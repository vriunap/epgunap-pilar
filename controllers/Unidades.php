<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include( "../absmain/mlLibrary.php" );
include( "../absmain/mlotiapi.php" );

class Unidades extends CI_Controller {

	public function __construct(){
		parent::__construct();

		$this->load->library("Sess");
		$this->load->library("Includes");
		$this->load->model('dbPilar');
		$this->load->model('dbRepo');
		$this->load->model('dbLog');
	}

	public function index(){

		// $this->sess->IsLoggedAccess();
		$sess = $this->sess->GetData();

		if( !$sess ){
			redirect( base_url("/"), 'refresh');
			return;
		}

		if( $sess->SessTip != "F6980x171701W" ) {
			$this->logout();
			return;
		}

		if ($sess->IdPrograma!=0) {
			$this->load->view("unidades/panelP",array('sess'=>$sess));
			return;
		}
		$this->load->view("unidades/panelU",array('sess'=>$sess));
	}

	public function viewDocentes(){
		$this->sess->IsLoggedAccess();
		$sess = $this->sess->GetData();
		$this->load->view('unidades/doc/panelDocente',array('sess'=>$sess)); 
	}

	public function searhDoc(){
		$this->sess->IsLoggedAccess();
		$sess = $this->sess->GetData();

		$dni=$this->input->post("iptDNIDoc");
		if (!$dni) {
			echo "Debe Ingresar un DNI";
			return;
		}
		$query=$this->dbRepo->getSnapRow('tblDocentes',"DNI LIKE '$dni'");
		if (!$query) {
			echo "El docente no pertene a la UNA - Puno, contáctese con la administración";
			return;
		}

		$carrera=$this->dbRepo->getOneField("dicFacultades","Nombre","Id=$query->IdFacultad");
		if ($sess->Tipo==3) {
			$progt = $this->dbRepo->getSnapView('dicProgramas',"IdFacultad=$sess->IdFacultad");
		}if($sess->Tipo==4) {
			$progt = $this->dbRepo->getSnapView('dicProgramas',"Id=$sess->IdPrograma");
		}

		echo "
		<form method='POST' name='frmAddTeacher'>
		<input name='iptIddoc' value='$query->Id' hidden/>
		<label> Grado Académico </label>
		<select class='form-control' name='iptKind'>
		<option selected='' disabled='' value=''>Selecciona un Tipo</option>
		<option value='1'>Maestro</option>
		<option value='2'>Doctor</option>
		</select>
		<br>
		<label> Programa de Posgrado </label>
		<select class='form-control' name='iptPrograma'>
		";
		// <option selected='' disabled='' value=''>Selecciona un Programa</option>

		foreach ($progt->result() as $pr) {
			$tprogt=($pr->Tipo==1?"Maestría":"Doctorado");
			echo "<option value='$pr->Id'>$tprogt : $pr->Nombre</option>";
		}

		echo"</select>
		<table class='table table-borderless'>
		<thead>
		<tr><th scope='col'>1</th><th scope='col'>Nombre</th><td scope='row'>: $query->Nombres</td></tr>
		</thead>
		<tbody><tr><th scope='col'>2</th><th scope='col'>Apellidos</th><td scope='row'>: $query->Apellidos</td></tr>
		<tr><th scope='col'>3</th><th scope='col'>Facultad</th><td scope='row'>: $carrera</td></tr>
		</table>
		</form>
		<a class='form-control btn btn-success' onclick=\"sendForm('resultSearchDoc','AddTeacher',frmAddTeacher)\">Guardar </a>
		";
	}

	public function AddTeacher()
    {
		$this->sess->IsLoggedAccess();
		$sess = $this->sess->GetData();

		$id=$this->input->post("iptIddoc");
		$kind=$this->input->post("iptKind");
		$iptPrograma=$this->input->post("iptPrograma");

        // siempre debes verificar los datos... #$%#%#$%#$
        // los $#$# coordinadores nunca seleccionan si no les ordenas

        if( !$id or !$kind or !$iptPrograma ){

            $this->msgPanel( "danger", "Debe seleccionar un <b>Grado y/o Programa de Posgrado</b>" );
            return;
        }


		$query    = $this->dbRepo->getSnapRow('tblDocentes',"Id=$id");
		$consulta = $this->dbRepo->getSnapRow('tblDocProg',"IdDocente=$id AND IdPrograma=$iptPrograma");
		if ($consulta OR !$iptPrograma OR !$kind  ) {
			$this->msgPanel('danger',"<b>UPS ...! </b>Registro Incorrecto : Docente $query->Nombres <br> [Intente Nuevamente / Ya está agregado]");
			return;
		}

		$this->dbRepo->Insert('tblDocProg',array(
			'IdDocente'			=>  $query->Id,
			'IdFacultad'		=>  $sess->IdFacultad,
			'IdPrograma'		=>  $iptPrograma,
			'Estado'			=>  1,
			'Tipo'				=>  $kind,
			'DateReg'			=>  mlCurrentDate(),
			'DateModif'			=>  mlCurrentDate(),
			'Obs'			=>  "-",
		));

		$msg="El docente $query->Id , ha sido agregado como docente de la Unidad en el Programa : $iptPrograma.";
		$this->dbLog->exeUnidades($sess->IdUser, 0, $iptPrograma,$sess->IdFacultad,"Registro Docente" , "$msg");
		//$this->viewDocentes();

        echo "<script> loadForm('ctntFlow','viewDocentes') </script>";
	}


	public function viewProyectos(){
		// Agregar la función de comprobación de estado :: PENDIENTE A
		$this->sess->IsLoggedAccess();
		$sess = $this->sess->GetData();
		$this->load->view('unidades/tram/pytos',array('sess'=>$sess)); 
	}


	public function oper($op,$IdTram){
		$this->sess->IsLoggedAccess();
		$sess = $this->sess->GetData();
		$rowTram=$this->dbPilar->getSnapRow('tesTramites',"Id=$IdTram");
		$rowDet=$this->dbPilar->getSnapRow('tesTramitesDet',"IdTram=$IdTram  ORDER BY Id DESC");
		$rowDoc=$this->dbPilar->getSnapRow('tesTramitesDoc',"IdTram=$IdTram");
		$rowTes=$this->dbPilar->getSnapRow('tblTesistas',"Id=$rowTram->IdTesista");
		$mail=$this->dbPilar->inCorreo($rowTram->IdTesista);
		switch ($op) {
			case 999:
			// $this->msgPanel('danger',"<b>Error ...! </b>Datos Incorrectos : [Operación Inválida]");

                    $arrCont = [
                        0,
                        $this->dbPilar->getSnapView('tblCorrecciones',"Iteracion = 1 AND IdTramite=$rowTram->Id AND Posicion=1") ->num_rows(),
	    			    $this->dbPilar->getSnapView('tblCorrecciones',"Iteracion = 1 AND IdTramite=$rowTram->Id AND Posicion=2") ->num_rows(),
    				    $this->dbPilar->getSnapView('tblCorrecciones',"Iteracion = 1 AND IdTramite=$rowTram->Id AND Posicion=3") ->num_rows(),
                        $this->dbPilar->getSnapView('tblCorrecciones',"Iteracion = 1 AND IdTramite=$rowTram->Id AND Posicion=4") ->num_rows()
                    ];
			$this->load->view('unidades/tram/infoTram',array('sess'=>$sess,'rowTram'=>$rowTram,'rowDet'=>$rowDet,'rowDoc'=>$rowDoc,'rowTes'=>$rowTes, 'contCorr'=>$arrCont));
			break;
			case 1001:
			$this->load->view('unidades/tram/pyt1rev',array('sess'=>$sess,'rowTram'=>$rowTram,'rowDet'=>$rowDet,'rowDoc'=>$rowDoc));
				// $this->msgPanel('danger',"<b>Error ...! </b>Datos Incorrectos : [Operación Inválida]");
			break;
			case 2001:
			$this->load->view('unidades/tram/borradrs1rev',array('sess'=>$sess,'rowTram'=>$rowTram,'rowDet'=>$rowDet,'rowDoc'=>$rowDoc));
				// $this->msgPanel('danger',"<b>Error ...! </b>Datos Incorrectos : [Operación Inválida]");
			break;
			case 1002:
			$this->dbPilar->Update('tesTramites',array('Estado'=>2,'DateModif'=>mlCurrentDate()),$IdTram);
			$this->dbPilar->Insert('tesTramitesDet',array(
				'IdTram' 	=> $IdTram,
				'Iteracion' => 2,
				'Titulo'	=> strtoupper($rowDet->Titulo),
				'Archivo'	=> $rowDet->Archivo,
				'vb1'		=> 0,
				'vb2'		=> 0,
				'vb3'		=> 0,
				'vb4'		=> 0,
				'DateReg'	=> mlCurrentDate(),
				'DateModif'	=> mlCurrentDate(),
				'Obs'		=> "",
			));
			$msg="<b>Proyecto Enviado !</b><br>$rowTram->Codigo : Enviado al Director de Tesis para su Confirmación [Envio Correcto]";
			$this->dbLog->exeUnidades($sess->IdUser, $IdTram, $rowTram->IdPrograma,$sess->IdFacultad,"Revisión Formato" , "$msg");
			$this->dbLog->exeTramites($sess->IdUser, "Coordinación", $IdTram,"UI Revisión de Proyecto", $msg);
			$this->msgPanel('success',"$msg");
			$this->sendMail($mail,"PROYECTO ENVIADO",strip_tags($msg));
			break;
			case 1003:
			$corr=$this->input->post('iptCorrects');
			$this->dbPilar->Update('tesTramites',array('Tipo'=>0),$IdTram);
			$msg="<b>Proyecto Rechazado!</b><br>$rowTram->Codigo : Rechazado por la Unidad de investigaciónpara su corrección [Envio Correcto] : $corr";
			$this->dbLog->exeUnidades($sess->IdUser, $IdTram, $rowTram->IdPrograma,$sess->IdFacultad,"UI Proyecto Rechazado" , "$msg");
			$this->dbLog->exeTramites($sess->IdUser, "Coordinación", $IdTram,"UI Proyecto Rechazado", $msg);
			$this->msgPanel('success',"$msg");
			$this->sendMail($mail,"PROYECTO RECHAZADO",strip_tags($msg));
			break;
			case 1004:
			$this->load->view('unidades/tram/pyt3sort',array('sess'=>$sess,'rowTram'=>$rowTram,'rowDet'=>$rowDet,'rowDoc'=>$rowDoc));
			break;
			case 1005:
			$j1=$this->input->post('j1');
			$j2=$this->input->post('j2');
			$j3=$this->input->post('j3');
			$j4=$this->input->post('j4');
			
			//  Log de Sorteo 

			$this->dbLog->Insert("logJuCambios", array(
		        'Referens'  => "Sorteo",        // Mejorar tipo doc
		        'IdTramite' => $rowTram->Id,    // guia de Tramite
		        'Tipo'      => $rowTram->Tipo,
		        'IdEstado'      => $rowTram->Estado,  // en el momento
		        'IdPrograma'      => $rowTram->IdPrograma,  // en el momento
		        'IdJurado1' => $j1,
		        'IdJurado2' => $j2,
		        'IdJurado3' => $j3,
		        'IdJurado4' => $j4,
		        'Motivo'    => "Sorteo",
		        'DateReg'     => mlCurrentDate()
		    ) );

			$msg="Previo saludo, comunicarle que tiene una nueva desginación [$rowTram->Codigo ] en calidad de jurado revisor";
			$msg.=", para visualizarlo deberá ingresar a PILAR EPG en la  dirección : http://vriunap.pe/epgunap/ . Este correo";
			$msg.="es de caracter informativo para consultas contáctese con el programa de posgrado correspondiente.";
			// Registra Jurado Seleccionado 
			for ($i=1; $i <4 ; $i++) { 
				$doc=$this->dbRepo->inDocente(${'j'.$i});
				$this->dbPilar->Insert('tesJurados',array(
					'IdTram' 	=> $IdTram,
					'IdJurado' 	=> ${'j'.$i},
					'IdPrograma' =>$rowTram->IdPrograma,
					'Estado' 	=> 1,
					'Posicion' 	=> $i,
					'DateReg' 	=> mlCurrentDate(),
					'DateModif' => mlCurrentDate(),
					'Obs' 		=> "",
				));
		    	// Aprovechamos Notificación
				$this->dbLog->exeDocentes($doc->Id, $rowTram->Id, $rowTram->IdPrograma,$rowTram->IdFacultad,"UI Asignación de Proyecto" , "Asignación : $rowTram->Codigo");
				$this->sendMail($doc->Correo,"DESIGNACIÓN DE JURADO",$msg);
			}

			$this->dbPilar->Update('tesTramites',array('Estado'=>4,'DateModif'=>mlCurrentDate()),$IdTram);

			$this->dbPilar->Insert('tesTramitesDet',array(
				'IdTram' 	=> $IdTram,
				'Iteracion' => 4,
				'Titulo'	=> $rowDet->Titulo,
				'Archivo'	=> $rowDet->Archivo,
				'vb1'		=> 0,
				'vb2'		=> 0,
				'vb3'		=> 0,
				'vb4'		=> 0,
				'DateReg'	=> mlCurrentDate(),
				'DateModif'	=> mlCurrentDate(),
				'Obs'		=> "",
			));
			// $this->sendMail("torresfrd@gmail.com","DESIGNACIÓN DE JURADO",$msg);

			$this->dbLog->exeUnidades($sess->IdUser, $rowTram->Id, $sess->IdPrograma,$sess->IdFacultad,"Sorteo" , "Sorteo : $rowTram->Codigo");

			$this->dbLog->exeTramites($sess->IdUser, "Coordinación", $IdTram,"UI Sorteo de Jurados", "Designación de Jurados :$j1,$j2,$j3,$j4");


			$msg2 = "<b>Exito! </b>Sorteo de Jurados Correcto, se ha procedido a notificar para el periodo de revisión correspondiente.";
			$this->msgPanel('success',$msg2);

			$this->sendMail($mail,"SORTEO DE JURADOS","$msg2");
			break;

			case 2002:
			$this->dbPilar->Update('tesTramites',array('Estado'=>21, 'DateModif'=>mlCurrentDate()),$IdTram);
			$this->dbPilar->Insert('tesTramitesDet',array(
				'IdTram' 	=> $IdTram,
				'Iteracion' => 21,
				'Titulo'	=> $rowDet->Titulo,
				'Archivo'	=> $rowDet->Archivo,
				'vb1'		=> 0,
				'vb2'		=> 0,
				'vb3'		=> 0,
				'vb4'		=> 0,
				'DateReg'	=> mlCurrentDate(),
				'DateModif'	=> mlCurrentDate(),
				'Obs'		=> "",
			));
			$msg="<b>Borrador Revisado!</b><br>El borrador de tesis ha sido enviado al Director de Tesis para su revisión. [Envio Correcto]";
			$this->dbLog->exeUnidades($sess->IdUser, $IdTram, $rowTram->IdPrograma,$sess->IdFacultad,"UI Revisión de Borrador" , "$msg");
			$this->dbLog->exeTramites($sess->IdUser, "Coordinación", $IdTram,"UI Revisión de Borrador", $msg);
			$this->msgPanel('success',"$msg");
			$this->sendMail($mail,"BORRADOR ENVIADO AL DIRECTOR",$msg);
			break;

			case 2003:
			$corr=$this->input->post('iptCorrects');
			$this->dbPilar->Update('tesTramites',array('Tipo'=>0),$IdTram);
			$msg="<b>Borrador Rechazado!</b><br>Borrador rechazado y retornado al Tesista para su corrección por la unidad de investigación [Rechazo Correcto] : $corr";
			$this->dbLog->exeUnidades($sess->IdUser, $IdTram, $rowTram->IdPrograma,$sess->IdFacultad,"UI Borrador Rechazado" , "$msg");
			$this->dbLog->exeTramites($sess->IdUser, "Coordinación", $IdTram,"UI Borrador Rechazado", $msg);
			$this->msgPanel('success',"$msg");
			$this->sendMail($mail,"BORRADOR REAHZADO",$msg);
			break;

			default:
			$this->msgPanel('danger',"Consulte con la Unidad de la EPG Error : [Operación Inválida]");
			break;
		}
	}

	// Funciones de Tesita
	public function choseWay($kind){
		$this->sess->IsLoggedAccess();
		$sess = $this->sess->GetData();
		if ($kind==1) {
			$this->load->view('tesistas/py/001formNuevoProy',array('sess'=>$sess)); 
			return;
		}elseif ($kind==2) {
			$this->load->view('tesistas/borr/001formNuevoBorr',array('sess'=>$sess)); 
			return;
		}else{
			$this->msgPanel('danger',"<b>UPS ...! </b>Datos Incorrectos : [Intente Nuevamente]");
			return;
		}
	}

	public function loadSublineas($Id){
		$this->sess->IsLoggedAccess();
		$sess = $this->sess->GetData();
		$query=$this->dbRepo->getSnapView('dicLineas',"IdLineaVRI=$Id AND Estado=1");
		if ($query) {
			echo "<option selected disabled value=''>Selecciona una Sub Línea de Investigación</option>";
			foreach ($query->result() as $row) {
				echo "<option value='$row->Id'>$row->Nombre</option>";
			}
		}else{
			echo "Error: Intente Nuevamente";
		}

	}
	// End Funciones de Tesista


	public function viewBorrador(){
		// Agregar la función de comprobación de estado :: PENDIENTE A
		$this->sess->IsLoggedAccess();
		$sess = $this->sess->GetData();
		$this->load->view('unidades/tram/borradrs',array('sess'=>$sess)); 
	}

	public function viewSustentac(){
		// $this->load->view('tesistas/py/00formSelect'); 
		echo "<div class='card mb-4 py-3 border-left-danger'>
		<div class='card-body'>
		Usted no cumple requisitos para acceder a esta sección.
		</div>
		</div>";
	}
	public function viewLog(){
		$this->sess->IsLoggedAccess();
		$sess = $this->sess->GetData();
		$this->load->view('unidades/log/logActi',array('sess'=>$sess));
	}
	public function msgPanel($color,$content){
		echo "<div class='card mb-4 py-3 border-left-$color'>
		<div class='card-body'>
		$content.
		</div>
		</div>";
	}

	public function doSorteo($IdTram){
		$this->sess->IsLoggedAccess();
		$sess = $this->sess->GetData();

		if (!$IdTram) return;

		$rowTram=$this->dbPilar->getSnapRow('tesTramites',"Id=$IdTram");

		if ($rowTram->Estado!=3) {
			$this->msgPanel('danger',"El proyecto ya ha sido sorteado o el estado no corresponde [Actualizar Panel].");
			return;
		}
		$rowDet=$this->dbPilar->getSnapRow('tesTramitesDet',"IdTram=$IdTram  ORDER BY Id DESC");
		$rowDoc=$this->dbPilar->getSnapRow('tesTramitesDoc',"IdTram=$IdTram");
		$IdDirector = $this->dbPilar->getOneField('tesJurados',"IdJurado","IdTram=$IdTram AND Posicion=4");
		$Linea=$this->dbRepo->getOneField("dicLineasVRI","Nombre","Id=$rowTram->IdLinea");
		$SubLinea=$this->dbRepo->getOneField("dicLineas","Nombre","Id=$rowTram->IdSubLinea");
		$lista=$this->dbRepo->getSnapView('tblDocProg',"IdPrograma=$rowTram->IdPrograma AND IdDocente<>$IdDirector ORDER BY Tipo DESC, IdDocente ASC");

		$jur=array();
		$i=1;
		foreach($lista->result() as $row){
			$jur[] = $row->IdDocente;
		}

		$total = $lista->num_rows();
		do {
			$j1 = rand( 0, $total-1 );
			$j2 = rand( 0, $total-1 );
			$j3 = rand( 0, $total-1 );

		}while( $j1 == $j2 OR $j2==$j3  OR $j1==$j3);

		echo "Aleatoriza : $j1 /$j2 /$j3<br> Linea de Investigación : $Linea <br> SubLinea : $SubLinea";

		$prop= array($jur[$j1],$jur[$j2],$jur[$j3] ,$IdDirector);

		$juritas=array();
		for ($i=0; $i <=3 ; $i++) { 
			$doc=$this->dbRepo->inDocente($prop[$i]);
			$tipoDoc=$this->dbRepo->getOneField('tblDocProg',"Tipo","IdDocente=$prop[$i] AND IdPrograma=$rowTram->IdPrograma");
			$juritas[$i] = array($prop[$i],$doc->Codigo,$tipoDoc);
		}


		for( $i=0; $i<3; $i++ ) for( $j=$i+1; $j<3; $j++ ){
			if( $juritas[$i][1] > $juritas[$j][1] )
			{
				$temp = $juritas[$i];
				$juritas[$i] = $juritas[$j];
				$juritas[$j] = $temp;
			}
		}


		for( $i=0; $i<3; $i++ ) for( $j=$i+1; $j<3; $j++ ){
			if( $juritas[$i][2] < $juritas[$j][2] )
			{
				$temp = $juritas[$i];
				$juritas[$i] = $juritas[$j];
				$juritas[$j] = $temp;
			}
		}

		echo "<form  name='frmAssingJudge' method='post' accept-charset='utf-8'>";
		echo "<table class='table table-bordered' cellPadding=0>";

		$tipos=array('Presidente','Primer Miembro','Segundo Miembro','Director/Asesor');
		for( $i=1; $i<=4; $i++ ) {

			$idDoc = $juritas[$i-1][0];
			$posis = "<input type='hidden' name='j$i' value='$idDoc'>";
			$rowDocente = $this->dbRepo->inDocente($idDoc);

			echo "<tr>";
			echo "<td>$i $posis </td>";
			echo "<td> $rowDocente->Nombres, $rowDocente->Apellidos <br><small><b> ".$tipos[$i-1]." </b></small</td>";
			echo "<td> <small>$rowDocente->Correo</small> </td>";
			$tipo=($juritas[$i-1][2]==1?"Maestro":"Doctor");
			echo "<td> <b>$tipo</b> </td>";
			echo "</tr>";
		}
		echo "</table> </form>"; 
 

		$this->dbLog->Insert("logJuCambios", array(
		        'IdTramite' => $rowTram->Id,    // guia de Tramite
		        'IdEstado'  => $rowTram->Estado,  // en el momento
		        'IdPrograma'=> $rowTram->IdPrograma,  // en el momento
		        'Tipo'      => $rowTram->Tipo,
		        'Referens'  => "Intento",        // Mejorar tipo doc
		        'IdJurado1' => $juritas[0][0],
		        'IdJurado2' => $juritas[1][0],
		        'IdJurado3' => $juritas[2][0],
		        'IdJurado4' => $IdDirector,
		        'Motivo'    => "Intento",
		        'DateReg'   => mlCurrentDate()
		    ) );


		$this->dbLog->exeUnidades($sess->IdUser, $rowTram->Id, $sess->IdPrograma,$sess->IdFacultad,"Intento Sorteo" , "Intento de Sorteo: $rowTram->Codigo");

		echo "<span class='help-block'> * Al guardar estos jurados está conforme con su composición, orden y grado académico, de lo contrario click en cancelar.</span>";
		echo "<center><button class='btn btn-md btn-success' onclick=\"sendForm('opResponse','oper/1005/$rowTram->Id',frmAssingJudge)\"> GURARDAR ESTOS JURADOS*</button></center>";
	}

	public function deleteDoc($Id, $IdPrograma){
		$this->sess->IsLoggedAccess();
		$sess = $this->sess->GetData();
		$this->dbRepo->DeleteEx("tblDocProg","IdDocente=$Id AND IdFacultad=$sess->IdFacultad AND IdPrograma=$sess->IdPrograma ");
		$msg= "El Docente ha sido eliminado del programa $IdPrograma. CLick en Cerrar para Actualizar";
		$this->dbLog->exeUnidades($sess->IdUser, 0, $sess->IdPrograma,$sess->IdFacultad,"Borrar Docente: $Id" , "$msg");
		$this->msgPanel('success',$msg);
	}


	public function sendMail($to,$asunto,$msg) { 
		$this->sess->IsLoggedAccess();
		$sess = $this->sess->GetData();

		$this->load->library('email');
		$this->email->from('no-reply@vriunap.pe', 'PILAR-EPG');
		$this->email->to($to);
		$this->email->subject($asunto);
		$this->email->message($msg);

		$this->dbLog->Insert('logCorreos',array(
				'IdUsuario'	=>$sess->IdUser,
				'TipoUser'	=>'Unidad',
				'Correo'	=>$sess->Correo,
				'Asunto'	=>$asunto,
				'Mensaje'	=>$msg
		));

		if($this->email->send())
			$this->msgPanel('success', "Notificado al correo electrónico : $to");
		else 
			$this->msgPanel('danger', "Problemas enviando correo electrónico : $to");
	}

	public function logout()
    {
		if( $sess = $this->sess->GetData() )
		    $this->dbLog->exeAccesos($sess->IdUser,3,"Salida","");

		$this->sess->SessionDestroy();
		redirect(base_url(),'refresh');
	}

}
