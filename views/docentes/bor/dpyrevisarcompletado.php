<div class="container-fluid" id='ctntFlow'>

<div class="container-fluid mb-4">

    <h1 class="h3 mb-0 text-primary">Proyecto <i class="fas fa-chevron-right fa-xs"></i> Revisión </h1>
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
    <i class="fas fa-calendar-alt"></i> Asignación : </span> <?php echo($fecha_asignacion) ?> <span class="badge badge-dark"> <i class="fas fa-stopwatch"></i> Finalización de corrección</span> <?php echo($fecha_fin) ?>
    <br>
    <br>
    <h1 class="h6 mb-0 text-primary font-weight-bold"><i class="fas fa-chevron-circle-left"></i> Ver todos los proyectos</h1>
    

</div>

<div class="card  mb-4">

            <div class="card-body">
            
            <div class="row">
            
                <div class="col-lg-9 mb-4">
                    <embed src="http://vriunap.pe/epgunap/opfile/<?php echo($ruta_archivo) ?>" width="100%" height="800">

                </div>
                <div class="col-lg-3 mb-4">
                
                            <label>Correcciones realizadas</label>
                            <div id="divListaCorrecciones">
                            <div class="list-group" style="max-height: 450px;  margin-bottom: 10px; overflow-y:scroll;  -webkit-overflow-scrolling: touch;">
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
                        
                            <i class="fas fa-eye"></i> Ver correcciones jurados
                            <br>
                            <i class="fas fa-file-download"></i> Descargar proyecto
                            <br>
                            <i class="fas fa-print"></i> Imprimir proyecto
                        
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
                            Esta a punto de finalizar el proceso de correción de proyecto de tesis. Luego de Finalizada usted no podrá agregar más correcciones.
                         </div>
                         
                      </div>
      </div>
      <div class="modal-footer mr-4">
        <button type="button" class="btn btn-link text-gray-500"  data-dismiss="modal"> Cancelar </button>
        <a onclick="saveNclose('finCorreccion/<?php echo($idtram)?>/<?php echo($iteracion)?>','mdAceptar','divAccion','viewListaProyecto')" href="javascript:void(0)"  type="button" class="btn btn-success"> Aceptar </a>
      </div>
    </div>
  </div>
</div>

<!-- /.container-fluid -->
</div>