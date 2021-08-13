<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include( "../absmain/mlLibrary.php" );
include( "../absmain/mlotiapi.php" );

class Inicio extends CI_Controller {

	public function __construct(){
		parent::__construct();

		$this->load->library("Sess");
		$this->load->library("Includes");
		$this->load->model('dbPilar');
		$this->load->model('dbRepo');
		$this->load->model('dbLog');
	}
	public function version(){
		$this->load->view('welcome_message');
	}
	public function index(){ 
		$this->load->view('index'); 
	 //echo "<body style='background-color:#9C466A;'><br><br><center><img height='100' src='".base_url('include/img/logoepg.png')."'><h1 style='color:white;'> SITIO EN MANTENIMIENTO <br>PILAR EPG 2020.</h1></center></body>";
	}

	public function login(){
		// echo "<h1 class='text-white'>Mantenimiento, No realizar operaciones.</h1>";
		$this->load->view('login'); 
	}

	public function password(){
		$this->load->view('recpassword'); 
	}
	public function registro(){
		$this->load->view('registro');	
	}

	public function doSearchCod(){
		$cod=$this->input->post("iptCod");

		if (!$cod) {
			echo "Ingrese un Código";
			return;
		}

		$tes=$this->dbPilar->getSnapView("tblTesistas","Cod=$cod");
		if ($tes->num_rows()!=0) {
			echo "Usted ya ha creado una cuenta.";
			return;
		}

		$stud=$this->includes->otiGetData($cod);

		if( $stud == null ) {
			echo "<b> Can't connect to: unap.edu.pe </b>";
			return;
		}

		if( $stud->success == false )
		{
			echo "<b> Datos Inconsistentes </b>";
			return;
		}

        // copiar datos y verificacion de Codigo
		$data = $stud->items[0];
		if( $data->codigo != $cod ){
			echo "<b> Los datos no coinciden </b>";
			return;
		}

		$_SESSION['tmp_COD'] = $cod;
		$_SESSION['tmp_DNI'] = $data->documento_numero;

		$this->load->view("web/formDNI");
	}

	public function doSearchDNI(){
		$dni=$this->input->post('iptDNI');
		$cui=$this->input->post('iptCUI');
		if ($dni) {
			if ($_SESSION['tmp_DNI']==$dni) {
				$_SESSION['tmp_DNI']=$dni;		
				$this->load->view('web/formDatos');
			}else{
				echo "Los datos ingresados no coinciden.";
			}
		}else{
			echo "Ingrese su DNI y CUI de verificación.";
		}
	}

	public function loadSubProgramas($id){
		$sub=$this->dbRepo->getSnapView('dicSubprogramas',"IdPrograma=$id");
		if ($sub->num_rows()==0) {
			echo "<option value='0'>No Corresponde </option>";
		}
		foreach ($sub->result() as $row) {
			echo "<option value='$row->Id'>$row->Nombre</option>";
		}
	}
	public function doRegister(){

		$iptPrograma = $this->input->post('iptPrograma');
		$iptSpg = $this->input->post('iptSpg');
		$iptCel = $this->input->post('iptCel');
		$iptMail = $this->input->post('iptMail');
		$iptPass = $this->input->post('iptPass');
		$iptPass2 = $this->input->post('iptPass2');
		$cod = $_SESSION['tmp_COD'];

		if (!$iptPrograma && !$iptMail && !$iptPass) {
			echo "Error de recepción de Datos. [Data:Error]";
			return;
		}
		$account=$this->dbPilar->getOneField("tblTesistas","Id","Cod=$cod");
		if (!$cod) {
			echo "Intente nuevamente [Data:Error]";
			return;
		}
		if ($account) {
			echo "Usted ya tiene una cuenta.[Data : Ok]";
			return;
		}
		$stud=$this->includes->otiGetData($cod);
		$data = $stud->items[0];
		$facu=$this->dbRepo->getSnapRow('dicProgramas',"Id=$iptPrograma");
		$this->dbPilar->Insert("tblTesistas", array(
			'Cod' 		=>$data->codigo , 
			'DNI' 		=>$data->documento_numero , 
			'Tipo'		=> $facu->Tipo,
			'Estado'	=> 1,
			'IdFacultad'=> $facu->IdFacultad,
			'IdPrograma'=> $iptPrograma,
			'IdSubProg'	=> $iptSpg,
			'Sexo'		=> 0,
			'Nombres'	=> $data->nombres,
			'Apellidos' => $data->apellidos,
			'Correo'	=> $iptMail,
			'Celular'	=> $iptCel,
			'Password'	=> $this->includes->DoPass($iptPass),
			'DateReg'	=> mlCurrentDate(),
			'DateModif' => mlCurrentDate(),
			'Obs'		=> $data->escuela
		));
		session_destroy();
		echo "Registrado! Ahora puede <a href='".base_url("/login/")."'>INICIAR SESIÓN</a> ";
	}

	public function doLogin(){
		$mail=$this->input->post('mail');
		$pass=$this->input->post('pass');
		$kind=$this->input->post('iptKind');
		$pass=$this->includes->DoPass($pass);

		if ($kind==1) {
			$quest=$this->dbPilar->mdLogin($mail,$pass);
			if($quest===true){
				$query=$this->dbPilar->getSnapRow('tblTesistas',"Correo='$mail'");

				$this->sess->SetUserTesista($query->Id,
					$query->DNI,
					$query->Cod,
					"$query->Nombres, $query->Apellidos",
					$query->Tipo,
					$query->Correo,
					$query->IdPrograma,
					$query->IdSubProg );
				$this->dbLog->exeAccesos($query->Id,$kind,"Ingreso",$mail);
				redirect(base_url("tesistas/"),'refresh');
			}else{
				$query=$this->dbPilar->getSnapRow('tblTesistas',"Correo='$mail'");
				$iDb=($query?$query->Id:0);
				$this->dbLog->exeAccesos($iDb,$kind,"Error",$mail);
				redirect(base_url("login"),'refresh');
			}
		}elseif($kind==2){

			$quest=$this->dbRepo->mdLoginD($mail,$pass);
			if($quest===true){
				$query=$this->dbRepo->getSnapRow('tblDocentes',"Correo='$mail'");

				$this->sess->SetUserDocente($query->Id,
					$query->DNI,
					$query->Codigo,
					"$query->Nombres, $query->Apellidos",
					$query->Correo,
					$query->Tipo
				     );

				$this->dbLog->exeAccesos($query->Id,$kind,"Ingreso",$mail);
				redirect(base_url("docentes/"),'refresh');
			}else{
				$query=$this->dbRepo->getSnapRow('tblDocentes',"Correo='$mail'");
				$iDb=($query?$query->Id:0);
				$this->dbLog->exeAccesos($iDb,$kind,"Error",$mail);
				redirect(base_url("login"),'refresh');
			}

		}elseif($kind==3){

			$quest=$this->dbRepo->mdLoginU($mail,$pass);
			if($quest===true){
				$query=$this->dbRepo->getSnapRow('tblUsuarios',"Estado=1 AND Correo='$mail'");
				$this->sess->SetUserUnidad($query->Id,
					$query->DNI,
					$query->Codigo,
					"$query->Nombres, $query->Apellidos",
					$query->Tipo,
					$query->Correo,
					$query->IdFacultad,
					$query->IdPrograma,
					$query->Nivel);

				$this->dbLog->exeAccesos($query->Id,$kind,"Ingreso",$mail);
				redirect(base_url("unidades/"),'refresh');
			}else{
				$query=$this->dbRepo->getSnapRow('tblUsuarios',"Correo='$mail'");
				$iDb=($query?$query->Id:0);
				$this->dbLog->exeAccesos($iDb,$kind,"Error",$mail);
				redirect(base_url("login"),'refresh');
			}

		}else{
			echo "<h1>Datos Incorrectos[Data:Error]</h1>";
		}

	}

}