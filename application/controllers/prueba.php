<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Prueba extends CI_Controller {
	function __construct(){
      parent::__construct();
      $this->load->helper('form');
      $this->load->model('sena_model');
      $this->load->helper('url');
	}
    
    function index(){
       $this->load->view('user/header');
       print_r($this->session->userdata());
        $this->load->view('user/footer');
    }

  }
