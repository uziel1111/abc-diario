<?php
class Riesgo_abandono_model extends CI_Model
{

      function ciclo_escolar(){
            $query="SELECT c.idciclo, c.descr as ciclo
                  FROM ciclo c
                  INNER JOIN complemento_apa apa ON c.descr LIKE CONCAT('%', apa.ciclo, '%')
                  GROUP BY c.idciclo";
      return  $this->db->query($query)->result_array();
      }

      function niveles(){
            $query="SELECT n.idnivel, n.descr as nombre, n.subfijo
            FROM niveleducativo n
            INNER JOIN complemento_apa apa on apa.idnivel = n.idnivel
            GROUP BY n.idnivel";
            return  $this->db->query($query)->result_array();
      }
	function obtener_riesgo_xmunicipioxnivelxcicloxperiodo($idmunicipio,$idnivel,$ciclo,$idperiodo){
		$datos=['A'];
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

      function obtener_riesgo_xcct($cct, $turno, $ciclo, $idperiodo){
            // $datos=['ACT'];
            // $where="";

            // if($idperiodo){
            //       $where.=" AND c.periodo=?";
            //       array_push($datos, $idperiodo);
            // }
            // if($idnivel>0){
            //       $where.=" AND cfg.nivel= ?";
            //       array_push($datos, $idnivel);
            // }
            // if($ciclo!=""){
            //       $where.= " AND c.ciclo=?";
            //       array_push($datos, $ciclo);
            // }

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
            WHERE ct.cct = '{$cct}' AND cfg.turno ='{$turno}' AND c.ciclo = {$ciclo} AND c.periodo = {$idperiodo}";
            // echo $query; die();
        return $this->db->query($query)->result_array();
      }
}
