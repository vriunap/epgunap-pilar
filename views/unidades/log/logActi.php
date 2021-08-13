<!-- Content Row -->
<div class="row">
  <div class="col-lg-7 mb-4">

    <?php 

      $list = $this->dbLog->getSnapView('logUnidades',"IdUsuario=$sess->IdUser ORDER BY DateReg DESC");
  
?>


     <!-- Programas - Unidad / Programa -->
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <H5 class="m-0 font-weight-bold text-primary"> LOG DE ACTIVIDADES</H5>
        </div>
        <div class="card-body">
          <p>Bienvenido al área de seguimiento de actividades del sistema.</p>
          <div class="table-responsive">

            <table class="table" style='font-size: 13px;'>
              <thead>
                <tr>
                   <th scope="col">Id</th>
                  <th scope="col">Fecha</th>
                  <th scope="col">Acción</th>
                  <th scope="col">Detalle</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                $i=1;
                foreach ($list->result() as $row) {
                  echo "            
                  <tr>
                  <th scope='row'>$i</th>
                  <td>$row->DateReg</td>
                  <td>$row->Accion</td>
                  <td>$row->Detalle</td>
                  </tr>";
                  $i++;
                }
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>

  



  </div>

  <!-- Content Column -->
  <div class="col-lg-5 mb-4">

    <!-- Project Card Example -->
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h3 class="m-0 font-weight-bold text-primary">Log de Accesos</h3>
      </div>
      <div class="card-body">
        <?php 
              $list = $this->dbLog->getSnapView('logAccesos',"IdUsuario=$sess->IdUser ORDER BY DateReg DESC");
        ?>

        <table class="table" style='font-size: 13px;'>
              <thead>
                <tr>
                   <th scope="col">Id</th>
                  <th scope="col">Fecha</th>
                  <th scope="col">Estado</th>
                  <th scope="col">Detalle</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                $i=1;
                foreach ($list->result() as $row) {
                  echo "            
                  <tr>
                  <th scope='row'>$i</th>
                  <td>$row->DateReg</td>
                  <td>$row->Accion</td>
                  <td>$row->IP / $row->OS</td>
                  </tr>";
                  $i++;
                }
                ?>
              </tbody>


      </div>
    </div>
  </div>

</div>


