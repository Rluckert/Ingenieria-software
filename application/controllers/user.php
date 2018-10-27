<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
	function __construct(){
      parent::__construct();
      $this->load->helper('form');
      $this->load->model('sena_model');
      $this->load->helper('url');
	}
    
    function index(){
		$this->load->view('user/header');
		$this->load->view('user/footer');
		}
		
    function perfilUsuario(){
    	$data['id'] = 1;
    	$data['user'] = $this->sena_model->obtenerUsuario($data['id']);
    	$this->load->view('user/header');
        $this->load->view('user/perfil', $data);
    	$this->load->view('user/footer');
    }

    function actualizar(){
		$data = array(
	    'nombre' => $this->input->post('nombre'),
	 	'correo' => $this->input->post('correo'),
	 	'clave' => $this->input->post('clave'),
	 	'celular' => $this->input->post('celular'));

		$this->sena_model->modificarPerfil(1, $data);
		redirect(base_url('/user'));
	}	

	function cargosUsuario(){
		$data['id'] = 1;
    	$data['cargos'] = $this->sena_model->obtenerCargos($data['id']);
		$this->load->view('user/header');
        $this->load->view('user/cargos', $data);
    	$this->load->view('user/footer');
	}

	function eliminarCargoDeseos(){
       $idCargo = $this->uri->segment(3);
       $this->sena_model->eliminarCargoUsuario(1,$idCargo);
        redirect(base_url('user/cargosUsuario'));
	}

    function rutaDeCursos(){
    	$data['id'] = 1;
    	$data['cursos'] = $this->sena_model->cargarRutaCursos($data['id']);
    	$this->load->view('user/header');
    	$this->load->view('cursos/rutaDeCursos', $data);
    	$this->load->view('user/footer');
    }

    function eliminarRutaCurso(){
    	$idCurso = $this->uri->segment(3);
        $this->sena_model->eliminarRutaCurso(1,$idCurso);
        redirect(base_url('user/rutaDeCursos'));
    }
	
	}//end of class
?>