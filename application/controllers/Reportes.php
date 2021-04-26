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
					'color' => array(
						'rgb' => '000000'
					)
				),
				'alignment' =>  array(
					'horizontal'=> PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
					'vertical'  => PHPExcel_Style_Alignment::VERTICAL_CENTER
				)
			);

			$this->style_contenido_first_colum = array(
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
					'color' => array(
						'rgb' => '000000'
					)
				),
				'alignment' =>  array(
					'horizontal'=> PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
					'vertical'  => PHPExcel_Style_Alignment::VERTICAL_CENTER
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
					)
				);

	}


	private function downloand_file($obj_excel,$nombre){

				header("Content-type: application/ms-excel");
				header("Content-Disposition: attachment;filename=\"" . $nombre . "\"");
				header("Cache-control: private");
				$objWriter = PHPExcel_IOFactory::createWriter($obj_excel, 'Excel5');
				$objWriter->save("assets/export/$nombre");
        readfile("assets/export/$nombre");
  			unlink("assets/export/$nombre");

	}// downloand_file()

	public function est_generales_xmuni(){
		$idmunicipio = $this->input->post('idmunicipio');
				$idnivel = $this->input->post('idnivel');
				$idsostenimiento = $this->input->post('idsostenimiento');
				$idmodalidad = $this->input->post('idmodalidad');
				$idciclo = $this->input->post('idciclo');
				$nivel_result = $this->Generico_model->obtener_nombre_nivel($idnivel);
				$nivel=((count($nivel_result)>0)?$nivel_result[0]['nombre']:'');
				$result_alumnos = $this->Estadistica_model->obtener_alumnos_xmunicipioxnivelxsosteniminientoxmodalidadxciclo($idmunicipio,$idnivel,$idsostenimiento,$idmodalidad,$idciclo);
		    	$result_docentes = $this->Estadistica_model->obtener_docentes_xmunicipioxnivelxsosteniminientoxmodalidadxciclo($idmunicipio,$idnivel,$idsostenimiento,$idmodalidad,$idciclo);
		    	$result_infraest = $this->Estadistica_model->obtener_infraestructura_xmunicipioxnivelxsosteniminientoxmodalidadxciclo($idmunicipio,$idnivel,$idsostenimiento,$idmodalidad,$idciclo);
					$arr_ciclos_asistencia =  $this->Estadistica_model->ciclos_indicadores_asistencia_xmunicipio($idmunicipio);
					$arr_niveles_asistencia =  $this->Estadistica_model->niveles_indicadores_asistencia_xmunicipio($idmunicipio);
					$result_asistencia_nv =  $this->Estadistica_model->indicadores_asistencia_xmunicipio($idmunicipio,$idciclo);
					$arr_ciclos_permanencia =  $this->Estadistica_model->ciclos_indicadores_permanencia_xmunicipio($idmunicipio);
					$arr_niveles_permanencia =  $this->Estadistica_model->niveles_indicadores_permanencia_xmunicipio($idmunicipio);
		    	$result_permanencia_nv =  $this->Estadistica_model->indicadores_permanencia_xmunicipio($idmunicipio,$idciclo);
		    	//falta ajustar query
		    	$result_planea =  $this->Estadistica_model->indicadores_aprendizaje_xmunicipio($idmunicipio);

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
		// Create new PHPExcel object
		$objPHPExcel = new PHPExcel();

		// Create a first sheet, representing sales data
		$objPHPExcel->setActiveSheetIndex(0);
		$objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Estadística e indicadores educativos generales');
				$objPHPExcel->getActiveSheet()->SetCellValue('A2', 'Municipio: '.(($municipio=='')?'Todos':$municipio).', Nivel: '.(($nivel=='')?'Todos':$nivel).', Sostenimiento: '.(($sostenimiento=='')?'Todos':$sostenimiento).', Modalidad: '.(($modalidad=='')?'Todos':$modalidad).', Ciclo escolar: '.$ciclo.'');
				$objPHPExcel->getActiveSheet()->SetCellValue('A3', 'Alumnos');
				$objPHPExcel->getActiveSheet()->SetCellValue('A4', 'Nivel educativo');
				$objPHPExcel->getActiveSheet()->SetCellValue('B4', 'Sostenimiento');
				$objPHPExcel->getActiveSheet()->SetCellValue('C4', 'Modalidad');
				$objPHPExcel->getActiveSheet()->SetCellValue('D4', 'Total');
				$objPHPExcel->getActiveSheet()->SetCellValue('E4', '1°');
				$objPHPExcel->getActiveSheet()->SetCellValue('F4', '2°');
				$objPHPExcel->getActiveSheet()->SetCellValue('G4', '3°');
				$objPHPExcel->getActiveSheet()->SetCellValue('H4', '4°');
				$objPHPExcel->getActiveSheet()->SetCellValue('I4', '5°');
				$objPHPExcel->getActiveSheet()->SetCellValue('J4', '6°');

				$objPHPExcel->getActiveSheet()->mergeCells('A1:J1');
				$objPHPExcel->getActiveSheet()->mergeCells('A2:J2');
				$objPHPExcel->getActiveSheet()->mergeCells('A3:J3');
				$objPHPExcel->getActiveSheet()->mergeCells('A4:A5');
				$objPHPExcel->getActiveSheet()->mergeCells('B4:B5');
				$objPHPExcel->getActiveSheet()->mergeCells('C4:C5');
				$objPHPExcel->getActiveSheet()->mergeCells('D4:D5');
				$objPHPExcel->getActiveSheet()->mergeCells('E4:E5');
				$objPHPExcel->getActiveSheet()->mergeCells('F4:F5');
				$objPHPExcel->getActiveSheet()->mergeCells('G4:G5');
				$objPHPExcel->getActiveSheet()->mergeCells('H4:H5');
				$objPHPExcel->getActiveSheet()->mergeCells('I4:I5');
				$objPHPExcel->getActiveSheet()->mergeCells('J4:J5');
				$objPHPExcel->getActiveSheet()->getStyle('A1:J1')->applyFromArray($this->style_titulo);
				$objPHPExcel->getActiveSheet()->getStyle('A2:J2')->applyFromArray($this->style_titulo);
				$objPHPExcel->getActiveSheet()->getStyle('A3:J3')->applyFromArray($this->style_titulo);

				$objPHPExcel->getActiveSheet()->getStyle('A4:J5')->applyFromArray($this->style_encabezado);

				$aux = 6;
				foreach ($result_alumnos as $row) {
					$objPHPExcel->getActiveSheet()->SetCellValue('A'.$aux, ($row['nivel']) );
					$objPHPExcel->getActiveSheet()->SetCellValue('B'.$aux, ($row['sostenimiento']) );
					$objPHPExcel->getActiveSheet()->SetCellValue('C'.$aux, ($row['modalidad']) );
					$objPHPExcel->getActiveSheet()->SetCellValue('D'.$aux, number_format($row['alumn_t_t']) );
					$objPHPExcel->getActiveSheet()->SetCellValue('E'.$aux, number_format($row['alumnos1']) );
					$objPHPExcel->getActiveSheet()->SetCellValue('F'.$aux, number_format($row['alumnos2']) );
					$objPHPExcel->getActiveSheet()->SetCellValue('G'.$aux, number_format($row['alumnos3']) );
					$objPHPExcel->getActiveSheet()->SetCellValue('H'.$aux, number_format($row['alumnos4']) );
					$objPHPExcel->getActiveSheet()->SetCellValue('I'.$aux, number_format($row['alumnos5']) );
					$objPHPExcel->getActiveSheet()->SetCellValue('J'.$aux, number_format($row['alumnos6']) );
					$objPHPExcel->getActiveSheet()->getStyle('D'.$aux.':J'.$aux)->applyFromArray($this->style_contenido);

					$objPHPExcel->getActiveSheet()->getStyle('A'.$aux.':C'.$aux)->applyFromArray($this->style_contenido_first_colum);
					$aux++;
				}
		$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);

		// Rename sheet
		$objPHPExcel->getActiveSheet()->setTitle('Estadística e indicadores');

		// Create a new worksheet, after the default sheet
		$objPHPExcel->createSheet();



		// Add some data to the second sheet, resembling some different data types
		$objPHPExcel->setActiveSheetIndex(1);
		$aux= 1;

				$objPHPExcel->getActiveSheet()->SetCellValue('A'.$aux, 'Personal docente');
				$objPHPExcel->getActiveSheet()->mergeCells('A'.$aux.':D'.$aux);
				$objPHPExcel->getActiveSheet()->getStyle('A'.$aux.':D'.$aux)->applyFromArray($this->style_titulo);
				$aux++;
				$objPHPExcel->getActiveSheet()->SetCellValue('A'.$aux, 'Nivel educativo');
				$objPHPExcel->getActiveSheet()->SetCellValue('B'.$aux, 'Sostenimiento');
				$objPHPExcel->getActiveSheet()->SetCellValue('C'.$aux, 'Modalidad');

				$objPHPExcel->getActiveSheet()->SetCellValue('D'.$aux, 'Docentes');

				$objPHPExcel->getActiveSheet()->mergeCells('D'.$aux.':D'.$aux);

				$aux++;

				$objPHPExcel->getActiveSheet()->SetCellValue('D'.$aux, 'Total');
				$objPHPExcel->getActiveSheet()->getStyle('A'.($aux-1).':D'.$aux)->applyFromArray($this->style_encabezado);
				$aux++;
				foreach ($result_docentes as $row) {
					$objPHPExcel->getActiveSheet()->SetCellValue('A'.$aux, ($row['nivel']) );
					$objPHPExcel->getActiveSheet()->SetCellValue('B'.$aux, ($row['sostenimiento']) );
					$objPHPExcel->getActiveSheet()->SetCellValue('C'.$aux, ($row['modalidad']) );

					$objPHPExcel->getActiveSheet()->SetCellValue('D'.$aux, number_format($row['docentes_t_g']) );
					$objPHPExcel->getActiveSheet()->getStyle('D'.$aux.':D'.$aux)->applyFromArray($this->style_contenido);

					$objPHPExcel->getActiveSheet()->getStyle('A'.$aux.':C'.$aux)->applyFromArray($this->style_contenido_first_colum);
					$aux++;
				}

		$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);


		// Rename 2nd sheet
		$objPHPExcel->getActiveSheet()->setTitle('Personal docente');

		// Create a new worksheet, after the default sheet
		$objPHPExcel->createSheet();

		// Add some data to the tercer sheet, resembling some different data types
		$objPHPExcel->setActiveSheetIndex(2);
		$aux=1;
		$objPHPExcel->getActiveSheet()->SetCellValue('A'.$aux, 'Escuelas y grupos');
				$objPHPExcel->getActiveSheet()->mergeCells('A'.$aux.':L'.$aux);
				$objPHPExcel->getActiveSheet()->getStyle('A'.$aux.':L'.$aux)->applyFromArray($this->style_titulo);
				$aux++;
				$objPHPExcel->getActiveSheet()->SetCellValue('A'.$aux, 'Nivel educativo');
				$objPHPExcel->getActiveSheet()->SetCellValue('B'.$aux, 'Sostenimiento');
				$objPHPExcel->getActiveSheet()->SetCellValue('C'.$aux, 'Modalidad');
				$objPHPExcel->getActiveSheet()->SetCellValue('D'.$aux, 'Escuelas');
				$objPHPExcel->getActiveSheet()->mergeCells('A'.$aux.':A'.($aux+1));
				$objPHPExcel->getActiveSheet()->mergeCells('B'.$aux.':B'.($aux+1));
				$objPHPExcel->getActiveSheet()->mergeCells('C'.$aux.':C'.($aux+1));
				$objPHPExcel->getActiveSheet()->mergeCells('D'.$aux.':D'.($aux+1));
				$objPHPExcel->getActiveSheet()->SetCellValue('E'.$aux, 'Grupos');
				$objPHPExcel->getActiveSheet()->mergeCells('E'.$aux.':L'.$aux);
				$aux++;
				$objPHPExcel->getActiveSheet()->SetCellValue('E'.$aux, '1°');
				$objPHPExcel->getActiveSheet()->SetCellValue('F'.$aux, '2°');
				$objPHPExcel->getActiveSheet()->SetCellValue('G'.$aux, '3°');
				$objPHPExcel->getActiveSheet()->SetCellValue('H'.$aux, '4°');
				$objPHPExcel->getActiveSheet()->SetCellValue('I'.$aux, '5°');
				$objPHPExcel->getActiveSheet()->SetCellValue('J'.$aux, '6°');
				$objPHPExcel->getActiveSheet()->SetCellValue('K'.$aux, 'Multigrado');
				$objPHPExcel->getActiveSheet()->SetCellValue('L'.$aux, 'Total');
				$objPHPExcel->getActiveSheet()->getStyle('A'.($aux-1).':L'.$aux)->applyFromArray($this->style_encabezado);
				$aux++;
				foreach ($result_infraest as $row) {
					$objPHPExcel->getActiveSheet()->SetCellValue('A'.$aux, ($row['nivel']) );
					$objPHPExcel->getActiveSheet()->SetCellValue('B'.$aux, ($row['sostenimiento']) );
					$objPHPExcel->getActiveSheet()->SetCellValue('C'.$aux, ($row['modalidad']) );
					$objPHPExcel->getActiveSheet()->SetCellValue('D'.$aux, number_format($row['nescuelas']) );
					$objPHPExcel->getActiveSheet()->SetCellValue('E'.$aux, number_format($row['grupos_1']) );
					$objPHPExcel->getActiveSheet()->SetCellValue('F'.$aux, number_format($row['grupos_2']) );
					$objPHPExcel->getActiveSheet()->SetCellValue('G'.$aux, number_format($row['grupos_3']) );
					$objPHPExcel->getActiveSheet()->SetCellValue('H'.$aux, number_format($row['grupos_4']) );
					$objPHPExcel->getActiveSheet()->SetCellValue('I'.$aux, number_format($row['grupos_5']) );
					$objPHPExcel->getActiveSheet()->SetCellValue('J'.$aux, number_format($row['grupos_6']) );
					$objPHPExcel->getActiveSheet()->SetCellValue('K'.$aux, number_format($row['grupos_multi']) );
					$objPHPExcel->getActiveSheet()->SetCellValue('L'.$aux, number_format($row['grupos_t']) );
					$objPHPExcel->getActiveSheet()->getStyle('D'.$aux.':L'.$aux)->applyFromArray($this->style_contenido);

					$objPHPExcel->getActiveSheet()->getStyle('A'.$aux.':C'.$aux)->applyFromArray($this->style_contenido_first_colum);
					$aux++;
				}

				$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
				$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
				$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
				$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
				$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
				$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
				$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
				$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
				$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
				$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);
				$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setAutoSize(true);
				$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setAutoSize(true);

		// Rename 3nd sheet
		$objPHPExcel->getActiveSheet()->setTitle('Escuelas y grupos');

		// Create a new worksheet, after the default sheet
		$objPHPExcel->createSheet();

		// Add some data to the tercer sheet, resembling some different data types
		$objPHPExcel->setActiveSheetIndex(3);
		$aux=1;

				$objPHPExcel->getActiveSheet()->SetCellValue('A'.$aux, 'Indicadores de Asistencia');
				$objPHPExcel->getActiveSheet()->mergeCells('A'.$aux.':G'.$aux);
				$objPHPExcel->getActiveSheet()->getStyle('A'.$aux.':G'.$aux)->applyFromArray($this->style_titulo);
				$aux++;
				$objPHPExcel->getActiveSheet()->mergeCells('A'.$aux.':G'.$aux);
				$objPHPExcel->getActiveSheet()->getStyle('A'.$aux.':G'.$aux)->applyFromArray($this->style_titulo);
				$aux++;

				$objPHPExcel->getActiveSheet()->SetCellValue('A'.$aux.'', '');
				$aux_letra='B';
				$aux_letra1='';
				foreach ($arr_ciclos_asistencia as $key => $value) {
					$aux_letra1 = $aux_letra;
					$objPHPExcel->getActiveSheet()->SetCellValue($aux_letra.$aux.'', $value['ciclo']);
					$objPHPExcel->getActiveSheet()->mergeCells($aux_letra.$aux.':'.++$aux_letra.$aux);
					++$aux_letra;
				}
				$objPHPExcel->getActiveSheet()->getStyle('A'.($aux).':'.(++$aux_letra1).$aux)->applyFromArray($this->style_encabezado);
				$aux++;
				$objPHPExcel->getActiveSheet()->SetCellValue('A'.$aux.'', 'Nivel');
				$aux_letra='B';
				$aux_letra1='';
				foreach ($arr_ciclos_asistencia as $key => $value) {
					$aux_letra1 = $aux_letra;
				$objPHPExcel->getActiveSheet()->SetCellValue($aux_letra.$aux.'', 'Cobertura');
				$objPHPExcel->getActiveSheet()->SetCellValue(++$aux_letra.$aux.'', 'Absorción');
				++$aux_letra;
			}
			$objPHPExcel->getActiveSheet()->getStyle('A'.($aux).':'.(++$aux_letra1).$aux)->applyFromArray($this->style_encabezado);
			$aux++;

			foreach ($arr_niveles_asistencia as $row) {
				$aux_letra='B';
				$aux_letra1='';
			$objPHPExcel->getActiveSheet()->SetCellValue('A'.$aux.'', $row['nivel']);
			foreach ($arr_ciclos_asistencia as $key => $value) {
				$aux_letra1 = $aux_letra;
				foreach ($result_asistencia_nv as $k => $v) {

					if ($row['nivel'] == $v['nivel'] && $value['ciclo'] == $v['ciclo']) {
						$objPHPExcel->getActiveSheet()->SetCellValue($aux_letra.$aux, (($v['cobertura']=='')?'-':$v['cobertura'].'%') );
						$objPHPExcel->getActiveSheet()->SetCellValue(++$aux_letra.$aux, (($v['absorcion']=='')?'-':$v['absorcion'].'%') );
						++$aux_letra;
					}
				}
			}

			$aux++;
		}

				$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
				$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
				$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
				$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
				$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
				$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
				$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
				// Rename 3nd sheet
				$objPHPExcel->getActiveSheet()->setTitle('Indicadores de Asistencia');

				// Create a new worksheet, after the default sheet
				$objPHPExcel->createSheet();

				// Add some data to the tercer sheet, resembling some different data types
				$objPHPExcel->setActiveSheetIndex(4);
				$aux=1;

				$objPHPExcel->getActiveSheet()->SetCellValue('A'.$aux, 'Indicadores de Permanencia');
				$objPHPExcel->getActiveSheet()->mergeCells('A'.$aux.':J'.$aux);
				$objPHPExcel->getActiveSheet()->getStyle('A'.$aux.':J'.$aux)->applyFromArray($this->style_titulo);
				$aux++;
				$objPHPExcel->getActiveSheet()->SetCellValue('A'.$aux, '');
				$objPHPExcel->getActiveSheet()->mergeCells('A'.$aux.':J'.$aux);
				$objPHPExcel->getActiveSheet()->getStyle('A'.$aux.':J'.$aux)->applyFromArray($this->style_titulo);
				$aux++;


				$aux_letra='B';
				$aux_letra1='';
				foreach ($arr_ciclos_permanencia as $key => $value) {
					$aux_letra1 = $aux_letra;
					$objPHPExcel->getActiveSheet()->SetCellValue($aux_letra.$aux.'', $value['ciclo']);
					++$aux_letra;
					$objPHPExcel->getActiveSheet()->mergeCells($aux_letra1.$aux.':'.(++$aux_letra).$aux);
					++$aux_letra;
				}
				++$aux_letra1;
				$objPHPExcel->getActiveSheet()->getStyle('A'.($aux).':'.(++$aux_letra1).$aux)->applyFromArray($this->style_encabezado);
				$aux++;
				$objPHPExcel->getActiveSheet()->SetCellValue('A'.$aux.'', 'Nivel');
				$aux_letra='B';
				$aux_letra1='';
				foreach ($arr_ciclos_permanencia as $key => $value) {
					$aux_letra1 = $aux_letra;
				$objPHPExcel->getActiveSheet()->SetCellValue($aux_letra.$aux.'', 'Retención');
				$objPHPExcel->getActiveSheet()->SetCellValue(++$aux_letra.$aux.'', 'Aprobación');
				$objPHPExcel->getActiveSheet()->SetCellValue(++$aux_letra.$aux.'', 'Eficiencia Terminal');
				++$aux_letra;
			}
			++$aux_letra1;
			$objPHPExcel->getActiveSheet()->getStyle('A'.($aux).':'.(++$aux_letra1).$aux)->applyFromArray($this->style_encabezado);
			$aux++;

			foreach ($arr_niveles_permanencia as $row) {
				$aux_letra='B';
				$aux_letra1='';
			$objPHPExcel->getActiveSheet()->SetCellValue('A'.$aux.'', $row['nivel']);
			foreach ($arr_ciclos_permanencia as $key => $value) {
				$aux_letra1 = $aux_letra;
				foreach ($result_permanencia_nv as $k => $v) {

					if ($row['nivel'] == $v['nivel'] && $value['ciclo'] == $v['ciclo']) {
						$objPHPExcel->getActiveSheet()->SetCellValue($aux_letra.$aux, (($v['retencion']=='')?'-':$v['retencion'].'%') );
							$objPHPExcel->getActiveSheet()->SetCellValue(++$aux_letra.$aux, (($v['aprobacion']=='')?'-':$v['aprobacion'].'%') );
							$objPHPExcel->getActiveSheet()->SetCellValue(++$aux_letra.$aux, (($v['et']=='')?'-':$v['et'].'%') );
						++$aux_letra;
					}
				}
			}

			$aux++;
		}


			$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);


			// Rename 3nd sheet
			$objPHPExcel->getActiveSheet()->setTitle('Indicadores de Permanencia');

			// Create a new worksheet, after the default sheet
			$objPHPExcel->createSheet();

			// Add some data to the tercer sheet, resembling some different data types
			$objPHPExcel->setActiveSheetIndex(5);
			$aux=1;

			$objPHPExcel->getActiveSheet()->SetCellValue('A'.$aux, 'Indicadores de aprendizaje');
				$objPHPExcel->getActiveSheet()->mergeCells('A'.$aux.':K'.$aux);
				$objPHPExcel->getActiveSheet()->getStyle('A'.$aux.':K'.$aux)->applyFromArray($this->style_titulo);
				$aux++;
				$objPHPExcel->getActiveSheet()->SetCellValue('A'.$aux, 'Resultados de prueba PLANEA 2016');
				$objPHPExcel->getActiveSheet()->mergeCells('A'.$aux.':K'.$aux);
				$objPHPExcel->getActiveSheet()->getStyle('A'.$aux.':K'.$aux)->applyFromArray($this->style_titulo);
				$aux++;
				$objPHPExcel->getActiveSheet()->SetCellValue('A'.$aux, 'Nivel educativo');
				$objPHPExcel->getActiveSheet()->mergeCells('A'.$aux.':A'.($aux+2));
				$objPHPExcel->getActiveSheet()->SetCellValue('B'.$aux, 'Lenguaje y Comunicación');
				$objPHPExcel->getActiveSheet()->SetCellValue('G'.$aux, 'Matemáticas');
				$objPHPExcel->getActiveSheet()->mergeCells('B'.$aux.':F'.$aux);
				$objPHPExcel->getActiveSheet()->mergeCells('G'.$aux.':K'.$aux);
				$aux++;
				$objPHPExcel->getActiveSheet()->SetCellValue('B'.$aux, 'Nivel de dominio');
				$objPHPExcel->getActiveSheet()->SetCellValue('G'.$aux, 'Nivel de dominio');
				$objPHPExcel->getActiveSheet()->SetCellValue('F'.$aux, 'Porcentaje de alumnos con nivel bueno y excelente');
				$objPHPExcel->getActiveSheet()->SetCellValue('K'.$aux, 'Porcentaje de alumnos con nivel bueno y excelente');
				$objPHPExcel->getActiveSheet()->mergeCells('B'.$aux.':E'.$aux);
				$objPHPExcel->getActiveSheet()->mergeCells('G'.$aux.':J'.$aux);
				$objPHPExcel->getActiveSheet()->mergeCells('F'.$aux.':F'.($aux+1));
				$objPHPExcel->getActiveSheet()->mergeCells('K'.$aux.':K'.($aux+1));
				$aux++;
				$objPHPExcel->getActiveSheet()->SetCellValue('B'.$aux, 'I Insuficiente');
				$objPHPExcel->getActiveSheet()->SetCellValue('C'.$aux, 'II Elemental');
				$objPHPExcel->getActiveSheet()->SetCellValue('D'.$aux, 'III Bueno');
				$objPHPExcel->getActiveSheet()->SetCellValue('E'.$aux, 'IV Excelente');

				$objPHPExcel->getActiveSheet()->SetCellValue('G'.$aux, 'I Insuficiente');
				$objPHPExcel->getActiveSheet()->SetCellValue('H'.$aux, 'II Elemental');
				$objPHPExcel->getActiveSheet()->SetCellValue('I'.$aux, 'III Bueno');
				$objPHPExcel->getActiveSheet()->SetCellValue('J'.$aux, 'IV Excelente');

				$objPHPExcel->getActiveSheet()->getStyle('A'.($aux-2).':K'.$aux)->applyFromArray($this->style_encabezado);
				$aux++;
				foreach ($result_planea as $row) {
					$objPHPExcel->getActiveSheet()->SetCellValue('A'.$aux, ($row['nivel']) );
					$objPHPExcel->getActiveSheet()->SetCellValue('B'.$aux, ($row['ni_lyc']).'%' );
					$objPHPExcel->getActiveSheet()->SetCellValue('C'.$aux, ($row['nii_lyc']).'%' );
					$objPHPExcel->getActiveSheet()->SetCellValue('D'.$aux, ($row['niii_lyc']).'%' );
					$objPHPExcel->getActiveSheet()->SetCellValue('E'.$aux, ($row['niv_lyc']).'%' );
					$objPHPExcel->getActiveSheet()->SetCellValue('F'.$aux, ($row['niii_lyc']+$row['niv_lyc']).'%' );
					$objPHPExcel->getActiveSheet()->SetCellValue('G'.$aux, ($row['ni_mat']).'%' );
					$objPHPExcel->getActiveSheet()->SetCellValue('H'.$aux, ($row['nii_mat']).'%' );
					$objPHPExcel->getActiveSheet()->SetCellValue('I'.$aux, ($row['niii_mat']).'%' );
					$objPHPExcel->getActiveSheet()->SetCellValue('J'.$aux, ($row['niv_mat']).'%' );
					$objPHPExcel->getActiveSheet()->SetCellValue('K'.$aux, ($row['niii_mat']+$row['niv_mat']).'%' );
					$objPHPExcel->getActiveSheet()->getStyle('B'.$aux.':K'.$aux)->applyFromArray($this->style_contenido);
					$objPHPExcel->getActiveSheet()->getStyle('A'.$aux.':A'.$aux)->applyFromArray($this->style_contenido_first_colum);
					$aux++;
				}
			$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setAutoSize(true);

			// Rename 3nd sheet
			$objPHPExcel->getActiveSheet()->setTitle('Indicadores de Aprendisaje');

			// Create a new worksheet, after the default sheet
			$objPHPExcel->createSheet();

			// Add some data to the tercer sheet, resembling some different data types
			$objPHPExcel->setActiveSheetIndex(6);
			$aux=1;

			$objPHPExcel->getActiveSheet()->SetCellValue('A'.$aux, 'Rezago educativo');
				$objPHPExcel->getActiveSheet()->mergeCells('A'.$aux.':G'.$aux);
				$objPHPExcel->getActiveSheet()->getStyle('A'.$aux.':G'.$aux)->applyFromArray($this->style_titulo);
				$aux++;
				$objPHPExcel->getActiveSheet()->SetCellValue('A'.$aux, 'Población por grupo de edad que no asiste a la escuela');
				$objPHPExcel->getActiveSheet()->SetCellValue('B'.$aux, 'Población total');
				$objPHPExcel->getActiveSheet()->SetCellValue('E'.$aux, 'Población que no asiste a la escuela');
				$objPHPExcel->getActiveSheet()->mergeCells('A'.$aux.':A'.($aux+1));
				$objPHPExcel->getActiveSheet()->mergeCells('B'.$aux.':D'.($aux));
				$objPHPExcel->getActiveSheet()->mergeCells('E'.$aux.':G'.($aux));
				$aux++;
				$objPHPExcel->getActiveSheet()->SetCellValue('B'.$aux, 'Mujeres');
				$objPHPExcel->getActiveSheet()->SetCellValue('C'.$aux, 'Hombres');
				$objPHPExcel->getActiveSheet()->SetCellValue('D'.$aux, 'Total');
				$objPHPExcel->getActiveSheet()->SetCellValue('E'.$aux, 'Mujeres');
				$objPHPExcel->getActiveSheet()->SetCellValue('F'.$aux, 'Hombres');
				$objPHPExcel->getActiveSheet()->SetCellValue('G'.$aux, 'Total');
				$objPHPExcel->getActiveSheet()->getStyle('A'.($aux-1).':G'.$aux)->applyFromArray($this->style_encabezado);
				$aux++;
				$temp=$aux;
				foreach ($result_rezinegi as $row) {
					$objPHPExcel->getActiveSheet()->SetCellValue('A'.$aux, ('3 a 14 años') );
					$objPHPExcel->getActiveSheet()->SetCellValue('B'.$aux, number_format($row['p3A14_ptotal_h']) );
					$objPHPExcel->getActiveSheet()->SetCellValue('C'.$aux, number_format($row['p3A14_ptotal_m']) );
					$objPHPExcel->getActiveSheet()->SetCellValue('D'.$aux, number_format($row['p3A14_ptotal_h']+$row['p3A14_ptotal_m']) );
					$objPHPExcel->getActiveSheet()->SetCellValue('E'.$aux, number_format($row['p3A14_noa_h']) );
					$objPHPExcel->getActiveSheet()->SetCellValue('F'.$aux, number_format($row['p3A14_noa_m']) );
					$objPHPExcel->getActiveSheet()->SetCellValue('G'.$aux, number_format($row['p3A14_noa_h']+$row['p3A14_noa_m']) );
					$objPHPExcel->getActiveSheet()->SetCellValue('H'.$aux, "INEGI ".($row['anio']) );
					$objPHPExcel->getActiveSheet()->getStyle('A'.$temp.':G'.$aux)->applyFromArray($this->style_contenido);
					$aux++;
				}

			$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);

			// Rename 3nd sheet
			$objPHPExcel->getActiveSheet()->setTitle('Rezago Educativo');

			// Create a new worksheet, after the default sheet
			$objPHPExcel->createSheet();

			// Add some data to the tercer sheet, resembling some different data types
			$objPHPExcel->setActiveSheetIndex(7);
			$aux=1;

			$objPHPExcel->getActiveSheet()->SetCellValue('A'.$aux, 'Analfabetismo');
				$objPHPExcel->getActiveSheet()->mergeCells('A'.$aux.':D'.$aux);
				$objPHPExcel->getActiveSheet()->getStyle('A'.$aux.':D'.$aux)->applyFromArray($this->style_titulo);

				$aux++;
				$objPHPExcel->getActiveSheet()->SetCellValue('B'.$aux, 'Mujeres');
				$objPHPExcel->getActiveSheet()->SetCellValue('C'.$aux, 'Hombres');
				$objPHPExcel->getActiveSheet()->SetCellValue('D'.$aux, 'Total');
				$objPHPExcel->getActiveSheet()->getStyle('A'.($aux-1).':D'.$aux)->applyFromArray($this->style_encabezado);
				$aux++;
				$temp=$aux;

				foreach ($result_analfinegi as $row) {
					$objPHPExcel->getActiveSheet()->SetCellValue('A'.$aux, ('Población mayor de 15 años que no saben leer ni escribir') );
					$objPHPExcel->getActiveSheet()->SetCellValue('B'.$aux, number_format($row['analfabetismo_mayor15_h']) );
					$objPHPExcel->getActiveSheet()->SetCellValue('C'.$aux, number_format($row['analfabetismo_mayor15_m']) );
					$objPHPExcel->getActiveSheet()->SetCellValue('D'.$aux, number_format($row['analfabetismo_mayor15_h']+$row['analfabetismo_mayor15_m']) );
					$objPHPExcel->getActiveSheet()->SetCellValue('E'.$aux, "INEGI ".($row['anio']) );

					$objPHPExcel->getActiveSheet()->getStyle('B'.$temp.':D'.$aux)->applyFromArray($this->style_contenido);

					$objPHPExcel->getActiveSheet()->getStyle('A'.$aux.':A'.$aux)->applyFromArray($this->style_contenido_first_colum);
					$aux++;
				}
			$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
		// Rename 3nd sheet
			$objPHPExcel->getActiveSheet()->setTitle('Analfabetismo');
			$objPHPExcel->setActiveSheetIndexByName('Estadística e indicadores');
		date_default_timezone_set('America/Mexico_City');
		$hoy = date("Y-m-d_H-i-s");
		$name_file = "Estadistica_e_indicadores_generales_".$hoy.'.xls';

		$this->downloand_file($objPHPExcel,$name_file);
	}



	public function escuelas(){
		$idmunicipio = $this->input->post('busquedalista_municipio_reporte');
		$idnivel = $this->input->post('busquedalista_nivel_reporte');
		$idsostenimiento = $this->input->post('busquedalista_sostenimiento_reporte');
		$nombre_cct = $this->input->post('busquedalista_nombreescuela_reporte');

		$array=$this->Estadistica_model->escuelas($idmunicipio,$idnivel,$idsostenimiento,$nombre_cct,'');


				$obj_excel = new PHPExcel();
				$obj_excel->getActiveSheet()->SetCellValue('A1', 'Lista de escuelas');
				$obj_excel->getActiveSheet()->SetCellValue('A2', 'CCT');
				$obj_excel->getActiveSheet()->SetCellValue('B2', 'Turno');
				$obj_excel->getActiveSheet()->SetCellValue('C2', 'Nombre');
				$obj_excel->getActiveSheet()->SetCellValue('D2', 'Nivel');
				$obj_excel->getActiveSheet()->SetCellValue('E2', 'Municipio');

				$obj_excel->getActiveSheet()->mergeCells('A1:E1');
				$obj_excel->getActiveSheet()->getStyle('A1:E1')->applyFromArray($this->style_titulo);
				$obj_excel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
				$obj_excel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
				$obj_excel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
				$obj_excel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
				$obj_excel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
				$obj_excel->getActiveSheet()->getStyle('A2:E2')->applyFromArray($this->style_encabezado);

				$aux = 3;
				foreach ($array as $row) {
					$obj_excel->getActiveSheet()->SetCellValue('A'.$aux, ($row['cct']) );
					$obj_excel->getActiveSheet()->SetCellValue('B'.$aux, ($row['turno']) );
					$obj_excel->getActiveSheet()->SetCellValue('C'.$aux, ($row['nombre']) );
					$obj_excel->getActiveSheet()->SetCellValue('D'.$aux, ($row['nivel']) );
					$obj_excel->getActiveSheet()->SetCellValue('E'.$aux, ($row['municipio']) );
					$obj_excel->getActiveSheet()->getStyle('A'.$aux.':E'.$aux)->applyFromArray($this->style_contenido_first_colum);
					$aux++;
				}
				date_default_timezone_set('America/Mexico_City');
				$hoy = date("Y-m-d_H-i-s");
				$name_file = "Reporte_escuelas_".$hoy.'.xls';
				$this->downloand_file($obj_excel,$name_file);

	}//escuelas

}// ReportesS
