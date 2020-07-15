<?php
class Planea_model extends CI_Model
{


  function obtener_nivel_xidmunicipio($id_municipio){
    if($id_municipio>0){
          $where = "AND ct.idmunicipio = {$id_municipio}";
        }
        else{
          $where = ' ';
        }
        $str_query = "SELECT
                      n.idnivel, n.descr as nombre, n.subfijo
                      FROM cct ct
                      INNER JOIN centrocfg  cfg ON ct.idct= cfg.idct
                      INNER JOIN planeaxidcentrocfg_reactivo pr ON cfg.idcentrocfg =pr.idcentrocfg
                      INNER JOIN niveleducativo n on cfg.nivel = n.idnivel
                      WHERE ct.`status`='A' AND cfg.`status`='A'
                      {$where}
                      GROUP BY n.idnivel";

        return $this->db->query($str_query)->result_array();
    }// obtener_nivel_xidmunicipio()
    function obtener_perido_xidmunicipio_xidnivel($id_municipio,$idnivel){
      $where = ' ';
      if($id_municipio>0){
            $where .= " AND ct.idmunicipio = {$id_municipio}";
          }
      if($idnivel>0){
            $where .= " AND n.idnivel = {$idnivel}";
          }
          $str_query = "SELECT
                        pp.id_periodo, pp.periodo
                        FROM cct ct
                        INNER JOIN centrocfg  cfg ON ct.idct= cfg.idct
                        INNER JOIN niveleducativo n on cfg.nivel = n.idnivel
                        INNER JOIN planeaxidcentrocfg_reactivo pr ON cfg.idcentrocfg = pr.idcentrocfg
												INNER JOIN periodoplanea pp ON pr.id_periodo = pp.id_periodo
                        WHERE ct.`status`='A' AND cfg.`status`='A'
                        {$where}
                        GROUP BY pp.id_periodo";
        // echo $str_query; die();
          return $this->db->query($str_query)->result_array();
      }// obtener_perido_xidmunicipio_xidnivel()

      function estadisticas_x_estadomunicipio($municipio, $nivel, $periodo, $idcampodis){
            $where = "";
            if($municipio != 0 ){
              $where = " AND e.idmunicipio = {$municipio}";
            }
            $str_query = "SELECT
                          id_contenido,
                          contenidos,
                          reactivos,
                          total_reac_xct,
                          total,
                          alumnos_evaluados,
                          ROUND((total* 100)/(total_reac_xct * alumnos_evaluados), 1)AS porcen_alum_respok
                          FROM (
                          			SELECT
                          			*,
                          			SUM(n_aciertos) AS total,
                          			SUM(n_almn_eval) AS alumnos_evaluados
                          			FROM (
                          						SELECT
                          						t3.id_contenido,
                          						t3.`contenido` AS contenidos,
                          						GROUP_CONCAT(DISTINCT t2.n_reactivo) AS reactivos,
                          						COUNT(DISTINCT t2.n_reactivo) AS total_reac_xct,
                          						t1.n_aciertos,
                          						t1.n_almn_eval
                          						FROM cct e
                          						INNER JOIN centrocfg cfg ON e.idct =cfg.idct
                          						INNER JOIN planeaxidcentrocfg_reactivo t1 ON cfg.idcentrocfg = t1.idcentrocfg
                          						INNER JOIN periodoplanea pp ON t1.id_periodo = pp.id_periodo
                          						INNER JOIN planea_reactivo t2 ON t1.id_reactivo=t2.id_reactivo
                          						INNER JOIN planea_contenido t3 ON t2.id_contenido= t3.id_contenido
                          						INNER JOIN planea_unidad_analisis t4 ON t3.id_unidad_analisis=t4.id_unidad_analisis
                          						INNER JOIN planea_camposdisciplinares t5 ON t4.id_campodisiplinario=t5.id_campodisiplinario
                          						WHERE cfg.nivel = {$nivel} AND pp.id_periodo = {$periodo}
                          						AND t5.id_campodisiplinario = {$idcampodis} {$where}
                                      GROUP BY t3.id_contenido, cfg.idcentrocfg) AS datos
                        			GROUP BY id_contenido
                        		) AS datos2";
          return $this->db->query($str_query)->result_array();
        }

        function obtener_periodoplane_xidperiodo($idperiodo){
          $str_query = "SELECT
                        pp.id_periodo, max(pp.periodo) as periodo
                        FROM cct ct
                        INNER JOIN centrocfg  cfg ON ct.idct= cfg.idct
                        INNER JOIN niveleducativo n on cfg.nivel = n.idnivel
                        INNER JOIN planeaxidcentrocfg_reactivo pr ON cfg.idcentrocfg = pr.idcentrocfg
                        INNER JOIN periodoplanea pp ON pr.id_periodo = pp.id_periodo
                        WHERE ct.`status`='A' AND cfg.`status`='A'
                        AND pp.id_periodo = {$idperiodo}
                        GROUP BY pp.id_periodo";

          return $this->db->query($str_query)->row('periodo');
        }

        function obtener_periodoplane_xidperiodo_info($cct, $turno){
          $str_query = "SELECT
                      	pp.id_periodo, pp.periodo as periodo
                      	FROM cct ct
                      	INNER JOIN centrocfg  cfg ON ct.idct= cfg.idct
                      	INNER JOIN planeaxidcentrocfg_reactivo pr ON cfg.idcentrocfg = pr.idcentrocfg
                      	INNER JOIN periodoplanea pp ON pr.id_periodo = pp.id_periodo
                      	WHERE  ct.cct='{$cct}' AND cfg.turno='{$turno}'
                      	GROUP BY pp.id_periodo
                      	ORDER BY pp.periodo DESC";

          return $this->db->query($str_query)->result_array();
        }
        function obtener_reactivos_xcont_municipio($id_contenido){
          $str_query = "SELECT
                        ct.id_contenido, ct.contenido, ct.idnivel,
                        cd.campodisiplinario,
                        r.id_reactivo, r.n_reactivo,
                        r.url_reactivo,
                        r.url_apoyo,
                        r.url_argumentacion,
                        r.url_especificacion
                        FROM planea_contenido ct
                        INNER JOIN planea_unidad_analisis ua ON ct.id_unidad_analisis = ua.id_unidad_analisis
                        INNER JOIN planea_camposdisciplinares cd ON ua.id_campodisiplinario = cd.id_campodisiplinario
                        INNER JOIN planea_reactivo r ON ct.id_contenido = r.id_contenido
                        WHERE ct.id_contenido= ? ";

          return $this->db->query($str_query,[$id_contenido])->result_array();
        }


        // function estadisticas_x_estadozona($zona, $sostenimiento, $nivel, $periodo, $campodisip)
        // {
        //      $where = "";
        //      $array = array($nivel, $periodo, $campodisip);
        //      /*if($sostenimiento != 0 ){
        //         $where.= " AND e.sostenimiento = ?";
        //         array_push($array,$sostenimiento);
        //         if($zona != 0 ){
        //           $where = " AND e.zona = ?";
        //           array_push($array,$zona);
        //         }
        //       }*/

        //       if($zona != 0 ){
        //           $where = " AND e.zonact = ?";
        //           array_push($array,$zona);
        //         }

        //     $str_query = "SELECT
        //                   id_contenido,
        //                   contenidos,
        //                   reactivos,
        //                   total_reac_xct,
        //                   total,
        //                   alumnos_evaluados,
        //                   ROUND((total* 100)/(total_reac_xct * alumnos_evaluados), 1)AS porcen_alum_respok
        //                   FROM (
        //                         SELECT
        //                         *,
        //                         SUM(n_aciertos) AS total,
        //                         SUM(n_almn_eval) AS alumnos_evaluados
        //                         FROM (
        //                               SELECT
        //                               t3.id_contenido,
        //                               t3.`contenido` AS contenidos,
        //                               GROUP_CONCAT(DISTINCT t2.n_reactivo) AS reactivos,
        //                               COUNT(DISTINCT t2.n_reactivo) AS total_reac_xct,
        //                               t1.n_aciertos,
        //                               t1.n_almn_eval
        //                               FROM cct e
        //                               INNER JOIN centrocfg cfg ON e.idct =cfg.idct
        //                               INNER JOIN planeaxidcentrocfg_reactivo t1 ON cfg.idcentrocfg = t1.idcentrocfg
        //                               INNER JOIN periodoplanea pp ON t1.id_periodo = pp.id_periodo
        //                               INNER JOIN planea_reactivo t2 ON t1.id_reactivo=t2.id_reactivo
        //                               INNER JOIN planea_contenido t3 ON t2.id_contenido= t3.id_contenido
        //                               INNER JOIN planea_unidad_analisis t4 ON t3.id_unidad_analisis=t4.id_unidad_analisis
        //                               INNER JOIN planea_camposdisciplinares t5 ON t4.id_campodisiplinario=t5.id_campodisiplinario
        //                               WHERE cfg.nivel = ? AND pp.id_periodo = ?
        //                               AND t5.id_campodisiplinario = ? {$where}
        //                               GROUP BY t3.id_contenido, cfg.idcentrocfg) AS datos
        //                       GROUP BY id_contenido
        //                     ) AS datos2";
        //   return $this->db->query($str_query,$array)->result_array();
        // }//estadisticas_x_estadozona
        //
        function estadisticas_x_estadozona($zona, $modalidad, $nivel, $periodo, $campodisip)
        {
             $where = "";
             $array = array($nivel, $periodo, $modalidad, $campodisip);
              if($zona != 0 ){
                  $where = " AND e.zonact = ?";
                  array_push($array,$zona);
                }

            $str_query = "SELECT
                          id_contenido,
                          contenidos,
                          reactivos,
                          total_reac_xct,
                          total,
                          alumnos_evaluados,
                          ROUND((total* 100)/(total_reac_xct * alumnos_evaluados), 1)AS porcen_alum_respok
                          FROM (
                                SELECT
                                *,
                                SUM(n_aciertos) AS total,
                                SUM(n_almn_eval) AS alumnos_evaluados
                                FROM (
                                      SELECT
                                      t3.id_contenido,
                                      t3.`contenido` AS contenidos,
                                      GROUP_CONCAT(DISTINCT t2.n_reactivo) AS reactivos,
                                      COUNT(DISTINCT t2.n_reactivo) AS total_reac_xct,
                                      t1.n_aciertos,
                                      t1.n_almn_eval
                                      FROM cct e
                                      INNER JOIN centrocfg cfg ON e.idct =cfg.idct
                                      INNER JOIN planeaxidcentrocfg_reactivo t1 ON cfg.idcentrocfg = t1.idcentrocfg
                                      INNER JOIN periodoplanea pp ON t1.id_periodo = pp.id_periodo
                                      INNER JOIN planea_reactivo t2 ON t1.id_reactivo=t2.id_reactivo
                                      INNER JOIN planea_contenido t3 ON t2.id_contenido= t3.id_contenido
                                      INNER JOIN planea_unidad_analisis t4 ON t3.id_unidad_analisis=t4.id_unidad_analisis
                                      INNER JOIN planea_camposdisciplinares t5 ON t4.id_campodisiplinario=t5.id_campodisiplinario
                                      INNER JOIN c_modalidad m ON m.idmodalidad = e.idmodalidad
                                      WHERE cfg.nivel = ? AND pp.id_periodo = ? AND m.idmodalidad = ?
                                      AND t5.id_campodisiplinario = ? {$where}
                                      GROUP BY t3.id_contenido, cfg.idcentrocfg) AS datos
                              GROUP BY id_contenido
                            ) AS datos2";
          return $this->db->query($str_query,$array)->result_array();
        }//estadisticas_x_estadozona

        function planea_logro_escuela($idcfg)
        {
          $query = "SELECT * from planea_nlogro_x_idcentrocfg where idcentrocfg = ?";
          return $this->db->query($query,array($idcfg))->result_array();
        }

        function estadisticas_x_cct($cct, $turno, $periodo, $idcampodis){
            $str_query = "SELECT
                          id_contenido,
                          contenidos,
                          reactivos,
                          total_reac_xct,
                          total,
                          alumnos_evaluados,
                          ROUND((total* 100)/(total_reac_xct * alumnos_evaluados), 1)AS porcen_alum_respok
                          FROM (
                                SELECT
                                *,
                                SUM(n_aciertos) AS total,
                                SUM(n_almn_eval) AS alumnos_evaluados
                                FROM (
                                      SELECT
                                      MAX(pp.periodo) as periodo,
                                      t3.id_contenido,
                                      t3.`contenido` AS contenidos,
                                      GROUP_CONCAT(DISTINCT t2.n_reactivo) AS reactivos,
                                      COUNT(DISTINCT t2.n_reactivo) AS total_reac_xct,
                                      t1.n_aciertos,
                                      t1.n_almn_eval
                                      FROM cct e
                                      INNER JOIN centrocfg cfg ON e.idct =cfg.idct
                                      INNER JOIN planeaxidcentrocfg_reactivo t1 ON cfg.idcentrocfg = t1.idcentrocfg
                                      INNER JOIN periodoplanea pp ON t1.id_periodo = pp.id_periodo
                                      INNER JOIN planea_reactivo t2 ON t1.id_reactivo=t2.id_reactivo
                                      INNER JOIN planea_contenido t3 ON t2.id_contenido= t3.id_contenido
                                      INNER JOIN planea_unidad_analisis t4 ON t3.id_unidad_analisis=t4.id_unidad_analisis
                                      INNER JOIN planea_camposdisciplinares t5 ON t4.id_campodisiplinario=t5.id_campodisiplinario
                                      WHERE e.cct ='{$cct}' AND cfg.turno = '{$turno}' AND pp.id_periodo = {$periodo}
                                      AND t5.id_campodisiplinario = {$idcampodis}
                                      GROUP BY t3.id_contenido, cfg.idcentrocfg) AS datos
                              GROUP BY id_contenido
                            ) AS datos2";
                            // echo $str_query; die();
          return $this->db->query($str_query)->result_array();
        }

        function estadisticas_x_cct_info($cct, $turno, $idcampodis){
            $str_query = "SELECT
                          id_contenido,
                          contenidos,
                          reactivos,
                          total_reac_xct,
                          total,
                          alumnos_evaluados,
                          ROUND((total* 100)/(total_reac_xct * alumnos_evaluados), 1)AS porcen_alum_respok
                          FROM (
                                SELECT
                                *,
                                SUM(n_aciertos) AS total,
                                SUM(n_almn_eval) AS alumnos_evaluados
                                FROM (
                                      SELECT
                                      MAX(pp.periodo) as periodo,
                                      t3.id_contenido,
                                      t3.`contenido` AS contenidos,
                                      GROUP_CONCAT(DISTINCT t2.n_reactivo) AS reactivos,
                                      COUNT(DISTINCT t2.n_reactivo) AS total_reac_xct,
                                      t1.n_aciertos,
                                      t1.n_almn_eval
                                      FROM cct e
                                      INNER JOIN centrocfg cfg ON e.idct =cfg.idct
                                      INNER JOIN planeaxidcentrocfg_reactivo t1 ON cfg.idcentrocfg = t1.idcentrocfg
                                      INNER JOIN periodoplanea pp ON t1.id_periodo = pp.id_periodo
                                      INNER JOIN planea_reactivo t2 ON t1.id_reactivo=t2.id_reactivo
                                      INNER JOIN planea_contenido t3 ON t2.id_contenido= t3.id_contenido
                                      INNER JOIN planea_unidad_analisis t4 ON t3.id_unidad_analisis=t4.id_unidad_analisis
                                      INNER JOIN planea_camposdisciplinares t5 ON t4.id_campodisiplinario=t5.id_campodisiplinario
                                      WHERE e.cct ='{$cct}' AND cfg.turno = '{$turno}'
                                      AND t5.id_campodisiplinario = {$idcampodis}
                                      GROUP BY t3.id_contenido, cfg.idcentrocfg) AS datos
                              GROUP BY id_contenido
                            ) AS datos2";
                            // echo $str_query; die();
          return $this->db->query($str_query)->result_array();
        }

        function niveles_de_logro_idcentrocfg($cct, $turno){
          $str_query = "SELECT
            pcfg.periodo_planea AS periodo,
            pcfg.ni_lyc,
            pcfg.nii_lyc,
            pcfg.niii_lyc,
            pcfg.niv_lyc,
            pcfg.ni_mat,
            pcfg.nii_mat,
            pcfg.niii_mat,
            pcfg.niv_mat,
            'mi_escuela' AS origen
            FROM planea_nlogro_x_idcentrocfg pcfg
            INNER JOIN centrocfg cfg ON cfg.idcentrocfg = pcfg.idcentrocfg
            INNER JOIN cct ct ON ct.idct = cfg.idct
            WHERE ct.cct = '{$cct}' AND cfg.turno = '{$turno}'
            ORDER BY pcfg.periodo_planea ASC";
         return $this->db->query($str_query)->result_array();
        }

        function niveles_de_logro_entidad($cct, $turno){
          $str_query = "SELECT
            pent.periodo_planea AS periodo,
            pent.ni_lyc,
            pent.nii_lyc,
            pent.niii_lyc,
            pent.niv_lyc,
            pent.ni_mat,
            pent.nii_mat,
            pent.niii_mat,
            pent.niv_mat,
            'entidad' AS origen
            FROM planea_nlogro_x_entidad pent
            INNER JOIN centrocfg cfg ON cfg.nivel = pent.idnivel
            INNER JOIN cct ct ON ct.idct = cfg.idct
            WHERE ct.cct = '{$cct}' AND cfg.turno = '{$turno}'
            ORDER BY pent.periodo_planea ASC";
          return $this->db->query($str_query)->result_array();
        }

        function niveles_de_logro_nacional($cct, $turno){
          $str_query = "SELECT
            pnac.periodo_planea AS periodo,
            pnac.ni_lyc AS 'ni_lyc',
            pnac.nii_lyc AS 'nii_lyc',
            pnac.niii_lyc AS 'niii_lyc',
            pnac.niv_lyc AS 'niv_lyc',
            pnac.ni_mat AS 'ni_mat',
            pnac.nii_mat AS 'nii_mat',
            pnac.niii_mat AS 'niii_mat',
            pnac.niv_mat AS 'niv_mat',
            'nacional' AS origen
            FROM planea_nlogro_x_nacional pnac
            INNER JOIN centrocfg cfg ON cfg.nivel = pnac.idnivel
            INNER JOIN cct ct ON ct.idct = cfg.idct
            WHERE ct.cct = '{$cct}' AND cfg.turno = '{$turno}'
            ORDER BY pnac.periodo_planea ASC";
          return $this->db->query($str_query)->result_array();
        }

        function niveles_de_logro_entidad_estadomun($municipio, $nivel, $periodo, $campodisip){
          $tabla = 'planea_nlogro_x_entidad';
          $where = "";
          if($municipio != 0){
            $tabla = 'planea_nlogro_x_muni';
            $where = "pmuni.idmunicipio = {$municipio} AND";
          }
          if($campodisip == 1){
            $campos = "
            pmuni.ni_lyc,
            pmuni.nii_lyc,
            pmuni.niii_lyc,
            pmuni.niv_lyc,
            ";
          }else{
            $campos = "
            pmuni.ni_mat,
            pmuni.nii_mat,
            pmuni.niii_mat,
            pmuni.niv_mat,
            ";
          }
          $str_query = "SELECT
            pmuni.periodo_planea AS periodo,
            {$campos}
            'muni' AS origen
            FROM {$tabla} pmuni
            INNER JOIN ciclo c ON SUBSTRING(c.descr, 1, 4) LIKE CONCAT('%', pmuni.periodo_planea, '%')
            WHERE {$where} pmuni.idnivel = {$nivel} AND c.idciclo = {$periodo}";
            // echo $str_query; die();
          return $this->db->query($str_query)->result_array();
        }

        function niveles_de_logro_entidad_edozona($zona, $periodo, $campodisip){
          if($campodisip == 1){
            $campos = "
            pzona.ni_lyc,
            pzona.nii_lyc,
            pzona.niii_lyc,
            pzona.niv_lyc,
            ";
          }else{
            $campos = "
            pzona.ni_mat,
            pzona.nii_mat,
            pzona.niii_mat,
            pzona.niv_mat,
            ";
          }
          $str_query = "SELECT
            pzona.periodo_planea AS periodo,
            zona.zona_escolar AS zona,
            {$campos}
            'muni' AS origen
            FROM planea_nlogro_x_zona pzona
            INNER JOIN ciclo c ON SUBSTRING(c.descr, 1, 4) LIKE CONCAT('%', pzona.periodo_planea, '%')
            INNER JOIN c_zona zona ON zona.zonaid = pzona.zonaid
            WHERE zona.cct_supervisor = '{$zona}' AND c.idciclo = {$periodo}";
          return $this->db->query($str_query)->result_array();
        }

        function niveles_de_logro_nacional_estadomun($nivel, $periodo, $campodisip){
          $str_query = "SELECT
            pnac.periodo_planea AS periodo,
            pnac.ni_lyc,
            pnac.nii_lyc,
            pnac.niii_lyc,
            pnac.niv_lyc,
            pnac.ni_mat,
            pnac.nii_mat,
            pnac.niii_mat,
            pnac.niv_mat,
            'nacional' AS origen
            FROM planea_nlogro_x_nacional pnac
            INNER JOIN ciclo c ON SUBSTRING(c.descr, 1, 4) LIKE CONCAT('%', pnac.periodo_planea, '%')
            WHERE pnac.idnivel = {$nivel} AND c.idciclo = {$periodo}";
          return $this->db->query($str_query)->result_array();
        }
        function niveles_zona(){
          $str_query = "SELECT
                n.idnivel, n.descr as nombre, n.subfijo
                FROM c_zona z
                INNER JOIN cct ct ON z.cct_supervisor = ct.zonact
                INNER JOIN centrocfg cfg ON ct.idct = cfg.idct
                INNER JOIN planeaxidcentrocfg_reactivo t1 ON cfg.idcentrocfg = t1.idcentrocfg
                INNER JOIN niveleducativo n ON cfg.nivel = n.idnivel
                GROUP BY n.idnivel";
          return $this->db->query($str_query)->result_array();
        }//niveles_zona

        // function sostenimiento_zona($idnivel=null){
        //   $where = " ";
        //   if ($idnivel!=null) {
        //     $where = "WHERE n.idnivel = {$idnivel}";
        //   }
        //   $str_query = "SELECT
        //             s.idsostenimiento, s.descr as nombre, s.estatus
        //             FROM c_zona z
        //             INNER JOIN cct ct ON z.cct_supervisor = ct.zonact
        //             INNER JOIN centrocfg cfg ON ct.idct = cfg.idct
        //             INNER JOIN planeaxidcentrocfg_reactivo t1 ON cfg.idcentrocfg = t1.idcentrocfg
        //             INNER JOIN niveleducativo n ON cfg.nivel = n.idnivel
        //             INNER JOIN c_sostenimiento s ON ct.sostenimiento = s.idsostenimiento
        //             {$where}
        //             GROUP BY s.idsostenimiento";
        //   return $this->db->query($str_query)->result_array();
        // }//niveles_zona

        function modalidad_zona($idnivel=null){
          $where = " ";
          if ($idnivel!=null) {
            $where = "WHERE n.idnivel = {$idnivel}";
          }
          $str_query = "SELECT
          m.idmodalidad, m.descr AS nombre, m.estatus
          FROM c_zona z
          INNER JOIN cct ct ON z.cct_supervisor = ct.zonact
          INNER JOIN centrocfg cfg ON ct.idct = cfg.idct
          INNER JOIN planeaxidcentrocfg_reactivo t1 ON cfg.idcentrocfg = t1.idcentrocfg
          INNER JOIN niveleducativo n ON cfg.nivel = n.idnivel
          INNER JOIN c_modalidad m ON ct.idmodalidad = m.idmodalidad
          {$where}
          GROUP BY m.idmodalidad";
          // echo $str_query; die();
          return $this->db->query($str_query)->result_array();
        }//niveles_zona

        // function zonas_zona($idnivel=null, $idsostenimiento=null){
        //   $where = "WHERE 1=1 ";
        //   if ($idnivel!=null) {
        //     $where .= " AND n.idnivel = {$idnivel}";
        //   }
        //   if ($idsostenimiento!=null) {
        //     $where .= " AND s.idsostenimiento = {$idsostenimiento}";
        //   }
        //   $str_query = "SELECT
        //                 z.zonaid, z.zona_escolar, z.cct_supervisor
        //                 FROM c_zona z
        //                 INNER JOIN cct ct ON z.cct_supervisor = ct.zonact
        //                 INNER JOIN centrocfg cfg ON ct.idct = cfg.idct
        //                 INNER JOIN planeaxidcentrocfg_reactivo t1 ON cfg.idcentrocfg = t1.idcentrocfg
        //                 INNER JOIN niveleducativo n ON cfg.nivel = n.idnivel
        //                 INNER JOIN c_sostenimiento s ON ct.sostenimiento = s.idsostenimiento
        //             {$where}
        //             GROUP BY z.zonaid, z.zona_escolar, z.cct_supervisor";
        //   return $this->db->query($str_query)->result_array();
        // }//niveles_zona

        function zonas_zona($idnivel=null, $idmodalidad=null){
          $where = "WHERE 1=1 ";
          if ($idnivel!=null) {
            $where .= " AND n.idnivel = {$idnivel}";
          }
          if ($idmodalidad!=null) {
            $where .= " AND m.idmodalidad = {$idmodalidad}";
          }
          $str_query = "SELECT
                        z.zonaid, z.zona_escolar, z.cct_supervisor
                        FROM c_zona z
                        INNER JOIN cct ct ON z.cct_supervisor = ct.zonact
                        INNER JOIN centrocfg cfg ON ct.idct = cfg.idct
                        INNER JOIN planeaxidcentrocfg_reactivo t1 ON cfg.idcentrocfg = t1.idcentrocfg
                        INNER JOIN niveleducativo n ON cfg.nivel = n.idnivel
                        INNER JOIN c_modalidad m ON ct.idmodalidad = m.idmodalidad
                    {$where}
                    GROUP BY z.zonaid, z.zona_escolar, z.cct_supervisor";
          return $this->db->query($str_query)->result_array();
        }//niveles_zona

        // function  periodo_zona($idnivel,$idsostenimiento,$zona){
        //   $where = "WHERE 1=1 ";
        //   if ($idnivel!=null) {
        //     $where .= " AND n.idnivel = {$idnivel}";
        //   }
        //   if ($idsostenimiento!=null) {
        //     $where .= " AND s.idsostenimiento = {$idsostenimiento}";
        //   }
        //   if ($zona!=null) {
        //     $where .= " AND z.cct_supervisor = '{$zona}'";
        //   }
        //   $str_query = "SELECT
        //                 p.id_periodo, p.periodo
        //                 FROM c_zona z
        //                 INNER JOIN cct ct ON z.cct_supervisor = ct.zonact
        //                 INNER JOIN centrocfg cfg ON ct.idct = cfg.idct
        //                 INNER JOIN planeaxidcentrocfg_reactivo t1 ON cfg.idcentrocfg = t1.idcentrocfg
        //                 INNER JOIN niveleducativo n ON cfg.nivel = n.idnivel
        //                 INNER JOIN c_sostenimiento s ON ct.sostenimiento = s.idsostenimiento
        //                 INNER JOIN periodoplanea p ON t1.id_periodo =p.id_periodo
        //             {$where}
        //             GROUP BY p.id_periodo";
        //   return $this->db->query($str_query)->result_array();
        // }//periodo_zona
        //
        function  periodo_zona($idnivel,$idmodalidad,$zona){
          $where = "WHERE 1=1 ";
          if ($idnivel!=null) {
            $where .= " AND n.idnivel = {$idnivel}";
          }
          if ($idmodalidad!=null) {
            $where .= " AND m.idmodalidad = {$idmodalidad}";
          }
          if ($zona!=null) {
            $where .= " AND z.cct_supervisor = '{$zona}'";
          }
          $str_query = "SELECT
                        p.id_periodo, p.periodo
                        FROM c_zona z
                        INNER JOIN cct ct ON z.cct_supervisor = ct.zonact
                        INNER JOIN centrocfg cfg ON ct.idct = cfg.idct
                        INNER JOIN planeaxidcentrocfg_reactivo t1 ON cfg.idcentrocfg = t1.idcentrocfg
                        INNER JOIN niveleducativo n ON cfg.nivel = n.idnivel
                        INNER JOIN c_modalidad m ON ct.idmodalidad = m.idmodalidad
                        INNER JOIN periodoplanea p ON t1.id_periodo =p.id_periodo
                    {$where}
                    GROUP BY p.id_periodo";
          return $this->db->query($str_query)->result_array();
        }//periodo_zona


}// Planea_model
