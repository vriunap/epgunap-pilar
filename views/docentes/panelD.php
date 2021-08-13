<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Pilar EPG - Docente</title>

  <!-- Custom fonts for this template-->
  
  <link href="<?php echo base_url('include/');?>css/all.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Own Styles -->
  <link href="<?php echo base_url('include/');?>css/sb-admin.css" rel="stylesheet">
  <link href="<?php echo base_url('include/');?>css/timepanel.css" rel="stylesheet">
  <link href="<?php echo base_url('include/');?>css/pnl-docente.css" rel="stylesheet">
  


</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion  bg-blue" id="accordionSidebar">
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
        <a class="nav-link" href="<?=base_url('docentes/');?>">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Panel principal</span>
        </a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

  
 
   

      <!-- Heading -->
      <div class="sidebar-heading">
        PROCESOS
      </div>

      <!-- Nav Item - Tables -->
      <li class="nav-item">

        <a class="nav-link" href="javascript:void(0)" onclick="loadForm('ctntFlow','viewListaProyecto');" >
          <i class="fas fa-fw fa-cog"></i>
          <span>Proyectos</span>
        </a>
      </li>


      <!-- Nav Item - Tables -->
      <li class="nav-item">
        <a class="nav-link" href="javascript:void(0)" onclick="loadForm('ctntFlow','viewListaBorrador');" >
          <i class="fas fa-fw fa-cog"></i>
          <span>Borradores</span>
        </a>
      </li>

      <!-- Nav Item - Tables -->
      <li class="nav-item">
<!--        <a class="nav-link" href="javascript:void(0)" onclick="loadForm('ctntFlow','msgPanel/warning/No-Disponible');" > -->
        <a class="nav-link" href="javascript:void(0)" onclick="loadForm('ctntFlow','viewListaSustentacion');" >
          <i class="fas fa-fw fa-graduation-cap"></i>
          <span>Sustentación</span>
        </a>
      </li>



      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        INFORMACIÓN ADICIONAL
      </div>

      <!-- Nav Item - Utilities Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
          <i class="fas fa-fw fa-sticky-note"></i>
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
        <a class="nav-link" href="javascript:void(0)"  >
          <i class="fas fa-fw fa-bullhorn"></i>
          <span>Buzón de mensajes</span>
        </a>
      </li>
            <!-- Nav Item - Tables -->
      <li class="nav-item">
        <a class="nav-link" href="javascript:void(0)"  >
          <i class="fas fa-fw fa-book"></i>
          <span>Manual de usuario</span>
        </a>
      </li>

                  <!-- Nav Item - Tables -->
       <li class="nav-item">
        <a class="nav-link" href="javascript:void(0)"  >
          <i class="fas fa-fw fa-tools"></i>
          <span>Utilidades</span>
        </a>
      </li>

       <!-- Divider -->
       <hr class="sidebar-divider">


        <!-- Heading -->
        <div class="sidebar-heading">
          CONFIGURACIÓN
        </div>

      <!-- Nav Item - Tables -->
      <li class="nav-item">
        <a class="nav-link" href="javascript:void(0)"  >
          <i class="fas fa-fw fa-user"></i>
          <span>Perfil docente</span>
        </a>
      </li>

            <!-- Nav Item - Tables -->
      <li class="nav-item">
        <a class="nav-link" href="javascript:void(0)"  >
          <i class="fas fa-fw fa-bell "></i>
          <span>Notificaciones</span>
        </a>
      </li>

     <!-- Nav Item - Tables -->
     <li class="nav-item">
        <a class="nav-link" href="javascript:void(0)"  >
          <i class="fas fa-fw fa-stream"></i>
          <span>Bitacora de actividad</span>
        </a>
      </li>

     <!-- Divider -->
    <hr class="sidebar-divider">

      <!-- Nav Item - Tables -->
      <li class="nav-item">
        <a class="nav-link" href="#" data-toggle="modal" data-target="#logoutModal">
          <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
          Cerrar sesión
        </a>
      </li>

     

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

     

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">


            <!-- Nav Item - Alerts -->
            <li class="nav-item dropdown no-arrow mx-1">
              <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
               
                <i class="fas fa-bell fa-fw"></i>
                <!-- Counter - Alerts -->
                <!-- <span class="badge badge-danger badge-counter">3+</span> -->
                <span class="badge badge-danger badge-counter"></span>
                
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
                  Perfil
                </a>
                <a class="dropdown-item" href="#">
                  <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                  Notificaciones
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Cerrar sesión 
                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->  

        <!-- Begin Page Content -->
        <div class="container-fluid" id='ctntFlow'>

        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-black"><i class="fas fa-fw fa-tachometer-alt"></i> Panel principal</h1>
            
            
          </div>

          <div class="row">

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-bottom-primary h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                      <?php 
                        $count=$this->dbPilar->getSnapView('tesJurados',"IdJurado=$sess->IdUser AND Estado = 1")->num_rows();
                        echo "$count";
                      ?>
                    </div>
                      <div class="text-s font-weight-bold text-primary text-uppercase mb-1">Proyectos de Tesis</div>
                     
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-sticky-note fa-2x text-primary"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-bottom-success h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="h5 mb-0 font-weight-bold text-gray-800">
                        <?php 
                        $count=$this->dbPilar->getSnapView('tesJurados',"IdJurado=$sess->IdUser AND Estado = 20")->num_rows();
                        echo "$count";
                      ?>
                      </div>
                      <div class="text-s font-weight-bold text-success text-uppercase mb-1">Borradores de Tesis</div>
                     
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-sticky-note fa-2x text-success"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-bottom-info h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="h5 mb-0 font-weight-bold text-gray-800">00</div>
                      <div class="text-s font-weight-bold text-info text-uppercase mb-1">Sustentaciones</div>
                      
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-graduation-cap fa-2x text-info"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-warning bg-warning h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-white text-uppercase mt-3">Perfil docente</div>
                      
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-user fa-2x text-white mt-1"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- ROW procesos y manuales  -->
          <div class="row">

              <!-- Content Column -->
              <div class="col-lg-4 mb-4">

                <!-- Procesos panel-->

             <!-- row divisor proyectos / borradores-->
             <div class="row">
             
                  <div class="col-sm-6  h-100">
                  
                          <div class="card bg-success text-white shadow">
                                    <div class="card-body" id='btnProyecto'>
                                        <div class="row"> 
                                        
                                            <div class="col-auto ">
                                              <i class="fas fa-angle-right fa-4x text-white mt-1"></i>
                                            </div>

                                            <div class="col-auto align-self-center text-lg">
                                            Revisa los proyectos de tesis
                                            </div>              
                                        </div>
                                    </div>
                          </div>
                  
                  </div> 

                  <div class="col-sm-6  h-100">

                      <div class="card bg-success text-white shadow">
                                <div class="card-body" id='btnBorrador'>
                                    <div class="row"> 
                                    
                                        <div class="col-auto ">
                                          <i class="fas fa-angle-right fa-4x text-white mt-1"></i>
                                        </div>

                                        <div class="col-auto align-self-center text-lg">
                                        Revisa los borradores de tesis
                                        </div>              
                                    </div>
                                </div>
                      </div>
                  </div>

              </div>
              <!-- FIN row divisor proyectos / borradores-->
             
              </div>

              <div class="col-lg-8 mb-4">

                <!-- Illustrations -->
                <div class="card mb-4">
                  <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Manuales de uso de la plataforma</h6>
                  </div>
                  <div class="card-body">
                    <div class ="row">
                      <div class="col-md-6 text-center">
                        <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 20rem;" src="<?php echo base_url('include/img/ayuda.jpg');?>" alt="">
                      </div>

                      <div class="col-md-6 text-left align-self-center">
                        <p> Revisa el manual de usuario , videos de ayuda y las preguntas frecuentes del uso de la Plataforma PILAR EPG.</p>
                        <a target="_blank" rel="nofollow" href="#">Ir → </a>
                      </div>

                    </div>
                  </div>
                </div>

              </div>

          </div>
        
        <!-- ROW comunicados y notificaciones -->
            <div class="row">
                <div class="col-lg-6 mb-4">
              <!-- card comunicado    -->
                  <div class="card h-100 mb-4">
                    <div class="card-header py-3">
                      <h6 class="m-0 font-weight-bold text-primary">Buzón de mensajes</h6>
                    </div>

                    <div class="card-body">
                                <div class="row">
                                   <div class="col-md-3 text-center align-self-center">
                                    <i class="fas fa-bullhorn fa-6x text-gray-500"></i>
                                    </div>
                                  
                                    <div class="col-md-9 align-self-center">
                                      <div class="text-gray-500 text-xs">Mensaje #1</div>
                                      <div class="text-gray-500 text-xs">Enviado por: Plataforma EPG - 2 de julio 2020</div>
                                        <br>
                                        <p>Bienvenido a la Plataforma PILAR EPG, en esta sección podrás encontrar los comunicados e información distribuida por el Programa de Posgrado acerca de los procesos de investigación</p>
                                        <a target="_blank" rel="nofollow" href="#">Leer este mensaje → </a> 
                                        <a target="_blank" rel="nofollow" href="#">Revisar todos → </a>
                                    </div>
                                </div>
                        </div>
                    </div>
              
              </div>

                <div class="col-lg-6 mb-4">
                <!-- card notificaciones    -->
                <div class="card h-100 mb-4">
                    <div class="card-header py-3">
                      <h6 class="m-0 font-weight-bold text-primary">Notificaciones</h6>
                    </div>

                    <div class="card-body">

                                                                                      
                                    <div class="col-md-9 align-self-center">
                                                                                     
                                          <a class="dropdown-item d-flex align-items-center" href="#">
                                              <div class="mr-3">
                                                <div class="icon-circle bg-primary">
                                                  <i class="fas fa-cogs text-white"></i>
                                                </div>
                                              </div>
                                              <div>
                                                <div class="small text-gray-500">1 de Julio 2020</div>
                                                <span class="font-weight-regular">Se ha configurado su cuenta correctamente</span>
                                              </div>
                                          </a>

                                        <!--
                                          <a class="dropdown-item d-flex align-items-center" href="#">
                                              <div class="mr-3">
                                                <div class="icon-circle bg-success">
                                                  <i class="fas fa-file-alt text-white"></i>
                                                </div>
                                              </div>
                                              <div>
                                                <div class="small text-gray-500">1 de Julio 2020</div>
                                                <span class="font-weight-regular">Se le ha asignado un nuevo proyecto de tesis</span>
                                              </div>
                                          </a>
                                        -->
                                        <br>
                                        <a target="_blank" rel="nofollow" href="#">Revisar todas → </a>
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
            <br>
            <br>
            <span>Universidad Nacional del Altiplano de Puno - Vicerrectorado de Investigación - Escuela de Posgrado </span>
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

  <script src="<?php echo base_url("include/js/pnl-docente.js");?>" crossorigin="anonymous"></script>

  <script src="<?php echo base_url("include/js/lightajax.js");?>" crossorigin="anonymous"></script>

  <script src="<?php echo base_url("include/js/web.js");?>" crossorigin="anonymous"></script>

  <script src="https://printjs-4de6.kxcdn.com/print.min.js"></script>


  

  

  <script>
  $(document).ready(function(){
    $('#btnProyecto').click(function(e){ loadForm('ctntFlow','viewListaProyecto'); });      
    $('#btnBorrador').click(function(e){ loadForm('ctntFlow','viewListaBorrador'); });      
  });

</script>

  

</body>

</html>
