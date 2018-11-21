<html>
  <head>
    <meta charset="utf-8">
    <title>Registro</title>
    <meta name="viewport" content="width=divice-width, initial-escale=1.0">
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <style type="text/css">
    .phcenter::-webkit-input-placeholder {
  text-align: center;

}
.boxregistro {
  border-radius:16px; 
  margin: 20px auto;
  width: 80%;
  -webki-border-radius: 4px;
  -moz-border-radius: 4px; 
  box-shadow: 0px 2px 10px #585858;
  margin-top: 100px;
  background-color: transparent;
  
}

input[type="text"]{
  margin-top: 15px;
  margin-bottom: 15px;
  border-radius: 20px;
  border-top: 0px;
  border-right: 0px;
  border-left: 0px;
  border-bottom-color: #298A08;
  background-color: transparent;
  text-align: center;
}

input[type="number"]{
  margin-top: 15px;
  margin-bottom: 15px;
  border-radius: 20px;
  border-top: 0px;
  border-right: 0px;
  border-left: 0px;
  border-bottom-color: #298A08;
  background-color: transparent;
  text-align: center;
}
input[type="email"]{
  margin-top: 15px;
  margin-bottom: 15px;
  border-radius: 20px;
  border-top: 0px;
  border-right: 0px;
  border-left: 0px;
  border-bottom-color: #298A08;
  background-color: transparent;
  text-align: center;
}

input[type="password"]{
  margin-top: 15px;
  margin-bottom: 15px;
  border-radius: 20px;
  border-top: 0px;
  border-right: 0px;
  border-left: 0px;
  border-bottom-color: #298A08;
  background-color: transparent;
  text-align: center;

}

input[type="submit"]{
  margin-top: 15px;
  margin-bottom: 20px;
}
  </style>
  </head>
  <body>

    <div class="jumbotron boxregistro"> 
      <p><a href="<?= base_url().'user'?>" style="color:#298A08">Atras</a></p>
     <center>


        <?= form_open('/empresas/recibirDatos'); ?>
      <?php
       
        $nombre = array(
          'name' => 'nombre',
          'placeholder' => 'Nombre empresa',
          'type' => 'text',
          'class' => 'form-control input-lg phcenter',
          'required' => ''

        );
        $descripcion = array(
          'name' => 'descripcion',
          'placeholder' => 'Descripcion de la empresa',
          'type' => 'text',
          'class' => 'form-control input-lg phcenter',
          'required' => ''
        );
        $nit = array(
          'name' => 'nit',
          'placeholder' => 'Nit de la empresa',
          'type' => 'number',
          'class' => 'form-control input-lg phcenter',
      'required' => ''
        );
        
         $correo = array(
          'name' => 'correo',
          'placeholder' => 'Correo de la empresa',
          'type' => 'email',
          'class' => 'form-control input-lg phcenter',
          'required' => ''
        );

        $contraseña = array(
          'name' => 'clave',
          'placeholder' => 'Clave',
          'type' => 'password',
          'class' => 'form-control input-lg phcenter',
          'required' => ''
        );

        $registrarme = array(
          'name' => 'Registrar',
          'class' => 'btn btn-success',
         'value' => 'Registrar'
        );
       ?>

       <?= form_input($nombre) ?>
       <br>

       <?= form_input($descripcion) ?>
       <br>
       
       <?= form_input($nit) ?>
       <br>

        <?= form_input($correo) ?>
       <br>
       
       <?= form_input($contraseña) ?>
       <br>
       
       <br>
        <div class="form-group">
       <select name="categoria" class="form-control">
        <?php 
         foreach ($categorias->result() as $categoria) {
           echo "<option value='$categoria->id'>".$categoria->nombre."</option>";
         }
        ?>
         
       </select>
     </div>

       <br>
       <div class="form-group">
       <select name="ciudad" class="form-control">
         <?php 
         foreach ($ciudades->result() as $ciudad) {
           echo "<option value='$ciudad->id'>".$ciudad->nombre."</option>";
         }
        ?>
         
       </select>
     </div>

     <?= form_submit($registrarme,'') ?>




      <?= form_close(); ?>
     </center>
    </div>
  </body>
</html>