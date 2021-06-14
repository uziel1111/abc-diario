<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Cat_req extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Catreq_model');
    }

    function index() {
    	$data = array();
      $num_xnivel = $this->Catreq_model->obtener_num_xnivel();
      $data['num_xnivel']=$num_xnivel;
      // echo "<pre>";print_r($data);die();
      carga_pagina_basica($this,$data,'cat_req/index.php');
    }

    function resultado($nivel) {

      $data = array();
      $arr_requerimeintos = $this->Catreq_model->obtener_requerimientos($nivel);
      $data['arr_requerimeintos']=$arr_requerimeintos;
      // echo "<pre>";print_r($data);die();
      carga_pagina_basica($this,$data,'cat_req/resultado.php');
    }

    public function ver_documento() {
    	$folio = $this->input->post('folio');
			$url =$this->Catreq_model->trae_url_xfolio($folio);
  		$respuesta = array("source" => 'https://abcdiario.org/levantamiento_de_requerimientos/'.$url);
  		envia_datos_json($this, $respuesta);
  		exit();
    }//

    public function ver_detalle() {
    	$data = array();
    	$folio = $this->input->post('folio');
    	$arr_detalles = $this->Catreq_model->obtener_detalles_xfolio($folio);
      $data['arr_detalles'] = $arr_detalles;
      // echo "<pre>";print_r($data);die();
      $string = $this->load->view('cat_req/detalles', $data, TRUE);
  		$respuesta = array("string" => $string);
  		envia_datos_json($this, $respuesta);
  		exit();
    }//

    public function ver_contacto() {
      $data = array();
    	$folio = $this->input->post('folio');
    	$arr_contacto = $this->Catreq_model->obtener_contacto_xfolio($folio);
      // $arr_contacto = array();
      $data['arr_contacto'] = $arr_contacto;
      $string = $this->load->view('cat_req/contacto', $data, TRUE);
  		$respuesta = array("string" => $string);
  		envia_datos_json($this, $respuesta);
		exit();
    }//

}
