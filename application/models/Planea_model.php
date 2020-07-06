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
                      WHERE ct.`status`='ACT' AND cfg.`status`='A'
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
                        WHERE ct.`status`='ACT' AND cfg.`status`='A'
                        {$where}
                        GROUP BY pp.id_periodo";

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
                        WHERE ct.`status`='ACT' AND cfg.`status`='A' 
                        AND pp.id_periodo = {$idperiodo}
                        GROUP BY pp.id_periodo";

          return $this->db->query($str_query)->row('periodo');
        }

        function obtener_periodoplane_xidperiodo_info(){
          $str_query = "SELECT
                        pp.id_periodo, max(pp.periodo) as periodo
                        FROM cct ct
                        INNER JOIN centrocfg  cfg ON ct.idct= cfg.idct
                        INNER JOIN niveleducativo n on cfg.nivel = n.idnivel
                        INNER JOIN planeaxidcentrocfg_reactivo pr ON cfg.idcentrocfg = pr.idcentrocfg
                        INNER JOIN periodoplanea pp ON pr.id_periodo = pp.id_periodo
                        WHERE ct.`status`='ACT' AND cfg.`status`='A' 
                        GROUP BY pp.id_periodo";

          return $this->db->query($str_query)->row('periodo');
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


        function estadisticas_x_estadozona($zona, $sostenimiento, $nivel, $periodo, $campodisip)
        {
             $where = "";
             $array = array($nivel, $periodo, $campodisip);
             /*if($sostenimiento != 0 ){
                $where.= " AND e.sostenimiento = ?";
                array_push($array,$sostenimiento);
                if($zona != 0 ){
                  $where = " AND e.zona = ?";
                  array_push($array,$zona);
                }
              }*/

              if($zona != 0 ){
                  $where = " AND e.zona = ?";
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
                                      WHERE cfg.nivel = ? AND pp.id_periodo = ?
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



}// Planea_model
