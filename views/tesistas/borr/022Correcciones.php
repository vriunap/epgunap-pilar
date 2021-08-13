    <br>
    <div class="card-body-timeline">

        <div id="timeline-wrap">
            <div id="timeline"></div>

            <div class="marker mfirst timeline-icon">
                <i>1</i>
                <div class="status ">
                    <span> Registro </span>
                </div>
            </div>

            <div class="marker m2 timeline-icon activo">
                <i>2</i>
                <div class="status">
                    <span> Correcciones </span>
                </div>
            </div>

            <div class="marker m3 timeline-icon">
                <i>3</i>
                <div class="status">
                    <span> Dictámen </span>
                </div>
            </div>

            <div class="marker mlast timeline-icon">
                <i>4</i>
                <div class="status">
                    <span> Aprobación</span>
                </div>
            </div>
        </div>
    </div>

    <br>
    <div class="alert alert-info">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <b>BORRADOR ENVIADO A REVISIÓN POR LOS JURADOS</b><br>El borrador se encuentra en etapa de REVISIÓN comunicarse con sus jurados para obtener y realizar las correcciones. <small>(Tiempo Estimado : 10 Días)</small>
    </div>


    <script>
    window.setTimeout(function() {
       $(".alert-info").fadeTo(1000, 0).slideUp(1000, function(){
           $(this).remove();
       });
    }, 3000);
    </script>



<!-- Content Row -->
<!-- <div class="card card-timeline mb-4" id="contentPytoKind">
-->
<div class="card card-timeline" id="contentPytoKind">
  <div class="card-header">
        <b>Correcciones del Jurado</b>
       <button class="float-right btn btn-primary" onclick="loadForm('contentPytoKind','viewCorrBorr')"> Subir Correcciones</button>
  </div>

<?php
    $j1 = $tblCorr1->num_rows();
    $j2 = $tblCorr2->num_rows();
    $j3 = $tblCorr3->num_rows();
    $j4 = $tblCorr4->num_rows();

?>
  <div class="card-body" id="IdUpload">
    <nav>
      <div class="nav nav-tabs" id="nav-tab" role="tablist">
        <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#j1" role="tab"  aria-selected="true">PRESIDENTE <span class="badge badge-danger"><?php echo $j1;?></span></a>
        <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#j2" role="tab"  aria-selected="false">PRIMER JURADO <span class="badge badge-danger"><?php echo $j2;?></span></a>
        <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#j3" role="tab"  aria-selected="false">SEGUNDO JURADO <span class="badge badge-danger"><?php echo $j3;?></span></a>
        <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#j3" role="tab"  aria-selected="false">TERCER JURADO <span class="badge badge-danger"><?php echo $j4;?></span></a>
      </div>
    </nav>
    <div class="tab-content" id="nav-tabContent">
      <div class="tab-pane fade show active" id="j1" role="tabpanel">
        <?php 
          foreach ($tblCorr1->result() as $row) {
            echo "<b>$row->Fecha</b>";
            echo "<p>$row->Mensaje</p>";
          }
         ?>
      </div>
      <div class="tab-pane fade" id="j2" role="tabpanel">
      <?php 
          foreach ($tblCorr2->result() as $row) {
            echo "<b>$row->Fecha</b>";
            echo "<p>$row->Mensaje</p>";
          }
         ?>
      </div>
      <div class="tab-pane fade" id="j3" role="tabpanel">
         <?php 
          foreach ($tblCorr3->result() as $row) {
            echo "<b>$row->Fecha</b>";
            echo "<p>$row->Mensaje</p>";
          }
         ?>
      </div>

      <div class="tab-pane fade" id="j4" role="tabpanel">
         <?php 
          foreach ($tblCorr4->result() as $row) {
            echo "<b>$row->Fecha</b>";
            echo "<p>$row->Mensaje</p>";
          }
         ?>
      </div>
    </div>

  </div>
</div>