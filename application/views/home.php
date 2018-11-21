<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Sena</title>
	<meta charset="utf-8">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.2/css/all.css" integrity="sha384-/rXc/GQVaYpyDdyxK+ecHPVYJSN9bmVFBvjA/9eOB+pb3F2w2N6fc5qB9Ew5yIns" crossorigin="anonymous">
	  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"> 
    <link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>css/font-awesome.min.css" />
    <link rel = "stylesheet" type = "text/css" href ="<?php echo base_url(); ?>css/styles.css">
    <script type = 'text/javascript' src = "<?php echo base_url();?>js/script.js"></script>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>

    
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
</head>
<body style="background-color: coral !important;">

<div id="notfound">
		<div class="notfound">
			<div class="notfound-bg">
				<div></div>
				<div></div>
				<div></div>
			</div>
			<h1>Bienvenido</h1>
			<h2>Escoja su rol para ingresar</h2>
			<a href="<?=base_url('/empresas');?>">Empresas</a>
			<a href="<?=base_url('/user');?>">Usuarios</a>
		</div>
	</div>


</body>
</html>