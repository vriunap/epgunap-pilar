<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Pilar EPG - Programas</title>

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
    <ul class="navbar-nav bg-darkblue  sidebar sidebar-dark accordion  bg-blue" id="accordionSidebar">
      <br>
      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?=base_url('unidades/');?>">

        <div class="sidebar-brand-text mx-3"><img  class='img-fluid' src="<?php echo base_url('include/img/logoepg.png');?>" alt="Plataforma EPG"></div>
      </a>
      <br>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
        <a class="nav-link" href="<?=base_url('unidades/');?>">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Inicio</span>
        </a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        PANEL
      </div>

      <!-- Nav Item - Tables -->
      <li class="nav-item">
        <a class="nav-link" href="javascript:void(0)" onclick="loadForm('ctntFlow','viewDocentes');" >
          <i class="fas fa-fw fa-table"></i> 
          <span>Docentes</span>
        </a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Nav Item - Logs -->
      <li class="nav-item">
        <a class="nav-link" href="javascript:void(0)" onclick="loadForm('ctntFlow','viewLog');" >
          <i class="fas fa-fw fa-table"></i>
          <span>Log de Actividades</span>
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

        <a class="nav-link" href="javascript:void(0)" onclick="loadForm('ctntFlow','viewProyectos');" >
          <i class="fas fa-fw fa-table"></i>
          <span>Proyectos</span>
        </a>
      </li>


      <!-- Nav Item - Tables -->
      <li class="nav-item">
        <a class="nav-link" href="javascript:void(0)" onclick="loadForm('ctntFlow','viewBorrador');" >
          <i class="fas fa-fw fa-table"></i>
          <span>Borradores</span>
        </a>
      </li>

      <!-- Nav Item - Tables -->
      <li class="nav-item">
        <a class="nav-link" href="javascript:void(0)" onclick="loadForm('ctntFlow','msgPanel/warning/No-Disponible');" >
          <i class="fas fa-fw fa-table"></i>
          <span>Sustentaciónes</span>
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

          <p class="d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 font-weight-bold">
            PROGRAMA EPG PILAR 2020
          </p>

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
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="mr-3">
                    <div class="icon-circle bg-primary">
                      <i class="fas fa-file-alt text-white"></i>
                    </div>
                  </div>
                  <div>
                    <div class="small text-gray-500">December 12, 2019</div>
                    <span class="font-weight-bold">A new monthly report is ready to download!</span>
                  </div>
                </a>
                <a class="dropdown-item text-center small text-gray-500" href="#">Ver toda mi Actividad</a>
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
        <div class="container-fluid" id='ctntFlow'>

          <div class="row">

            <?php 
              $countp=$this->dbPilar->getSnapView('tesTramites',"Tipo=1 AND IdPrograma=$sess->IdPrograma")->num_rows();
              $countb=$this->dbPilar->getSnapView('tesTramites',"Tipo=2 AND IdPrograma=$sess->IdPrograma")->num_rows();
              $countr=$this->dbPilar->getSnapView('tesTramites',"Tipo=0 AND IdPrograma=$sess->IdPrograma")->num_rows();
            ?>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Proyectos de Tesis</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?=$countp;?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Borradores de Tesis</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?=$countb;?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-check fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Rechazados</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?=$countr;?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-user fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Sustentaciones</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">00</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-comment fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Content Row -->
          <div class="row">

            <!-- Content Column -->
            <div class="col-lg-4 mb-4">

              <!-- Project Card Example -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Bienvenido(a)</h6>
                </div>
                <div class="card-body">
                  <p>Bienvenido a PILAR de la Escuela de Posgrado de la UNA PUNO para ver el procedimiento completo puedes ver el video descriptivo, 
                  con la finalidad de estar enterado de todo el proceso para el uso de esta plataforma.</p>
                </div>
              </div>

              <!-- Project Card Example -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Reglamentos</h6>
                </div>
                <div class="card-body">
                  <p>PRONTO ..... Bienvenido a PILAR de la Escuela de Posgrado de la UNA PUNO para ver el procedimiento completo puedes ver el video descriptivo, 
                  con la finalidad de estar enterado de todo el proceso para el uso de esta plataforma.</p>
                </div>
              </div>

            </div>

            <div class="col-lg-8 mb-4">

              <!-- Illustrations -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Linea de Tiempo</h6>
                </div>
                <div class="card-body">
                  <p>Bienvenido al área de seguimiento de tu trabajo de investigación, para ostentar el grado de maestro o doctor por la Universidad nacional del altiplano de Puno, para lo cual tienes que realizar los siguientes procesos.</p>
                  <a target="_blank" rel="nofollow" href="#">Iniciar</a>
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
          <a class="btn btn-primary" href="<?=base_url("unidades/logout");?>">Salir </a>
        </div>
      </div>
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
