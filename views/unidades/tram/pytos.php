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
                  <h5 class="m-0 font-weight-bold text-primary"> <?php echo "$tprogt : $prog->Nombre";?></h5>
            </div>
          <div class="card-body" >
              <p>Área de seguimiento de Proyectos de Investigación.</p>
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
                $query=$this->dbPilar->getSnapView("tesTramites","IdPrograma=$prog->Id AND Tipo = 1  AND Estado>=1 ORDER BY Estado");
                $i=1;
                $estados= array(1=>'Proyecto',2=>'Rev. Director',3=>'Sorteo',4=>'Revisión Jurados','5'=>'Dictamen',6=>'Aprobación');
                foreach ($query->result() as $row) {
                  $dets=$this->dbPilar->getSnapRow('tesTramitesDet',"IdTram=$row->Id");
                  $docs=$this->dbPilar->getSnapRow('tesTramitesDoc',"IdTram=$row->Id");
                  $tesi= $this->dbPilar->inTesista($row->IdTesista);
                  $opciones="";
                  if ($row->Estado==1) {
                      $opciones="<button class='btn btn-sm btn-success' onclick=\"loadForm('actSpace','oper/1001/$row->Id')\">REVISAR</button>";
                  }
                  if($row->Estado==3){
                        $opciones="<button class='btn btn-sm btn-info' onclick=\"loadForm('actSpace','oper/1004/$row->Id')\">SORTEO</button>"; 
                  }
                  echo "            
                  <tr>
                  <th scope='row'>$i</th>
                  <th><a class='link' href='javascript:void(0)' onclick=\"loadForm('actSpace','oper/999/$row->Id')\">$row->Codigo</a></th>
                  <td>$tesi->Nombres, $tesi->Apellidos</td>
                  <td>$dets->Titulo</td>
                  <td>".$estados[$row->Estado]."</td>
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


