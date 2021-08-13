<div class="container-fluid" id='ctntFlow'>

<div class="container-fluid mb-4">

    <h1 class="h3 mb-0 text-primary">Borrador <i class="fas fa-chevron-right fa-xs"></i> Aprobación </h1>
    <br>
    <h1 class="h5 mb-0 text-black"> <?php echo($tituloPy) ?> </h1>
    <br>
        
    <h1 class="h6 mb-0 text-gray-800 ">
      <span class="font-weight-bold">Código:</span> <?php echo($codigoPy) ?>  <br>
      <span class="font-weight-bold">Tesista:</span> <?php echo($nombre) ?> <br>
      <span class="font-weight-bold">Programa:</span> <?php echo($programa) ?> 
   </h1>
    <br>
    <span  class="badge badge-dark"> 
    <i class="fas fa-calendar-alt"></i> Asignación : </span> <?php echo($fecha_asignacion) ?>   <span class="badge badge-dark"> <i class="fas fa-stopwatch"></i> Días restantes para aprobación :</span> 2 días hábiles 
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
                    
                        <a  href="#" id="ok" onclick="modalVentana('mdAceptar')" class="btn btn-success btn-icon-split"  style="display:block">
                                                <span class="icon text-white-50 float-left">
                                                <i class="fas fa-check"></i>
                                                </span>
                                                <span class="text">Aprobar</span>
                        </a>

                        <br>
                        <a href="#" id="ok" onclick="modalVentana('mdRechazar')" class="btn btn-danger btn-icon-split" style="display:block">
                                                <span class="icon text-white-50 float-left">
                                                <i class="fas fa-times"></i>
                                                </span>
                                                <span class="text">Rechazar</span>
                        </a>

                        <br>    
                        <hr>                      
                        <h1 class="h6 mb-0 text-gray-600 ">

                        <a href="<?php echo (base_url("opfile/").$ruta_archivo) ?>" download>
                            <i class="fas fa-file-download"></i> Descargar borrador
                            </a>
                            <br>
                            
                            <a  href="#" onclick="printJS({printable:'<?php echo (base_url("opfile/").$ruta_archivo) ?>', type:'pdf', showModal:true})">
                                <i class="fas fa-print"></i> Imprimir borrador
                             </a>
                        
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
                         <div class="col-sm-8 align-self-center text-justify text-interWin" id="divAccion">
                            La aprobación de este borrador de tesis implica que, el mencionado, cumple con los líneamientos de investigación requeridos por el programa de Posgrado con los cuales usted se encuentra de acuerdo.
                         </div>
                         
                      </div>
      </div>
      <div class="modal-footer mr-4">
        <button type="button" class="btn btn-link text-gray-500"  data-dismiss="modal"> Cancelar </button>
        <a onclick="saveNclose('operacionbor/aceptar/<?php echo($idtram) ?>','mdAceptar','divAccion','viewListaBorrador')" href="javascript:void(0)"  type="button" class="btn btn-success"> Aprobar </a>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="mdRechazar" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                        <i class="fas fa-ban fa-5x text-cancel"></i>
                         </div>
                         <div class="col-sm-8 align-self-center text-justify text-interWin" id="divAccion">
                         
                         Registre los motivos por el cual esta desaprobando el borrador de tesis
                           
                           <form method="POST" name="frmCorreccion" id="frmCorreccion" onsubmit ="sendForm('divListaCorreccionesModal','regCorreccion',frmCorreccion); return false;" enctype="multipart/form-data" accept-charset="utf-8">        
                               <div class="form-group">
                                     <label for="textoCorreccion"></label>
                                     <textarea class="form-control" id="textoCorreccion"   name="textoCorreccion" rows="3" maxlength="512" placeholder="(El número límite de caracteres por correción es de 512)"></textarea>
                                     <input type="hidden" id="idTramite" name="idTramite" value=<?php echo($idtram) ?>>
                                     <input type="hidden" id="iteracion" name="iteracion" value=<?php echo($iteracion) ?>>
                                     <input type="hidden" id="iteracion" name="iteracion" value=<?php echo($estado) ?>>
                                     <input type="hidden" id="idDocente" name="idDocente" value=<?php echo($idjurado) ?>>
                                     <input type="hidden" id="rol" name="rol" value=<?php echo($rol) ?>>
                                 </div>

                                 <button type="submit" onclick="limpiar()" class="btn btn-success btn-icon-split btn-block" id="btnEnviar"  >
                                                         <span class="icon text-white-50 float-left">
                                                         <i class="fas fa-plus"></i>
                                                         </span>
                                                         <span class="text">Agregar</span>
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
        <a onclick="saveNclose('operacionbor/rechazar/<?php echo($idtram) ?>','mdRechazar','divAccion','viewListaBorrador')" href="javascript:void(0)"  type="button" class="btn btn-success"> Rechazar </a>
      </div>
    </div>
  </div>
</div>

<!-- Fin modals -->





<!-- /.container-fluid -->
</div>