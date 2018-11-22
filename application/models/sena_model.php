<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class sena_model extends CI_Model {
  function __construct(){
  	parent:: __construct();
  	$this->load->database();
  }
  

  //------------------------- Registro y Login --------------------//
  function crearUsuario($data){
      date_default_timezone_set('America/Bogota');
      $fecha_actual = date("Y-m-d H:i:s");

      $this->db->insert('usuarios', array('NombreCompleto' => $data['nombre'],
                                           'Correo' => $data['correo'],
                                           'Identificacion' => $data['documento'],
                                           'Clave' => $data['contraseña'],
                                           'FechaHoraRegistro' => $fecha_actual,
                                           'FechaHoraUltimoIngreso' => $fecha_actual,
                                           'Celular' => $data['celular'],
                                          ));
    }

      public function verificarRegistro($data){
        $correo = $data['correo'];
        $documento = $data['documento'];
        $celular = $data['celular'];
        $consulta = "SELECT * FROM USUARIOS WHERE Correo = '$correo' OR Identificacion = $documento OR Celular = $celular";
        $array =  $this->db->query($consulta);

        if($array->num_rows()>0){
          return TRUE;
        }else{
          return FALSE;
        }

      }

      public function actualizarRegistro($data){
        date_default_timezone_set('America/Bogota');
        $fecha_actual = date("Y-m-d H:i:s");

        $this->db->set('FechaHoraUltimoIngreso', $fecha_actual);
        $this->db->where('Identificacion', $data['documento_l']);
        $this->db->update('usuarios');

      }

      public function verificarUsuario($data){
        $identificacion = $data['documento_l'];
        $clave = $data['contraseña_l'];
        $consulta = "SELECT * from usuarios where Identificacion = $identificacion and Clave = '$clave'";
        $aux = $this->db->query($consulta);
        if($aux->num_rows() > 0){
          return $aux;
        }else{
          return null;
        }
      }

        public function verificarCuenta($data){
        $documento = $data['documento'];
        $correo = $data['correo'];
        $consulta = "SELECT * from usuarios where Identificacion = $documento and Correo = '$correo'";
        $aux = $this->db->query($consulta);
        if($aux->num_rows() > 0){
          return $aux;
        }else{
          return null;
        }



      }

      //---------------------------------------------------------------------------- ///

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

    function cargosPorCurso() {
       $consulta = "SELECT NombreCursoCorto, NombreCargo, IdCursoCortoSena idCurso
       from cursoscortossena cuse, cursoscortocargo cucar, cargosempresa ca
       where cuse.IdCursoCortoSena = cucar.IdCursoCorto and
       ca.IdCargoEmpresa = cucar.IdCargoEmpresa";
       $query = $this->db->query($consulta);
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

      function verificarCargo($idUser, $idCargo){
    $consulta = "SELECT * from  listadeseoscargousuario lista
    where lista.IdUsuario = $idUser and IdCargoEmpresa = $idCargo";
    $query = $this->db->query($consulta);
    if ($query->num_rows() != 0) {
      return true;
    }else{
      return false;
    }
  } 

  function añadirCargo($idUser, $idCargo){
    date_default_timezone_set("America/Bogota");
    if (!$this->verificarCargo($idUser, $idCargo)) {
        $datos = array('IdUsuario' => $idUser,
        'IdCargoEmpresa' => $idCargo, 'FechaHoraRegistro' => date('Y-m-d H:i:s'));
        $this->db->insert('listadeseoscargousuario', $datos);
        return true;
    }else{
        return false;
    }

  }

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

  /*----------------------Empresas ------------- */

  function buscarEmpresa($id){
    $consulta = "SELECT e.NombreEmpresa empresa, e.RutaImagen urlImage
    from empresas e where e.IdEmpresa = $id";

   $query = $this->db->query($consulta);

   if ($query->num_rows() > 0) {
     return $query; 
   }else{
     false;
   }
  }

  function listaEmpresas(){
    $consulta = "SELECT e.IdEmpresa idEmpresa, e.NombreEmpresa nombre, e.DescripcionCorta descripcion,
   c.NombreCiudad ciudad, caem.NombreCategoriaEmpresa categoria, e.RutaImagen url
   from 
   empresas e, categoriasempresa caem, ciudades c
   where e.IdCategoria = caem.IdCategoriaEmpresa and
   e.IdCiudad = c.IdCiudad";

   $query = $this->db->query($consulta);

   if ($query->num_rows() > 0) {
     return $query; 
   }else{
     false;
   }

  }

   function empresasPorCategoria($categoria){
   $consulta = "SELECT e.IdEmpresa idEmpresa, e.NombreEmpresa nombre, e.DescripcionCorta descripcion,
   c.NombreCiudad ciudad, caem.NombreCategoriaEmpresa categoria, e.RutaImagen url
   from 
   empresas e, categoriasempresa caem, ciudades c
   where e.IdCategoria = caem.IdCategoriaEmpresa and
   e.IdCiudad = c.IdCiudad and caem.IdCategoriaEmpresa = $categoria";

   $query = $this->db->query($consulta);

   if ($query->num_rows() > 0) {
     return $query; 
   }else{
     false;
   }

  }

  function noCargosEmpresas(){
    $consulta = "SELECT car.IdCargoEmpresa id, count(*) cantidad
    from empresas e, cargosempresa car
    where e.IdEmpresa = car.IdEmpresa
    group by id";

    $query = $this->db->query($consulta);

   if ($query->num_rows() > 0) {
     return $query; 
   }else{
     false;
   }
  }

  function cargosEmpresas($id){
    $consulta = " SELECT car.IdCargoEmpresa idCargo, car.NombreCargo cargo,
    car.DescripcionCorta descripcion, car.RutaImagen url
    from empresas e, cargosempresa car
    where e.IdEmpresa = car.IdEmpresa and e.IdEmpresa = $id";
    $query = $this->db->query($consulta);
   if ($query->num_rows() > 0) {
     return $query; 
   }else{
     false;
   }
  }

  function cursosCargos(){
     $consulta = "SELECT NombreCursoCorto, NombreCargo cargo, IdCursoCortoSena idCurso, ca.IdCargoEmpresa idCargo
      from cursoscortossena cuse, cursoscortocargo cucar, cargosempresa ca
      where cuse.IdCursoCortoSena = cucar.IdCursoCorto and
      ca.IdCargoEmpresa = cucar.IdCargoEmpresa";
      $query = $this->db->query($consulta);
     if ($query->num_rows() > 0) {
       return $query; 
     }else{
       false;
     }
  }

  function cursosCargosPorId($id){
     $consulta = "SELECT NombreCursoCorto, NombreCargo cargo, IdCursoCortoSena idCurso, ca.IdCargoEmpresa idCargo
      from cursoscortossena cuse, cursoscortocargo cucar, cargosempresa ca
      where cuse.IdCursoCortoSena = cucar.IdCursoCorto and
      ca.IdCargoEmpresa = cucar.IdCargoEmpresa and ca.IdCargoEmpresa = $id";
      $query = $this->db->query($consulta);
     if ($query->num_rows() > 0) {
       return $query; 
     }else{
       false;
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
     
  


  

}

 ?>  
