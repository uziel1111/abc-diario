<?php
class Catreq_model extends CI_Model
{
  function __construct(){
        parent::__construct();
        $this->levreq_db = $this->load->database('levreq_db', TRUE);
    }

    function obtener_num_xnivel(){
    	$str_query = "SELECT
                   r.complemento as nivel, COUNT(DISTINCT r.idaplicar) as num_req
                   FROM respuesta r
                  	INNER JOIN aplicar a ON r.idaplicar = a.idaplicar
                   WHERE r.idpregunta=11 AND a.estatus=1
                   GROUP BY r.complemento
                  ORDER BY FIELD(r.complemento, 'Inicial', 'Preescolar', 'Primaria', 'Secundaria', 'Especial', 'Educación indígena', 'Educación para Adultos', 'Educación migrante');";
		return $this->levreq_db->query($str_query)->result_array();
    }

    function obtener_requerimientos($nivel){
      $nivel = str_replace("%20", " ", $nivel);
      $nivel = str_replace("%C3%B3", "ó", $nivel);
      $nivel = str_replace("%C3%AD", "í", $nivel);
      // echo "<pre>";print_r($nivel);die();
    	$str_query1 = "SET lc_time_names = 'es_ES'";

		$str_query = "SELECT
		a.idaplicar as folio,
		a1.respuesta as nombre_requierimiento,
		a11.complemento as niveles,
		a12.complemento as sostenimiento,
		a16.complemento as periodicidad,
		a19.complemento as fechas_entrega,
		a28.complemento as tipo,
		a29.complemento as modalidad
		FROM aplicar a
		INNER JOIN (SELECT idaplicar, respuesta FROM respuesta WHERE idpregunta=4) as a1 ON a.idaplicar = a1.idaplicar
		INNER JOIN (SELECT
		 r.idaplicar, GROUP_CONCAT( DISTINCT r.complemento) as complemento
		 FROM respuesta r
		 WHERE r.idpregunta=11 AND r.complemento = ?
		 GROUP BY r.idaplicar) as a11 ON a.idaplicar = a11.idaplicar
		LEFT JOIN (SELECT
		 r.idaplicar, GROUP_CONCAT( DISTINCT r.complemento) as complemento
		 FROM respuesta r
		 WHERE r.idpregunta=12
		 GROUP BY r.idaplicar) as a12 ON a.idaplicar = a12.idaplicar
		LEFT JOIN (SELECT
		 r.idaplicar, GROUP_CONCAT( DISTINCT r.complemento) as complemento
		 FROM respuesta r
		 WHERE r.idpregunta=16
		 GROUP BY r.idaplicar) as a16 ON a.idaplicar = a16.idaplicar
		LEFT JOIN (SELECT
		 r.idaplicar, GROUP_CONCAT( DISTINCT r.complemento) as complemento
		 FROM respuesta r
		 WHERE r.idpregunta=19
		 GROUP BY r.idaplicar) as a19 ON a.idaplicar = a19.idaplicar
		LEFT JOIN (SELECT idaplicar, complemento FROM respuesta WHERE idpregunta=28) as a28 ON a.idaplicar = a28.idaplicar
		LEFT JOIN (SELECT
		 r.idaplicar, GROUP_CONCAT( DISTINCT r.complemento) as complemento
		 FROM respuesta r
		 WHERE r.idpregunta=29
		 GROUP BY r.idaplicar) as a29 ON a.idaplicar = a29.idaplicar
		WHERE a.estatus=1
		 GROUP BY a.idaplicar
		ORDER BY a28.complemento ASC , FIELD(a16.complemento, 'Permanente') DESC,
(
	case
			when a19.complemento LIKE CONCAT('%Agosto%') then 1
			when a19.complemento LIKE CONCAT('%Septiembre%')  then 2
			when a19.complemento LIKE CONCAT('%Octubre%')  then 3
			when a19.complemento LIKE CONCAT('%Noviembre%')  then 4
			when a19.complemento LIKE CONCAT('%Diciembre%')  then 5
			when a19.complemento LIKE CONCAT('%Enero%')  then 6
			when a19.complemento LIKE CONCAT('%Febrero%')  then 7
			when a19.complemento LIKE CONCAT('%Marzo%')  then 8
			when a19.complemento LIKE CONCAT('%Abril%')  then 9
			when a19.complemento LIKE CONCAT('%Mayo%')  then 10
			when a19.complemento LIKE CONCAT('%Junio%')  then 11
			when a19.complemento LIKE CONCAT('%Julio%')  then 12
			else 13
	 end
), a1.respuesta
";
$this->levreq_db->query($str_query1);
		return $this->levreq_db->query($str_query,[$nivel])->result_array();
    }

    function trae_url_xfolio($folio){
    	$str_query = "SELECT url_comple FROM respuesta WHERE ISNULL(idpregunta) AND idaplicar=?;";
		return $this->levreq_db->query($str_query,[$folio])->row('url_comple');
    }

    function obtener_detalles_xfolio($folio){
    	$str_query = "SELECT
a1.respuesta as nombre_requierimiento,
a5.respuesta as descripcion_req,
a6.complemento as area_solicitante,
a9.complemento as forma_de_generar,
a10.respuesta as url_si_sistema,
a11.complemento as niveles,
a13.complemento as forma_entregar_req,
a15.complemento as se_requiere_oficio,
a16.complemento as periodicidad,
a19.complemento as fechas_entrega,
a20.respuesta as utilidad,
a21.respuesta as fudamento_legal,
a22.complemento as con_anexos,
a12.complemento as sostenimiento,
a23.respuesta as especifica_anexo,
a27.respuesta as acc_mejora_implementada
FROM aplicar a
INNER JOIN (SELECT idaplicar, respuesta FROM respuesta WHERE idpregunta=4 AND idaplicar={$folio}) as a1 ON a.idaplicar = a1.idaplicar
INNER JOIN (SELECT idaplicar, respuesta FROM respuesta WHERE idpregunta=5 AND idaplicar={$folio}) as a5 ON a.idaplicar = a5.idaplicar
INNER JOIN (SELECT
 r.idaplicar, GROUP_CONCAT( DISTINCT r.complemento) as complemento
 FROM respuesta r
 WHERE r.idpregunta=6 AND r.idaplicar={$folio}
 GROUP BY r.idaplicar) as a6 ON a.idaplicar = a6.idaplicar
LEFT JOIN (SELECT
 r.idaplicar, GROUP_CONCAT( DISTINCT r.complemento) as complemento
 FROM respuesta r
 WHERE r.idpregunta=9 AND r.idaplicar={$folio}
 GROUP BY r.idaplicar) as a9 ON a.idaplicar = a9.idaplicar
LEFT JOIN (SELECT idaplicar, respuesta FROM respuesta WHERE idpregunta=10 AND idaplicar={$folio}) as a10 ON a.idaplicar = a10.idaplicar
INNER JOIN (SELECT
 r.idaplicar, GROUP_CONCAT( DISTINCT r.complemento) as complemento
 FROM respuesta r
 WHERE r.idpregunta=11 AND r.idaplicar={$folio}
 GROUP BY r.idaplicar) as a11 ON a.idaplicar = a11.idaplicar
INNER JOIN (SELECT
 r.idaplicar, GROUP_CONCAT( DISTINCT r.complemento) as complemento
 FROM respuesta r
 WHERE r.idpregunta=13 AND r.idaplicar={$folio}
 GROUP BY r.idaplicar) as a13 ON a.idaplicar = a13.idaplicar
LEFT JOIN (SELECT
 r.idaplicar, r.complemento
 FROM respuesta r
 WHERE r.idpregunta=15 AND r.idaplicar={$folio}) as a15 ON a.idaplicar = a15.idaplicar
INNER JOIN (SELECT
 r.idaplicar, GROUP_CONCAT( DISTINCT r.complemento) as complemento
 FROM respuesta r
 WHERE r.idpregunta=16 AND r.idaplicar={$folio}
 GROUP BY r.idaplicar) as a16 ON a.idaplicar = a16.idaplicar
INNER JOIN (SELECT
 r.idaplicar, GROUP_CONCAT( DISTINCT r.complemento) as complemento
 FROM respuesta r
 WHERE r.idpregunta=19 AND r.idaplicar={$folio}
 GROUP BY r.idaplicar) as a19 ON a.idaplicar = a19.idaplicar
INNER JOIN (SELECT idaplicar, respuesta FROM respuesta WHERE idpregunta=20 AND idaplicar={$folio}) as a20 ON a.idaplicar = a20.idaplicar
LEFT JOIN (SELECT idaplicar, respuesta FROM respuesta WHERE idpregunta=21 AND idaplicar={$folio}) as a21 ON a.idaplicar = a21.idaplicar
LEFT JOIN (SELECT idaplicar, complemento FROM respuesta WHERE idpregunta=22 AND idaplicar={$folio}) as a22 ON a.idaplicar = a22.idaplicar
INNER JOIN (SELECT
 r.idaplicar, GROUP_CONCAT( DISTINCT r.complemento) as complemento
 FROM respuesta r
 WHERE r.idpregunta=12 AND r.idaplicar={$folio}
 GROUP BY r.idaplicar) as a12 ON a.idaplicar = a12.idaplicar
LEFT JOIN (SELECT idaplicar, respuesta FROM respuesta WHERE idpregunta=23) as a23 ON a.idaplicar = a23.idaplicar
LEFT JOIN (SELECT idaplicar, respuesta FROM respuesta WHERE idpregunta=27) as a27 ON a.idaplicar = a27.idaplicar
WHERE a.idaplicar= ? ;";
		return $this->levreq_db->query($str_query,[$folio])->row();
    }

    function obtener_contacto_xfolio($folio){
    	$str_query = "SELECT
                CONCAT_WS(' ',u.nombre,u.paterno,u.materno) as nombre,
                u.direccion, u.ntelefono, u.email
                FROM aplicar a
                INNER JOIN usuario u ON a.idusuario = u.idusuario
                WHERE a.idaplicar=?;";
		return $this->levreq_db->query($str_query,[$folio])->row();
    }



}//
