

<div class="card card-timeline mb-4" id='contentPytoKind'>
  <!-- Content Row -->
  <div class="row">
    <!-- Content Column -->
    <div class="col-lg-6 mb-12">
     <!-- Project Card Example -->
     <div class="card shadow mb-4">
      <div class="card-header py-1 bg-primary">
        <h6 class="m-0 font-weight-bold text-white">Log de Accesos</h6>
      </div>
      <div class="card-body p- table-responsivesm">
        <table class="table table-striped">
          <thead>
            <tr >
              <th scope="col">N°</th>
              <th scope="col">Acción</th>
              <th scope="col">Detalle</th>
              <th scope="col">Fecha</th>
            </tr>
          </thead>
          <tbody>
            <?php 
            $gla=1;
            foreach ($ac->result() as $row) {
              echo "
              <tr style='height: 10px; font-size: 10px;'>
              <td class='p-1'>$gla</td>
              <td class='p-1'>$row->Accion</td>
              <td class='p-1'>$row->Browser</td>
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

  <!-- Content Column -->
  <div class="col-lg-6 mb-12" >
    <div class="card shadow mb-4">
      <div class="card-header py-1 bg-primary">
        <h6 class="m-0 font-weight-bold text-white">Log de Accesos</h6>
      </div>
      <div class="card-body p-3 table-responsive" >
       <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">N°</th>
            <th scope="col">Acción</th>
            <th scope="col">Detalle</th>
            <th scope="col">Fecha</th>
          </tr>
        </thead>
        <tbody>
          <?php 
          $gla=1;
          foreach ($usr->result() as $row) {
            echo "
            <tr style='height: 10px; font-size: 10px;'>
            <td class='p-1'>$gla</td>
            <td class='p-1'>$row->Accion</td>
            <td class='p-1'>$row->Detalle</td>
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
</div>


