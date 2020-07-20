<?php
class Mapa_model extends CI_Model
{

  function obtener_xparams($idmunicipio,$idnivel,$id_sostenimiento,$nombre_centro){
    $filtros = [];
    $where = '';
    // echo "<pre>";print_r($idmunicipio);die();
    if ($idmunicipio > 0 ) {
      $where .= "AND m.idmunicipio = ?";
      array_push($filtros, $idmunicipio);
    }
    if ($idnivel > 0 ) {
      $where .= "AND n.idnivel = ?";
      array_push($filtros, $idnivel);
    }
    if ($id_sostenimiento > 0 ) {
      $where .= "AND s.idsostenimiento = ?";
      array_push($filtros, $id_sostenimiento);
    }
    if($nombre_centro!=''){
      $where = " AND ct.nombre LIKE '%{$nombre_centro}%'";
    }
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
                  WHERE ct.`status`='A'
                  {$where} ";
        return $this->db->query($str_query, $filtros)->result_array();
    }// obtener_xparams()

    public function obtener_xidcct($idcfg)
    {
        $query = "SELECT

                  ct.cct as cve_centro,
                  ct.nombre as nombre_centro,
                  n.descr as nivel,
                  ct.turno,
                  t.descripcion as turno_single,
                  ct.lat as latitud, ct.lon as longitud,
                  cfg.nivel as idnivel,
                  m.nombre as municipio,
                  m.idmunicipio as idmunicipio,
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
                  WHERE cfg.idcentrocfg= ? ";
        return $this->db->query($query,[$idcfg])->result_array();
    }//obtener_xidcct

    function obtener_coordenadas_muni($idmunicipio){
      if ($idmunicipio==0) {
        return array(['lat' => 24.7903194,'lon' =>  -107.3878174]);
      }
      else {
        $str_query = "SELECT lat,lon FROM municipio WHERE idmunicipio = {$idmunicipio}";
        return $this->db->query($str_query)->result_array();
      }

    }// obtener_mismo_nivel()

    function obtener_mismo_nivel($latitud, $longitud, $id_nivel, $siguiente){
      if($siguiente == true && $id_nivel < 10){
        $id_nivel = $id_nivel+1;
      }

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
                cfg.idcentrocfg,
                (3959 * acos(
                cos(radians({$latitud}))
                * cos(radians(ct.lat))
                * cos(radians(ct.lon) - radians({$longitud}))
                + sin(radians({$latitud}))
                        * sin(radians(ct.lat)))) as distance
      FROM cct ct
      INNER JOIN centrocfg cfg ON ct.idct = cfg.idct
      INNER JOIN niveleducativo n ON cfg.nivel = n.idnivel
      INNER JOIN turno t on cfg.turno = t.idturno
      LEFT JOIN municipio m ON ct.idmunicipio = m.idmunicipio
      INNER JOIN c_sostenimiento s ON ct.sostenimiento = s.idsostenimiento
      WHERE ct.`status`='A' AND
      n.idnivel = ?
      HAVING distance < 1000
      ORDER BY distance
      LIMIT 6";
// echo "<pre>";print_r($str_query);die();
      return $this->db->query($str_query,[$id_nivel])->result_array();

    }// obtener_mismo_nivel()


}// Mapa_model
