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
                <?php /*
                        $num_revisar = $this->dbPilar->num_pendientes_jurado_bor($sess->IdUser,22);
                        
                        if($num_revisar>0)
                        {
                            echo("<span  class=\"badge badge-danger badge-counter\">".$num_revisar."</span>");
                        }*/
                      
                ?>
                </a>
             </li>
            <li class="nav-item">
                <a href="#paneldictaminar" class="nav-link" data-toggle="tab">Para dictaminación 
                <?php /*
                        $num_revisar = $this->dbPilar->num_pendientes_jurado_bor($sess->IdUser,23);
                        
                        if($num_revisar>0)
                        {
                            echo("<span  class=\"badge badge-danger badge-counter\">".$num_revisar."</span>");
                        }*/
                      
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
                            
                            if ($py_asociados->num_rows()>0) {
                            foreach ($py_asociados->result() as $row) {
                                $rowTram=$this->dbPilar->getSnapRow('tesTramites',"Id = $row->IdTram");
                                if ($rowTram->Estado==21) {
                                    $rowDet=$this->dbPilar->getSnapRow('tesTramitesDet',"IdTram = $row->IdTram ORDER BY Iteracion DESC");
                                    $tesista=$this->dbPilar->inTesista($rowTram->IdTesista);
                                    $programa=$this->dbRepo->inProgramaTesista($rowTram->IdTesista);
                                    echo("<tr>
                                        <th scope='row' style='width: 10%' class='text-primary' >". $rowTram->Codigo ." </th>
                                        <td style='width: 10%'>".$programa->Nombre ."</td>
                                        <td style='width: 15%'> $tesista->Nombres, $tesista->Apellidos</td>
                                        <td style='width: 35%'> $rowDet->Titulo</td>
                                        <td style='width: 10%'>Director/Asesor</td>
                                        <td style='width: 10%' class='small text-center'><h6>
                                            <span style='display: block' class='badge badge-primary font-weight-light'> 
                                            <i class='fas fa-calendar-alt'></i> Asignación</h6></span>$rowTram->DateModif<br> <h6> 
                                            <span style='display: block' class='badge badge-primary font-weight-light'> <i class='fas fa-stopwatch'></i> Días restantes</span> </h6>2 días hábiles 
                                        </td>
                                        <td style='width: 10%'>
                                             <a onclick=\"loadForm('ctntFlow','viewPanelAceptarBor/$rowTram->Id')\" href=\"javascript:void(0)\" href='#' class='btn btn-success btn-icon-split'>
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
                               echo '<tr> <td colspan="7" class="text-center"> No tiene borradores de tesis en espera de aprobación como Director</td> </tr>';
                            }                ?>
                               
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
           
                            //$py_asociados=$this->dbPilar->getSnapView('tesJurados',"IdJurado=$sess->IdUser AND Posicion!=4");

                            $py_asociados=$this->dbPilar->getSnapView('tesJurados',"IdJurado=$sess->IdUser");
                            
                            if ($py_asociados->num_rows()>0) {
                                foreach ($py_asociados->result() as $row) {
                                    $rowTram=$this->dbPilar->getSnapRow('tesTramites',"Id = $row->IdTram");
                                    if ($rowTram->Estado==22) {
                                        //$rowDet=$this->dbPilar->getSnapRow('tesTramitesDet',"Id = $row->IdTram");
                                        $rowDet=$this->dbPilar->getSnapRow('tesTramitesDet',"IdTram = $row->IdTram ORDER BY Iteracion DESC");
                                        $tesista=$this->dbPilar->inTesista($rowTram->IdTesista);
                                        $programa=$this->dbRepo->inProgramaTesista($rowTram->IdTesista);
                                        $posicion=$this->dbPilar->posicion($row->IdTram,$sess->IdUser);
                                        $rol_texto=rolTexto($posicion);

                                        if($this->dbPilar->isBorradorRevisado($row->IdTram,$sess->IdUser, $posicion))
                                        {


                                            
                                            echo("<tr>
                                                <th scope='row' style='width: 10%' class='text-primary' >". $rowTram->Codigo ." </th>
                                                <td style='width: 10%'>".$programa->Nombre ."</td>
                                                <td style='width: 15%'> $tesista->Nombres, $tesista->Apellidos</td>
                                                <td style='width: 35%'> $rowDet->Titulo</td>
                                                <td style='width: 10%'> $rol_texto </td>
                                                <td style='width: 10%' class='small text-center'><h6>
                                                    <span style='display: block' class='badge badge-primary font-weight-light'> 
                                                    <i class='fas fa-calendar-alt'></i> Asignación</h6></span>$rowTram->DateModif<br> <h6> 
                                                    <span style='display: block' class='badge badge-primary font-weight-light'> <i class='fas fa-stopwatch'></i> Fecha de revisión </span> </h6> -- 
                                                </td>
                                                <td style='width: 10%'>
                                                    <a onclick=\"loadForm('ctntFlow','viewPanelRevisarComBor/$rowTram->Id')\" href=\"javascript:void(0)\" href='#' class='btn btn-primary btn-icon-split'>
                                                        <span class='icon text-white-50'>
                                                        <i class='fas fa-eye'></i>
                                                        </span>
                                                        <span class='text'>Ver correcciones</span>
                                                    </a>
                                                    
                                                </td> 
                                                </tr>");

                                        }
                                        else{

                                            echo("<tr>
                                                <th scope='row' style='width: 10%' class='text-primary' >". $rowTram->Codigo ." </th>
                                                <td style='width: 10%'>".$programa->Nombre ."</td>
                                                <td style='width: 15%'> $tesista->Nombres, $tesista->Apellidos</td>
                                                <td style='width: 35%'> $rowDet->Titulo</td>
                                                <td style='width: 10%'> $rol_texto </td>
                                                <td style='width: 10%' class='small text-center'><h6>
                                                    <span style='display: block' class='badge badge-primary font-weight-light'> 
                                                    <i class='fas fa-calendar-alt'></i> Asignación</h6></span>$rowTram->DateModif<br> <h6> 
                                                    <span style='display: block' class='badge badge-primary font-weight-light'> <i class='fas fa-stopwatch'></i> Días restantes</span> </h6>2 días hábiles 
                                                </td>
                                                <td style='width: 10%'>
                                                    <a onclick=\"loadForm('ctntFlow','viewPanelRevisarBor/$rowTram->Id')\" href=\"javascript:void(0)\" href='#' class='btn btn-success btn-icon-split'>
                                                        <span class='icon text-white-50'>
                                                        <i class='fas fa-arrow-right'></i>
                                                        </span>
                                                        <span class='text'>Revisar</span>
                                                    </a>
                                                    
                                                </td> 
                                                </tr>");

                                        }
                                    }
                                } 
                            }else{
                               echo '<tr> <td colspan="7" class="text-center"> No tiene borradores en espera de revisión</td> </tr>';
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
                                
                                $py_asociados=$this->dbPilar->getSnapView('tesJurados',"IdJurado=$sess->IdUser");
                                
                                if ($py_asociados->num_rows()>0) {
                                    foreach ($py_asociados->result() as $row) {
                                        $rowTram=$this->dbPilar->getSnapRow('tesTramites',"Id = $row->IdTram");
                                        if ($rowTram->Estado==23) {
                                            //$rowDet=$this->dbPilar->getSnapRow('tesTramitesDet',"Id = $row->IdTram");
                                            $rowDet=$this->dbPilar->getSnapRow('tesTramitesDet',"IdTram = $row->IdTram ORDER BY Iteracion DESC");
                                            $tesista=$this->dbPilar->inTesista($rowTram->IdTesista);
                                            $programa=$this->dbRepo->inProgramaTesista($rowTram->IdTesista);
                                            $posicion=$this->dbPilar->posicion($row->IdTram,$sess->IdUser);
                                            $rol_texto=rolTexto($posicion);

                                     
                                                echo("<tr>
                                                    <th scope='row' style='width: 10%' class='text-primary' >". $rowTram->Codigo ." </th>
                                                    <td style='width: 10%'>".$programa->Nombre ."</td>
                                                    <td style='width: 15%'> $tesista->Nombres, $tesista->Apellidos</td>
                                                    <td style='width: 35%'> $rowDet->Titulo</td>
                                                    <td style='width: 10%'> $rol_texto </td>");
                                        
                                                    $reunionDictamen=$this->dbPilar->getSnapRow('tblReuniones',"IdTramite = $row->IdTram ORDER BY Id DESC");

                                                    //print_r($reunionDictamen );


                                                    if($posicion==1) // si es presidente PROGRAMAR REUNIÓN  / DICTAMINAR
                                                    {
                                                        
                                                        if($reunionDictamen)
                                                         {
                                                             if($this->dbPilar->isBorradorDictaminado($row->IdTram,$sess->IdUser,$posicion))
                                                                {    
                                                                        echo( "<td style='width: 10%' class='small text-center'><h6>
                                                                        <span style='display: block' class='badge badge-primary font-weight-light'> 
                                                                        <i class='fas fa-calendar-alt'></i> Fecha de reunión </h6></span>$reunionDictamen->DateLimite<br> <h6> 
                                                                        <span style='display: block' class='badge badge-primary font-weight-light'>  
                                                                        <i class='fas fa-link'></i> Lugar / enlace </h6></span>$reunionDictamen->Lugar<br> <h6> 
                                                                        
                                                                        </td>
                                                                        <td style='width: 10%'>
                                                                        <a javascript:void(0) href='#' class='btn btn-primary btn-icon-split'>
                                                                        <span class='icon text-white-50'>
                                                                        <i class='fas fa-check'></i>
                                                                        </span>
                                                                        <span class='text'>Dictaminado</span>
                                                                          </a>   
                                                                        </td> 
                                                                                                            
                                                                    </tr>");

                                                                }
                                                                else
                                                                {
                                                                    echo( "<td style='width: 10%' class='small text-center'><h6>
                                                                            <span style='display: block' class='badge badge-primary font-weight-light'> 
                                                                            <i class='fas fa-calendar-alt'></i> Fecha de reunión </h6></span>$reunionDictamen->DateLimite<br> <h6> 
                                                                            <span style='display: block' class='badge badge-primary font-weight-light'>  
                                                                            <i class='fas fa-link'></i> Lugar / enlace </h6></span>$reunionDictamen->Lugar<br> <h6> 
                                                                            
                                                                        </td>
                                                                        <td style='width: 10%'>
                                                                                <a onclick=\"loadForm('ctntFlow','viewPanelDictaminarBor/$rowTram->Id')\" href=\"javascript:void(0)\" href='#' class='btn btn-success btn-icon-split'>
                                                                            <span class='icon text-white-50'>
                                                                                <i class='fas fa-check'></i>
                                                                                </span>
                                                                                <span class='text'>Dictaminar</span>
                                                                                </a>
                                                                        </td> 
                                                                                                                
                                                                </tr>");

                                                                }

                                                        }
                                                        else
                                                        {


                                                            
                                                            echo( "<td style='width: 10%' class='small text-center'><h6>
                                                                    <span style='display: block' class='badge badge-primary font-weight-light'> 
                                                                    <i class='fas fa-calendar-alt'></i> Asignación</h6></span>$rowTram->DateModif<br> <h6> 
                                                                    <span style='display: block' class='badge badge-primary font-weight-light'> <i class='fas fa-stopwatch'></i> Plazo </span> </h6> 5 días hábiles
                                                                    </td>
                                                                    <td style='width: 10%'>
                                                                    <a onclick=\"loadForm('ctntFlow','viewPanelReunion/$rowTram->Id')\" href=\"javascript:void(0)\" href='#' class='btn btn-success btn-icon-split'>
                                                                        <span class='icon text-white-50'>
                                                                        <i class='fas fa-calendar-plus'></i>
                                                                        </span>
                                                                        <span class='text'>Programar reunión</span>
                                                                    </a>
                                                                </td> 
                                                        
                                                        
                                                            </tr>");

                                                        }
                                                        

                                                    }else // SI es jurado o director  ESPERA A REUNIÓN / DICTAMINAR
                                                    {

                                                        if($reunionDictamen)
                                                        {
                                                              if($this->dbPilar->isBorradorDictaminado($row->IdTram,$sess->IdUser,$posicion))
                                                                {    
                                                                    echo( "<td style='width: 10%' class='small text-center'><h6>
                                                                    <span style='display: block' class='badge badge-primary font-weight-light'> 
                                                                    <i class='fas fa-calendar-alt'></i> Fecha de reunión </h6></span>$reunionDictamen->DateLimite<br> <h6> 
                                                                    <span style='display: block' class='badge badge-primary font-weight-light'>  
                                                                    <i class='fas fa-link'></i> Lugar / enlace </h6></span>$reunionDictamen->Lugar<br> <h6> 
                                                                    
                                                                    </td>
                                                                    <td style='width: 10%'>
                                                                    <a javascript:void(0) href='#' class='btn btn-primary btn-icon-split'>
                                                                    <span class='icon text-white-50'>
                                                                    <i class='fas fa-check'></i>
                                                                    </span>
                                                                    <span class='text'>Dictaminado</span>
                                                                      </a>   
                                                                    </td> 
                                                                                                        
                                                                </tr>");
    
                                                                }
                                                                else{

                                                                    echo( "<td style='width: 10%' class='small text-center'><h6>
                                                                    <span style='display: block' class='badge badge-primary font-weight-light'> 
                                                                    <i class='fas fa-calendar-alt'></i> Fecha de reunión </h6></span>$reunionDictamen->DateLimite<br> <h6> 
                                                                    <span style='display: block' class='badge badge-primary font-weight-light'> 
                                                                    <i class='fas fa-link'></i> Lugar/enlace </h6></span>$reunionDictamen->Lugar<br> <h6> 
                                                                    
                                                                </td>
                                                                <td style='width: 10%'>
                                                                    <a onclick=\"loadForm('ctntFlow','viewPanelDictaminarBor/$rowTram->Id')\" href=\"javascript:void(0)\" href='#' class='btn btn-success btn-icon-split'>
                                                                    <span class='icon text-white-50'>
                                                                    <i class='fas fa-check'></i>
                                                                    </span>
                                                                    <span class='text'>Dictaminar</span>
                                                                    </a>
                                                                </td> 
                                                                                                    
                                                                </tr>");
                                                                }

                                                       }
                                                       else
                                                       {
                                                           echo( "<td style='width: 10%' class='small text-center'><h6>
                                                                   <span style='display: block' class='badge badge-primary font-weight-light'> 
                                                                   <i class='fas fa-calendar-alt'></i> Asignación a presidente</h6></span>$rowTram->DateModif<br> <h6> 
                                                                   
                                                                   </td>
                                                                   <td style='width: 10%'>
                                                                   <span  class='badge badge-primary text-wrap font-weight-light'>
                                                                        
                                                                        <i class='fas fa-stopwatch'></i>
                                                                        
                                                                        <span class='text'>A la espera de reunión de dictamen</span>
                                                                   </span>
                                                               </td> 
                                                       
                                                       
                                                           </tr>");

                                                       }

                                                    }

                                        }
                                    } 
                                }else{
                                    echo '<tr> <td colspan="7" class="text-center"> No tiene borradores en espera de dictaminación</td> </tr>';
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
                            if (($this->dbPilar->comoJurado($sess->IdUser,24) > 0) OR ($this->dbPilar->comoDirector($sess->IdUser,24) > 0) )
                            {
                                $py_asociados=$this->dbPilar->getSnapView('tesJurados',"IdJurado=$sess->IdUser");
                                $rol= rolTexto($py_asociados->row()->Posicion);
                                $idJurado= $sess->IdUser ;

                                foreach($py_asociados->result() as $jurado)
                                {
                                    //$proyecto=$this->dbPilar->infoTramite($jurado->IdTram,6,5); // método antiguo
                                    
                                    $estado=$this->dbPilar->getOneField("tesTramites", "Estado", "Id=$jurado->IdTram AND Estado=24");

                                    if($estado==24)
                                    {

                                       $item=$this->dbPilar->getSnapRow('tesTramites',"Id=$jurado->IdTram AND Estado=24"); 

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

                         
                                            echo("
                                            <td style='width: 10%' class='small text-center'><h6>
                                                <span style='display: block' class='badge badge-primary'> 
                                                <i class='fas fa-calendar-alt'></i> Asignación</h6></span>".$fecha_asignacion."<br> <h6> 
                                                <span style='display: block' class='badge badge-primary'> <i class='fas fa-stopwatch'></i> Fecha de aprobación </span> </h6> -- 
                                            </td>
                                            <td style='width: 10%'>
                                                
                                                <a onclick=\"loadForm('ctntFlow','viewPanelActaBor/$idTramite')\" href=\"javascript:void(0)\" href='#' class='btn btn-primary btn-icon-split'>
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
                               echo '<tr> <td colspan="7" class="text-center"> No tiene borradores de tesis aprobados en reunión de dictámen</td> </tr>';
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