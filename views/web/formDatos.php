<form id="frmDatos"name='frmDatos' method="POST">
    <div class="form-group">
        <div class="col-md-12"> 
            <div class="form-group row">
                <label class="col-md-4 col-form-label">Programa</label>
                <div class="col-md-8">
                    <select name="iptPrograma" class="form-control" onchange="loadsubpg(this.value)">
                        <option disabled value="" selected >Selecciona un programa.</option>
                        <?php 
                        $prog= $this->dbRepo->getSnapView('dicProgramas'); 
                        foreach ($prog->result() as $row) {
                            $tipo=($row->Tipo==1?"Maestria":"Doctorado");
                            echo "<option value='$row->Id'><b>$tipo</b>-$row->Nombre</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="col-md-12"> 
            <div class="form-group row">
                <label class="col-md-4 col-form-label">Sub Programa Programa</label>
                <div class="col-md-8">
                    <select name="iptSpg" id="iptSpg" class="form-control">
                    <option disabled value="" selected >Selecciona un programa.</option>
                    </select>
                </div>
            </div>
        </div>


        <div class="col-md-12"> 
            <div class="form-group row">
                <label class="col-md-4 col-form-label">Celular</label>
                <div class="col-md-8">
                    <input type="number" class="form-control" id="iptCel" name="iptCel" placeholder="Celular">
                </div>
            </div>
        </div>

        <div class="col-md-12"> 
            <div class="form-group row">
                <label class="col-md-4 col-form-label">Correo Electrónico</label>
                <div class="col-md-8">
                    <input type="text" class="form-control" id="iptMail" name="iptMail" placeholder="Correo">
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
            <div class="form-group row">
                <label class="col-md-4 col-form-label">Confirma Password</label>
                <div class="col-md-8">
                    <input type="password" class="form-control" id="iptPass2" name="iptPass2" placeholder="Confirma Contraseña">
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <button  onclick="sendForm('rsltCod','inicio/doRegister',frmDatos); return false;" class="btn btn-info btn-block btn-lg" name="btn-search" id ="btn-search"> <i class="fa fa-check"></i> Crear mi cuenta </button>
            </div>
        </div>
    </div>
</form>
