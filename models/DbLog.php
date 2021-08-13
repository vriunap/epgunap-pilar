<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

//
// add our Base Model retrived From: PedrixAdo
//
require_once APPPATH."models/MainModel.php";

//
// our Composed Model to EpgApp
//

class DbLog extends MainModel
{

    public function __construct()
    {
        parent::__construct();
        $this->setDB( "epg_log" );
    }

    //---------------------------------------------------------------------------
    // area de funciones propias para DB manage por ROW ultima iteracion
    //---------------------------------------------------------------------------

    public function exeAccesos($idUsuario,$tipo,$accion,$mail)
    {
      $this->load->library('user_agent');

      $agent = 'Unknowed UA';
      if ($this->agent->is_browser())
      {
        $agent = $this->agent->browser().' '.$this->agent->version();
        }
        elseif ($this->agent->is_robot())
        {
            $agent = $this->agent->robot();
        }
        elseif ($this->agent->is_mobile())
        {
            $agent = $this->agent->mobile();
        }

        $this->dbLog->Insert( "logAccesos", array(
            'IdUsuario'  => $idUsuario,
            'Accion'  => $accion,
            'Tipo'  => $tipo,
            'IP'      => mlClientIP(),
            'OS'      => $this->agent->platform(),
            'Browser' => $agent,
            'DateReg'   => mlCurrentDate(),
            'DateModif'   => mlCurrentDate(),
            'Resumen'   => md5("$idUsuario+".mlCurrentDate() ),
            'Obs'=>"$mail"
        ) );

    }


    public function exeUnidades($IdUsuario, $IdTramite=0, $IdPrograma=0,$IdFacultad, $accion , $detalle){
        $this->dbLog->Insert( "logUnidades", array(
            'IdUsuario' => $IdUsuario,
            'IdTramite' => $IdTramite,
            'IdPrograma' => $IdPrograma,
            'IdFacultad' => $IdFacultad,
            'Accion' => $accion,
            'Detalle' => $detalle,
            'DateReg'=>mlCurrentDate(),
            'DateModif'=>mlCurrentDate(),
            'Resumen'=> md5("$IdUsuario+".mlCurrentDate()),
        ) );
    }

    public function exeTramites($IdUsuario, $who, $IdTramite=0,$accion , $detalle){
        $this->dbLog->Insert( "logTramites", array(
            'IdUsuario' => $IdUsuario,
            'IdTramite' => $IdTramite,
            'Iteracion' => 0,  // se agregó el 15/10/2020 ,hay que actualizar los argumentos 
            'Quien' => $who,
            'Accion' => $accion,
            'Detalle' => $detalle,
            'DateReg'=>mlCurrentDate(),
            'DateModif'=>mlCurrentDate(),
            'Resumen'=> md5("$IdUsuario+".mlCurrentDate()),
        ) );
    }

    public function exeTesistas($IdUsuario, $IdTramite=0, $IdPrograma=0,$IdFacultad, $accion , $detalle){
        $this->dbLog->Insert( "logTesistas", array(
            'IdUsuario' => $IdUsuario,
            'IdTramite' => $IdTramite,
            'IdPrograma' => $IdPrograma,
            'IdFacultad' => $IdFacultad,
            'Accion' => $accion,
            'Detalle' => $detalle,
            'DateReg'=>mlCurrentDate(),
            'DateModif'=>mlCurrentDate(),
            'Resumen'=> md5("$IdUsuario+".mlCurrentDate()),
        ) );
    }

    public function exeDocentes($IdUsuario, $IdTramite=0, $IdPrograma=0,$IdFacultad, $accion , $detalle){
        $this->dbLog->Insert( "logDocentes", array(
            'IdUsuario' => $IdUsuario,
            'IdTramite' => $IdTramite,
            'IdPrograma' => $IdPrograma,
            'IdFacultad' => $IdFacultad,
            'Accion' => $accion,
            'Detalle' => $detalle,
            'DateReg'=>mlCurrentDate(),
            'DateModif'=>mlCurrentDate(),
            'Resumen'=> md5("$IdUsuario+".mlCurrentDate()),
        ) );
    }

     public function exeAdmins($IdAdmin,$IdUsuario, $IdTramite=0, $IdPrograma=0,$IdFacultad, $accion , $detalle){
        $this->dbLog->Insert( "logAdmin", array(
            'IdAdmin'   => $IdAdmin,
            'IdUsuario' => $IdUsuario,
            'IdTramite' => $IdTramite,
            'IdPrograma' => $IdPrograma,
            'IdFacultad' => $IdFacultad,
            'Accion' => $accion,
            'Detalle' => $detalle,
            'DateReg'=>mlCurrentDate(),
            'DateModif'=>mlCurrentDate(),
            'Resumen'=> md5("$IdUsuario+".mlCurrentDate()),
        ) );
    }



}

