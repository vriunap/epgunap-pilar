
<!-- Content Column -->
<div class="col-lg-8 mb-5">

    <!-- Project Card Example -->
    <div class="card mb-4">
        <div class="card-header bg-primary py-3">
            <h6 class="m-0 text-white">Revisión del Proyecto de Tesis
                <span class="m-0 font-weight-bold text-primary float-right"><button class='btn btn-sm btn-info'onclick="loadForm('actSpace','viewProyectos')">Ver Otros Proyectos</button></span>
            </h6>
        </div>
        <div class="card-body">
            <?php 
            $rowTesista = $this->dbPilar->inTesista($rowTram->IdTesista);
            $Nombre = $rowTesista->Nombres.", ". $rowTesista->Apellidos;
            $DataProg=$this->dbRepo->inProgramaTesista($rowTram->IdTesista);
            $Programa =$DataProg->Nombre;
            $Tipo = ($DataProg->Tipo==1?"MAESTRÍA":"DOCTORADO");
            $Linea=$this->dbRepo->getOneField("dicLineasVRI","Nombre","Id=$rowTram->IdLinea");
            $SubLinea=$this->dbRepo->getOneField("dicLineas","Nombre","Id=$rowTram->IdSubLinea");
            $Asesor=$this->dbRepo->inDocente($this->dbPilar->getOneField('tesJurados',"IdJurado","IdTram=$rowTram->Id AND Posicion=4"));
            ?> 
            <div class="form-group row" >
                <div class="col-md-5">
                    <label class="text-primary font-weight-bold">Tesista:</label>
                    <p><?=$Nombre;?></p>
                </div>
                <div class="col-md-5">
                    <label class="text-primary font-weight-bold">Programa:</label>
                    <p><?=$Programa;?></p>
                </div>
                <div class="col-md-2">
                    <label class="text-primary font-weight-bold">Tipo:</label>
                    <p><?=$Tipo;?></p>
                </div>
            </div>

            <div class="form-group">
                <label class="text-primary font-weight-bold">Título de Proyecto:</label>
                <p><?=$rowDet->Titulo;?></p>
            </div>

            <div class="form-group">
                <label class="text-primary font-weight-bold">Línea de Investigación:</label>
                <p><?=$Linea;?></p>
            </div>

            <div class="form-group">
                <label class="text-primary font-weight-bold">Sub - Línea de Investigación:</label>
                <br>
                <small><?=$SubLinea;?></small>
            </div>

            <div class="form-group">
                <label class="text-primary font-weight-bold">ASESOR DE TESIS:</label>
                <p><?php echo $Asesor->Nombres.",".$Asesor->Apellidos;?></p>
            </div>

            <a class="btn btn-sm btn-success" href="<?=base_url("opfile/$rowDet->Archivo");?>" target="_blank"> VER ARCHIVO ( Nueva Pestaña) </a>

        </div>
    </div>
</div>

<div class="col-lg-4 mb-5">
    <div class="card mb-4">
        <div class="card-header bg-primary py-3">
            <h6 class="m-0 text-white">Operaciones y Determinación</h6>
        </div>
        <div class="card-body p-4">

            <button class="col-md-8 m-2 btn btn-sm btn-success" data-toggle="modal" data-target="#aprobar"> APROBAR </button>
            <button class="col-md-8 m-2 btn btn-sm btn-warning" data-toggle="modal" data-target="#corregir"> CORREGIR / RECHAZAR</button>

            <!-- Modal 1 -->
        </div>
    </div>
</div>


<div class="modal fade" id="aprobar" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">¿Esta usted seguro?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close" onclick="loadForm('actSpace','viewProyectos')">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body" id='opResponse'>
                Al aprobar el proyecto, usted declara que cumple con lo minimo establecido para proseguir su trámite. <br> Por su seguridad este evento será grabado.
                <button class="btn btn-success" onclick="loadForm('opResponse','oper/1002/<?=$rowTram->Id;?>')">APROBAR PROYECTO </button>
            </div>
            <div class="modal-footer">
                <button class="btn btn-danger" type="button" data-dismiss="modal" onclick="loadForm('actSpace','viewProyectos')">CERRAR</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal 2-->
<div class="modal fade" id="corregir" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ingrese las Observaciones</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close" onclick="loadForm('actSpace','viewProyectos')">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body" id='opResponse1'>
                <p> El proyecto no cumple con el formato mínimo establecido deberá corregir y volver a cargar a la plataforma.
                    Unidad de Investigación </p>
                <form  name='frmCorrects' method="post" accept-charset="utf-8">
                    <label>Ingrese Observaciones</label>
                    <textarea name="iptCorrects" class="form-control" rows="4">Corregir el trabajo de Investigación lo siguiente:  
-
-
                    </textarea>
                </form>

            <small>Este evento está grabado por : <b><?=$sess->NameUser;?></b>.</small>
            <br> 
            <button class="btn btn-success" onclick="sendForm('opResponse1','oper/1003/<?=$rowTram->Id;?>',frmCorrects)" >RECHAZAR </button>
        </div>
        <div class="modal-footer">
            <button class="btn btn-danger" type="button" data-dismiss="modal" onclick="loadForm('actSpace','viewProyectos')">CERRAR</button>
        </div>
    </div>
</div>
</div>            

