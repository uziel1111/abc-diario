<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Info_escuela extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Listadoesc_model');
        $this->load->model('Estadistica_model');
        $this->load->model('Generico_model');
        $this->load->model('Planea_model');
        $this->load->model('Riesgo_abandono_model');
        $this->load->model('Eficienciat_model');
    }//_construct

    function busqueda_general() {
      $data=array();
      $municipios=$this->Generico_model->municipios();
      $nivel=$this->Listadoesc_model->niveles();
      $sostenimiento=$this->Listadoesc_model->sostenimientos();
      $data['municipios']=$municipios;
      $data['nivel'] = $nivel;
      $data['sostenimiento'] = $sostenimiento;

      carga_pagina_basica($this,$data,'escuela/busqueda_escuela');

    }//busqueda_general

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
      if($idsostenimiento!=0){
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

    }//listado_escuelas

    function busqueda_especifica() {
      $cct = $this->input->post('cct');
      $idturno = $this->input->post('turno');
      $ciclo = trae_ciclo_actual();
      $idciclo = $this->Generico_model->get_idciclo_x_desc(trim($ciclo))->idciclo;
      // echo"<pre>";
      // print_r($idciclo);
      // die();

        $datos_alumnos = $this->Estadistica_model->datos_estadistica_alumnosxgrado_xescuela($cct,$idturno,$idciclo);
        // echo"<pre>";
        // print_r($datos_alumnos);
        // die();
        $datos_grupos = $this->Estadistica_model->datos_estadistica_gruposxgrado_xescuela($cct,$idturno,$idciclo);
        $datos_docentes = $this->Estadistica_model->datos_estadistica_docentes_xescuela($cct,$idturno,$idciclo);

        $respuesta = array("alumnos" => $datos_alumnos[0], 'grupos' => $datos_grupos[0], 'docentes' => $datos_docentes[0]);
        envia_datos_json($this, $respuesta);
        exit();
    }//busqueda_especifica

   function info_escuela (){
   	if(isset($_POST['idcfg'])){
      $idcfg = $this->input->post('idcfg');
      $info_escuela = $this->Generico_model->info_escuela_post($idcfg);

      $turno = $info_escuela[0]['idturno'];
      $info_escuela[0]['idcentrocfg']=$idcfg;
    }else{
   		$cct = $this->input->get('cct');
   		$turno = $this->input->get('turno');
      $info_escuela = $this->Generico_model->info_escuela_get($cct,$turno);
    }

   		$data['info'] = $info_escuela;
      // echo "<pre>";print_r($data);die();
   		carga_pagina_basica($this,$data,'escuela/info_escuela');
   }//info_escuela

  public function get_asistencia(){
    $vista = $this->load->view('escuela/info/asistencia',array(), TRUE);
    $respuesta = array('vista' => $vista);

    envia_datos_json($this, $respuesta);
    exit();
  }

  public function get_permanencia(){
    $data['ciclos'] = $this->Generico_model->ciclo_escolar();
    $vista = $this->load->view('escuela/info/permanencia',$data, TRUE);
    $respuesta = array('vista' => $vista);

    envia_datos_json($this, $respuesta);
    exit();
  }

  public function get_aprendizaje(){
    $vista = $this->load->view('escuela/info/aprendizaje',array(), TRUE);
    $respuesta = array('vista' => $vista);

    envia_datos_json($this, $respuesta);
    exit();
  }

   function obtener_idnivel_xmuni(){
     $idmunicipio = $this->input->post('idmunicipio');
     $arr_datos = $this->Listadoesc_model->niveles($idmunicipio);
     $str_select = "<option value='0'>Todos</option>";
     foreach ($arr_datos as $key => $row) {
       $str_select .= " <option value=".$row['idnivel'].">".$row['nombre']."</option>";
     }

     $sostenimiento=$this->Listadoesc_model->sostenimientos($idmunicipio);
     $str_select2 = "<option value='0'>Todos</option>";
     foreach ($sostenimiento as $key => $row) {
       $str_select2 .= " <option value=".$row['idsostenimiento'].">".$row['nombre']."</option>";
     }

     $respuesta = array("slc_nivel" => $str_select,"slc_sost" => $str_select2);
     envia_datos_json($this, $respuesta);
     exit();
   }//obtener_idnivel_xmuni


function obtener_idsost_xidnivel_xmuni(){
  $idmunicipio = $this->input->post('idmunicipio');
  $idnivel = $this->input->post('idnivel');

  $sostenimiento=$this->Listadoesc_model->sostenimientos($idmunicipio,$idnivel);
  $str_select2 = "<option value='0'>Todos</option>";
  foreach ($sostenimiento as $key => $row) {
    $str_select2 .= " <option value=".$row['idsostenimiento'].">".$row['nombre']."</option>";
  }

  $respuesta = array("slc_sost" => $str_select2);
  envia_datos_json($this, $respuesta);
  exit();
}//obtener_idnivel_xmuni

   function get_datos_permanencia(){
    $cct = $this->input->post('cct');
    $idturno = $this->input->post('turno');
    $periodo = $this->input->post('periodo');
    $ciclo = $this->input->post('ciclo');
    $ciclo_corto = trae_ciclo_corto($ciclo);
    $idciclo = $this->Generico_model->get_idciclo_x_desc(trim($ciclo))->idciclo;

    $riesgo = $this->Riesgo_abandono_model->obtener_riesgo_xcct($cct, $idturno, $ciclo_corto, $periodo);
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

        $idciclo_ant = $this->Estadistica_model->ciclo_ant_indicadores_xescuela($idciclo);

        $datos_indicadores = $this->Estadistica_model->datos_indicadores_xescuela($cct,$idturno,$idciclo_ant);
        $indicadores  = (isset($datos_indicadores[0]))?$datos_indicadores[0]:0;

        $respuesta = array("muy_alto" => intval($muy_alto),"alto" => intval($alto),"medio" => intval($medio),"bajo" => intval($bajo),"array_muy_alto" => $array_muy_alto,"array_alto" => $array_alto,"total_alumnos" => intval($total_alumnos),"total_alumnos_riesgo"=>$total_alumnos_riesgo, 'indicadores' => $indicadores);
        envia_datos_json($this, $respuesta);
        exit();

   }

   public function obtener_grafica_x_campodisiplinario(){
    $cct = $this->input->post('cct');
    $idturno = $this->input->post('turno');
    $campodisip = $this->input->post("campodisip");
    $datos = $this->Planea_model->estadisticas_x_cct_info($cct, $idturno, $campodisip);
    $periodoplanea = $this->Planea_model->obtener_periodoplane_xidperiodo_info($cct, $idturno);
    $periodoplanea = $periodoplanea[0]['periodo'];
    // echo "<pre>";print_r($periodoplanea);die();
      $respuesta = array('datos' => $datos, 'periodoplanea' => $periodoplanea, 'campodisip' => $campodisip);

      envia_datos_json($this, $respuesta);
      exit();
    }

    public function obtener_info_nlogro(){
      $cct = $this->input->post('cct');
      $idturno = $this->input->post('turno');

      $data['centrocfg'] = $this->Planea_model->niveles_de_logro_idcentrocfg($cct, $idturno);
      $data['entidad'] = $this->Planea_model->niveles_de_logro_entidad($cct, $idturno);
      $data['nacional'] = $this->Planea_model->niveles_de_logro_nacional($cct, $idturno);
      $data['ciclos'] = $this->obtener_ciclos($data['centrocfg'], $data['entidad'], $data['nacional']);
      // echo"<pre>";
      // print_r($data);
      // die();
      $vista_tabla = $this->load->view('escuela/tabla_nlogro',$data, TRUE);


      $respuesta = array('vista' => $vista_tabla, 'datos' => $data['centrocfg']);

      envia_datos_json($this, $respuesta);
      exit();
    }

    private function obtener_ciclos($data_cfg, $data_entidad, $data_nacional){
      $ciclos_data = array();
      $tam_datos = count($data_cfg);
      foreach ($data_cfg as $dato) {
        array_push($ciclos_data, $dato['periodo']);
      }
      foreach ($data_entidad as $dato) {
        array_push($ciclos_data, $dato['periodo']);
      }
      foreach ($data_nacional as $dato) {
        array_push($ciclos_data, $dato['periodo']);
      }

      return array_unique($ciclos_data);
    }

    public function ete_info(){
      $cct = $this->input->post('cct');
      $turno = $this->input->post('turno');

      $eft = $this->Eficienciat_model->eficiencia_terminal($cct, $turno);
      $contenido_may = $this->Eficienciat_model->indicadores_sum($cct, $turno);
      $ete = round((($eft->eficiencia_terminal* $contenido_may->mayor)/100),2);
      $respuesta = array('ete' => $ete, 'periodo' => $contenido_may->periodo);

      envia_datos_json($this, $respuesta);
      exit();
    }

}//class
