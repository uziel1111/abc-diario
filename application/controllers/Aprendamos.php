<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Aprendamos extends CI_Controller {

		function __construct() {
			parent::__construct();
			$this->load->model('Planea_model');
		}
		public function index($seccion = null){
					$data = array();
					$data2= array();
					$municipios = $this->Generico_model->municipios();
					$arr_municipios['0'] = 'SELECCIONE';
					foreach ($municipios as $municipio){
						 $arr_municipios[$municipio['idmunicipio']] = $municipio['nombre'];
					}

					$periodos = $this->Generico_model->periodos_aprendizaje();

					foreach ($periodos as $periodo){
						 $arr_periodos[$periodo['periodo_planea']] = $periodo['periodo_planea'];
					}
					$data2['municipios'] = $arr_municipios;
					$data2['periodos'] = $arr_periodos;
					$string = $this->load->view('aprendizaje/buscador_estmuni', $data2, TRUE);
					$data['buscador'] = $string;
					$subsistemas= $this->Generico_model->subsistemas_aprendizaje();
					$arr_subsistemas['0'] = 'SELECCIONE';
					foreach ($subsistemas as $subsistema){
						 $arr_subsistemas[$subsistema['subsistema']] = $subsistema['subsistema'];
					}
					$data2['subsistemas'] = $arr_subsistemas;
					$string_z = $this->load->view('aprendizaje/buscador_zona', $data2, TRUE);
					$data['buscador_z'] = $string_z;

					carga_pagina_basica($this,$data,'aprendizaje/index');
				}// index()


	public function obtener_tabla_xidmunicipio_periodo(){
		$municipio = $this->input->post("idmunicipio");
		$diagnostico_muni = $this->Planea_model->diagnosticoall_x_estadomunicipio($municipio);
		$diagnostico_estado = $this->Planea_model->diagnosticoall_x_estadomunicipio(0);
		$data = array('diagnostico_muni' => $diagnostico_muni, 'diagnostico_estado' => $diagnostico_estado);

	  $str_vista = $this->load->view('aprendizaje/tabla_nlogro_diagnostico',$data, TRUE);
		$respuesta = array('str_vista' => $str_vista);

		envia_datos_json($this, $respuesta);
		exit();
	}

	public function obtener_tabla_xsubsistema_periodo(){
		$subsistema = $this->input->post("subsistema");
		$diagnostico_subs = $this->Planea_model->diagnosticoall_x_subsistema($subsistema);
		$diagnostico_estado = $this->Planea_model->diagnosticoall_x_estadomunicipio(0);
		$data = array('diagnostico_subs' => $diagnostico_subs, 'diagnostico_estado' => $diagnostico_estado);

	  $str_vista = $this->load->view('aprendizaje/tabla_nlogro_diagnostico',$data, TRUE);
		$respuesta = array('str_vista' => $str_vista);

		envia_datos_json($this, $respuesta);
		exit();
	}


	}// Planea
