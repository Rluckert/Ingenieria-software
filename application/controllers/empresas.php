<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Empresas extends CI_Controller {
	function __construct(){
      parent::__construct();
      $this->load->helper('form');
      $this->load->model('empresas_model');
      $this->load->helper('url');
	}
    
    function index(){
    $this->load->view('login_empresas/login_view');
		}

	  public function registro(){
	  	$data['categorias'] = $this->empresas_model->categorias();
	  	$data['ciudades'] = $this->empresas_model->ciudades();

         $this->load->view('login_empresas/formulario', $data);
  }

   public function recibirDatos(){
    $data = array('nombre' => $this->input->post('nombre'),
                  'descripcion' => $this->input->post('descripcion'),
                  'nit' => $this->input->post('nit'),
                  'clave' => $this->input->post('clave'),
                  'ciudad' => $this->input->post('ciudad'),
                  'categoria' => $this->input->post('categoria'),
                  'correo' => $this->input->post('correo')
                  );


    
    if ($this->empresas_model->verificarRegistro($data)) {
      redirect('empresas/registro');
    }else{
      $this->empresas_model->crearEmpresa($data);
       $nombre = $data['nombre'];
       $correo = $data['correo'];
       $nit = $data['nit'];
       $clave = $data['clave'];

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
  $this->email->message('<h3>' . $nombre . ' Gracias por registrarte en Sena app<hr>Aquí podras ofertar los cargos que quieras y vacantes que solicites.</h3><br>
                Tu número de nit: ' . $nit . '.<br>Tu password es: ' . $clave.'<br>'.'Tu correo asociado es: '.
                $correo);
 $this->email->send();
 //con esto podemos ver el resultado
 //var_dump($this->email->print_debugger());
      redirect('empresas');
    }
    

  }


  public function login(){
    $data = array('nit' => $this->input->post('nit'),
                  'clave' => $this->input->post('clave')
                  );
    
   
    $consulta = $this->empresas_model->verificarEmpresa($data);
    
    


     
    if(!is_null($consulta)){
      $id = $consulta->result()[0]->IdUsuario;
      $dataUser = array('idUsuario' => $id,
                        'logueado' => TRUE
                      );
      
      $this->session->set_userdata($dataUser);
      redirect(base_url('empresas/logueado'));
    }else{
      redirect(base_url('empresas'));
    }
    
    
    
  }

  public function logueado(){
    if($this->session->userdata('logueado')){
    $this->load->view('empresas/panelEmpresa');
    }else{
       redirect(base_url('empresas'));
    }


  }

}