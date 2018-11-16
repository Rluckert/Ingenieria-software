<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class sena_model extends CI_Model {
  function __construct(){
  	parent:: __construct();
  	$this->load->database();
  }

  function obtenerCursos(){
    $consult = "SELECT IdCursoCortoSena, cuse.NombreCursoCorto, cuse.DescripcionCorta,
    NoHoras, cat.NombreCursoCorto categoria, RutaImagen url
    from cursoscortossena cuse, categoriacursoscortos cat
    where cuse.Categoria = cat.IdCategoriaCursoCorto";
    $query = $this->db->query($consult);
    if ($query->num_rows() > 0) {
      return $query;
    }else{
      return false;
    }
  }

  function obtenerCurso($id){
    $this->db->where('idCursoCortoSena', $id);
    $query = $this->db->get('cursoscortossena');
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

  function verificarCurso($idUser, $idCurso){
    $consulta = "SELECT * from hojarutacursoscortousuario hoja
    where hoja.Usuarios_IdUsuario = $idUser and hoja.CursosCortosSena_IdCursoCortoSena = $idCurso";
    $query = $this->db->query($consulta);
    if ($query->num_rows() != 0) {
      return true;
    }else{
      return false;
    }
  } 

  function añadirRutaCursos($idUser, $idCurso){
    date_default_timezone_set("America/Bogota");
    if (!$this->verificarCurso($idUser, $idCurso)) {
        $datos = array('Usuarios_IdUsuario' => $idUser,
        'CursosCortosSena_IdCursoCortoSena' => $idCurso, 'FechaRegistro' => date('Y-m-d H:i:s'),
        'EstadoFinalizado' => 0);
        $this->db->insert('hojarutacursoscortousuario', $datos);
        return true;
    }else{
        return false;
    }
      
  }

  function cargarRutaCursos($idUser){
   $consult = "
    SELECT IdCursoCortoSena idCurso, cu.NombreCursoCorto nombreCurso, cacu.NombreCursoCorto categoria,
     hoja.EstadoFinalizado finalizado, cu.DescripcionCorta descripcion, cu.RutaImagen urlimage, cu.NoHoras horas,
     RutaImagen url
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

    function cursosRecomendados($id){
      $consult = "SELECT cs.IdCursoCortoSena idCurso, cs.NombreCursoCorto nombreCurso,
      cs.DescripcionCorta descripcion, cs.NoHoras horas, cs.RutaImagen url,
      cat.NombreCursoCorto categoria
      from usuarios u
      inner join listadeseoscargousuario lu
        on u.IdUsuario = lu.IdUsuario
      inner join cargosempresa ce
        on lu.IdCargoEmpresa = ce.IdCargoEmpresa
      inner join cursoscortocargo cc
        on ce.IdCargoEmpresa = cc.IdCargoEmpresa
      left join cursoscortossena cs
        on cc.IdCursoCorto = cs.IdCursoCortoSena
      inner join categoriacursoscortos cat
        on cat.IdCategoriaCursoCorto = cs.Categoria
      left join hojarutacursoscortousuario hc
        on cs.IdCursoCortoSena = hc.CursosCortosSena_IdCursoCortoSena 
        and hc.Usuarios_IdUsuario = u.IdUsuario
      where u.IdUsuario = $id
      and hc.id is null";

    $query = $this->db->query($consult);
    if ($query->num_rows() > 0) {
      return $query;
    }else{
      return false;
    }

    }


  

}

 ?>  
