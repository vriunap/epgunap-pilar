<form id="frmDatos"name='frmDatos' method="POST">
   <?php 

   $Docentes=$this->dbRepo->getSnapView("tblDocProg","IdPrograma=$row->IdPrograma ORDER by IdDocente ASC");
   $j1=$this->dbPilar->getSnapRow('tesJurados',"IdTram=$row->Id AND Estado<>0 AND Posicion=1");
   $j2=$this->dbPilar->getSnapRow('tesJurados',"IdTram=$row->Id AND Estado<>0 AND Posicion=2");
   $j3=$this->dbPilar->getSnapRow('tesJurados',"IdTram=$row->Id AND Estado<>0 AND Posicion=3");
   $j4=$this->dbPilar->getSnapRow('tesJurados',"IdTram=$row->Id AND Estado<>0 AND Posicion=4");

   ?>

   <input type="number" class="form-control" id="idTram" name='idTram' hidden="" value="<?=$row->Id;?>" onlyread="">

   <h3 class="lead font-weight-bold text-primary"> Cambio de Jurados - PILAR EPG</h3>
   <hr>

   <div class="col-md-12"> 
         <label class="text-danger">Documento de referencia</label>
         <input type="text" class="form-control" id="docRef" name="docRef" placeholder=" Ejemp. OFICIO No 0745-2020-DG-EPG-UNA-PUNO" required="">
      </div>
      <div class="col-md-12"> 
         <label class="text-danger">Nombre del Remitente</label>
         <input type="text" class="form-control" id="firma" name="firma" placeholder="Dr. Juan Perez Perez" required="">
      </div>
      <div class="col-md-12"> 
         <label class="text-danger">Motivo y Detalle del Cambio</label>
         <textarea type="text" class="form-control" id="motiv" name="motiv" placeholder="Justificación y Detalle   de Cambio de Jurado" required=""></textarea>
      </div>  
      <hr>

   <div class="row">
      <div class="col-md-6">
         <label for="usr" class='text-primary'>Presidente del Jurado:</label>
         <select class="form-control" required="" id='j1' name='j1' required="">
            <option selected disabled value="" >Seleccione al Presidente.</option>
            <?php 
            foreach ($Docentes->result() as $doc) {
               $docen=$this->dbRepo->inProgramaDocente($doc->IdDocente,$row->IdPrograma);
               $val=($doc->IdDocente==$j1->IdJurado?"selected":"");
               echo "<option value='$doc->IdDocente' $val>$docen->Nombres, $docen->Apellidos</option>";  
            }
            ?>
         </select>
      </div>
      <div class="col-md-6">
         <label for="usr" class='text-primary'>Primer Miembro de Jurado:</label>
         <select class="form-control" required="" id='j2' name='j2' required="">
            <option selected disabled value="" >Seleccione al Primer Miembro.</option>
            <?php 
            foreach ($Docentes->result() as $doc) {
               $docen=$this->dbRepo->inProgramaDocente($doc->IdDocente,$row->IdPrograma);
               $val=($doc->IdDocente==$j2->IdJurado?"selected":"");
               echo "<option value='$doc->IdDocente' $val>$docen->Nombres, $docen->Apellidos</option>";  
            }
            ?>
         </select>
      </div>
   </div>
</div>

<div class="form-group">

   <div class="row">
      <div class="col-md-6">
         <label for="usr" class='text-primary'>Segundo Miembro del Jurado:</label>
         <select class="form-control" required="" id='j3' name='j3' required="">
            <option selected disabled value="" >Seleccione al Segundo Miembro.</option>
            <?php 
            foreach ($Docentes->result() as $doc) {
               $docen=$this->dbRepo->inProgramaDocente($doc->IdDocente,$row->IdPrograma);
               $val=($doc->IdDocente==$j3->IdJurado?"selected":"");
               echo "<option value='$doc->IdDocente' $val>$docen->Nombres, $docen->Apellidos</option>";  
            }
            ?>
         </select>
      </div>
      <div class="col-md-6">
         <label for="usr" class='text-primary'>Tercer Miembro de Jurado ( ASESOR ):</label>
         <select class="form-control" required="" id='j4' name='j4' required="">
            <option selected disabled value="" >Seleccione al Asesor.</option>
            <?php 
            foreach ($Docentes->result() as $doc) {
               $docen=$this->dbRepo->inProgramaDocente($doc->IdDocente,$row->IdPrograma);
               $val=($doc->IdDocente==$j4->IdJurado?"selected":"");
               echo "<option value='$doc->IdDocente' $val>$docen->Nombres, $docen->Apellidos</option>";  
            }
            ?>
         </select>
      </div>
      

      <div class="col-md-12 mt-3">
         <div class="form-group">
            <button  onclick="sendForm('infoCuenta','cambioJurados',frmDatos); return false;" class="btn btn-primary btn-block btn-lg" name='btn-search' id ="btn-search"> <i class="fa fa-check"></i> Cambiar Jurados </button>
            <span><i>* Esta operación será registrada a su nombre.</i></span>
         </div>
      </div>
   </div>
</div>
</div>
</form>
