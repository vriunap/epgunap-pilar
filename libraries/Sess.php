<?php if ( ! defined('BASEPATH')) exit('No se permite el acceso directo al script');

//--------------------------------------------------------------------------------
//  Custom Library : Native Session Manager
//   coded by: Ramiro Pedro Laura Murillo
//   dated on: 21/02/2017
//--------------------------------------------------------------------------------

class GenSessionNative {

    public function isOn()
    {
        echo "custom lib: GenSession loaded.<br>";
    }

    public function set_userdata( $name, $value )
    {
        if(!isset($_SESSION))
            session_start();

        $_SESSION[ $name ] = $value;
    }

    public function userdata( $name )
    {
        if(!isset($_SESSION))
            session_start();

        if( isset($_SESSION[ $name ]) )
            return $_SESSION[ $name ];

        return NULL;
    }

    public function sess_destroy( $name )
    {
        if(!isset($_SESSION))
            session_start();

        $_SESSION[ $name ] = NULL;
    }
}


//--------------------------------------------------------------------------------
// Enhanced Session Class : indepent sessions by App as it worth  (Pedrix)
//--------------------------------------------------------------------------------

define( "SessRealName", "eEPG" );


class Sess extends GenSessionNative {

    public function __construct()
    {
        //parent::__construct();
    }

    //------------------------------------------------------------------------------------------------
    // Login para usuarios PILAREPG - Tesista
    //------------------------------------------------------------------------------------------------
    public function  SetUserTesista($IdUser, $UserDNI,$UserCod,$UserName, $Tipo,$Correo="(none)", $IdPrograma=0, $IdSubprog=0 ){

        $sessdata = array(
            'IdService'     => 0x10,
            'servName'      => 'utf8',
            'userType'      => 100,
            'IdUser'        => $IdUser,
            'DNIUser'       => $UserDNI,
            'CodUser'       => $UserCod,
            'NameUser'      => $UserName,
            'Correo'        => $Correo,
            'IdSubProg'     => $IdSubprog,
            'IdPrograma'    => $IdPrograma,
            'Tipo'          => $Tipo,
            'SessTip'       =>'F6969x1711P',
            'islogged'      => true
        );

        $this->SetSessionData( $sessdata, SessRealName );
    }

       //------------------------------------------------------------------------------------------------
    // Login para usuarios PILAREPG - Coordinador
    //------------------------------------------------------------------------------------------------
    public function  SetUserUnidad($IdUser, $UserDNI,$UserCod,$UserName, $Tipo,$Correo="(none)", $IdFacultad, $IdPrograma, $Nivel){

        $sessdata = array(
            'IdService'     => 0x170,
            'servName'      => 'utf8',
            'userType'      => 700,
            'IdUser'        => $IdUser,
            'DNIUser'       => $UserDNI,
            'CodUser'       => $UserCod,//Anio-FB-Number
            'NameUser'      => $UserName,
            'Correo'        => $Correo,
            'IdFacultad'    => $IdFacultad,
            'IdPrograma'    => $IdPrograma,
            'Tipo'          => $Tipo,
            'Nivel'          => $Nivel,
            'SessTip'       =>'F6980x171701W',
            'islogged'      => true
        );

        $this->SetSessionData( $sessdata, SessRealName );
    }


    //------------------------------------------------------------------------------------------------
    // Login para usuarios PILAREPG - Docente
    //------------------------------------------------------------------------------------------------
    public function  SetUserDocente($IdUser, $UserDNI,$UserCod,$UserName, $Tipo,$Correo="(none)", $IdPrograma=0, $IdSubprog=0 ){

        $sessdata = array(
            'IdService'     => 0x10,
            'servName'      => 'utf8',
            'userType'      => 0,
            'IdUser'        => $IdUser,
            'DNIUser'       => $UserDNI,
            'CodUser'       => $UserCod,
            'NameUser'      => $UserName,
            'Correo'        => $Correo,
            /*'IdSubProg'     => $IdSubprog, creo que no va  */
            /*'IdPrograma'    => $IdPrograma,/* creo que no va */
            'Tipo'          => $Tipo,
            'SessTip'       =>'F6969x1711P',
            'islogged'      => true
        );

        $this->SetSessionData( $sessdata, SessRealName );
    }




    //------------------------------------------------------------------------------------------------
    // Login para usuarios PILAREPG - SetUserAdmin
    //------------------------------------------------------------------------------------------------
    public function  SetUserAdmin($IdUser, $UserDNI,$UserName, $Tipo, $Nivel){

        $sessdata = array(
            'IdService'     => 0x116,
            'servName'      => 'utf8',
            'IdUser'        => $IdUser,
            'DNIUser'       => $UserDNI,
            'NameUser'      => $UserName,
            'Tipo'          => $Tipo,
            'Nivel'         => $Nivel,
            'SessTip'       =>'F6969x1407AD',
            'islogged'      => true
        );

        $this->SetSessionData( $sessdata, SessRealName );
    }


    function SetSessionData( $arrData, $sessName=SessRealName )
    {
        // $this->mark_as_temp( $arrData, seconds );
        $this->set_userdata( $sessName, $arrData );
    }

    function GetSessionData( $sessName=SessRealName )
    {
        // verificar si es de esta APP ojo

        $sessData = $this->userdata( $sessName );
        if( ! $sessData ) return NULL;

        // si existe info, crear en JSON
        return json_decode( json_encode($sessData) );
    }

    function GetData( $sessName=SessRealName )
    {
        return $this->GetSessionData($sessName);
    }

    /*
    function IsLoggedAccess( $sessName=SessRealName )
    {
        $sessData = $this->GetSessionData( $sessName );
        if( ! $sessData ) {
            echo "Pilar : You aren't allowed";
            exit; return;
        }
    }*/

    // version modificada para sessiones Multi-Admin level
    function IsLoggedAccess( $sessName=SessRealName, $arrAllows=1 )
    {
        $sessData = $this->GetSessionData( $sessName );
        if( ! $sessData ) {
            echo "iVRIEPG : You aren't allowed";
            exit; return;
        }

        $allowed = false;
        if( is_array($arrAllows) ) {
            foreach( $arrAllows as $itm ){
                if( $itm == $sessData->userLevel )
                    $allowed = true;
            }
        } else {
            //if( $arrAllows == $sessData->userLevel )
            $allowed = true; // para todos los ($sessName)
        }

        if( ! $allowed ) {
            echo "iVRIEPG: You haven't enough priviledges";
            exit; return;
        }
    }

    function SessionDestroy( $sessName=SessRealName )
    {
        $this->sess_destroy( $sessName );
    }
}

?>
