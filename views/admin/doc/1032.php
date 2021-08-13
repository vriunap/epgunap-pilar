<?php 
  $programa = $this->dbRepo->getSnapRow('dicProgramas',"Id=$program");
  $tipo=($programa->Tipo==1?"MAESTRÍA ":"DOCTORADO ");
  echo "<h1>".$tipo."EN ". $programa->Nombre."</h1>";
 ?>
<button class="btn btn-sm btn-info float-right" onclick="loadDataTable('Docentes')">Ver Filtros </button>
<table class="table table-striped" Id="Docentes">
  <thead>
    <tr>
      <th scope="col">N°</th>
      <th scope="col">DNI</th>
      <th scope="col">CODIGO</th>
      <th scope="col">Apellidos y Nombres</th>
      <th scope="col">Celular</th>
      <th scope="col">Correo</th>
      <th scope="col">Operaciones</th>
    </tr>
  </thead>
  <tbody>
    <?php
      $cont = 1;
      foreach ($list->result() as $row) {
        $docente=$this->dbRepo->inDocente($row->IdDocente);
        $tipo=($docente->IdCategoria>14)?"<small>(Contratado)</small>":"";
        echo "
          <tr>
            <th scope='row'>$cont</th>
            <td>$docente->DNI</td>
            <td>$docente->Codigo<br>$tipo</td>
            <td>$docente->Apellidos $docente->Nombres</td>
            <td>$docente->Celular</td>
            <td>$docente->Correo</td>
            <td></td>
          </tr>
        ";
        $cont++;
    } ?>
  </tbody>
</table>