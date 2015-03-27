<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of mst_account_kel
 *
 * @author faroq
 */
class mst_accountkel extends MY_MODEL {
    //put your code here
   function __construct() {
        parent::__construct();
    }

    function get_rows($search="",$start,$limit)
    {
        $sql_search="";
        if ($search != "")
        {
            $sql_search = "(lower(nama_kelompok) LIKE '%" . strtolower($search) . "%')";           
        }
        $select="jenis,nama_jenis,dk,`default`,kelompok,nama_kelompok,kode_asosiasi,nilai,flag";
        $order=array("kelompok", "asc");
        $table="v_mst_account_kel";
        $results = $this->get_rows_paging($sql_search,$start,$limit,$table,$select,$order);
//        $results='tes';
        return $results;       
    }   
}

?>
