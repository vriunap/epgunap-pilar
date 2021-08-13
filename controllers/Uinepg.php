<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include( "../absmain/mlLibrary.php" );
include( "../absmain/mlotiapi.php" );

// Rewriting some partf of code:
// UCases in DB & Update tesTramitesDet set Titulo = REPLACE(Titulo,'“  ”','') WHERE IdTram=145

class Uinepg extends CI_Controller {
 
    public function __construct(){
        parent::__construct();

        $this->load->library("Sess");
        $this->load->library("Includes");
        $this->load->model('dbPilar');
        $this->load->model('dbRepo');
        $this->load->model('dbLog');
    }

    public function index(){
        $sess = $this->sess->GetData();
        if (!$sess) {
            $this->load->view("admin/login");
            return; 
        }     
        if( $sess->SessTip != "F6969x1407AD" ) {
            $this->logout();
            redirect( base_url("uinepg/"), 'refresh');
            return;
        }
        // $this->sess->IsLoggedAccess();
        $this->load->view('admin/panel',array('sess'=>$sess));
    }

    public function doLogin(){
        $mail=$this->input->post('mail');
        $pass=$this->input->post('pass');
        $pass=$this->includes->DoPass($pass);
        $quest=$this->dbRepo->mdLoginAd($mail,$pass);
        if($quest===true){
            $query=$this->dbRepo->getSnapRow('tblUsuariosAdm',"Correo='$mail'");
            $this->sess->SetUserAdmin($query->Id,
                $query->DNI,
                "$query->Nombres, $query->Apellidos",
                $query->Tipo,
                $query->Nivel );
            $this->dbLog->exeAccesos($query->Id,'69',"Ingreso",$mail);
            redirect( base_url("uinepg/"), 'refresh');
        }else{
            $query=$this->dbRepo->getSnapRow('tblUsuarios',"Correo='$mail'");
            $iDb=($query?$query->Id:0);
            $this->dbLog->exeAccesos($iDb,'69',"Error",$mail);
            redirect(base_url("uinepg/"),'refresh');
        }
    } 
    
    public function viewUnidades(){
        $this->sess->IsLoggedAccess();
        $sess = $this->sess->GetData();
        $this->load->view('admin/unid/unidades',array('sess'=>$sess)); 
    }
    public function viewDocentes(){
        $this->sess->IsLoggedAccess();
        $sess = $this->sess->GetData();
        $this->load->view('admin/doc/docBusq',array('sess'=>$sess)); 
    }
    public function viewTesistas(){
        $this->sess->IsLoggedAccess();
        $sess = $this->sess->GetData();
        $this->load->view('admin/tes/tesistas',array('sess'=>$sess)); 
    }
    public function viewLineas(){
        $this->sess->IsLoggedAccess();
        $sess = $this->sess->GetData();
        $this->load->view('admin/lin/lineas',array('sess'=>$sess)); 
    }

    public function vwTesista($Id){
        $this->sess->IsLoggedAccess();
        $sess = $this->sess->GetData();
        $rowTes=$this->dbPilar->getSnapRow('tblTesistas',"Id=$Id");
        $rowTram=$this->dbPilar->getSnapRow('tesTramites',"IdTesista=$Id");
        $this->load->view('admin/tes/infoTesista',array('rowTes'=>$rowTes,'rowTram'=>$rowTram));
    }

    //Operaciones tesistas apartir del Misma View Num 20XX
    public function infoTesistas($op,$id)
    {
        $this->sess->IsLoggedAccess();
        $sess = $this->sess->GetData();

        switch ($op) {
            //  Cambio de Jurados
            case 2028:

                $tramRow=$this->dbPilar->getSnapRow('tesTramites',"Tipo<>0 AND IdTesista=$id");
                if ($tramRow AND $tramRow->Estado>=4) {
                    $this->load->view('admin/tes/2028',array('row'=>$tramRow));
                }else{
                    $this->msgPanel('warning',"El usuario seleccionado no tiene un trámite para realizar esta operación.");
                }
                break;

            //  Visualizar y Editar Datos Tesista
            case 2029:
                $rowTes=$this->dbPilar->getSnapRow('tblTesistas',"Id=$id");
                $this->load->view('admin/tes/2029',array('row'=>$rowTes));
                break;
                // Visualizar Historial de Usuario
            case 2030:
                $usr=$this->dbLog->getSnapView('logTesistas',"IdUsuario=$id");
                $ac=$this->dbLog->getSnapView('logAccesos',"IdUsuario=$id AND Tipo=1");
                $this->load->view('admin/tes/2030',array('ac'=>$ac,'usr'=>$usr));
                break;

                // Visualizar Tramite de Proyecto
            case 2031:
                $tramRow=$this->dbPilar->getSnapRow('tesTramites',"Tipo=1 AND IdTesista=$id");
                if ($tramRow) {

                    $arrCont = [
                        0,
                        $this->dbPilar->getSnapView('tblCorrecciones',"Iteracion = 1 AND IdTramite=$tramRow->Id AND Posicion=1") ->num_rows(),
	    			    $this->dbPilar->getSnapView('tblCorrecciones',"Iteracion = 1 AND IdTramite=$tramRow->Id AND Posicion=2") ->num_rows(),
    				    $this->dbPilar->getSnapView('tblCorrecciones',"Iteracion = 1 AND IdTramite=$tramRow->Id AND Posicion=3") ->num_rows(),
                        $this->dbPilar->getSnapView('tblCorrecciones',"Iteracion = 1 AND IdTramite=$tramRow->Id AND Posicion=4") ->num_rows()
                    ];

                    $tramDet=$this->dbPilar->getSnapRow ('tesTramitesDet',"IdTram=$tramRow->Id ORDER BY Iteracion DESC");
                    $rowsDet=$this->dbPilar->getSnapView ('tesTramitesDet',"IdTram=$tramRow->Id ORDER BY Iteracion DESC");
                    $tramLog=$this->dbLog->getSnapView  ('logTramites', "IdTramite=$tramRow->Id");
                    $tramJur=$this->dbPilar->getSnapView('tesJurados', "IdTram=$tramRow->Id AND Estado<>0 ORDER BY Posicion ASC");

                    $this->load->view('admin/tes/2031',array('tramRow'=>$tramRow,'rowsDet'=>$rowsDet,'tramDet'=>$tramDet,'tramLog'=>$tramLog, 'tramJur'=>$tramJur, 'contCorr'=>$arrCont) );

                } else {
                    $this->msgPanel('warning',"El usuario seleccionado no ha registrado <b>proyecto</b> en PILAR EPG");
                }
                break;

                // Visualizar Trámite de Borrador
            case 2032:
                $tramRow=$this->dbPilar->getSnapRow('tesTramites',"Tipo=2 AND IdTesista=$id");
                if ($tramRow) {

                    $arrCont = [
                        0,
                        $this->dbPilar->getSnapView('tblCorrecciones',"Iteracion=22 AND IdTramite=$tramRow->Id AND Posicion=1") ->num_rows(),
	    			    $this->dbPilar->getSnapView('tblCorrecciones',"Iteracion=22 AND IdTramite=$tramRow->Id AND Posicion=2") ->num_rows(),
    				    $this->dbPilar->getSnapView('tblCorrecciones',"Iteracion=22 AND IdTramite=$tramRow->Id AND Posicion=3") ->num_rows(),
                        $this->dbPilar->getSnapView('tblCorrecciones',"Iteracion=22 AND IdTramite=$tramRow->Id AND Posicion=4") ->num_rows()
                    ];

                    $tramDet = $this->dbPilar->getSnapRow('tesTramitesDet',"IdTram=$tramRow->Id ORDER BY Iteracion DESC");
                    $rowsDet=$this->dbPilar->getSnapView ('tesTramitesDet',"IdTram=$tramRow->Id ORDER BY Iteracion DESC");
                    $tramLog = $this->dbLog->getSnapView('logTramites',"IdTramite=$tramRow->Id");
                    $tramJur = $this->dbPilar->getSnapView('tesJurados',"IdTram=$tramRow->Id AND Estado<>0");

                    $this->load->view('admin/tes/2031',array('tramRow'=>$tramRow,'rowsDet'=>$rowsDet,'tramDet'=>$tramDet,'tramLog'=>$tramLog, 'tramJur'=>$tramJur, 'contCorr'=>$arrCont) );

                }else{
                    $this->msgPanel('warning',"El usuario seleccionado no ha registrado <b>Borrador</b> en PILAR EPG");
                }
                break;

                default:
                echo "Error";
                break;
            }
        }

        public function updateTesData(){
            $this->sess->IsLoggedAccess();
            $sess = $this->sess->GetData();

            $idTes= $this->input->post('idTes');
            $iptCel= $this->input->post('iptCel');
            $iptMail= $this->input->post('iptMail');
            $iptPass= $this->input->post('iptPass');


            if($idTes==0){$this->msgPanel('danger',"El tesista no Existe");return;}

            $rowTes=$this->dbPilar->getSnapRow('tblTesistas',"Id=$idTes");

            if($iptPass){

                $this->dbPilar->Update('tblTesistas',array(
                    'Celular'   => $iptCel, 
                    'Correo'    => $iptMail, 
                    'Password'  => $this->includes->DoPass($iptPass),
                    'DateModif'   => mlCurrentDate(),
                ), $idTes);

                $this->dbLog->exeTesistas($idTes, 0, $rowTes->IdPrograma,$rowTes->IdFacultad, "Actualización de Contraseña", "IdTes:$idTes");

                $this->dbLog->exeAdmins($sess->IdUser,$idTes, 0, $rowTes->IdPrograma,$rowTes->IdFacultad, 'Actualizo Contraseña' , "IdTes:$idTes");
                $this->msgPanel('success',"Contraseña Actualizada.");

                $this->sendMail($rowTes->Correo,"CAMBIO DE PASSWORD","La administración de PILAR EPG,  ha actualizado su [ Contraseña : $iptPass ]");
                return ;
            }


            $this->dbPilar->Update('tblTesistas',array(
                'Celular'   => $iptCel, 
                'Correo'    => $iptMail, 
                'DateModif'   => mlCurrentDate(),
            ), $idTes);

            $this->dbLog->exeTesistas($idTes, 0, $rowTes->IdPrograma,$rowTes->IdFacultad, "Actualización de Datos[ Correo / Celular ]", "IdTes:$idTes");
            $this->dbLog->exeAdmins($sess->IdUser,$idTes, 0, $rowTes->IdPrograma,$rowTes->IdFacultad, 'Actualizo Datos Tesista' , "IdTes:$idTes");
            $this->msgPanel('success',"Datos Actualizados.");
            $this->sendMail($iptMail, "ACTUALIZACIÓN DE DATOS","La Administración ha actualizado sus Datos Personales. [Celular: $iptCel] [Correo : $iptMail] ");


        }

        public function cambioJurados(){
            $this->sess->IsLoggedAccess();
            $sess = $this->sess->GetData();

            $IdTram = $this->input->post('idTram');
            $j1 = $this->input->post('j1');
            $j2 = $this->input->post('j2');
            $j3 = $this->input->post('j3');
            $j4 = $this->input->post('j4');
            $docRef = $this->input->post('docRef');
            $firma  = $this->input->post('firma');
            $motiv  = $this->input->post('motiv');
            if ($docRef AND $firma AND $motiv) {
                $tramRow=$this->dbPilar->getSnapRow('tesTramites',"Id=$IdTram AND Estado>=4");
                echo "<h1>$tramRow->Id</h1>";
                if ($tramRow->Tipo!=0) {
                    $this->dbPilar->UpdateEx('tesJurados',array(
                        'Estado'   => 0, 
                        'DateModif'   => mlCurrentDate(),
                        'Obs'=> "Cambio: $docRef"
                    ), "IdTram=$tramRow->Id");
                    // Jurado Seleccionado 
                    for ($i=1; $i <=4 ; $i++) { 
                        $this->dbPilar->Insert('tesJurados',array(
                            'IdTram'    => $IdTram,
                            'IdJurado'  => ${'j'.$i},
                            'IdPrograma' => $tramRow->IdPrograma,
                            'Estado'    => $tramRow->Estado,
                            'Posicion'  => $i,
                            'DateReg'   => mlCurrentDate(),
                            'DateModif' => mlCurrentDate(),
                            'Obs'       => "Cambio:$docRef",
                        ));
                    }
                //  Log de Registro de Log de Cambios
                    $this->dbLog->Insert("logJuCambios", array(
                    'Referens'  => "CambiodeJurado",        // Mejorar tipo doc
                    'IdTramite' => $IdTram,    // guia de Tramite
                    'Tipo'      => $tramRow->Tipo,
                    'IdEstado'  => $tramRow->Estado,  // en el momento
                    'IdPrograma' => $tramRow->IdPrograma,  // en el momento
                    'IdJurado1' => $j1,
                    'IdJurado2' => $j2,
                    'IdJurado3' => $j3,
                    'IdJurado4' => $j4,
                    'Motivo'    => "Cambio de Jurado#$docRef#$firma#$motiv",
                    'DateReg'     => mlCurrentDate()
                    ) );

                    $msg ="CAMBIO DE JURADOS REGISTRADO <br><b>$docRef</b><br> $motiv <br> $firma ";

                    $this->dbLog->exeTramites($sess->IdUser,"EPG - UI", $IdTram,"Cambio de Jurados", "$j1-$j2-$j3-$j4".$msg);
                    $this->dbLog->exeAdmins($sess->IdUser,$tramRow->IdTesista, 0, $tramRow->IdPrograma,$tramRow->IdFacultad, 'Cambio de Jurados' , "IdTram:$IdTram : $j1-$j2-$j3-$j4");
                    $this->msgPanel('success',"$msg");
                    $tesista=$this->dbPilar->inTesista($tramRow->IdTesista);
                    $this->sendMail($tesista->Correo, "CAMBIO DE JURADOS","Se ha realizado un cambio de jurados del trámite $tramRow->Codigo, DocRef. $docRef , si no conoce este procedimiento pongase en contacto con la dependencia de investigación de la EPG.");
                }else{
                    $this->msgPanel('danger',"No es posible realizar el cambio de jurado, no cumple con los requisitos");
                }
            }else{
                $this->msgPanel('danger',"No es posible realizar el cambio de jurado, debe completar la información requerida");
            }

        }

    public function viewProyectos(){
        $this->sess->IsLoggedAccess();
        $sess = $this->sess->GetData();
        $this->load->view('admin/py/pytos',array('sess'=>$sess)); 
    }

    public function viewDefensas(){
        $this->sess->IsLoggedAccess();
        $sess = $this->sess->GetData();
        $this->load->view('admin/sust/solicitudes',array('sess'=>$sess)); 
    }

    public function viewLog(){
        $this->sess->IsLoggedAccess();
        $sess = $this->sess->GetData();
        $acceso=$this->dbLog->getSnapView('logAccesos',"IdUsuario=$sess->IdUser");
        $operac=$this->dbLog->getSnapView('logAdmin',"IdAdmin=$sess->IdUser");
        $this->load->view('admin/log',array('sess'=>$sess,'ac'=>$acceso,'op'=>$operac)); 
    }

    public function operacion($id){
        
        $ipt = $this->input->post('iptBusq');

        switch ($id) {
            // Busequeda Tesistas por código o DNI
            case 1029:
            $datos=$this->dbPilar->getSnapRow('tblTesistas',"DNI='$ipt' OR Cod = '$ipt' OR Apellidos LIKE '%$ipt%'");
            $this->load->view('admin/tes/1029',array('row'=>$datos));
            break;
            // Listado de Tesistas del Programa
            case 1030:
            $datos=$this->dbPilar->getSnapView('tblTesistas',"IdPrograma='$ipt'");
            $this->load->view('admin/tes/1030',array('list'=>$datos, 'program'=>$ipt));
            break;

            // Busequeda Docente por código o DNI
            case 1031:
            $datos=$this->dbRepo->getSnapRow('tblDocentes',"DNI='$ipt' OR Codigo = '$ipt' OR Apellidos LIKE '%$ipt%'");
            $this->load->view('admin/doc/1031',array('row'=>$datos));
            break;
            // Listado de Docentes del Programa
            case 1032:
            $datos=$this->dbRepo->getSnapView('tblDocProg',"IdPrograma='$ipt'");
            $this->load->view('admin/doc/1032',array('list'=>$datos, 'program'=>$ipt));
            break;

            // Listar Trabajos por Usuario
            case 1033:
            $datos=$this->dbPilar->getSnapRow('tblTesistas',"DNI='$ipt' OR Cod = '$ipt'");
            $this->load->view('admin/py/1033',array('tesista'=>$datos));
            break;

            // Listar Trabajos por Tipo
            case 1034:
            $datos=$this->dbPilar->getSnapView('tesTramites',"Estado='$ipt' AND Tipo>0 ORDER BY DateModif ASC");
            $this->load->view('admin/py/1034',array('list'=>$datos, 'Estado'=>$ipt));
            break;

             // Listar Trabajos por Programa
            case 1035:
            $datos=$this->dbPilar->getSnapView('tesTramites',"IdPrograma='$ipt' ORDER BY Id DESC");
            $programa = $this->dbRepo->getSnapRow('dicProgramas',"Id=$ipt");
            $this->load->view('admin/py/1035',array('list'=>$datos, 'program'=>$programa));
            break;

            //  Busqueda de Directores 
            case 1036 :
            $direct=$this->dbRepo->getSnapRow('tblUsuarios',"Id=$ipt"); 
            echo "Yasta está en Id $ipt";   
            break; 

            default:
            echo "No definido";
            break;
        }
    }

    //Operaciones docente apartir del 3000
    public function infoDocentes($op,$id){
        $this->sess->IsLoggedAccess();
        $sess = $this->sess->GetData();
        $rowDoc=$this->dbRepo->getSnapRow('tblDocentes',"Id=$id");
        switch ($op) {
            //  Visualizar y Editar Datos Docente
            case 3031:
                $this->load->view('admin/doc/3031',array('row'=>$rowDoc));
                break;
            default:
                echo "No definido";
                break;
        }

    }

    #Aprobar proyectos por reglamento
    public function apruebaProyecto($IdPy){
        $this->sess->IsLoggedAccess();
        $sess = $this->sess->GetData();
        $rowTram=$this->dbPilar->getSnapRow('tesTramites',"Id=$IdPy");
        $rowDet=$this->dbPilar->getSnapRow('tesTramitesDet',"IdTram=$IdPy ORDER BY Iteracion DESC");
        if ($rowTram->Estado==5) {
            $ptj=$rowDet->vb1+$rowDet->vb2+$rowDet->vb3;
            if ($ptj>=2) {
                $this->dbPilar->UpdateEx( 'tesTramites', array('Estado'=>6,'DateModif'=>mlCurrentDate()), array('Id'=>$IdPy) );
                $this->dbPilar->Insert('tesTramitesDet',array(
                    'IdTram'=>$IdPy,
                    'Iteracion'=>6,
                    'Titulo'=>$rowDet->Titulo,
                    'Archivo'=>$rowDet->Archivo,
                    'vb1'=>$rowDet->vb1,
                    'vb2'=>$rowDet->vb2,
                    'vb3'=>$rowDet->vb3,
                    'vb4'=>$rowDet->vb4,
                    'DateReg'=>mlCurrentDate(),
                    'DateModif'=>mlCurrentDate(),                   
                    'Obs'=>"Aprobación EPG"                   
                ));
                $msg="<b>El proyecto <b>$rowTram->Codigo</b> ha sido aprobado para su ejecución, por la EPG.</b>";
                $this->dbLog->exeTramites($sess->IdUser, "EPG - UI", $IdPy,"Aprobación de proyecto [Reglamento]", $msg);
                $this->msgPanel('success',"$msg");
            }else{
               $this->msgPanel('danger',"<b>Cuidado!</b>: Revise el detalle del proyecto, no tiene los dictámenes suficientes para su aprobación");
            }
        }else{
            $this->msgPanel('danger',"Operación No disponible, no es posible actualizar");
        }
    }

    public function updateDocData(){
            $this->sess->IsLoggedAccess();
            $sess = $this->sess->GetData();

            $IdDoc= $this->input->post('idDoc');
            $iptCel= $this->input->post('iptCel');
            $iptMail= $this->input->post('iptMail');
            $iptPass= $this->input->post('iptPass');


            if($IdDoc==0){$this->msgPanel('danger',"El Docente no Existe");return;}

            $rowDoc=$this->dbRepo->getSnapRow('tblDocentes',"Id=$IdDoc");

            if($iptPass){

                $this->dbRepo->Update('tblDocentes',array(
                    'Celular'   => $iptCel, 
                    'Correo'    => $iptMail, 
                    'Clave'  => $this->includes->DoPass($iptPass),
                    'DateModif'   => mlCurrentDate(),
                ), $IdDoc);

                $this->dbLog->exeDocentes($IdDoc, 0, 0,$rowDoc->IdFacultad, "Actualización de Contraseña", "IdDoc:$IdDoc");

                $this->dbLog->exeAdmins($sess->IdUser,$IdDoc, 0, 0,$rowDoc->IdFacultad, 'Actualizo Contraseña' , "IdDoc:$IdDoc");

                $this->msgPanel('success',"Contraseña Actualizada.");

                $this->sendMail($rowDoc->Correo,"CAMBIO DE PASSWORD PILAR [EPG]","La administración de PILAR EPG,  ha actualizado su [ Contraseña : $iptPass ]");
                return ;
            }

            if($iptMail AND $iptCel){

                $this->dbRepo->Update('tblDocentes',array(
                    'Celular'   => $iptCel, 
                    'Correo'    => $iptMail, 
                    'DateModif'   => mlCurrentDate(),
                ), $IdDoc);

                $this->dbLog->exeDocentes($IdDoc, 0, 0,$rowDoc->IdFacultad, "Actualización de Datos[ Correo / Celular ]", "IdDoc:$IdDoc");
                $this->dbLog->exeAdmins($sess->IdUser,$IdDoc, 0, 0,$rowDoc->IdFacultad, 'Actualizo Datos Docente' , "IdDoc:$IdDoc");
                $this->msgPanel('success',"Datos Actualizados.");
                $this->sendMail($iptMail, "ACTUALIZACIÓN DE DATOS DOCENTE","La Administración ha actualizado sus Datos Personales. [Celular: $iptCel] [Correo : $iptMail] ");
                return ;
            }
            $this->msgPanel('danger',"Error en Operación");

        }


    public function msgPanel($color,$content){
        echo "<div class='card mb-4 py-3 border-left-$color'>
        <div class='card-body'>
        $content.
        </div>
        </div>";

    }

    public function assignUser(){
        // $this->sendMail('rortega@unap.edu.pe',"ASGINACIÓN DE USUARIO","El usuario [rortega@unap.edu.pe] y contraseña [z3z2pas3], han sido asignados con éxito. ");
        echo "Ok";
    }

    public function notificaDoc($idDoc,$idPy){
        $this->sess->IsLoggedAccess();
        $rowDoc=$this->dbRepo->getSnapRow('tblDocentes',"Id=$idDoc");
        $rowTram=$this->dbPilar->getSnapRow('tesTramites',"Id=$idPy");
        $msg="Mediante el presente, se le hace recuerdo que usted tiene pendiente la revisión del trabajo con código : $rowTram->Codigo, en la dirección web : https://vriunap.pe/epgunap/ a la cual deberá acceder con sus credenciales de acceso, en caso de tener inconvenientes puede ponerse en contacto con epg.investigacion@unap.edu.pe";
        $this->sendMail("$rowDoc->Correo","RECORDATORIO: REVISIÓN DE TRABAJO EPG", "$msg");
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
                'IdUsuario' =>$sess->IdUser,
                'TipoUser'  =>'EPG',
                'Correo'    =>$to,
                'Asunto'    =>$asunto, 
                'Mensaje'   =>$msg
        ));

        if($this->email->send()) 
            $this->msgPanel('success', "Notificado al correo electrónico : $to");
        else 
            $this->msgPanel('danger', "Problemas enviando correo electrónico : $to");
    } 


    public function corregir(){
        // $dets=$this->dbPilar->getSnapView('tesTramitesDet',"Iteracion=5");
        // foreach ($dets->result() as $row) {
        //     $this->dbPilar->Update('tesTramitesDet',array('Iteracion'=>20),$row->Id);
        //     echo "Actualizados $row->Id";
        // }
    }

    public function logout()
    {
        if( $sess = $this->sess->GetData() )
            $this->dbLog->exeAccesos($sess->IdUser,69,"Salida","");

        $this->sess->SessionDestroy();
        redirect(base_url("uinepg"),'refresh');
    }

}
