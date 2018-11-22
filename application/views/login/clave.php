<html>
  <head>
    <meta charset="utf-8">
    <title>Login</title>
    <meta name="viewport" content="width=divice-width, initial-escale=1.0">
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <style type="text/css">
    .phcenter::-webkit-input-placeholder {
  text-align: center;

}

.log {
  position: absolute;
    /*nos posicionamos en el centro del navegador*/
    top:50%;
    left:50%;
    /*determinamos una anchura*/
    width:400px;
    /*indicamos que el margen izquierdo, es la mitad de la anchura*/
    margin-left:-200px;
    /*determinamos una altura*/
    height:300px;
    /*indicamos que el margen superior, es la mitad de la altura*/
    margin-top:-150px;
    ;
    padding:5px;
}

html{
  margin: 0px;
  padding: 0px;
}

.boxlogin {
  border-radius:16px; 
  margin: 20px auto;
  width: 320px;
  -webki-border-radius: 4px;
  -moz-border-radius: 4px; 
  box-shadow: 0px 2px 10px #585858;
  margin-top: 100px;
  background-color: transparent;


}

h1{
  margin-top: 50px;
}

input[type="number"]{
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
  border-bottom-color: #045FB4;
  background-color: transparent;
  text-align: center;

}

input[type="submit"]{
  margin-top: 15px;
  margin-bottom: 20px;
}
a{
  margin-top: 10px;
}

.boxlogin img{
  width: 100px;
  height: auto;
  

}
    </style>
  </head>
  <body>
   
   <div class="jumbotron boxlogin">

    <?= form_open('/user/recibirRecuperar');  ?>
    <?php
    $documento = array(
      'name' => 'documento',
      'placeholder' => '&#128179; Documento de identidad',
      'type' => 'number',
      'class' => 'form-control input-lg phcenter',
      'required' => ''
      
    );
    $correo = array(
      'name' => 'correo',
      'placeholder' => '&#128272; Correo',
      'type' => 'email',
      'class' => 'form-control input-lg phcenter',
      'required' => ''
    );
    $datoIngresado = array(
      'name' => 'datoIngresado',
      'class' => 'btn btn-success',
      'value' => 'Recuperar contraseña'
    );

     ?>
     <center>
      <img src="https://sistemas01.ugel03.gob.pe/consultaplazas/resource/admin/img/iconoLogin.png">
      <p></p>
     <?= form_input($documento) ?>
     <br>
     <?= form_input($correo) ?>
     
     <p align="justify"><h6 align="left" style=" padding:20px"> Se le será enviado un correo con su contraseña al email registrado con este usuario.</h6></p>
    
     <?= form_submit($datoIngresado,'') ?>
     
    <?= form_close(); ?>
     </center>
   </div>
  </body>
</html>
