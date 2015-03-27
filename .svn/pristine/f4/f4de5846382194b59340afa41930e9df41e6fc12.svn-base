<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of masteraccount_model
 *
 * @author faroq
 */
class masteraccount_model extends MY_MODEL {
    //put your code here
    function __construct() {
        parent::__construct();
    }


    
    function get_rows($search="",$start,$limit) {
        $sql_search="";
        if ($search != "") {
            $sql_search = "(lower(nama_rekening) LIKE '%" . strtolower($search) . "%')";
//            $this->db->where($sql_search, NULL);
        }
        $select="rekening,nama_rekening,default,nama_kelompok,nama_jenis,kelompok,jenis";
        $order=array("rekening", "asc");     
        $table="v_mst_account";
        
        $results = $this->get_rows_paging($sql_search,$start,$limit,$table,$select,$order);
        return $results;       
        
    }   
    
    function get_jenis() {
        $sql_search="";        
        $select="jenis,nama_jenis";
        $order=NULL;     
        $table="acc_jenisaccount";
        
        $results = $this->get_rows_table($sql_search,$table,$select,$order);
        return $results;       
        
    }   
    
    function get_kelompok($search="") {
        $sql_search="";
        if ($search != "") {
            $sql_search = "jenis = '$search'";
//            $this->db->where($sql_search, NULL);
        }    
        $select="kelompok,nama_kelompok";
        $order=NULL;     
        $table="mst_account_kel";
        
        $results = $this->get_rows_table($sql_search,$table,$select,$order);
        return $results;       
        
    }   
    
   
    
    
}

?>
