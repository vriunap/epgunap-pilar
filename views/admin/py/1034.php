
<?php 
    $estado=$this->dbRepo->getSnapRow('dicEstadoTram',"Id=$Estado");
?>

<h6 class="m-0 font-weight-bold text-primary">LISTADO DEL ESTADO:  <?php echo $estado->Nombre;?></h6>

<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">N°</th>
      <th scope="col">Codigo</th>
      <th scope="col">Apellidos y Nombres</th>
      <th scope="col">Titulo</th>
      <th scope="col">Programa</th>
      <th scope="col">Días</th>
      <th scope="col">Operaciones</th>
    </tr>
  </thead>
  <tbody>
    <?php 
    $gla=$list->num_rows();
    foreach ($list->result() as $row) {
      $rowTesista = $this->dbPilar->inTesista($row->IdTesista);
      $Titulo = $this->dbPilar->getOneField('tesTramitesDet','Titulo',"IdTram='$row->Id'");
      $Nombre = $rowTesista->Nombres.", ". $rowTesista->Apellidos;
      $DataProg=$this->dbRepo->inProgramaTesista($row->IdTesista);
      $Programa =$DataProg->Nombre;
      $Tipo = ($DataProg->Tipo==1?"MAESTRÍA":"DOCTORADO");
      $dias=mlDiasTranscHoy($row->DateModif);

        // Determinar Operación
        switch ($Estado) {
          case 5:
            if ($dias>=7) {
            $opcion="<button  type='submit' onclick=\"loadForm('rsltSearchDoc','apruebaProyecto/$row->Id'); return false;\" class='btn btn-success btn-sm p-0 pt-1 pb-1' >Aprobar Proyecto</button>";
            }else{
              $opcion="";
            }
            break;
          default:
            $opcion="";
            break;
        }

        //  Imprimir Filas de Resultados
        echo "
        <tr class='small p-0'>
        <td class='p-2'>$gla</td>
        <td class='p-2'>$row->Codigo</td>
        <td class='p-2'>$Nombre</td>
        <td class='p-2'><small>$Titulo</small></td>
        <td class='p-2'>$Programa</td>
        <td class='p-2'>$dias</td>
        <td class='p-2'><button onclick=\"loadForm('ctntFlow','vwTesista/$row->IdTesista');\" class='btn btn-sm btn-info'>Ver Usuario</button> $opcion </td>
        </tr>
        ";
        $gla--;

    }
    ?>

  </tbody>
</table>



