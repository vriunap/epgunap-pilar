<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include( "../absmain/mlLibrary.php" );
include( "../absmain/mlotiapi.php" );

class Reports extends CI_Controller {

    public function __construct(){
        parent::__construct();

        $this->load->library("Sess");
        $this->load->library("Includes");
        $this->load->model('dbPilar');
        $this->load->model('dbRepo');
        $this->load->model('dbLog');
    }

    public function index(){
        echo "Report Area";
    }
    
    public function viewDocentes(){
        $this->load->view('reports/header');
        $programas  = $this->dbRepo->getSnapView('dicProgramas');
        $this->load->view('reports/001_docentesprograma',array('programas'=>$programas));
        $this->load->view('reports/footer');
    }

    public function viewdocEsc($id){
        $this->load->view('reports/header');
        $docProg    = $this->dbRepo->getSnapView('tblDocProg', "IdPrograma=$id");
        $nombre = $this->dbRepo->getOneField('dicProgramas',"Nombre","Id=$id");
        $this->load->view('reports/002_listadocentesprograma',array('docProg'=>$docProg,'nombre'=>$nombre));
        $this->load->view('reports/footer');
    }

    public function verificaDoc(){
        $i=1;
        $docProg    = $this->dbRepo->getSnapView('tblDocProg');
        foreach ($docProg->result() as $row) {
            $doc=$this->dbRepo->inDocente("$row->IdDocente");
            if($doc->Id){
                echo "$i:$row->Id:$doc->Nombres:$row->IdPrograma<br>";
                $i++;
            }
        }
    }
}
    

