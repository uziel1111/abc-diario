<?php
class Eficienciat_model extends CI_Model
{
  function eficiencia_terminal($cct, $turno){
    $str_query = "SELECT eficiencia_terminal FROM indicadores_x_idcentrocfg ind
    INNER JOIN centrocfg cfg ON cfg.idcentrocfg = ind.idcentrocfg
    INNER JOIN cct ct ON ct.idct = cfg.idct
    WHERE ct.cct = '{$cct}' AND cfg.turno = '{$turno}'";
      return  $this->db->query($str_query)->row();
    }// eficiencia_terminal()

    function indicadores_sum($cct, $turno){
      $str_query = "SELECT
      datos.periodo,
      IF(datos.lyc < datos.mat, datos.lyc, datos.mat) AS  mayor, 
      IF(datos.lyc < datos.mat,'lyc', 'mat') AS  contenido 
      FROM 
        (SELECT 
        pcfg.periodo_planea AS periodo,
        (pcfg.nii_lyc + pcfg.niii_lyc + pcfg.niv_lyc) AS lyc,
        (pcfg.nii_mat + pcfg.niii_mat + pcfg.niv_mat) AS mat
        FROM planea_nlogro_x_idcentrocfg pcfg
        INNER JOIN centrocfg cfg ON cfg.idcentrocfg = pcfg.idcentrocfg
        INNER JOIN cct ct ON ct.idct = cfg.idct
        WHERE ct.cct = '{$cct}' AND cfg.turno = '{$turno}') AS datos
        ORDER BY datos.periodo DESC
        LIMIT 1";
        return  $this->db->query($str_query)->row();
    }// indicadores_sum()

}//
