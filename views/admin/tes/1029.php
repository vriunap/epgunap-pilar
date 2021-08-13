<?php 
if ($row) {
    ?>
    <div class="form-group row" >
        <div class="col-md-6">
            <label class="text-primary font-weight-bold">Nombres :</label>
            <p><?=$row->Nombres;?></p>
        </div>
        <div class="col-md-6">
            <label class="text-primary font-weight-bold">Apellidos:</label>
            <p><?=$row->Apellidos;?></p>
        </div>
    </div>

    <div class="form-group row" >
        <div class="col-md-6">
            <label class="text-primary font-weight-bold">Correo :</label>
            <p><?=$row->Correo;?></p>
        </div>
        <div class="col-md-6">
            <label class="text-primary font-weight-bold">Celular:</label>
            <p><?=$row->Celular;?></p>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-md-6">
            <label class="text-primary font-weight-bold">Programas:</label>
            <?php 
            $prog=$this->dbRepo->getSnapRow('dicProgramas',"Id=$row->IdPrograma");
            $tprog=($prog->Tipo==1?"MAESTRÍA":"DOCTORADO");
            echo "<p>$tprog EN $prog->Nombre</p>";
            ?>
        </div>
        <div class="col-md-6">
            <label class="text-primary font-weight-bold">Fecha de Creación:</label>      
            <p><?=$row->DateReg;?></p>
        </div>


    </div>

    <div class="form-group">

        <button onclick="loadForm('ctntFlow','vwTesista/<?=$row->Id;?>');" class="btn btn-warning">Visualizar Usuario</button>

    </div>
    <?php


}else{
    echo "Datos incorrectos, Estudiante no registrado, si los datos son inconsistentes comunicarse con la OTIT";
}
?>