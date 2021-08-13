
<!-- Content Column -->
<div class="col-lg-8 mb-5">

    <!-- Project Card Example -->
    <div class="card mb-4">
        <div class="card-header bg-danger py-3">
            <h6 class="m-0 text-white">Revisión del Borrador de Tesis
                <span class="m-0 font-weight-bold text-primary float-right"><button class='btn btn-sm btn-info'onclick="loadForm('actSpace','viewBorrador')">Ver más Borradores</button></span>
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
            $jurados=$this->dbPilar->getSnapView('tesJurados',"IdTram=$rowTram->Id AND Estado=1 ORDER BY Posicion ASC");
            ?> 
            <div class="form-group row" >
                <div class="col-md-6">
                    <label class="text-primary font-weight-bold">Tesista:</label>
                    <p><?=$Nombre;?></p>
                </div>
                <div class="col-md-6">
                    <label class="text-primary font-weight-bold">Programa:</label>
                    <p><?=$Programa;?></p>
                </div>
            </div>
                <div class="form-group ">
                    <label class="text-primary font-weight-bold">Tipo:</label>
                    <p><?=$Tipo;?></p>
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
            <?php 
                foreach ($jurados->result() as $row) {
                    $docente=$this->dbRepo->inDocente($row->IdJurado);
                    $denomina =array(1=>'Presidente',2=>'Primer Miembro',3=> 'Segundo Miembro', 4=>'Tercer Mimebro');
            ?>
                <div class="form-group">
                    <label class="text-danger font-weight-bold"><?php echo $denomina[$row->Posicion];?>:</label>
                    <p><?php echo $docente->Nombres.",".$docente->Apellidos;?></p>
                </div>

            <?php
                }
             ?>

            <a class="btn btn-sm btn-success" href="<?=base_url("opfile/$rowDet->Archivo");?>" target="_blank"> VER ARCHIVO ( Nueva Pestaña) </a>

        </div>
    </div>
</div>

<div class="col-lg-4 mb-5">
    <div class="card mb-4">
        <div class="card-header bg-danger py-3">
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
                <button class="close" type="button" data-dismiss="modal" aria-label="Close" onclick="loadForm('actSpace','viewBorrador')">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body" id='opResponse'>
                Al aprobar el proyecto, usted declara que los jurados registrados por el tesista, son los que se <b>sortearon en el proyecto</b> y así mismo cumple con lo minimo establecido para para proseguir su trámite de BORRADOR DE TESIS. <br> Por su seguridad este evento será grabado.
                <button class="btn btn-success" onclick="loadForm('opResponse','oper/2002/<?=$rowTram->Id;?>')"> ENVIAR A LOS JURADOS </button>
            </div>
            <div class="modal-footer">
                <button class="btn btn-danger" type="button" data-dismiss="modal" onclick="loadForm('actSpace','viewBorrador')">CERRAR</button>
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
                <button class="close" type="button" data-dismiss="modal" aria-label="Close" onclick="loadForm('actSpace','viewBorrador')">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body" id='opResponse1'>
                <p> El proyecto no cumple con el formato mínimo establecido deberá corregir y volver a cargar a la plataforma.
                    Unidad de Investigación </p>

                    <form  name='frmCorrects' method="post" accept-charset="utf-8">
                    <label>Ingrese Observaciones</label>
                    <textarea name="iptCorrects" class="form-control" rows="4">EL borrador tiene observaciones :
- 
- 
                      </textarea>
                </form>
            <br> 
            <small>Este evento está grabado por : <b><?=$sess->NameUser;?></b>.</small>
            <button class="btn btn-success" onclick="sendForm('opResponse1','oper/2003/<?=$rowTram->Id;?>',frmCorrects)" >RECHAZAR</button>
        </div>
        <div class="modal-footer">
            <button class="btn btn-danger" type="button" data-dismiss="modal" onclick="loadForm('actSpace','viewBorrador')">CERRAR</button>
        </div>
    </div>
</div>
</div>            

