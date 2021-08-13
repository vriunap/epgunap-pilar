<div class="card card-timeline mb-4" id='contentPytoKind'>
  <!-- Content Row -->
  <div class="container">
    <!-- Content Column -->
    <div class="col-lg-12 mb-12" >
      <div class="card shadow mb-4">
        <div class="card-header py-1 bg-primary">
          <h5 class="m-0 font-weight-bold text-white"> 
            Unidades de Investigación
          </h5>
        </div>
        <div class="card-body p-5" id ='rsltSearchDirec'>

              <div class="table-responsive">

                <?php 
                $programa = $this->dbRepo->getSnapView('dicProgramas');

                ?>
                 <button class="btn btn-sm btn-info float-right" onclick="loadDataTable('Directores')">Ver Filtros </button>

                <table id="Directores" class="table table-bordered"  class="display"  width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th >N°</th>
                      <th >TIPO</th>
                      <th >RESPONSABLE</th>
                      <th >OPERACIONES</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th >N°</th>
                      <th >TIPO</th>
                      <th >RESPONSABLE</th>
                      <th >OPERACIONES</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    <?php 
                    $flag=1;
                    foreach ($programa->result() as $row) {
                      $tipo=($row->Tipo==1?"MAESTRÍA":"DOCTORADO");
                      $resp=$this->dbRepo->getSnapRow('tblUsuarios',"IdPrograma=$row->Id");
                      if($resp){

                      echo "
                      <tr>
                      <th class='p-2 text-center'scope='row'>$flag</th>
                      <td class='p-2 text-center'>$tipo</td>
                      
                      <td class='p-2'>".$resp->Apellidos.", ".$resp->Nombres." <br> <p class='m-0'style='font-size:12px'><b>$row->Nombre</b></p></td>
                      <td class='p-2'></td>
                      </tr>
                      ";
                      }
                      $flag++;
                    } ?>
                  </tbody>
                </table>
              </div>
        </div>
      </div>
    </div>

  </div>
</div>


