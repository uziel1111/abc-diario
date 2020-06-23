<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


if(!function_exists('envia_datos_json')){
    function envia_datos_json($contexto, $data) {
      return $contexto->output
      ->set_status_header(http_response_code())
      ->set_content_type('application/json', 'utf-8')
      ->set_output(json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
      ->_display();
        }// envia_datos_json()
    }

    if(!function_exists('carga_pagina_basica')){
        function carga_pagina_basica($contexto, $data, $vista, $header = 'header', $footer = 'footer') {
          $contexto->load->view('templates/'.$header, $data);
          $contexto->load->view($vista, $data);
          $contexto->load->view('templates/'.$footer);
        }// envia_datos_json()
    }

    if(!function_exists('carga_pagina_sola')){
        function carga_pagina_sola($contexto, $data, $vista) {
          $contexto->load->view($vista, $data);
        }// carga_pagina_sola()
    }

    if(!function_exists('hay_sesion_abierta')){
        function hay_sesion_abierta($contexto) {
            return $contexto->session->has_userdata(DATOSUSUARIO);
        }// hay_sesion_abierta()
      }

    if(!function_exists('consola')){
        function consola($contexto) {
         echo "<pre>"; print_r($contexto); die();
        }// consola()
    }

    if(!function_exists('set_cct_sesion')){
      function set_cct_sesion($contexto, $datoscct){
            $contexto->session->set_userdata(DATOCCT, $datoscct);
        } // set_cct_sesion()
    }

    if (!function_exists('get_cct_sesion')) {
         function get_cct_sesion($contexto) {
            if (hay_sesion_abierta($contexto)) {
                return $contexto->session->userdata(DATOCCT);
            } else {
                return null;
            }
        }//get_cct_sesion()
    }
if ( !function_exists( 'destroy_all_session_cct' ) ) {
    function destroy_all_session_cct( $contexto ) {
        $contexto->session->unset_userdata( DATOSUSUARIO );
        $contexto->session->sess_destroy();
        return TRUE;
    }
    // destroy_all_session_cct()
}

if ( !function_exists( 'verifica_permiso' ) ) {
    function verifica_permiso( $tipo_usuario, $keyword ) {
        $bandera = FALSE;
        $menu_permisos = array();
        if ( $tipo_usuario == USUARIO_ESCOLAR ) {
            $menu_permisos = array( 'AGEN_DOC', 'PLANT_DOC', 'REG_ANT' );
        } else if ( $tipo_usuario == USUARIO_AREA ) {
            $menu_permisos = array( 'CONS_DOC', 'CALEN_DOC' );
        } else if ( $tipo_usuario == USUARIO_CENTRAL ) {
            $menu_permisos = array( 'CONS_DOC', 'CALEN_DOC', 'CONS_REG' );
        }

        if ( $menu_permisos != NULL ) {
            for ( $i = 0; $i<count( $menu_permisos );
            $i++ ) {
                if ( $keyword == $menu_permisos[$i] ) {
                    $bandera = TRUE;
                }
            }
        }
        return $bandera;
    }
}
//verifica_permiso

if ( !function_exists( 'redirige_sesion' ) ) {
    function redirige_sesion( $contexto ) {
        if ( !hay_sesion_abierta( $contexto ) ) {
            http_response_code(408);
            destroy_all_session_cct($contexto);
        } else {
            return TRUE;
        }
    }
}
//redirige_sesion

if ( !function_exists( 'redirige_prohibido' ) ) {
    function redirige_prohibido( $contexto ) {
        $data['url_back'] = site_url().'Panel';
        carga_pagina_basica( $contexto, $data, 'errors/error' );
    }
}

if ( !function_exists( 'isRequestAjax' ) ) {
    function isRequestAjax( $contexto ) {
        if ( $contexto->input->is_ajax_request() ) {
            if ( hay_sesion_abierta( $contexto ) ) {
                return TRUE;
            } else {
                redirige_prohibido( $contexto );
            }
        } else {
            redirige_prohibido( $contexto );
        }
    }
    // isRequestAjax()
}

if ( !function_exists( 'trae_ciclo_actual' ) ) {
    function trae_ciclo_actual() {
        $anio_actual = date( 'Y' );
        $mes_actual = date( 'm' );
        $dia_actual = date( 'd' );
        if ( $mes_actual>8 && $dia_actual >25 ) {
            $ciclo_escolar = $anio_actual.'-'.( $anio_actual+1 );
        } else {
            $ciclo_escolar = ( $anio_actual-1 ).'-'.$anio_actual;
        }
        return $ciclo_escolar;
    }
}

if ( !function_exists( 'trae_ciclo_corto' ) ) {
    function trae_ciclo_corto($cadena) {
        $ciclo="";
        if($cadena!="" && strlen($cadena)){
            $ciclo = substr($cadena, -4); 
        }
        return $ciclo;
    }
}
?>