<?php 
            $idtram=$rowTram->Id;
            $rowTesista = $this->dbPilar->inTesista($rowTram->IdTesista);
            $datPrograma=$this->dbRepo->inProgramaTesista($rowTram->IdTesista);
            $programa=$datPrograma->Nombre;
            $tipoPrograma = ($datPrograma->Tipo==1?"MAESTRÍA":"DOCTORADO");
            $lineaPrograma=$this->dbRepo->getOneField("dicLineasVRI","Nombre","Id=$rowTram->IdLinea");
            $subLineaPrograma=$this->dbRepo->getOneField("dicLineas","Nombre","Id=$rowTram->IdSubLinea");
            $tituloPy= $rowDet->Titulo;
            $codigoPy= $rowTram->Codigo;
            $nombre= $rowTesista->Nombres.", ".$rowTesista->Apellidos;
            $fecha_asignacion = $rowDet->DateReg;
            $ruta_archivo=$rowDet->Archivo;
            $iteracion=$rowDet->Iteracion;
            $estado=$rowTram->Estado;
            $idjurado= $sess->IdUser;
            $rol = $this->dbPilar->posicion($idtram,$sess->IdUser);
?> 



<div class="container-fluid" id='ctntFlow'>

<div class="container-fluid mb-4">

    <h1 class="h3 mb-0 text-primary">Proyecto <i class="fas fa-chevron-right fa-xs"></i> Dictaminación </h1>
    <br>
    <h1 class="h5 mb-0 text-black"><?php echo($tituloPy) ?> </h1>
    <br>
        
    <h1 class="h6 mb-0 text-gray-800 ">
      <span class="font-weight-bold">Código:</span> <?php echo($codigoPy) ?> <br>
      <span class="font-weight-bold">Tesista:</span> <?php echo($nombre) ?> <br>
      <span class="font-weight-bold">Programa:</span> <?php echo($programa) ?>
   </h1>
    <br>
    <span  class="badge badge-dark"> 
    <i class="fas fa-calendar-alt"></i> Asignación : </span> <?php echo($fecha_asignacion) ?> <span class="badge badge-dark"> <i class="fas fa-stopwatch"></i> Días restantes para dictaminación :</span> 2 días hábiles 
    <br>
    <br>
    <a href="javascript:void(0)" onclick="loadForm('ctntFlow','viewListaProyecto');">
    <h1 class="h6 mb-0 text-primary font-weight-bold"><i class="fas fa-chevron-circle-left"></i> Ver todos los proyectos</h1>
    </a>

</div>

<div class="card  mb-4">

            <div class="card-body">
            
            <div class="row">
            
                <div class="col-lg-9 mb-4">
                    

                  <embed src= "<?php echo (base_url("opfile/").$ruta_archivo) ?>" width="100%" height="800">

                </div>
                <div class="col-lg-3 mb-4">
                

                         <a onclick="modalVentana('mdDictaminar1')" href="javascript:void(0)" class="btn btn-success btn-icon-split" style="display:block">
                                                <span class="icon text-white-50 float-left">
                                                <i class="fas fa-check"></i>
                                                </span>
                                                <span class="text">Aprobar sin observaciones</span>
                        </a>
                        <br>
                        <a onclick="modalVentana('mdDictaminar2')" href="javascript:void(0)" class="btn btn-success btn-icon-split" style="display:block">
                                                <span class="icon text-white-50 float-left">
                                                <i class="fas fa-check"></i>
                                                </span>
                                                <span class="text">Aprobar con observaciones menores</span>
                        </a>
                        <br>
                        <a onclick="modalVentana('mdDictaminar3')" href="javascript:void(0)" class="btn btn-danger btn-icon-split" style="display:block">
                                                <span class="icon text-white-50 float-left">
                                                <i class="fas fa-check"></i>
                                                </span>
                                                <span class="text">Desaprobar</span>
                        </a>
               
                        <br>
                            <label>Correcciones realizadas previamente en la etapa de revisión</label>
                            <div id="divListaCorrecciones">
                                <div class="list-group" style="max-height: 330px;  margin-bottom: 10px; overflow-y:scroll;  -webkit-overflow-scrolling: touch;">
                                      <?php                                      
                                          foreach($correcciones as $item)
                                          {    
                                          echo("        
                                              <a href='#' class='list-group-item list-group-item-action flex-column align-items-start'>
                                              <div class='d-flex w-100 justify-content-between'>
                                              <h6 class='mb-1'># ".$item['numero']."</h6>
                                              <small>".$item['fecha']."</small>
                                              </div>
                                              <p class='mb-1'>".$item['mensaje']."</p>
                                              </a>
                                              "); 
                                          }  

                                      ?>


                                </div>
                            </div>

                        <br>    
                        <hr>                      
                        <h1 class="h6 mb-0 text-gray-600">
                                                 
                            <a href="<?php echo (base_url("opfile/").$ruta_archivo) ?>" download>
                               <i class="fas fa-file-download"></i> Descargar proyecto
                            </a>
                            <br>
                            <a  href="#" onclick="printJS({printable:'<?php echo (base_url("opfile/").$ruta_archivo) ?>', type:'pdf', showModal:true})">
                                <i class="fas fa-print"></i> Imprimir proyecto
                            </a>
                        
                        </h1>

                </div>
                
            </div>
           </div>
</div>
          


<!-- modals -->
<!--Aprobar sin observaciones  -->

<div class="modal fade" id="mdDictaminar1" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      
      <div class="modal-body">
        <div class="container-fluid mb-5">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button> 
        </div>
                    <div class="row h-100 m-4">
                        <div class="col-sm-4 align-self-center">
                        <i class="fas fa-check fa-5x text-success"></i>
                         </div>
                         <div class="col-sm-8 align-self-center text-justify text-interWin" id="divAccion">
                            Esta a punto de finalizar el proceso de dictaminación de proyecto de tesis aprobándolo sin ninguna observación.
                         </div>
                         
                      </div>
      </div>
      <div class="modal-footer mr-4">
        <button type="button" class="btn btn-link text-gray-500"  data-dismiss="modal"> Cancelar </button>
        <a onclick="saveNclose('finDictaminacion/<?php echo($idtram)?>/<?php echo($rol)?>/1','mdDictaminar1','divAccion','viewListaProyecto')" href="javascript:void(0)"  type="button" class="btn btn-success"> Aceptar </a>
      </div>
    </div>
  </div>
</div>


<!--Aprobar con observaciones menores  -->

<div class="modal fade" id="mdDictaminar2" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      
      <div class="modal-body">
        <div class="container-fluid mb-5">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button> 
        </div>
                    <div class="row h-100 m-4">
                        <div class="col-sm-4 align-self-center">
                        <i class="fas fa-check fa-5x text-success"></i>
                         </div>
                         <div class="col-sm-8 align-self-center text-justify text-interWin" id="divAccion">
                            Registre las observaciones al proyecto antes de su aprobación
                           
                            <form method="POST" name="frmCorreccion" id="frmCorreccion" onsubmit ="sendForm('divListaCorreccionesModal','regCorreccion',frmCorreccion); return false;" enctype="multipart/form-data" accept-charset="utf-8">        
                                <div class="form-group">
                                      <label for="textoCorreccion"></label>
                                      <textarea class="form-control" id="textoCorreccion"   name="textoCorreccion" rows="3" maxlength="512" placeholder="(El número límite de caracteres por correción es de 512)"></textarea>
                                      <input type="hidden" id="idTramite" name="idTramite" value=<?php echo($idtram) ?>>
                                      <input type="hidden" id="iteracion" name="iteracion" value=<?php echo($iteracion) ?>>
                                      <input type="hidden" id="estado" name="estado" value=<?php echo($estado) ?>>
                                      <input type="hidden" id="idDocente" name="idDocente" value=<?php echo($idjurado) ?>>
                                      <input type="hidden" id="rol" name="rol" value=<?php echo($rol) ?>>
                                      
                                  </div>

                                  <button type="submit" onclick="limpiar()" class="btn btn-success btn-icon-split btn-block" id="btnEnviar"  >
                                                          <span class="icon text-white-50 float-left">
                                                          <i class="fas fa-plus"></i>
                                                          </span>
                                                          <span class="text">Agregar corrección</span>
                                  </button>
                                  <br><br>
                          </form>
                          <div id="divListaCorreccionesModal">
                          </div>
                      
                         </div>
                         
                      </div>
      </div>
      <div class="modal-footer mr-4">
        <button type="button" class="btn btn-link text-gray-500"  data-dismiss="modal"> Cancelar </button>
        <a onclick="saveNclose('finDictaminacion/<?php echo($idtram)?>/<?php echo($rol)?>/2','mdDictaminar2','divAccion','viewListaProyecto')" href="javascript:void(0)"  type="button" class="btn btn-success"> Aceptar </a>
      </div>
    </div>
  </div>
</div>

<!-- desaprobar -->

<div class="modal fade" id="mdDictaminar3" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      
      <div class="modal-body">
        <div class="container-fluid mb-5">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button> 
        </div>
                    <div class="row h-100 m-4">
                        <div class="col-sm-4 align-self-center">
                        <i class="fas fa-ban fa-5x text-cancel"></i>
                         </div>
                         <div class="col-sm-8 align-self-center text-justify text-interWin" id="divAccion">
                            Esta a punto de desaprobar este proyecto de tesis.
                         </div>
                         
                      </div>
      </div>
      <div class="modal-footer mr-4">
        <button type="button" class="btn btn-link text-gray-500"  data-dismiss="modal"> Cancelar </button>
        <a onclick="saveNclose('finDictaminacion/<?php echo($idtram)?>/<?php echo($rol)?>/-1','mdDictaminar3','divAccion','viewListaProyecto')" href="javascript:void(0)"  type="button" class="btn btn-success"> Aceptar </a>
      </div>
    </div>
  </div>
</div>




<!-- /.container-fluid -->
</div>