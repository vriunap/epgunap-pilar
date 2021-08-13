
<div class="container">

 <!-- Content Row -->
 <div class="row">
   <div class='card mb-4 py-3 border-left-danger'>
      <div class='card-body'>
         <b><h5 class="text-danger">IMPORTANTE :</h5></b> 
         Solo deberá usar este formulario si ya cuenta con un el proyecto <span class="text-success">APROBADO</span> , y Transcurrido el tiempo necesario para cargar el borrador de tesis a la EPG, recuerde  completar los requisitos necesarios para este proceso.
      </div>
   </div>
   <!-- Content Column -->
   <div class="col-lg-12 mb-12">

      <!-- Project Card Example -->
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 text-gray-dark">Formulario de <b>Borrador de Tesis</b>
             <span class="m-0 font-weight-bold text-primary float-right">Paso N° 1 : Carga Borrador </span></h6>
          </div>
          <div class="card-body" id="frmMetaNewBorr" name="frmMetaNewBorr">
            <?php 
            $IdUser = $sess->IdUser;
            $CodUsuer = $sess->CodUser;
            $Nombre = $sess->NameUser;
            $DataProg=$this->dbRepo->inProgramaTesista($IdUser);
            $Programa =$DataProg->Nombre;
            $Tipo = ($DataProg->Tipo==1?"Maestria":"Doctorado");
            $Linea=$this->dbRepo->getSnapRow("dicLineasVRI","Id=$rowTram->IdLinea");
            $Docentes=$this->dbRepo->getSnapView("tblDocProg","IdPrograma=$DataProg->Id ORDER by IdDocente ASC");
            ?> 
            <form method="POST" name="frmProyNuevo" id="frmProyNuevo" onsubmit ="sendForm('frmMetaNewBorr','regBorradorN',frmProyNuevo); return false;" enctype="multipart/form-data" accept-charset="utf-8">
               <div class="form-group row" >
                  <div class="col-md-5">
                     <label>Tesista:</label>
                     <h5><?=$Nombre;?></h5>
                  </div>
                  <div class="col-md-5">
                     <label>Programa:</label>
                     <h5><?=$Programa;?></h5>
                  </div>
                  <div class="col-md-2">
                     <label>Tipo:</label>
                     <h5><?=$Tipo;?></h5>
                  </div>
               </div>

               <div class="form-group">
                  <label>Título de Proyecto:</label>
                  <textarea type="text" class="form-control" id="iptTitulo" name="iptTitulo" required=""></textarea>
               </div>

               <div class="form-group">
                  <label>Línea de Investigación:</label>
                  <select name="iptLinea" class="form-control" required="" onchange="loadForm('iptSubLinea','loadSublineas/'+this.value+'/')">
                     <option selected value="<?php echo $Linea->Id;?>"><?php echo $Linea->Nombre;?></option>
                 </select>
              </div>

            <div class="form-group">
               <label>Resumen de Proyecto:</label>
               <textarea type="text" class="form-control" id="iptResumen" name="iptResumen" required=""></textarea>
            </div>
            <div class="form-group">
               <label>Palabras Clave:</label>
               <input type="text" class="form-control" id="iptKeywords" name="iptKeywords" required=""></input>
            </div>
            <div class="form-group">
               <label >Objetivos:</label>
               <textarea type="text" class="form-control" id="iptObjetivos" name="iptObjetivos"></textarea>
            </div>
            <div class="form-group">
               <label >Conclusiones:</label>
               <textarea type="text" class="form-control" id="iptConclusion" name="iptConclusion"></textarea>
            </div>
            <div class="form-group"> 
               <label for="exampleFormControlFile1">Archivo de Proyecto</label>
               <input type="file" class="form-control-file" id="iptFile" name="iptFile" required="">
               <small  class="form-text text-muted">Solo se admiten archivos en PDF, Máximo 5Mb.</small>
            </div>

            <div class="form-group ">
               <center>
                  <button type="submit" class="btn btn-primary btn-lg btn-icon-split">
                     <span class="icon text-white-50">
                       <i class="fas fa-flag"></i>
                    </span>
                    <span class="text">Registrar Borrador de Tesis</span>
                 </button>
              </center>
           </div>
        </form>
     </div>
  </div>
</div>
</div>

</div>

