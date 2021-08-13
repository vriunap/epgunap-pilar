
<div class="col-md-6 offset-3">
    
<div class="alert alert-info">
    <h4> Usted está editando los datos del docente: <br><?=$row->Nombres;?> <?=$row->Apellidos;?></h4>
</div>
<form id="frmDatos"name='frmDatos' method="POST">

    <input type="number" class="form-control" id="idDoc" name="idDoc" hidden="" value="<?=$row->Id;?>" onlyread="">
    <div class="form-group">
        <div class="col-md-12"> 
            <div class="form-group row">
                <label class="col-md-4 col-form-label">Celular</label>
                <div class="col-md-8">
                    <input type="number" class="form-control" id="iptCel" name="iptCel" placeholder="Celular" value="<?=$row->Celular;?>">
                </div>
            </div>
        </div>

        <div class="col-md-12"> 
            <div class="form-group row">
                <label class="col-md-4 col-form-label">Correo Electrónico</label>
                <div class="col-md-8">
                    <input type="text" class="form-control" id="iptMail" name="iptMail" placeholder="Correo" value="<?=$row->Correo;?>">
                </div>
            </div>
        </div>

        <div class="col-md-12"> 
            <div class="form-group row">
                <label class="col-md-4 col-form-label">Password</label>
                <div class="col-md-8">
                    <input type="password" class="form-control" id="iptPass" name="iptPass" placeholder="Contraseña">
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <button  onclick="sendForm('ctntFlow','updateDocData',frmDatos); return false;" class="btn btn-success btn-block btn-lg" name="btn-search" id ="btn-search"> <i class="fa fa-check"></i> Actualizar Datos </button>
                <span><i>* Esta operación será registrada a su nombre.</i></span>
            </div>
        </div>
    </div>
</form>
</div>
