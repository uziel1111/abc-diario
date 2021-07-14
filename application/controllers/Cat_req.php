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
      $nivel = str_replace("%20", " ", $nivel);
      $nivel = str_replace("%C3%B3", "ó", $nivel);
      $nivel = str_replace("%C3%AD", "í", $nivel);
      $arr_requerimeintos = $this->Catreq_model->obtener_requerimientos($nivel);
      $data['arr_requerimeintos']=$arr_requerimeintos;
      $data['nivel']=$nivel;
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
      $data['folio'] = $folio;
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

    public function dom_pdf() {
      $data = array();
    	$folio = $this->input->post('folio');
      $arr_detalles = $this->Catreq_model->obtener_detalles_xfolio($folio);

      $filename = 'Detalles_'.date('d-m-Y h:i:s', time()).'.pdf';
        $this->load->library('My_tcpdf');
        $pdf = new My_tcpdf('P', 'mm', 'LETTER', true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('PE');
        $pdf->SetTitle($filename);
        $pdf->SetSubject('');
        $pdf->SetKeywords('');
        // add a page
        $pdf->SetFont('', '', 10);
        $pdf->SetAutoPageBreak(TRUE, 0);

        $pdf->AddPage('P', 'LETTER');
        $area = str_replace(',',' ',str_replace('Otro <input type="text" name="otro_input">', "",$arr_detalles->area_solicitante));
        $str_htm = '';
        $str_htm .= <<<EOT
                <div style="color: #526542; background-color: #ebf3e5; border-color: #e4eedb;" role="alert">
                    <span style="color: #6c757d !important;">Nombre del requerimiento: </span><br> {$arr_detalles->nombre_requierimiento}
                </div>
                <div style="color: #526542; background-color: #ebf3e5; border-color: #e4eedb;" role="alert">
                    <span style="color: #6c757d !important;">Descripción del requerimiento: </span><br> {$arr_detalles->descripcion_req}
                </div>
                <div style="color: #526542; background-color: #ebf3e5; border-color: #e4eedb;" role="alert">
                    <span style="color: #6c757d !important;">Área que lo solicita a la escuela: </span><br> {$area}
                </div>
                <div style="color: #526542; background-color: #ebf3e5; border-color: #e4eedb;" role="alert">
                    <span style="color: #6c757d !important;">Forma de generar el requerimiento: </span><br> {$arr_detalles->forma_de_generar}
                </div>
                <div style="color: #526542; background-color: #ebf3e5; border-color: #e4eedb;" role="alert">
                    <span style="color: #6c757d !important;">Dirección URL: </span><br> {$arr_detalles->url_si_sistema}
                </div>
                <div style="color: #526542; background-color: #ebf3e5; border-color: #e4eedb;" role="alert">
                    <span style="color: #6c757d !important;">Nivel educativo: </span><br> {$arr_detalles->niveles}
                </div>
                <div style="color: #526542; background-color: #ebf3e5; border-color: #e4eedb;" role="alert">
                    <span style="color: #6c757d !important;">Forma de entregar el requerimiento: </span><br> {$arr_detalles->forma_entregar_req}
                </div>
                <div style="color: #526542; background-color: #ebf3e5; border-color: #e4eedb;" role="alert">
                    <span style="color: #6c757d !important;">¿Se requiere oficio para entregar requerimiento?</span><br> {$arr_detalles->se_requiere_oficio}
                </div>
                <div style="color: #526542; background-color: #ebf3e5; border-color: #e4eedb;" role="alert">
                    <span style="color: #6c757d !important;">Periodicidad: </span><br> {$arr_detalles->periodicidad}
                </div>
                <div style="color: #526542; background-color: #ebf3e5; border-color: #e4eedb;" role="alert">
                    <span style="color: #6c757d !important;">Meses en que se entrega: </span><br> {$arr_detalles->fechas_entrega}
                </div>
                <div style="color: #526542; background-color: #ebf3e5; border-color: #e4eedb;" role="alert">
                    <span style="color: #6c757d !important;">¿Qué función tiene?</span><br> {$arr_detalles->utilidad}
                </div>
                <div style="color: #526542; background-color: #ebf3e5; border-color: #e4eedb;" role="alert">

                    <span style="color: #6c757d !important;">Fundamento legal: </span><br> {$arr_detalles->fudamento_legal}
                </div>
                <div style="color: #526542; background-color: #ebf3e5; border-color: #e4eedb;" role="alert">
                    <span style="color: #6c757d !important;">¿Se solicitan anexos?</span><br> {$arr_detalles->con_anexos}
                </div>
EOT;
      if ($arr_detalles->con_anexos == 'Sí'){
        $str_htm .= <<<EOT
                <div style="color: #526542; background-color: #ebf3e5; border-color: #e4eedb;" role="alert">
                    <span style="color: #6c757d !important;">Anexos: </span><br> {$arr_detalles->especifica_anexo}
                </div>
EOT;
      }
      $str_htm .= <<<EOT
                <div style="color: #526542; background-color: #ebf3e5; border-color: #e4eedb;" role="alert">
                    <span style="color: #6c757d !important;">Tipo de sostenimiento: </span><br> {$arr_detalles->sostenimiento}
                </div>
                <div style="color: #526542; background-color: #ebf3e5; border-color: #e4eedb;" role="alert">
                    <span style="color: #6c757d !important;">Descripción de la mejora: </span><br> {$arr_detalles->acc_mejora_implementada}
                </div>
EOT;
        $pdf->writeHTMLCell($w=200,$h=10,$x=10,$y=10, $str_htm, $border=0, $ln=1, $fill=0, $reseth=true, $aligh='L', $autopadding=false);
        $pdf->Output($filename, 'D');
    }//

}
