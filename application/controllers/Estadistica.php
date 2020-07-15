<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Estadistica extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('Estadistica_model');
		$this->load->model('Generico_model');
	}

	public function estadistica_general($seccion=null,$sub_seccion=null) {
    	$data = array();
		$filtros_zona = array();
		$municipios=$this->Generico_model->municipios();
		$niveles = $this->Generico_model->obtener_nivel_xidmunicipio(0);
    	$ciclo=$this->Estadistica_model->trae_ciclos_est_muni();
		$filtros_zona['nivel'] = $this->Estadistica_model->trae_nivel_zona();
		if($seccion == 'estado_municipio'){
			$sub = "Por estado / municipio";
		}else if($seccion == "zona_escolar"){
			$sub = "Por zona escolar";
		}
    	$data['ciclo']=$ciclo;
    	$data['municipios']=$municipios;
    	$data['niveles'] = $niveles;
    	$data['sostenimientos'] = $this->Generico_model->obtener_sostenimiento_xidmunicipioxidnivel(0,0);
    	$data['modalidades'] = $this->Generico_model->obtener_modalidad_xidmunicipioxidnivelxsostenimiento(0,0,0);
		$string = $this->load->view('estadistica/filtros_zona', $filtros_zona, TRUE);
		$data['filtros_zona'] = $string;
		$data['seccion'] = $seccion;
		$data['subtitulo'] = $sub;
		$data['sub_seccion'] = $sub_seccion;
		carga_pagina_basica($this,$data,'estadistica/estadistica_general');
    }//estadistica_general

    public function niveles() {
    	$data = array();
    	$idmunicipio = $this->input->post('municipio');
    	$niveles=$this->Generico_model->obtener_nivel_xidmunicipio($idmunicipio);
			$ciclo=$this->Estadistica_model->trae_ciclos_est_muni_param($idmunicipio);
		$respuesta = array("niveles" => $niveles,"ciclo" => $ciclo);
		envia_datos_json($this, $respuesta);
		exit();
    }//

    public function sostenimientos() {
    	$data = array();
    	$idmunicipio = $this->input->post('municipio');
    	$idnivel = $this->input->post('nivel');
    	$sostenimientos=$this->Generico_model->obtener_sostenimiento_xidmunicipioxidnivel($idmunicipio,$idnivel);
			$ciclo=$this->Estadistica_model->trae_ciclos_est_muni_param($idmunicipio,$idnivel);
		$respuesta = array("sostenimientos" => $sostenimientos,"ciclo" => $ciclo);
		envia_datos_json($this, $respuesta);
		exit();
    }//

    public function modalidades() {
    	$data = array();
    	$idmunicipio = $this->input->post('municipio');
    	$idnivel = $this->input->post('nivel');
    	$idsostenimiento = $this->input->post('sostenimiento');
    	$modalidades=$this->Generico_model->obtener_modalidad_xidmunicipioxidnivelxsostenimiento($idmunicipio,$idnivel,$idsostenimiento);
			$ciclo=$this->Estadistica_model->trae_ciclos_est_muni_param($idmunicipio,$idnivel,$idsostenimiento);
		$respuesta = array("modalidades" => $modalidades,"ciclo" => $ciclo);
		envia_datos_json($this, $respuesta);
		exit();
    }//

		public function ciclo_est() {
    	$data = array();
    	$idmunicipio = $this->input->post('municipio');
    	$idnivel = $this->input->post('nivel');
    	$idsostenimiento = $this->input->post('sostenimiento');
			$idmodalidad = $this->input->post('modalidad');
    	$ciclo=$this->Estadistica_model->trae_ciclos_est_muni_param($idmunicipio,$idnivel,$idsostenimiento,$idmodalidad);
		$respuesta = array("ciclo" => $ciclo);
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
    	$asistencia =  $this->Estadistica_model->indicadores_asistencia_xmunicipio($idmunicipio,$idciclo);
    	$permanencia =  $this->Estadistica_model->indicadores_permanencia_xmunicipio($idmunicipio,$idciclo);
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
        	$sostenimiento=$sostenimiento[0]['nombre'];
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

            // $ciclo = $this->Generico_model->ciclo_escolar();
						$ciclo = $this->Estadistica_model->ciclo_escolar_estadist_xesc();
						$turnos = $this->Estadistica_model->turno_escolar_estadist_xesc();
						$data['turnos'] = $turnos;
						$data['ciclos'] = $ciclo;
            carga_pagina_basica($this,$data,'estadistica/estadistica_especifica');

    }//estadistica_especifica

    public function busqueda_especifica() {
        $cct = $this->input->post('cct');
				$idturno = $this->input->post('idturno');
        $idciclo = $this->input->post('idciclo');
				$datos_alumnos = $this->Estadistica_model->datos_estadistica_alumnosxgrado_xescuela($cct,$idturno,$idciclo);
				$datos_grupos = $this->Estadistica_model->datos_estadistica_gruposxgrado_xescuela($cct,$idturno,$idciclo);
				$datos_docentes = $this->Estadistica_model->datos_estadistica_docentes_xescuela($cct,$idturno,$idciclo);
				$idciclo_ant = $this->Estadistica_model->ciclo_ant_indicadores_xescuela($idciclo);
				// echo "<pre>";print_r($datos_docentes);die();
				if ($idciclo_ant=='') {
					$datos_indicadores = $this->Estadistica_model->datos_indicadores_xescuela($cct,$idturno,$idciclo);
				}
				else {
					$datos_indicadores = $this->Estadistica_model->datos_indicadores_xescuela($cct,$idturno,$idciclo_ant);
				}

				if (count($datos_alumnos)==0) {
					$data['vacio']  = 'true';
				}
				else {
					$data['vacio']  = 'false';
				}
				$data['alumnos']  = (isset($datos_alumnos[0]))?$datos_alumnos[0]:0;
				$data['grupos']  = (isset($datos_grupos[0]))?$datos_grupos[0]:0;
				$data['docentes']  = $datos_docentes;
				$data['indicadores']  = (isset($datos_indicadores[0]))?$datos_indicadores[0]:0;
				// echo "<pre>";print_r($data);die();
        envia_datos_json($this, $data);
        exit();
    }//busqueda_especifica

		//estadistica por zona Alex
		public function obtener_modalidad_xidnivel_zona() {
			$idnivel = $this->input->post('idnivel');
			$arr_datos = $this->Estadistica_model->obtener_modalidad_xidnivel_zona($idnivel);
			$str_select = "<option value='0' disabled='true' selected='true'>SELECCIONE</option>";
	    foreach ($arr_datos as $key => $row) {
	      $str_select .= " <option value=".$row['idmodalidad'].">".$row['nombre']."</option>";
	    }
			$respuesta = array("str_select" => $str_select);
			envia_datos_json($this, $respuesta);
			exit();
		}//obtener_sostenimiento_xidnivel_zona()

		public function obtener_nzona_xidnivelxidmodalidad_zona() {
			$data = array();
			$idnivel = $this->input->post('idnivel');
			$idmodalidad = $this->input->post('idmodalidad');
			$arr_datos = $this->Estadistica_model->obtener_nzona_xidnivelxidmodalidad_zona($idnivel,$idmodalidad);
			$str_select = "<option value='0' disabled='true' selected='true'>SELECCIONE</option>";
	    foreach ($arr_datos as $key => $row) {
	      $str_select .= " <option value=".$row['zonaid'].">".$row['nombre']."</option>";
	    }
			$respuesta = array("str_select" => $str_select);
			envia_datos_json($this, $respuesta);
			exit();
		}//obtener_nzona_xidnivelxidsost_zona()

		public function obtener_ciclo_xidnivelxidmodalidadxnzona_zona() {
			$data = array();
			$idnivel = $this->input->post('idnivel');
			$idmodalidad = $this->input->post('idmodalidad');
			$numzona = $this->input->post('numzona');
			$arr_datos = $this->Estadistica_model->obtener_ciclo_xidnivelxidmodalidadxnzona_zona($idnivel,$idmodalidad,$numzona);
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
			$idmodalidad = $this->input->post('idmodalidad');
			$numzona = $this->input->post('numzona');
			$idciclo = $this->input->post('idciclo');
			$arr_datos = $this->Estadistica_model->obtener_estadistica_xzona($idnivel,$idmodalidad,$numzona,$idciclo);
			// echo"<pre>";
			// print_r($arr_datos);die();
			$arr_zona['arr_datos_a_g_d_e'] = ((count($arr_datos)>0)?$arr_datos[0]:array());
			$arr_datos = $this->Estadistica_model->obtener_indicadores_xzona($idnivel,$idmodalidad,$numzona,$idciclo);
			$arr_zona['arr_datos_ind'] = ((count($arr_datos)>0)?$arr_datos[0]:array());
			$arr_datos = $this->Estadistica_model->obtener_indicadoresplanea_xzona($idnivel,$idmodalidad,$numzona,$idciclo);
			$arr_zona['arr_datos_indplanea'] = ((count($arr_datos)>0)?$arr_datos[0]:array());
			// echo "<pre>";print_r($arr_zona);die();
			$vista = $this->load->view('estadistica/contenido_zona', $arr_zona, TRUE);
			$respuesta = array("vista" => $vista);
			envia_datos_json($this, $respuesta);
			exit();
		}//obtener_estadistica_xzona()


}// Estadistica
