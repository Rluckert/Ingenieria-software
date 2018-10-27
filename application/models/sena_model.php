<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class sena_model extends CI_Model {
  function __construct(){
  	parent:: __construct();
  	$this->load->database();
  }

  function obtenerCursos(){
    $query = $this->db->get('CursoCortosSena');
    if ($query->num_rows() > 0) {
      return $query;
    }else{
      return false;
    }
  }

  function obtenerCurso($id){
    $this->db->where('idCursoCortoSena', $id);
    $query = $this->db->get('CursoCortosSena');
    if ($query->num_rows() > 0) {
      return $query;
    }else{
      return false;
    }
    }

  //---------------- Query usuarios ------------------

  function obtenerUsuario($id){
    $this->db->where('IdUsuario', $id);
    $query = $this->db->get('Usuarios');
    if ($query->num_rows() > 0) {
      return $query;
    }else{
      return false;
    }
    }

  function modificarPerfil($id, $data){
        $datos = array('NombreCompleto'=>
        $data['nombre'], 'Correo'=>
        $data['correo'], 'Clave'=>
        $data['clave'], 'Celular'=>
        $data['celular']);

        $this->db->where('IdUsuario', $id);  
        $query = $this->db->update('Usuarios', $datos);
      }

    // --------------------------------------------------
    
    //---------------- Query cargos ---------------------

  function obtenerCargos($id){
    $consult = "SELECT NombreCargo cargo, ca.IdCargoEmpresa idCargo,
                ca.DescripcionCorta descripcion
    from usuarios u, listadeseoscargousuario li, cargosempresa ca
    where u.IdUsuario = li.IdUsuario  and
    ca.IdCargoEmpresa = li.IdCargoEmpresa and u.IdUsuario = $id";
    $query = $this->db->query($consult);

    if ($query->num_rows() > 0) {
       return $query;
     }else{
       return false;
     }
  }

  function eliminarCargoUsuario($id, $idCargo){
    $query = "DELETE FROM ListaDeseosCargoUsuario 
    WHERE IdUsuario = $id and IdCargoEmpresa = $idCargo";
    $this->db->query($query);
   
  }


  //-----------------   Cursos Usuario --------------------------------

  function cargarRutaCursos($idUser){
   $consult = "
    SELECT IdCursoCortoSena idCurso, cu.NombreCursoCorto nombreCurso, cacu.NombreCursoCorto categoria,
     hoja.EstadoFinalizado finalizado, cu.DescripcionCorta descripcion, cu.RutaImagen urlimage, cu.NoHoras horas
     from usuarios u , cursoscortossena cu, hojarutacursoscortousuario hoja, categoriacursoscortos cacu
     where u.IdUsuario = Usuarios_IdUsuario and 
       CursosCortosSena_IdCursoCortoSena = IdCursoCortoSena and cu.Categoria = cacu.IdCategoriaCursoCorto
     and IdUsuario = $idUser";

   $query = $this->db->query($consult);
    if ($query->num_rows() > 0) {
       return $query;
     }else{
       return false;
     }

  }



  function eliminarRutaCurso($id, $idCurso){
    $query = "DELETE FROM  hojarutacursoscortousuario
    WHERE Usuarios_IdUsuario = $id and CursosCortosSena_IdCursoCortoSena = $idCurso";
    $this->db->query($query);
    
  	}

  }



 ?>  
