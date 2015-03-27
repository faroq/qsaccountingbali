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
    function get_rows_mp($search="",$start,$limit)
    {
        $sql_search="";
        if ($search != "")
        {
            $sql_search = "(lower(kode_posting) LIKE '%" . strtolower($search) . "%' or lower(nama_posting) LIKE '%" . strtolower($search) . "%')";
        }
        $select="kode_posting,memorial,dk,nama_posting,
            rekening_debet,get_nama_rekening(rekening_debet) as nama_rekening_debet,
            rekening_kredit,get_nama_rekening(rekening_kredit) as nama_rekening_kredit
            ";
        $order=array("kode_posting", "asc");
        $table="mst_account_posting";
        $results = $this->get_rows_paging($sql_search,$start,$limit,$table,$select,$order);
//        $results='tes';
        return $results;       
    }   
     
    function get_rows_mp_biaya($search="",$start,$limit)
    {
        $sql_search="";
        if ($search != "")
        {
            $sql_search = "(lower(kode_posting) LIKE '%" . strtolower($search) . "%' or lower(nama_rekening) LIKE '%" . strtolower($search) . "%')";
        }
        $select="dept,get_nama_dept(dept) as nama_dept, kode_posting, nama_rekening, debet,get_nama_rekening(debet) as nama_debet, kredit, get_nama_rekening(kredit) as nama_kredit";
        $order=array("kode_posting", "asc");
        $table="mst_account_biaya";
        $results = $this->get_rows_paging($sql_search,$start,$limit,$table,$select,$order);
//        $results='tes';
        return $results;       
    }   
     
    
}

?>
