<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of payable_report_model
 *
 * @author miyzan
 */
class payable_report_model extends MY_MODEL{
    //put your code here
    
    function __construct() {
        parent::__construct();
    }

    function get_report_account($search="",$start,$limit) {
        $sql_search="report_type = 'Payable' ";
        if ($search != "") {
            $sql_search .= " and (lower(nama_rekening) LIKE '%" . strtolower($search) . "%' or rekening LIKE '%" . strtolower($search) . "%')";
//            $this->db->where($sql_search, NULL);
        }
        
        $select="rekening,nama_rekening";
//        $order=NULL;
        $table="v_mst_report_acc";
        $order=array("rekening", "asc");  
        
        $results = $this->get_rows_paging($sql_search,$start,$limit,$table,$select,$order);
        return $results;       
        
    }   
}

?>
