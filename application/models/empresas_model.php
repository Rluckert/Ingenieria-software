<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class empresas_model extends CI_Model {
  function __construct(){
  	parent:: __construct();
  	$this->load->database();
  }

  function crearEmpresa($data){
      date_default_timezone_set('America/Bogota');
      $fecha_actual = date("Y-m-d H:i:s");

      $this->db->insert('empresas', array('NombreEmpresa' => $data['nombre'],
                                           'RutaImagen' => '',
                                           'DescripcionCorta' => $data['descripcion'],
                                           'IdCiudad' => $data['ciudad'],
                                           'IdCategoria' => $data['categoria'],
                                           'Nit' => $data['nit'],
                                           'Clave' => $data['clave'],
                                          ));
    }

    
      public function verificarRegistro($data){
        $nit = $data['nit'];
        $consulta = "SELECT * FROM empresas WHERE Nit = $nit";
        $array =  $this->db->query($consulta);

        if($array->num_rows()>0){
          return TRUE;
        }else{
          return FALSE;
        }

      }

      public function categorias(){
        $consulta = "SELECT NombreCategoriaEmpresa nombre, IdCategoriaEmpresa id from categoriasempresa";
        $query =  $this->db->query($consulta);

        if($query->num_rows()>0){
          return $query;
        }else{
          return FALSE;
        }

         }

         public function ciudades(){
        $consulta = "SELECT NombreCiudad nombre, IdCiudad id from ciudades;";
        $query =  $this->db->query($consulta);

        if($query->num_rows()>0){
          return $query;
        }else{
          return FALSE;
        }

        }
      public function verificarEmpresa($data){
        $id = $data['nit'];
        $clave = $data['clave'];
        $consulta = "SELECT * from empresas where Nit = $id and Clave = '$clave'";
        $aux = $this->db->query($consulta);
        if($aux->num_rows() > 0){
          return $aux;
        }else{
          return null;
        }

        public function cursosPorCargo($id){
        $consulta = "SELECT NombreCursoCorto nombrCurso, NombreCargo nombreCargo, IdCursoCortoSena idCurso, ca.IdCargoEmpresa idCargo
        from cursoscortossena cuse, cursoscortocargo cucar, cargosempresa ca
        where cuse.IdCursoCortoSena = cucar.IdCursoCorto and
        ca.IdCargoEmpresa = cucar.IdCargoEmpresa and ca.IdCargoEmpresa = $id";
        $query = $this->db->query($consulta);
        if($query->num_rows() > 0){
          return $query;
        }else{
          return false;
        }


      }



      }



