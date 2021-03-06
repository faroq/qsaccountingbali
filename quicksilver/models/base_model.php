<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of base_model
 *
 * @author faroq
 */
class base_model extends MY_MODEL {

    //put your code here
    function __construct() {
        parent::__construct();
    }

    //put your code here

    public function get_account_kelompok($jenis = null) {
        $query = null;
        $this->db->select('kelompok,nama_kelompok,jenis,nama_jenis');
        if ($jenis) {
            $this->db->where_in('jenis', $jenis);
        }
        $this->db->group_by('kelompok,nama_kelompok,jenis,nama_jenis');
        $this->db->order_by('jenis asc,kelompok asc');
        $query = $this->db->get('v_mst_account');
        return $query->result();
    }
    
    public function get_account_level1($jenis = null) {
        $query = null;
        $this->db->select('kelompok,nama_kelompok,jenis,nama_jenis');
        $this->db->where('kode_asosiasi','' );        
        if ($jenis) {
            $this->db->where_in('jenis', $jenis);
        }
        $this->db->group_by('kelompok,nama_kelompok,jenis,nama_jenis');
        $this->db->order_by('jenis asc,kelompok asc');
        $query = $this->db->get('v_mst_account_kel');
        return $query->result();
    }
    
    public function get_accountincs_level1($jenis = null) {
        $query = null;
        $this->db->select('kelompok,nama_kelompok,jenis,nama_jenis');
        $this->db->where('kode_asosiasi','' );   
        $this->db->where('rugilaba',true );   
        if ($jenis) {
            $this->db->where_in('jenis', $jenis);
        }
        $this->db->group_by('kelompok,nama_kelompok,jenis,nama_jenis');
        $this->db->order_by('jenis asc,kelompok asc');
        $query = $this->db->get('v_mst_account_kel');
        return $query->result();
    }
    
    

    public function get_trialbalance_child($thbl) {
        $param = array($thbl);
        $result = $this->SP_getData_array('sp_trialbalance', $param);

        return $result;
    }
    
    public function get_trialbalance_child_header($thbl) {
        $param = array($thbl);
        $result = $this->SP_getData_array('sp_trialbalance_header', $param);

        return $result;
    }
    public function get_trialbalance_child_header_l1($thbl) {
        $param = array($thbl);
        $result = $this->SP_getData_array('sp_trialbalance_header_1', $param);

        return $result;
    }
    

    public function get_incomestatement_child($thbl) {
        $param = array($thbl);

        $result = $this->SP_getData_array('sp_incomestatement_new', $param);

        return $result;
    }
    
    public function get_incomestatement_child_header($thbl) {
        $param = array($thbl);

        $result = $this->SP_getData_array('sp_incomestatement_h', $param);

        return $result;
    }
    public function get_incomestatement_child_lv1($thbl) {
        $param = array($thbl);

        $result = $this->SP_getData_array('sp_incomestatement_lv1', $param);

        return $result;
    }

    public function get_balancesheet_child($thbl,$dk) {
        $param = array($thbl,$dk);
        $result = $this->SP_getData_array('sp_balancesheet_new', $param);

        return $result;
    }
    
    public function get_balancesheet_child_h($thbl,$dk) {
        $param = array($thbl,$dk);
        $result = $this->SP_getData_array('sp_balancesheet_h', $param);

        return $result;
    }
    public function get_balancesheet_child_lv1($thbl,$dk) {
        $param = array($thbl,$dk);
        $result = $this->SP_getData_array('sp_balancesheet_lv1', $param);

        return $result;
    }

    public function get_max_jenis_account() {
        $this->db->select_max('jenis');
        $query = $this->db->get('acc_jenisaccount');
        $retval = $query->result();
        return $retval[0]->jenis;
    }

}

?>
