<!-- Content Row -->
<div class="row" id='actSpace'>
    <div class="col-lg-12 mb-4">

        <?php 

        if ($sess->Tipo==3) {
              $tipo = "Unidad";
              $list = $this->dbRepo->getSnapView('dicProgramas',"IdFacultad=$sess->IdFacultad");
        }if($sess->Tipo==4) {
              $tipo = "Programa";
              $list = $this->dbRepo->getSnapView('dicProgramas',"Id=$sess->IdPrograma");
        }


      foreach ($list->result() as $prog) {
          $tprogt=($prog->Tipo==1?"MAESTRÍA":"DOCTORADO");
          ?>
          <!-- Programas - Unidad / Programa -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
                  <h5 class="m-0 font-weight-bold text-danger"> <?php echo "$tprogt : $prog->Nombre";?></h5>
            </div>
          <div class="card-body" >
              <p>Área de seguimiento de Borradores de Tesis .</p>
              <div class="table-responsive">

                <table class="table" style='font-size: 13px;'>
                  <thead>
                    <tr>
                      <th scope="col">N°</th>
                      <th scope="col">Codigo Py.</th>
                      <th scope="col">Nombres y Apellidos</th>
                      <th scope="col">Titulo</th>
                      <th scope="col">Estado</th>
                      <th scope="col">Operaciones</th>
                  </tr>
              </thead>
              <tbody>
                <?php 
                $query=$this->dbPilar->getSnapView("tesTramites","IdPrograma=$prog->Id AND Tipo = 2  AND Estado>=20 ORDER BY Estado");
                $i=1;
                foreach ($query->result() as $row) {
                  $dets=$this->dbPilar->getSnapRow('tesTramitesDet',"IdTram=$row->Id");
                  $docs=$this->dbPilar->getSnapRow('tesTramitesDoc',"IdTram=$row->Id");
                  $tesi= $this->dbPilar->inTesista($row->IdTesista);
                  $opciones="";
                  if ($row->Estado==20) {
                      $opciones="<button class='btn btn-sm btn-success' onclick=\"loadForm('actSpace','oper/2001/$row->Id')\">REVISAR</button>";
                  }
                  $nameEstado= $this->dbRepo->getOneField("dicEstadoTram","Nombre","Id=$row->Estado");
                  echo "            
                  <tr>
                  <th scope='row'>$i</th>
                  <th>$row->Codigo</th>
                  <td>$tesi->Nombres, $tesi->Apellidos</td>
                  <td>$dets->Titulo</td>
                  <td>$nameEstado</td>
                  <td>$opciones</td>
                  </tr>";
                  $i++;
              }
              ?>
          </tbody>
      </table>
  </div>
</div>
</div>

<?php
}
?>

</div>

</div>


