<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Estadistica extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('Estadistica_model');
		$this->load->model('Generico_model');
	}

	public function estadistica_general() {
    	$data = array();
			$filtros_zona = array();
    	$ciclo=$this->Generico_model->ciclo_escolar();
    	$municipios=$this->Generico_model->municipios();
    	$data['ciclo']=$ciclo;
    	$data['municipios']=$municipios;
			$string = $this->load->view('estadistica/filtros_zona', $filtros_zona, TRUE);
			$data['filtros_zona'] = $string;
		carga_pagina_basica($this,$data,'estadistica/estadistica_general');
    }//estadistica_general

    public function niveles() {
    	$data = array();
    	$idmunicipio = $this->input->post('municipio');
    	$niveles=$this->Generico_model->obtener_nivel_xidmunicipio($idmunicipio);
		$respuesta = array("niveles" => $niveles);
		envia_datos_json($this, $respuesta);
		exit();
    }//

    public function sostenimientos() {
    	$data = array();
    	$idmunicipio = $this->input->post('municipio');
    	$idnivel = $this->input->post('nivel');
    	$sostenimientos=$this->Generico_model->obtener_sostenimiento_xidmunicipioxidnivel($idmunicipio,$idnivel);
		$respuesta = array("sostenimientos" => $sostenimientos);
		envia_datos_json($this, $respuesta);
		exit();
    }//

    public function modalidades() {
    	$data = array();
    	$idmunicipio = $this->input->post('municipio');
    	$idnivel = $this->input->post('nivel');
    	$idsostenimiento = $this->input->post('sostenimiento');
    	$modalidades=$this->Generico_model->obtener_modalidad_xidmunicipioxidnivelxsostenimiento($idmunicipio,$idnivel,$idsostenimiento);
		$respuesta = array("modalidades" => $modalidades);
		envia_datos_json($this, $respuesta);
		exit();
    }//

    public function obtener_estadistica_xmunicipio_edo(){
    	$data = array();
    	$idmunicipio = $this->input->post('municipio');
    	$idnivel = $this->input->post('nivel');
    	$idsostenimiento = $this->input->post('sostenimiento');
    	$idmodalidad = $this->input->post('modalidad');
    	$idciclo = $this->input->post('ciclo');
    	$alumnos = $this->Estadistica_model->obtener_alumnos_xmunicipioxnivelxsosteniminientoxmodalidadxciclo($idmunicipio,$idnivel,$idsostenimiento,$idmodalidad,$idciclo);
    	$docentes = $this->Estadistica_model->obtener_docentes_xmunicipioxnivelxsosteniminientoxmodalidadxciclo($idmunicipio,$idnivel,$idsostenimiento,$idmodalidad,$idciclo);
    	$infraestructura = $this->Estadistica_model->obtener_infraestructura_xmunicipioxnivelxsosteniminientoxmodalidadxciclo($idmunicipio,$idnivel,$idsostenimiento,$idmodalidad,$idciclo);
    	$asistencia =  $this->Estadistica_model->indicadores_asistencia_xmunicipio($idmunicipio);
    	$permanencia =  $this->Estadistica_model->indicadores_permanencia_xmunicipio($idmunicipio);
    	$aprendizaje =  $this->Estadistica_model->indicadores_aprendizaje_xmunicipio($idmunicipio);
    	$analfabetismo =  $this->Estadistica_model->analfabetismo_xmuni($idmunicipio);
    	$rezago =  $this->Estadistica_model->rezago_educativo_xmuni($idmunicipio);
    	$municipio="";
      	$nivel="";
      	$sostenimiento="";
      	$modalidad="";
      	if($idmunicipio>0){
        	$municipio= $this->Generico_model->obtener_nombre_municipio($idmunicipio);
        	$municipio=$municipio[0]['nombre'];
      	}
      	if($idnivel>0){
        	$nivel = $this->Generico_model->obtener_nombre_nivel($idnivel);
        	$nivel=$nivel[0]['nombre'];
      	}
      	if($idsostenimiento>0){
        	$sostenimiento = $this->Generico_model->obtener_nombre_sostenimiento($idsostenimiento);
        	$sostenimiento=$nivel[0]['nombre'];
     	}
     	if($idmodalidad>0){
        	$modalidad = $this->Generico_model->obtener_nombre_modalidad($idmodalidad);
        	$modalidad=$modalidad[0]['nombre'];
     	}

    
    	
    	$ciclo = $this->Generico_model->obtener_ciclo($idciclo);
    	$data["idmunicipio"] = $idmunicipio;
    	$data["idnivel"] = $idnivel;
    	$data["idsostenimiento"] = $idsostenimiento;
    	$data["idmodalidad"] = $idmodalidad;
    	$data["municipio"] = $municipio;
    	$data["nivel"] = $nivel;
    	$data["sostenimiento"] = $sostenimiento;
    	$data["modalidad"] = $modalidad;
    	$data["ciclo"] = $ciclo[0]['nombre'];
    	$data["idciclo"] = $idciclo;
    	$data["alumnos"] = $alumnos;
    	$data["docentes"] = $docentes;
    	$data["infraestructura"] = $infraestructura;
    	$data["asistencia"] = $asistencia;
    	$data["permanencia"] = $permanencia;
    	$data["aprendizaje"] = $aprendizaje;
    	$data["rezago"] = $rezago;
    	$data["analfabetismo"] = $analfabetismo;
    	// echo"<pre>";
    	// print_r($data);
    	// die();
		$vista = $this->load->view("estadistica/contenido_municipio",$data,TRUE);
		$respuesta = array("vista" => $vista);
		envia_datos_json($this, $respuesta);
		exit();

    }


    public function estadistica_especifica() {

            $ciclo = $this->Generico_model->ciclo_escolar();

            $data['ciclos'] = $ciclo;
            carga_pagina_basica($this,$data,'Estadistica/estadistica_especifica');

    }//estadistica_especifica

    public function busqueda_especifica() {
        $cct = $this->input->post('cct');
        $ciclo = $this->input->post('ciclo');

        $datos_alumnos = $this->Estadistica_model->datos_escuela_alumnos($cct,$ciclo);
        $datos_grupo = $this->Estadistica_model->datos_escuela_grupos($cct,$ciclo);
		$datos_docentes = $this->Estadistica_model->datos_escuela_docentes($cct,$ciclo);
		$eficiencia_terminal_retencion = $this->Estadistica_model->datos_escuela_ef_ret($cct,$ciclo);

		$total_alumnos = 0;
		$total_grupos = 0;
		$total_docentes = 0;
		
		for ($i=0; $i < count($datos_alumnos); $i++) { 
			$total_alumnos += $datos_alumnos[$i]['total'];
		}
		array_push($datos_alumnos,$total_alumnos);

        for ($i=0; $i < count($datos_grupo); $i++) { 
			$total_grupos += $datos_grupo[$i]['total'];
		}
		array_push($datos_grupo,$total_grupos);
		
		for ($i=0; $i < count($datos_docentes); $i++) { 
			$total_docentes += $datos_docentes[$i]['total'];
		}
        array_push($datos_docentes,$total_docentes);

        $data['grados']  = $datos_alumnos;
        $data['grupos']  = $datos_grupo;
		$data['docentes']  = $datos_docentes;
		$data['eficiencia_terminal']  = $eficiencia_terminal_retencion[0]['eficiencia_terminal'];
		$data['retencion']  = $eficiencia_terminal_retencion[0]['retencion'];

        $respuesta = array('datos'=>$data);
        envia_datos_json($this, $respuesta);
        exit();
    }//busqueda_especifica

		//estadistica por zona Alex
		public function obtener_sostenimiento_xidnivel_zona() {
			$idnivel = $this->input->post('idnivel');
			$arr_datos = $this->Estadistica_model->obtener_sostenimiento_xidnivel_zona($idnivel);
			$str_select = "<option value='0' disabled='true' selected='true'>SELECCIONE</option>";
	    foreach ($arr_datos as $key => $row) {
	      $str_select .= " <option value=".$row['idsostenimiento'].">".$row['nombre']."</option>";
	    }
			$respuesta = array("str_select" => $str_select);
			envia_datos_json($this, $respuesta);
			exit();
		}//obtener_sostenimiento_xidnivel_zona()

		public function obtener_nzona_xidnivelxidsost_zona() {
			$data = array();
			$idnivel = $this->input->post('idnivel');
			$idsostenimieto = $this->input->post('idsostenimieto');
			$arr_datos = $this->Estadistica_model->obtener_nzona_xidnivelxidsost_zona($idnivel,$idsostenimieto);
			$str_select = "<option value='0' disabled='true' selected='true'>SELECCIONE</option>";
	    foreach ($arr_datos as $key => $row) {
	      $str_select .= " <option value=".$row['zonaid'].">".$row['nombre']."</option>";
	    }
			$respuesta = array("str_select" => $str_select);
			envia_datos_json($this, $respuesta);
			exit();
		}//obtener_nzona_xidnivelxidsost_zona()

		public function obtener_ciclo_xidnivelxidsostxnzona_zona() {
			$data = array();
			$idnivel = $this->input->post('idnivel');
			$idsostenimieto = $this->input->post('idsostenimieto');
			$numzona = $this->input->post('numzona');
			$arr_datos = $this->Estadistica_model->obtener_ciclo_xidnivelxidsostxnzona_zona($idnivel,$idsostenimieto,$numzona);
			$str_select = "<option value='0' disabled='true' selected='true' >SELECCIONE</option>";
	    foreach ($arr_datos as $key => $row) {
	      $str_select .= " <option value=".$row['idciclo'].">".$row['nombre']."</option>";
	    }
			$respuesta = array("str_select" => $str_select);
			envia_datos_json($this, $respuesta);
			exit();
		}//obtener_ciclo_xidnivelxidsostxnzona_zona()


		public function obtener_estadistica_xzona() {
			$data = array();
			$arr_zona = array ();
			$idnivel = $this->input->post('idnivel');
			$idsostenimieto = $this->input->post('idsostenimieto');
			$numzona = $this->input->post('numzona');
			$idciclo = $this->input->post('idciclo');
			$arr_datos = $this->Estadistica_model->obtener_estadistica_xzona($idnivel,$idsostenimieto,$numzona,$idciclo);
			$arr_zona['arr_datos_a_g_d_e'] = $arr_datos;
			$arr_datos = $this->Estadistica_model->obtener_indicadores_xzona($idnivel,$idsostenimieto,$numzona,$idciclo);
			$arr_zona['arr_datos_ind'] = $arr_datos;
			$arr_datos = $this->Estadistica_model->obtener_indicadoresplanea_xzona($idnivel,$idsostenimieto,$numzona,$idciclo);
			$arr_zona['arr_datos_indplanea'] = $arr_datos;
			$vista = $this->load->view('estadistica/contenido_zona', $arr_zona, TRUE);
			$respuesta = array("vista" => $vista);
			envia_datos_json($this, $respuesta);
			exit();
		}//obtener_estadistica_xzona()


}// Estadistica