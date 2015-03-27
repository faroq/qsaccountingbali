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
    
    function get_dept()
    {
        $sql_search="";
        $select="nomor_customer as dept,nama as nama_dept";
        $order=NULL;
        $table="mst_customer";
        $results = $this->get_rows_table($sql_search,$table,$select,$order);
        return $results;
    }
    
    

    function get_mst_account()
    {
        $sql_search="";
        $select="rekening, nama_rekening";
        $order=NULL;
        $table="mst_account";
        $results = $this->get_rows_table($sql_search,$table,$select,$order);
        return $results;
    }

    function get_journalmonitor($tgl1="", $tgl2="", $akun="", $start, $limit)
    {
        $sql_search="";
        if ($search != "")
        {
            $sql_search = "(tgl_jurnal between ".$tgl1." and ".$tgl1." and akun_type = '".$akun."')";
        }
        $select="id_jurnal,nomor_jurnal,tgl_jurnal,referensi,keterangan,transaksi_cd,rekening,akun_type,jumlah,jurnal_by,jurnal_date,update_date";
        $order=array("id_jurnal", "nomor_jurnal");
        $table="acc_jurnal_umum";
        $results = $this->get_rows_paging($sql_search,$start,$limit,$table,$select,$order);
        return $results;

    }
    
    
}

?>
