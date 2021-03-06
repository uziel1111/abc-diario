<?php
class Estadistica_model extends CI_Model
{
 	function obtener_alumnos_xmunicipioxnivelxsosteniminientoxmodalidadxciclo($id_municipio,$id_nivel,$id_sostenimiento,$id_modalidad,$id_ciclo){
 		$where=" WHERE est.idciclo={$id_ciclo} ";
 		$tabla = " estadistica_x_estado ";
 		if($id_municipio!=0){
 			$where.=" AND est.idmunicipio={$id_municipio}";
 			$tabla = "estadistica_x_muni";
 		}
 		$query1="SELECT * FROM(
      (SELECT est.idnivel, n.descr AS nivel, '0' AS idsostenimiento, 'total' AS sostenimiento,
			'0' AS idmodalidad,
			'total' AS modalidad,
			SUM(IF(ISNULL(est.t_alumnos_m),0 , t_alumnos_m)) AS alumn_m_t,
			SUM(IF(ISNULL(est.t_alumnos_h),0 , t_alumnos_h)) AS alumn_h_t,
			SUM(IF(ISNULL(est.t_alumnos),0 , t_alumnos)) AS alumn_t_t,
			SUM(est.alumnos1) AS alumnos1,
			SUM(est.alumnos2) AS alumnos2,
			SUM(est.alumnos3) AS alumnos3,
			SUM(est.alumnos4) AS alumnos4,
			SUM(est.alumnos5) AS alumnos5,
			SUM(est.alumnos6) AS alumnos6
			FROM {$tabla} est
			INNER JOIN niveleducativo n ON n.idnivel = est.idnivel
			{$where} AND est.idmodalidad!=15
			GROUP BY est.idnivel)
			UNION
			(SELECT est.idnivel, n.descr AS nivel, est.idsostenimiento, s.descr AS sostenimiento,
			'0' AS idmodalidad,
			'total' AS modalidad,
			SUM(IF(ISNULL(est.t_alumnos_m),0 , t_alumnos_m)) AS alumn_m_t,
			SUM(IF(ISNULL(est.t_alumnos_h),0 , t_alumnos_h)) AS alumn_h_t,
			SUM(IF(ISNULL(est.t_alumnos),0 , t_alumnos)) AS alumn_t_t,
			SUM(est.alumnos1) AS alumnos1,
			SUM(est.alumnos2) AS alumnos2,
			SUM(est.alumnos3) AS alumnos3,
			SUM(est.alumnos4) AS alumnos4,
			SUM(est.alumnos5) AS alumnos5,
			SUM(est.alumnos6) AS alumnos6
			FROM {$tabla} est
			INNER JOIN niveleducativo n ON n.idnivel = est.idnivel
			INNER JOIN c_sostenimiento s ON s.idsostenimiento = est.idsostenimiento
			{$where} AND est.idmodalidad!=15
			GROUP BY est.idnivel,s.idsostenimiento)
			UNION
			(SELECT est.idnivel, n.descr AS nivel, est.idsostenimiento, s.descr AS sostenimiento,
			est.idmodalidad,
			m.descr AS modalidad,
			SUM(IF(ISNULL(est.t_alumnos_m),0 , t_alumnos_m)) AS alumn_m_t,
			SUM(IF(ISNULL(est.t_alumnos_h),0 , t_alumnos_h)) AS alumn_h_t,
			SUM(IF(ISNULL(est.t_alumnos),0 , t_alumnos)) AS alumn_t_t,
			SUM(est.alumnos1) AS alumnos1,
			SUM(est.alumnos2) AS alumnos2,
			SUM(est.alumnos3) AS alumnos3,
			SUM(est.alumnos4) AS alumnos4,
			SUM(est.alumnos5) AS alumnos5,
			SUM(est.alumnos6) AS alumnos6
			FROM {$tabla} est
			INNER JOIN niveleducativo n ON n.idnivel = est.idnivel
			INNER JOIN c_sostenimiento s ON s.idsostenimiento = est.idsostenimiento
			INNER JOIN c_modalidad m ON m.idmodalidad = est.idmodalidad
			{$where} AND m.idmodalidad != 15
			GROUP BY est.idnivel,s.idsostenimiento, m.idmodalidad
			ORDER BY  est.idnivel,s.idsostenimiento,m.idmodalidad)) as xxxx
ORDER BY FIELD(xxxx.idnivel,1,2,3,4,5,7,6,8),FIELD(xxxx.idsostenimiento,1,2,3),FIELD(xxxx.idmodalidad,1,4,7,6,8,9,10,12,13,16,2,17,3,5,11)
			";

  		return $this->db->query($query1)->result_array();
  	}

  	function obtener_docentes_xmunicipioxnivelxsosteniminientoxmodalidadxciclo($id_municipio,$id_nivel,$id_sostenimiento,$id_modalidad,$id_ciclo){
 		$where=" WHERE est.idciclo={$id_ciclo}";
 		$tabla = " estadistica_x_estado ";
 		if($id_municipio!=0){
 			$where.=" AND est.idmunicipio={$id_municipio}";
 			$tabla = "estadistica_x_muni";
 		}

 		$query1="SELECT * FROM(
				(SELECT n.idnivel,n.descr AS nivel,'0' AS idsostenimiento,
				'total' AS sostenimiento,'0' AS idmodalidad,
				'total' AS modalidad,
				'' AS docentes_m,
				'' AS docentes_h,
				SUM(est.t_docentes) AS docentes_t_g,
				'' AS directivo_m_congrup,
				'' AS directivo_h_congrup,
				est.t_direc_congrupo AS directivo_t_congrup,
				'' AS directivo_m_singrup,
				'' AS directivo_h_singrup,
				est.t_direc_singrupo AS directivo_t_singrup
				FROM {$tabla} est
				INNER JOIN niveleducativo n ON n.idnivel = est.idnivel
				{$where} AND est.idmodalidad!=15
				GROUP BY est.idnivel)
				UNION(
				SELECT n.idnivel,n.descr AS nivel,s.idsostenimiento,
				s.descr AS sostenimiento,'0' AS idmodalidad,
				'total' AS modalidad,
				'' AS docentes_m,
				'' AS docentes_h,
				SUM(est.t_docentes) AS docentes_t_g,
				'' AS directivo_m_congrup,
				'' AS directivo_h_congrup,
				est.t_direc_congrupo AS directivo_t_congrup,
				'' AS directivo_m_singrup,
				'' AS directivo_h_singrup,
				est.t_direc_singrupo AS directivo_t_singrup
				FROM {$tabla} est
				INNER JOIN niveleducativo n ON n.idnivel = est.idnivel
				INNER JOIN c_sostenimiento s ON s.idsostenimiento = est.idsostenimiento
				{$where} AND est.idmodalidad!=15
				GROUP BY est.idnivel, s.idsostenimiento
				)
				UNION(
				SELECT n.idnivel,n.descr AS nivel,s.idsostenimiento,
				s.descr AS sostenimiento,m.idmodalidad,
				m.descr AS modalidad,
				'' AS docentes_m,
				'' AS docentes_h,
				SUM(est.t_docentes) AS docentes_t_g,
				'' AS directivo_m_congrup,
				'' AS directivo_h_congrup,
				est.t_direc_congrupo AS directivo_t_congrup,
				'' AS directivo_m_singrup,
				'' AS directivo_h_singrup,
				est.t_direc_singrupo AS directivo_t_singrup
				FROM {$tabla} est
				INNER JOIN niveleducativo n ON n.idnivel = est.idnivel
				INNER JOIN c_sostenimiento s ON s.idsostenimiento = est.idsostenimiento
				INNER JOIN c_modalidad m ON m.idmodalidad = est.idmodalidad
				{$where} AND m.idmodalidad != 15
				GROUP BY est.idnivel, s.idsostenimiento, m.idmodalidad
				ORDER BY  est.idnivel,est.idsostenimiento,est.idmodalidad
				)) as xxxx
  ORDER BY FIELD(xxxx.idnivel,1,2,3,4,5,7,6,8),FIELD(xxxx.idsostenimiento,1,2,3),FIELD(xxxx.idmodalidad,1,4,7,6,8,9,10,12,13,16,2,17,3,5,11)
				";
  		return $this->db->query($query1)->result_array();
  	}

  	function obtener_infraestructura_xmunicipioxnivelxsosteniminientoxmodalidadxciclo($id_municipio,$id_nivel,$id_sostenimiento,$id_modalidad,$id_ciclo){
 		$where=" WHERE est.idciclo={$id_ciclo}";
 		$tabla = " estadistica_x_estado ";
 		if($id_municipio!=0){
 			$where.=" AND est.idmunicipio={$id_municipio}";
 			$tabla = "estadistica_x_muni";
 		}

 		$query1="SELECT * FROM((SELECT n.idnivel,n.descr AS nivel,'0' AS idsostenimiento,
				'total' AS sostenimiento,'0' AS idmodalidad,
				'total' AS modalidad,
				SUM(est.n_escuelas)AS nescuelas,
				SUM(est.grupos1) AS grupos_1,
				SUM(est.grupos2) AS grupos_2,
				SUM(est.grupos3) AS grupos_3,
				SUM(est.grupos4) AS grupos_4,
				SUM(est.grupos5) AS grupos_5,
				SUM(est.grupos6) AS grupos_6,
				SUM(est.gruposmulti) AS grupos_multi,
				SUM(t_grupos) AS grupos_t
				FROM {$tabla} est
				INNER JOIN niveleducativo n ON n.idnivel = est.idnivel
				{$where} AND est.idmodalidad!=15
				GROUP BY est.idnivel)
				UNION(
				SELECT n.idnivel,n.descr AS nivel,s.idsostenimiento,
				s.descr AS sostenimiento,'0' AS idmodalidad,
				'total' AS modalidad,
				SUM(est.n_escuelas)AS nescuelas,
				SUM(est.grupos1) AS grupos_1,
				SUM(est.grupos2) AS grupos_2,
				SUM(est.grupos3) AS grupos_3,
				SUM(est.grupos4) AS grupos_4,
				SUM(est.grupos5) AS grupos_5,
				SUM(est.grupos6) AS grupos_6,
				SUM(est.gruposmulti) AS grupos_multi,
				SUM(t_grupos) AS grupos_t
				FROM {$tabla} est
				INNER JOIN niveleducativo n ON n.idnivel = est.idnivel
				INNER JOIN c_sostenimiento s ON s.idsostenimiento = est.idsostenimiento
				{$where} AND est.idmodalidad!=15
				GROUP BY est.idnivel, s.idsostenimiento
				)
				UNION(
				SELECT n.idnivel,n.descr AS nivel,s.idsostenimiento,
				s.descr AS sostenimiento,m.idmodalidad,
				m.descr AS modalidad,
				SUM(est.n_escuelas)AS nescuelas,
				SUM(est.grupos1) AS grupos_1,
				SUM(est.grupos2) AS grupos_2,
				SUM(est.grupos3) AS grupos_3,
				SUM(est.grupos4) AS grupos_4,
				SUM(est.grupos5) AS grupos_5,
				SUM(est.grupos6) AS grupos_6,
				SUM(est.gruposmulti) AS grupos_multi,
				SUM(t_grupos) AS grupos_t
				FROM {$tabla} est
				INNER JOIN niveleducativo n ON n.idnivel = est.idnivel
				INNER JOIN c_sostenimiento s ON s.idsostenimiento = est.idsostenimiento
				INNER JOIN c_modalidad m ON m.idmodalidad = est.idmodalidad
				{$where} AND m.idmodalidad != 15
				GROUP BY est.idnivel, s.idsostenimiento, m.idmodalidad
				)) as xxxx
  ORDER BY FIELD(xxxx.idnivel,1,2,3,4,5,7,6,8),FIELD(xxxx.idsostenimiento,1,2,3),FIELD(xxxx.idmodalidad,1,4,7,6,8,9,10,12,13,16,2,17,3,5,11)";
  		return $this->db->query($query1)->result_array();
  	}

  	function indicadores_asistencia_xmunicipio($id_municipio,$idciclo){
  		$where="WHERE 1=1";
  		$tabla = " indicadores_x_estado ";
  		$campos = " e.identidad,e.nombre as muninicipio ";
  		$inner = "INNER JOIN entidad e ON e.identidad=i.idestado";
 		if($id_municipio!=0){
 			$where.=" AND m.idmunicipio={$id_municipio}";
 			$tabla = " indicadores_x_muni ";
 			$campos = " i.idmunicipio,m.nombre as muninicipio ";
  			$inner = " INNER JOIN municipio m ON m.idmunicipio=i.idmunicipio ";
 		}
  		$query="SELECT {$campos},i.idnivel,n.descr as nivel,i.idciclo,c.descr as ciclo,i.cobertura,i.absorcion
  			FROM {$tabla} as i
  			{$inner}
  			INNER JOIN niveleducativo n ON n.idnivel=i.idnivel
  			INNER JOIN ciclo c ON c.idciclo=i.idciclo
  			{$where}
        ORDER BY FIELD(n.descr,'PRIMARIA','SECUNDARIA ','MEDIA SUPERIOR','SUPERIOR'),c.descr DESC
  		";

  		return $this->db->query($query)->result_array();
  	}

  	function indicadores_permanencia_xmunicipio($id_municipio,$idciclo){
  		$where="WHERE 1=1";
  		$tabla = " indicadores_x_estado ";
  		$campos = " e.identidad,e.nombre as muninicipio ";
  		$inner = "INNER JOIN entidad e ON e.identidad=i.idestado";
 		if($id_municipio!=0){
 			$where.=" AND m.idmunicipio={$id_municipio}";
 			$tabla = " indicadores_x_muni ";
 			$campos = " i.idmunicipio,m.nombre as muninicipio ";
  			$inner = " INNER JOIN municipio m ON m.idmunicipio=i.idmunicipio ";
 		}
  		$query="SELECT {$campos},i.idnivel,n.descr as nivel,i.idciclo,c.descr as ciclo,i.retencion,i.aprobacion,i.eficiencia_terminal as et
  			FROM {$tabla} as i
  			{$inner}
  			INNER JOIN niveleducativo n ON n.idnivel=i.idnivel
  			INNER JOIN ciclo c ON c.idciclo=i.idciclo
  			{$where}
        ORDER BY FIELD(n.descr,'PRIMARIA','SECUNDARIA ','MEDIA SUPERIOR','SUPERIOR'),c.descr DESC

  			";
  		return $this->db->query($query)->result_array();
  	}

  	function indicadores_aprendizaje_xmunicipio($id_municipio){
  		$where="";
  		$campos = " p.identidad,e.nombre as muninicipio ";
  		$tabla = " planea_nlogro_x_entidad ";
  		$inner = " INNER JOIN entidad e ON e.identidad=p.identidad ";
 		if($id_municipio!=0){
 			$where.=" where m.idmunicipio={$id_municipio}";
 			$campos = " p.idmunicipio,m.nombre as muninicipio ";
  			$tabla = " planea_nlogro_x_muni ";
  			$inner = " INNER JOIN municipio m ON m.idmunicipio=p.idmunicipio ";
 		}
  		$query="SELECT {$campos},p.idnivel,concat(n.descr,' (',p.periodo_planea,')') as nivel,
  				p.ni_lyc,p.nii_lyc,p.niii_lyc,p.niv_lyc,p.ni_mat,p.nii_mat,p.niii_mat,
  				p.niv_mat
  			FROM {$tabla} as p
  			{$inner}
  			INNER JOIN niveleducativo n ON n.idnivel=p.idnivel
  			{$where}
  			";
  		return $this->db->query($query)->result_array();
  	}

  	function analfabetismo_xmuni($idmunicipio){
  		$where="";
  		if($idmunicipio>0){
  			$where=" WHERE idmunicipio={$idmunicipio} ";
        $query="SELECT * FROM analfabetismo_xmuni
    			{$where}
          ORDER BY anio DESC";
  		}
      else {
        $query="SELECT
            anio,
            sum(analfabetismo_mayor15_m) as analfabetismo_mayor15_m,
            sum(analfabetismo_mayor15_h) as analfabetismo_mayor15_h
            FROM analfabetismo_xmuni
            GROUP BY anio
            ORDER BY anio DESC";
      }
  		return $this->db->query($query)->result_array();
  	}

  	function rezago_educativo_xmuni($idmunicipio){
  		$where="";
  		if($idmunicipio>0){
  			$where=" WHERE idmunicipio={$idmunicipio}";
        $query="SELECT idmunicipio,
  				  anio,
  				  p3A14_ptotal_m,
  				  p3A14_ptotal_h,
  				  p3A14_noa_m,
  				  p3A14_noa_h,
  				  p12A14ptotal_m,
  				  p12A14ptotal_h,
  				  p12A14noa_m,
  				  p12A14noa_h
  				FROM
  				  rezago_edu_xmuni
  				{$where}
          ORDER BY anio DESC
  				";
  		}
      else {
        $query="SELECT max(idmunicipio) as idmunicipio,
  				  max(anio) as anio,
  				  SUM(p3A14_ptotal_m) as p3A14_ptotal_m,
  				  SUM(p3A14_ptotal_h) as p3A14_ptotal_h,
  				  SUM(p3A14_noa_m) as p3A14_noa_m,
  				  SUM(p3A14_noa_h) as p3A14_noa_h,
  				  SUM(p12A14ptotal_m) as p12A14ptotal_m,
  				  SUM(p12A14ptotal_h) as p12A14ptotal_h,
  				  SUM(p12A14noa_m) as p12A14noa_m,
  				  SUM(p12A14noa_h) as p12A14noa_h
            				FROM
            				  rezago_edu_xmuni
          GROUP BY anio
          ORDER BY anio DESC
  				";
      }

		return $this->db->query($query)->result_array();
  	}

	function datos_escuela_grupos($cct,$ciclo) {

		if ($ciclo == trae_ciclo_actual()) {
		$str_query = "SELECT count(*) as total, concat(gp.grado,'°') as grado from grupo_prim gp
					  inner join centrocfg cfg on cfg.idcentrocfg = gp.idcentrocfg
					  inner join cct c on c.idct = cfg.idct
					  where c.cct = ? and gp.status = ? group by gp.grado;";
		return  $this->db->query($str_query,array($cct,'A'))->result_array();
		}else{
			return	array('total'=>0, 'grupo'=>'aún no hay historio');
		}
	}//datos_escuela_grupos

	function datos_escuela_alumnos($cct,$ciclo) {

		if ($ciclo == trae_ciclo_actual()) {
		$str_query = "SELECT count(*) as total, concat(gp.grado,'°') as grado from expediente_prim ep
					  inner join grupo_prim gp on ep.idgrupo = gp.idgrupo
					  inner join centrocfg cfg on cfg.idcentrocfg = gp.idcentrocfg
					  inner join cct c on c.idct = cfg.idct
					  where c.cct = ? and gp.status = ? group by gp.grado;";
		return  $this->db->query($str_query,array($cct,'A'))->result_array();
		}else{
			return	array('total'=>0, 'grupo'=>'aún no hay historio');
		}
	}//datos_escuela_alumnos

	function datos_escuela_docentes($cct,$ciclo) {

		if ($ciclo == trae_ciclo_actual()) {
		$str_query = "SELECT count(*) as total, concat(gp.grado,'-',gp.grupo) as grupo from personal pe
					  inner join grupo_prim gp on pe.idpersonal = gp.idpersonal_asesor
					  inner join centrocfg cfg on cfg.idcentrocfg = gp.idcentrocfg
					  inner join cct c on c.idct = cfg.idct
                      where c.cct = ? and gp.status = ? group by gp.grado;";
		return  $this->db->query($str_query,array($cct,'A'))->result_array();
		}else{
			return	array('total'=>0, 'grupo'=>'aún no hay historio');
		}
	}//datos_escuela_docentes


    function obtener_modalidad_xidnivel_zona($idnivel){
    	$str_query = "SELECT m.idmodalidad, m.descr AS nombre, m.estatus
		FROM estadistica_x_zona est
		INNER JOIN c_zona z ON est.zonaid = z.zonaid
		INNER JOIN cct ct ON ct.zonaid = z.zonaid
		INNER JOIN c_modalidad m ON m.idmodalidad = ct.idmodalidad
		WHERE ct.nivel = ? AND m.idmodalidad != 15
		GROUP BY m.idmodalidad";
		return $this->db->query($str_query,[$idnivel])->result_array();
    }

    function escuelas($idmunicipio,$idnivel,$idsostenimiento,$nombre_cct,$cct){
    	$where="";
    	$datos=['A'];
    	if($idmunicipio>0){
    		$where.=" AND m.idmunicipio= ? ";
    		array_push($datos, $idmunicipio);
    	}

    	if($idnivel>0){
    		$where.=" AND cfg.nivel= ?";
    		array_push($datos, $idnivel);
    	}

    	if($idsostenimiento!=0){
    		$where.= " AND ct.sostenimiento= ?";
    		array_push($datos, $idsostenimiento);
    	}
    	if($nombre_cct!=""){
    		$where.= " AND ct.nombre LIKE '%{$nombre_cct}%' ";

    	}
    	if($cct!=""){
    		$where.= " AND ct.cct= ?";
    		array_push($datos, $cct);
    	}

    	//falta agregar localidad
    	$query="SELECT ct.cct,
    			IF(cfg.turno='M','Matutino',
    			IF(cfg.turno='V','Vespertino',
    			IF(cfg.turno='N','Nocturno',
    			'Discontinuo'))) as turno,ct.nombre,cfg.nivel as idnivel,
    			n.descr as nivel,m.nombre as municipio,m.idmunicipio,
    				concat_ws(ct.entrecalle,' ',ct.ycalle,' ',ct.colonia) AS domicilio,
    			cfg.idcentrocfg,
          ct.nombre_direct_encargado
    			FROM cct ct
    			INNER JOIN centrocfg cfg ON cfg.idct=ct.idct
    			INNER JOIN municipio m ON m.idmunicipio=ct.idmunicipio
    			INNER JOIN niveleducativo n ON n.idnivel=cfg.nivel
    			WHERE ct.status = ?
    			{$where}
    			";

    	return $this->db->query($query,$datos)->result_array();
    }


      function obtener_nzona_xidnivelxidmodalidad_zona($idnivel,$idmodalidad){
      	$str_query = "SELECT
			z.zonaid, z.zona_escolar AS nombre, z.cct_supervisor
			FROM estadistica_x_zona est
			INNER JOIN c_zona z ON est.zonaid = z.zonaid
			INNER JOIN cct ct ON ct.zonaid = z.zonaid
			INNER JOIN c_modalidad m ON m.idmodalidad = ct.idmodalidad
			WHERE ct.nivel = ? AND m.idmodalidad = ? AND m.idmodalidad != 15
			GROUP BY z.zonaid";
		return $this->db->query($str_query,[$idnivel,$idmodalidad])->result_array();
      }


        function obtener_ciclo_xidnivelxidmodalidadxnzona_zona($idnivel,$idmodalidad,$numzona){
            $str_query = "SELECT
				c.idciclo, c.descr AS nombre, c.`status`
				FROM estadistica_x_zona est
				INNER JOIN c_zona z ON est.zonaid = z.zonaid
				INNER JOIN cct ct ON ct.zonaid = z.zonaid
				INNER JOIN c_modalidad m ON m.idmodalidad = ct.idmodalidad
				INNER JOIN ciclo c ON est.idciclo = c.idciclo
				WHERE ct.nivel = ?  AND m.idmodalidad = ? AND z.zonaid = ? AND m.idmodalidad != 15
				GROUP BY c.idciclo
        ORDER BY FIELD(c.descr,'2020-2021','2019-2020','2018-2019','2017-2018')";
            return $this->db->query($str_query,[$idnivel,$idmodalidad,$numzona])->result_array();
        }// obtener_nzona_xidnivelxidsost_zona()



        function obtener_estadistica_xzona($idnivel,$idmodalidad,$numzona,$idciclo){
              $str_query = "SELECT
                            n.descr as nivel, alumnos1,alumnos2,alumnos3,alumnos4,alumnos5,alumnos6,t_alumnos,
                            grupos1,grupos2,grupos3,grupos4,grupos5,grupos6,gruposmulti,t_grupos,
                            t_docentes,
                            n_escuelas,
                            t_alumnos_m,
                            t_alumnos_h,
                            t_direc_congrupo,
                            t_direc_singrupo
                            FROM estadistica_x_zona ez
                            INNER JOIN c_zona z ON ez.zonaid = z.zonaid
                            INNER JOIN niveleducativo n ON z.idnivel = n.idnivel
                            INNER JOIN cct ct ON ct.zonaid = z.zonaid
                            WHERE z.idnivel = ? AND ct.idmodalidad = ? AND ez.zonaid = ? AND ez.idciclo = ?
                            GROUP BY z.zonaid";

              return $this->db->query($str_query,[$idnivel,$idmodalidad,$numzona,$idciclo])->result_array();
          }// obtener_estadistica_xzona()

          function obtener_indicadores_xzona($idnivel,$idmodalidad,$numzona,$idciclo){
                $str_query = "SELECT
                              n.descr as nivel,cobertura,absorcion,retencion,
                              aprobacion,eficiencia_terminal, SUBSTRING(c.descr, 1, 4) AS ciclo,
                              c.descr as ciclo_esc
                              FROM indicadores_zona ez
                              INNER JOIN c_zona z ON ez.zonaid = z.zonaid
                              INNER JOIN niveleducativo n ON z.idnivel = n.idnivel
                              INNER JOIN cct ct ON ct.zonaid = z.zonaid
                              INNER JOIN ciclo c ON c.idciclo = ez.idciclo
                              WHERE z.idnivel = ? AND ct.idmodalidad = ? AND ez.zonaid = ?
                              GROUP BY z.zonaid
                              ORDER BY c.descr DESC";

                return $this->db->query($str_query,[$idnivel,$idmodalidad,$numzona])->result_array();
            }// obtener_indicadores_xzona()

            function obtener_indicadoresplanea_xzona($idnivel,$idmodalidad,$numzona,$idciclo){
                  $str_query = "SELECT
                                  n.descr as nivel, pz.periodo_planea,
                                  pz.ni_lyc,pz.nii_lyc,pz.niii_lyc,pz.niv_lyc,
                                  pz.ni_mat,pz.nii_mat,pz.niii_mat,pz.niv_mat
                                  FROM planea_nlogro_x_zona pz
                                  INNER JOIN c_zona z ON pz.zonaid = z.zonaid
                                  INNER JOIN niveleducativo n ON z.idnivel = n.idnivel
                                  INNER JOIN cct ct ON ct.zonaid = z.zonaid
                                  WHERE z.idnivel = ? AND ct.idmodalidad = ? AND pz.zonaid = ?
                                  GROUP BY pz.periodo_planea
                                  order by pz.periodo_planea desc ";

                  return $this->db->query($str_query,[$idnivel,$idmodalidad,$numzona])->result_array();
              }// obtener_indicadoresplanea_xzona()

			public function datos_escuela_ef_ret($cct,$ciclo)
			{
				if ($ciclo == trae_ciclo_actual()) {
					$str_query = "SELECT retencion, eficiencia_terminal from indicadores_x_idcentrocfg ind
					inner join centrocfg cfg on ind.idcentrocfg = cfg.idcentrocfg
					inner join cct c on cfg.idct = c.idct
								  where c.cct = ? ;";
					return  $this->db->query($str_query,array($cct))->result_array();
					}else{
						return	array('total'=>0, 'grupo'=>'aún no hay historio');
					}
			}//datos_escuela_ef

      public function trae_ciclos_est_muni() {
        $query="SELECT
                c.idciclo,c.descr as ciclo
                FROM estadistica_x_estado est
                INNER JOIN ciclo c ON est.idciclo = c.idciclo
                GROUP BY c.idciclo
                ORDER BY FIELD(c.descr,'2020-2021','2019-2020','2018-2019','2017-2018')";
          return  $this->db->query($query)->result_array();
			}//trae_ciclos_est_muni

      public function trae_ciclos_est_muni_param($id_municipio,$idnivel=0,$idsostenimiento=0,$idmodalidad=0) {
        $join = " ";
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
              $join .= " INNER JOIN niveleducativo n on est.idnivel = n.idnivel ";
            }
            if($idsostenimiento> 0){
              $where .= " AND s.idsostenimiento = {$idsostenimiento}";
              $join .= " INNER JOIN c_sostenimiento s ON est.idsostenimiento= s.idsostenimiento ";
            }
            if($idmodalidad>0){
              $where .= " AND m.idmodalidad = {$idmodalidad} AND m.idmodalidad != 15";
              $join .= " INNER JOIN c_modalidad m ON est.idmodalidad = m.idmodalidad ";
            }
        $query="SELECT
                c.idciclo,c.descr as ciclo
                FROM {$from} est
                INNER JOIN ciclo c ON est.idciclo = c.idciclo
                {$join}
                {$where}
                GROUP BY c.idciclo
                ORDER BY FIELD(c.descr,'2020-2021','2019-2020','2018-2019','2017-2018')";
          return  $this->db->query($query)->result_array();
			}//trae_ciclos_est_muni

      public function ciclo_escolar_estadist_xesc() {
        $query="SELECT
                	c.idciclo,c.descr as ciclo
                	FROM estadistica_x_idcentrocfg est
                	INNER JOIN ciclo c ON est.idciclo = c.idciclo
                	GROUP BY c.idciclo
                  ORDER BY FIELD(c.descr,'2020-2021','2019-2020','2018-2019','2017-2018')";
          return  $this->db->query($query)->result_array();
			}//ciclo_escolar_estadist_xesc

      public function turno_escolar_estadist_xesc() {
        $query="SELECT
              		t.idturno,t.descripcion as turno
              		FROM estadistica_x_idcentrocfg est
              		INNER JOIN centrocfg cfg ON est.idcentrocfg = cfg.idcentrocfg
              		INNER JOIN turno t ON cfg.turno = t.idturno
              		GROUP BY t.idturno";
          return  $this->db->query($query)->result_array();
			}//turno_escolar_estadist_xesc

      public function datos_estadistica_alumnosxgrado_xescuela($cct,$idturno,$idciclo) {
        $query="SELECT
            		est.alumnos1,est.alumnos2,est.alumnos3,est.alumnos4,est.alumnos5,est.alumnos6,est.t_alumnos
            		FROM estadistica_x_idcentrocfg est
            		INNER JOIN centrocfg cfg ON est.idcentrocfg = cfg.idcentrocfg
            		INNER JOIN turno t ON cfg.turno = t.idturno
            		INNER JOIN cct ct ON cfg.idct = ct.idct
            		WHERE ct.cct = '{$cct}' AND cfg.turno ='{$idturno}' AND est.idciclo = {$idciclo}";
          return  $this->db->query($query)->result_array();
			}//datos_estadistica_alumnosxgrado_xescuela

      public function datos_estadistica_gruposxgrado_xescuela($cct,$idturno,$idciclo) {
        $query="SELECT
            		est.grupos1,est.grupos2,est.grupos3,est.grupos4,est.grupos5,est.grupos6,est.gruposmulti, est.t_grupos
            		FROM estadistica_x_idcentrocfg est
            		INNER JOIN centrocfg cfg ON est.idcentrocfg = cfg.idcentrocfg
            		INNER JOIN turno t ON cfg.turno = t.idturno
            		INNER JOIN cct ct ON cfg.idct = ct.idct
            		WHERE ct.cct = '{$cct}' AND cfg.turno ='{$idturno}' AND est.idciclo = {$idciclo}";
          return  $this->db->query($query)->result_array();
			}//datos_estadistica_gruposxgrado_xescuela

      public function datos_estadistica_docentes_xescuela($cct,$idturno,$idciclo) {
        $query="SELECT
            		est.t_docentes
            		FROM estadistica_x_idcentrocfg est
            		INNER JOIN centrocfg cfg ON est.idcentrocfg = cfg.idcentrocfg
            		INNER JOIN turno t ON cfg.turno = t.idturno
            		INNER JOIN cct ct ON cfg.idct = ct.idct
            		WHERE ct.cct = '{$cct}' AND cfg.turno ='{$idturno}' AND est.idciclo = {$idciclo}";
          return  $this->db->query($query)->row('t_docentes');
			}//datos_estadistica_docentes_xescuela

      public function ciclo_ant_indicadores_xescuela($idciclo) {
        $query="SELECT idciclo FROM ciclo WHERE descr =
                (SELECT
                CONCAT((SUBSTRING(descr, 1, 4)-1),'-',(SUBSTRING(descr, 6, 4)-1)) AS ciloc_ant
                FROM ciclo WHERE idciclo = {$idciclo})";
          return  $this->db->query($query)->row('idciclo');
			}//ciclo_ant_indicadores_xescuela

      public function datos_indicadores_xescuela($cct,$idturno,$idciclo) {
        $query="SELECT
            		est.eficiencia_terminal, est.retencion, est.aprobacion
            		FROM indicadores_x_idcentrocfg est
            		INNER JOIN centrocfg cfg ON est.idcentrocfg = cfg.idcentrocfg
            		INNER JOIN turno t ON cfg.turno = t.idturno
            		INNER JOIN cct ct ON cfg.idct = ct.idct
            		WHERE ct.cct = '{$cct}' AND cfg.turno ='{$idturno}' AND est.idciclo = {$idciclo}";
          return  $this->db->query($query)->result_array();
			}//datos_indicadores_xescuela

      public function trae_nivel_zona() {
        $query="SELECT
                n.idnivel, n.descr as nombre, n.subfijo
                FROM estadistica_x_zona est
                INNER JOIN c_zona z ON est.zonaid = z.zonaid
                INNER JOIN niveleducativo n ON z.idnivel = n.idnivel
                GROUP BY n.idnivel
                order by FIELD(n.idnivel,6,8,1,2,3,4,5,7)";
          return  $this->db->query($query)->result_array();
			}//trae_nivel_zona

      function ciclos_indicadores_asistencia_xmunicipio($id_municipio){
    		$where="WHERE 1=1";
    		$tabla = " indicadores_x_estado ";
    		$inner = "INNER JOIN entidad e ON e.identidad=i.idestado";
   		if($id_municipio!=0){
   			$where.=" AND m.idmunicipio={$id_municipio}";
   			$tabla = " indicadores_x_muni ";
    			$inner = " INNER JOIN municipio m ON m.idmunicipio=i.idmunicipio ";
   		}
    		$query="SELECT c.idciclo,c.descr as ciclo
    			FROM {$tabla} as i
    			{$inner}
    			INNER JOIN niveleducativo n ON n.idnivel=i.idnivel
    			INNER JOIN ciclo c ON c.idciclo=i.idciclo
    			{$where}
          GROUP BY c.descr
          ORDER BY c.descr DESC
    		";

    		return $this->db->query($query)->result_array();
    	}

      function niveles_indicadores_asistencia_xmunicipio($id_municipio){
    		$where="WHERE 1=1";
    		$tabla = " indicadores_x_estado ";
    		$inner = "INNER JOIN entidad e ON e.identidad=i.idestado";
   		if($id_municipio!=0){
   			$where.=" AND m.idmunicipio={$id_municipio}";
   			$tabla = " indicadores_x_muni ";
    			$inner = " INNER JOIN municipio m ON m.idmunicipio=i.idmunicipio ";
   		}
    		$query="SELECT n.idnivel,n.descr as nivel
    			FROM {$tabla} as i
    			{$inner}
    			INNER JOIN niveleducativo n ON n.idnivel=i.idnivel
    			INNER JOIN ciclo c ON c.idciclo=i.idciclo
    			{$where}
          GROUP BY n.descr
          ORDER BY FIELD(n.descr,'PRIMARIA','SECUNDARIA ','MEDIA SUPERIOR','SUPERIOR')
    		";

    		return $this->db->query($query)->result_array();
    	}

      function ciclos_indicadores_permanencia_xmunicipio($id_municipio){
    		$where="WHERE 1=1";
    		$tabla = " indicadores_x_estado ";
    		$inner = "INNER JOIN entidad e ON e.identidad=i.idestado";
   		if($id_municipio!=0){
   			$where.=" AND m.idmunicipio={$id_municipio}";
   			$tabla = " indicadores_x_muni ";
    			$inner = " INNER JOIN municipio m ON m.idmunicipio=i.idmunicipio ";
   		}
    		$query="SELECT c.idciclo,c.descr as ciclo
    			FROM {$tabla} as i
    			{$inner}
    			INNER JOIN niveleducativo n ON n.idnivel=i.idnivel
    			INNER JOIN ciclo c ON c.idciclo=i.idciclo
    			{$where}
          GROUP BY c.descr
          ORDER BY c.descr DESC
    			";
    		return $this->db->query($query)->result_array();
    	}

function niveles_indicadores_permanencia_xmunicipio($id_municipio){
  $where="WHERE 1=1";
  $tabla = " indicadores_x_estado ";
  $inner = "INNER JOIN entidad e ON e.identidad=i.idestado";
if($id_municipio!=0){
  $where.=" AND m.idmunicipio={$id_municipio}";
  $tabla = " indicadores_x_muni ";
    $inner = " INNER JOIN municipio m ON m.idmunicipio=i.idmunicipio ";
}
  $query="SELECT n.idnivel,n.descr as nivel
    FROM {$tabla} as i
    {$inner}
    INNER JOIN niveleducativo n ON n.idnivel=i.idnivel
    INNER JOIN ciclo c ON c.idciclo=i.idciclo
    {$where}
    GROUP BY n.descr
    ORDER BY FIELD(n.descr,'PRIMARIA','SECUNDARIA ','MEDIA SUPERIOR','SUPERIOR')
    ";
  return $this->db->query($query)->result_array();
}

}//
