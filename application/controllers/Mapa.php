<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mapa extends CI_Controller {

		function __construct() {
			parent::__construct();
			$this->load->model('Mapa_model');
			$this->load->model('Listadoesc_model');
		}

		public function busqueda_x_mapa($tipo_busqueda=null){
			$data = array();
			$data2 = array();
			$arr_municipios = array();
			$arr_niveles = array();
			$arr_sostenimientos = array();
			$arr_federales = array();

			if($tipo_busqueda == 'cct'){
				$sub = "Por clave de escuela";
			}else if($tipo_busqueda == "parametros"){
				$sub = "Por municipio, nivel, sostenimiento y nombre";
			}

			$municipios = $this->Generico_model->municipios();
			$arr_municipios['0'] = 'TODOS';
			foreach ($municipios as $municipio){
			 $arr_municipios[$municipio['idmunicipio']] = $municipio['nombre'];
			}

			$niveles = $this->Listadoesc_model->niveles();
			$arr_niveles['0'] = 'TODOS';

			foreach ($niveles as $nivel){
			 $arr_niveles[$nivel['idnivel']] = $nivel['nombre'];
			}

			$sostenimientos = $this->Listadoesc_model->sostenimientos();
			$arr_sostenimientos['0'] = 'TODOS';
			foreach ($sostenimientos as $sostenimiento){
			 $arr_sostenimientos[$sostenimiento['idsostenimiento']] = $sostenimiento['nombre'];
			}
			$arr_federales['0'] = 'TODOS';

			$data2['municipios'] = $arr_municipios;
			$data2['niveles'] = $arr_niveles;
			$data2['sostenimientos'] = $arr_sostenimientos;
			$data2['programas'] = $arr_federales;
			$data2['tipo_busqueda'] = $tipo_busqueda;
			$string = $this->load->view('mapa/buscador_x_mapa', $data2, TRUE);
			$data['buscador'] = $string;
			$data['subtitulo'] = $sub;
			carga_pagina_basica($this,$data,'mapa/index');
		}// index()

		public function obtener_niveles(){
			$idmunicipio = $this->input->post('idmunicipio');

			$niveles = $this->Listadoesc_model->niveles($idmunicipio);

			$str_select = '<option value=0>TODOS</option>';
			foreach ($niveles as $key => $value) {
				$str_select .= "<option value={$value['idnivel']}> {$value['nombre']} </option>";
			}
			$sostenimientos = $this->Listadoesc_model->sostenimientos($idmunicipio);
			$str_select1 = '<option value=0>TODOS</option>';
			foreach ($sostenimientos as $key => $value) {
				$str_select1 .= "<option value={$value['idsostenimiento']}> {$value['nombre']} </option>";
			}
			$respuesta = array('options' => $str_select,'options1' => $str_select1);
			envia_datos_json($this, $respuesta);
			exit();
		}
				public function obtener_sostenimientos(){
					$idmunicipio = $this->input->post('idmunicipio');
					$idnivel = $this->input->post('idnivel');
					$sostenimientos = $this->Listadoesc_model->sostenimientos($idmunicipio);
					$str_select = '<option value=0>TODOS</option>';
					foreach ($sostenimientos as $key => $value) {
						$str_select .= "<option value={$value['idsostenimiento']}> {$value['nombre']} </option>";
					}
					$respuesta = array('options' => $str_select);
					envia_datos_json($this, $respuesta);
					exit();
				}

				public function obtener_marcadores_filtro(){
					$idmunicipio       = $this->input->post("idmunicipio");
					$idnivel           = $this->input->post("idnivel");
					$id_sostenimiento  = $this->input->post("idsostenimiento");
					$nombre_centro     = $this->input->post("nombre");
					$cct               = $this->input->post("cct");

					$marcadorb = array();
					$vfinal = array();

					if(isset($cct) && $cct != ""){
						$escuelas = $this->Generico_model->obtener_xcvecentro("25".$cct);
					}else{
						$escuelas = $this->Mapa_model->obtener_xparams($idmunicipio,$idnivel,$id_sostenimiento,$nombre_centro);

					}

					foreach ($escuelas as $marcador) {

			            array_push($marcadorb, $marcador['nombre_centro']);
			            array_push($marcadorb, (float) $marcador['latitud']);
			            array_push($marcadorb, (float) $marcador['longitud']);
			            array_push($marcadorb, $marcador['cve_centro']);
			            array_push($marcadorb, $marcador['idnivel']);
			            array_push($marcadorb, $marcador['municipio']);
			            array_push($marcadorb, $marcador['turno_single']);
			            array_push($marcadorb, $marcador['nivel']);
			            array_push($marcadorb, $marcador['localidad']);
			            array_push($marcadorb, $marcador['zona_escolar']);
			            array_push($marcadorb, $marcador['sostenimiento']);
									array_push($marcadorb, $marcador['idcentrocfg']);
			            array_push($vfinal, $marcadorb);
			            $marcadorb = array();
			        }
							$respuesta = array('response' => $vfinal);
							envia_datos_json($this, $respuesta);
							exit();
				}

				public function obtener_mismo_nivel(){

					$idcfg = $this->input->post('idcfg');
					$marcadorb = array();
					$vfinal = array();
					if($idcfg != ""){
						$escuela = $this->Mapa_model->obtener_xidcct($idcfg);
						$escuelas = $this->Mapa_model->obtener_mismo_nivel($escuela[0]['latitud'], $escuela[0]['longitud'], $escuela[0]['idnivel'], false);

						foreach ($escuelas as $marcador) {

				            array_push($marcadorb, $marcador['nombre_centro']);
				            array_push($marcadorb, (float) $marcador['latitud']);
				            array_push($marcadorb, (float) $marcador['longitud']);
				            array_push($marcadorb, $marcador['cve_centro']);
				            array_push($marcadorb, $marcador['idnivel']);
				            array_push($marcadorb, $marcador['municipio']);
										array_push($marcadorb, $marcador['turno_single']);
										array_push($marcadorb, $marcador['nivel']);
										array_push($marcadorb, $marcador['localidad']);
										array_push($marcadorb, $marcador['zona_escolar']);
										array_push($marcadorb, $marcador['sostenimiento']);
										array_push($marcadorb, $marcador['idcentrocfg']);
				            array_push($vfinal, $marcadorb);
				            $marcadorb = array();
				        }
								$respuesta = array('response' => $vfinal);
								envia_datos_json($this, $respuesta);
								exit();
					}
				}

				public function obtener_siguiente_nivel(){

					$idcfg = $this->input->post('idcfg');
					$marcadorb = array();
					$vfinal = array();
					if($idcfg != ""){
						$escuela = $this->Mapa_model->obtener_xidcct($idcfg);
						$escuelas = $this->Mapa_model->obtener_mismo_nivel($escuela[0]['latitud'], $escuela[0]['longitud'], $escuela[0]['idnivel'], true);

						foreach ($escuelas as $marcador) {

				            array_push($marcadorb, $marcador['nombre_centro']);
				            array_push($marcadorb, (float) $marcador['latitud']);
				            array_push($marcadorb, (float) $marcador['longitud']);
				            array_push($marcadorb, $marcador['cve_centro']);
				            array_push($marcadorb, $marcador['idnivel']);
				            array_push($marcadorb, $marcador['municipio']);
										array_push($marcadorb, $marcador['turno_single']);
										array_push($marcadorb, $marcador['nivel']);
										array_push($marcadorb, $marcador['localidad']);
										array_push($marcadorb, $marcador['zona_escolar']);
										array_push($marcadorb, $marcador['sostenimiento']);
										array_push($marcadorb, $marcador['idcentrocfg']);
				            array_push($vfinal, $marcadorb);
				            $marcadorb = array();
				        }
								$respuesta = array('response' => $vfinal);
								envia_datos_json($this, $respuesta);
								exit();
					}
				}

		}// Mapa
