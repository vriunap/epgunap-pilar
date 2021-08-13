<?php 
if ($tesista) {
	$rowTram=$this->dbPilar->inTramTesista($tesista->Id);

	if ($rowTram) {

		$rowTesista = $this->dbPilar->inTesista($rowTram->IdTesista);
		$rowDet = $this->dbPilar->getSnapRow('tesTramitesDet',"IdTram=$rowTram->Id");
		$Nombre = $rowTesista->Nombres.", ". $rowTesista->Apellidos;
		$DataProg=$this->dbRepo->inProgramaTesista($rowTram->IdTesista);
		$Programa =$DataProg->Nombre;
		$Tipo = ($DataProg->Tipo==1?"MAESTRÍA":"DOCTORADO");
		$Linea=$this->dbRepo->getOneField("dicLineasVRI","Nombre","Id=$rowTram->IdLinea");
		$SubLinea=$this->dbRepo->getOneField("dicLineas","Nombre","Id=$rowTram->IdSubLinea");
		$Asesor=$this->dbRepo->inDocente($this->dbPilar->getOneField('tesJurados',"IdJurado","IdTram=$rowTram->Id AND Posicion=4"));
		?> 
		<div class="form-group row" >
			<div class="col-md-5">
				<label class="text-primary font-weight-bold">Tesista:</label>
				<p><?=$Nombre;?></p>
				<button onclick="loadForm('ctntFlow','vwTesista/<?=$rowTram->IdTesista;?>')" class='btn btn-sm btn-info'>Ver Usuario</button>
			</div>
			<div class="col-md-5">
				<label class="text-primary font-weight-bold">Programa:</label>
				<p><?=$Programa;?></p>
			</div>
			<div class="col-md-2">
				<label class="text-primary font-weight-bold">Tipo:</label>
				<p><?=$Tipo;?></p>
			</div>
		</div>

		<div class="form-group">
			<label class="text-primary font-weight-bold">Título de Proyecto:</label>
			<p><?=$rowDet->Titulo;?></p>
		</div>

		<div class="form-group">
			<label class="text-primary font-weight-bold">Línea de Investigación:</label>
			<p><?=$Linea;?></p>
		</div>

		<div class="form-group">
			<label class="text-primary font-weight-bold">Sub - Línea de Investigación:</label>
			<br>
			<small><?=$SubLinea;?></small>
		</div>

<!-- 		<div class="form-group">
			<label class="text-primary font-weight-bold">ASESOR DE TESIS:</label>
			<p><?php //echo $Asesor->Nombres.",".$Asesor->Apellidos;?></p>
		</div> -->
		<?php 
		// if ($rowTram->Tipo==2) {
			$jurados=$this->dbPilar->getSnapView('tesJurados',"IdTram=$rowTram->Id AND Estado=1 ORDER BY Posicion ASC");
			foreach ($jurados->result() as $row) {
				$docente=$this->dbRepo->inDocente($row->IdJurado);
				$denomina =array(1=>'Presidente',2=>'Primer Miembro',3=> 'Segundo Miembro', 4=>'Tercer Mimebro');
				?>
				<div class="form-group">
					<label class="text-danger font-weight-bold"><?php echo $denomina[$row->Posicion];?>:</label>
					<p><?php echo $docente->Nombres.",".$docente->Apellidos;?></p>
				</div>

				<?php
			// }


		}
		?>

		<div class="form-group">
			<a class="btn btn-sm btn-success" href="<?=base_url("opfile/$rowDet->Archivo");?>" target="_blank"> VER ARCHIVO ( Nueva Pestaña) </a>
		</div>
		<div class="form-group">
			<label class="text-primary font-weight-bold">ESTADO : </label>
			<p><?php echo $rowTram->Estado;?></p>
		</div>


		<?php
	}else{
		
		echo "No ha registrado ningun proyecto, Ingrese bien el criterio de búsqueda.";
	}
}
else{
	echo "La busqueda es inexistente";
}
?>	
