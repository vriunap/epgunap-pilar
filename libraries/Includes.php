<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Includes extends GenSessionNative{

    public function DoPass($text){
        $pass = strtoupper(sha1(sha1($text, true)));
        $pass = '*' . $pass;
        return  $pass;
    }

    function otiGetData( $codMat ){
        return json_decode( otiGetAlumno($codMat) );
    }

    public function otiGetAlumno( $codMat ){

        /********************************************************************************************
        DATOS DE TU CUENTA
        ********************************************************************************************/

        $app_id  = 'viceinvestigacion';
        $app_key = '575e0877a2612696ab01606f11c69eaf';

        $parametros = array(
            'controller' => 'estudiante',
            'action'     => 'datos',
            'codigo'     => $codMat, // '131313',
            'clave'      => 'f57fbc106613ce2c'
        );

        // $peticion = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $app_key, json_encode($parametros), MCRYPT_MODE_ECB));
        //
        // $id = openssl_random_pseudo_bytes(16);
        // $peticion = openssl_encrypt( json_encode($parametros), 'AES-128-CBC', $app_key, OPENSSL_RAW_DATA, $id);

        $peticion = json_encode($parametros);  /// -> 2019-11-11 Solo se cambio esta linea

        $api = curl_init();
        curl_setopt($api, CURLOPT_URL, 'http://unapvirtual.unap.edu.pe/siu/viceinvestigacion/');
        curl_setopt($api, CURLOPT_POST, TRUE);
        curl_setopt($api, CURLOPT_POSTFIELDS, array('request'=>$peticion, 'id'=>$app_id));
        curl_setopt($api, CURLOPT_RETURNTRANSFER, 1);

        $resultado = curl_exec($api);

        return $resultado;
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

    function IsLoggedAccess( $sessName=SessRealName )
    {
        $sessData = $this->GetSessionData( $sessName );
        if( ! $sessData ) {
            echo "EPGUnap : You aren't allowed";
            exit; return;
        }
    }

    function SessionDestroy( $sessName=SessRealName )
    {
        $this->sess_destroy();
    }

}
