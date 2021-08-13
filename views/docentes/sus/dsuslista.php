<div class="container-fluid" id='ctntFlow'>

<div class="container-fluid mb-4">



    <h1 class="h3 mb-0 text-primary">Exposición y defensa de tesis </h1>
    <h1 class="h5 mb-0 text-gray-500">Panel docente</h1>
    <a href="http://vriunap.pe/epgunap/docentes/">
    <h1 class="h6 mt-3 text-primary font-weight-bold"><i class="fas fa-chevron-circle-left"></i> Ir al panel principal</h1>
   </a>


</div>

<div class="card  mb-4">

            <div class="card-body">
            <ul class="nav nav-tabs">
                    
            <li class="nav-item">
               <a href="#paneldictaminar" class="nav-link active" data-toggle="tab">Para dictaminar
                <?php 
                /*
                        $num_aceptar = $this->dbPilar->comoDirector($sess->IdUser,2);
                        
                        if($num_aceptar>0)
                        {
                        echo("<span  class=\"badge badge-danger badge-counter\">".$num_aceptar."</span>");
                        }*/
                ?>
               </a>
            </li>
            <li class="nav-item">
                <a href="#panelaprobados" class="nav-link" data-toggle="tab">Para revisión
                <?php /*
                        $num_revisar = $this->dbPilar->num_pendientes_jurado($sess->IdUser,4);
                        
                        if($num_revisar>0)
                        {
                            echo("<span  class=\"badge badge-danger badge-counter\">".$num_revisar."</span>");
                        }
                      */
                ?>
                </a>
             </li>




            </ul>
            
            <div class="tab-content">
       
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
                            
                            
                     
     
                            if ($this->dbPilar->comoJurado($sess->IdUser,25) > 0 )
                            {
                              

                                $py_asociados=$this->dbPilar->getSnapView('tesJurados',"IdJurado=$sess->IdUser AND Posicion!=4"); 
                                $rol= rolTexto($py_asociados->row()->Posicion);                                
                                $idJurado= $sess->IdUser ;

                                foreach($py_asociados->result() as $jurado) 
                                { 
                                        
                                      $estado=$this->dbPilar->getOneField("tesTramites", "Estado", "Id=$jurado->IdTram AND Estado=25");
    
                                      if( $estado==25)
                                    {
                                              
                                        $item=$this->dbPilar->getSnapRow('tesTramites',"Id=$jurado->IdTram AND Estado=25"); 

                                        $rowTesista = $this->dbPilar->inTesista($item->IdTesista);
                                        $datPrograma=$this->dbRepo->inProgramaTesista($item->IdTesista);
                                        $rowDet=$this->dbPilar->getSnapRow('tesTramitesDet',"IdTram=$jurado->IdTram ORDER BY Id DESC");

                                        $programa=$datPrograma->Nombre;
                                        $codigoPy= $item->Codigo;
                                        $fecha_asignacion = $rowDet->DateReg; // capturar fecha de sustentación de la tabla donde se almacenarán las SUSTENTACIONES
                                        $nombre= $rowTesista->Nombres.", ".$rowTesista->Apellidos;
                                        $tituloPy=$rowDet->Titulo;
                                        $rol = $this->dbPilar->posicion($item->Id,$sess->IdUser);
                                        $idTramite = $item->Id;

                               

                                        
                                       echo("<tr>
                                        <th scope='row' style='width: 10%' class='text-primary' >". $codigoPy." </th>
                                        <td style='width: 10%'>".$programa ."</td>
                                        <td style='width: 15%'>".$nombre."</td>
                                        <td style='width: 35%'>".$tituloPy ."</td>
                                        <td style='width: 10%'>".rolTexto($rol)."</td>");

                                        if ($this->dbPilar->isSustentacionDictaminado($idTramite,$idJurado,$rol))
                                        {
                                                                                    
                                            echo("
                                            <td style='width: 10%' class='small text-center'><h6>
                                                <span style='display: block' class='badge badge-primary'> 
                                                <i class='fas fa-calendar-alt'></i> Exposición y defensa</h6></span>".$fecha_asignacion."<br> <h6> 
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
                                                <i class='fas fa-calendar-alt'></i> Exposición y defensa</h6></span>".$fecha_asignacion."<br> <h6> 
                                                 
                                            </td>
                                            <td style='width: 10%'>
                                                <a onclick=\"loadForm('ctntFlow','viewPanelDictaminarSus/$idTramite')\" href=\"javascript:void(0)\" href='#' class='btn btn-success btn-icon-split'>
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
                               echo '<tr> <td colspan="7" class="text-center"> No tiene ninguna exposición y defensa de tesis en espera de dictaminación</td> </tr>';

                               echo("<script>console.log('Debug php: NO tengo sustentación para dictaminar ' );</script>");
                            }
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
 
                             if (($this->dbPilar->comoJurado($sess->IdUser,6) > 0) OR ($this->dbPilar->comoDirector($sess->IdUser,6) > 0) )
                             {
                                 $py_asociados=$this->dbPilar->getSnapView('tesJurados',"IdJurado=$sess->IdUser");
                                 $rol= rolTexto($py_asociados->row()->Posicion);
                                 $idJurado= $sess->IdUser ;
 
                                 foreach($py_asociados->result() as $jurado)
                                 {
                                     //$proyecto=$this->dbPilar->infoTramite($jurado->IdTram,6,5); // método antiguo
                                     
                                     $estado=$this->dbPilar->getOneField("tesTramites", "Estado", "Id=$jurado->IdTram AND Estado=6");

                                     if($estado==6)
                                     {

                                        $item=$this->dbPilar->getSnapRow('tesTramites',"Id=$jurado->IdTram AND Estado=6"); 

                                        $rowTesista = $this->dbPilar->inTesista($item->IdTesista);
                                        $datPrograma=$this->dbRepo->inProgramaTesista($item->IdTesista);
                                        $rowDet=$this->dbPilar->getSnapRow('tesTramitesDet',"IdTram=$jurado->IdTram ORDER BY Id DESC");

                                        $programa=$datPrograma->Nombre;
                                        $codigoPy= $item->Codigo;
                                        $fecha_asignacion = $rowDet->DateReg;
                                        $nombre= $rowTesista->Nombres.", ".$rowTesista->Apellidos;
                                        $tituloPy=$rowDet->Titulo;
                                        $rol = $this->dbPilar->posicion($item->Id,$sess->IdUser);
                                        $idTramite = $item->Id;


                            
                                         
 
                                        echo("<tr>
                                         <th scope='row' style='width: 10%' class='text-primary' >". $codigoPy ." </th>
                                         <td style='width: 10%'>".$programa ."</td>
                                         <td style='width: 15%'>".$nombre ."</td>
                                         <td style='width: 35%'>".$tituloPy ."</td>
                                         <td style='width: 10%'>".rolTexto($rol)."</td>");
 
                                         //if ($this->dbPilar->isProyectoAprobado($idTramite))
                                         //{
                                                                                 //$idTramite=;

                                            // <a onclick=\"loadForm('ctntFlow','viewPanelActa/$idTramite')\" href=\"javascript:void(0)\" href='#' class='btn btn-primary btn-icon-split'>
                                            // <a onclick=\"loadForm('','')\" href=\"javascript:void(0)\" href='#' class='btn btn-primary btn-icon-split'>
                                             echo("
                                             <td style='width: 10%' class='small text-center'><h6>
                                                 <span style='display: block' class='badge badge-primary'> 
                                                 <i class='fas fa-calendar-alt'></i> Asignación</h6></span>".$fecha_asignacion."<br> <h6> 
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
 
                                         //};

                                         echo("</tr>");
 
                                     }
                                                                   
                                 }
 
                             }else{
                                echo '<tr> <td colspan="7" class="text-center"> No tiene proyectos aprobados</td> </tr>';
                             }
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