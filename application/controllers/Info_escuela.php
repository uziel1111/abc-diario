<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Info_escuela extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Estadistica_model');
        $this->load->model('Generico_model');
        $this->load->model('Planea_model');
    }//_construct

    function busqueda_general() {

      $data=array();
      $ciclo=$this->Generico_model->ciclo_escolar();
      $municipios=$this->Generico_model->municipios();
      $nivel=$this->Generico_model->niveles();
      $sostenimiento=$this->Generico_model->sostenimientos();
      $data['municipios']=$municipios;
      $data['nivel'] = $nivel;
      $data['sostenimiento'] = $sostenimiento;

      carga_pagina_basica($this,$data,'escuela/busqueda_escuela');
        
    }//busqueda_especifica

    function lista_escuelas() {
      $idmunicipio = $this->input->post('municipio');
      $idsostenimiento = $this->input->post('sostenimiento');
      $idnivel = $this->input->post('nivel');
      $nombre_cct =  $this->input->post('nombre_cct');
      $cct =  $this->input->post('cct');
      $municipio="";
      $nivel="";
      $sostenimiento="";
      if($idmunicipio>0){
        $municipio= $this->Generico_model->obtener_nombre_municipio($idmunicipio);
        $municipio=$municipio[0]['nombre'];
      }
      if($idnivel>0){
        $nivel = $this->Generico_model->obtener_nombre_nivel($idnivel);
        $nivel=$nivel[0]['nombre'];
      }
      if($idsostenimiento!=-1){
        $sostenimiento = $this->Generico_model->obtener_nombre_sostenimiento($idsostenimiento);
        $sostenimiento=$sostenimiento[0]['nombre'];
      }
      
      
      $data=array();
      $escuelas=$this->Estadistica_model->escuelas($idmunicipio,$idnivel,$idsostenimiento,$nombre_cct,$cct);
      $data['escuelas'] = $escuelas;
      $data["municipio"] = $municipio;
      $data["nivel"] = $nivel;
      $data["sostenimiento"] = $sostenimiento;
      $data['idnivel'] = $idnivel;
      $data['cct'] = $cct;
      $data['idmunicipio'] = $idmunicipio;
      $data['total_escuelas'] = count($escuelas);
      $data['idsostenimiento'] = $idsostenimiento;
      $data['nombre_escuela'] = $nombre_cct;
      $vista = $this->load->view("escuela/lista_escuelas",$data,TRUE);
      $respuesta = array("vista" => $vista);
      envia_datos_json($this, $respuesta);
      exit();
        
    }//busqueda_especifica

    function busqueda_especifica($cct) {
        
        $ciclo = trae_ciclo_actual();

        $datos_alumnos = $this->Estadistica_model->datos_escuela_alumnos($cct,$ciclo);
        $datos_grupo = $this->Estadistica_model->datos_escuela_grupos($cct,$ciclo);
        $datos_docentes = $this->Estadistica_model->datos_escuela_docentes($cct,$ciclo);

        $data['grados']  = $datos_alumnos;
        $data['grupos']  = $datos_grupo;
        $data['docentes']  = $datos_docentes;

        return $data;
    }//busqueda_especifica

   function info_escuela (){
   	if(isset($_POST['idcfg'])){	
      $idcfg = $this->input->post('idcfg');
      $info_escuela = $this->Generico_model->info_escuela_post($idcfg);
    }else{
   		$cct = $this->input->get('cct');
   		$turno = $this->input->get('turno');
      $info_escuela = $this->Generico_model->info_escuela_get($cct,$turno);
    }        
      // $planea_info = $this->planea_escuela($info_escuela);
      $planea_logro = $this->planea_nivel_logro($info_escuela[0]['idcentrocfg']);
      consola($planea_logro);
   		$data = $this->busqueda_especifica($info_escuela[0]['cct']);
   		$data['info'] = $info_escuela;
   		
   		carga_pagina_basica($this,$data,'escuela/info_escuela');
   }//info_escuela

   function planea_escuela($datos){
    consola($datos);

   }//planea_escuela

   function planea_nivel_logro($idcfg){
      $niveles_logro = $this->Planea_model->planea_logro_escuela($idcfg);
      return $niveles_logro;

   }//planea_nivel_logro


}//class
