<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of mst_account_kel
 *
 * @author faroq
 */
class mst_account_kel extends MY_MODEL {
    //put your code here
    function __construct()
    {
        parent::__construct();
    }

    function get_rows($search="",$start,$limit)
    {
        $sql_search="";
        if ($search != "")
        {
            $sql_search = "(lower(nama_kelompok) LIKE '%" . strtolower($search) . "%')";
            //$this->db->where($sql_search, NULL);
        }
        $select="jenis,nama_jenis,dk,default,kelompok,nama_kelompok,kode_asosiasi,nilai,flag";
        $order=array("kelompok", "asc");
        $table="v_mst_account_kel";
        $results = $this->get_rows_paging($sql_search,$start,$limit,$table,$select,$order);
        return $results;       
    }   
}

?>
