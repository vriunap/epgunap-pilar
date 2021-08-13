
<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

//
// add our Base Model retrived From: PedrixAdo
//
require_once APPPATH."models/MainModel.php";

//
// our Composed Model to EpgApp
//

class DbRepo extends MainModel
{

    public function __construct()
    {
        parent::__construct();
        $this->setDB( "epg_absmain" );
    }

    //---------------------------------------------------------------------------
    // area de funciones propias para DB manage por ROW ultima iteracion
    //---------------------------------------------------------------------------
    public function mdLoginU($mail,$pass){
        $query=$this->dbRepo->getSnapRow('tblUsuarios',"Correo='$mail' AND Password='$pass'");
        return ($query?true:false);
    }

    public function mdLoginD($mail,$pass){
        $query=$this->dbRepo->getSnapRow('tblDocentes',"Correo='$mail' AND Clave='$pass'");
        return ($query?true:false);
    }


    public function mdLoginAd($mail,$pass){
        $query=$this->dbRepo->getSnapRow('tblUsuariosAdm',"Estado='1' AND Correo='$mail' AND Password='$pass'");
        return ($query?true:false);
    }

    public function logPilar($idUser,$op,$obs){
        echo "opps develp";
    }

    public function inCorreo( $idTes )
    {
        if( ! $idTes ) return null;
        return $this->getOneField( "tblTesistas", "Correo", "Id=$idTes" );
    }

    public function inProgramaTesista($IdTes){
        if( ! $IdTes ) return null;
        $query=$this->dbPilar->getSnapRow('tblTesistas',"Id=$IdTes");
        return $this->getSnapRow( "dicProgramas", "Id=$query->IdPrograma" );
    }

    public function inProgramaDocente($IdDoc,$IdProg){
        if( ! $IdDoc ) return null;
        $query=$this->getSnapRow('tblDocProg',"IdDocente=$IdDoc AND IdPrograma=$IdProg");
        if ($query) {
            return $this->getSnapRow( "tblDocentes", "Id=$IdDoc" );
        }else{
            return null;
        }
    }

    public function inDocente($Id){
        return $this->dbRepo->getSnapRow('tblDocentes',"Id=$Id");
    }

    function inDocenteEx( $id )
    {
        if( !$id ) return null;
        $row = $this->getSnapRow( "tblDocentes", "Id=$id" );

        if( !$row ) return null;
        $datos = "";
        $datos = mb_strtoupper($row->Nombres) . " $row->Apellidos";
        return $datos;
    }

}

