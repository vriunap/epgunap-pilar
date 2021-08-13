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
    <div class="form-group">
        <label class="text-primary font-weight-bold">Programas:</label>
<?php 
    $consulta=$this->dbRepo->getSnapView('tblDocProg',"IdDocente=$row->Id");
       echo "<ul>";
    foreach ( $consulta->result() as $con) {
        $prog=$this->dbRepo->getSnapRow('dicProgramas',"Id=$con->IdPrograma");
        $tprog=($prog->Tipo==1?"MAESTRÍA":"DOCTORADO");
        echo "<li>$tprog EN $prog->Nombre</li>";
    }
    echo "</ul>"
 ?>

    <div class="form-group">

        <button onclick="loadForm('ctntFlow','infoDocentes/3031/<?=$row->Id;?>');" class="btn btn-warning">Cambiar Datos Docente</button>

    </div>

    </div>
    <?php


}else{
    echo "Datos incorrectos, registrar nuevo docente";
}
?>