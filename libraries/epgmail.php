<?php if(!defined('BASEPATH')) exit('No direct script access allowed');


require_once BASEPATH . "libraries/Email.php";


class epgmail extends CI_Email
{
    public function __construct()
    {
        parent::__construct();
    }


    //----------------------------------------------------------------------------------------------------------------
    // Formatos HTML para presentacion de correos por App
    //----------------------------------------------------------------------------------------------------------------
    private function frmMsgVRI( $msg )
    {
        $str = "<body style='background:#E0E0E0; padding:25px'> <center> "
             . "<div style='background:white;width:600px;padding:14px;border:1px solid #B0B0B0'> "
             . "<div style='text-align:left;font-family:Arial'> "
             . "<img style='float: right' src='http://vriunap.pe/absmain/imgs/sm_unap.png' height=55> &nbsp;&nbsp; "
             . "<img style='float: left' src='http://vriunap.pe/absmain/imgs/sm_vri.png' height=55> &nbsp;&nbsp; "
             . "<div style='clear: both'></div>"
             . "<hr> <p> $msg </p> <br><hr style='border:1px dotted #C0C0C0'> "
             . "<p style='font-size:10px;font-weight:bold'> Universidad Nacional del Altiplano - Puno <br>"
             . "Vicerrectorado de Investigación<br>Dirección General de Investigación<br> <small>Plataforma de Investigación y Desarrollo </small> </p> </div></div>"
             . "</center> </body>";

        return $str;
    }

    private function frmMsgPilar( $msg )
    {
        $str = "<body style='background:#E0E0E0; padding:25px'> <center> "
             . "<div style='background:white;width:650px;padding:14px;border:1px solid #B0B0B0'> "
             . "<div style='text-align:left;font-family:Arial'> "
             . "<img src='http://vriunap.pe/absmain/imgs/sm_unap.png' height=55> &nbsp;&nbsp; "
             . "<img src='http://vriunap.pe/absmain/imgs/sm_vri.png' height=55> &nbsp;&nbsp; "
             . "<img src='http://vriunap.pe/absmain/imgs/sm_pilar.png' height=60> "
             . "<hr> <p> $msg </p> <br><hr style='border:1px dotted #C0C0C0'> "
             . "<p style='font-size:10px;font-weight:bold'> Universidad Nacional del Altiplano - Puno <br>"
             . "Vicerrectorado de Investigación<br>Dirección General de Investigación<br> <small>Plataforma de Investigación y Desarrollo </small> </p> </div></div>"
             . "</center> </body>";

        return $str;
    }

    private function frmMsgEpg( $msg )
    {
        $str = "<body style='background:#E0E0E0; padding:25px'> <center> "
             . "<div style='background:white;width:650px;padding:14px;border:1px solid #B0B0B0'> "
             . "<div style='text-align:left;font-family:Arial'> "
             . "<img src='http://vriunap.pe/epgunap/include/img/imgmailunap.png' height=55> &nbsp;&nbsp; "
             . "<img src='http://vriunap.pe/epgunap/include/img/imgmailvri.png' height=55> &nbsp;&nbsp; "
             . "<img src='http://vriunap.pe/epgunap/include/img/imgmailpilar.png' height=60> "
             . "<hr> <p> $msg </p> <br><hr style='border:1px dotted #C0C0C0'> "
             . "<p style='font-size:10px;font-weight:bold'> Universidad Nacional del Altiplano de Puno <br>"
             . "<p style='font-size:10px;font-weight:bold'> Escuela de Posgrado <br>"
             . "Vicerrectorado de Investigación<br> <small>Oficina de Plataforma de Investigación y Desarrollo </small> </p> </div></div>"
             . "</center> </body>";

        return $str;
    }



 

    public function mailPilar( $mailx, $title, $msg )
    {

        $config['charset']  = 'UTF-8';
        $config['mailtype'] = "html";

        $this->initialize($config);

        $this->from('pilar@vriunap.pe', 'Plataforma PILAR - UNAP');
        $this->to( $mailx );
        //$this->cc('vriunap@yahoo.com');

        $this->subject( $title );
        $this->message( $this->frmMsgPilar($msg) );

        if ( ! $this->send() )
            echo $this->email->print_debugger();
    }

    public function sendMail( $mailx, $title, $msg ) // VRI general
    {
        //$config['protocol'] = 'sendmail';
        //$config['mailpath'] = '/usr/sbin/sendmail';
        $config['charset']  = 'UTF-8';
        $config['mailtype'] = "html";

        $this->initialize($config);

        $this->from('vri@vriunap.pe', 'Vicerrectorado de Investigación - UNAP');
        $this->to( $mailx );
        $this->cc('tempmail@mail.com'); // crear mail de respaldo

        $this->subject( $title );
        $this->message( $this->frmMsgVRI($msg) );

        if ( ! $this->send() )
            echo $this->email->print_debugger();
    }

    public function sendHtml( $mailx, $title, $msg ) // VRI general
    {
        //$config['protocol'] = 'sendmail';
        //$config['mailpath'] = '/usr/sbin/sendmail';
        $config['charset']  = 'UTF-8';
        $config['mailtype'] = "html";

        $this->initialize($config);

        $this->from('vri@vriunap.pe', 'Vicerrectorado de Investigación - UNAP');
        $this->to( $mailx );
        //$this->cc('vriunap@yahoo.com');

        $this->subject( $title );
        $this->message( $msg );

        if ( ! $this->send() )
            echo $this->email->print_debugger();
    }

    //--------------------------------------------------------------------------------------
    // evio por lotes :: bcc_batch_size = 500   (email.php .. line 224)
    //--------------------------------------------------------------------------------------
    public function sendBatch( $arrmail, $title, $msg, $who=1 )
    {
        // who:1  VRI
        // who:2  Pilar
        // who:3  Fedu

        $config['charset']  = 'UTF-8';
        $config['mailtype'] = "html";

        $this->initialize($config);

        $this->to( 'ccoepg@gmail.com' );  //Crear
        $this->bcc( $arrmail );

        

        if( $who==1 ) $this->from('vri@vriunap.pe', 'Vicerrectorado de Investigación - UNAP');
        if( $who==2 ) $this->from('pilar@vriunap.pe', 'Plataforma PILAR - UNAP');
        if( $who==3 ) $this->from('epg@vriunap.pe', 'Plataforma PILAR EPG - UNA PUNO');

        $this->subject( $title );

        if( $who==1 ) $this->message( $this->frmMsgVRI($msg) );
        if( $who==2 ) $this->message( $this->frmMsgPilar($msg) );
        if( $who==3 ) $this->message( $this->frmMsgEpg($msg) );

        if ( ! $this->send() )
            echo $this->print_debugger();

        return $msg;
    }


    public function mailEpg( $mailx, $title, $msg )
    {
        //$config['protocol'] = 'sendmail';
        //$config['mailpath'] = '/usr/sbin/sendmail';
        $config['charset']  = 'UTF-8';
        $config['mailtype'] = "html";

        $this->initialize($config);

        $this->from('epg@vriunap.pe', 'EPG-UNAP'); //crear epg
        $this->to( $mailx );
 

        $msgx = "<hr> <p> $msg </p> <br><hr style='border:1px dotted #C0C0C0'> "
              . "<p style='font-size:10px;font-weight:bold'> Universidad Nacional del Altiplano de Puno <br>"
              . "<b>Escuela de Posgrado</b> </p> </div></div>"
              . "</center> </body>";

        $this->subject( $title );
        $this->message( $msgx ); //$this->frmMsgVRI($msg) );

        if ( ! $this->send() )
            echo $this->email->print_debugger();
    }






}




