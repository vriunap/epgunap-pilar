

<h6 class="m-0 font-weight-bold text-primary">Lista de proyectos del programa <?=$program->Nombre;?></h6>

<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">N°</th>
      <th scope="col">Apellidos y Nombres</th>
      <th scope="col">Codigo</th>
      <th scope="col">Estado</th>
      <th scope="col">Titulo</th>
      <th scope="col">Programa</th>
      <!-- <th scope="col">Operaciones</th> -->
    </tr>
  </thead>
  <tbody>
    <?php 
    $gla=1;
    foreach ($list->result() as $row) {
      $rowTesista = $this->dbPilar->inTesista($row->IdTesista);
      $rowDet = $this->dbPilar->getSnapRow('tesTramitesDet',"IdTram=$row->Id");
      if (!$rowDet) {
        $rowDet = "Revisar el Detalle del Trámite [Error de Registro]";
      }else{
        $rowDet=$rowDet->Titulo;
      }
      $Nombre = $rowTesista->Nombres.", ". $rowTesista->Apellidos;
      echo "
      <tr>
      <td>$gla</td> 
      <td>$Nombre</td>
      <td>$row->Codigo</td>
      <td>$row->Estado</td>
      <td>$rowDet</td>
      <td>$program->Nombre</td>
      </tr>
      ";
      $gla++; 
    }
    ?>

  </tbody>
</table>



