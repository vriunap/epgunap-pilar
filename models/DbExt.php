<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

//
// add our Base Model retrived From: PedrixAdo
//
require_once APPPATH."models/MainModel.php";

//
// our Composed Model to EpgApp
//

class DbExt extends CI_Model
{
   var $innerDB;

    //-------------------------------------------------------------------------------
    public function __construct()
    {
        parent::__construct();
        $this->load->database('pilar');
    }

    public function setDB( $dbname='vriunap_absmain' )
    {
        $this->innerDB = $dbname;
    }

    public function getDB()
    {
        return "USE: $this->innerDB";
    }
    // Area
     public function Insert( $table, $arrData )
    {
        //$this->db->trans_start();
        $this->db->insert( "$this->innerDB.$table", $arrData );
        //$this->db->trans_complete();
        $id = $this->db->insert_id();
        return $id;
    }
    //-------------------------------------------------------------------------------
    public function Update( $table, $arrFields, $idReg )
    {
        $this->db->where( 'Id', $idReg );
        $this->db->update( "$this->innerDB.$table", $arrFields );
    }

    public function UpdateEx( $table, $arrFields, $arrFilter )
    {
        $this->db->where( $arrFilter );
        $this->db->update( "$this->innerDB.$table", $arrFields );
    }
    //-------------------------------------------------------------------------------
    public function DeleteEx( $table, $arrFilter )
    {
        $this->db->where( $arrFilter );
        $this->db->delete( "$this->innerDB.$table" );
    }

    public function Delete( $table, $id )
    {
        // interno ya procesa
        $this->DeleteEx( $table, array('Id' => $id ) );
    }
    //-------------------------------------------------------------------------------
    public function getTable( $table, $arrCriteria=null )
    {
        if( $arrCriteria != null )
            $this->db->where( $arrCriteria );

        return  $this->db->get( "$this->innerDB.$table" );
    }
    //-------------------------------------------------------------------------------
    public function getSnapView( $table, $strCriteria=null, $extra="" )
    {
        if( is_array($strCriteria) or $strCriteria==null )
            $query = "SELECT * FROM $this->innerDB.$table $extra";
        else
            $query = "SELECT * FROM $this->innerDB.$table WHERE $strCriteria $extra";

        return $this->db->query( $query );
    }

    public function getResultSet( $table, $filter )
    {
        $tbl = $this->getSnapView( $table, $filter );
        if( $tbl->num_rows() >= 1 )
            return $tbl->result();

        return false;
    }

    public function getSnapRow( $table, $strCriteria=null, $extra="" )
    {
        $table = $this->getSnapView( $table, $strCriteria, $extra );
        if( $table )
            return $table->row();

        return null;
    }
    //-------------------------------------------------------------------------------
    public function getTotalRows( $table, $arrfilter )
    {
        $tmp = $this->getSnapView( $table, $arrfilter );
        return $tmp->num_rows();
    }

    public function getOneField( $table, $field, $filter )
    {
        $tbl = $this->getSnapView( $table, $filter );
        if( $tbl->num_rows() >= 1 ){
            $row = $tbl->row_array();
            return $row[ $field ];
        }

        return  null;
    }
    //-------------------------------------------------------------------------------
    public function getQuery( $query )
    {
        // a resultset()
        return $this->db->query( $query );
    }

}

