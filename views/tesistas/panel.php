<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>PILAR EPG - Tesista</title>

  <!-- Custom fonts for this template-->
  
  <link href="<?php echo base_url('include/');?>css/all.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Own Styles -->
  <link href="<?php echo base_url('include/');?>css/sb-admin.css" rel="stylesheet">
  <link href="<?php echo base_url('include/');?>css/timepanel.css" rel="stylesheet">


</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-purple  sidebar sidebar-dark accordion  bg-purple" id="accordionSidebar">
      <br>
      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?=base_url('tesistas/');?>">

        <div class="sidebar-brand-text mx-3"><img  class='img-fluid' src="<?php echo base_url('include/img/logoepg.png');?>" alt="Plataforma EPG"></div>
      </a>
      <br>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
        <a class="nav-link" href="<?=base_url('tesistas/');?>">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Inicio</span>
        </a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        ETAPAS
      </div>

      <!-- Nav Item - Tables -->
      <li class="nav-item">
        <a class="nav-link" href="javascript:void(0)" onclick="loadForm('ctntFlow','viewProyecto');" >
          <i class="fas fa-fw fa-table"></i>
          <span>Proyecto</span>
        </a>
      </li>


      <!-- Nav Item - Tables -->
      <li class="nav-item">
        <a class="nav-link" href="javascript:void(0)" onclick="loadForm('ctntFlow','viewBorrador');">
          <i class="fas fa-fw fa-table"></i>
          <span>Borrador</span>
        </a>
      </li>

      <!-- Nav Item - Tables -->
      <li class="nav-item">
        <a class="nav-link" href="javascript:void(0)" onclick="loadForm('ctntFlow','viewSustentac');">
          <i class="fas fa-fw fa-table"></i>
          <span>Sustentación</span>
        </a>
      </li>


      
      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        COMPLEMENTOS
      </div>

      <!-- Nav Item - Utilities Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
          <i class="fas fa-fw fa-wrench"></i>
          <span>Formatos</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Formatos Investigación:</h6>
            <a class="collapse-item" href="<?php echo base_url('include/docs/Anexopy2.docx');?>">Proyecto cualitativo</a>
            <a class="collapse-item" href="<?php echo base_url('include/docs/Anexopy1.docx');?>">Proyecto cuantitativo</a>
            <a class="collapse-item" href="<?php echo base_url('include/docs/Anexo2bor.docx');?>">Borrador cualitativo</a>
            <a class="collapse-item" href="<?php echo base_url('include/docs/Anexo1bor.docx');?>">Borrador cuantitativo</a>
            <a class="collapse-item" href="<?php echo base_url('include/docs/INFORME FINAL cualitativa.pdf');?>" target="_blank" >Informe cualitativo</a>
            <a class="collapse-item" href="<?php echo base_url('include/docs/INFORME FINAL cuantitativa.pdf');?>" target="_blank">Informe cuantitativo</a>
          </div>
        </div>
      </li>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-cog"></i>
          <span>Repositorio</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Formatos Repositorio:</h6>
            <a class="collapse-item" href="#">Constancia</a>
            <a class="collapse-item" href="#">Solicitud</a>
          </div>
        </div>
      </li>

      <!-- Nav Item - Tables -->
      <li class="nav-item">
        <a class="nav-link" href="#" data-toggle="modal" data-target="#logoutModal">
          <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
          Salir
        </a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

        <!--
          <p class="d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 font-weight-bold">
            PILAR EPG 2020
          </p>
        -->
        <!-- Topbar Navbar -->
        <ul class="navbar-nav ml-auto">


          <!-- Nav Item - Alerts -->
          <li class="nav-item dropdown no-arrow mx-1">
            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Log de Actividades
              <i class="fas fa-bell fa-fw"></i>
              <!-- Counter - Alerts -->
              <!-- <span class="badge badge-danger badge-counter">3+</span> -->
            </a>
            <!-- Dropdown - Alerts -->
            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
              <h6 class="dropdown-header">
                Log de Actividades en PILAR
              </h6>

              <?php 
                $log=$this->dbLog->getSnapRow('logAccesos',"IdUsuario=$sess->IdUser AND Tipo = 1 ORDER BY DateReg DESC");
               ?>
              <a class="dropdown-item d-flex align-items-center" href="#">
                <div class="mr-3">
                  <div class="icon-circle bg-info">
                    <i class="fas fa-file-alt text-dark"></i>
                  </div>
                </div>
                <div>
                  <div class="small text-gray-500"><?=$log->DateReg;?></div>
                  <span class="font-weight-normal"><?php echo " $log->Accion : $log->OS <br> $log->IP";?></span>
                </div>
              </a>
              <a class="dropdown-item text-center small text-gray-500" href="#">Ver toda mi Actividad</a>
            </div>
          </li>

          <!-- Nav Item - Messages -->
          <li class="nav-item dropdown no-arrow mx-1">
            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Mensajes
              <i class="fas fa-envelope fa-fw"></i>
            </a>
            <!-- Dropdown - Messages -->
            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
              <h6 class="dropdown-header">
                Bandeja de Entrada
              </h6>
              <?php 
                $mail=$this->dbLog->getSnapRow('logCorreos',"Correo='$sess->Correo' ORDER BY Fecha DESC");
              ?>
              <a class="dropdown-item d-flex align-items-center" href="#">
                <div class="dropdown-list-image mr-3">
                  <img class="rounded-circle" src="https://source.unsplash.com/fn_BT9fwg_E/60x60" alt="">
                  <div class="status-indicator bg-success"></div>
                </div>
                <div class="font-weight-bold">
                  <div class="text-truncate"><?=$mail->Asunto;?>.</div>
                  <div class="small text-gray-500">Fecha : <?=$mail->Fecha;?></div>
                </div> 
              </a>
              <a class="dropdown-item text-center small text-gray-500" href="#">Leer Todos los Mensajes</a>
            </div>
          </li>

          <div class="topbar-divider d-none d-sm-block"></div>

          <!-- Nav Item - User Information -->
          <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?=$sess->NameUser;?></span>
              <i class="fas fa-user fa-fw"></i>
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
              <a class="dropdown-item" href="#">
                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                Perfil de Usuario
              </a>
              <a class="dropdown-item" href="#">
                <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                Log de Actividades
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                Salir 
              </a>
            </div>
          </li>

        </ul>

      </nav>
      <!-- End of Topbar -->

      <!-- Begin Page Content -->
      <div class="container" id='ctntFlow'>

        <!-- Content Row -->
        <div class="row">

          <div class="col-lg-12 mb-1">

            <div class="card-inicio mb-0">
              <div class="card-header-inicio py-2">
                <h2 class="m-0 font-weight-bold text-menu">PILAR : Plataforma EPG</h2>
              </div>
              <div class="card-body">
                <p>Este el panel principal, desde aquí podrás tener acceso directo a las funciones y características principales de la plataforma</p>
              </div>
            </div>

          </div>
        </div>
        <div class="row">
          <div class="col-lg-6 mb-4">
            <div class="card mb-4">
              <div class="card-header py-2">
                <h6 class="m-0 font-weight-bold text-menu">Reglamentos</h6>
              </div>

              <div class="card-body">
                <div class="row">
                  <div class="col-md-4">
                    <i class="fas fa-book-open fa-4x text-menu"></i>

                  </div>

                  <div class="col-md-8">
                    <p>Obtén los reglamentos de proyecto y borrador de tesis</p>
                  </div>
                </div> 
              </div>
            </div>
            <div class="card mb-4">
              <div class="card-header py-2">
                <h6 class="m-0 font-weight-bold text-menu">Formatos</h6>
              </div>

              <div class="card-body">
                <div class="row">
                  <div class="col-md-4">
                    <i class="fas fa-file-word fa-4x text-menu"></i>
                  </div>

                  <div class="col-md-8">
                    <p>Descarga los formatos de proyecto y borrador de tesis tanto para investigaciones cualitativas como cuantitativas</p>
                  </div>
                </div> 
              </div>
            </div>
            <div class="card mb-4">
              <div class="card-header py-2">
                <h6 class="m-0 font-weight-bold text-menu">Configuración</h6>
              </div>

              <div class="card-body">
                <div class="row">
                  <div class="col-md-4">
                    <i class="fas fa-cogs fa-4x text-menu"></i>
                  </div>

                  <div class="col-md-8">
                    <p>Revise y modifique los ajustes de usuario de su cuenta.</p>
                  </div>
                </div> 
              </div>
            </div>
          </div>
          <div class="col-lg-6 mb-4">
            <div class="card mb-4">
              <div class="card-header py-2">
                <h6 class="m-0 font-weight-bold text-menu">Herramientas</h6>
              </div>

              <div class="card-body">
                <div class="row">
                  <div class="col-md-4">
                    <i class="fas fa-toolbox fa-4x text-menu"></i>
                  </div>

                  <div class="col-md-8">
                    <p>Aquí encontrarás herramientas que te ayudarán a desarrollar tu trabajo de investigación.</p>
                  </div>
                </div> 
              </div>
            </div>
            <div class="card mb-4">
              <div class="card-header py-2">
                <h6 class="m-0 font-weight-bold text-menu">Líneas de investigación</h6>
              </div>

              <div class="card-body">
                <div class="row">
                  <div class="col-md-4">
                    <i class="fas fa-th-list fa-4x text-menu"></i>
                  </div>

                  <div class="col-md-8">
                    <p>Revise las líneas de investigación de su programa y los docentes que la integran</p>
                  </div>
                </div> 
              </div>
            </div>
            <div class="card mb-4">
              <div class="card-header py-2">
                <h6 class="m-0 font-weight-bold text-menu">Ayuda</h6>
              </div>

              <div class="card-body">
                <div class="row">
                  <div class="col-md-4">
                    <i class="fas fa-question-circle fa-4x text-menu"></i>
                  </div>

                  <div class="col-md-8">
                    <p>Encuentra el manual de usuario, banco de preguntas y otras herramientas de ayuda.</p>
                  </div>
                </div> 
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Footer -->
<footer class="sticky-footer bg-white">
  <div class="container my-auto">
    <div class="copyright text-center my-auto">
      <span>Desarrolado por  &copy; OPID - VRI </span>
    </div>
  </div>
</footer>
<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
  <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Salir de PILAR ?</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">Al salir se guardará el registro para salvaguardar sus datos e integridad de la cuenta. <br> Gracias por usar PILAR.</div>
      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
        <a class="btn btn-primary" href="<?=base_url("tesistas/logout");?>">Salir </a>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="modalt">
    <div class="modal-dialog modal-dialog-centered text-center" role="document">
        <span class="fa fa-spinner fa-spin fa-3x w-100"></span>
    </div>
</div>

<!-- Bootstrap core JavaScript -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<!-- <script src="vendor/jquery/jquery.min.js"></script> -->
<script src="<?php echo base_url('include/');?>js/bootstrap.bundle.min.js"></script>



<script src="<?php echo base_url('include/');?>js/jquery.easing.js"></script>

<!-- Custom scripts for all pages-->
<script src="<?php echo base_url('include/');?>js/sb-admin-2.js"></script>

<script src="<?php echo base_url("include/js/lightajax.js");?>" crossorigin="anonymous"></script>

<script src="<?php echo base_url("include/js/web.js");?>" crossorigin="anonymous"></script>


</body>

</html>

