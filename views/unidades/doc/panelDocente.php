<!-- Content Row -->
<div class="row">
  <div class="col-lg-7 mb-4">

    <?php 

    if ($sess->Tipo==3) {
      $tipo = "Programa";
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
          <H5 class="m-0 font-weight-bold text-primary"> <?php echo "$tprogt:$prog->Nombre";?></H5>
        </div>
        <div class="card-body">
          <p>Bienvenido al área de seguimiento de tu trabajo de investigación, para ostentar el grado de maestro o doctor por la Universidad nacional del altiplano de Puno, para lo cual tienes que realizar los siguientes procesos.</p>
          <div class="table-responsive">

            <table class="table" style='font-size: 13px;'>
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Grado</th>
                  <th scope="col">Nombres</th>
                  <th scope="col">Apellidos</th>
                  <th scope="col">Carrera</th>
                  <th scope="col">Estado</th>
                  <th scope="col">Opciones</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                $query=$this->dbRepo->getSnapView("tblDocProg","IdPrograma=$prog->Id");
                $i=1;
                foreach ($query->result() as $row) {
                  $rows=$this->dbRepo->getSnapRow('tblDocentes',"Id=$row->IdDocente");
                  $carrera=$this->dbRepo->getOneField("dicFacultades","Nombre","Id=$rows->IdFacultad");
                  $gradDoc=($row->Tipo==1?"Mg/M.Sc.":"Dr./D.Sc.");
                  echo "            
                  <tr>
                  <th scope='row'>$i</th>
                  <th>$gradDoc</th>
                  <td>$rows->Nombres</td>
                  <td>$rows->Apellidos</td>
                  <td>$carrera</td>
                  <td>Activo</td>
                  <td><a class=' col-md-12 badge badge-danger' href='#' data-toggle='modal' data-target='#deleteModal$row->IdDocente'>  BORRAR </a></td>
                  </tr>";
                  $i++;
                  echo "
                           <div class='modal fade' id='deleteModal$row->IdDocente' tabindex='-1' role='dialog' aria-hidden='true'>
                              <div class='modal-dialog' role='document'>
                                <div class='modal-content'>
                                  <div class='modal-header bg-lred'>
                                    <h5 class='modal-title text-white' id='exampleModalLabel'>Eliminar Docente ?</h5>
                                    <button class='close' type='button' data-dismiss='modal' aria-label='Close' onclick=\"loadForm('ctntFlow','viewDocentes')\">
                                      <span aria-hidden='true'>×</span>
                                    </button>
                                  </div>
                                  <div class='modal-body' id='resultopDoc$row->IdDocente'>

                                    Está seguro Al elminar el docente, la operación será registrada.
                                    <button class='btn btn-danger' onclick=\"loadForm('resultopDoc$row->IdDocente','deleteDoc/$row->IdDocente/$prog->Id')\">Eliminar </button>

                                  </div>
                                  <div class='modal-footer'>
                                    <button class='btn btn-secondary' type='button' data-dismiss='modal' onclick=\"loadForm('ctntFlow','viewDocentes')\">Cerrar Ventana</button>
                                  </div>
                                </div>
                              </div>
                            </div>

                  ";

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

  <!-- Content Column -->
  <div class="col-lg-5 mb-4">

    <!-- Project Card Example -->
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h3 class="m-0 font-weight-bold text-primary">Registro de Docentes</h3>
      </div>
      <div class="card-body">
        <p>Solo deberá registrar a los docentes que correspondan al Unidad de Posgrado, conforme a la normativa vigente.</p>

        <form method="post" id='frmlDNIdoc' name="frmStudent" class="form-validate" onsubmit="sendForm('resultSearchDoc','searhDoc',frmlDNIdoc); return false;">
          <label class="form-control-label">DNI Docente:</label>
          <div class="form-group ">
            <div class="form-group row">
              <div class="col-md-8">
                <input id="iptDNIDoc" name="iptDNIDoc"  type="text" class="form-control" required="">
              </div>
              <div class="col-md-4">
                <input type="submit" value="Buscar!" class="form-control btn btn-primary">
              </div>
            </div>
          </div>
        </form>
        <div id="resultSearchDoc">

        </div>
      </div>
    </div>
  </div>

</div>
  

