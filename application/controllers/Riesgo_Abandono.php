<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Riesgo_Abandono extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('Riesgo_abandono_model');
		$this->load->model('Generico_model');
	}

	public function vista_principal_riesgo() {
    	$data = array();
    	$ciclo=$this->Generico_model->ciclo_escolar();
    	$municipios=$this->Generico_model->municipios();
    	$nivel=$this->Generico_model->niveles();
    	$data['ciclo']=$ciclo;
    	$data['nivel']=$nivel;
    	$data['municipios']=$municipios;
		carga_pagina_basica($this,$data,'Riesgo/filtro_riesgo');
    }//vista_principal_riesgo

    public function obtener_riesgo_xmunicipioxnivelxcicloxperiodo(){
    	$idmunicipio = $this->input->post('municipio');
	    $idnivel = $this->input->post('nivel');
	    $ciclo = $this->input->post('ciclo');
	    $idperiodo = $this->input->post('periodo');
	    $muy_alto=0;
	    $alto=0;
	    $medio=0;
	    $bajo=0;
	    $ciclo_corto = trae_ciclo_corto($ciclo);
	    $riesgo = $this->Riesgo_abandono_model->obtener_riesgo_xmunicipioxnivelxcicloxperiodo($idmunicipio,$idnivel,$ciclo_corto,$idperiodo);
      	$array_muy_alto=array();
      	$array_alto=array();
      	$muy_alto1=0;
      	$muy_alto2=0;
      	$muy_alto3=0;
      	$muy_alto4=0;
      	$muy_alto5=0;
      	$muy_alto6=0;
      	$alto1=0;
      	$alto2=0;
      	$alto3=0;
      	$alto4=0;
      	$alto5=0;
      	$alto6=0;
      	$total_alumnnos=0;
      	$total_alumnnos_riesgo=0;
      	if(count($riesgo)){
      		$muy_alto=$riesgo[0]['muy_alto'];
			$alto=$riesgo[0]['alto'];
			$medio=$riesgo[0]['medio'];
			$bajo=$riesgo[0]['bajo'];
	      	$muy_alto1=$riesgo[0]['muy_alto1'];
	      	$muy_alto2=$riesgo[0]['muy_alto2'];
	      	$muy_alto3=$riesgo[0]['muy_alto3'];
	      	$muy_alto4=$riesgo[0]['muy_alto4'];
	      	$muy_alto5=$riesgo[0]['muy_alto5'];
	      	$muy_alto6=$riesgo[0]['muy_alto6'];
	      	$alto1=$riesgo[0]['alto1'];
	      	$alto2=$riesgo[0]['alto2'];
	      	$alto3=$riesgo[0]['alto3'];
	      	$alto4=$riesgo[0]['alto4'];
	      	$alto5=$riesgo[0]['alto5'];
	      	$alto6=$riesgo[0]['alto6'];
	      	$total_alumnos_riesgo=intval($riesgo[0]['total']);
	      	$total_alumnos=intval($muy_alto1)+intval($muy_alto2)+intval($muy_alto3)+intval($muy_alto4)+intval($muy_alto5)+intval($muy_alto6)+intval($alto1)+intval($alto2)+intval($alto3)+intval($alto4)+intval($alto5)+intval($alto6);
      	}
      	array_push($array_muy_alto,intval($muy_alto1));
      	array_push($array_muy_alto,intval($muy_alto2));
      	array_push($array_muy_alto,intval($muy_alto3));
      	array_push($array_muy_alto,intval($muy_alto4));
      	array_push($array_muy_alto,intval($muy_alto5));
      	array_push($array_muy_alto,intval($muy_alto6));
      	array_push($array_alto,intval($alto1));
      	array_push($array_alto,intval($alto2));
      	array_push($array_alto,intval($alto3));
      	array_push($array_alto,intval($alto4));
      	array_push($array_alto,intval($alto5));
      	array_push($array_alto,intval($alto6));
     
      	$respuesta = array("muy_alto" => intval($muy_alto),"alto" => intval($alto),"medio" => intval($medio),"bajo" => intval($bajo),"array_muy_alto" => $array_muy_alto,"array_alto" => $array_alto,"total_alumnos" => intval($total_alumnos),"total_alumnos_riesgo"=>$total_alumnos_riesgo);
      	envia_datos_json($this, $respuesta);
      	exit();
    }

 

}// Riesgo de Abandono