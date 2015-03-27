<?php

//if (!defined('BASEPATH'))
//    exit('No direct script access allowed');
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of acc_master_posting_account
 *
 * @author faroq
 */
class masterposting_account extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('acc_masterposting', 'acc_mp');
    }

    public function get_rows() {
        $page = ($this->input->post('page', TRUE) ? $this->input->post('page', TRUE) : 1);
        $start = isset($_POST['start']) ? $this->db->escape_str($this->input->post('start', TRUE)) : 0;
        $limit = isset($_POST['limit']) ? $this->db->escape_str($this->input->post('limit', TRUE)) : $this->config->item("length_records");
        $search = isset($_POST['query']) ? $this->db->escape_str($this->input->post('query', TRUE)) : '';

        $result = $this->acc_mp->get_rows_mp($search, $start, $limit);
        echo $result;
    }

    public function update_rows() {
        $opt = isset($_POST['cmd']) ? $this->db->escape_str($this->input->post('cmd', TRUE)) : '';
        $kode_posting = isset($_POST['kode_posting']) ? $this->db->escape_str($this->input->post('kode_posting', TRUE)) : '';
        $memorial = isset($_POST['memorial']) ? $this->db->escape_str($this->input->post('memorial', TRUE)) : '';
        $dk = isset($_POST['dk']) ? $this->db->escape_str($this->input->post('dk', TRUE)) : '';
        $nama_posting = isset($_POST['nama_posting']) ? $this->db->escape_str($this->input->post('nama_posting', TRUE)) : '';
        $rekening_debet = isset($_POST['rekening_debet']) ? $this->db->escape_str($this->input->post('rekening_debet', TRUE)) : '';
        $rekening_kredit = isset($_POST['rekening_kredit']) ? $this->db->escape_str($this->input->post('rekening_kredit', TRUE)) : '';

        $param = array($opt, $kode_posting, $memorial, $dk, $nama_posting,$rekening_debet,$rekening_kredit);
        $spname = 'sp_mst_account_posting';
        $result = $this->acc_mp->SP_execData($spname, $param, true);
        echo $result;
    }
    
    
    public function delete_row() {
        $opt = isset($_POST['cmd']) ? $this->db->escape_str($this->input->post('cmd', TRUE)) : '';
        $data = isset($_POST['postdata']) ? json_decode($this->input->post('postdata', TRUE)): array(); 
        
        $kode_posting=$data->kode_posting;
        $memorial='';
        $dk='';
        $nama_posting='';
        $rekening_debet='';
        $rekening_kredit='';         
        
        $param = array($opt, $kode_posting, $memorial, $dk, $nama_posting,$rekening_debet,$rekening_kredit);
        $spname = 'sp_mst_account_posting';
        $result = $this->acc_mp->SP_execData($spname, $param, true);
        echo $result;
        
    }

}

?>
