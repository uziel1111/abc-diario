<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Busqueda extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    function index() {
    	$data = array();
        carga_pagina_basica($this,$data,'busqueda/index.php');
    }

    function resultado() {
    	$data = array();
        carga_pagina_basica($this,$data,'busqueda/resultado.php');
    }

}
