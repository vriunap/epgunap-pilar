<div class="container">

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
        $subpgrama=$this->dbRepo->getOneField('dicSubprogramas',"Nombre","Id=$rowTes->IdSubProg");
        ?>
        <div class="form-group row" >
          <div class="col-md-5">
           <label>Tesista:</label>
           <h4><?php echo $rowTes->Nombres.", ".$rowTes->Apellidos;?></h4>
         </div>
         <div class="col-md-5">
           <label>Programa:</label>
           <h4><?=$Programa->Nombre;?></h4>
           <small><?php echo $subpgrama;?></small>
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

       <nav class="nav nav-pills flex-column flex-sm-row">
        <button class="flex-sm-fill btn btn-info m-1 text-sm-center nav-link" onclick="loadForm('infoCuenta','infoTesistas/2029/<?=$rowTes->Id;?>')">Datos</button>
        <button class="flex-sm-fill btn btn-primary m-1 text-sm-center nav-link" onclick="loadForm('infoCuenta','infoTesistas/2030/<?=$rowTes->Id;?>')">Historial</button>
         <button class="flex-sm-fill btn btn-secondary m-1 text-sm-center nav-link" onclick="loadForm('infoCuenta','infoTesistas/2028/<?=$rowTes->Id;?>')">Camb. Jur.</button>
        <button class="flex-sm-fill btn btn-dark m-1 text-sm-center nav-link " onclick="loadForm('infoCuenta','infoTesistas/2031/<?=$rowTes->Id;?>')">Proyecto</button>
        <button class="flex-sm-fill btn btn-warning m-1 text-sm-center nav-link "onclick="loadForm('infoCuenta','infoTesistas/2032/<?=$rowTes->Id;?>')">Borrador</button>
        <button class="flex-sm-fill btn btn-success m-1 text-sm-center nav-link" onclick="loadForm('ctntFlow','vwTesista/<?=$rowTes->Id;?>');" >Actualizar</button>

      </nav>


      <hr>

      <div class="card-body" id='infoCuenta'>
        
      </div>

    </div>
  </div>
</div>
</div>

</div>

