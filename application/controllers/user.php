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
    $this->load->view('login/login_view');
		}

    public function Registro(){
    $this->load->view('login/formulario');
  }

   public function recibirDatos(){
    $data = array('nombre' => $this->input->post('nombre'),
                  'correo' => $this->input->post('correo'),
                  'documento' => $this->input->post('documento'),
                  'contraseña' => $this->input->post('contraseña'),
                  'celular' => $this->input->post('celular')
                  );
    print_r($this->sena_model->verificarRegistro($data));
    if ($this->sena_model->verificarRegistro($data)) {
      redirect('user/registro');
    }else{
      $this->sena_model->crearUsuario($data);
      redirect('user');
    }
    

  }


  public function login(){
    $data = array('documento_l' => $this->input->post('documento_l'),
                  'contraseña_l' => $this->input->post('contraseña_l')
                  );

    $consulta = $this->sena_model->verificarUsuario($data);
      
    if(!is_null($consulta)){
      $id = $consulta->result()[0]->IdUsuario;
      $dataUser = array('idUsuario' => $id,
                        'logueado' => TRUE
                      );
      
      $this->session->set_userdata($dataUser);
      $this->sena_model->actualizarRegistro($data);
      redirect(base_url('user/logueado'));
    }else{
      redirect(base_url('user'));
    }
    
    
  }

  public function logueado(){
    if($this->session->userdata('logueado')){
    $this->load->view('user/header');
    $this->load->view('user/footer');
    }else{
       redirect(base_url('user'));
    }


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
      if ($data['cargos'] == false) {
          $this->load->view('errorCargos');
        }else{
          $this->load->view('user/cargos', $data);
      }
     
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
      if ($data['cursos'] == false) {
          $this->load->view('errorRutaCursos');
        }else{
         $data['cargos'] = $this->sena_model->cargosPorCurso();
         $this->load->view('cursos/rutaDeCursos', $data);
      }
    	$this->load->view('user/footer');
    }

    function listaCursos(){
        $data['cursos'] = $this->sena_model->obtenerCursos();
        $this->load->view('user/header');
        $this->load->view('cursos/listaCursos', $data);
        $this->load->view('user/footer');
      


    }

    function eliminarRutaCurso(){
    	$idCurso = $this->uri->segment(3);
        $this->sena_model->eliminarRutaCurso($this->session->userdata('idUsuario'),$idCurso);
        redirect(base_url('user/rutaDeCursos'));
    }

    function cursosRecomendados(){
        $data['cursos'] = $this->sena_model->cursosRecomendados($this->session->userdata('idUsuario'));
        $this->load->view('user/header');
        if ($data['cursos'] == false) {
          $this->load->view('errorCursosRe');
        }else{
         $this->load->view('cursos/cursosRecomendados', $data); 
        }
        
        $this->load->view('user/footer');
    }

    function destruirSesion(){
        session_destroy();
        redirect(base_url('user'));

    }

	
	}//end of class
?>