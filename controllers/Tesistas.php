<?php defined('BASEPATH') OR exit('No direct script access allowed');

include( "../absmain/mlLibrary.php" );
include( "../absmain/mlotiapi.php" );


class Tesistas extends CI_Controller
{
	public function __construct()
    {
		parent::__construct();

		$this->load->library("Sess");
		$this->load->library("Includes");
		$this->load->model('dbPilar');
		$this->load->model('dbLog');
		$this->load->model('dbRepo');
        $this->load->library("GenApi");
	}

	//public function version()
    //{
	//	$this->load->view('welcome_message');
	//}

	public function index()
    {
		// $this->sess->IsLoggedAccess();
		$sess = $this->sess->GetData();

		if( !$sess ){
			redirect( base_url("/"), 'refresh');
			return;
		}elseif( $sess->SessTip == "F6969x1711P" ) {
			$this->load->view("tesistas/panel",array('sess'=>$sess));
			return;
		}else{
			$this->logout();
			redirect( base_url("/"), 'refresh');
		}
	}

	public function pruebas(){
		echo"pruebas";
	}
    public function actaProy( $id=0 )
    {
        if( ! $id ){
            echo "No procesable";
            return;
        }

        $rowTram = $this->dbPilar->getSnapRow( 'tesTramites', "Id=$id" );
		$rowDets = $this->dbPilar->getSnapRow( 'tesTramitesDet', "IdTram=$rowTram->Id AND Iteracion=6 ORDER BY Id DESC" );
        $rowAlum = $this->dbPilar->getSnapRow( 'tblTesistas', "Id=$rowTram->IdTesista" );

        //echo "IdTram=$rowTram->Id AND Iteracion=6";
        //echo "<hr>";
        //print_r( $rowDets );
        if( ! $rowDets )
        {
            echo "<b>Error: </b>Id Tramite ($rowTram->Id), Sin iteracion de aprobación.";
            exit;
        }

        //--------------------------------------------
        // comprobaciones aburridas pero necesarias
        //--------------------------------------------
        if( ! $rowTram ){
            echo "El trámite no existe";
            return;
        }

        if( $rowTram->Estado < 6 ){
            echo "El trámite aun no se ha completado para aprobacion";
            return;
        }

        if( $rowDets->Iteracion < 5 ){

            echo "El trámite en detalle, aún no se ha completado para aprobacion";
            return;
        }

        $prog = $this->dbRepo->inProgramaTesista( $rowTram->IdTesista );
        if( !$prog ){
            echo "Programa EPG no definido para el tesista";
            return;
        }


        header("Content-type:application/pdf");
        header("Content-Disposition:inline;");

        $dia = (int) substr( $rowDets->DateReg, 8, 2 );
        $mes = $this->nombreMes( substr($rowDets->DateReg,5,2) );
        $ano = (int) substr( $rowDets->DateReg, 0, 4 );
        $hor = substr( $rowDets->DateReg, 11, 8 );
        $qrx = $this->CodeQR( $rowTram->Codigo, 180 );

        /*
        <img width="200" src="https://chart.googleapis.com/chart?cht=qr&chs=160x160&chl=<?= ?>&choe=UTF-8">
        */


		$j1=$this->dbRepo->inDocenteEx($this->dbPilar->getOneField('tesJurados','IdJurado',"IdTram=$rowTram->Id AND  Posicion=1 AND Estado=1"));
		$j2=$this->dbRepo->inDocenteEx($this->dbPilar->getOneField('tesJurados','IdJurado',"IdTram=$rowTram->Id AND  Posicion=2 AND Estado=1"));
		$j3=$this->dbRepo->inDocenteEx($this->dbPilar->getOneField('tesJurados','IdJurado',"IdTram=$rowTram->Id AND  Posicion=3 AND Estado=1"));
		$j4=$this->dbRepo->inDocenteEx($this->dbPilar->getOneField('tesJurados','IdJurado',"IdTram=$rowTram->Id AND  Posicion=4 AND Estado=1"));


		//echo "$rowTram->Id";
        //return;

        $args = array(
            'tipActa' => "PROYECTO",
            'codTram' => $rowTram->Codigo,
            'Titulo'  => $rowDets->Titulo,
            'Tesista' => "$rowAlum->Nombres $rowAlum->Apellidos",
            'dia'     => $dia,
            'mes'     => $mes,
            'ano'     => $ano,
            'hor'     => $hor,
            'prog'    => $prog,
            'j1'	  => $j1,
            'j2'	  => $j2,
            'j3'	  => $j3,
            'j4'	  => $j4,
            'qimg'    => $qrx,
        );

        $html = $this->load->view('tesistas/acta', $args, TRUE);
        echo $this->genapi->SignIn( $html, 14, 255 );

        //echo $html;
    }


    public function actaBorr( $id = 0 )
    {
        if( ! $id ){
            echo "No procesable";
            return;
        }

        $rowTram = $this->dbPilar->getSnapRow( 'tesTramites', "Id=$id" );
		$rowDets = $this->dbPilar->getSnapRow( 'tesTramitesDet', "IdTram=$rowTram->Id ORDER BY Id DESC" );
        $rowAlum = $this->dbPilar->getSnapRow( 'tblTesistas', "Id=$rowTram->IdTesista" );

        //--------------------------------------------
        // comprobaciones aburridas pero necesarias
        //--------------------------------------------
        if( ! $rowTram ){
            echo "El trámite no existe";
            return;
        }

        if( $rowTram->Estado < 24 ){
            echo "El trámite aun no se ha completado para aprobacion";
            return;
        }

        if( $rowDets->Iteracion < 23 ){
            echo "El trámite en detalle, aún no se ha completado para aprobacion";
            return;
        }

        $prog = $this->dbRepo->inProgramaTesista( $rowTram->IdTesista );
        if( !$prog ){
            echo "Programa EPG no definido para el tesista";
            return;
        }


        header("Content-type:application/pdf");
        header("Content-Disposition:inline;");

        $dia = (int) substr( $rowDets->DateReg, 8, 2 );
        $mes = $this->nombreMes( substr($rowDets->DateReg,5,2) );
        $ano = (int) substr( $rowDets->DateReg, 0, 4 );
        $hor = substr( $rowDets->DateReg, 11, 8 );
        $qrx = $this->CodeQR( $rowTram->Codigo, 180 );

        /*
        <img width="200" src="https://chart.googleapis.com/chart?cht=qr&chs=160x160&chl=<?= ?>&choe=UTF-8">
        */


		$j1=$this->dbRepo->inDocenteEx($this->dbPilar->getOneField('tesJurados','IdJurado',"IdTram=$rowTram->Id AND Posicion=1") ); // AND Estado=20"));
		$j2=$this->dbRepo->inDocenteEx($this->dbPilar->getOneField('tesJurados','IdJurado',"IdTram=$rowTram->Id AND Posicion=2") ); // AND Estado=20"));
		$j3=$this->dbRepo->inDocenteEx($this->dbPilar->getOneField('tesJurados','IdJurado',"IdTram=$rowTram->Id AND Posicion=3") ); // AND Estado=20"));
		$j4=$this->dbRepo->inDocenteEx($this->dbPilar->getOneField('tesJurados','IdJurado',"IdTram=$rowTram->Id AND Posicion=4") ); // AND Estado=20"));

		/// echo "$j1";
        $args = array(
            'tipActa' => "BORRADOR",
            'codTram' => $rowTram->Codigo,
            'Titulo'  => $rowDets->Titulo,
            'Tesista' => "$rowAlum->Nombres $rowAlum->Apellidos",
            'dia'     => $dia,
            'mes'     => $mes,
            'ano'     => $ano,
            'hor'     => $hor,
            'prog'    => $prog,
            'j1'	  => $j1,
            'j2'	  => $j2,
            'j3'	  => $j3,
            'j4'	  => $j4,
            'qimg'    => $qrx,
        );

        $html = $this->load->view('tesistas/acta', $args, TRUE);
        echo $this->genapi->SignIn( $html, 14, 254 );
    }

    public function verActa( $id = 15 )
    {
        //$this->sess->IsLoggedAccess();
		//$sess = $this->sess->GetData();

        echo "definir acta P/B";

        /*
        if( ! $id ){
            echo "No procesable";
            return;
        }

        //$rowTram = $this->dbPilar->inTramTesista( $sess->IdUser );
        $rowTram = $this->dbPilar->getSnapRow( 'tesTramites', "Id=$id" );
		$rowDets = $this->dbPilar->getSnapRow( 'tesTramitesDet', "IdTram=$rowTram->Id ORDER BY Id DESC" );
        $rowAlum = $this->dbPilar->getSnapRow( 'tblTesistas', "Id=$rowTram->IdTesista" );


        //--------------------------------------------
        // comprobaciones aburridas pero necesarias
        //--------------------------------------------
        if( ! $rowTram ){
            echo "El trámite no existe";
            return;
        }

        if( $rowTram->Estado < 24 ){
            echo "El trámite aun no se ha completado para aprobacion";
            return;
        }

        if( $rowDets->Iteracion < 24 ){
            echo "El trámite en detalle, aún no se ha completado para aprobacion";
            return;
        }

        $prog = $this->dbRepo->inProgramaTesista( $rowTram->IdTesista );
        if( !$prog ){
            echo "Programa EPG no definido para el tesista";
            return;
        }



        header("Content-type:application/pdf");
        header("Content-Disposition:inline;");


        $dia = (int) substr( $rowDets->DateReg, 8, 2 );
        $mes = $this->nombreMes( substr($rowDets->DateReg,5,2) );
        $ano = (int) substr( $rowDets->DateReg, 0, 4 );
        $hor = substr( $rowDets->DateReg, 11, 8 );
        $qrx = $this->CodeQR( $rowTram->Codigo, 180 );


		$j1=$this->dbRepo->inDocenteEx($this->dbPilar->getOneField('tesJurados','IdJurado',"IdTram=$rowTram->Id AND  Posicion=1 AND Estado=1"));
		$j2=$this->dbRepo->inDocenteEx($this->dbPilar->getOneField('tesJurados','IdJurado',"IdTram=$rowTram->Id AND  Posicion=2 AND Estado=1"));
		$j3=$this->dbRepo->inDocenteEx($this->dbPilar->getOneField('tesJurados','IdJurado',"IdTram=$rowTram->Id AND  Posicion=3 AND Estado=1"));
		$j4=$this->dbRepo->inDocenteEx($this->dbPilar->getOneField('tesJurados','IdJurado',"IdTram=$rowTram->Id AND  Posicion=4 AND Estado=1"));

		/// echo "$j1";
        $args = array(
            'tipActa' => "PROYECTO",
            'codTram' => $rowTram->Codigo,
            'Titulo'  => $rowDets->Titulo,
            'Tesista' => "$rowAlum->Nombres $rowAlum->Apellidos",
            'dia'     => $dia,
            'mes'     => $mes,
            'ano'     => $ano,
            'hor'     => $hor,
            'prog'    => $prog,
            'j1'	  => $j1,
            'j2'	  => $j2,
            'j3'	  => $j3,
            'j4'	  => $j4,
            'qimg'    => $qrx,
        );

        $html = $this->load->view('tesistas/acta', $args, TRUE);

        echo $this->genapi->SignIn( $html, 14, 250 );
        */
    }


    function nombreMes( $nmes )
    {
        $meses = array( "", "ENERO", "FEBRERO", "MARZO", "ABRIL", "MAYO", "JUNIO", "JULIO", "AGOSTO", "SEPTIEMBRE", "OCTUBRE", "NOVIEMBRE", "DICIEMBRE" );
        return $meses[ (int)$nmes ];
    }

    function CodeQR( $code, $siz=152 )
    {
        $urlCode = urlencode ( $code );
        // "http://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=PedroEstuvo&.png";
        $urlImage = "https://chart.googleapis.com/chart?"
                  . "cht=qr&chs=$siz" ."x" ."$siz&chl=$urlCode&.png";

        /// normal
        /// $this->Image( $urlImage, $xpos, $ypos);
        // $api = curl_init();
        // curl_setopt($api, CURLOPT_URL, $urlImage);
        // curl_setopt($api, CURLOPT_RETURNTRANSFER, 1);
        // $res = curl_exec($api);
		// $file = tmpfile();
		// $path = stream_get_meta_data($file)['uri'];


        $path = "include/qr/$code.png";
        $imagen = file_get_contents( $urlImage );
		file_put_contents( $path, $imagen );


        /*
        $file = tmpfile();
        $path = stream_get_meta_data($file)['uri'];
        file_put_contents( "$path.png", $urlImage ); // base64_decode($data) );
        */

        //$pdf->Image( "$path.jpg", 140, 29, 35 );

        //echo " <img src='$path.png'> ";

        return $path;
    }


	public function viewProyecto(){
		// Agregar la función de comprobación de estado :: PENDIENTE A
		$this->sess->IsLoggedAccess();
		$sess = $this->sess->GetData();

        //print_r( $sess );

		$rowTram=$this->dbPilar->inTramTesista($sess->IdUser);

		if (!$rowTram) {
			$this->load->view('tesistas/py/000formProyecto');
			return;
		}

		$rowDet=$this->dbPilar->getSnapRow('tesTramitesDet',"IdTram=$rowTram->Id");

		switch ($rowTram->Estado) {
			case 1:
				$this->msgPanel("success","<b>PROYECTO EN VERIFICACIÓN</b><br>El proyecto está REGISTRADO y a la espera de verificación por la Unidad de Investigación.<br> <br> <small>Tiempo Estimado : 48Hrs</small>");
				break;

			case 2:
				$this->msgPanel("success","<b>PROYECTO EN VERIFICACIÓN POR EL DIRECTOR DE TESIS</b><br> debe de comunicarse con su director de tesis para su aprobación y posterior sorteo de jurados. <br> <br> <small>Tiempo Estimado : 48Hrs</small>");
				break;

			case 3:
				$this->msgPanel("success","<b>PROYECTO LISTO PARA SORTEO DE JURADOS</b><br> debe de comunicarse con el director de la unidad de investigación para el sorteo de Jurados. <br> <br> <small>Tiempo Estimado : 48Hrs</small>");
				break;

			case 4:
				$tblCorr1=$this->dbPilar->getSnapView('tblCorrecciones',"Iteracion<10 AND IdTramite=$rowTram->Id AND Posicion=1 ORDER BY Fecha ASC");
				$tblCorr2=$this->dbPilar->getSnapView('tblCorrecciones',"Iteracion<10 AND IdTramite=$rowTram->Id AND Posicion=2 ORDER BY Fecha ASC");
				$tblCorr3=$this->dbPilar->getSnapView('tblCorrecciones',"Iteracion<10 AND IdTramite=$rowTram->Id AND Posicion=3 ORDER BY Fecha ASC");
				$this->load->view('tesistas/py/004Correcciones',array('tblCorr1'=>$tblCorr1,'tblCorr2'=>$tblCorr2,'tblCorr3'=>$tblCorr3));
				//$this->msgPanel("success","<b>PROYECTO EN REVISIÓN POR LOS JURADOS DE TESIS</b><br> debe de comunicarse con los jurados de tesis para la respectiva revisión . <br> <br> <small>Tiempo Estimado : 10 Días</small>");
				break;

			case 5:
				$this->msgPanel("success","<b>PROYECTO EN DICTAMEN</b><br> debe de comunicarse con los jurados de tesis para el DICTAMEN CORRESPONDIENTE. <br> <br> <small>Tiempo Estimado : 5 Días</small>");
				break;

			case 6:
                $acta = "<hr><a target=_blank href='actaProy/$rowTram->Id' class='btn btn-success'> Ver/Descargar Acta de Aprobación </a>";
				$this->msgPanel("success","<b>PROYECTO APROBADO</b><br> debe de ejecutar el proyecto conforme el cronograma de presentación. <br> <br> <small>Tiempo Estimado : 60 Días de Ejecución</small><br><br> $acta");
				break;

			default:
				$this->msgPanel("info","Si ya concluyó esta etapa continue en la sección de borrador, caso contrario reportarlo como error.");
				break;
		}
	}

    // 1. proyectos
    public function viewCorrecs()
    {
        // mejor a usar Id Session en todos los sistemas los Id son peligrosos atacantes con bots.

		$this->sess->IsLoggedAccess();
		$sess = $this->sess->GetData();

		$rowTram = $this->dbPilar->inTramTesista( $sess->IdUser );

        $tblJur1 = $this->dbPilar->getSnapView('tblCorrecciones',"Iteracion < 10 AND IdTramite=$rowTram->Id AND Posicion=1") -> num_rows();
        $tblJur2 = $this->dbPilar->getSnapView('tblCorrecciones',"Iteracion < 10 AND IdTramite=$rowTram->Id AND Posicion=2") -> num_rows();
        $tblJur3 = $this->dbPilar->getSnapView('tblCorrecciones',"Iteracion < 10 AND IdTramite=$rowTram->Id AND Posicion=3") -> num_rows();

        // Modo 1. Correcciones completas
        if( $tblJur1 && $tblJur2 && $tblJur3 ){

            $this->load->view( "tesistas/py/005formSubCorr", array('sess'=>$sess) );
            return;
        }

        // Modo 2. Tiempo de Revisión

		$diasRes=mlDiasTranscHoy($rowTram->DateModif)-7;

        if( $diasRes>17){
        	$this->msgPanel("danger","<b class='text-danger'>Leer antes de Continuar:</b> Uno o más de sus jurados <span class='text-danger'>No ha realizado correciones</span>, se deberá contactar con la EPG antes de realizar este procedimiento, si desea continuar es bajo su estricta responsabilidad");
            $this->load->view( "tesistas/py/005formSubCorr", array('sess'=>$sess) );
            return;
        }

        // Modo N° 3 : Vistos Buenos
        $reg= $this->dbPilar->getSnapRow('tesTramitesDet',"IdTram=$rowTram->Id AND Iteracion=4");
        if ($reg->vb1 AND $reg->vb2 AND $reg->vb2 AND $reg->vb3) {
        	$this->load->view( "tesistas/py/005formSubCorr", array('sess'=>$sess) );
            return;
        }
        // calcular dias transcurridos tambien
        // echo "Fecha: " . $rowTram->DateModif;

        $this->msgPanel("danger","<b>Lo sentimos :</b> Las correcciones aún no han sido completadas en su totalidad, el jurado deberá realizar las correcciónes al trámite.");
    }

    // 2. borradores
    public function viewCorrBorr()
    {
        // mejor a usar Id Session en todos los sistemas los Id son peligrosos atacantes con bots.

		$this->sess->IsLoggedAccess();
		$sess = $this->sess->GetData();

		$rowTram = $this->dbPilar->inTramTesista( $sess->IdUser );

        $tblJur1 = $this->dbPilar->getSnapView('tblCorrecciones',"Iteracion>20 AND IdTramite=$rowTram->Id AND Posicion=1") -> num_rows();
        $tblJur2 = $this->dbPilar->getSnapView('tblCorrecciones',"Iteracion>20 AND IdTramite=$rowTram->Id AND Posicion=2") -> num_rows();
        $tblJur3 = $this->dbPilar->getSnapView('tblCorrecciones',"Iteracion>20 AND IdTramite=$rowTram->Id AND Posicion=3") -> num_rows();
        $tblJur4 = $this->dbPilar->getSnapView('tblCorrecciones',"Iteracion>20 AND IdTramite=$rowTram->Id AND Posicion=4") -> num_rows();

        // Modo 1. Correcciones completas
        if( $tblJur1 && $tblJur2 && $tblJur3 && $tblJur4){

            $this->load->view( "tesistas/borr/023formSubCorr", array('sess'=>$sess) );
            return;
        }

          // Modo 2. Tiempo de Revisión

		$diasRes=mlDiasTranscHoy($rowTram->DateModif)-7;

        if( $diasRes>10){
        	$this->msgPanel("danger","<b class='text-danger'>Leer antes de Continuar:</b> Uno o más de sus jurados <span class='text-danger'>No ha realizado correciones</span>, se deberá contactar con la EPG antes de realizar este procedimiento, si desea continuar es bajo su estricta responsabilidad");
            $this->load->view( "tesistas/borr/023formSubCorr", array('sess'=>$sess) );
            return;
        }
        // Modo N° 3 : Vistos Buenos
        $reg= $this->dbPilar->getSnapRow('tesTramitesDet',"IdTram=$rowTram->Id AND Iteracion=22");
        if ($reg->vb1 AND $reg->vb2 AND $reg->vb2 AND $reg->vb3) {
        	$this->load->view( "tesistas/borr/023formSubCorr", array('sess'=>$sess) );
            return;
        }

        // calcular dias transcurridos tambien
        // echo "Fecha: " . $rowTram->DateModif;

        $this->msgPanel("danger","<b>Lo sentimos :</b> Las correcciones aún no han sido completadas en su totalidad, el jurado deberá realizar las correcciónes al trámite.");
    }


	public function choseWay($kind)
    {
		$this->sess->IsLoggedAccess();
		$sess = $this->sess->GetData();

		if ($kind==1) {
			$this->load->view('tesistas/py/001formNuevoProy',array('sess'=>$sess)); 
			return;
		}elseif ($kind==2) {
			$rowTram=$this->dbPilar->inTramTesista($sess->IdUser);
			if ($rowTram->Estado == 6) {
				$dias=mlDiasTranscHoy($rowTram->DateModif);
				// echo "Carga borrador ... [This option has been temporarily disabled. $dias] ";
				if ($dias>=90) {
					$tramJur=$this->dbPilar->getSnapView('tesJurados', "IdTram=$rowTram->Id AND Estado<>0 ORDER BY Posicion ASC");
					$this->load->view('tesistas/borr/011formNuevoBorr',array('sess'=>$sess,'rowTram'=>$rowTram , 'tramJur'=>$tramJur)); 
				}else{
					echo "Ha transcurrido $dias de 90  [This option has been temporarily disabled.] ";
				}

			}else{
				$this->load->view('tesistas/borr/001formNuevoBorr',array('sess'=>$sess)); 
			}
			return;
		}else{
			$this->msgPanel('danger',"<b>Datos Incorrectos : [Intente Nuevamente]</b>");
			return;
		}
	}

	public function loadSublineas($Id)
    {
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

    // correcciones
    public function regProyCorrec()
    {
		$this->sess->IsLoggedAccess();
		$sess = $this->sess->GetData();

		$rwTesista = $this->dbPilar->inTramTesista($sess->IdUser);
		$tesista = $this->dbPilar->inTesista($sess->IdUser);
        // sequencia de verificacion no BOT, por pre sesiones implementar urgente

        // print_r( $rwTesista );

		// if ($rwTesista) {
		//	$this->msgPanel('danger',"El usuario ya tiene un trámite pendiente.");
			/// return;
		//}


		//$iptTitulo = $this->input->post("iptTitulo");
        $iptTitulo   = mlSecurePost( "iptTitulo" );   // eliminar " y demas cars indeseados

		$iptLinea    = $this->input->post("iptLinea");
		$iptSubLinea = $this->input->post("iptSubLinea");
		$j4 = $this->input->post("j4");
		$iptTipoTesis = $this->input->post("iptTipoTesis");
		$iptVariables = $this->input->post("iptVariables");
		$iptTamMuestra = $this->input->post("iptTamMuestra");
		$iptTecnicaDatos = $this->input->post("iptTecnicaDatos");
		$iptMetodHip = $this->input->post("iptMetodHip");
		$iptPresupuesto = $this->input->post("iptPresupuesto");
		$iptTiempo = $this->input->post("iptTiempo");
		$iptResumen = $this->input->post("iptResumen");
		$iptKeywords = $this->input->post("iptKeywords");
		$iptObjetivos = $this->input->post("iptObjetivos");
		$iptFile = $this->input->post("iptFile");

		$archi = $this->subirArchevo( 5 ); // it5
        $IdTram = $rwTesista->Id;

		if ($archi) {
 		    // actualizar el trámite
            $this->dbPilar->Update('tesTramites',array(
				'Estado' 	=> 5,
				'DateModif' => mlCurrentDate(),
				'Obs' 		=> "Correccion:$tesista->Tipo"
			), $IdTram );

				// Insertar el Detalle del Trámite
			$this->dbPilar->Insert('tesTramitesDet',array(
				'IdTram' 	=> $IdTram,
				'Iteracion' => 5,
				'Titulo'	=> mb_strtoupper($iptTitulo),
				'Archivo'	=> $archi,
				'vb1'		=> 0,
				'vb2'		=> 0,
				'vb3'		=> 0,
				'vb4'		=> 0,
				'DateReg'	=> mlCurrentDate(), //aqui solo uno deberia ir
				'Obs'		=> "Correccion"
				//'DateModif'	=> mlCurrentDate(),
			));

				// Insertar Metadatos
			$this->dbPilar->Insert('tesTramitesDoc',array(
				'IdTram'			=> $IdTram,
				'Iteracion' 		=> 5,
				'Titulo'			=> mb_strtoupper($iptTitulo),
				'IdTipoEst'			=> $iptTipoTesis,
				'Variables'			=> $iptVariables,
				'TamMuestra'		=> $iptTamMuestra,
				'IdTipoInstrumento'	=> $iptTecnicaDatos,
				'MetodHip'			=> $iptMetodHip,
				'Presupuesto'		=> $iptPresupuesto,
				'Tiempo'			=> $iptTiempo,
				'Resumen'			=> $iptResumen,
				'Keyword'			=> $iptKeywords,
				'Objetivos'			=> $iptObjetivos,
				'Conclusiones'		=> "",
				'Archivo'			=> $archi,
			));


			$msg = "<b>Subida de correcciones</b><br>El proyecto: <br><i>$iptTitulo</i> <br>El archivo con correcciones ha sido registrado e inicia el proceso de dictaminación.";
                 //. "<br>Notificación enviada a: <b>$sess->Correo</b>";
            //por la unidad de posgrado, posterior a este proceso será enviado al director de tesis $docente->Nombres, $docente->Apellidos, quien será notificado a $docente->Correo, para su conformidad respectiva";


			$this->dbLog->exeTramites($sess->IdUser, "Tesista", $IdTram,"Subida de correcciones", $msg);
			$this->dbLog->exeTesistas($sess->IdUser, $IdTram, $tesista->IdPrograma,$tesista->IdFacultad, "Subida de correcciones", "IdProy:$IdTram IdJur4=$j4");

			/// $docente=$this->dbRepo->getSnapRow('tblDocentes',"Id=$j4");
			$this->msgPanel('success',$msg);
			$this->sendMail($sess->Correo, "Subida de Correcciones", $msg);
		}
    }

	public function regProyecto()
    {
		$this->sess->IsLoggedAccess();
		$sess = $this->sess->GetData();

		$rwTesista=$this->dbPilar->inTramTesista($sess->IdUser);

		if ($rwTesista) {
			$this->msgPanel('danger',"El usuario ya tiene un trámite pendiente.");
			return;
		}

		$tesista=$this->dbPilar->inTesista($sess->IdUser);
		$anio=$this->dbRepo->getOneField('confAnio',"Anio","Estado=1");
		$orden = $this->dbPilar->getOneField( "tesTramites", "Orden", "Anio=$anio ORDER BY Orden DESC" );
		$orden=($orden?$orden+1:1);
		$codigo = sprintf("%04d-%04d", $anio, $orden);


		//$iptTitulo = $this->input->post("iptTitulo");
        $iptTitulo   = mlSecurePost( "iptTitulo" );   // eliminar " y demas cars indeseados
		$iptLinea    = $this->input->post("iptLinea");
		$iptSubLinea = $this->input->post("iptSubLinea");
		$j4 = $this->input->post("j4");
		$iptTipoTesis = $this->input->post("iptTipoTesis");
		$iptVariables = $this->input->post("iptVariables");
		$iptTamMuestra = $this->input->post("iptTamMuestra");
		$iptTecnicaDatos = $this->input->post("iptTecnicaDatos");
		$iptMetodHip = $this->input->post("iptMetodHip");
		$iptPresupuesto = $this->input->post("iptPresupuesto");
		$iptTiempo = $this->input->post("iptTiempo");
		$iptResumen = $this->input->post("iptResumen");
		$iptKeywords = $this->input->post("iptKeywords");
		$iptObjetivos = $this->input->post("iptObjetivos");
		$iptFile = $this->input->post("iptFile");
		$archi = $this->subirArchevo( 1 );

		if ($archi) {
 		   // Creamos el trámite
			$IdTram = $this->dbPilar->Insert('tesTramites',array(
				'Tipo' 		=> 1,
				'Estado' 	=> 1,
				'SubEst' 	=> 1,
				'Codigo' 	=> $codigo,
				'Anio' 		=> $anio,
				'Orden' 	=> $orden,
				'IdFacultad' => $tesista->IdFacultad,
				'IdPrograma' => $tesista->IdPrograma,
				'IdSubPrograma' => $tesista->IdSubProg,
				'IdTesista' 	=> $sess->IdUser,
				'IdLinea' 		=> $iptLinea,
				'IdSubLinea' 	=> $iptSubLinea,
				'DateRegProy' 	=> mlCurrentDate(),
				'DateModif' 	=> mlCurrentDate(),
				'Obs' 			=> "Proyecto:$tesista->Tipo",
				'Opt' 			=> $tesista->Tipo,
			));

				// Insertar el Detalle del Trámite
			$this->dbPilar->Insert('tesTramitesDet',array(
				'IdTram' 	=> $IdTram,
				'Iteracion' => 1,
				'Titulo'	=> mb_strtoupper($iptTitulo),
				'Archivo'	=> $archi,
				'vb1'		=> 0,
				'vb2'		=> 0,
				'vb3'		=> 0,
				'vb4'		=> 0,
				'DateReg'	=> mlCurrentDate(),
				'DateModif'	=> mlCurrentDate(),
				'Obs'		=> "",
			));

				// Insertar Metadatos
			$this->dbPilar->Insert('tesTramitesDoc',array(
				'IdTram'			=> $IdTram,
				'Iteracion' 		=> 1,
				'Titulo'			=> mb_strtoupper($iptTitulo),
				'IdTipoEst'			=> $iptTipoTesis,
				'Variables'			=> $iptVariables,
				'TamMuestra'		=> $iptTamMuestra,
				'IdTipoInstrumento'	=> $iptTecnicaDatos,
				'MetodHip'			=> $iptMetodHip,
				'Presupuesto'		=> $iptPresupuesto,
				'Tiempo'			=> $iptTiempo,
				'Resumen'			=> $iptResumen,
				'Keyword'			=> $iptKeywords,
				'Objetivos'			=> $iptObjetivos,
				'Conclusiones'		=> "",
				'Archivo'			=> $archi,
			));

				// Jurado Seleccionado
			$this->dbPilar->Insert('tesJurados',array(
				'IdTram' 	 => $IdTram,
				'IdPrograma' => $tesista->IdPrograma,
				'IdJurado' 	 => $j4,
				'Estado' 	 => 1,
				'Posicion' 	 => 4,
				'DateReg' 	 => mlCurrentDate(),
				'DateModif'  => mlCurrentDate(),
				'Obs' 		 => "",
			));

			$msg = "<b>REGISTRO DE PROYECTO EXITOSO!</b><br>El proyecto $codigo: <i>$iptTitulo</i>, ha sido registrado en la plataforma este proyecto será verificado por la unidad de posgrado, posterior a este proceso será enviado al director de tesis $docente->Nombres, $docente->Apellidos, quien será notificado a $docente->Correo, para su conformidad respectiva";



			$this->dbLog->exeTramites($sess->IdUser, "Tesista", $IdTram,"Registro Proyecto", $msg);

			$this->dbLog->exeTesistas($sess->IdUser, $IdTram, $tesista->IdPrograma,$tesista->IdFacultad, "Registro Proyecto", "IdProy:$IdTram IdJur4=$j4");

			//  Log de Registro Inicial
			$this->dbLog->Insert("logJuCambios", array(
		        'Referens'   => "RegistroP",
		        'IdTramite'  => $IdTram,
		        'IdPrograma' => $tesista->IdPrograma,
		        'Tipo'       => 1,
		        'IdEstado'   => 1,
		        'IdJurado1'  => 0,
		        'IdJurado2'  => 0,
		        'IdJurado3'  => 0,
		        'IdJurado4'  => $j4,
		        'Motivo'     => "Registro Proyecto",
		        'DateReg'    => mlCurrentDate()
		    ) );


			$docente=$this->dbRepo->getSnapRow('tblDocentes',"Id=$j4");

			$this->msgPanel('success',$msg);

			$this->sendMail($sess->Correo,"REGISTRO PROYECTO : $codigo",$msg);
		}
	}

	public function viewBorrador(){
		// Agregar la función de comprobación de estado :: PENDIENTE A
		$this->sess->IsLoggedAccess();
		$sess = $this->sess->GetData();

		$rowTram=$this->dbPilar->inTramTesista($sess->IdUser);

		if (!$rowTram) {
			$this->load->view('tesistas/borr/000formBorrador');
			return;
		}

		if($rowTram->Estado ==6 && $rowTram->Tipo ==1){
			$this->load->view('tesistas/borr/000formBorrador');
			return;
		}



		switch ($rowTram->Estado) {

			case 20:
				$this->msgPanel("success","<b class='text-dark'>BORRADOR EN VERIFICACIÓN</b><br>El borrador está REGISTRADO y a la espera de verificación por la Unidad de Investigación, luego debe de comunicarse con su director de tesis para su aprobación y posterior sorteo de jurados.  <br> <br> Póngase en contacto con la Unidad de Investigación respectiva.<br><br><small>Tiempo Estimado : 48Hrs</small>");
				break;
			case 21:
				$this->msgPanel("success","<b>BORRADOR ENVIADO AL DIRECTOR </b><br>El borrador está con el director de tesis deberá comunicarse con sus director para obtener el visto bueno y realizar las correcciones. <br> <br> <small>Tiempo Estimado : 2 Días</small>");
				break;
			case 22:
				$tblCorr1=$this->dbPilar->getSnapView('tblCorrecciones',"Iteracion=22 AND IdTramite=$rowTram->Id AND Posicion=1 ORDER BY Fecha ASC");
				$tblCorr2=$this->dbPilar->getSnapView('tblCorrecciones',"Iteracion=22 AND IdTramite=$rowTram->Id AND Posicion=2 ORDER BY Fecha ASC");
				$tblCorr3=$this->dbPilar->getSnapView('tblCorrecciones',"Iteracion=22 AND IdTramite=$rowTram->Id AND Posicion=3 ORDER BY Fecha ASC");
				$tblCorr4=$this->dbPilar->getSnapView('tblCorrecciones',"Iteracion=22 AND IdTramite=$rowTram->Id AND Posicion=4 ORDER BY Fecha ASC");
				$this->load->view('tesistas/borr/022Correcciones', array(
						'tblCorr1'=>$tblCorr1,
						'tblCorr2'=>$tblCorr2,
						'tblCorr3'=>$tblCorr3,
						'tblCorr4'=>$tblCorr4,
				));
				//$this->msgPanel("success","<b>BORRADOR ENVIADO A REVISIÓN POR LOS JURADOS</b><br>El borrador se encuentra en etapa de REVISIÓN comunicarse con sus jurados para obtener y realizar las correcciones. <br> <br> <small>Tiempo Estimado : 10 Días</small>");
				break;

			case 23:
				$this->msgPanel("success","<b>BORRADOR EN DICTAMEN</b><br> debe de comunicarse con los jurados de tesis para el DICTAMEN CORRESPONDIENTE. <br> <br> <small>Tiempo Estimado : 5 Días</small>");
				break;

			case 24:
                $acta = "<hr><a target=_blank href='actaBorr/$rowTram->Id' class='btn btn-primary btn-sm'> acta de borrador de tesis </a>";
				$this->msgPanel("success","<b>BORRADOR A SUSTENTAR</b><br> $acta ");
				break;

			default:
				$this->msgPanel("light","<b>Reportar a la EPG : Si usted considera que debería estar en este apartado. El procedimiento esta siendo evaluado contactarse con la EPG.</small>");
				break;
		}
	}


	public function regBorrador(){
		$this->sess->IsLoggedAccess();
		$sess = $this->sess->GetData();

		$rwTesista=$this->dbPilar->inTramTesista($sess->IdUser);

		if ($rwTesista) {
			$this->msgPanel('danger',"El usuario ya tiene un trámite pendiente.");
			return;
		}

		$tesista=$this->dbPilar->inTesista($sess->IdUser);
		$anio=$this->dbRepo->getOneField('confAnio',"Anio","Estado=1");
		$orden = $this->dbPilar->getOneField( "tesTramites", "Orden", "Anio=$anio ORDER BY Orden DESC" );
		$orden=($orden?$orden+1:1);
		$codigo = sprintf("%04d-%04d", $anio, $orden);


		//$iptTitulo = $this->input->post("iptTitulo");
        $iptTitulo = mlSecurePost( "iptTitulo" );   // eliminar " y demas cars indeseados
		$iptLinea = $this->input->post("iptLinea");
		$iptSubLinea = $this->input->post("iptSubLinea");
		$j1 = $this->input->post("j1");
		$j2 = $this->input->post("j2");
		$j3 = $this->input->post("j3");
		$j4 = $this->input->post("j4");
		$iptTipoTesis = $this->input->post("iptTipoTesis");
		$iptVariables = $this->input->post("iptVariables");
		$iptTamMuestra = $this->input->post("iptTamMuestra");
		$iptTecnicaDatos = $this->input->post("iptTecnicaDatos");
		$iptMetodHip = $this->input->post("iptMetodHip");
		$iptPresupuesto = $this->input->post("iptPresupuesto");
		$iptTiempo = $this->input->post("iptTiempo");
		$iptResumen = $this->input->post("iptResumen");
		$iptKeywords = $this->input->post("iptKeywords");
		$iptObjetivos = $this->input->post("iptObjetivos");
		$iptConclusion = $this->input->post("iptConclusion");

		$iptFile = $this->input->post("iptFile");
		$archi = $this->subirArchevo( 21 );

		if ($archi) {

				// Creamos el trámite
			$IdTram = $this->dbPilar->Insert('tesTramites',array(
				'Tipo' 		=> 2,
				'Estado' 	=> 20,
				'SubEst' 	=> 1,
				'Codigo' 	=> $codigo,
				'Anio' 		=> $anio,
				'Orden' 	=> $orden,
				'IdFacultad' => $tesista->IdFacultad,
				'IdPrograma' => $tesista->IdPrograma,
				'IdSubPrograma' => $tesista->IdSubProg,
				'IdTesista' 	=> $sess->IdUser,
				'IdLinea' 		=> $iptLinea,
				'IdSubLinea' 	=> $iptSubLinea,
				'DateRegBorr' 	=> mlCurrentDate(),
				'DateModif' 	=> mlCurrentDate(),
				'Obs' 			=> "Borrador:$tesista->Tipo",
				'Opt' 			=> $tesista->Tipo,
			));

				// Insertar el Detalle del Trámite
			$this->dbPilar->Insert('tesTramitesDet',array(
				'IdTram' 	=> $IdTram,
				'Iteracion' => 20,
				'Titulo'	=> mb_strtoupper($iptTitulo),
				'Archivo'	=> $archi,
				'vb1'		=> 0,
				'vb2'		=> 0,
				'vb3'		=> 0,
				'vb4'		=> 0,
				'DateReg'	=> mlCurrentDate(),
				'DateModif'	=> mlCurrentDate(),
				'Obs'		=> "",
			));

				// Insertar Metadatos
			$this->dbPilar->Insert('tesTramitesDoc',array(
				'IdTram'			=> $IdTram,
				'Iteracion' 		=> 20,
				'Titulo'			=> mb_strtoupper($iptTitulo),
				'IdTipoEst'			=> $iptTipoTesis,
				'Variables'			=> $iptVariables,
				'TamMuestra'		=> $iptTamMuestra,
				'IdTipoInstrumento'	=> $iptTecnicaDatos,
				'MetodHip'			=> $iptMetodHip,
				'Presupuesto'		=> $iptPresupuesto,
				'Tiempo'			=> $iptTiempo,
				'Resumen'			=> $iptResumen,
				'Keyword'			=> $iptKeywords,
				'Objetivos'			=> $iptObjetivos,
				'Conclusiones'		=> $iptConclusion,
				'Archivo'			=> $archi,
			));

				// Jurado Seleccionado 
			for ($i=1; $i <=4 ; $i++) { 
				$this->dbPilar->Insert('tesJurados',array(
					'IdTram' 	=> $IdTram,
					'IdJurado' 	=> ${'j'.$i},
					'IdPrograma' => $tesista->IdPrograma,
					'Estado' 	=> 20,
					'Posicion' 	=> $i,
					'DateReg' 	=> mlCurrentDate(),
					'DateModif' => mlCurrentDate(),
					'Obs' 		=> "",
				));
			}
			//  Log de Registro Inicial
			$this->dbLog->Insert("logJuCambios", array(
		        'Referens'  => "RegistroB",        // Mejorar tipo doc
		        'IdTramite' => $IdTram,    // guia de Tramite
		        'Tipo'      => 2,
		        'IdEstado'  => 20,  // en el momento
		        'IdPrograma' => $tesista->IdPrograma,  // en el momento
		        'IdJurado1' => $j1,
		        'IdJurado2' => $j2,
		        'IdJurado3' => $j3,
		        'IdJurado4' => $j4,
		        'Motivo'    => "Registro Borrador",
		        'DateReg'     => mlCurrentDate()
		    ) );

			$docente=$this->dbRepo->getSnapRow('tblDocentes',"Id=$j4");
			$msg = "<b>REGISTRO DE BORRADOR EXITOSO!</b><br>El borrador de tesis <i>$iptTitulo</i>, ha sido registrado en la plataforma este borrador será verificado por la unidad de posgrado, posterior a este proceso será enviado al director de tesis $docente->Nombres, $docente->Apellidos, quien será notificado a $docente->Correo, para su conformidad respectiva y remisión a los jurados.";

			$this->dbLog->exeTramites($sess->IdUser, "Tesista", $IdTram,"Registro Borrador", $msg);

			$this->dbLog->exeTesistas($sess->IdUser, $IdTram, $tesista->IdPrograma,$tesista->IdFacultad, "Registro Borrador", "IdProy:$IdTram IdJur1=$j1 IdJur2=$j2 IdJur3=$j3 IdJur4=$j4");

			$this->msgPanel('success',$msg);
			$this->sendMail($sess->Correo,"REGISTRO BORRADOR : $codigo",$msg);
		}
	}

	public function regBorradorN() {
		$this->sess->IsLoggedAccess();
		$sess = $this->sess->GetData();

		$rwTesista=$this->dbPilar->inTramTesista($sess->IdUser);

		if (!$rwTesista) {
			$this->msgPanel('danger',"El procedimiento no corresponde a esta etapa.");
			return;
		}
		if ($rwTesista->Estado != 6 OR $rwTesista->Tipo != 1) {
			$this->msgPanel('danger',"El usuario ya tiene un trámite que no corresponde al proceso.");
			return;
		}

		$tesista=$this->dbPilar->inTesista($sess->IdUser);

		// echo "$rwTesista->Id :::::::: $rwTesista->Codigo";
	
		//$iptTitulo = $this->input->post("iptTitulo");
        $iptTitulo = mlSecurePost( "iptTitulo" );   // eliminar " y demas cars indeseados
		$iptResumen = $this->input->post("iptResumen");
		$iptKeywords = $this->input->post("iptKeywords");
		$iptObjetivos = $this->input->post("iptObjetivos");
		$iptConclusion = $this->input->post("iptConclusion");

		$iptFile = $this->input->post("iptFile");
		$archi = $this->subirArchevo( 21 );

		if ($archi) {
			// Actualizamos El registro
			$this->dbPilar->Update('tesTramites',array(
				'Tipo' 		=> 2,
				'Estado' 	=> 20,
				'SubEst' 	=> 1,
				'DateRegBorr' 	=> mlCurrentDate(),
				'DateModif' 	=> mlCurrentDate(),
				'Obs' 			=> "$rwTesista->Obs | Borrador:$tesista->Tipo",
			), $rwTesista->Id);

			// Insertar el Detalle del Trámite
			$this->dbPilar->Insert('tesTramitesDet',array(
				'IdTram' 	=> $rwTesista->Id,
				'Iteracion' => 20,
				'Titulo'	=> mb_strtoupper($iptTitulo),
				'Archivo'	=> $archi,
				'vb1'		=> 0,
				'vb2'		=> 0,
				'vb3'		=> 0,
				'vb4'		=> 0,
				'DateReg'	=> mlCurrentDate(),
				'DateModif'	=> mlCurrentDate(),
				'Obs'		=> "",
			));

			// Insertar Metadatos
			$metadata=$this->dbPilar->getSnapRow('tesTramitesDoc',"IdTram=$rwTesista->Id ORDER BY Iteracion DESC");
			if (!$metadata) {
				$this->msgPanel('danger',"El proyecto no fué registrado adecuadamente.");
				return;
			}
			$this->dbPilar->Insert('tesTramitesDoc',array(
				'IdTram'			=> $rwTesista->Id,
				'Iteracion' 		=> 20,
				'Titulo'			=> mb_strtoupper($iptTitulo),
				'IdTipoEst'			=> $metadata->IdTipoEst,
				'Variables'			=> $metadata->Variables,
				'TamMuestra'		=> $metadata->TamMuestra,
				'IdTipoInstrumento'	=> $metadata->IdTipoInstrumento,
				'MetodHip'			=> $metadata->MetodHip,
				'Presupuesto'		=> $metadata->Presupuesto,
				'Tiempo'			=> $metadata->Tiempo,
				'Resumen'			=> $iptResumen,
				'Keyword'			=> $iptKeywords,
				'Objetivos'			=> $iptObjetivos,
				'Conclusiones'		=> $iptConclusion,
				'Archivo'			=> $archi,
			));

			$this->dbPilar->UpdateEx('tesJurados',array(
                'Estado'   => 20, 
                'DateModif'   => mlCurrentDate(),
                'Obs'=> "Registro Borrador"
            ), "IdTram=$rwTesista->Id");


			//  Log de Registro Inicial

			$j1=$this->dbPilar->getOneField('tesJurados', "IdJurado", "IdTram='$rwTesista->Id' AND Posicion=1 ORDER BY Id DESC");
			$j2=$this->dbPilar->getOneField('tesJurados', "IdJurado", "IdTram='$rwTesista->Id' AND Posicion=2 ORDER BY Id DESC");
			$j3=$this->dbPilar->getOneField('tesJurados', "IdJurado", "IdTram='$rwTesista->Id' AND Posicion=3 ORDER BY Id DESC");
			$j4=$this->dbPilar->getOneField('tesJurados', "IdJurado", "IdTram='$rwTesista->Id' AND Posicion=4 ORDER BY Id DESC");

			$this->dbLog->Insert("logJuCambios", array(
		        'Referens'  => "RegistroBorrador",        // Mejorar tipo doc
		        'IdTramite' => $rwTesista->Id,    // guia de Tramite
		        'Tipo'      => 2,
		        'IdEstado'  => 20,  // en el momento
		        'IdPrograma' => $tesista->IdPrograma,  // en el momento
		        'IdJurado1' => $j1,
		        'IdJurado2' => $j2,
		        'IdJurado3' => $j3,
		        'IdJurado4' => $j4,
		        'Motivo'    => "Registro Borrador",
		        'DateReg'     => mlCurrentDate()
		    ) );

			$docente=$this->dbRepo->getSnapRow('tblDocentes',"Id=$j4");
			$msg = "<b>REGISTRO DE BORRADOR EXITOSO!</b><br>El borrador de tesis <i>$iptTitulo</i>, ha sido registrado en la plataforma PILAR-EPG este borrador será verificado por la unidad de posgrado, posterior a este proceso será enviado al director de tesis $docente->Nombres, $docente->Apellidos, quien será notificado a $docente->Correo, para su conformidad respectiva y remisión a los jurados.";

			$this->dbLog->exeTramites($sess->IdUser, "Tesista", $rwTesista->Id,"Registro Borrador", $msg);

			$this->dbLog->exeTesistas($sess->IdUser, $rwTesista->Id, $tesista->IdPrograma,$tesista->IdFacultad, "Registro Borrador[N]", "IdProy:$rwTesista->Id IdJur1=$j1 IdJur2=$j2 IdJur3=$j3 IdJur4=$j4");

			$this->msgPanel('success',$msg);
			$this->sendMail($sess->Correo,"REGISTRO BORRADOR : $rwTesista->Codigo",$msg);
		}
	}

	public function regCorrBorr()
    {
		$this->sess->IsLoggedAccess();
		$sess = $this->sess->GetData();

		$rwTesista=$this->dbPilar->inTramTesista($sess->IdUser);

		//if ($rwTesista) {
		//	$this->msgPanel('danger',"El usuario ya tiene un trámite pendiente.");
		//	return;
		//}

		$tesista=$this->dbPilar->inTesista($sess->IdUser);
		//$anio=$this->dbRepo->getOneField('confAnio',"Anio","Estado=1");
		//$orden = $this->dbPilar->getOneField( "tesTramites", "Orden", "Anio=$anio ORDER BY Orden DESC" );
		//$orden=($orden?$orden+1:1);
		//$codigo = sprintf("%04d-%04d", $anio, $orden);


		//$iptTitulo = $this->input->post("iptTitulo");
        $iptTitulo = mlSecurePost( "iptTitulo" );   // eliminar " y demas cars indeseados

		$iptLinea = $this->input->post("iptLinea");
		$iptSubLinea = $this->input->post("iptSubLinea");
		//$j1 = $this->input->post("j1");
		//$j2 = $this->input->post("j2");
		//$j3 = $this->input->post("j3");
		//$j4 = $this->input->post("j4");
		$iptTipoTesis = $this->input->post("iptTipoTesis");
		$iptVariables = $this->input->post("iptVariables");
		$iptTamMuestra = $this->input->post("iptTamMuestra");
		$iptTecnicaDatos = $this->input->post("iptTecnicaDatos");
		$iptMetodHip = $this->input->post("iptMetodHip");
		$iptPresupuesto = $this->input->post("iptPresupuesto");
		$iptTiempo = $this->input->post("iptTiempo");
		$iptResumen = $this->input->post("iptResumen");
		$iptKeywords = $this->input->post("iptKeywords");
		$iptObjetivos = $this->input->post("iptObjetivos");
		$iptConclusion = $this->input->post("iptConclusion");

		$iptFile = $this->input->post("iptFile");
		$archi = $this->subirArchevo( 23 );


		if ($archi) {

				// Creamos el trámite
            $IdTram = $rwTesista->Id;
			$this->dbPilar->Update('tesTramites',array(
				'Estado' 	  => 23,
				'DateModif'   => mlCurrentDate(),
			), $IdTram );

				// Insertar el Detalle del Trámite
			$this->dbPilar->Insert('tesTramitesDet',array(
				'IdTram' 	=> $IdTram,
				'Iteracion' => 23,
				'Titulo'	=> mb_strtoupper($iptTitulo),
				'Archivo'	=> $archi,
				'vb1'		=> 0,
				'vb2'		=> 0,
				'vb3'		=> 0,
				'vb4'		=> 0,
				'DateReg'	=> mlCurrentDate(),
				'Obs'		=> "Correccion Borrador",
			));

			// Insertar Metadatos
			$this->dbPilar->Insert('tesTramitesDoc',array(
				'IdTram'			=> $IdTram,
				'Iteracion' 		=> 23,
				'Titulo'			=> mb_strtoupper($iptTitulo),
				'IdTipoEst'			=> $iptTipoTesis,
				'Variables'			=> $iptVariables,
				'TamMuestra'		=> $iptTamMuestra,
				'IdTipoInstrumento'	=> $iptTecnicaDatos,
				'MetodHip'			=> $iptMetodHip,
				'Presupuesto'		=> $iptPresupuesto,
				'Tiempo'			=> $iptTiempo,
				'Resumen'			=> $iptResumen,
				'Keyword'			=> $iptKeywords,
				'Objetivos'			=> $iptObjetivos,
				'Conclusiones'		=> $iptConclusion,
				'Archivo'			=> $archi,
			));


			//$docente=$this->dbRepo->getSnapRow('tblDocentes',"Id=$j4");
			$msg = "<b>SUBIDA DE ARCHIVO CON CORRECCIONES</b><br>El borrador de tesis <i>$iptTitulo</i>, ";// ha sido registrado en la plataforma este borrador será verificado por la unidad de posgrado, posterior a este proceso será enviado al director de tesis $docente->Nombres, $docente->Apellidos, quien será notificado a $docente->Correo, para su conformidad respectiva y remisión a los jurados.";

			$this->dbLog->exeTramites($sess->IdUser, "Tesista", $IdTram,"Corrección Borrador", $msg);

			// $this->dbLog->exeTesistas($sess->IdUser, $IdTram, $tesista->IdPrograma,$tesista->IdFacultad, "Registro Borrador", "IdProy:$IdTram IdJur1=$j1 IdJur2=$j2 IdJur3=$j3 IdJur4=$j4");

			$this->msgPanel( 'success', $msg );
			$this->sendMail( $sess->Correo, "Subida de Correcciones de Borrador", $msg);
		}
	}



	public function viewSustentac(){
		$this->sess->IsLoggedAccess();
		$sess = $this->sess->GetData();

		$rwTesista=$this->dbPilar->inTramTesista($sess->IdUser);

		if ($rwTesista) {
			$this->msgPanel('danger',"El usuario  tiene un trámite pendiente.");
			return;
		}

		echo "<div class='card mb-4 py-3 border-left-danger'>
		<div class='card-body'>
		Usted no cumple requisitos para acceder a esta sección.
		</div>
		</div>";
	}

	public function msgPanel($color,$content){
		echo "<div class='card mb-4 py-3 border-left-$color'>
		<div class='card-body'>
		$content
		</div>
		</div>";

	}



	public function subirArchevo( $tipo=1 )
	{
		$this->sess->IsLoggedAccess();
		$sess = $this->sess->GetData();
		$config['upload_path']   = './opfile/';


        // generamos el nombre Aleatorio: 5 Caracteres - Aleatorizados + 3 DNI
        //$str = mlRandomStr(12);

        $config['allowed_types'] = 'jpg|png|pdf';  // ext
        $config['max_size']      = '6144';         // KB
        $config['overwrite']     = TRUE;

        $config['file_name']     = sprintf("d%08s-$tipo.pdf", $sess->IdUser );

        // finalmente subir archivo
        $this->load->library('upload', $config);
        if ( !$this->upload->do_upload("iptFile") ) { // input field

        	$data['uploadError'] = $this->upload->display_errors();
        	echo "Error: " . $this->upload->display_errors();
        	return null;

        } else {
        	$file_info = $this->upload->data();
        	echo "Archivo Subido <br>";
        }

        // devolvemos el nombre del archivo
        return  $config['file_name'];
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
				'TipoUser'	=>'Tesista',
				'Correo'	=>$to,
				'Asunto'	=>$asunto,
				'Mensaje'	=>$msg,
		));

		if( $this->email->send() )
			$this->msgPanel('success', "Notificado al correo electrónico : $to");
		else
			$this->msgPanel('danger', "Problemas enviando correo electrónico : $to");
	}

    public function logout()
    {
        if( $sess = $this->sess->GetData() )
    	    $this->dbLog->exeAccesos( $sess->IdUser,1,"Salida","Salida Tesista : $sess->IdUser");

        $this->sess->SessionDestroy();
    	redirect( base_url(),'refresh');
    }


}
