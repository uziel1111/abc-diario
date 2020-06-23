<?php
class Riesgo_abandono_model extends CI_Model
{
	function obtener_riesgo_xmunicipioxnivelxcicloxperiodo($idmunicipio,$idnivel,$ciclo,$idperiodo){
		$datos=['ACT'];
		$where="";
		
		if($idmunicipio>0){
			$where.=" AND m.idmunicipio=?";
			array_push($datos, $idmunicipio);
		}
		if($idperiodo){
			$where.=" AND c.periodo=?";
			array_push($datos, $idperiodo);
		}
		if($idnivel>0){
			$where.=" AND cfg.nivel= ?";
			array_push($datos, $idnivel);
		}
		if($ciclo!=""){
			$where.= " AND c.ciclo=?";
			array_push($datos, $ciclo);
		}

		$query="SELECT
            SUM(c.per_riesgo_al_t) AS total,
            SUM(c.per_riesgo_al_muy_alto) AS muy_alto,
            SUM(c.per_riesgo_al_alto) AS alto,
            SUM(c.per_riesgo_al_medio) AS medio,
            SUM(c.per_riesgo_al_bajo) AS bajo,
            SUM(c.per_riesgo_al_muy_alto_1) as muy_alto1,
            SUM(c.per_riesgo_al_muy_alto_2) as muy_alto2,
            SUM(c.per_riesgo_al_muy_alto_3) as muy_alto3,
            SUM(c.per_riesgo_al_muy_alto_4) as muy_alto4,
            SUM(c.per_riesgo_al_muy_alto_5) as muy_alto5,
            SUM(c.per_riesgo_al_muy_alto_6) as muy_alto6,
            SUM(c.per_riesgo_al_alto_1) as alto1,
            SUM(c.per_riesgo_al_alto_2) as alto2,
            SUM(c.per_riesgo_al_alto_3) as alto3,
            SUM(c.per_riesgo_al_alto_4) as alto4,
            SUM(c.per_riesgo_al_alto_5) as alto5,
            SUm(c.per_riesgo_al_alto_6) as alto6
            FROM complemento_apa AS c
            INNER JOIN centrocfg cfg ON cfg.idcentrocfg=c.idcentrocfg
            INNER JOIN cct ct ON ct.idct=cfg.idct
            INNER JOIN municipio m ON m.idmunicipio=ct.idmunicipio
            WHERE ct.status=? 
            {$where}
            ";
        return $this->db->query($query,$datos)->result_array();
	}
}