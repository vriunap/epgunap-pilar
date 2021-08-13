<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>EPG - Pilar </title>

	<!-- Bootstrap core CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	


	<!-- Own Styles -->
	<link href="<?php echo base_url('include/');?>css/web-init.css" rel="stylesheet">

</head>

<body>

	<!-- Navigation -->
	<nav class="navbar navbar-expand-lg navbar-dark bg-purple fixed-top">
		<div class="container">
			<center><!-- <a class="navbar-brand" href="#">Plataforma <span class="text-bold text-info">EPG</span></a> --></center>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarResponsive">
				<ul class="navbar-nav ml-auto">
					<li class="nav-item active">
						<center><a class="nav-link" href="<?=base_url('inicio');?>">Inicio</a>
							<span class="sr-only">(current)</span>
						</a>
					</li>
					<li class="nav-item">
						<center><a class="nav-link" href="<?=base_url('registro');?>">Registro</a></center>
					</li>
					<li class="nav-item">
						<center><a class="nav-link" href="<?=base_url('login');?>">Acceso</a></center>
					</li>
				</ul>
			</div>
		</div>
	</nav>

	<!-- Header -->
	<header class="bg-purple py-5 mb-5">
		<div class="container h-100">
			<div class="row h-100 align-items-center">
				<div class="col-lg-12">
					<img height="100" src="<?php echo base_url('include/img/logoepg.png');?>" alt="Plataforma EPG">
					<h1 class="display-4 text-white mt-5 mb-2">Plataforma Digital - EPG</h1>
					<p class="lead mb-5 text-white-50">Bienvenidos a la <span class="text-nowrap">Versión 0.01</span> de la plataforma digital de la Escuela de Posgrado de la Universidad Nacional del Altiplano de Puno. En la que podrás realizar tus trámites y agilizar los procesos de investigación en Maestrías y Doctorados. Los servicios implementados serán progresivos, hasta completar la digitalización completa.</p>
					<center><a href="<?php echo base_url('include/docs/Reglamento_Investigacion EPG.pdf');?>"  target="_blank" class="btn btn-sm btn-default bg-white"> DESCARGAR REGLAMENTO DE INVESTIGACIÓN </a></center>
				</div>
			</div>
		</div>
	</header>

	<!-- Page Content -->
	<div class="container">

		<div class="row">
			<div class="col-md-4 mb-5">
			
				<center><a class="btn btn-acpilar bg-skyblue  btn-lg" href="<?=base_url("login");?>"> <svg class="bi bi-person-bounding-box" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
					<path fill-rule="evenodd" d="M1.5 1a.5.5 0 00-.5.5v3a.5.5 0 01-1 0v-3A1.5 1.5 0 011.5 0h3a.5.5 0 010 1h-3zM11 .5a.5.5 0 01.5-.5h3A1.5 1.5 0 0116 1.5v3a.5.5 0 01-1 0v-3a.5.5 0 00-.5-.5h-3a.5.5 0 01-.5-.5zM.5 11a.5.5 0 01.5.5v3a.5.5 0 00.5.5h3a.5.5 0 010 1h-3A1.5 1.5 0 010 14.5v-3a.5.5 0 01.5-.5zm15 0a.5.5 0 01.5.5v3a1.5 1.5 0 01-1.5 1.5h-3a.5.5 0 010-1h3a.5.5 0 00.5-.5v-3a.5.5 0 01.5-.5z" clip-rule="evenodd"/>
					<path fill-rule="evenodd" d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd"/>
				</svg> Ingresar  &raquo;</a></center>
			</div>
			<div class="col-md-4 mb-5">
				<center><a class="btn btn-acpilar bg-melon  btn-lg" href="<?=base_url("registro");?>"><svg class="bi bi-person-lines-fill" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
					<path fill-rule="evenodd" d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 100-6 3 3 0 000 6zm7 1.5a.5.5 0 01.5-.5h2a.5.5 0 010 1h-2a.5.5 0 01-.5-.5zm-2-3a.5.5 0 01.5-.5h4a.5.5 0 010 1h-4a.5.5 0 01-.5-.5zm0-3a.5.5 0 01.5-.5h4a.5.5 0 010 1h-4a.5.5 0 01-.5-.5zm2 9a.5.5 0 01.5-.5h2a.5.5 0 010 1h-2a.5.5 0 01-.5-.5z" clip-rule="evenodd"/>
				</svg> Registro &raquo;</a></center>
			</div>
			<div class="col-md-4 mb-5">
				<center><a class="btn btn-acpilar bg-lred  btn-lg" href="#"> <svg class="bi bi-shield-lock-fill" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
					<path fill-rule="evenodd" d="M5.187 1.025C6.23.749 7.337.5 8 .5c.662 0 1.77.249 2.813.525a61.09 61.09 0 012.772.815c.528.168.926.623 1.003 1.184.573 4.197-.756 7.307-2.367 9.365a11.191 11.191 0 01-2.418 2.3 6.942 6.942 0 01-1.007.586c-.27.124-.558.225-.796.225s-.526-.101-.796-.225a6.908 6.908 0 01-1.007-.586 11.192 11.192 0 01-2.417-2.3C2.167 10.331.839 7.221 1.412 3.024A1.454 1.454 0 012.415 1.84a61.11 61.11 0 012.772-.815zm3.328 6.884a1.5 1.5 0 10-1.06-.011.5.5 0 00-.044.136l-.333 2a.5.5 0 00.493.582h.835a.5.5 0 00.493-.585l-.347-2a.5.5 0 00-.037-.122z" clip-rule="evenodd"/>
				</svg>Sustentaciones &raquo;</a></center>
			</div>
		</div>
		<!-- /.row -->
	</div> 
	<!-- /.container -->

	<!-- Footer -->
	<footer class="py-5 bg-purple">
		<div class="container">
			<p class="m-0 text-center text-white">Desarrolado por &copy; OPID - VRI</p>
		</div>
		<!-- /.container -->
	</footer>

	<!-- Bootstrap core JavaScript -->
	<script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
	<!-- <script src="vendor/jquery/jquery.min.js"></script> -->
	<script src="<?php echo base_url('include/');?>js/bootstrap.bundle.min.js"></script>

</body>

</html>
