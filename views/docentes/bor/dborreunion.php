<div class="container-fluid" id='ctntFlow'>

<div class="container-fluid mb-4">

    <h1 class="h3 mb-0 text-primary">Borrador <i class="fas fa-chevron-right fa-xs"></i> Programar reunión de dictamen </h1>
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
    <i class="fas fa-calendar-alt"></i> Asignación : </span> <?php echo($fecha_asignacion) ?> <span class="badge badge-dark"> <i class="fas fa-stopwatch"></i> Días restantes para revisión :</span> 5 días hábiles 
    <br>
    <br>
    <a href="javascript:void(0)" onclick="loadForm('ctntFlow','viewListaBorrador');">
    <h1 class="h6 mb-0 text-primary font-weight-bold"><i class="fas fa-chevron-circle-left"></i> Ver todos los borradores</h1>
    </a>

</div>

<div class="card  mb-4">

            <div class="card-body">
            
            <div class="row">
            
                <div class="col-lg-9 mb-4">
                    <embed src="<?php echo (base_url("opfile/").$ruta_archivo) ?>" width="100%" height="800">

                </div>
                <div class="col-lg-3 mb-4">
                
                
                <form method="POST" name="frmReunion" id="frmReunion" onsubmit ="sendForm('divListaCorrecciones','regReunion',frmReunion); return false;" enctype="multipart/form-data" accept-charset="utf-8">        
                       <div class="form-group">
                           <!-- <label class="text-primary mb-2"   for="textoCorreccion">Registre los datos para la reunión de dictámen de Borrador de Tesis</label> -->
                              <div class="card bg-light text-dark mb-2">
                              <div class="card-body">Registre los datos para la reunión de dictámen de Borrador de Tesis</div>
                              </div>

                              <label for="textoCorreccion" class="font-weight-light">Día y hora de la reunión</label>
                              <input class="form-control mb-2" type="datetime-local" id="fechahora" name="fechahora">
                              <label for="textoCorreccion" class="font-weight-light" >Enlace de la sala de reunión</label>
                              <input class="form-control mb-2" type="text" id="lugar" name="lugar">
                              <label for="textoCorreccion" class="font-weight-light">Mensaje</label>                           
                              <textarea class="form-control" id="mensaje"   name="mensaje" rows="8" maxlength="512" placeholder="Mensaje destinado a los demás miembros de jurado  (El número límite de caracteres es de 512)"></textarea>
                              

                              <input type="hidden" id="idTramite" name="idTramite" value=<?php echo($idtram) ?>>
                              <input type="hidden" id="iteracion" name="iteracion" value=<?php echo($iteracion) ?>>
                              <input type="hidden" id="idDocente" name="idDocente" value=<?php echo($idjurado) ?>>
                              <input type="hidden" id="rol" name="rol" value=<?php echo($rol) ?>>
                        </div>


                        <br>
                </form>
                        <a onclick="modalVentana('mdAceptar')" href="javascript:void(0)" class="btn btn-primary btn-icon-split" style="display:block">
                                <span class="icon text-white-50 float-left">
                                <i class="fas fa-check"></i>
                                </span> 
                                <span class="text">Programar</span>
                        </a>
             
                            <div id="divListaCorrecciones">
                            </div>
         
                        <hr>                      
                        <h1 class="h6 mb-0 text-gray-600">
                        
                            
                            <i class="fas fa-file-download"></i> Descargar borrador corregido
                            <br>
                            <i class="fas fa-print"></i> Imprimir borrador
                        
                        </h1>

                </div>
                
            </div>
           </div>
</div>
          


<!-- modals -->

<div class="modal fade" id="mdAceptar" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                         <div class="col-sm-8 align-self-center text-justify text-interWin font-weight-light" id="divAccion">
                            ¿Esta de acuerdo con programar la reunión dictamen para este borrador de tesis?
                         </div>
                         
                      </div>
      </div>
      <div class="modal-footer mr-4">
        <button type="button" class="btn btn-link text-gray-500"  data-dismiss="modal"> Cancelar </button>
        <!-- <a href="javascript:document.getElementById('frmReunion').submit();" type="button" class="btn btn-success"> Si </a> -->
        <button  type="submit" form="frmReunion" class="btn btn-success"  onclick="saveNclose('#','mdAceptar','divAccion','viewListaBorrador')" > Si </button>
      </div>
    </div>
  </div>
</div>

<!-- /.container-fluid -->
</div>