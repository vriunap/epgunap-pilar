<div class="container-fluid" id='ctntFlow'>

<div class="container-fluid mb-4">



    <h1 class="h3 mb-0 text-primary">Borrador de tesis </h1>
    <h1 class="h5 mb-0 text-gray-500">Panel docente</h1>
    <a href="http://vriunap.pe/epgunap/docentes/">
    <h1 class="h6 mt-3 text-primary font-weight-bold"><i class="fas fa-chevron-circle-left"></i> Ir al panel principal</h1>
   </a>


</div>

<div class="card  mb-4">

            <div class="card-body">
            <ul class="nav nav-tabs">
                    
            <li class="nav-item">
               <a href="#panelaceptar" class="nav-link active" data-toggle="tab">Para aceptación 
                <?php
                        $num_aceptar = $this->dbPilar->comoDirector($sess->IdUser,21);
                        
                        if($num_aceptar>0)
                        {
                        echo("<span  class=\"badge badge-danger badge-counter\">".$num_aceptar."</span>");
                        }
                ?>
               </a>
            </li>
            <li class="nav-item">
                <a href="#panelrevisar" class="nav-link" data-toggle="tab">Para revisión
                    <?php

                /*
                        $num_revisar = $this->dbPilar->num_pendientes_jurado_bor($sess->IdUser,22);
                        echo ($num_revisar);
                        if($num_revisar>0)
                        {
                            echo("<span  class=\"badge badge-danger badge-counter\">".$num_revisar."</span>");
                        }
                        */
                 ?>
                </a>
             </li>
            <li class="nav-item">
                <a href="#paneldictaminar" class="nav-link" data-toggle="tab">Para dictaminación 
                <?php
                    /*
                        $num_revisar = $this->dbPilar->num_pendientes_jurado($sess->IdUser,5);
                        
                        if($num_revisar>0)
                        {
                            echo("<span  class=\"badge badge-danger badge-counter\">".$num_revisar."</span>");
                        }
                        */
                ?>
                </a>
            </li>
            <li class="nav-item">
                <a href="#panelaprobados" class="nav-link" data-toggle="tab">Aprobados</a>
            </li>


            </ul>
            
            <div class="tab-content">
                <div class="tab-pane fade show active" id="panelaceptar">
                    <p>
                    <div class="table-responsive">
                            <table class="table  table-hover">
                            <thead>
                                <tr>
                                <th scope="col" style="width: 10%" >Código </th>
                                <th scope="col" style="width: 10%" >Programa</th>
                                <th scope="col" style="width: 15%">Tesista</th>
                                <th scope="col" style="width: 35%">Título</th>
                                <th scope="col" style="width: 10%">Rol</th>
                                <th scope="col" style="width: 10%">Plazos</th>
                                <th scope="col" style="width: 10%">Acción</th>
                                </tr>
                            </thead>
                            <tbody>

                           <?php
           
                            $py_asociados=$this->dbPilar->getSnapView('tesJurados',"IdJurado=$sess->IdUser AND Posicion=4");
                                echo $py_asociados->num_rows();
                                
                            if ($py_asociados->num_rows() > 0 )
                            { 

                                $rol= rolTexto($py_asociados->row()->Posicion);
                               

                                foreach($py_asociados->result() as $jurado)
                                {
                                    $borrador=$this->dbPilar->infoTramite($jurado->IdTram,21,20);
                                   
                                    print_r($borrador)
                                    foreach($borrador as $item)
                                    {
                            
                                        $idTramite = $item['Id'];

                                       echo("<tr>
                                        <th scope='row' style='width: 10%' class='text-primary' >". $item['Codigo'] ." </th>
                                        <td style='width: 10%'>".$item['Nombre'] ."</td>
                                        <td style='width: 15%'>".$item['Nombres'] ." ". $item['Apellidos'] ."</td>
                                        <td style='width: 35%'>".$item['Titulo'] ."</td>
                                        <td style='width: 10%'>".$rol."</td>
                                        <td style='width: 10%' class='small text-center'><h6>
                                            <span style='display: block' class='badge badge-primary'> 
                                            <i class='fas fa-calendar-alt'></i> Asignación</h6></span>".$item['DateReg'] ."<br> <h6> 
                                            <span style='display: block' class='badge badge-primary'> <i class='fas fa-stopwatch'></i> Días restantes</span> </h6>2 días hábiles 
                                        </td>
                                        <td style='width: 10%'>
                                             <a onclick=\"loadForm('ctntFlow','viewPanelAceptarBor/$idTramite')\" href=\"javascript:void(0)\" href='#' class='btn btn-success btn-icon-split'>
                                                <span class='icon text-white-50'>
                                                <i class='fas fa-arrow-right'></i>
                                                </span>
                                                <span class='text'>Revisar</span>
                                            </a>
                                            
                                        </td>
                                        </tr>");

                                    }
                                                                   
                                }

                            }else{
                               echo '<tr> <td colspan="7" class="text-center"> No tiene proyectos en espera de aprobación como Director</td> </tr>';
                            }
                            ?>
                               
                           </tbody>
                    </table>
                    </div>
                    </p>
                </div>
                <div class="tab-pane fade" id="panelrevisar">
                <p>
                    <div class="table-responsive">
                            <table class="table  table-hover">
                            <thead>
                                <tr>
                                <th scope="col" style="width: 10%">Código</th>
                                <th scope="col" style="width: 10%">Programa</th>
                                <th scope="col" style="width: 15%">Tesista</th>
                                <th scope="col" style="width: 35%">Título</th>
                                <th scope="col" style="width: 10%">Rol</th>
                                <th scope="col" style="width: 10%">Plazos</th>
                                <th scope="col" style="width: 10%">Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            
                            
                            //echo ("<br> num proyectos </br>");
                            //echo ($this->dbPilar->comoJurado($sess->IdUser,4));
                                                                                                               
                            //print_r($this->dbPilar->infoTramite(34,2));

                            if ($this->dbPilar->comoJurado($sess->IdUser,22) > 0 )
                            {
                                $py_asociados=$this->dbPilar->getSnapView('tesJurados',"IdJurado=$sess->IdUser AND Posicion!=4");
                                $rol= rolTexto($py_asociados->row()->Posicion);
                                //echo $rol;
                                //print_r($this->dbPilar->infoTramite(34,2,1));

                                $idJurado= $sess->IdUser ;

                                foreach($py_asociados->result() as $jurado)
                                {
                                    $proyecto=$this->dbPilar->infoTramite($jurado->IdTram,22,22); //
                                                                                            
                                    foreach($proyecto as $item)
                                    {
                            
                                        $idTramite = $item['Id'];

                                       echo("<tr>
                                        <th scope='row' style='width: 10%' class='text-primary' >". $item['Codigo'] ." </th>
                                        <td style='width: 10%'>".$item['Nombre'] ."</td>
                                        <td style='width: 15%'>".$item['Nombres'] ." ". $item['Apellidos'] ."</td>
                                        <td style='width: 35%'>".$item['Titulo'] ."</td>
                                        <td style='width: 10%'>".$rol."</td>");

                                        if ($this->dbPilar->isBorradorRevisado($idTramite,$idJurado,$py_asociados->row()->Posicion))
                                        {
                                                                                    
                                            echo("
                                            <td style='width: 10%' class='small text-center'><h6>
                                                <span style='display: block' class='badge badge-primary'> 
                                                <i class='fas fa-calendar-alt'></i> Asignación</h6></span>".$item['DateReg'] ."<br> <h6> 
                                                <span style='display: block' class='badge badge-primary'> <i class='fas fa-stopwatch'></i> Fecha de revisión </span> </h6> -- 
                                            </td>
                                            <td style='width: 10%'>
                                                <a onclick=\"loadForm('ctntFlow','viewPanelRevisarComBor/$idTramite')\" href=\"javascript:void(0)\" href='#' class='btn btn-primary btn-icon-split'>
                                                    <span class='icon text-white-50'>
                                                    <i class='fas fa-eye'></i>
                                                    </span>
                                                    <span class='text'>Ver correcciones</span>
                                                </a>                                            
                                            </td> ");
                                            

                                        }
                                        else
                                         {
                                        
                                            echo("
                                            <td style='width: 10%' class='small text-center'><h6>
                                                <span style='display: block' class='badge badge-primary'> 
                                                <i class='fas fa-calendar-alt'></i> Asignación</h6></span>".$item['DateReg'] ."<br> <h6> 
                                                <span style='display: block' class='badge badge-primary'> <i class='fas fa-stopwatch'></i> Días restantes</span> </h6>2 días hábiles 
                                            </td>
                                            <td style='width: 10%'>
                                                <a onclick=\"loadForm('ctntFlow','viewPanelRevisarBor/$idTramite')\" href=\"javascript:void(0)\" href='#' class='btn btn-success btn-icon-split'>
                                                    <span class='icon text-white-50'>
                                                    <i class='fas fa-arrow-right'></i>
                                                    </span>
                                                    <span class='text'>Revisar</span>
                                                </a>                                            
                                            </td> ");
                                        };
                                        
                                        
                                        echo("</tr>");

                                    }
                                                                   
                                }

                            }else{
                               echo '<tr> <td colspan="7" class="text-center"> No tiene proyectos en espera de revisión</td> </tr>';
                            }
                            ?>

                            </tbody>
                   
                    </table>
                    </div>
                    </p>
                </div>
                <div class="tab-pane fade" id="paneldictaminar">
                <p>
                    <div class="table-responsive">
                            <table class="table  table-hover">
                            <thead>
                                <tr>
                                <th scope="col" style="width: 10%" >Código</th>
                                <th scope="col" style="width: 10%" >Programa</th>
                                <th scope="col" style="width: 15%">Tesista</th>
                                <th scope="col" style="width: 35%">Título</th>
                                <th scope="col" style="width: 10%">Rol</th>
                                <th scope="col" style="width: 10%">Plazos</th>
                                <th scope="col" style="width: 10%">Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            /*
                            
                           // echo ("<br> num proyectos </br>");
                           // echo ($this->dbPilar->comoJurado($sess->IdUser,5));
                                                                                                               
                            //print_r($this->dbPilar->infoTramite(34,2));

                            if ($this->dbPilar->comoJurado($sess->IdUser,5) > 0 )
                            {
                                $py_asociados=$this->dbPilar->getSnapView('tesJurados',"IdJurado=$sess->IdUser AND Posicion!=4");
                                $rol= rolTexto($py_asociados->row()->Posicion);
                                //echo $rol;
                                //print_r($this->dbPilar->infoTramite(34,2,1));

                                $idJurado= $sess->IdUser ;

                                foreach($py_asociados->result() as $jurado)
                                {
                                    $proyecto=$this->dbPilar->infoTramite($jurado->IdTram,5,5); //
                                                                                            
                                    foreach($proyecto as $item)
                                    {
                            
                                        $idTramite = $item['Id'];

                                       echo("<tr>
                                        <th scope='row' style='width: 10%' class='text-primary' >". $item['Codigo'] ." </th>
                                        <td style='width: 10%'>".$item['Nombre'] ."</td>
                                        <td style='width: 15%'>".$item['Nombres'] ." ". $item['Apellidos'] ."</td>
                                        <td style='width: 35%'>".$item['Titulo'] ."</td>
                                        <td style='width: 10%'>".$rol."</td>");

                                        if ($this->dbPilar->isProyectoDictaminado($idTramite,$idJurado,$py_asociados->row()->Posicion))
                                        {
                                                                                    
                                            echo("
                                            <td style='width: 10%' class='small text-center'><h6>
                                                <span style='display: block' class='badge badge-primary'> 
                                                <i class='fas fa-calendar-alt'></i> Asignación</h6></span>".$item['DateReg'] ."<br> <h6> 
                                                <span style='display: block' class='badge badge-primary'> <i class='fas fa-stopwatch'></i> Fecha de dictaminación </span> </h6> -- 
                                            </td>
                                            <td style='width: 10%'>
                                                <a javascript:void(0) href='#' class='btn btn-primary btn-icon-split'>
                                                    <span class='icon text-white-50'>
                                                    <i class='fas fa-check'></i>
                                                    </span>
                                                    <span class='text'>Dictaminado</span>
                                                </a>                                            
                                            </td> ");

                                        }
                                        else
                                         {
                                        
                                            echo("
                                            <td style='width: 10%' class='small text-center'><h6>
                                                <span style='display: block' class='badge badge-primary'> 
                                                <i class='fas fa-calendar-alt'></i> Asignación</h6></span>".$item['DateReg'] ."<br> <h6> 
                                                <span style='display: block' class='badge badge-primary'> <i class='fas fa-stopwatch'></i> Días restantes</span> </h6>2 días hábiles 
                                            </td>
                                            <td style='width: 10%'>
                                                <a onclick=\"loadForm('ctntFlow','viewPanelDictaminar/$idTramite')\" href=\"javascript:void(0)\" href='#' class='btn btn-success btn-icon-split'>
                                                    <span class='icon text-white-50'>
                                                    <i class='fas fa-arrow-right'></i>
                                                    </span>
                                                    <span class='text'>Dictaminar</span>
                                                </a>                                            
                                            </td> ");
                                        };
                                        
                                        
                                        echo("</tr>");

                                    }
                                                                   
                                }

                            }else{
                               echo '<tr> <td colspan="7" class="text-center"> No tiene proyectos en espera de revisión</td> </tr>';
                            }
                           */
                            ?>
                            </tbody>
                   
                    </table>
                    </div>
                    </p>
                </div>

                <div class="tab-pane fade" id="panelaprobados">
                <p>
                    <div class="table-responsive">
                            <table class="table  table-hover">
                            <thead>
                                <tr>
                                <th scope="col" style="width: 10%" >Código</th>
                                <th scope="col" style="width: 10%" >Programa</th>
                                <th scope="col" style="width: 15%">Tesista</th>
                                <th scope="col" style="width: 40%">Título</th>
                                <th scope="col" style="width: 10%">Rol</th>
                                <th scope="col" style="width: 15%">Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            /*
                            
                            // echo ("<br> num proyectos </br>");
                            // echo ($this->dbPilar->comoJurado($sess->IdUser,5));
                                                                                                                
                             //print_r($this->dbPilar->infoTramite(34,2));

                             
                             //print_r($py_asociados->result());
                                 
 
                             if (($this->dbPilar->comoJurado($sess->IdUser,6) > 0) OR ($this->dbPilar->comoDirector($sess->IdUser,6) > 0) )
                             {
                                 $py_asociados=$this->dbPilar->getSnapView('tesJurados',"IdJurado=$sess->IdUser");
                                 $rol= rolTexto($py_asociados->row()->Posicion);
                                 
                                 //print_r($py_asociados);
 
                                 $idJurado= $sess->IdUser ;
 
                                 foreach($py_asociados->result() as $jurado)
                                 {
                                     $proyecto=$this->dbPilar->infoTramite($jurado->IdTram,6,6); //
                                                                                             
                                     foreach($proyecto as $item)
                                     {
                             
                                         $idTramite = $item['Id'];
 
                                        echo("<tr>
                                         <th scope='row' style='width: 10%' class='text-primary' >". $item['Codigo'] ." </th>
                                         <td style='width: 10%'>".$item['Nombre'] ."</td>
                                         <td style='width: 15%'>".$item['Nombres'] ." ". $item['Apellidos'] ."</td>
                                         <td style='width: 35%'>".$item['Titulo'] ."</td>
                                         <td style='width: 10%'>".$rol."</td>");
 
                                         if ($this->dbPilar->isProyectoAprobado($idTramite))
                                         {
                                                                                     
                                             echo("
                                             <td style='width: 10%' class='small text-center'><h6>
                                                 <span style='display: block' class='badge badge-primary'> 
                                                 <i class='fas fa-calendar-alt'></i> Asignación</h6></span>".$item['DateReg'] ."<br> <h6> 
                                                 <span style='display: block' class='badge badge-primary'> <i class='fas fa-stopwatch'></i> Fecha de aprobación </span> </h6> -- 
                                             </td>
                                             <td style='width: 10%'>
                                                 <a onclick=\"loadForm('ctntFlow','viewPanelActa/$idTramite')\" href=\"javascript:void(0)\" href='#' class='btn btn-primary btn-icon-split'>
                                                     <span class='icon text-white-50'>
                                                     <i class='fas fa-eye'></i>
                                                     </span>
                                                     <span class='text'>Ver acta</span>
                                                 </a>                                            
                                             </td> ");
 
                                         };
                                         echo("</tr>");
 
                                     }
                                                                   
                                 }
 
                             }else{
                                echo '<tr> <td colspan="7" class="text-center"> No tiene proyectos aprobados/td> </tr>';
                             }
                             */
                             ?>
                            
                            </tbody>
                   
                    </table>
                    </div>
                    </p>
                </div>


            </div>

              </div>
</div>
          




<!-- /.container-fluid -->
</div>