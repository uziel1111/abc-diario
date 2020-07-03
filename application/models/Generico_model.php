<?php
class Generico_model extends CI_Model
{
  function municipios(){
      $query="SELECT idmunicipio, nombre FROM municipio";
      return  $this->db->query($query)->result_array();
    }// municipios()
  function niveles(){
      $query="SELECT idnivel, descr as nombre, subfijo FROM niveleducativo";
      return  $this->db->query($query)->result_array();
    }// niveles()
  function sostenimientos(){
      $query="SELECT idsostenimiento, descr as nombre, estatus FROM c_sostenimiento";
      return  $this->db->query($query)->result_array();
    }// sostenimientos()
  function obtener_nivel_xidmunicipio($id_municipio){
    if($id_municipio>0){
          $where = "WHERE est.idmunicipio = {$id_municipio}";
          $from = "estadistica_x_muni";
        }
        else{
          $where = ' ';
          $from = "estadistica_x_estado";
        }
        $str_query = "SELECT
                    	n.idnivel, n.descr as nombre, n.subfijo
                    	FROM {$from} est
                    	INNER JOIN niveleducativo n on est.idnivel = n.idnivel
                    	{$where}
                      GROUP BY n.idnivel";

        return $this->db->query($str_query)->result_array();
    }// obtener_nivel_xidmunicipio()
    function obtener_sostenimiento_xidmunicipioxidnivel($id_municipio,$idnivel){
      if($id_municipio>0){
            $where = "WHERE est.idmunicipio = {$id_municipio} ";
            $from = "estadistica_x_muni";
          }
          else{
            $where = 'WHERE 1=1 ';
            $from = "estadistica_x_estado";
          }
      if($idnivel>0){
            $where .= " AND n.idnivel = {$idnivel}";
          }
          $str_query = "SELECT
                          s.idsostenimiento, s.descr as nombre, s.estatus
                          FROM {$from} est
                          INNER JOIN niveleducativo n on est.idnivel = n.idnivel
                          INNER JOIN c_sostenimiento s ON est.idsostenimiento = s.idsostenimiento
                          {$where}
                        GROUP BY s.idsostenimiento";

          return $this->db->query($str_query)->result_array();
      }// obtener_sostenimiento_xidmunicipioxidnivel()
      function obtener_xcvecentro($cct){

            $str_query = "SELECT

                          ct.cct as cve_centro,
                          ct.nombre as nombre_centro,
                          n.descr as nivel,
                          ct.turno,
                          t.descripcion as turno_single,
                          ct.lat as latitud, ct.lon as longitud,
                          cfg.nivel as idnivel,
                          m.nombre as municipio,
                          ct.localidad,
                          ct.zona zona_escolar,
                          s.descr as sostenimiento,
                          cfg.idcentrocfg
                          FROM cct ct
                          INNER JOIN centrocfg cfg ON ct.idct = cfg.idct
                          INNER JOIN niveleducativo n ON cfg.nivel = n.idnivel
                          INNER JOIN turno t on cfg.turno = t.idturno
                          LEFT JOIN municipio m ON ct.idmunicipio = m.idmunicipio
                          INNER JOIN c_sostenimiento s ON ct.sostenimiento = s.idsostenimiento
                          WHERE ct.cct= ? ";
            return $this->db->query($str_query, [$cct])->result_array();
        }// obtener_xcvecentro()


  function ciclo_escolar(){
    $query="SELECT idciclo,descr as ciclo
            FROM ciclo ORDER BY status";
      return  $this->db->query($query)->result_array();
  }//ciclo escolar

  function modalidades(){
    $query="SELECT idmodalidad,descr as nombre
            FROM c_modalidad";
      return  $this->db->query($query)->result_array();
  }

  function obtener_modalidad_xidmunicipioxidnivelxsostenimiento($id_municipio,$idnivel,$idsostenimiento){
    if($id_municipio>0){
          $where = "WHERE est.idmunicipio = {$id_municipio} ";
          $from = "estadistica_x_muni";
        }
        else{
          $where = 'WHERE 1=1 ';
          $from = "estadistica_x_estado";
        }

      if($idnivel>0){
        $where .= " AND n.idnivel = {$idnivel}";
      }
      if($idsostenimiento>-1){
        $where .= " AND s.idsostenimiento = {$idsostenimiento}";
      }

          $str_query = "SELECT
                  			m.idmodalidad, m.descr as nombre
                  			FROM {$from} est
                  			INNER JOIN niveleducativo n on est.idnivel = n.idnivel
                  			INNER JOIN c_sostenimiento s ON est.idsostenimiento= s.idsostenimiento
                  			INNER JOIN c_modalidad m ON est.idmodalidad = m.idmodalidad
                  			{$where}
                  			GROUP BY m.idmodalidad";
// echo "<pre>";print_r($str_query);die();
          return $this->db->query($str_query)->result_array();
    }// obtener_sostenimiento_xidmunicipioxidnivel()

  function periodos_planeaxreactivo(){
    $query="SELECT
                  pp.id_periodo, pp.periodo
                  FROM cct ct
                  INNER JOIN centrocfg  cfg ON ct.idct= cfg.idct
                  INNER JOIN niveleducativo n on cfg.nivel = n.idnivel
                  INNER JOIN planeaxidcentrocfg_reactivo pr ON cfg.idcentrocfg = pr.idcentrocfg
                  INNER JOIN periodoplanea pp ON pr.id_periodo = pp.id_periodo
                  WHERE ct.`status`='ACT' AND cfg.`status`='A'
                  GROUP BY pp.id_periodo";
      return  $this->db->query($query)->result_array();
  }//periodos_planea
  function contenidos_planea(){
    $query="SELECT id_periodo, periodo FROM periodoplanea";
      return  $this->db->query($query)->result_array();
  }//contenidos_planea

  function info_escuela_get($cct,$turno){
    $query = "SELECT c.nombre,c.cct,
                CASE  WHEN c.turno = 100 THEN 'MATUTINO'
                WHEN c.turno = 200 THEN 'VESPERTINO'
                END as turno,n.descr as nivel,m.descr as modalidad,s.descr as sostenimiento ,concat(domicilio,numero) as domicilio,c.localidad,mun.nombre as municipio,'director',if(c.status='ACT','ACTIVO','') as estatus, cfg.idcentrocfg FROM cct c
                left join niveleducativo n on n.idnivel = c.nivel
                left join c_modalidad m on m.idmodalidad = c.idmodalidad
                left join c_sostenimiento s on s.idsostenimiento = c.sostenimiento
                left join municipio mun on mun.idmunicipio = c.idmunicipio
                left join centrocfg cfg ON cfg.idct = c.idct
                where c.cct = ? AND c.turno like ?;";
      return $this->db->query($query,array($cct,$turno))->result_array();
  }//info_escuela_get

   function info_escuela_post($idcentrocfg){
    $query = "SELECT
    c.nombre,
    c.cct,
    CASE
        WHEN c.turno = 100 THEN 'MATUTINO'
        WHEN c.turno = 200 THEN 'VESPERTINO'
    END AS turno,
    cfg.turno AS idturno,
    n.descr AS nivel,
    m.descr AS modalidad,
    s.descr AS sostenimiento,
    CONCAT(domicilio, numero) AS domicilio,
    c.localidad,
    mun.nombre AS municipio,
    'director',
    IF(c.status = 'ACT', 'ACTIVO', '') AS estatus
FROM
    cct c
        LEFT JOIN
    niveleducativo n ON n.idnivel = c.nivel
        LEFT JOIN
    c_modalidad m ON m.idmodalidad = c.idmodalidad
        LEFT JOIN
    c_sostenimiento s ON s.idsostenimiento = c.sostenimiento
        LEFT JOIN
    municipio mun ON mun.idmunicipio = c.idmunicipio
        INNER JOIN
    centrocfg cfg ON cfg.idct = c.idct
WHERE
    cfg.idcentrocfg = ?;";
      return $this->db->query($query,array($idcentrocfg))->result_array();
  }//info_escuela_get

  function obtener_nombre_municipio($idmunicipio){
      $query="SELECT nombre FROM municipio WHERE idmunicipio= ? ";
      return  $this->db->query($query,[$idmunicipio])->result_array();
  }// obtener_nombre_municipio()
  function obtener_nombre_nivel($idnivel){
      $query="SELECT  descr as nombre FROM niveleducativo WHERE idnivel= ? ";
      return  $this->db->query($query,[$idnivel])->result_array();
  }// obtener_nombre_nivel()

  function obtener_nombre_sostenimiento($idsostenimiento){
      $query="SELECT descr as nombre FROM c_sostenimiento WHERE idsostenimiento= ? AND estatus=?";
      return  $this->db->query($query,[$idsostenimiento,'A'])->result_array();
  }// obtener_nombre_municipio()
  function obtener_nombre_modalidad($idmodalidad){
      $query="SELECT  descr as nombre FROM c_modalidad WHERE idmodalidad= ? AND estatus=?";
      return  $this->db->query($query,[$idmodalidad,'A'])->result_array();
  }// obtener_nombre_nivel()
  function obtener_ciclo($idciclo){
      $query="SELECT  descr as nombre FROM ciclo WHERE idciclo= ? ";
      return  $this->db->query($query,[$idciclo])->result_array();
  }// obtener_nombre_nivel()

  function get_idciclo_x_desc($ciclo){
    $query="SELECT  idciclo FROM ciclo WHERE descr = ? ";
      return  $this->db->query($query,[$ciclo])->row();
  }

}// Generico_model
