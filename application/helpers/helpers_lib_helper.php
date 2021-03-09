<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// envia de php a javascript datos en formato json para que javascript los puede leer correctamente
if(!function_exists('envia_datos_json')){
    function envia_datos_json($contexto, $data) {
      return $contexto->output
      ->set_status_header(http_response_code())//Obtener u establecer el código de estado de la respuesta HTTP.
      ->set_content_type('application/json', 'utf-8') //tipo de contenido
      ->set_output(json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES)) //datos de envio con jsonencode con sumascarar de bist en constantes
      ->_display();
        }// envia_datos_json()
        //JSON_UNESCAPED_SLASHES (integer)o escapar /. Disponible desde PHP 5.4.0.
        //JSON_UNESCAPED_UNICODE (integer) Codificar caracteres Unicode multibyte literalmente (por defecto es escapado como \uXXXX). Disponible desde PHP 5.4.0.
        //JSON_PRETTY_PRINT (integer)Utiliza espacios en blanco para formatear los datos devueltos. Disponible desde PHP 5.4.0.
    }


    if(!function_exists('carga_pagina_basica')){
        function carga_pagina_basica($contexto, $data, $vista, $header = 'header', $footer = 'footer') {
          $contexto->load->view('templates/'.$header, $data);
          $contexto->load->view($vista, $data);
          $contexto->load->view('templates/'.$footer);
        }// envia_datos_json()
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
