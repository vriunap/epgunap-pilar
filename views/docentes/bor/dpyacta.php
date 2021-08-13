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
            //$fecha_aprobacion =$rowDet->DateModif;
            $ruta_archivo=$rowDet->Archivo;
            $iteracion=$rowDet->Iteracion;
            $estado=$rowTram->Estado;
            $idjurado= $sess->IdUser;
            //$rol = $this->dbPilar->posicion($idtram,$sess->IdUser);
?> 




<div class="container-fluid" id='ctntFlow'>

<div class="container-fluid mb-4">

    <h1 class="h3 mb-0 text-primary">Proyecto <i class="fas fa-chevron-right fa-xs"></i> Acta de aprobación </h1>
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
    <i class="fas fa-calendar-alt"></i> Fecha de aprobación: </span> <?php echo($fecha_asignacion) ?> 
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
                    

                    <embed src= "<?php echo (base_url("tesistas/actaProy/").$idtram) ?>" width="100%" height="800">

                </div>
                <div class="col-lg-3 mb-4">
                
                        <a href="<?php echo (base_url("tesistas/actaProy/").$idtram) ?>" download class="btn d-block btn-primary btn-icon-split">
                             <span class='icon text-white-50'>
                             <i class='fas fa-download'></i>
                             </span>
                             <span class='text'>Descargar</span>
                        </a>  
                        

                        <hr>          
                                                            
                        <h1 class="h6 mb-0 text-gray-600">
                            <a  href="#" onclick="printJS({printable:'<?php echo (base_url("tesistas/actaProy/").$idtram) ?>', type:'pdf', showModal:true})">
                                <i class="fas fa-print"></i> Imprimir acta
                             </a>
                             <br>

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
          




<!-- /.container-fluid -->
</div>