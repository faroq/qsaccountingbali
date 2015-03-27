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
class global_reference_model extends MY_MODEL {
    //put your code here
    function __construct() {
        parent::__construct();
    }

    function get_jenis()
    {
        $sql_search="";
        $select="jenis,nama_jenis";
        $order=NULL;
        $table="acc_jenisaccount";
        $results = $this->get_rows_table($sql_search,$table,$select,$order);
        return $results;
    }

    function get_dk()
    {
        $sql_search="";
        $select="dk,default";
        $order=NULL;
        $table="acc_dkaccount";
        $results = $this->get_rows_table($sql_search,$table,$select,$order);
        return $results;
    }
}

?>
