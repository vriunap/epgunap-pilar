<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include( "../absmain/mlLibrary.php" );
include( "../absmain/mlotiapi.php" );


class Docentes extends CI_Controller {

	public function __construct(){
		parent::__construct();

		$this->load->library("Sess");
		$this->load->library("Includes");
		$this->load->model('dbPilar');
		$this->load->model('dbRepo');
		$this->load->model('dbLog');
		$this->load->helper('globales');
	}

    public function index(){

		$this->sess->IsLoggedAccess();
		$sess = $this->sess->GetData();

		if( !$sess ){
            redirect( base_url("/"), 'refresh');
            return;
		}

		if( $sess->SessTip != "F6969x1711P" ) {
			$this->logout();
			return;
		}

		$this->load->view("docentes/panelD",array('sess'=>$sess));
	}

	public function viewListaProyecto()
	{
		$this->sess->IsLoggedAccess();
		$sess = $this->sess->GetData();
		$this->load->view('docentes/py/dpylista',array('sess'=>$sess));
	}
/*
	public function viewPanelAceptar($idTramite=0)
	{
		$this->sess->IsLoggedAccess();
		$sess = $this->sess->GetData();
		$proyecto=$this->dbPilar->infoTramite($idTramite,2,1);  // trámite, testramites.estado , tramdet.Iteracion



		$rol = $this->dbPilar->posicion($idTramite,$sess->IdUser);
		//print_r($proyecto);

		foreach($proyecto as $item)
		{
			$parametros = [
				'idtram' => $idTramite,
				'estado'=>$item['Estado'],
				'idjurado'=>$sess->IdUser,
				'rol'=> $rol,
				'iteracion'=>$item['Iteracion'],
				//'iteracion'=>2,
				'tituloPy'=>$item['Titulo'],
				'codigoPy'=>$item['Codigo'],
				'nombre'=>$item['Nombres']." ".$item['Apellidos'],
				'programa'=>$item['Nombre'],
				'fecha_asignacion'=>date( "d/m/y", strtotime($item['DateReg'])),
				'ruta_archivo'=>$item['Archivo']
			];
		};

		$this->load->view('docentes/py/dpyaceptar',$parametros);
	}
*/
// Reemplazo  de viewPanelAceptar
// también se ha generado la vista dpyaceptar_v2

public function viewPanelAceptar_v2($idTramite=0)
{

	$this->sess->IsLoggedAccess();
	$sess = $this->sess->GetData();

	//falta verificar si le corresponde esta etapa
	$rowTram=$this->dbPilar->getSnapRow('tesTramites',"Id=$idTramite");
	$rowDet=$this->dbPilar->getSnapRow('tesTramitesDet',"IdTram=$idTramite ORDER BY Id DESC");
	$rowDoc=$this->dbPilar->getSnapRow('tesTramitesDoc',"IdTram=$idTramite ORDER BY Id DESC");
	//$rol = $this->dbPilar->posicion($idTramite,$sess->IdUser); // esto lo podría obtener en la vista 

	
	$this->load->view('docentes/py/dpyaceptar_v2', array('sess'=>$sess , 'rowTram'=>$rowTram, 'rowDet'=>$rowDet, 'rowDoc'=>$rowDoc ));

}
//-----------------------------------------
/*

	public function viewPanelRevisar($idTramite=0)
	{
		$this->sess->IsLoggedAccess();
		$sess = $this->sess->GetData();
		$proyecto=$this->dbPilar->infoTramite($idTramite,4,1);

	    $rol = $this->dbPilar->posicion($idTramite,$sess->IdUser);



		foreach($proyecto as $item)
		{
		$parametros = [
			'idtram' => $idTramite,
			'estado'=>$item['Estado'],
			'idjurado'=>$sess->IdUser,
			'rol'=> $rol,
			'iteracion'=>$item['Iteracion'],
			'tituloPy'=>$item['Titulo'],
			'codigoPy'=>$item['Codigo'],
			'nombre'=>$item['Nombres']." ".$item['Apellidos'],
			'programa'=>$item['Nombre'],
			'fecha_asignacion'=>date( "d/m/y", strtotime($item['DateReg'])),
			'ruta_archivo'=>$item['Archivo']
		];
		};

		$this->load->view('docentes/py/dpyrevisar',$parametros);
	}
*/
// Reemplazo de viewPanelRevisar  

public function viewPanelRevisar_v2($idTramite=0)
{
	$this->sess->IsLoggedAccess();
	$sess = $this->sess->GetData();

	//falta verificar si le corresponde esta etapa
	$rowTram=$this->dbPilar->getSnapRow('tesTramites',"Id=$idTramite");
	$rowDet=$this->dbPilar->getSnapRow('tesTramitesDet',"IdTram=$idTramite ORDER BY Id DESC");
	$rowDoc=$this->dbPilar->getSnapRow('tesTramitesDoc',"IdTram=$idTramite ORDER BY Id DESC");

	$this->load->view('docentes/py/dpyrevisar_v2', array('sess'=>$sess , 'rowTram'=>$rowTram, 'rowDet'=>$rowDet, 'rowDoc'=>$rowDoc ));
}


// ===============================
/*
public function viewPanelRevisarCom($idTramite)
	{
		$this->sess->IsLoggedAccess();
		$sess = $this->sess->GetData();
		$proyecto=$this->dbPilar->infoTramite($idTramite,4,1);


		$datos= array();
		$indice=0;

		$listaCorr = $this->dbPilar->getSnapView("tblCorrecciones","IdTramite=$idTramite AND Iteracion=4 AND IdDocente=$sess->IdUser");
		$fecha_fin= $this->dbPilar->getOneField("tblCorrecciones","Fecha","IdTramite=$idTramite AND Iteracion=4");
		$rol = rolTexto($this->dbPilar->posicion($idTramite,$sess->IdUser));

		foreach($listaCorr->result() as $lista )
		{   
			$datos[$indice]['numero'] = $indice+1;
			$datos[$indice]['fecha'] = $lista->Fecha;
			$datos[$indice]['mensaje'] = $lista->Mensaje;
			$indice++;
		}

		$arrayenviar['correcciones']=$datos;

		foreach($proyecto as $item)
		{
		$parametros = [
			'idtram' => $idTramite,
			'estado'=>$item['Estado'],
			'idjurado'=>$sess->IdUser,
			'rol'=>$rol,
			'iteracion'=>$item['Iteracion'],
			'tituloPy'=>$item['Titulo'],
			'codigoPy'=>$item['Codigo'],
			'nombre'=>$item['Nombres']." ".$item['Apellidos'],
			'programa'=>$item['Nombre'],
			'fecha_asignacion'=>date( "d/m/y", strtotime($item['DateReg'])),
			'fecha_fin'=>date( "d/m/y", strtotime($fecha_fin)), //fin de corrección como rol de jurado
			'correcciones'=>$arrayenviar['correcciones'],
			'ruta_archivo'=>$item['Archivo']				
		];
		}

		$this->load->view('docentes/py/dpyrevisarcompletado',$parametros);

	}
*/
// Reemplazo de viewPanelRevisarCom


public function viewPanelRevisarCom($idTramite)
	{
		$this->sess->IsLoggedAccess();
		$sess = $this->sess->GetData();
			
		$rowTram=$this->dbPilar->getSnapRow('tesTramites',"Id=$idTramite");
		$rowDet=$this->dbPilar->getSnapRow('tesTramitesDet',"IdTram=$idTramite ORDER BY Id DESC");
		$rowDoc=$this->dbPilar->getSnapRow('tesTramitesDoc',"IdTram=$idTramite ORDER BY Id DESC");
	

		$datos= array();
		$indice=0;

		$listaCorr = $this->dbPilar->getSnapView("tblCorrecciones","IdTramite=$idTramite AND Iteracion=4 AND IdDocente=$sess->IdUser");
		$fecha_fin= $this->dbPilar->getOneField("tblCorrecciones","Fecha","IdTramite=$idTramite AND Iteracion=4");
		$rol = rolTexto($this->dbPilar->posicion($idTramite,$sess->IdUser));

		foreach($listaCorr->result() as $lista )
		{   
			$datos[$indice]['numero'] = $indice+1;
			$datos[$indice]['fecha'] = $lista->Fecha;
			$datos[$indice]['mensaje'] = $lista->Mensaje;
			$indice++;
		}

		$arrayenviar['correcciones']=$datos;

 		$this->load->view('docentes/py/dpyrevisarcompletado', array('sess'=>$sess , 'rowTram'=>$rowTram, 'rowDet'=>$rowDet, 'rowDoc'=>$rowDoc, 'correcciones'=>$arrayenviar['correcciones'] ));

	}



	public function viewSubpanelCorrec($idTramite,$iteracion,$texto)
	{
		$this->sess->IsLoggedAccess();
		$sess = $this->sess->GetData();
		$rowTram=$this->dbPilar->getSnapRow('tesTramites',"Id=$IdTram");
		$this->dbPilar->Update('tesTramites',array('Estado'=>3),$IdTram);

		$this->load->view('docentes/py/subop',$parametros);
	}



	public function regCorreccion()
	{
		$this->sess->IsLoggedAccess();
		$sess = $this->sess->GetData();
		$numero=1;

		$iptTramite = $this->input->post("idTramite");
		$iptIteracion= $this->input->post("iteracion");
		$iptEstado = $this->input->post("estado");
		$iptDocente= $this->input->post("idDocente");
		$iptRol=$this->input->post("rol");
		$iptTxtCorreccion = $this->input->post("textoCorreccion");
		$datos= array();
		$indice=0;

		$this->dbPilar->Insert('tblCorrecciones',array(
						'IdTramite'=>$iptTramite,
					    'Iteracion'=>$iptIteracion,
						'IdDocente'=>$iptDocente,
						'Posicion'=>$iptRol,
						'Fecha'=>mlCurrentDate(),
						'Mensaje'=> $iptTxtCorreccion
					   ));

		$listaCorr = $this->dbPilar->getSnapView("tblCorrecciones","IdTramite=$iptTramite AND Iteracion=$iptIteracion AND IdDocente=$iptDocente") ;

		foreach($listaCorr->result() as $lista )
		{
				$datos[$indice]['numero'] = $indice+1;
				$datos[$indice]['fecha'] = $lista->Fecha;
				$datos[$indice]['mensaje'] = $lista->Mensaje;
				$datos[$indice]['iteracion']=$iptIteracion;
				$indice++;
		}

		$arrayenviar['correcciones']=$datos;
     	$this->load->view('docentes/py/subop/splistacorrecciones',$arrayenviar);
	}

	public function finCorreccion($idTramite,$rol)
	{
		$this->sess->IsLoggedAccess();
		$sess = $this->sess->GetData();
		$rowTram=$this->dbPilar->getSnapRow('tesTramites',"Id=$idTramite");

		switch ($rol) {

		case 1 :
				$this->dbPilar->UpdateEx( 'tesTramitesDet', array('vb1'=>1), array('IdTram'=>$idTramite,'Iteracion'=>4) );
				$msg="<b>Corrección de proyecto finalizado como presidente</b>";

				break;
		case 2 :
				$this->dbPilar->UpdateEx( 'tesTramitesDet', array('vb2'=>1), array('IdTram'=>$idTramite,'Iteracion'=>4) );
				$msg="<b>Corrección de proyecto finalizado como primer miembro</b>";

				break;
		case 3 :
				$this->dbPilar->UpdateEx( 'tesTramitesDet', array('vb3'=>1), array('IdTram'=>$idTramite,'Iteracion'=>4) );
				$msg="<b>Corrección de proyecto finalizado como segundo miembro</b>";
				
				break;
		case 4 :
				$this->dbPilar->UpdateEx( 'tesTramitesDet', array('vb4'=>1), array('IdTram'=>$idTramite,'Iteracion'=>4) );
				$msg="<b>Corrección de proyecto finalizado como asesor</b>";
				
				break;
	

				default:
				$this->msgPanel('danger',"<b>Error</b>Datos incorrectos : Operación inválida");
				break;
		}

				$this->dbLog->exeDocentes($sess->IdUser, $idTramite, $rowTram->IdPrograma,$rowTram->IdFacultad, "Finalización de corrección" , $msg);
				$this->dbLog->exeTramites($sess->IdUser, "Docente", $idTramite,"Finalización de corrección", $msg);		
		

	}

/*
	public function viewPanelDictaminar($idTramite=0)
	{
		$this->sess->IsLoggedAccess();
		$sess = $this->sess->GetData();
		$proyecto=$this->dbPilar->infoTramite($idTramite,5,5);
		$datos= array();
		$indice=0;
		
		$listaCorr = $this->dbPilar->getSnapView("tblCorrecciones","IdTramite=$idTramite AND Iteracion=4 AND IdDocente=$sess->IdUser");
		$fecha_fin= $this->dbPilar->getOneField("tblCorrecciones","Fecha","IdTramite=$idTramite AND Iteracion=4");
		$rol = $this->dbPilar->posicion($idTramite,$sess->IdUser);
		
		foreach($listaCorr->result() as $lista )
		{   
			$datos[$indice]['numero'] = $indice+1;
			$datos[$indice]['fecha'] = $lista->Fecha;
			$datos[$indice]['mensaje'] = $lista->Mensaje;
			$indice++;
		}

		$arrayenviar['correcciones']=$datos;
		
		foreach($proyecto as $item)
		{
		$parametros = [
			'idtram' => $idTramite,
			'estado'=>$item['Estado'],
			'idjurado'=>$sess->IdUser,
			'rol'=>$rol,
			'iteracion'=>$item['Iteracion'],
			'tituloPy'=>$item['Titulo'],
			'codigoPy'=>$item['Codigo'],
			'nombre'=>$item['Nombres']." ".$item['Apellidos'],
			'programa'=>$item['Nombre'],
			'fecha_asignacion'=>date( "d/m/y", strtotime($item['DateReg'])),
			'fecha_fin'=>date( "d/m/y", strtotime($fecha_fin)), //fin de corrección como rol de jurado
			'correcciones'=>$arrayenviar['correcciones'],
			'ruta_archivo'=>$item['Archivo']				
		];
		}

		
		$this->load->view('docentes/py/dpydictaminar',$parametros);
	}
*/

//Reemplazo de función viewPanelDictaminar

	public function viewPanelDictaminar($idTramite=0)
	{
		$this->sess->IsLoggedAccess();
		$sess = $this->sess->GetData();
			
		$rowTram=$this->dbPilar->getSnapRow('tesTramites',"Id=$idTramite");
		$rowDet=$this->dbPilar->getSnapRow('tesTramitesDet',"IdTram=$idTramite ORDER BY Id DESC");
		$rowDoc=$this->dbPilar->getSnapRow('tesTramitesDoc',"IdTram=$idTramite ORDER BY Id DESC");

		
	
		$datos= array();
		$indice=0;
		
		$listaCorr = $this->dbPilar->getSnapView("tblCorrecciones","IdTramite=$idTramite AND Iteracion=4 AND IdDocente=$sess->IdUser");
		$fecha_fin= $this->dbPilar->getOneField("tblCorrecciones","Fecha","IdTramite=$idTramite AND Iteracion=4");
		$rol = $this->dbPilar->posicion($idTramite,$sess->IdUser);
		
		foreach($listaCorr->result() as $lista )
		{   
			$datos[$indice]['numero'] = $indice+1;
			$datos[$indice]['fecha'] = $lista->Fecha;
			$datos[$indice]['mensaje'] = $lista->Mensaje;
			$indice++;
		}

		$arrayenviar['correcciones']=$datos;

		$this->load->view('docentes/py/dpydictaminar', array('sess'=>$sess , 'rowTram'=>$rowTram, 'rowDet'=>$rowDet, 'rowDoc'=>$rowDoc, 'correcciones'=>$arrayenviar['correcciones'] ));
	}


	public function finDictaminacion($idTramite,$rol,$tipo) // tipo 1: sin correcciones ,tipo 2: con correcciones menores
	{
		$this->sess->IsLoggedAccess();
		$sess = $this->sess->GetData();
		$rowTram=$this->dbPilar->getSnapRow('tesTramites',"Id=$idTramite");
		$rowDet=$this->dbPilar->getSnapRow('tesTramitesDet',"IdTram=$idTramite ORDER BY Id DESC");

		$titulo= $rowDet->Titulo;
		$ruta =$rowDet->Archivo;

		$this->debug_consola("entre a dictaminación");
 
		switch ($rol) {

		case 1 :
				$this->dbPilar->UpdateEx( 'tesTramitesDet', array('vb1'=>$tipo), array('IdTram'=>$idTramite,'Iteracion'=>5) );
				$msg="<b>Dictaminación de proyecto finalizado como presidente</b>";
			
				break;
		case 2 :
				$this->dbPilar->UpdateEx( 'tesTramitesDet', array('vb2'=>$tipo), array('IdTram'=>$idTramite,'Iteracion'=>5) );
				$msg="<b>Dictaminación de proyecto finalizado como primer miembro</b>";

				break;
		case 3 :
				$this->dbPilar->UpdateEx( 'tesTramitesDet', array('vb3'=>$tipo), array('IdTram'=>$idTramite,'Iteracion'=>5) );
				$msg="<b>Dictaminación de proyecto finalizado como segundo miembro</b>";

				break;
		case 4 :
				$this->dbPilar->UpdateEx( 'tesTramitesDet', array('vb4'=>$tipo), array('IdTram'=>$idTramite,'Iteracion'=>5) );
				$msg="<b>Dictaminación de proyecto finalizado como asesor</b>";

				break;


				default:
				$this->msgPanel('danger',"<b>Error</b>Datos incorrectos : Operación inválida");
				break;
		};

				

		$this->dbLog->exeDocentes($sess->IdUser, $idTramite, $rowTram->IdPrograma,$rowTram->IdFacultad, "Finalización de dictaminación" , $msg);
		$this->dbLog->exeTramites($sess->IdUser, "Docente", $idTramite,"Finalización de dictaminación", $msg);		

	
		
		
		if($this->dictamenCompletado($idTramite))
		{ 
		
			$votosNegativos=0;

			$valor1 = $this->dbPilar->getOneField("tesTramitesDet", "vb1", "IdTram=$idTramite AND Iteracion=5");
			$valor2 = $this->dbPilar->getOneField("tesTramitesDet", "vb2", "IdTram=$idTramite AND Iteracion=5");
			$valor3 = $this->dbPilar->getOneField("tesTramitesDet", "vb3", "IdTram=$idTramite AND Iteracion=5");			

			$votos= array( $valor1, $valor2,  $valor3 );

			for($i=0; $i< count($votos);$i++)
			{
				if($votos[$i]<0)
					$votosNegativos++;

			}

				
			$this->debug_consola("votos negativos :" .$votosNegativos);

			if($votosNegativos>=2)
			{
				// se desaprueba, notifica, cambia de estado
				
				$this->debug_consola("votos negativos se desarpueba");	
				$this->dbPilar->UpdateEx( 'tesTramites', array('Estado'=>0), array('Id'=>$idTramite) );
				$msg="<b>El proyecto ha sido desaprobado en la etapa de dictamen</b>";
				$this->dbLog->exeTramites($sess->IdUser, "Pilar", $idTramite,"Desaprobación de proyecto", $msg);		
				
			}
			else
			{
				// se aprueba, notifica, correcciones menores, cambia de estado
				$this->debug_consola("votos negativos se aprueba");	
				$this->dbPilar->UpdateEx( 'tesTramites', array('Estado'=>6), array('Id'=>$idTramite) );
				
				$this->debug_consola($titulo);	

				$this->dbPilar->Insert('tesTramitesDet',array(
					'IdTram'=>$idTramite,
					'Iteracion'=>6,
					'Titulo'=>$titulo,
					'Archivo'=>$ruta,
					'vb1'=>0,
					'vb2'=>0,
					'vb3'=>0,
					'vb4'=>0,
					'DateReg'=>mlCurrentDate(),
					'DateModif'=>mlCurrentDate(), 					
					'Obs'=>"" 					
				));
				

				$msg="<b>El proyecto ha sido aprobado para su ejecución</b>";
				$this->dbLog->exeTramites($sess->IdUser, "Pilar", $idTramite,"Aprobación de proyecto", $msg);		
			}
		}

	}

	public function dictamenCompletado($idTramite) //¿ todos han dictaminado?
	{
		
		$vb1 = $this->dbPilar->getOneField("tesTramitesDet", "vb1", "IdTram=$idTramite AND Iteracion=5");
		$vb2 = $this->dbPilar->getOneField("tesTramitesDet", "vb2", "IdTram=$idTramite AND Iteracion=5");
		$vb3 = $this->dbPilar->getOneField("tesTramitesDet", "vb3", "IdTram=$idTramite AND Iteracion=5");

		$this->debug_consola("entre a dictamen completado");	

		if(($vb1!=0) AND ($vb2!=0) AND ($vb3!=0))
		{	
			$this->debug_consola("retorno verdadero");	
			return true;
		}
		else
		{
			$this->debug_consola("retorno falso");	
			return false;
		}

		

	}


	public function viewPanelActa($idTramite=0)
	{
		$this->sess->IsLoggedAccess();
		$sess = $this->sess->GetData();

		/*
		$proyecto=$this->dbPilar->infoTramite($idTramite,6,6);
		$fecha_asignacion=$this->dbPilar->getOneField("tesTramitesDet","DateReg","IdTram=".$idTramite);
		$rol = $this->dbPilar->posicion($idTramite,$sess->IdUser);

		foreach($proyecto as $item)
		{
			$parametros = [
				'idtram' => $idTramite,
				'estado'=>$item['Estado'],
				'idjurado'=>$sess->IdUser,
				'rol'=> $rol,
				'iteracion'=>$item['Iteracion'],
				'tituloPy'=>$item['Titulo'],
				'codigoPy'=>$item['Codigo'],
				'nombre'=>$item['Nombres']." ".$item['Apellidos'],
				'programa'=>$item['Nombre'],
				'fecha_asignacion'=>date( "d/m/y", strtotime($fecha_asignacion)),
				'fecha_aprobacion'=>date( "d/m/y", strtotime($item['DateReg']))

			];

		}

		$this->load->view('docentes/py/dpyacta',$parametros);
	*/


		$rowTram=$this->dbPilar->getSnapRow('tesTramites',"Id=$idTramite");
		$rowDet=$this->dbPilar->getSnapRow('tesTramitesDet',"IdTram=$idTramite ORDER BY Id DESC");
		$rowDoc=$this->dbPilar->getSnapRow('tesTramitesDoc',"IdTram=$idTramite ORDER BY Id DESC");
	
		$this->load->view('docentes/py/dpyacta', array('sess'=>$sess , 'rowTram'=>$rowTram, 'rowDet'=>$rowDet, 'rowDoc'=>$rowDoc ));


	}

	public function operacion($accion,$IdTram)
	{
		$this->sess->IsLoggedAccess();
		$sess = $this->sess->GetData();
		$rowTram=$this->dbPilar->getSnapRow('tesTramites',"Id=$IdTram");
		$rowDet=$this->dbPilar->getSnapRow('tesTramitesDet',"IdTram=$IdTram ORDER BY Id DESC");
		$rowDoc=$this->dbPilar->getSnapRow('tesTramitesDoc',"IdTram=$IdTram ORDER BY Id DESC");


		$titulo = $rowDet->Titulo;
	    $ruta = $rowDet->Archivo;
		//print_r($rowTram);

		switch ($accion) {
			//aprobar proyecto
			case "aceptar":
				$this->dbPilar->Update('tesTramites',array('Estado'=>3),$IdTram);
				$msg="<b>Aprobado por el Director</b><br>Ahora el proyecto se encuentra listo para el sorteo de jurados por el Director del Programa";

				$this->dbPilar->Insert('tesTramitesDet',array(
					'IdTram'=>$IdTram,
					'Iteracion'=>3,
					'Titulo'=>$titulo,
					'Archivo'=>$ruta,
					'vb1'=>0,
					'vb2'=>0,
					'vb3'=>0,
					'vb4'=>0,
					'DateReg'=>mlCurrentDate(),
					'DateModif'=>mlCurrentDate(), 					
					'Obs'=>"" 					
				));

				$this->dbLog->exeDocentes($sess->IdUser, $IdTram, $rowTram->IdPrograma,$rowTram->IdFacultad, "Aprobación del Director" , $msg);
				$this->dbLog->exeTramites($sess->IdUser, "Director", $IdTram,"Aprobación del proyecto", $msg);
			    //$this->msgPanel('success',"$msg"); 		

				break;

			case "rechazar":
					$this->dbPilar->Update('tesTramites',array('Tipo'=>0),$IdTram);

					$msg="<b>Rechazado por el Director</b><br>El proyecto ha sido rechazado por el Director";
					//$msg=$msg."<br>Motivo:<br>".htmlentities($txtOperacion); // mejorar esta parte

					$this->dbLog->exeDocentes($sess->IdUser, $IdTram, $rowTram->IdPrograma,$rowTram->IdFacultad, "Proyecto rechazado por el director" , $msg);
					$this->dbLog->exeTramites($sess->IdUser, "Director", $IdTram,"Rechazo", $msg);
					// FALTA enviar correo con las OBServaciones  y notificar en panel de tesista 
					//$this->msgPanel('success',"$msg"); 		
	
					break;

			default:
				$this->msgPanel('danger',"<b>Error</b>Datos incorrectos : Operación inválida");
				break;
		}
	}

	/* Funciones para PANEL  dpylista */
								
	






   // Sección Borrador

   public function viewListaBorrador()
   {
	   $this->sess->IsLoggedAccess();
	   $sess = $this->sess->GetData();
	   $this->load->view('docentes/bor/dborlista',array('sess'=>$sess));
   }


   public function viewPanelAceptarBor($idTramite=0)
   {
	   $this->sess->IsLoggedAccess();
	   $sess = $this->sess->GetData();
	   //$borrador=$this->dbPilar->infoTramite($idTramite,21,20);  // trámite, testramites.estado , tramdet.Iteracion
	   $rol = $this->dbPilar->posicion($idTramite,$sess->IdUser);

	
	   // foreach($borrador as $item)
	   // {

		  //  $parametros = array(
			 //   'idtram' => $idTramite,
			 //   'estado'=>$item['Estado'], 
			 //   'idjurado'=>$sess->IdUser,
			 //   'rol'=> $rol,
			 //   'iteracion'=>$item['Iteracion'],
			 //   //'iteracion'=>2,
			 //   'tituloPy'=>$item['Titulo'],
			 //   'codigoPy'=>$item['Codigo'],
			 //   'nombre'=>$item['Nombres']." ".$item['Apellidos'],
			 //   'programa'=>$item['Nombre'],
			 //   'fecha_asignacion'=>date( "d/m/y", strtotime($item['DateReg'])),
			 //   'ruta_archivo'=>$item['Archivo']				
		  //  );
	   // };
	   // $this->load->view('docentes/bor/dboraceptar',$parametros):

   	   $rowTram=$this->dbPilar->getSnapRow('tesTramites',"Id = $idTramite");
	   $rowDet=$this->dbPilar->getSnapRow('tesTramitesDet',"IdTram = $idTramite ORDER BY Iteracion DESC");
	   $tesista=$this->dbPilar->inTesista($rowTram->IdTesista);
       $programa=$this->dbRepo->inProgramaTesista($rowTram->IdTesista);

	   $this->load->view('docentes/bor/dboraceptar',array(
   		   'idtram' 		=> 	$rowTram->Id,
		   'estado'			=>	$rowTram->Estado,
		   'idjurado'		=>	$sess->IdUser,
		   'rol'			=> 	$rol,
		   'iteracion'		=>	$rowDet->Iteracion,
		   'tituloPy'		=>	$rowDet->Titulo,
		   'codigoPy'		=>	$rowTram->Codigo,
		   'nombre'			=>	$tesista->Nombres.",".$tesista->Apellidos,
		   'programa'		=>	$programa->Nombre,
		   'fecha_asignacion' => $rowTram->DateModif,
		   'ruta_archivo'	=> $rowDet->Archivo				
	   ));
   }


   public function operacionbor($accion,$IdTram)
   {
	   $this->sess->IsLoggedAccess();
	   $sess = $this->sess->GetData();
	   $rowTram=$this->dbPilar->getSnapRow('tesTramites',"Id=$IdTram");
	   $rowDet=$this->dbPilar->getSnapRow('tesTramitesDet',"IdTram=$IdTram ORDER BY Iteracion DESC");
	   $rowDoc=$this->dbPilar->getSnapRow('tesTramitesDoc',"IdTram=$IdTram");
	   


	   $titulo = $rowDet->Titulo;
	   $ruta = $rowDet->Archivo;
	   
	   switch ($accion) {
		   
		   case "aceptar":

               $this->dbPilar->Update('tesTramites',array('Estado'=>22),$IdTram);
			   $msg1="<b>Aprobado por el Director</b><br>Ahora el borrador de tesis se encuentra en la bandeja de los jurados para su revisión";
				
			  
				$this->dbPilar->Insert('tesTramitesDet',array(
					'IdTram'=>$IdTram,
					'Iteracion'=>22,
					'Titulo'=>$titulo,
					'Archivo'=>$ruta,
					'vb1'=>0,
					'vb2'=>0,
					'vb3'=>0,
					'vb4'=>0,
					'DateReg'=>mlCurrentDate(),
					'DateModif'=>mlCurrentDate(), 					
					'Obs'=>"" 					
				));
	   			

	   			$msg="Previo saludo, comunicarle que tiene en su bandeja [$rowTram->Codigo ] en calidad de jurado revisor";
			    $msg.=", para visualizarlo deberá ingresar a PILAR EPG en la  dirección : http://vriunap.pe/epgunap/ . Este correo";
			    $msg.="es de caracter informativo, para consultas contáctese con el programa de posgrado correspondiente.";

			    $jurados= $this->dbPilar->getSnapView('tesJurados',"IdTram=$IdTram");
			    foreach ($jurados->result() as $row) {
			    	$doc=$this->dbRepo->inDocente($row->IdJurado);
			    	$this->sendMail($doc->Correo,"NUEVO BORRADOR",$msg);
			    }
			   
			   $this->dbLog->exeDocentes($sess->IdUser, $IdTram, $rowTram->IdPrograma,$rowTram->IdFacultad, "Rev. Director de Tesis" , $msg1);
			   $this->dbLog->exeTramites($sess->IdUser, "Director", $IdTram,"Rev. Director de Tesis", $msg1);
			   //$this->msgPanel('success',"$msg"); 		

			   break;

		   case "rechazar":
				   $this->dbPilar->Update('tesTramites',array('Tipo'=>0),$IdTram); 

				   //$this->dbPilar->Update('tesTramites',array('Estado'=>20),$IdTram); 				   

				   $msg="<b>Rechazado por el Director</b><br>El borrador ha sido rechazado por el Director";
				   //$msg=$msg."<br>Motivo:<br>".htmlentities($txtOperacion); // mejorar esta parte
				   
				   $this->dbLog->exeDocentes($sess->IdUser, $IdTram, $rowTram->IdPrograma,$rowTram->IdFacultad, "Rechazo Director de Tesis" , $msg);
				   $this->dbLog->exeTramites($sess->IdUser, "Director", $IdTram,"Rechazo", $msg);
				   // FALTA enviar correo con las OBServaciones  y notificar en panel de tesista 
				   //$this->msgPanel('success',"$msg"); 		
   
				   break;

		   default:
			   $this->msgPanel('danger',"<b>Error</b>Datos incorrectos : Operación inválida");
			   break;
	   }
   }

/*
 function viewPanelRevisarBor($idTramite=0)
   {
	   $this->sess->IsLoggedAccess();
	   $sess = $this->sess->GetData();
	   $proyecto = $this->dbPilar->infoTramite($idTramite,22,22);

	   $rol = $this->dbPilar->posicion($idTramite,$sess->IdUser);

       if( $proyecto == null ){
           echo "Iter22 no presente";
       }

	   foreach($proyecto as $item)
	   {
	   $parametros = [
		   'idtram' => $idTramite,
		   'estado'=>$item['Estado'],
		   'idjurado'=>$sess->IdUser,
		   'rol'=> $rol,
		   'iteracion'=>$item['Iteracion'],
		   'tituloPy'=>$item['Titulo'],
		   'codigoPy'=>$item['Codigo'],
		   'nombre'=>$item['Nombres']." ".$item['Apellidos'],
		   'programa'=>$item['Nombre'],
		   'fecha_asignacion'=>date( "d/m/y", strtotime($item['DateReg'])),
		   'ruta_archivo'=>$item['Archivo']
	   ];
	   };

	   $this->load->view('docentes/bor/dborrevisar',$parametros);
   }
*/

// reemplazo viewPanelRevisarBor

   public function viewPanelRevisarBor($idTramite=0)
   {
	   $this->sess->IsLoggedAccess();
	   $sess = $this->sess->GetData();
   
	   //falta verificar si le corresponde esta etapa
	   $rowTram=$this->dbPilar->getSnapRow('tesTramites',"Id=$idTramite");
	   $rowDet=$this->dbPilar->getSnapRow('tesTramitesDet',"IdTram=$idTramite ORDER BY Id DESC");
	   $rowDoc=$this->dbPilar->getSnapRow('tesTramitesDoc',"IdTram=$idTramite ORDER BY Id DESC");

  
	   $this->load->view('docentes/bor/dborrevisar', array('sess'=>$sess , 'rowTram'=>$rowTram, 'rowDet'=>$rowDet, 'rowDoc'=>$rowDoc ));
   }
   




/*


   public function viewPanelRevisarComBor($idTramite)
   {
	   $this->sess->IsLoggedAccess();
	   $sess = $this->sess->GetData();
	   $proyecto=$this->dbPilar->infoTramite($idTramite,22,22);
	   $datos= array();
	   $indice=0;

	   $listaCorr = $this->dbPilar->getSnapView("tblCorrecciones","IdTramite=$idTramite AND Iteracion=22 AND IdDocente=$sess->IdUser");
	   $fecha_fin= $this->dbPilar->getOneField("tblCorrecciones","Fecha","IdTramite=$idTramite AND Iteracion=22");
	   $rol = rolTexto($this->dbPilar->posicion($idTramite,$sess->IdUser));

	   foreach($listaCorr->result() as $lista )
	   {   
		   $datos[$indice]['numero'] = $indice+1;
		   $datos[$indice]['fecha'] = $lista->Fecha;
		   $datos[$indice]['mensaje'] = $lista->Mensaje;
		   $indice++;
	   }

	   $arrayenviar['correcciones']=$datos;

	   foreach($proyecto as $item)
	   {
	   $parametros = [
		   'idtram' => $idTramite,
		   'estado'=>$item['Estado'],
		   'idjurado'=>$sess->IdUser,
		   'rol'=>$rol,
		   'iteracion'=>$item['Iteracion'],
		   'tituloPy'=>$item['Titulo'],
		   'codigoPy'=>$item['Codigo'],
		   'nombre'=>$item['Nombres']." ".$item['Apellidos'],
		   'programa'=>$item['Nombre'],
		   'fecha_asignacion'=>date( "d/m/y", strtotime($item['DateReg'])),
		   'fecha_fin'=>date( "d/m/y", strtotime($fecha_fin)), //fin de corrección como rol de jurado
		   'correcciones'=>$arrayenviar['correcciones'],
		   'ruta_archivo'=>$item['Archivo']				
	   ];
	   }

	   $this->load->view('docentes/bor/dborrevisarcompletado',$parametros);

   }
*/

// Funci+on reemplazo viewPanelRevisarComBor


   public function viewPanelRevisarComBor($idTramite)
	{
		$this->sess->IsLoggedAccess();
		$sess = $this->sess->GetData();
			
		$rowTram=$this->dbPilar->getSnapRow('tesTramites',"Id=$idTramite");
		$rowDet=$this->dbPilar->getSnapRow('tesTramitesDet',"IdTram=$idTramite ORDER BY Id DESC");
		$rowDoc=$this->dbPilar->getSnapRow('tesTramitesDoc',"IdTram=$idTramite ORDER BY Id DESC");
	

		$datos= array();
		$indice=0;

		$listaCorr = $this->dbPilar->getSnapView("tblCorrecciones","IdTramite=$idTramite AND Iteracion=22 AND IdDocente=$sess->IdUser");
		$fecha_fin= $this->dbPilar->getOneField("tblCorrecciones","Fecha","IdTramite=$idTramite AND Iteracion=22");
		$rol = rolTexto($this->dbPilar->posicion($idTramite,$sess->IdUser));

		foreach($listaCorr->result() as $lista )
		{   
			$datos[$indice]['numero'] = $indice+1;
			$datos[$indice]['fecha'] = $lista->Fecha;
			$datos[$indice]['mensaje'] = $lista->Mensaje;
			$indice++;
		}

		$arrayenviar['correcciones']=$datos;

 		$this->load->view('docentes/bor/dborrevisarcompletado', array('sess'=>$sess , 'rowTram'=>$rowTram, 'rowDet'=>$rowDet, 'rowDoc'=>$rowDoc, 'correcciones'=>$arrayenviar['correcciones'] ));

	}








   public function finCorreccionBor($idTramite,$rol)
   {
	   $this->sess->IsLoggedAccess();
	   $sess = $this->sess->GetData();
	   $rowTram=$this->dbPilar->getSnapRow('tesTramites',"Id=$idTramite");

	   switch ($rol) {

	   case 1 :
			   $this->dbPilar->UpdateEx( 'tesTramitesDet', array('vb1'=>1), array('IdTram'=>$idTramite,'Iteracion'=>22) );
			   $msg="<b>Corrección de borrador finalizado como presidente</b>";
			   
			   break;
	   case 2 :
			   $this->dbPilar->UpdateEx( 'tesTramitesDet', array('vb2'=>1), array('IdTram'=>$idTramite,'Iteracion'=>22) );
			   $msg="<b>Corrección de borradorfinalizado como primer miembro</b>";
			   
			   break;
	   case 3 :
			   $this->dbPilar->UpdateEx( 'tesTramitesDet', array('vb3'=>1), array('IdTram'=>$idTramite,'Iteracion'=>22) );
			   $msg="<b>Corrección de borrador finalizado como segundo miembro</b>";
			   
			   break;
	   case 4 :
			   $this->dbPilar->UpdateEx( 'tesTramitesDet', array('vb4'=>1), array('IdTram'=>$idTramite,'Iteracion'=>22) );
			   $msg="<b>Corrección de borrador finalizado como asesor</b>";
			   
			   break;


			   default:
			   $this->msgPanel('danger',"<b>Error</b>Datos incorrectos : Operación inválida");
			   break;
	   }

			   $this->dbLog->exeDocentes($sess->IdUser, $idTramite, $rowTram->IdPrograma,$rowTram->IdFacultad, "Finalización de corrección" , $msg);
			   $this->dbLog->exeTramites($sess->IdUser, "Docente", $idTramite,"Finalización de corrección", $msg);		
	   

   }

   public function viewPanelReunion($idTramite=0)
   {
	$this->sess->IsLoggedAccess();
	$sess = $this->sess->GetData();
	$rol = $this->dbPilar->posicion($idTramite,$sess->IdUser);

	$rowTram=$this->dbPilar->getSnapRow('tesTramites',"Id = $idTramite");
	$rowDet=$this->dbPilar->getSnapRow('tesTramitesDet',"IdTram = $idTramite ORDER BY Iteracion DESC");
	$tesista=$this->dbPilar->inTesista($rowTram->IdTesista);
	$programa=$this->dbRepo->inProgramaTesista($rowTram->IdTesista);

	$this->load->view('docentes/bor/dborreunion',array(
	 'idtram' 		=> 	$rowTram->Id,
	 'estado'		=>	$rowTram->Estado,
	 'idjurado'		=>	$sess->IdUser,
	 'rol'			=> 	$rol,
	 'iteracion'	=>	$rowDet->Iteracion,
	 'tituloPy'		=>	$rowDet->Titulo,
	 'codigoPy'		=>	$rowTram->Codigo,
	 'nombre'		=>	$tesista->Nombres.",".$tesista->Apellidos,
	 'programa'		=>	$programa->Nombre,
	 'fecha_asignacion' => $rowTram->DateModif,
	 'ruta_archivo'	=> $rowDet->Archivo				
 	));


   }

   public function regReunion()
   {
	$this->sess->IsLoggedAccess();
	$sess = $this->sess->GetData();
	//$rol = $this->dbPilar->posicion($idTramite,$sess->IdUser);


	$iptTramite = $this->input->post("idTramite");
	$rol = $this->dbPilar->posicion($iptTramite,$sess->IdUser);
	$iptIteracion= $this->input->post("iteracion");
	$iptDocente= $this->input->post("idDocente");
	$iptRol=$this->input->post("rol");
	$iptFechaHora=$this->input->post("fechahora");
	$iptLugar=$this->input->post("lugar");
	$iptMensaje= $this->input->post("mensaje");
	$motivo="Reunión de dictamen";

	$this->dbPilar->Insert('tblReuniones',array(
					'Status'=>0,
					'IdTramite'=>$iptTramite,
					'Motivo'=>$motivo,
					'Lugar'=>$iptLugar,
					'Mensaje'=>$iptMensaje,
					'DateReg'=>mlCurrentDate(),
					'DateLimite'=>$iptFechaHora,
					'Obs'=>""
				   ));

	$this->load->view('docentes/bor/dborlista',array('sess'=>$sess));
   }


   public function sendMail($to,$asunto,$msg) { 
		$this->load->library('email');

		$this->email->from('no-reply@vriunap.pe', 'PILAR-EPG');
		$this->email->to($to);

		$this->email->subject($asunto);
		$this->email->message($msg);

		$this->dbLog->Insert('logCorreos',array(
                'IdUsuario' =>$sess->IdUser,
                'TipoUser'  =>'DOCENTE',
                'Correo'    =>$to,
                'Asunto'    =>$asunto, 
                'Mensaje'   =>$msg
        ));

		if($this->email->send()) 
			$this->msgPanel('success', "Notificado al correo electrónico : $to");
		else 
			$this->msgPanel('danger', "Problemas enviando correo electrónico : $to");
	}

    public function msgPanel($color,$content){
	    echo "<div class='card  py-3 border-left-$color'>
			<div class='card-body'>
			  $content.
			</div>
		  </div>";
	}


	public function viewPanelDictaminarBor($idTramite=0)
	{
		$this->sess->IsLoggedAccess();
		$sess = $this->sess->GetData();
			
		$rowTram=$this->dbPilar->getSnapRow('tesTramites',"Id=$idTramite");
		$rowDet=$this->dbPilar->getSnapRow('tesTramitesDet',"IdTram=$idTramite ORDER BY Id DESC");
		$rowDoc=$this->dbPilar->getSnapRow('tesTramitesDoc',"IdTram=$idTramite ORDER BY Id DESC");
	
		$datos= array();
		$indice=0;
		
		$listaCorr = $this->dbPilar->getSnapView("tblCorrecciones","IdTramite=$idTramite AND Iteracion=22 AND IdDocente=$sess->IdUser");
		$fecha_fin= $this->dbPilar->getOneField("tblCorrecciones","Fecha","IdTramite=$idTramite AND Iteracion=22");
		$rol = $this->dbPilar->posicion($idTramite,$sess->IdUser);
		
		foreach($listaCorr->result() as $lista)
		{   
			$datos[$indice]['numero'] = $indice+1;
			$datos[$indice]['fecha'] = $lista->Fecha;
			$datos[$indice]['mensaje'] = $lista->Mensaje;
			$indice++;
		}

		$arrayenviar['correcciones']=$datos;

		$this->load->view('docentes/bor/dbordictaminar', array('sess'=>$sess , 'rowTram'=>$rowTram, 'rowDet'=>$rowDet, 'rowDoc'=>$rowDoc, 'correcciones'=>$arrayenviar['correcciones'] ));
	}


	public function finDictaminacionBor($idTramite,$rol,$tipo) // tipo 1: sin correcciones ,tipo 2: con correcciones menores
	{
		$this->sess->IsLoggedAccess();
		$sess = $this->sess->GetData();
		$rowTram=$this->dbPilar->getSnapRow('tesTramites',"Id=$idTramite");
		$rowDet=$this->dbPilar->getSnapRow('tesTramitesDet',"IdTram=$idTramite ORDER BY Id DESC");

		$titulo= $rowDet->Titulo;
		$ruta =$rowDet->Archivo;

		$this->debug_consola("entre a dictaminación borrador");
 
		switch ($rol) {

		case 1 :
				$this->dbPilar->UpdateEx( 'tesTramitesDet', array('vb1'=>$tipo), array('IdTram'=>$idTramite,'Iteracion'=>23) );
				$msg="<b>Dictaminación de borrador finalizado como presidente</b>";
			
				break;
		case 2 :
				$this->dbPilar->UpdateEx( 'tesTramitesDet', array('vb2'=>$tipo), array('IdTram'=>$idTramite,'Iteracion'=>23) );
				$msg="<b>Dictaminación de borrador finalizado como primer miembro</b>";

				break;
		case 3 :
				$this->dbPilar->UpdateEx( 'tesTramitesDet', array('vb3'=>$tipo), array('IdTram'=>$idTramite,'Iteracion'=>23) );
				$msg="<b>Dictaminación de borrador finalizado como segundo miembro</b>";

				break;
		case 4 :
				$this->dbPilar->UpdateEx( 'tesTramitesDet', array('vb4'=>$tipo), array('IdTram'=>$idTramite,'Iteracion'=>23) );
				$msg="<b>Dictaminación de borrador finalizado como asesor</b>";

				break;


				default:
				$this->msgPanel('danger',"<b>Error</b>Datos incorrectos : Operación inválida");
				break;
		};

				

		$this->dbLog->exeDocentes($sess->IdUser, $idTramite, $rowTram->IdPrograma,$rowTram->IdFacultad, "Finalización de dictaminación Borrador" , $msg);
		$this->dbLog->exeTramites($sess->IdUser, "Docente", $idTramite,"Finalización de dictaminación Borrador", $msg);		

	
		
		
		if($this->dictamenCompletadoBor($idTramite))
		{ 
		
			$votosNegativos=0;

			$valor1 = $this->dbPilar->getOneField("tesTramitesDet", "vb1", "IdTram=$idTramite AND Iteracion=23");
			$valor2 = $this->dbPilar->getOneField("tesTramitesDet", "vb2", "IdTram=$idTramite AND Iteracion=23");
			$valor3 = $this->dbPilar->getOneField("tesTramitesDet", "vb3", "IdTram=$idTramite AND Iteracion=23");			
			$valor4 = $this->dbPilar->getOneField("tesTramitesDet", "vb4", "IdTram=$idTramite AND Iteracion=23");			

			$votos= array( $valor1, $valor2,  $valor3 , $valor4);

			for($i=0; $i< count($votos);$i++)
			{
				if($votos[$i]<0)
					$votosNegativos++;

			}

				
			$this->debug_consola("votos negativos borrador :" .$votosNegativos);

			if($votosNegativos>=3)
			{
				// se desaprueba, notifica, cambia de estado
				
				$this->debug_consola("votos negativos se desarpueba borrador");	
				//$this->dbPilar->UpdateEx( 'tesTramites', array('Estado'=>0), array('Id'=>$idTramite) );
				$msg="<b>El borrador ha sido desaprobado en la etapa de dictamen</b>";
				$this->dbLog->exeTramites($sess->IdUser, "Pilar", $idTramite,"Desaprobación de borrador", $msg);		
				
			}
			else
			{
				// se aprueba, notifica, correcciones menores, cambia de estado
				$this->debug_consola("votos negativos se aprueba");	
				$this->dbPilar->UpdateEx( 'tesTramites', array('Estado'=>24), array('Id'=>$idTramite) );
				
				$this->dbPilar->Insert('tesTramitesDet',array(
					'IdTram'=>$idTramite,
					'Iteracion'=>24,
					'Titulo'=>$titulo,
					'Archivo'=>$ruta,
					'vb1'=>0,
					'vb2'=>0,
					'vb3'=>0,
					'vb4'=>0,
					'DateReg'=>mlCurrentDate(),
					'DateModif'=>mlCurrentDate(), 					
					'Obs'=>"" 					
				));
				

				$msg="<b>El borrador ha sido aprobado</b>";
				$this->dbLog->exeTramites($sess->IdUser, "Pilar", $idTramite,"Aprobación de Borrador[Trámite]", $msg);		
			}
		}

	}

	public function dictamenCompletadoBor($idTramite) //¿ todos han dictaminado?
	{
		
		$vb1 = $this->dbPilar->getOneField("tesTramitesDet", "vb1", "IdTram=$idTramite AND Iteracion=23");
		$vb2 = $this->dbPilar->getOneField("tesTramitesDet", "vb2", "IdTram=$idTramite AND Iteracion=23");
		$vb3 = $this->dbPilar->getOneField("tesTramitesDet", "vb3", "IdTram=$idTramite AND Iteracion=23");
		$vb4 = $this->dbPilar->getOneField("tesTramitesDet", "vb4", "IdTram=$idTramite AND Iteracion=23");

		$this->debug_consola("entre a dictamen completado");	

		if(($vb1!=0) AND ($vb2!=0) AND ($vb3!=0) AND  ($vb4!=0))
		{	
			$this->debug_consola("retorno verdadero");	
			return true;
		}
		else
		{
			$this->debug_consola("retorno falso");	
			return false;
		}

		

	}


	public function viewPanelActaBor($idTramite=0)
	{
		$this->sess->IsLoggedAccess();
		$sess = $this->sess->GetData();


		$rowTram=$this->dbPilar->getSnapRow('tesTramites',"Id=$idTramite");
		$rowDet=$this->dbPilar->getSnapRow('tesTramitesDet',"IdTram=$idTramite ORDER BY Id DESC");
		$rowDoc=$this->dbPilar->getSnapRow('tesTramitesDoc',"IdTram=$idTramite ORDER BY Id DESC");
	
		$this->load->view('docentes/bor/dboracta', array('sess'=>$sess , 'rowTram'=>$rowTram, 'rowDet'=>$rowDet, 'rowDoc'=>$rowDoc ));


	}



// Sección Sustentación

   // Sección Borrador

   public function viewListaSustentacion()
   {
	   $this->sess->IsLoggedAccess();
	   $sess = $this->sess->GetData();
	   $this->load->view('docentes/sus/dsuslista',array('sess'=>$sess));
   }

	public function viewPanelDictaminarSus($idTramite=0)
	{
		$this->sess->IsLoggedAccess();
		$sess = $this->sess->GetData();
			
		$rowTram=$this->dbPilar->getSnapRow('tesTramites',"Id=$idTramite");
		$rowDet=$this->dbPilar->getSnapRow('tesTramitesDet',"IdTram=$idTramite ORDER BY Id DESC");
		$rowDoc=$this->dbPilar->getSnapRow('tesTramitesDoc',"IdTram=$idTramite ORDER BY Id DESC");
				
		$rol = $this->dbPilar->posicion($idTramite,$sess->IdUser);

		$this->load->view('docentes/sus/dsusdictaminar', array('sess'=>$sess , 'rowTram'=>$rowTram, 'rowDet'=>$rowDet, 'rowDoc'=>$rowDoc ));
	}

	public function finDictaminacionSus($idTramite,$rol,$nota) // nota 0 a 20 
	{
		$this->sess->IsLoggedAccess();
		$sess = $this->sess->GetData();
		$rowTram=$this->dbPilar->getSnapRow('tesTramites',"Id=$idTramite");
		$rowDet=$this->dbPilar->getSnapRow('tesTramitesDet',"IdTram=$idTramite ORDER BY Id DESC");

		$titulo= $rowDet->Titulo;
		$ruta =$rowDet->Archivo;

		//$this->debug_consola("entre a dictaminación");
 
		switch ($rol) {

		case 1 :
				$this->dbPilar->UpdateEx( 'tesTramitesDet', array('vb1'=>$tipo), array('IdTram'=>$idTramite,'Iteracion'=>5) );
				$msg="<b>Dictaminación de sustentación finalizado como presidente</b>";
			
				break;
		case 2 :
				$this->dbPilar->UpdateEx( 'tesTramitesDet', array('vb2'=>$tipo), array('IdTram'=>$idTramite,'Iteracion'=>5) );
				$msg="<b>Dictaminación de proyecto finalizado como primer miembro</b>";

				break;
		case 3 :
				$this->dbPilar->UpdateEx( 'tesTramitesDet', array('vb3'=>$tipo), array('IdTram'=>$idTramite,'Iteracion'=>5) );
				$msg="<b>Dictaminación de proyecto finalizado como segundo miembro</b>";

				break;
		case 4 :
				$this->dbPilar->UpdateEx( 'tesTramitesDet', array('vb4'=>$tipo), array('IdTram'=>$idTramite,'Iteracion'=>5) );
				$msg="<b>Dictaminación de proyecto finalizado como asesor</b>";

				break;


				default:
				$this->msgPanel('danger',"<b>Error</b>Datos incorrectos : Operación inválida");
				break;
		};

				

		$this->dbLog->exeDocentes($sess->IdUser, $idTramite, $rowTram->IdPrograma,$rowTram->IdFacultad, "Finalización de dictaminación" , $msg);
		$this->dbLog->exeTramites($sess->IdUser, "Docente", $idTramite,"Finalización de dictaminación", $msg);		

	
		
		
		if($this->dictamenCompletado($idTramite))
		{ 
		
			$votosNegativos=0;

			$valor1 = $this->dbPilar->getOneField("tesTramitesDet", "vb1", "IdTram=$idTramite AND Iteracion=5");
			$valor2 = $this->dbPilar->getOneField("tesTramitesDet", "vb2", "IdTram=$idTramite AND Iteracion=5");
			$valor3 = $this->dbPilar->getOneField("tesTramitesDet", "vb3", "IdTram=$idTramite AND Iteracion=5");			

			$votos= array( $valor1, $valor2,  $valor3 );

			for($i=0; $i< count($votos);$i++)
			{
				if($votos[$i]<0)
					$votosNegativos++;

			}

				
			$this->debug_consola("votos negativos :" .$votosNegativos);

			if($votosNegativos>=2)
			{
				// se desaprueba, notifica, cambia de estado
				
				$this->debug_consola("votos negativos se desarpueba");	
				$this->dbPilar->UpdateEx( 'tesTramites', array('Estado'=>0), array('Id'=>$idTramite) );
				$msg="<b>El proyecto ha sido desaprobado en la etapa de dictamen</b>";
				$this->dbLog->exeTramites($sess->IdUser, "Pilar", $idTramite,"Desaprobación de proyecto", $msg);		
				
			}
			else
			{
				// se aprueba, notifica, correcciones menores, cambia de estado
				$this->debug_consola("votos negativos se aprueba");	
				$this->dbPilar->UpdateEx( 'tesTramites', array('Estado'=>6), array('Id'=>$idTramite) );
				
				$this->debug_consola($titulo);	

				$this->dbPilar->Insert('tesTramitesDet',array(
					'IdTram'=>$idTramite,
					'Iteracion'=>6,
					'Titulo'=>$titulo,
					'Archivo'=>$ruta,
					'vb1'=>0,
					'vb2'=>0,
					'vb3'=>0,
					'vb4'=>0,
					'DateReg'=>mlCurrentDate(),
					'DateModif'=>mlCurrentDate(), 					
					'Obs'=>"" 					
				));
				

				$msg="<b>El proyecto ha sido aprobado para su ejecución</b>";
				$this->dbLog->exeTramites($sess->IdUser, "Pilar", $idTramite,"Aprobación de proyecto", $msg);		
			}
		}

	}

	





// sección utilidades

	public function debug_consola($datos) 
	{
		$salida = $datos;
		if (is_array($salida))
		{
			$salida = implode(',', $salida);
		}
	
		echo("<script>console.log('Debug php: " . $salida . "' );</script>");
	}


}


?>