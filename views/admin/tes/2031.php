
<div class="card card-timeline mb-4" id='contentPytoKind'>
  <!-- Content Row -->
  <div class="row">
      
    <!-- Content Column -->
    <div class="col-lg-7 mb-12">
     <!-- Project Card Example -->
     <div class="card shadow mb-4">
      <div class="card-header py-1 bg-primary">
        <h6 class="m-0 font-weight-bold text-white">DETALLE DE REGISTRO Y ESTADO</h6>
      </div>
      <div class="card-body p- table-responsivesm">
        <table class="table table-striped">
          <thead>
            <tr class='p-1'>
              <th class='p-1 bg-info'colspan='2'>Identificadores</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td class='p-2 font-weight-bold'>CODIGO </td>
              <td class='p-2'><?php echo "$tramRow->Codigo ($tramRow->Id)";?></td>
            </tr>
             <tr>
              <td class='p-2 font-weight-bold'>ESTADO </td>
              <td class='p-2'><?=$tramRow->Estado;?></td>
            </tr>
            <tr>
              <td class='p-2 font-weight-bold'>TITULO </td>
              <td class='p-2'><?php echo "$tramDet->IdTram/$tramDet->Titulo";?></td>
            </tr>

            <tr>
              <td class='p-2 font-weight-bold'>ARCHIVO </td>
              <td class='p-2'><a class="badge badge-success" target="_blank" href="<?php echo base_url("opfile/$tramDet->Archivo");?>"> Visualizar </a></td>
            </tr>
            <tr>
              <td class='p-1 bg-info' colspan="2"><b>Jurado Evaluador</b></td>
            </tr>
            <!-- <tr> -->
                <?php
                  // print_r( $contCorr );
                  foreach ($tramJur->result() as $row) {
                    $docente  = $this->dbRepo->inDocente($row->IdJurado);
                    $denomina = array(1=>'Presidente',2=>'Primer Miembro',3=> 'Segundo Miembro', 4=>'Tercer Miembro / Asesor');
                    $correccs = "<span class='badge badge-danger'> ".$contCorr[$row->Posicion]." </span>";
                    $notifica = "<button class='btn btn-sm btn-info p-0' onclick=\"loadForm('showNotifica','notificaDoc/$row->IdJurado/$tramRow->Id')\">Notificar</button>";
                    echo "<tr><td class='p-2' colspan='2'><b>".$denomina[$row->Posicion]."</b> $correccs <br>". $docente->Nombres." ".$docente->Apellidos." "."$notifica<br></td></tr>";
                  }
                ?>

            <!-- </tr> -->

          <tr><td colspan='6' class='p-1 bg-info'><b>Historial de Estados</b></td></tr>
          </tbody>
        </table>


        <table class="table table-bordered">
          <thead>
            <th class="p-2 font-weight-bold">ID</th>
            <th class="p-2">Nombre Estado</th>
            <th class="p-2"><small><b>Vb1</b></small></th>
            <th class="p-2"><small><b>Vb2</b></small></th>
            <th class="p-2"><small><b>Vb3</b></small></th>
            <th class="p-2"><small><b>Vb4</b></small></th>
            <th class="p-2">Fecha</th>
          </thead>
          <tbody>
            <?php 
            if ($rowsDet) {
              foreach($rowsDet->result() as $rwf) {
                $nmEstado=$this->dbRepo->getOneField("dicEstadoTram","Nombre","Id=$rwf->Iteracion");
                echo "
                <tr>
                  <td class='p-1 text-center'>$rwf->Iteracion</td>
                  <td class='p-1'><small>$nmEstado</small></td>
                  <td class='p-1 text-center'>$rwf->vb1</td>
                  <td class='p-1 text-center'>$rwf->vb2</td>
                  <td class='p-1 text-center'>$rwf->vb3</td>
                  <td class='p-1 text-center'>$rwf->vb4</td>
                  <td class='p-1'><small>$rwf->DateReg</small></td>
                </tr>
                ";
              }
            }
             ?>
          </tbody>
        </table>

      </div>
    </div>
  </div>

  <!-- Content Column -->
  <div class="col-lg-5 mb-12" >
    <div class="card shadow mb-4">
      <div class="card-header py-1 bg-primary">
        <h6 class="m-0 font-weight-bold text-white">Historial de Tramite</h6>
      </div>
      <div class="card-body p-3 table-responsive" >
       <table class="table table-striped">
        <thead>
          <tr>
            <th class='p-1'scope="col">N°</th>
            <th class='p-1'scope="col">Quien</th>
            <th class='p-1'scope="col">Acción</th>
            <th class='p-1'scope="col">Fecha</th>
          </tr>
        </thead>
        <tbody>
          <?php 
          $gla=1;

          
          foreach ($tramLog->result() as $row) {
            echo "
            <tr style='height: 10px; font-size: 10px;'>
            <td class='p-1'>$gla</td>
            <td class='p-1'>$row->Quien</td>
            <td class='p-1'>$row->Accion</td>
            <td class='p-1'>$row->DateReg</td>
            </tr>
            ";
            $gla++;
          }
          ?>

        </tbody>
      </table>



    </div>
  </div>

</div>
   

<div id='showNotifica'>
 
</div>
</div>


