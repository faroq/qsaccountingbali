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
class acc_masterposting extends MY_MODEL {
    //put your code here
   function __construct() {
        parent::__construct();
    }

    function get_rows($search="",$start,$limit)
    {
        $sql_search="";
        if ($search != "")
        {
            $sql_search = "(lower(tablefrom) LIKE '%" . strtolower($search) . "%')";
        }
        $select="id,tablefrom,validation,isselisih,debet,kredit,akun_selisih,created_date,update_date";
        $order=array("id", "asc");
        $table="v_acc_master_posting";
        $results = $this->get_rows_paging($sql_search,$start,$limit,$table,$select,$order);
//        $results='tes';
        return $results;       
    }   
}

?>
