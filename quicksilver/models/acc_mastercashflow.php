<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of acc_mastercashflow
 *
 * @author miyzan
 */
class acc_mastercashflow extends MY_MODEL{
    function __construct() {
        parent::__construct();
    }

     
    function get_rows($search="",$start,$limit)
    {
        $sql_search="";
        if ($search != "")
        {
            $sql_search = "(lower(rekening_debet) LIKE '%" . strtolower($search) . "%' or lower(keterangan) LIKE '%" . strtolower($search) . "%' or lower(rekening_kredit) LIKE '%" . strtolower($search) . "%' or lower(mutasi) LIKE '%" . strtolower($search) . "%')";
        }
        $select="id,idformat,keterangan,mutasi,
            rekening_debet,get_nama_rekening(rekening_debet) as nama_rekening_debet,
            rekening_kredit,get_nama_rekening(rekening_kredit) as nama_rekening_kredit
            ";
        $order=array("id", "asc");
        $table="v_mst_account_cashflow";
        $results = $this->get_rows_paging($sql_search,$start,$limit,$table,$select,$order);
//        $results='tes';
        return $results;       
    }  
     
    
    function get_rows_format($search="",$start,$limit)
    {
        $sql_search="";
        if ($search != "")
        {
            $sql_search = "(lower(keterangan) LIKE '%" . strtolower($search) . "%')";
        }
        $select="id,keterangan,mutasi";
        $order=array("id", "asc");
        $table="mst_account_cashflow_format";
        $results = $this->get_rows_paging($sql_search,$start,$limit,$table,$select,$order);
//        $results='tes';
        return $results;       
    }  
    function get_cashflowformat(){
        $sql_search="";
        $select="id,keterangan";
        $order=NULL;
        $table="mst_account_cashflow_format";
        $results = $this->get_rows_table($sql_search,$table,$select,$order);
        return $results;
    }
    
    
}

?>
