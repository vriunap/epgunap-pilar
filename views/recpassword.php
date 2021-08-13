<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Pilar EPG - Password</title>

  <!-- Custom fonts for this template-->
  
  <link href="<?php echo base_url('include/');?>css/all.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Own Styles -->
  <link href="<?php echo base_url('include/');?>css/sb-admin.css" rel="stylesheet">
  <link href="<?php echo base_url('include/');?>css/timepanel.css" rel="stylesheet">

</head>

<body class="bg-purple">

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-6 col-md-8">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-2">Olvidaste tu contraseña?</h1>
                    <p class="mb-4">Aún estamos implementado este módulo pero pronto podrás realizarlo !</p>
                  </div>
                  <form class="user">
                    <div class="form-group">
                      <input type="email" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Correo Electrónico">
                    </div>
                    <a href="#" class="btn btn-primary btn-user btn-block" disabled="">
                      Cambiar mi Contraseña
                    </a>
                  </form>
                  <hr>
                  <div class="text-center">
                    <a class="small" href="<?=base_url('registro');?>">Crear una Cuenta!</a>
                  </div>
                  <div class="text-center">
                    <a class="small" href="<?=base_url('login');?>">Ya tienes Cuenta ? Accede!</a>
                  </div>
                </div>  
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

</body>

</html>
