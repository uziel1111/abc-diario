<?php
class Listadoesc_model extends CI_Model
{
  function niveles($idmunicipio=0){
    if ($idmunicipio>0) {
      $where = "WHERE ct.idmunicipio= {$idmunicipio}";
    }
    else {
      $where = " ";
    }
      $query="SELECT
              n.idnivel, n.descr as nombre, n.subfijo
              FROM cct ct
              INNER JOIN centrocfg cfg ON ct.idct = cfg.idct
              INNER JOIN niveleducativo n ON cfg.nivel = n.idnivel
              {$where}
              GROUP BY n.idnivel
              ORDER BY FIELD(n.idnivel,6,8,1,2,3,4,5,7)";
      return  $this->db->query($query)->result_array();
    }// niveles()

    function niveles_planea($idmunicipio=0){
    if ($idmunicipio>0) {
      $where = "WHERE ct.idmunicipio= {$idmunicipio}";
    }
    else {
      $where = " ";
    }
      $query="SELECT
              n.idnivel, n.descr as nombre, n.subfijo
              FROM cct ct
              INNER JOIN centrocfg cfg ON ct.idct = cfg.idct
              INNER JOIN niveleducativo n ON cfg.nivel = n.idnivel
              {$where} AND n.idnivel IN(2,3,4)
              GROUP BY n.idnivel
              ORDER BY FIELD(n.idnivel,2,3,4)";
      return  $this->db->query($query)->result_array();
    }// niveles()

    function sostenimientos($idmunicipio=0, $idnivel=0){
      if ($idmunicipio>0) {
        $where = "WHERE ct.idmunicipio= {$idmunicipio}";
      }
      else {
        $where = " ";
      }
      if ($idnivel>0) {
        $where .= " AND n.idnivel= {$idnivel}";
      }
        $query="SELECT
                s.idsostenimiento, s.descr as nombre, s.estatus
                FROM cct ct
                INNER JOIN centrocfg cfg ON ct.idct = cfg.idct
                INNER JOIN niveleducativo n ON cfg.nivel = n.idnivel
                INNER JOIN c_sostenimiento s ON ct.sostenimiento = s.idsostenimiento
                {$where}
                GROUP BY s.idsostenimiento";
        return  $this->db->query($query)->result_array();
      }// niveles()

}//
