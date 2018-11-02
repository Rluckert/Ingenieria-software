<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Sena-app</title>
	<meta charset="utf-8">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.2/css/all.css" integrity="sha384-/rXc/GQVaYpyDdyxK+ecHPVYJSN9bmVFBvjA/9eOB+pb3F2w2N6fc5qB9Ew5yIns" crossorigin="anonymous">
	  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#"> <img class="logo" src="http://bootstrap-ecommerce.com/main/images/logo-white.png" height="40"> Sena-app</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar1" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbar1">
    <ul class="navbar-nav ml-auto"> 
<li class="nav-item active">
<a class="nav-link" href="<?=base_url('/user/');?>">Inicio<span class="sr-only">(current)</span></a>
</li>
<li class="nav-item dropdown">
  <a class="nav-link  dropdown-toggle" href="#" data-toggle="dropdown">Cursos&nbsp;<i class="fas fa-book"></i></a>
    <ul class="dropdown-menu">
    <li><a class="dropdown-item" href="<?=base_url('/user/listaCursos');?>">Lista de cursos</a></li>
    <li><a class="dropdown-item" href="<?=base_url('/user/rutaDeCursos/');?>">Mi ruta de cursos</a></li>
    <li><a class="dropdown-item" href="<?=base_url('/user/cursosRecomendados');?>">Cursos recomendados</a></li>
    </ul>
</li>
<li class="nav-item dropdown">
  <a class="nav-link  dropdown-toggle" href="#" data-toggle="dropdown">Cargos&nbsp;<i class="fas fa-briefcase"></i></a>
    <ul class="dropdown-menu">
    <li><a class="dropdown-item" href="<?=base_url('/user/cargosUsuario/');?>">Lista deseos de cargos</a></li>
    
    </ul>
</li>

<li class="nav-item"><a class="nav-link" href="html-components.html">Empresas&nbsp;<i class="far fa-building"></i></a></li>

<li class="nav-item"><a class="nav-link" href="<?=base_url('/user/perfilUsuario/');?>">Mi perfil&nbsp;<i class="fas fa-user-cog"></i></a></li>

    </ul>
  </div>
</nav>