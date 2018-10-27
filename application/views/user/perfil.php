<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
      <div class="card border-dark">
        <div class="card-header"><center><h3>Modificar perfil</h3></center></div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-12">
              <?php
$attributes = array('class' => 'form-horizontal');
echo form_open(base_url().'/user/actualizar', $attributes);
  $nombre = array('name' => 'nombre', 'class' => 'form-control here',
  'placeholder' => 'Escribe tu nombre:',
   'value' => $user->result()[0]->NombreCompleto);

  $identificacion = array('name' => 'identificacion', 'class' => 'form-control here', 'disabled' =>"",
  'placeholder' => '',
   'value' => $user->result()[0]->Identificacion);

  $correo = array('name' => 'correo', 'class' => 'form-control here',
  'placeholder' => 'Escribe tu nombre:',
   'value' => $user->result()[0]->Correo);

   $clave = array('name' => 'clave', 'class' => 'form-control here',
  'placeholder' => 'Escribe tu nueva clave...', 'type' => 'password');

   $celular = array('name' => 'celular', 'class' => 'form-control here',
  'placeholder' => 'Escribe tu celular',
   'value' => $user->result()[0]->Celular);

  
?>
   <div class="form-group">
    <?php 
     echo form_label('Nombre completo:', 'name'); 
     echo form_input($nombre);
    ?>
  </div>

  <div class="form-group">
    <?php 
     echo form_label('Identificacion:', 'videos'); 
     echo form_input($identificacion);
    ?>
  </div>

  <div class="form-group">
    <?php 
     echo form_label('Correo :', 'name'); 
     echo form_input($correo);
    ?>
  </div>

  <div class="form-group">
    <?php 
     echo form_label('Contraseña:', 'Contraseña'); 
     echo form_input($clave);
    ?>
  </div>


  <div class="form-group">
    <?php 
     echo form_label('Celular:', 'celular'); 
     echo form_input($celular);
    ?>
  </div>

 <center><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Modal">
  Actualizar datos
 </button></center>

<div class="modal fade" id="Modal" tabindex="-1" role="dialog"  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <center><h5 class="modal-title">Confirmar cambios</h5></center>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <center>¿Está seguro de modificar sus datos?</center>
      </div>
      <div class="modal-footer">
        <center><button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Guardar cambios</button></center>
      </div>
    </div>
  </div>
</div>

<?= form_close();?>
            </div>
          </div>

          
        </div>
      </div>
    </div>
    
  </div>
</div>


