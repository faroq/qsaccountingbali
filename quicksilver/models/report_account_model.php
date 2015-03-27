<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of report_account_model
 *
 * @author miyzan
 */
class report_account_model extends MY_MODEL {
    //put your code here
    function __construct() {
        parent::__construct();
    }


    
    function get_rows($search="",$start,$limit) {
        $sql_search="";
        if ($search != "") {
            $sql_search = "(lower(nama_rekening) LIKE '%" . strtolower($search) . "%' or rekening LIKE '%" . strtolower($search) . "%' or report_type like '%" . strtolower($search) . "%')";
//            $this->db->where($sql_search, NULL);
        }
        $select="id,report_type,rekening,nama_rekening";
        $order=array("report_type", "asc");     
        $table="v_mst_report_acc";
        
        $results = $this->get_rows_paging($sql_search,$start,$limit,$table,$select,$order);
        return $results;       
        
    }   
}

?>
