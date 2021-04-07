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

    function busqueda_general($seccion = null, $subseccion = null) {
      $data=array();
      $municipios=$this->Generico_model->municipios();

      $sostenimiento=$this->Listadoesc_model->sostenimientos();
      if($seccion == 'estadistica'){
        $secc = "Estadística, indicadores y resultados educativos";
        if($subseccion == 'escuela'){
          $sub = "Por escuela";
        }else if($subseccion == 'rescuela'){
          $sub = "Riesgo de abandono por escuela";
        }
      }else if($seccion == "aprendizaje"){
        $secc = "Aprendizaje";
        if($subseccion == 'escuela'){
          $sub = "Resultados PLANEA y Aprendamos Juntos por escuela";
        }
      }else if($seccion == "ubica"){
        $secc = "Ubica tu escuela";
        if($subseccion == 'listado'){
          $sub = "En listado de escuelas";
        }
      }
      $data['municipios']=$municipios;
      if($seccion == "aprendizaje" && $subseccion == 'escuela'){
        $nivel=$this->Listadoesc_model->niveles_planea();
      }else{
        $nivel=$this->Listadoesc_model->niveles();
      }
      if($seccion == 'estadistica' && $subseccion == 'escuela'){
        $nivel=$this->Listadoesc_model->niveles_estadistica();
      }
      if($seccion == 'estadistica' && $subseccion == 'rescuela'){
        $nivel=$this->Listadoesc_model->niveles_riesgo();
      }
      $data['nivel'] = $nivel;
      $data['sostenimiento'] = $sostenimiento;
      if($seccion != null && $subseccion != null){
        $data['seccion'] = $secc;
        $data['subseccion'] = $sub;
        if($seccion == 'aprendizaje'){
          $data['seccion_corta'] = 'aprendizaje';
        }else{
          $data['seccion_corta'] = $subseccion;
        }

      }

      carga_pagina_basica($this,$data,'escuela/busqueda_escuela');

    }//busqueda_general

    function lista_escuelas() {

      $idmunicipio = $this->input->post('municipio');
      $idsostenimiento = $this->input->post('sostenimiento');
      $idnivel = $this->input->post('nivel');
      $nombre_cct =  trim($this->input->post('nombre_cct'));
      $cct =  trim($this->input->post('cct'));
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
    
      $idciclo = 0;

      $idciclo_max = $this->Generico_model->max_idciclo_estadistica_xescuela($cct,$idturno);
      if($idciclo_max!=NULL){
        if(trim($idciclo_max->idciclo)!='' && $idciclo_max->idciclo !=NULL){
          $idciclo =  trim($idciclo_max->idciclo);
        }
      }

        $datos_alumnos = $this->Estadistica_model->datos_estadistica_alumnosxgrado_xescuela($cct,$idturno,$idciclo);

        $datos_grupos = $this->Estadistica_model->datos_estadistica_gruposxgrado_xescuela($cct,$idturno,$idciclo);
        $datos_docentes = $this->Estadistica_model->datos_estadistica_docentes_xescuela($cct,$idturno,$idciclo);

        $respuesta = array("alumnos" => ((isset($datos_alumnos[0]))?$datos_alumnos[0]:0), 'grupos' => ((isset($datos_grupos[0]))?$datos_grupos[0]:0), 'docentes' => ((isset($datos_docentes))?$datos_docentes:0));
        envia_datos_json($this, $respuesta);
        exit();
    }//busqueda_especifica

   function info_escuela (){
   	if(isset($_POST['idcfg'])){
      $idcfg = $this->input->post('idcfg');
      $seccion = $this->input->post('seccion');

      $info_escuela = $this->Generico_model->info_escuela_post($idcfg);

      $turno = $info_escuela[0]['idturno'];
      $info_escuela[0]['idcentrocfg']=$idcfg;
    }else{

      redirect('Info_escuela/busqueda_general/ubica/listado');
    }

   		$data['info'] = $info_escuela;
      $data['seccion'] = $seccion;
   		carga_pagina_basica($this,$data,'escuela/info_escuela');
   }//info_escuela

  public function get_asistencia(){
    $vista = $this->load->view('escuela/info/asistencia',array(), TRUE);
    $respuesta = array('vista' => $vista);

    envia_datos_json($this, $respuesta);
    exit();
  }

  public function get_permanencia(){
    $cct = $this->input->post('cct');
    $idturno = $this->input->post('turno');
    $idnivel = $this->input->post('idnivel');

    $idciclo_ant = 0;
    $idciclo_max = $this->Generico_model->max_idciclo_indicadores_xescuela($cct,$idturno);
    if($idciclo_max != NULL){
      if($idciclo_max->idciclo!=NULL && $idciclo_max->idciclo!=''){
        $idciclo_ant = $idciclo_max->idciclo;
      }
    }
// echo $idciclo_ant; die();
    $datos_indicadores = $this->Estadistica_model->datos_indicadores_xescuela($cct,$idturno,$idciclo_ant);
    $indicadores  = (isset($datos_indicadores[0]))?$datos_indicadores[0]:['eficiencia_terminal'=>0,'retencion'=>0,'aprobacion'=>0];

    $data['ciclos'] = $this->Riesgo_abandono_model->ciclo_escolar(); 
    $data['idnivel'] = $idnivel;
    $vista = $this->load->view('escuela/info/permanencia',$data, TRUE);
    $respuesta = array('vista' => $vista, 'indicadores' => $indicadores);

    envia_datos_json($this, $respuesta);
    exit();
  }

  public function get_aprendizaje(){
    $idnivel = $this->input->post('idnivel');
    $data['idnivel'] = $idnivel;
    $vista = $this->load->view('escuela/info/aprendizaje',$data, TRUE);
    $respuesta = array('vista' => $vista);

    envia_datos_json($this, $respuesta);
    exit();
  }

   function obtener_idnivel_xmuni(){

     $tipo_busqueda = $this->input->post('tipo_busqueda');
     $idmunicipio = $this->input->post('idmunicipio');
     if($tipo_busqueda == 'aprendizaje'){
      $arr_datos = $this->Listadoesc_model->niveles_planea($idmunicipio);
     }else if($tipo_busqueda == 'rescuela'){
      $arr_datos = $this->Listadoesc_model->niveles_riesgo($idmunicipio);
     }else if($tipo_busqueda == 'escuela'){
      $arr_datos = $this->Listadoesc_model->niveles_estadistica($idmunicipio);
     }else{
      $arr_datos = $this->Listadoesc_model->niveles($idmunicipio);
     }

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
    $idnivel = $this->input->post('idnivel');

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
          if ($idnivel==2) {
						$total_alumnos=intval($muy_alto1)+intval($muy_alto2)+intval($muy_alto3)+intval($muy_alto4)+intval($muy_alto5)+intval($muy_alto6)+intval($alto1)+intval($alto2)+intval($alto3)+intval($alto4)+intval($alto5)+intval($alto6);
					}
					else {
						$total_alumnos=intval($muy_alto1)+intval($muy_alto2)+intval($muy_alto3)+intval($alto1)+intval($alto2)+intval($alto3);
					}
          
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
        $indicadores  = (isset($datos_indicadores[0]))?$datos_indicadores[0]:['eficiencia_terminal'=>0,'retencion'=>0,'aprobacion'=>0];

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
    $periodoplanea = ((isset($periodoplanea[0]['periodo']))?$periodoplanea[0]['periodo']:'');

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
      // print_r($contenido_may);die();
      if ($eft!='' && $contenido_may!='') {
        $ete = round((($eft->eficiencia_terminal* $contenido_may->mayor)/100),2);
        $periodo = $contenido_may->periodo;
      }
      else {
        $ete = 0;
        $periodo = '';
      }


      $respuesta = array('ete' => $ete, 'periodo' => $periodo);

      envia_datos_json($this, $respuesta);
      exit();
    }

    public function obtener_diagnostico_info_nlogro(){
      $cct = $this->input->post('cct');
      $idturno = $this->input->post('turno');
      $subsistema = $this->input->post('subsistema');
      $municipio = $this->Generico_model->municipio_x_escuela($cct, $idturno);

      $diagnostico_esc = $this->Planea_model->diagnostico_x_escuela($cct, $idturno);
      $diagnostico_muni = $this->Planea_model->diagnosticoall_x_estadomunicipio($municipio['idmunicipio']);
      $diagnostico_estado = $this->Planea_model->diagnosticoall_x_estadomunicipio(0);
      $diagnostico_subs = $this->Planea_model->diagnosticoall_x_subsistema($subsistema);
      $data = array('diagnostico_esc' => $diagnostico_esc, 'diagnostico_muni' => $diagnostico_muni, 'municipio' => $municipio, 'diagnostico_estado' => $diagnostico_estado, 'diagnostico_subs' => $diagnostico_subs);

      $vista_tabla_diagnostico = $this->load->view('escuela/tabla_nlogro_diagnostico_info',$data, TRUE);
      $respuesta = array('vista_tabla_diagnostico' => $vista_tabla_diagnostico);
      envia_datos_json($this, $respuesta);
      exit();
    }

}//class
