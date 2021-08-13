<div class="container">
  <?php 
      $tramDet=$this->dbPilar->getSnapRow ('tesTramitesDet',"IdTram=$rowTram->Id ORDER BY Iteracion DESC");
      $tramLog=$this->dbLog->getSnapView  ('logTramites', "IdTramite=$rowTram->Id");
      $tramJur=$this->dbPilar->getSnapView('tesJurados', "IdTram=$rowTram->Id AND Estado=1");
   ?>
 <!-- Content Row -->
 <div class="row">

  <!-- Content Column -->
  <div class="col-lg-12 mb-12">

    <!-- Project Card Example -->
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 text-gray-dark">Informacíon Tesista
         <span class="m-0 font-weight-bold text-primary float-right">Operaciónes Informativas</span></h6>
       </div>
       <div class="card-body">
        <?php 
        $Programa=$this->dbRepo->getSnapRow('dicProgramas',"Id=$rowTes->IdPrograma");
        ?>
        <div class="form-group row" >
          <div class="col-md-5">
           <label>Tesista:</label>
           <h4><?php echo $rowTes->Nombres.", ".$rowTes->Apellidos;?></h4>
         </div>
         <div class="col-md-5">
           <label>Programa:</label>
           <h4><?=$Programa->Nombre;?></h4>
         </div>
         <div class="col-md-2">
           <label>Tipo:</label>
           <h4><?=$rowTes->Tipo;?></h4>
         </div>
       </div>

       <div class="form-group row" >
          <div class="col-md-6">
           <label>Celular:</label>
           <h6><?php echo $rowTes->Celular?></h6>
         </div>
         <div class="col-md-6">
           <label>Correo:</label>
           <h6><?=$rowTes->Correo;?></h6>
         </div>
       </div>
         <div class="form-group row" >
          <div class="col-md-6">
           <label>Codigo:</label>
           <h6><?php echo $rowTes->Cod?></h6>
         </div>
         <div class="col-md-6">
           <label>DNI:</label>
           <h6><?=$rowTes->DNI;?></h6>
         </div>
       </div>

      <hr>

      <div class="card-body" id='infoCuenta'>
<div class="card card-timeline mb-4" id='contentPytoKind'>
  <!-- Content Row -->
  <div class="row">
    <!-- Content Column -->
    <div class="col-lg-7 mb-12">
     <!-- Project Card Example -->
     <div class="card shadow mb-4">
      <div class="card-header py-1 bg-primary">
        <h6 class="m-0 font-weight-bold text-white">Datos</h6>
      </div>
      <div class="card-body p- table-responsivesm">
        <table class="table table-striped">
          <thead>
            <tr class='p-1'>
              <th class='p-1'scope="col">DATO</th>
              <th class='p-1'scope="col">VALOR</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td class='p-2 font-weight-bold'>CODIGO </td>
              <td class='p-2'><?=$rowTram->Codigo;?></td>
            </tr>
             <tr>
              <td class='p-2 font-weight-bold'>ESTADO </td>
              <td class='p-2'><?=$rowTram->Estado;?></td>
            </tr>
            <tr>
              <td class='p-2 font-weight-bold'>TITULO </td>
              <td class='p-2'><?=$tramDet->Titulo;?></td>
            </tr>

            <tr>
              <td class='p-2 font-weight-bold'>ARCHIVO </td>
              <td class='p-2'><a class="badge badge-success" target="_blank" href="<?php echo base_url("opfile/$tramDet->Archivo");?>"> Visualizar </a></td>
            </tr>

            <tr>

              <td class='p-2' colspan="2">
                <?php
                  // print_r( $contCorr );
                  foreach ($tramJur->result() as $row) {
                    $docente  = $this->dbRepo->inDocente($row->IdJurado);
                    $denomina = array(1=>'Presidente',2=>'Primer Miembro',3=> 'Segundo Miembro', 4=>'Tercer Miembro / Asesor');
                    $correccs = "<span class='badge badge-danger'> ".$contCorr[$row->Posicion]." </span>";
                    echo "<b>".$denomina[$row->Posicion]."</b> $correccs <br>". $docente->Nombres." ".$docente->Apellidos."<br>";
                  }
                ?>
              <td>
            </tr>

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
</div>



        
      </div>

    </div>
  </div>
</div>
</div>

</div>

