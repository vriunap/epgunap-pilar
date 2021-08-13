
<div class="container">

 <!-- Content Row -->
 <div class="row">
   <div class='card mb-4 py-3 border-left-danger'>
      <div class='card-body'>
         <b><h5 class="text-danger">IMPORTANTE :</h5></b> 
         Solo deberá usar este formulario si ya cuenta con un el proyecto <span class="text-success">APROBADO</span> , de comprobarse que la información es FALSA, Se procederá a bloquear la cuenta hasta justificar lo registrado deacuerdo a la normativa vigente.
      </div>
   </div>
    <!-- Content Column -->
    <div class="col-lg-12 mb-12">

      <!-- Project Card Example -->
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 text-gray-dark">Formulario de Borrador de Tesis
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
            $Lineas=$this->dbRepo->getSnapView("dicLineasVRI");
            $Docentes=$this->dbRepo->getSnapView("tblDocProg","IdPrograma=$DataProg->Id ORDER by IdDocente ASC");
            ?> 
            <form method="POST" name="frmProyNuevo" id="frmProyNuevo" onsubmit ="sendForm('frmMetaNewBorr','regBorrador',frmProyNuevo); return false;" enctype="multipart/form-data" accept-charset="utf-8">
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
                     <option selected disabled value="">Selecciona una Línea de Investigación</option>
                     <?php 
                     foreach ($Lineas->result() as $row) {
                       echo"<option value='$row->Id'>$row->Nombre</option>";
                    }
                    ?>
                 </select>
              </div>

              <div class="form-group">
               <label for="usr">Sub - Línea de Investigación:</label>
               <select class="form-control" required="" id="iptSubLinea" name="iptSubLinea">
                  <option selected disabled value="">Selecciona una Sub Línea de Investigación</option>
               </select>
            </div>

           <div class="form-group">
               <div class="row">
                  <div class="col-md-6">
                     <label for="usr">Presidente del Jurado:</label>
                     <select class="form-control" required="" id='j1' name='j1' required="">
                        <option selected disabled value="" >Seleccione al Presidente.</option>
                        <?php 
                           foreach ($Docentes->result() as $doc) {
                              $docen=$this->dbRepo->inProgramaDocente($doc->IdDocente,$DataProg->Id);
                              echo "<option value='$doc->IdDocente'>$docen->Nombres, $docen->Apellidos</option>";
                           }
                         ?>
                     </select>
                  </div>
                  <div class="col-md-6">
                     <label for="usr">Primer Miembro de Jurado:</label>
                     <select class="form-control" required="" id='j2' name='j2' required="">
                        <option selected disabled value="" >Seleccione al Primer Miembro.</option>
                        <?php 
                           foreach ($Docentes->result() as $doc) {
                              $docen=$this->dbRepo->inProgramaDocente($doc->IdDocente,$DataProg->Id);
                              echo "<option value='$doc->IdDocente'>$docen->Nombres, $docen->Apellidos</option>";
                           }
                         ?>
                     </select>
                  </div>
               </div>
            </div>

            <div class="form-group">
               <div class="row">
               <div class="col-md-6">
                  <label for="usr">Segundo Miembro del Jurado:</label>
                  <select class="form-control" required="" id='j3' name='j3' required="">
                     <option selected disabled value="" >Seleccione al Segundo Miembro.</option>
                     <?php 
                        foreach ($Docentes->result() as $doc) {
                           $docen=$this->dbRepo->inProgramaDocente($doc->IdDocente,$DataProg->Id);
                           echo "<option value='$doc->IdDocente'>$docen->Nombres, $docen->Apellidos</option>";
                        }
                      ?>
                  </select>
               </div>
               <div class="col-md-6">
                  <label for="usr">Tercer Miembro de Jurado ( ASESOR ):</label>
                  <select class="form-control" required="" id='j4' name='j4' required="">
                     <option selected disabled value="" >Seleccione al Asesor.</option>
                     <?php 
                        foreach ($Docentes->result() as $doc) {
                           $docen=$this->dbRepo->inProgramaDocente($doc->IdDocente,$DataProg->Id);
                           echo "<option value='$doc->IdDocente'>$docen->Nombres, $docen->Apellidos</option>";
                        }
                      ?>
                  </select>
               </div>
            </div>
            </div>
            <div class="form-group row" >
               <div class="col-md-4">
                  <div class="form-group">
                     <label for="usr">Tipo de Estudio:</label>
                     <select class="form-control" required="" id="iptTipoTesis" name="iptTipoTesis" required="">
                        <option selected disabled value="">Selecciona un Tipo</option>
                        <option value="1">Cualitativo</option>
                        <option value="2">Cuantitativo</option>
                     </select>
                  </div>

               </div>
               <div class="col-md-4">
                  <div class="form-group">
                     <label for="usr">Variables:</label>
                     <input class="form-control" type="text" name="iptVariables" id="iptVariables" required="">
                  </div>
               </div>
               <div class="col-md-4">
                  <div class="form-group">
                     <label for="usr">Tamaño de Muestra:</label>
                     <input class="form-control" type="number" name="iptTamMuestra" id="iptTamMuestra" required="">
                  </div>
               </div>
            </div>
            <div class="form-group row" >
               <div class="col-md-3">
                  <div class="form-group">
                     <label for="usr">Técnica de Rec. Datos:</label>
                     <select class="form-control" required="" id="iptTecnicaDatos" name="iptTecnicaDatos" required="">
                        <option selected disabled value="">Selecciona una Técnica</option>
                        <option value="1">Encuesta</option>
                        <option value="2">Entrevista</option>
                        <option value="3">Observación</option>
                        <option value="4">Experimento</option>
                        <option value="5">Otros</option>
                     </select>
                  </div>

               </div>
               <div class="col-md-5">
                  <div class="form-group">
                     <label for="usr">Método de Comprobación de Hipótesis:</label>
                     <input class="form-control" type="text" name="iptMetodHip" id="iptMetodHip" required="">
                  </div>
               </div>
               <div class="col-md-2">
                  <div class="form-group">
                     <label for="usr">Presupuesto<small>(S/.)</small>:</label>
                     <input class="form-control" type="number" name="iptPresupuesto" id="iptPresupuesto" required="">
                  </div>
               </div>
               <div class="col-md-2">
                  <div class="form-group">
                     <label for="usr">Tiempo: <small>En Meses</small></label>
                     <input class="form-control" type="number" name="iptTiempo" id="iptTiempo" required="">
                  </div>
               </div>
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

