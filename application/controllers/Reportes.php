<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reportes extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->library('My_PHPExcel');
		$this->load->model('Estadistica_model');
		$this->load->model('Generico_model');

		$this->style_encabezado = array(
			'borders' => array(
				'allborders' => array(
					'style' => PHPExcel_Style_Border::BORDER_THIN
				)
			),
			'fill' => array(
				'type'  => PHPExcel_Style_Fill::FILL_SOLID,
				'color' => array(
					'rgb' => 'F4FCFC')
				),
				'font' => array(
					'name'  => 'Arial',
					'bold'  => true,
					'color' => array(
						'rgb' => '000000'
					)
				)
			);
			$this->style_contenido = array(
				'borders' => array(
					'allborders' => array(
						'style' => PHPExcel_Style_Border::BORDER_THIN
					)
				),
				'fill' => array(
					'type'  => PHPExcel_Style_Fill::FILL_SOLID
				),
				'font' => array(
					'name'  => 'Arial',
					// 'bold'  => true,
					'color' => array(
						'rgb' => '000000'
					)
				),
				'alignment' =>  array(
					'horizontal'=> PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
					'vertical'  => PHPExcel_Style_Alignment::VERTICAL_CENTER
					// 'wrap'      => TRUE
				)
			);

			$this->style_titulo = array(
				'borders' => array(
					'allborders' => array(
						'style' => PHPExcel_Style_Border::BORDER_THIN
					)
				),
				'fill' => array(
					'type'  => PHPExcel_Style_Fill::FILL_SOLID,
					'color' => array(
						'rgb' => 'DFF5F5')
					),
					'font' => array(
						'name'  => 'Arial',
						'bold'  => true,
						'color' => array(
							'rgb' => '000000'
						)
					),
					'alignment' =>  array(
						'horizontal'=> PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
						'vertical'  => PHPExcel_Style_Alignment::VERTICAL_CENTER
						// 'wrap'      => TRUE
					)
				);

	}


	private function downloand_file($obj_excel,$nombre){
				// Se modifican los encabezados del HTTP para indicar que se envia un archivo de Excel.
				header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
				header("Content-Disposition: attachment;filename={$nombre}");
				header("Cache-Control: max-age=0");
				$obj_writer = PHPExcel_IOFactory::createWriter($obj_excel, "Excel2007");
				ob_end_clean();
				$obj_writer->save("php://output");
	}// downloand_file()


	public function est_generales_xmuni(){
				$idmunicipio = $this->input->post('idmunicipio');
				$idnivel = $this->input->post('idnivel');
				$idsostenimiento = $this->input->post('idsostenimiento');
				$idmodalidad = $this->input->post('idmodalidad');
				$idciclo = $this->input->post('idciclo');
				$nivel_result = $this->Generico_model->obtener_nombre_nivel($idnivel);
				// echo "<pre>";print_r($nivel_result);die();
				$nivel=((count($nivel_result)>0)?$nivel_result[0]['nombre']:'');
				$result_alumnos = $this->Estadistica_model->obtener_alumnos_xmunicipioxnivelxsosteniminientoxmodalidadxciclo($idmunicipio,$idnivel,$idsostenimiento,$idmodalidad,$idciclo);
		    	$result_docentes = $this->Estadistica_model->obtener_docentes_xmunicipioxnivelxsosteniminientoxmodalidadxciclo($idmunicipio,$idnivel,$idsostenimiento,$idmodalidad,$idciclo);
		    	$result_infraest = $this->Estadistica_model->obtener_infraestructura_xmunicipioxnivelxsosteniminientoxmodalidadxciclo($idmunicipio,$idnivel,$idsostenimiento,$idmodalidad,$idciclo);
		    	$result_asistencia_nv =  $this->Estadistica_model->indicadores_asistencia_xmunicipio($idmunicipio,$idciclo);
		    	$result_permanencia_nv =  $this->Estadistica_model->indicadores_permanencia_xmunicipio($idmunicipio,$idciclo);
		    	//falta ajustar query
		    	$result_planea =  $this->Estadistica_model->indicadores_aprendizaje_xmunicipio($idmunicipio);
					// echo "<pre>";print_r($result_planea);die();
		    	// $result_planea=[];
		    	$result_analfinegi =  $this->Estadistica_model->analfabetismo_xmuni($idmunicipio);
		    	$municipio= $this->Generico_model->obtener_nombre_municipio($idmunicipio);
		    	$nivel = $this->Generico_model->obtener_nombre_nivel($idnivel);
		    	$sostenimiento = $this->Generico_model->obtener_nombre_sostenimiento($idsostenimiento);
		    	$modalidad = $this->Generico_model->obtener_nombre_modalidad($idmodalidad);
		    	$ciclo = $this->Generico_model->obtener_ciclo($idciclo);
		    	$municipio = ((count($municipio)>0)?$municipio[0]['nombre']:'');
		    	$nivel = ((count($nivel)>0)?$nivel[0]['nombre']:'');
		    	$sostenimiento = ((count($sostenimiento)>0)?$sostenimiento[0]['nombre']:'');
		    	$modalidad = ((count($modalidad)>0)?$modalidad[0]['nombre']:'');
		    	$ciclo = ((count($ciclo)>0)?$ciclo[0]['nombre']:'');
				$result_rezinegi =  $this->Estadistica_model->rezago_educativo_xmuni($idmunicipio);


				$obj_excel = new PHPExcel();
				$obj_excel->getActiveSheet()->SetCellValue('A1', 'Estadística e indicadores educativos generales');
				$obj_excel->getActiveSheet()->SetCellValue('A2', 'Municipio: '.(($municipio=='')?'Todos':$municipio).', Nivel: '.(($nivel=='')?'Todos':$nivel).', Sostenimiento: '.(($sostenimiento=='')?'Todos':$sostenimiento).', Modalidad: '.(($modalidad=='')?'Todos':$modalidad).', Ciclo escolar: '.$ciclo.'');
				$obj_excel->getActiveSheet()->SetCellValue('A3', 'Alumnos');
				$obj_excel->getActiveSheet()->SetCellValue('A4', 'Nivel educativo');
				$obj_excel->getActiveSheet()->SetCellValue('B4', 'Sostenimiento');
				$obj_excel->getActiveSheet()->SetCellValue('C4', 'Modalidad');
				$obj_excel->getActiveSheet()->SetCellValue('D4', 'Total');
				// $obj_excel->getActiveSheet()->SetCellValue('D5', 'M');
				// $obj_excel->getActiveSheet()->SetCellValue('E5', 'H');
				// $obj_excel->getActiveSheet()->SetCellValue('D5', '');
				$obj_excel->getActiveSheet()->SetCellValue('E4', '1°');
				$obj_excel->getActiveSheet()->SetCellValue('F4', '2°');
				$obj_excel->getActiveSheet()->SetCellValue('G4', '3°');
				$obj_excel->getActiveSheet()->SetCellValue('H4', '4°');
				$obj_excel->getActiveSheet()->SetCellValue('I4', '5°');
				$obj_excel->getActiveSheet()->SetCellValue('J4', '6°');

				$obj_excel->getActiveSheet()->mergeCells('A1:J1');
				$obj_excel->getActiveSheet()->mergeCells('A2:J2');
				$obj_excel->getActiveSheet()->mergeCells('A3:J3');
				$obj_excel->getActiveSheet()->mergeCells('A4:A5');
				$obj_excel->getActiveSheet()->mergeCells('B4:B5');
				$obj_excel->getActiveSheet()->mergeCells('C4:C5');
				$obj_excel->getActiveSheet()->mergeCells('D4:D5');
				$obj_excel->getActiveSheet()->mergeCells('E4:E5');
				$obj_excel->getActiveSheet()->mergeCells('F4:F5');
				$obj_excel->getActiveSheet()->mergeCells('G4:G5');
				$obj_excel->getActiveSheet()->mergeCells('H4:H5');
				$obj_excel->getActiveSheet()->mergeCells('I4:I5');
				$obj_excel->getActiveSheet()->mergeCells('J4:J5');
				// $obj_excel->getActiveSheet()->mergeCells('K4:K5');
				// $obj_excel->getActiveSheet()->mergeCells('L4:L5');
				$obj_excel->getActiveSheet()->getStyle('A1:J1')->applyFromArray($this->style_titulo);
				$obj_excel->getActiveSheet()->getStyle('A2:J2')->applyFromArray($this->style_titulo);
				$obj_excel->getActiveSheet()->getStyle('A3:J3')->applyFromArray($this->style_titulo);

				$obj_excel->getActiveSheet()->getStyle('A4:J5')->applyFromArray($this->style_encabezado);

				$aux = 6;
				foreach ($result_alumnos as $row) {
					$obj_excel->getActiveSheet()->SetCellValue('A'.$aux, utf8_encode($row['nivel']) );
					$obj_excel->getActiveSheet()->SetCellValue('B'.$aux, utf8_encode($row['sostenimiento']) );
					$obj_excel->getActiveSheet()->SetCellValue('C'.$aux, utf8_encode($row['modalidad']) );
					// $obj_excel->getActiveSheet()->SetCellValue('D'.$aux, $row['alumn_m_t'] );
					// $obj_excel->getActiveSheet()->SetCellValue('E'.$aux, $row['alumn_h_t'] );
					$obj_excel->getActiveSheet()->SetCellValue('D'.$aux, number_format($row['alumn_t_t']) );
					$obj_excel->getActiveSheet()->SetCellValue('E'.$aux, number_format($row['alumnos1']) );
					$obj_excel->getActiveSheet()->SetCellValue('F'.$aux, number_format($row['alumnos2']) );
					$obj_excel->getActiveSheet()->SetCellValue('G'.$aux, number_format($row['alumnos3']) );
					$obj_excel->getActiveSheet()->SetCellValue('H'.$aux, number_format($row['alumnos4']) );
					$obj_excel->getActiveSheet()->SetCellValue('I'.$aux, number_format($row['alumnos5']) );
					$obj_excel->getActiveSheet()->SetCellValue('J'.$aux, number_format($row['alumnos6']) );
					$obj_excel->getActiveSheet()->getStyle('A'.$aux.':J'.$aux)->applyFromArray($this->style_contenido);
					$aux++;
				}
				$aux++;
				$obj_excel->getActiveSheet()->SetCellValue('A'.$aux, 'Personal docente');
				$obj_excel->getActiveSheet()->mergeCells('A'.$aux.':D'.$aux);
				$obj_excel->getActiveSheet()->getStyle('A'.$aux.':D'.$aux)->applyFromArray($this->style_titulo);
				$aux++;
				$obj_excel->getActiveSheet()->SetCellValue('A'.$aux, 'Nivel educativo');
				$obj_excel->getActiveSheet()->SetCellValue('B'.$aux, 'Sostenimiento');
				$obj_excel->getActiveSheet()->SetCellValue('C'.$aux, 'Modalidad');
				// $obj_excel->getActiveSheet()->mergeCells('A'.$aux.':A'.($aux+1));
				// $obj_excel->getActiveSheet()->mergeCells('B'.$aux.':B'.($aux+1));
				// $obj_excel->getActiveSheet()->mergeCells('C'.$aux.':C'.($aux+1));
				$obj_excel->getActiveSheet()->SetCellValue('D'.$aux, 'Docentes');
				// $obj_excel->getActiveSheet()->SetCellValue('G'.$aux, 'Directivo con grupo');
				// $obj_excel->getActiveSheet()->SetCellValue('J'.$aux, 'Directivo sin grupo');
				$obj_excel->getActiveSheet()->mergeCells('D'.$aux.':D'.$aux);
				// $obj_excel->getActiveSheet()->mergeCells('G'.$aux.':I'.$aux);
				// $obj_excel->getActiveSheet()->mergeCells('J'.$aux.':L'.$aux);
				$aux++;
				// $obj_excel->getActiveSheet()->SetCellValue('D'.$aux, 'Mujeres');
				// $obj_excel->getActiveSheet()->SetCellValue('E'.$aux, 'Hombres');
				$obj_excel->getActiveSheet()->SetCellValue('D'.$aux, 'Total');
				// $obj_excel->getActiveSheet()->SetCellValue('G'.$aux, 'Mujeres');
				// $obj_excel->getActiveSheet()->SetCellValue('H'.$aux, 'Hombres');
				// $obj_excel->getActiveSheet()->SetCellValue('I'.$aux, 'Total');
				// $obj_excel->getActiveSheet()->SetCellValue('J'.$aux, 'Mujeres');
				// $obj_excel->getActiveSheet()->SetCellValue('K'.$aux, 'Hombres');
				// $obj_excel->getActiveSheet()->SetCellValue('L'.$aux, 'Total');
				$obj_excel->getActiveSheet()->getStyle('A'.($aux-1).':D'.$aux)->applyFromArray($this->style_encabezado);
				$aux++;
				foreach ($result_docentes as $row) {
					$obj_excel->getActiveSheet()->SetCellValue('A'.$aux, utf8_encode($row['nivel']) );
					$obj_excel->getActiveSheet()->SetCellValue('B'.$aux, utf8_encode($row['sostenimiento']) );
					$obj_excel->getActiveSheet()->SetCellValue('C'.$aux, utf8_encode($row['modalidad']) );
					// $obj_excel->getActiveSheet()->SetCellValue('D'.$aux, $row['docentes_m'] );
					// $obj_excel->getActiveSheet()->SetCellValue('E'.$aux, $row['docentes_h']);
					$obj_excel->getActiveSheet()->SetCellValue('D'.$aux, number_format($row['docentes_t_g']) );
					// $obj_excel->getActiveSheet()->SetCellValue('G'.$aux, $row['directivo_m_congrup'] );
					// $obj_excel->getActiveSheet()->SetCellValue('H'.$aux, $row['directivo_h_congrup'] );
					// $obj_excel->getActiveSheet()->SetCellValue('I'.$aux, $row['directivo_t_congrup'] );
					// $obj_excel->getActiveSheet()->SetCellValue('J'.$aux, $row['directivo_m_singrup'] );
					// $obj_excel->getActiveSheet()->SetCellValue('K'.$aux, $row['directivo_h_singrup'] );
					// $obj_excel->getActiveSheet()->SetCellValue('L'.$aux, $row['directivo_t_singrup'] );
					$obj_excel->getActiveSheet()->getStyle('A'.$aux.':D'.$aux)->applyFromArray($this->style_contenido);
					$aux++;
				}
				$aux++;

				$obj_excel->getActiveSheet()->SetCellValue('A'.$aux, 'Infraestructura');
				$obj_excel->getActiveSheet()->mergeCells('A'.$aux.':L'.$aux);
				$obj_excel->getActiveSheet()->getStyle('A'.$aux.':L'.$aux)->applyFromArray($this->style_titulo);
				$aux++;
				$obj_excel->getActiveSheet()->SetCellValue('A'.$aux, 'Nivel educativo');
				$obj_excel->getActiveSheet()->SetCellValue('B'.$aux, 'Sostenimiento');
				$obj_excel->getActiveSheet()->SetCellValue('C'.$aux, 'Modalidad');
				$obj_excel->getActiveSheet()->SetCellValue('D'.$aux, 'Escuelas');
				$obj_excel->getActiveSheet()->mergeCells('A'.$aux.':A'.($aux+1));
				$obj_excel->getActiveSheet()->mergeCells('B'.$aux.':B'.($aux+1));
				$obj_excel->getActiveSheet()->mergeCells('C'.$aux.':C'.($aux+1));
				$obj_excel->getActiveSheet()->mergeCells('D'.$aux.':D'.($aux+1));
				$obj_excel->getActiveSheet()->SetCellValue('E'.$aux, 'Grupos');
				$obj_excel->getActiveSheet()->mergeCells('E'.$aux.':L'.$aux);
				$aux++;
				$obj_excel->getActiveSheet()->SetCellValue('E'.$aux, '1°');
				$obj_excel->getActiveSheet()->SetCellValue('F'.$aux, '2°');
				$obj_excel->getActiveSheet()->SetCellValue('G'.$aux, '3°');
				$obj_excel->getActiveSheet()->SetCellValue('H'.$aux, '4°');
				$obj_excel->getActiveSheet()->SetCellValue('I'.$aux, '5°');
				$obj_excel->getActiveSheet()->SetCellValue('J'.$aux, '6°');
				$obj_excel->getActiveSheet()->SetCellValue('K'.$aux, 'Multigrado');
				$obj_excel->getActiveSheet()->SetCellValue('L'.$aux, 'Total');
				$obj_excel->getActiveSheet()->getStyle('A'.($aux-1).':L'.$aux)->applyFromArray($this->style_encabezado);
				$aux++;
				foreach ($result_infraest as $row) {
					$obj_excel->getActiveSheet()->SetCellValue('A'.$aux, utf8_encode($row['nivel']) );
					$obj_excel->getActiveSheet()->SetCellValue('B'.$aux, utf8_encode($row['sostenimiento']) );
					$obj_excel->getActiveSheet()->SetCellValue('C'.$aux, utf8_encode($row['modalidad']) );
					$obj_excel->getActiveSheet()->SetCellValue('D'.$aux, number_format($row['nescuelas']) );
					$obj_excel->getActiveSheet()->SetCellValue('E'.$aux, number_format($row['grupos_1']) );
					$obj_excel->getActiveSheet()->SetCellValue('F'.$aux, number_format($row['grupos_2']) );
					$obj_excel->getActiveSheet()->SetCellValue('G'.$aux, number_format($row['grupos_3']) );
					$obj_excel->getActiveSheet()->SetCellValue('H'.$aux, number_format($row['grupos_4']) );
					$obj_excel->getActiveSheet()->SetCellValue('I'.$aux, number_format($row['grupos_5']) );
					$obj_excel->getActiveSheet()->SetCellValue('J'.$aux, number_format($row['grupos_6']) );
					$obj_excel->getActiveSheet()->SetCellValue('K'.$aux, number_format($row['grupos_multi']) );
					$obj_excel->getActiveSheet()->SetCellValue('L'.$aux, number_format($row['grupos_t']) );
					$obj_excel->getActiveSheet()->getStyle('A'.$aux.':L'.$aux)->applyFromArray($this->style_contenido);
					$aux++;
				}

				$obj_excel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
				$obj_excel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
				$obj_excel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
				$obj_excel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
				$obj_excel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
				$obj_excel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
				$obj_excel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
				$obj_excel->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
				$obj_excel->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
				$obj_excel->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);
				$obj_excel->getActiveSheet()->getColumnDimension('K')->setAutoSize(true);
				$obj_excel->getActiveSheet()->getColumnDimension('L')->setAutoSize(true);

				$aux++;
				$obj_excel->getActiveSheet()->SetCellValue('A'.$aux, 'Indicadores de Asistencia');
				$obj_excel->getActiveSheet()->mergeCells('A'.$aux.':C'.$aux);
				$obj_excel->getActiveSheet()->getStyle('A'.$aux.':C'.$aux)->applyFromArray($this->style_titulo);
				$aux++;
				$obj_excel->getActiveSheet()->SetCellValue('A'.$aux, 'ciclo escolar '.$ciclo);
				$obj_excel->getActiveSheet()->mergeCells('A'.$aux.':C'.$aux);
				$obj_excel->getActiveSheet()->getStyle('A'.$aux.':C'.$aux)->applyFromArray($this->style_titulo);
				$aux++;
				$obj_excel->getActiveSheet()->SetCellValue('A'.$aux.'', 'Nivel');
				$obj_excel->getActiveSheet()->SetCellValue('B'.$aux.'', 'Cobertura');
				$obj_excel->getActiveSheet()->SetCellValue('C'.$aux.'', 'Absorción');
				$obj_excel->getActiveSheet()->getStyle('A'.($aux-1).':C'.$aux)->applyFromArray($this->style_encabezado);
				$aux++;
				foreach ($result_asistencia_nv as $row) {
					$obj_excel->getActiveSheet()->SetCellValue('A'.$aux, utf8_encode($row['nivel']) );
					$obj_excel->getActiveSheet()->SetCellValue('B'.$aux, (($row['cobertura']=='')?'-':$row['cobertura'].'%') );
					$obj_excel->getActiveSheet()->SetCellValue('C'.$aux, (($row['absorcion']=='')?'-':$row['absorcion'].'%') );
					$obj_excel->getActiveSheet()->getStyle('A'.$aux.':C'.$aux)->applyFromArray($this->style_contenido);
					$aux++;
				}

				$aux++;
				$obj_excel->getActiveSheet()->SetCellValue('A'.$aux, 'Indicadores de Permanencia');
				$obj_excel->getActiveSheet()->mergeCells('A'.$aux.':D'.$aux);
				$obj_excel->getActiveSheet()->getStyle('A'.$aux.':D'.$aux)->applyFromArray($this->style_titulo);
				$aux++;
				$obj_excel->getActiveSheet()->SetCellValue('A'.$aux, 'ciclo escolar '.$ciclo);
				$obj_excel->getActiveSheet()->mergeCells('A'.$aux.':D'.$aux);
				$obj_excel->getActiveSheet()->getStyle('A'.$aux.':D'.$aux)->applyFromArray($this->style_titulo);
				$aux++;
				$obj_excel->getActiveSheet()->SetCellValue('A'.$aux.'', 'Nivel');
				$obj_excel->getActiveSheet()->SetCellValue('B'.$aux.'', 'Retención');
				$obj_excel->getActiveSheet()->SetCellValue('C'.$aux.'', 'Aprobación');
				$obj_excel->getActiveSheet()->SetCellValue('D'.$aux.'', 'Eficiencia Terminal');
				$obj_excel->getActiveSheet()->getStyle('A'.($aux-1).':D'.$aux)->applyFromArray($this->style_encabezado);
				$aux++;
				foreach ($result_permanencia_nv as $row) {
					$obj_excel->getActiveSheet()->SetCellValue('A'.$aux, utf8_encode($row['nivel']) );
					$obj_excel->getActiveSheet()->SetCellValue('B'.$aux, (($row['retencion']=='')?'-':$row['retencion'].'%') );
					$obj_excel->getActiveSheet()->SetCellValue('C'.$aux, (($row['aprobacion']=='')?'-':$row['aprobacion'].'%') );
					$obj_excel->getActiveSheet()->SetCellValue('D'.$aux, (($row['et']=='')?'-':$row['et'].'%') );
					$obj_excel->getActiveSheet()->getStyle('A'.$aux.':D'.$aux)->applyFromArray($this->style_contenido);
					$aux++;
				}

				$aux++;
				$obj_excel->getActiveSheet()->SetCellValue('A'.$aux, 'Indicadores de aprendizaje');
				$obj_excel->getActiveSheet()->mergeCells('A'.$aux.':K'.$aux);
				$obj_excel->getActiveSheet()->getStyle('A'.$aux.':K'.$aux)->applyFromArray($this->style_titulo);
				$aux++;
				$obj_excel->getActiveSheet()->SetCellValue('A'.$aux, 'Resultados de prueba PLANEA 2016');
				$obj_excel->getActiveSheet()->mergeCells('A'.$aux.':K'.$aux);
				$obj_excel->getActiveSheet()->getStyle('A'.$aux.':K'.$aux)->applyFromArray($this->style_titulo);
				$aux++;
				$obj_excel->getActiveSheet()->SetCellValue('A'.$aux, 'Nivel educativo');
				$obj_excel->getActiveSheet()->mergeCells('A'.$aux.':A'.($aux+2));
				$obj_excel->getActiveSheet()->SetCellValue('B'.$aux, 'Lenguaje y Comunicación');
				$obj_excel->getActiveSheet()->SetCellValue('G'.$aux, 'Matemáticas');
				$obj_excel->getActiveSheet()->mergeCells('B'.$aux.':F'.$aux);
				$obj_excel->getActiveSheet()->mergeCells('G'.$aux.':K'.$aux);
				$aux++;
				$obj_excel->getActiveSheet()->SetCellValue('B'.$aux, 'Nivel de dominio');
				$obj_excel->getActiveSheet()->SetCellValue('G'.$aux, 'Nivel de dominio');
				$obj_excel->getActiveSheet()->SetCellValue('F'.$aux, 'Porcentaje de alumnos con nivel bueno y excelente');
				$obj_excel->getActiveSheet()->SetCellValue('K'.$aux, 'Porcentaje de alumnos con nivel bueno y excelente');
				$obj_excel->getActiveSheet()->mergeCells('B'.$aux.':E'.$aux);
				$obj_excel->getActiveSheet()->mergeCells('G'.$aux.':J'.$aux);
				$obj_excel->getActiveSheet()->mergeCells('F'.$aux.':F'.($aux+1));
				$obj_excel->getActiveSheet()->mergeCells('K'.$aux.':K'.($aux+1));
				$aux++;
				$obj_excel->getActiveSheet()->SetCellValue('B'.$aux, 'I Insuficiente');
				$obj_excel->getActiveSheet()->SetCellValue('C'.$aux, 'II Elemental');
				$obj_excel->getActiveSheet()->SetCellValue('D'.$aux, 'III Bueno');
				$obj_excel->getActiveSheet()->SetCellValue('E'.$aux, 'IV Excelente');

				$obj_excel->getActiveSheet()->SetCellValue('G'.$aux, 'I Insuficiente');
				$obj_excel->getActiveSheet()->SetCellValue('H'.$aux, 'II Elemental');
				$obj_excel->getActiveSheet()->SetCellValue('I'.$aux, 'III Bueno');
				$obj_excel->getActiveSheet()->SetCellValue('J'.$aux, 'IV Excelente');

				$obj_excel->getActiveSheet()->getStyle('A'.($aux-2).':K'.$aux)->applyFromArray($this->style_encabezado);
				$aux++;
				foreach ($result_planea as $row) {
					$obj_excel->getActiveSheet()->SetCellValue('A'.$aux, utf8_encode($row['nivel']) );
					$obj_excel->getActiveSheet()->SetCellValue('B'.$aux, ($row['ni_lyc']).'%' );
					$obj_excel->getActiveSheet()->SetCellValue('C'.$aux, ($row['nii_lyc']).'%' );
					$obj_excel->getActiveSheet()->SetCellValue('D'.$aux, ($row['niii_lyc']).'%' );
					$obj_excel->getActiveSheet()->SetCellValue('E'.$aux, ($row['niv_lyc']).'%' );
					$obj_excel->getActiveSheet()->SetCellValue('F'.$aux, ($row['niii_lyc']+$row['niv_lyc']).'%' );
					$obj_excel->getActiveSheet()->SetCellValue('G'.$aux, ($row['ni_mat']).'%' );
					$obj_excel->getActiveSheet()->SetCellValue('H'.$aux, ($row['nii_mat']).'%' );
					$obj_excel->getActiveSheet()->SetCellValue('I'.$aux, ($row['niii_mat']).'%' );
					$obj_excel->getActiveSheet()->SetCellValue('J'.$aux, ($row['niv_mat']).'%' );
					$obj_excel->getActiveSheet()->SetCellValue('K'.$aux, ($row['niii_mat']+$row['niv_mat']).'%' );
					$obj_excel->getActiveSheet()->getStyle('A'.$aux.':K'.$aux)->applyFromArray($this->style_contenido);
					$aux++;
				}
				$aux++;

				$obj_excel->getActiveSheet()->SetCellValue('A'.$aux, 'Rezago educativo');
				$obj_excel->getActiveSheet()->mergeCells('A'.$aux.':G'.$aux);
				$obj_excel->getActiveSheet()->getStyle('A'.$aux.':G'.$aux)->applyFromArray($this->style_titulo);
				$aux++;
				$obj_excel->getActiveSheet()->SetCellValue('A'.$aux, 'Población por grupo de edad que no asiste a la escuela');
				$obj_excel->getActiveSheet()->SetCellValue('B'.$aux, 'Población total');
				$obj_excel->getActiveSheet()->SetCellValue('E'.$aux, 'Población que no asiste a la escuela');
				$obj_excel->getActiveSheet()->mergeCells('A'.$aux.':A'.($aux+1));
				$obj_excel->getActiveSheet()->mergeCells('B'.$aux.':D'.($aux));
				$obj_excel->getActiveSheet()->mergeCells('E'.$aux.':G'.($aux));
				$aux++;
				$obj_excel->getActiveSheet()->SetCellValue('B'.$aux, 'Mujeres');
				$obj_excel->getActiveSheet()->SetCellValue('C'.$aux, 'Hombres');
				$obj_excel->getActiveSheet()->SetCellValue('D'.$aux, 'Total');
				$obj_excel->getActiveSheet()->SetCellValue('E'.$aux, 'Mujeres');
				$obj_excel->getActiveSheet()->SetCellValue('F'.$aux, 'Hombres');
				$obj_excel->getActiveSheet()->SetCellValue('G'.$aux, 'Total');
				$obj_excel->getActiveSheet()->getStyle('A'.($aux-1).':G'.$aux)->applyFromArray($this->style_encabezado);
				$aux++;
				$temp=$aux;
				foreach ($result_rezinegi as $row) {
					$obj_excel->getActiveSheet()->SetCellValue('A'.$aux, ('3 a 14 años') );
					$obj_excel->getActiveSheet()->SetCellValue('B'.$aux, number_format($row['p3A14_ptotal_h']) );
					$obj_excel->getActiveSheet()->SetCellValue('C'.$aux, number_format($row['p3A14_ptotal_m']) );
					$obj_excel->getActiveSheet()->SetCellValue('D'.$aux, number_format($row['p3A14_ptotal_h']+$row['p3A14_ptotal_m']) );
					$obj_excel->getActiveSheet()->SetCellValue('E'.$aux, number_format($row['p3A14_noa_h']) );
					$obj_excel->getActiveSheet()->SetCellValue('F'.$aux, number_format($row['p3A14_noa_m']) );
					$obj_excel->getActiveSheet()->SetCellValue('G'.$aux, number_format($row['p3A14_noa_h']+$row['p3A14_noa_m']) );
					$obj_excel->getActiveSheet()->getStyle('A'.$temp.':G'.$aux)->applyFromArray($this->style_contenido);
					$aux++;
					// $obj_excel->getActiveSheet()->SetCellValue('A'.$aux, ('12 a 14 años') );
					// $obj_excel->getActiveSheet()->SetCellValue('B'.$aux, number_format($row['p12A14ptotal_h']) );
					// $obj_excel->getActiveSheet()->SetCellValue('C'.$aux, number_format($row['p12A14ptotal_m']) );
					// $obj_excel->getActiveSheet()->SetCellValue('D'.$aux, number_format($row['p12A14ptotal_h']+$row['p12A14ptotal_m']) );
					// $obj_excel->getActiveSheet()->SetCellValue('E'.$aux, number_format($row['p12A14noa_h']) );
					// $obj_excel->getActiveSheet()->SetCellValue('F'.$aux, number_format($row['p12A14noa_m']) );
					// $obj_excel->getActiveSheet()->SetCellValue('G'.$aux, number_format($row['p12A14noa_h']+$row['p12A14noa_m']) );
					// $aux++;
				}

				$aux++;
				$obj_excel->getActiveSheet()->SetCellValue('A'.$aux, 'Analfabetismo');
				$obj_excel->getActiveSheet()->mergeCells('A'.$aux.':D'.$aux);
				$obj_excel->getActiveSheet()->getStyle('A'.$aux.':D'.$aux)->applyFromArray($this->style_titulo);
				$aux++;
				$obj_excel->getActiveSheet()->SetCellValue('B'.$aux, 'Mujeres');
				$obj_excel->getActiveSheet()->SetCellValue('C'.$aux, 'Hombres');
				$obj_excel->getActiveSheet()->SetCellValue('D'.$aux, 'Total');
				$obj_excel->getActiveSheet()->getStyle('A'.($aux-1).':D'.$aux)->applyFromArray($this->style_encabezado);
				$aux++;
				$temp=$aux;

				foreach ($result_analfinegi as $row) {
					$obj_excel->getActiveSheet()->SetCellValue('A'.$aux, ('Población mayor de 15 años que no saben leer ni escribir') );
					$obj_excel->getActiveSheet()->SetCellValue('B'.$aux, number_format($row['analfabetismo_mayor15_h']) );
					$obj_excel->getActiveSheet()->SetCellValue('C'.$aux, number_format($row['analfabetismo_mayor15_m']) );
					$obj_excel->getActiveSheet()->SetCellValue('D'.$aux, number_format($row['analfabetismo_mayor15_h']+$row['analfabetismo_mayor15_m']) );

					$obj_excel->getActiveSheet()->getStyle('A'.$temp.':D'.$aux)->applyFromArray($this->style_contenido);
					$aux++;
				}
				date_default_timezone_set('America/Mexico_City');
				$hoy = date("Y-m-d");
				$name_file = "Estadistica_e_indicadores_generales_".$hoy.'.xlsx';
				$this->downloand_file($obj_excel,$name_file);
	}// est_generales_xmuni()

	public function escuelas(){
		$idmunicipio = $this->input->post('busquedalista_municipio_reporte');
		$idnivel = $this->input->post('busquedalista_nivel_reporte');
		$idsostenimiento = $this->input->post('busquedalista_sostenimiento_reporte');
		$nombre_cct = $this->input->post('busquedalista_nombreescuela_reporte');
		// $municipio = $this->input->get('hidden_municipio');
		// $nivel = $this->input->get('hidden_nivel');
		// $sostenimiento = $this->input->get('hidden_sostenimiento');
		$array=$this->Estadistica_model->escuelas($idmunicipio,$idnivel,$idsostenimiento,$nombre_cct,'');


				$obj_excel = new PHPExcel();
				$obj_excel->getActiveSheet()->SetCellValue('A1', 'Lista de escuelas');
				$obj_excel->getActiveSheet()->SetCellValue('A2', 'CCT');
				$obj_excel->getActiveSheet()->SetCellValue('B2', 'Turno');
				$obj_excel->getActiveSheet()->SetCellValue('C2', 'Nombre');
				$obj_excel->getActiveSheet()->SetCellValue('D2', 'Nivel');
				$obj_excel->getActiveSheet()->SetCellValue('E2', 'Municipio');
				// $obj_excel->getActiveSheet()->SetCellValue('F2', 'Localidad');
				// $obj_excel->getActiveSheet()->SetCellValue('F2', 'Domicilio');

				$obj_excel->getActiveSheet()->mergeCells('A1:E1');
				$obj_excel->getActiveSheet()->getStyle('A1:E1')->applyFromArray($this->style_titulo);
				$obj_excel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
				$obj_excel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
				$obj_excel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
				$obj_excel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
				$obj_excel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
				// $obj_excel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
				// $obj_excel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
				$obj_excel->getActiveSheet()->getStyle('A2:E2')->applyFromArray($this->style_encabezado);

				$aux = 3;
				foreach ($array as $row) {
					$obj_excel->getActiveSheet()->SetCellValue('A'.$aux, utf8_encode($row['cct']) );
					$obj_excel->getActiveSheet()->SetCellValue('B'.$aux, utf8_encode($row['turno']) );
					$obj_excel->getActiveSheet()->SetCellValue('C'.$aux, utf8_encode($row['nombre']) );
					$obj_excel->getActiveSheet()->SetCellValue('D'.$aux, utf8_encode($row['nivel']) );
					$obj_excel->getActiveSheet()->SetCellValue('E'.$aux, utf8_encode($row['municipio']) );
					// $obj_excel->getActiveSheet()->SetCellValue('F'.$aux, utf8_encode($row['domicilio']) );
					// $obj_excel->getActiveSheet()->SetCellValue('G'.$aux, utf8_encode($row['domicilio']) );
					$obj_excel->getActiveSheet()->getStyle('A'.$aux.':E'.$aux)->applyFromArray($this->style_contenido);
					$aux++;
				}
				date_default_timezone_set('America/Mexico_City');
				$hoy = date("Y-m-d");
				$name_file = "Reporte_escuelas_".$hoy.'.xlsx';
				$this->downloand_file($obj_excel,$name_file);

	}//escuelas

}// ReportesS
