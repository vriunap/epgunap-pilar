<?php 
  $programa = $this->dbRepo->getSnapRow('dicProgramas',"Id=$program");
  $tipo=($programa->Tipo==1?"MAESTRÍA":"DOCTORADO");
  echo "<h1>".$tipo."EN ". $programa->Nombre."</h1>";
 ?>

<button class="btn btn-sm btn-info float-right" onclick="loadDataTable('Tesistas')">Ver Filtros </button>
<table class="table table-striped" id="Tesistas">
  <thead>
    <tr>
      <th scope="col">N°</th>
      <th >DNI/ CODIGO </th>
      <th >APELLIDOS Y NOMBRES</th>
      <th >CEL</th>
      <th >MAIL</th>
      <th >OPERACIONES</th>
    </tr>
  </thead>
  <tbody>
    <?php 
      $flag=1;
      foreach ($list->result() as $row) {
       
        echo "
          <tr>
            <th scope='row'>$flag</th>
            <td>$row->DNI<br><b>$row->Cod</b></td>
            <td>$row->Nombres $row->Apellidos</td>
            <td>$row->Celular</td>
            <td>$row->Correo</td>
            <td> <button onclick=\"loadForm('ctntFlow','vwTesista/$row->Id');\" class='btn btn-sm btn-warning'>Ver Usuario</button></td>
          </tr>
        ";
        $flag++;
    } ?>
  </tbody>
</table>