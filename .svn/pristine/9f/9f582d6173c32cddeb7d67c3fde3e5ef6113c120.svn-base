<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of entry_jurnal
 *
 * @author faroq
 */
class entry_jurnal_model extends MY_MODEL {
    //put your code here
    function __construct() {
        parent::__construct();
    }
    
    function get_row_approval($search="",$start,$limit) {
        $sql_search="";
        if ($search != "") {
            $sql_search = "(lower(referensi) LIKE '%" . strtolower($search) . "%' or lower(keterangan) LIKE '%" . strtolower($search) . "%')";
        }
        $select="nomor_entry,tgl_jurnal,referensi,keterangan";        
        $order=array("nomor_entry", "asc");     
        $table="v_acc_jurnal_to_approval";
        
        $results = $this->get_rows_paging($sql_search,$start,$limit,$table,$select,$order);
        return $results;       
        
    }   
    function get_row_approval_detail($search="") {
        $sql_search="nomor_entry = '$search'";        
        $select="rekening,nama_rekening,debet,kredit,dk_entry";
        $order=array("dk_entry", "asc");     ;     
        $table="v_acc_jurnal_to_approval_d";
        
        $results = $this->get_rows_table($sql_search,$table,$select,$order);
        return $results;   
    }   
}

?>
