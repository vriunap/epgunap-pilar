
<!-- Content Column -->
<div class="col-lg-8 mb-5">

    <!-- Project Card Example -->
    <div class="card mb-4">
        <div class="card-header bg-primary py-3">
            <h6 class="m-0 text-white">Sorteo del Proyecto de Tesis
                <span class="m-0 font-weight-bold text-primary float-right"><button class='btn btn-sm btn-info'onclick="loadForm('actSpace','viewProyectos')">Regresar a la Lista</button></span>
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
            <?php $intentos=$this->dbLog->getTotalRows('logJuCambios',"IdTramite=$rowTram->Id AND Referens LIKE '%Intento%'"); ?>
            <h5>Antes de <b class="text-info">sortear</b> los jurados de este proyecto debe de de verificar la información consignada a la izquierda, esta operación será registrada al usuario de esta cuenta:</h5>
            <button class="col-md-7 m-2 btn btn-sm btn-success" data-toggle="modal" data-target="#sortear"> SORTEAR </button>
            <span class="help-block">Intentos Realizados: <b><?=$intentos;?></b></span>
        </div>
    </div>
</div>


<div class="modal fade" id="sortear" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h5 class="modal-title text-white">SORTEO DE TESIS</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close" onclick="loadForm('actSpace','oper/1004/<?=$rowTram->Id;?>')">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body" id='opResponse'>
                <center>
                <h5><b>NOTA: </b> Antes guardar debe verificar la conformación de jurados, orden,  jerarquia según el reglamento, si no está conforme <span class="text-danger">cancelar</span> ambos casos serán registrados.</h5>
                <br>
                <button class="btn btn-primary" onclick="loadForm('opResponse','doSorteo/<?=$rowTram->Id;?>')">REALIZAR SORTEO </button>
                </center>
            </div>
            <div class="modal-footer">
                <button class="btn btn-danger" type="button" data-dismiss="modal" onclick="loadForm('actSpace','oper/1004/<?=$rowTram->Id;?>')">CANCELAR</button>
            </div>
        </div>
    </div>
</div>
