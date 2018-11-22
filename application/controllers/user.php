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

  function recuperarCuenta(){
     $this->load->view('login/clave');
  }

  function recibirRecuperar(){
    $data = array('documento' => $this->input->post('documento'),
                  'correo' => $this->input->post('correo')
                  );
    $aux = $this->sena_model->verificarCuenta($data);
    if (!is_null($aux)) {
       $clave = $aux->result()[0]->Clave;
       $correo = $aux->result()[0]->Correo;
       $configSmtp = array(
           'protocol' => 'smtp',
           'smtp_host' => 'in-v3.mailjet.com',
           'smtp_port' => 587,
           'smtp_user' => 'a17740ed2ef10bb3b6fbbd87d86248b6',
           'smtp_pass' => '408501b5cce52ae7abb3a4cfc45c71df',
           'mailtype' => 'html',
           'charset' => 'utf-8',
           'newline' => "\r\n"
           );    
 
 //cargamos la configuración para enviar con gmail
 $this->email->initialize($configSmtp);
 
 $this->email->from('rafaelluck14@hotmail.com', 'Sena-app');
 $this->email->to($correo);
  $this->email->subject('Recuperar contraseña');
  $this->email->message('<h3>Has solicitado tu contraseña</h3><br><hr>'.'<h4>Tu contraseña es: '.$clave.'</h4>');
 $this->email->send();
 
 //var_dump($this->email->print_debugger());
       
      redirect('user');
    }else{
      redirect('user/recuperarCuenta');
    }
  }

   public function recibirDatos(){
    $data = array('nombre' => $this->input->post('nombre'),
                  'correo' => $this->input->post('correo'),
                  'documento' => $this->input->post('documento'),
                  'contraseña' => $this->input->post('contraseña'),
                  'celular' => $this->input->post('celular')
                  );
   
    if ($this->sena_model->verificarRegistro($data)) {
      redirect('user/registro');
    }else{
      $this->sena_model->crearUsuario($data);
       $nombre = $data['nombre'];
       $correo = $data['correo'];
       $documento = $data['documento'];
       $contraseña = $data['contraseña'];
       $celular = $data['celular'];

          $configSmtp = array(
           'protocol' => 'smtp',
           'smtp_host' => 'in-v3.mailjet.com',
           'smtp_port' => 587,
           'smtp_user' => 'a17740ed2ef10bb3b6fbbd87d86248b6',
           'smtp_pass' => '408501b5cce52ae7abb3a4cfc45c71df',
           'mailtype' => 'html',
           'charset' => 'utf-8',
           'newline' => "\r\n"
           );    
 
 //cargamos la configuración para enviar con gmail
 $this->email->initialize($configSmtp);
 
 $this->email->from('rafaelluck14@hotmail.com', 'Sena-app');
 $this->email->to($correo);
  $this->email->subject('Bienvenido/a a Sena app');
  $this->email->message('<h3>' . $nombre . ' Gracias por registrarte en Sena app<hr>Aquí podras encontrar cientos de cargos ofrecidos por diferentes empresas además de cursos con los cuales podras aplicar a estos cargos</h3><br>
                Tu número de documento es: ' . $documento . '.<br>Tu password es: ' . $contraseña.'<br>'.'Tu correo asociado es: '.
                $correo.'<br>'.'Tu celular asociado es: '.$celular);
 $this->email->send();
 //con esto podemos ver el resultado
 //var_dump($this->email->print_debugger());
       
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
      $nombreUsuario = $consulta->result()[0]->NombreCompleto;
      $dataUser = array('idUsuario' => $id,
                        'logueado' => TRUE,
                        'nombreUsuario' => $nombreUsuario
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
    $this->load->view('welcome');
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
		redirect(base_url('/user/perfilUsuario'));   
	}	

  function addCargo(){
    $idCargo = $this->uri->segment(3);
    $idUsuario = $this->session->userdata('idUsuario');
    if ($this->sena_model->añadirCargo($idUsuario, $idCargo)) {
        $cursos = $this->sena_model->cursosCargosPorId($idCargo);
        foreach ($cursos->result() as $curso) {
          $this->sena_model->añadirRutaCursos($idUsuario, $curso->idCurso);
        }

        redirect(base_url('user/cargosUsuario'));
    }else{
        echo "<script>
             if (window.confirm('Este cargo ya está en su lista de deseo de cargos, favor intentar con otro.')){
             window.location = 'http://localhost/sena/user/cargosUsuario';
             }
             </script>";
    }
 

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

    /*----------------     Empresas -------------------------*/

    function empresas(){
      $data['categorias'] = $this->sena_model->categorias();
      $data['empresas'] = $this->sena_model->listaEmpresas();
      $data['noCargos'] = $this->sena_model->noCargosEmpresas();
      $this->load->view('user/header');
      $this->load->view('empresas/empresas', $data);
      $this->load->view('user/footer');
    }

    function cargosEmpresa(){
      $id = $this->uri->segment(3);
      $this->load->view('user/header');
      $data['cursos'] = $this->sena_model->cursosCargos();
      $data['cargos'] = $this->sena_model->cargosEmpresas($id);
      $data['empresa'] = $this->sena_model->buscarEmpresa($id);

      if ($data['cargos'] == false) {
          echo "La empresa no tiene cargos disponibbles";
      }else{
          $this->load->view('empresas/cargosEmpresa', $data);

      }
      $this->load->view('user/footer');
    }

    function empresasCategoria(){
      $this->load->view('user/header');
      $categoria = $this->input->post('categoria');
      $data['categorias'] = $this->sena_model->categorias();
      $data['empresas'] = $this->sena_model->empresasPorCategoria($categoria);
      $data['noCargos'] = $this->sena_model->noCargosEmpresas();
      

      
      if ($data['empresas'] == false) {
         $this->load->view('noCategoriasEmpresas');
      }else{
         $this->load->view('empresas/empresas', $data);
      }
      
      $this->load->view('user/footer');

    }

    function prueba(){
      $this->load->view('prueba');
    }

    function destruirSesion(){
        session_destroy();
        redirect(base_url('user'));

    }

	}
	//end of class
?>