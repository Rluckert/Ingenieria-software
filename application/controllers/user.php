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
        $user = array('idUsuario'  => 1);
        $this->session->set_userdata($user);

		}
		
    function perfilUsuario(){
        $data['user'] = $this->sena_model->obtenerUsuario($this->session->userdata('idUsuario'));
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

		$this->sena_model->modificarPerfil($this->session->userdata('idUsuario'), $data);
		redirect(base_url('/user'));
	}	

	function cargosUsuario(){
    	$data['cargos'] = $this->sena_model->obtenerCargos($this->session->userdata('idUsuario'));
		$this->load->view('user/header');
        $this->load->view('user/cargos', $data);
    	$this->load->view('user/footer');
	}

	function eliminarCargoDeseos(){
       $idCargo = $this->uri->segment(3);
       $this->sena_model->eliminarCargoUsuario($this->session->userdata('idUsuario'),$idCargo);
        redirect(base_url('user/cargosUsuario'));
	}

    function addCursoRuta(){
        $idCurso = $this->uri->segment(3);
        if ($this->sena_model->añadirRutaCursos($this->session->userdata('idUsuario'),$idCurso)) {
             redirect(base_url('user/rutaDeCursos'));
        }else{
             echo "<script>
             if (window.confirm('Este curso ya está en su ruta de cursos, favor intentar con otro.')){
             window.location = 'http://localhost/sena/user/listaCursos';
             }
             </script>";
        }
        

    }

    function rutaDeCursos(){
		$data['cursos'] = $this->sena_model->cargarRutaCursos($this->session->userdata('idUsuario'));
    	$this->load->view('user/header');
    	$this->load->view('cursos/rutaDeCursos', $data);
    	$this->load->view('user/footer');
    }

    function listaCursos(){
        $data['cursos'] = $this->sena_model->obtenerCursos();
        $this->load->view('user/header', $data);
        $this->load->view('cursos/listaCursos', $data);
        $this->load->view('user/footer', $data);

    }

    function eliminarRutaCurso(){
    	$idCurso = $this->uri->segment(3);
        $this->sena_model->eliminarRutaCurso($this->session->userdata('idUsuario'),$idCurso);
        redirect(base_url('user/rutaDeCursos'));
    }

    function cursosRecomendados(){
        $data['cursos'] = $this->sena_model->cursosRecomendados($this->session->userdata('idUsuario'));
        $this->load->view('user/header');
        $this->load->view('cursos/cursosRecomendados', $data);
        $this->load->view('user/footer');
    }
	
	}//end of class
?>