<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Index extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    function index() {
    	$data = array();
        carga_pagina_basica($this,$data,'index.php');
    }

}
