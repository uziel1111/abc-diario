<?php
class Estadistica_model extends CI_Model
{
 	function obtener_alumnos_xmunicipioxnivelxsosteniminientoxmodalidadxciclo($id_municipio,$id_nivel,$id_sostenimiento,$id_modalidad,$id_ciclo){
 		$where=" WHERE est.idciclo={$id_ciclo}";
 		if($id_municipio!=0){
 			$where.=" AND c.idmunicipio={$id_municipio}";
 		}

 		$query1="SELECT n.idnivel,n.descr AS nivel,'0' AS idsostenimiento,
 				'total' AS sostenimiento,'0' AS idmodalidad,
                'total' AS modalidad,
                '' AS alumn_m_t,
                '' AS alumn_h_t,
                '' AS alumn_t_t,
 				SUM(est.alumnos1) AS alumnos1,
 				SUM(est.alumnos2) AS alumnos2,
				SUM(est.alumnos3) AS alumnos3,
				SUM(est.alumnos4) AS alumnos4,
				SUM(est.alumnos5) AS alumnos5,
				SUM(est.alumnos6) AS alumnos6
				FROM estadistica_x_idcentrocfg est
				INNER JOIN centrocfg cfg ON cfg.idcentrocfg=est.idcentrocfg
				INNER JOIN cct c ON c.idct=cfg.idct
				INNER JOIN c_sostenimiento cs ON cs.idsostenimiento=c.sostenimiento
				INNER JOIN c_modalidad m ON m.descr=c.ssnivel
				INNER JOIN municipio mun ON mun.idmunicipio=c.idmunicipio
				INNER JOIN niveleducativo n ON n.idnivel=c.nivel
				{$where}
				GROUP BY cfg.nivel";
		$query2="SELECT n.idnivel,n.descr AS nivel,cs.idsostenimiento,
				cs.descr AS sostenimiento,'0' AS idmodalidad,
				'total' AS modalidad,
				'0' AS alumn_m_t,
                '0' AS alumn_h_t,
				'0' AS alumn_t_t,
				SUM(est.alumnos1) AS alumnos1,
				SUM(est.alumnos2) AS alumnos2,
				SUM(est.alumnos3) AS alumnos3,
				SUM(est.alumnos4) AS alumnos4,
				SUM(est.alumnos5) AS alumnos5,
				SUM(est.alumnos6) AS alumnos6
				FROM estadistica_x_idcentrocfg est
				INNER JOIN centrocfg cfg ON cfg.idcentrocfg=est.idcentrocfg
				INNER JOIN cct c ON c.idct=cfg.idct
				INNER JOIN c_sostenimiento cs ON cs.idsostenimiento=c.sostenimiento
				INNER JOIN c_modalidad m ON m.descr=c.ssnivel
				INNER JOIN municipio mun ON mun.idmunicipio=c.idmunicipio
				INNER JOIN niveleducativo n ON n.idnivel=c.nivel
				{$where}
				GROUP BY cfg.nivel,c.sostenimiento";
  		$query3="SELECT n.idnivel,n.descr AS nivel,cs.idsostenimiento,
  				cs.descr AS sostenimiento,m.idmodalidad,
  				m.descr AS modalidad,
  				'0' AS alumn_m_t,
                '0' AS alumn_h_t,
  				'0' AS alumn_t_t,
  				SUM(est.alumnos1) AS alumnos1,
  				SUM(est.alumnos2) AS alumnos2,
				SUM(est.alumnos3) AS alumnos3,
				SUM(est.alumnos4) AS alumnos4,
				SUM(est.alumnos5) AS alumnos5,
				SUM(est.alumnos6) AS alumnos6
				FROM estadistica_x_idcentrocfg est
				INNER JOIN centrocfg cfg ON cfg.idcentrocfg=est.idcentrocfg
				INNER JOIN cct c ON c.idct=cfg.idct
				INNER JOIN c_sostenimiento cs ON cs.idsostenimiento=c.sostenimiento
				INNER JOIN c_modalidad m ON m.descr=c.ssnivel
				INNER JOIN municipio mun ON mun.idmunicipio=c.idmunicipio
				INNER JOIN niveleducativo n ON n.idnivel=c.nivel
				{$where}
				GROUP BY cfg.nivel,c.sostenimiento,c.ssnivel
				ORDER BY  idnivel,idsostenimiento,idmodalidad";

  		return $this->db->query($query1 . ' UNION ALL ' . $query2. ' UNION ALL ' . $query3)->result_array();
  	}

  	function obtener_docentes_xmunicipioxnivelxsosteniminientoxmodalidadxciclo($id_municipio,$id_nivel,$id_sostenimiento,$id_modalidad,$id_ciclo){
 		$where=" WHERE est.idciclo={$id_ciclo}";
 		if($id_municipio!=0){
 			$where.=" AND c.idmunicipio={$id_municipio}";
 		}

 		$query1="SELECT n.idnivel,n.descr AS nivel,'0' AS idsostenimiento,
 				'total' AS sostenimiento,'0' AS idmodalidad,
                'total' AS modalidad,
 				'' AS docentes_m,
 				'' AS docentes_h,
				SUM(est.t_docentes) AS docentes_t_g,
				'' AS directivo_m_congrup,
				'' AS directivo_h_congrup,
				'' AS directivo_t_congrup,
				'' AS directivo_m_singrup,
				'' AS directivo_h_singrup,
				'' AS directivo_t_singrup
				FROM estadistica_x_idcentrocfg est
				INNER JOIN centrocfg cfg ON cfg.idcentrocfg=est.idcentrocfg
				INNER JOIN cct c ON c.idct=cfg.idct
				INNER JOIN c_sostenimiento cs ON cs.idsostenimiento=c.sostenimiento
				INNER JOIN c_modalidad m ON m.descr=c.ssnivel
				INNER JOIN municipio mun ON mun.idmunicipio=c.idmunicipio
				INNER JOIN niveleducativo n ON n.idnivel=c.nivel
				{$where}
				GROUP BY cfg.nivel";
		$query2="SELECT n.idnivel,n.descr AS nivel,cs.idsostenimiento,
				cs.descr AS sostenimiento,'0' AS idmodalidad,
				'total' AS modalidad,
 				'' AS docentes_m,
 				'' AS docentes_h,
				SUM(est.t_docentes) AS docentes_t_g,
				'' AS directivo_m_congrup,
				'' AS directivo_h_congrup,
				'' AS directivo_t_congrup,
				'' AS directivo_m_singrup,
				'' AS directivo_h_singrup,
				'' AS directivo_t_singrup
				FROM estadistica_x_idcentrocfg est
				INNER JOIN centrocfg cfg ON cfg.idcentrocfg=est.idcentrocfg
				INNER JOIN cct c ON c.idct=cfg.idct
				INNER JOIN c_sostenimiento cs ON cs.idsostenimiento=c.sostenimiento
				INNER JOIN c_modalidad m ON m.descr=c.ssnivel
				INNER JOIN municipio mun ON mun.idmunicipio=c.idmunicipio
				INNER JOIN niveleducativo n ON n.idnivel=c.nivel
				{$where}
				GROUP BY c.nivel,c.sostenimiento";
  		$query3="SELECT n.idnivel,n.descr AS nivel,cs.idsostenimiento,
  				cs.descr AS sostenimiento,m.idmodalidad,
  				m.descr AS modalidad,
 				'' AS docentes_m,
 				'' AS docentes_h,
				SUM(est.t_docentes) AS docentes_t_g,
				'' AS directivo_m_congrup,
				'' AS directivo_h_congrup,
				'' AS directivo_t_congrup,
				'' AS directivo_m_singrup,
				'' AS directivo_h_singrup,
				'' AS directivo_t_singrup
				FROM estadistica_x_idcentrocfg est
				INNER JOIN centrocfg cfg ON cfg.idcentrocfg=est.idcentrocfg
				INNER JOIN cct c ON c.idct=cfg.idct
				INNER JOIN c_sostenimiento cs ON cs.idsostenimiento=c.sostenimiento
				INNER JOIN c_modalidad m ON m.descr=c.ssnivel
				INNER JOIN municipio mun ON mun.idmunicipio=c.idmunicipio
				INNER JOIN niveleducativo n ON n.idnivel=c.nivel
				{$where}
				GROUP BY cfg.nivel,c.sostenimiento,c.ssnivel
				ORDER BY  idnivel,idsostenimiento,idmodalidad";
				// echo $query1 . ' UNION ALL ' . $query2. ' UNION ALL ' . $query3; die();
  		return $this->db->query($query1 . ' UNION ALL ' . $query2. ' UNION ALL ' . $query3)->result_array();
  	}

  	function obtener_infraestructura_xmunicipioxnivelxsosteniminientoxmodalidadxciclo($id_municipio,$id_nivel,$id_sostenimiento,$id_modalidad,$id_ciclo){
 		$where=" WHERE est.idciclo={$id_ciclo}";
 		if($id_municipio!=0){
 			$where.=" AND c.idmunicipio={$id_municipio}";
 		}

 		$query1="SELECT n.idnivel,n.descr AS nivel,'0' AS idsostenimiento,
 				'total' AS sostenimiento,'0' AS idmodalidad,
                'total' AS modalidad,
                count(est.idcentrocfg)AS nescuelas,
				SUM(est.grupos1) AS grupos_1,
				SUM(est.grupos2) AS grupos_2,
				SUM(est.grupos3) AS grupos_3,
				SUM(est.grupos4) AS grupos_4,
				SUM(est.grupos5) AS grupos_5,
				SUM(est.grupos6) AS grupos_6,
				SUM(est.gruposmulti) AS grupos_multi,
				SUM(t_grupos) AS grupos_t
				FROM estadistica_x_idcentrocfg est
				INNER JOIN centrocfg cfg ON cfg.idcentrocfg=est.idcentrocfg
				INNER JOIN cct c ON c.idct=cfg.idct
				INNER JOIN c_sostenimiento cs ON cs.idsostenimiento=c.sostenimiento
				INNER JOIN c_modalidad m ON m.descr=c.ssnivel
				INNER JOIN municipio mun ON mun.idmunicipio=c.idmunicipio
				INNER JOIN niveleducativo n ON n.idnivel=c.nivel
				{$where}
				GROUP BY cfg.nivel";
		$query2="SELECT n.idnivel,n.descr AS nivel,cs.idsostenimiento,
				cs.descr AS sostenimiento,'0' AS idmodalidad,
				'total' AS modalidad,
				count(est.idcentrocfg)AS nescuelas,
				SUM(est.grupos1) AS grupos_1,
				SUM(est.grupos2) AS grupos_2,
				SUM(est.grupos3) AS grupos_3,
				SUM(est.grupos4) AS grupos_4,
				SUM(est.grupos5) AS grupos_5,
				SUM(est.grupos6) AS grupos_6,
				SUM(est.gruposmulti) AS grupos_multi,
				SUM(t_grupos) AS grupos_t
				FROM estadistica_x_idcentrocfg est
				INNER JOIN centrocfg cfg ON cfg.idcentrocfg=est.idcentrocfg
				INNER JOIN cct c ON c.idct=cfg.idct
				INNER JOIN c_sostenimiento cs ON cs.idsostenimiento=c.sostenimiento
				INNER JOIN c_modalidad m ON m.descr=c.ssnivel
				INNER JOIN municipio mun ON mun.idmunicipio=c.idmunicipio
				INNER JOIN niveleducativo n ON n.idnivel=c.nivel
				{$where}
				GROUP BY cfg.nivel,c.sostenimiento";
  		$query3="SELECT n.idnivel,n.descr AS nivel,cs.idsostenimiento,
  				cs.descr AS sostenimiento,m.idmodalidad,
  				m.descr AS modalidad,
  				count(est.idcentrocfg)AS nescuelas,
				SUM(est.grupos1) AS grupos_1,
				SUM(est.grupos2) AS grupos_2,
				SUM(est.grupos3) AS grupos_3,
				SUM(est.grupos4) AS grupos_4,
				SUM(est.grupos5) AS grupos_5,
				SUM(est.grupos6) AS grupos_6,
				SUM(est.gruposmulti) AS grupos_multi,
				SUM(t_grupos) AS grupos_t
				FROM estadistica_x_idcentrocfg est
				INNER JOIN centrocfg cfg ON cfg.idcentrocfg=est.idcentrocfg
				INNER JOIN cct c ON c.idct=cfg.idct
				INNER JOIN c_sostenimiento cs ON cs.idsostenimiento=c.sostenimiento
				INNER JOIN c_modalidad m ON m.descr=c.ssnivel
				INNER JOIN municipio mun ON mun.idmunicipio=c.idmunicipio
				INNER JOIN niveleducativo n ON n.idnivel=c.nivel
				{$where}
				GROUP BY cfg.nivel,c.sostenimiento,c.ssnivel
				ORDER BY  idnivel,idsostenimiento,idmodalidad";
  		return $this->db->query($query1 . ' UNION ALL ' . $query2. ' UNION ALL ' . $query3)->result_array();
  	}

  	function indicadores_asistencia_xmunicipio($id_municipio){
  		$where="";
 		if($id_municipio!=0){
 			$where.=" where m.idmunicipio={$id_municipio}";
 		}
  		$query="SELECT i.idmunicipio,m.nombre as muninicipio,i.idnivel,n.descr as nivel,i.idciclo,c.descr as ciclo,i.cobertura,i.absorcion
  			FROM indicadores_x_muni as i
  			INNER JOIN municipio m ON m.idmunicipio=i.idmunicipio
  			INNER JOIN niveleducativo n ON n.idnivel=i.idnivel
  			INNER JOIN ciclo c ON c.idciclo=i.idciclo
  			{$where}
  		";
  		return $this->db->query($query)->result_array();
  	}

  	function indicadores_permanencia_xmunicipio($id_municipio){
  		$where="";
 		if($id_municipio!=0){
 			$where.=" where m.idmunicipio={$id_municipio}";
 		}
  		$query="SELECT i.idmunicipio,m.nombre as muninicipio,i.idnivel,n.descr as nivel,i.idciclo,c.descr as ciclo,i.retencion,i.aprobacion,i.eficiencia_terminal
  			FROM indicadores_x_muni as i
  			INNER JOIN municipio m ON m.idmunicipio=i.idmunicipio
  			INNER JOIN niveleducativo n ON n.idnivel=i.idnivel
  			INNER JOIN ciclo c ON c.idciclo=i.idciclo
  			{$where}
  			";
  		return $this->db->query($query)->result_array();
  	}

  	function indicadores_aprendizaje_xmunicipio($id_municipio){
  		$where="";
 		if($id_municipio!=0){
 			$where.=" where m.idmunicipio={$id_municipio}";
 		}
  		$query="SELECT p.idmunicipio,m.nombre as muninicipio,p.idnivel,n.descr as nivel,
  				p.ni_lyc,p.nii_lyc,p.niii_lyc,p.niv_lyc,p.ni_mat,p.nii_mat,p.niii_mat,
  				p.niv_mat
  			FROM planea_nlogro_x_muni as p
  			INNER JOIN municipio m ON m.idmunicipio=p.idmunicipio
  			INNER JOIN niveleducativo n ON n.idnivel=p.idnivel
  			{$where}
  			";
  		return $this->db->query($query)->result_array();
  	}

  	function analfabetismo_xmuni($idmunicipio){
  		$where="";
  		if($idmunicipio>0){
  			$where="WHERE idmunicipio={$idmunicipio}";
  		}
  		$query="SELECT * FROM analfabetismo_xmuni
  			{$where}
  		";
  		return $this->db->query($query)->result_array();
  	}

  	function rezago_educativo_xmuni($idmunicipio){
  		$where="";
  		if($idmunicipio>0){
  			$where=" WHERE idmunicipio={$idmunicipio}";
  		}
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
				";
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


  function obtener_sostenimiento_xidnivel_zona($idnivel){

        $str_query = "SELECT
                        s.idsostenimiento, s.descr as nombre, s.estatus
                        FROM cct ct
                        INNER JOIN centrocfg cfg ON ct.idct =cfg.idct
                        INNER JOIN niveleducativo n ON cfg.nivel = n.idnivel
                        INNER JOIN c_sostenimiento s ON ct.sostenimiento = s.idsostenimiento
                        LEFT JOIN c_zona z on ct.zonaid = z.zonaid
                        WHERE n.idnivel = ?
                        GROUP BY s.idsostenimiento";

        return $this->db->query($str_query,[$idnivel])->result_array();
    }// obtener_sostenimiento_xidnivel_zona()

    function escuelas($idmunicipio,$idnivel,$idsostenimiento,$nombre_cct,$cct){
    	$where="";
    	$datos=['ACT'];
    	if($idmunicipio>0){
    		$where.=" AND m.idmunicipio= ? ";
    		array_push($datos, $idmunicipio);
    	}

    	if($idnivel>0){
    		$where.=" AND cfg.nivel= ?";
    		array_push($datos, $idnivel);
    	}

    	if($idsostenimiento!=-1){
    		$where.= " AND ct.sostenimiento= ?";
    		array_push($datos, $idsostenimiento);
    	}
    	if($nombre_cct!=""){
    		$where.= " AND ct.nombre= ?";
    		array_push($datos, $nombre_cct);
    	}
    	if($cct!=""){
    		$where.= " AND ct.cct= ?";
    		array_push($datos, $cct);
    	}
    	// consola($datos);
    	//falta agregar localidad
    	$query="SELECT ct.cct,
    			IF(cfg.turno='M','Matutino',
    			IF(cfg.turno='V','Vespertino',
    			IF(cfg.turno='N','Nocturno',
    			'Discontinuo'))) as turno,ct.nombre,cfg.nivel as idnivel,
    			n.descr as nivel,m.nombre as municipio,m.idmunicipio,
    				concat_ws(ct.entrecalle,' ',ct.ycalle,' ',ct.colonia) AS domicilio,
    			cfg.idcentrocfg
    			FROM cct ct
    			INNER JOIN centrocfg cfg ON cfg.idct=ct.idct
    			INNER JOIN municipio m ON m.idmunicipio=ct.idmunicipio
    			INNER JOIN niveleducativo n ON n.idnivel=cfg.nivel
    			WHERE ct.status = ?
    			{$where}
    			";
    	return $this->db->query($query,$datos)->result_array();
    }

    function obtener_nzona_xidnivelxidsost_zona($idnivel,$idsostenimieto){

          $str_query = "SELECT
                        z.zonaid, z.zona_escolar as nombre, z.cct_supervisor
                        FROM cct ct
                        INNER JOIN centrocfg cfg ON ct.idct =cfg.idct
                        INNER JOIN niveleducativo n ON cfg.nivel = n.idnivel
                        INNER JOIN c_sostenimiento s ON ct.sostenimiento = s.idsostenimiento
                        LEFT JOIN c_zona z on ct.zonaid = z.zonaid
                        WHERE n.idnivel = ? AND s.idsostenimiento = ?
                        GROUP BY z.zonaid";

          return $this->db->query($str_query,[$idnivel,$idsostenimieto])->result_array();
      }// obtener_nzona_xidnivelxidsost_zona()

      function obtener_ciclo_xidnivelxidsostxnzona_zona($idnivel,$idsostenimieto,$numzona){

            $str_query = "SELECT
                          c.idciclo, c.descr as nombre, c.`status`
                          FROM cct ct
                          INNER JOIN centrocfg cfg ON ct.idct =cfg.idct
                          INNER JOIN niveleducativo n ON cfg.nivel = n.idnivel
                          INNER JOIN c_sostenimiento s ON ct.sostenimiento = s.idsostenimiento

                          LEFT JOIN c_zona z on ct.zonaid = z.zonaid
                          INNER JOIN estadistica_x_zona ez ON z.zonaid = ez.zonaid
                          INNER JOIN ciclo c ON ez.idciclo = c.idciclo
                          WHERE n.idnivel = ? AND s.idsostenimiento = ? AND z.zonaid = ?
                          GROUP BY c.idciclo";

            return $this->db->query($str_query,[$idnivel,$idsostenimieto,$numzona])->result_array();
        }// obtener_nzona_xidnivelxidsost_zona()



        function obtener_estadistica_xzona($idnivel,$idsostenimieto,$numzona,$idciclo){
              $str_query = "SELECT
                            alumnos1,alumnos2,alumnos3,alumnos4,alumnos5,alumnos6,t_alumnos,
                            grupos1,grupos2,grupos3,grupos4,grupos5,grupos6,gruposmulti,t_grupos,
                            t_docentes,
                            n_escuelas
                            FROM estadistica_x_zona ez
                            INNER JOIN c_zona z ON ez.zonaid = z.zonaid
                            WHERE z.idnivel = ? AND z.idsostenimiento = ? AND ez.zonaid = ? AND ez.idciclo = ? ";

              return $this->db->query($str_query,[$idnivel,$idsostenimieto,$numzona,$idciclo])->result_array();
          }// obtener_estadistica_xzona()

          function obtener_indicadores_xzona($idnivel,$idsostenimieto,$numzona,$idciclo){
                $str_query = "SELECT
                              cobertura,absorcion,retencion,
                              aprobacion,eficiencia_terminal
                              FROM indicadores_zona ez
                              INNER JOIN c_zona z ON ez.zonaid = z.zonaid
                              WHERE z.idnivel = ? AND z.idsostenimiento = ? AND ez.zonaid = ? AND ez.idciclo = ? ";

                return $this->db->query($str_query,[$idnivel,$idsostenimieto,$numzona,$idciclo])->result_array();
            }// obtener_indicadores_xzona()

            function obtener_indicadoresplanea_xzona($idnivel,$idsostenimieto,$numzona,$idciclo){
                  $str_query = "SELECT
                                  pz.periodo_planea,
                                  pz.ni_lyc,pz.nii_lyc,pz.niii_lyc,pz.niv_lyc,
                                  pz.ni_mat,pz.nii_mat,pz.niii_mat,pz.niv_mat
                                  FROM planea_nlogro_x_zona pz
                                  INNER JOIN c_zona z ON pz.zonaid = z.zonaid
                                  WHERE z.idnivel = ? AND z.idsostenimiento = ? AND pz.zonaid = ? AND pz.periodo_planea = ? ";

                  return $this->db->query($str_query,[$idnivel,$idsostenimieto,$numzona,$idciclo])->result_array();
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
                GROUP BY c.idciclo";
          return  $this->db->query($query)->result_array();
			}//trae_ciclos_est_muni

      public function trae_ciclos_est_muni_param($id_municipio,$idnivel=0,$idsostenimiento=-1,$idmodalidad=0) {
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
            if($idsostenimiento> -1){
              $where .= " AND s.idsostenimiento = {$idsostenimiento}";
              $join .= " INNER JOIN c_sostenimiento s ON est.idsostenimiento= s.idsostenimiento ";
            }
            if($idmodalidad>0){
              $where .= " AND m.idmodalidad = {$idmodalidad}";
              $join .= " INNER JOIN c_modalidad m ON est.idmodalidad = m.idmodalidad ";
            }
        $query="SELECT
                c.idciclo,c.descr as ciclo
                FROM {$from} est
                INNER JOIN ciclo c ON est.idciclo = c.idciclo
                {$join}
                {$where}
                GROUP BY c.idciclo";
          return  $this->db->query($query)->result_array();
			}//trae_ciclos_est_muni

}//
