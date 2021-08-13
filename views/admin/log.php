

<div class="card card-timeline mb-4" id='contentPytoKind'>
  <!-- Content Row -->
  <div class="row">
    <!-- Content Column -->
    <div class="col-lg-6 mb-12">
     <!-- Project Card Example -->
     <div class="card shadow mb-4">
      <div class="card-header py-1 bg-primary">
        <h6 class="m-0 font-weight-bold text-white">Log de Operaciones</h6>
      </div>
      <div class="card-body p-2">
        <table class="table table-striped">
          <thead>
            <tr>
              <th scope="col">N°</th>
              <th scope="col">Acción</th>
              <th scope="col">Detalle</th>
              <th scope="col">Fecha</th>

          </thead>
          <tbody>
            <?php 
            $gla=1;
            foreach ($ac->result() as $row) {
              echo "
              <tr>
              <td>$gla</td>
              <td>$row->Accion</td>
              <td>$row->Browser</td>
              <td>$row->DateReg</td>

              <td></td>
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
      <div class="card-body p-5" >
 <table class="table table-striped">
          <thead>
            <tr>
              <th scope="col">N°</th>
              <th scope="col">Acción</th>
              <th scope="col">Detalle</th>
              <th scope="col">Fecha</th>

          </thead>
          <tbody>
            <?php 
            $gla=1;
            foreach ($op->result() as $row) {
              echo "
              <tr>
              <td>$gla</td>
              <td>$row->Accion</td>
              <td>$row->Detalle</td>
              <td>$row->DateReg</td>

              <td></td>
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


