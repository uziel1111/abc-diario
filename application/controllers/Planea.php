<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Planea extends CI_Controller {

		function __construct() {
			parent::__construct();
			$this->load->model('Planea_model');
		}
		public function index(){
					$data = array();
					$data2= array();
					$municipios = $this->Generico_model->municipios();
					$arr_municipios['0'] = 'TODOS';
					foreach ($municipios as $municipio){
						 $arr_municipios[$municipio['idmunicipio']] = $municipio['nombre'];
					}
					// NIVEL POR PLANEA MUN
					$arr_niveles['0'] = 'SELECCIONE';
					$arr_niveles['2'] = 'PRIMARIA';
					$arr_niveles['3'] = 'SECUNDARIA';

					//CAMPOS DICIPLINARIOS
					$arr_campod['0'] = 'SELECCIONE';
					$arr_campod['1'] = 'Lenguaje y comunicación';
					$arr_campod['2'] = 'Matemáticas';

					$periodos = $this->Generico_model->periodos_planeaxreactivo();

					$arr_periodos['0'] = 'SELECCIONE';
					foreach ($periodos as $periodo){
						 $arr_periodos[$periodo['id_periodo']] = $periodo['periodo'];
					}
					$data2['municipios'] = $arr_municipios;
					$data2['niveles'] = $arr_niveles;
					$data2['camposd'] = $arr_campod;
					$data2['periodos'] = $arr_periodos;
					$string = $this->load->view('planea/buscador_estmuni', $data2, TRUE);
					$data['buscador'] = $string;
					carga_pagina_basica($this,$data,'planea/index');
				}// index()

public function obtener_niveles_xidmunicipio(){
	$idmunicipio = $this->input->post('idmunicipio');
	$niveles = $this->Planea_model->obtener_nivel_xidmunicipio($idmunicipio);
	$str_select = '<option value=0>SELECCIONE</option>';
	foreach ($niveles as $key => $value) {
		$str_select .= "<option value={$value['idnivel']}> {$value['nombre']} </option>";
	}
	$respuesta = array('options' => $str_select);
	envia_datos_json($this, $respuesta);
	exit();
}//obtener_niveles_xidmunicipio

public function obtener_perido_xidmunicipio_xidnivel(){
	$idmunicipio = $this->input->post('idmunicipio');
	$idnivel = $this->input->post('idnivel');
	$niveles = $this->Planea_model->obtener_perido_xidmunicipio_xidnivel($idmunicipio, $idnivel);
	$str_select = '<option value=0>SELECCIONE</option>';
	foreach ($niveles as $key => $value) {
		$str_select .= "<option value={$value['id_periodo']}> {$value['periodo']} </option>";
	}
	$respuesta = array('options' => $str_select);
	envia_datos_json($this, $respuesta);
	exit();
}//obtener_perido_xidmunicipio_xidnivel



public function obtener_grafica_xestadomunicipio(){
			$municipio = $this->input->post("idmunicipio");
			$nivel = $this->input->post("nivel");
			$periodo = $this->input->post("periodo");
			$campodisip = $this->input->post("campodisip");
			$datos = $this->Planea_model->estadisticas_x_estadomunicipio($municipio, $nivel, $periodo, $campodisip);
			$periodoplanea = $this->Planea_model->obtener_periodoplane_xidperiodo($periodo);

			$respuesta = array('datos' => $datos, 'id_municipio' => $municipio, 'nivel' => $nivel, 'periodoplanea' => $periodoplanea, 'campodisip' => $campodisip);

			envia_datos_json($this, $respuesta);
			exit();
		}
		public function planea_xcont_xmunicipio(){
			$id_contenido = $this->input->post("id_cont");
		    $datos = $this->Planea_model->obtener_reactivos_xcont_municipio($id_contenido);
				$respuesta = array('graph_cont_reactivos_xcctxcont' => $datos);

				envia_datos_json($this, $respuesta);
				exit();
		}

		public function bucador_zona()//corregir nombre plisss...
		{
			// NIVEL POR PLANEA
			$arr_niveles = $this->Planea_model->niveles_zona();
			//SOSTENIMIENTOS
			$arr_sostenimiento = $this->Planea_model->sostenimiento_zona();

			$arr_zonas = $this->Planea_model->zonas_zona();

					//CAMPOS DICIPLINARIOS
					$arr_campod['0'] = array('id' =>'1' , 'nombre' => 'Lenguaje y comunicación');
					$arr_campod['1'] = array('id' =>'2' , 'nombre' => 'Matemáticas');
					//PERIODOS
					$arr_periodos = $this->Generico_model->periodos_planeaxreactivo();

					$data2['niveles'] = $arr_niveles;
					$data2['sostenimiento'] = $arr_sostenimiento;
					$data2['zona'] = $arr_zonas;
					$data2['camposd'] = $arr_campod;
					$data2['periodos'] = $arr_periodos;
					// echo "<pre>";print_r($data2);die();
					$filtros = $this->load->view('planea/buscador_zona', $data2, TRUE);


					$response = array('filtros'=>$filtros);
					envia_datos_json($this,$response);
					exit;
		}//bucador_zona

		public function obtener_grafica_xestadozona()
		{
			$zona = $this->input->post("zona");
			$nivel = $this->input->post("nivel");
			$periodo = $this->input->post("periodo");
			$sostenimiento = $this->input->post("sostenimiento");
			$campodisip = $this->input->post("campodisip");
			$datos = $this->Planea_model->estadisticas_x_estadozona($zona, $sostenimiento, $nivel, $periodo, $campodisip);
			// echo "<pre>";print_r($campodisip);die();
			$periodoplanea = $this->Planea_model->obtener_periodoplane_xidperiodo($periodo);
			$respuesta = array('datos' => $datos, 'zona' => $zona, 'nivel' => $nivel, 'periodoplanea' => $periodoplanea, 'campodisip' => $campodisip);
			envia_datos_json($this, $respuesta);
			exit();
		}//obtener_grafica_xestadozona

		public function obtener_sostenimiento_xidnivel_zona()
		{
			$idnivel = $this->input->post("idnivel");
			$arr_sostenimiento = $this->Planea_model->sostenimiento_zona($idnivel);
			$str_select = "<option value='-1'  disabled='true' selected='true'>SELECCIONE UN SOSTENIMIENTO</option>";
			foreach ($arr_sostenimiento as $key => $value) {
				$str_select .= "<option value={$value['idsostenimiento']}> {$value['nombre']} </option>";
			}
			$respuesta = array('str_select' => $str_select);
			envia_datos_json($this, $respuesta);
			exit();
		}//obtener_sostenimiento_xidnivel_zona

		public function obtener_zona_xidnivel_sos_zona()
		{
			$idnivel = $this->input->post("idnivel");
			$idsostenimiento = $this->input->post("idsostenimiento");
			$arr_zona = $this->Planea_model->zonas_zona($idnivel,$idsostenimiento);
			$str_select = "<option value='0' disabled='true' selected='true'>SELECCIONE UNA ZONA ESCOLAR</option>";
			foreach ($arr_zona as $key => $value) {
				$str_select .= "<option value={$value['cct_supervisor']}> {$value['zona_escolar']} </option>";
			}
			$respuesta = array('str_select' => $str_select);
			envia_datos_json($this, $respuesta);
			exit();
		}//obtener_zona_xidnivel_sos_zona

		public function obtener_periodo_xidnivel_sos_zona()
		{
			$idnivel = $this->input->post("idnivel");
			$idsostenimiento = $this->input->post("idsostenimiento");
			$zona = $this->input->post("zona");
			$arr_periodo = $this->Planea_model->periodo_zona($idnivel,$idsostenimiento,$zona);
			$str_select = "<option value='0'  disabled='true' selected='true'>SELECCIONE UN PERIODO</option>";
			foreach ($arr_periodo as $key => $value) {
				$str_select .= "<option value={$value['id_periodo']}> {$value['periodo']} </option>";
			}
			$respuesta = array('str_select' => $str_select);
			envia_datos_json($this, $respuesta);
			exit();
		}//obtener_periodo_xidnivel_sos_zona

	}// Planea
