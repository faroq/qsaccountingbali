<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of masterposting_biaya
 *
 * @author faroq
 */
class masterposting_biaya extends MY_Controller
{
    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('acc_masterposting','acc_mp');
    }
     public function get_rows() {
        $page = ($this->input->post('page', TRUE) ? $this->input->post('page', TRUE) : 1);
        $start = isset($_POST['start']) ? $this->db->escape_str($this->input->post('start', TRUE)) : 0;
        $limit = isset($_POST['limit']) ? $this->db->escape_str($this->input->post('limit', TRUE)) : $this->config->item("length_records");
        $search = isset($_POST['query']) ? $this->db->escape_str($this->input->post('query', TRUE)) : '';

        $result = $this->acc_mp->get_rows_mp_biaya($search, $start, $limit);
        echo $result;
    }

    public function update_rows() {
        $opt = isset($_POST['cmd']) ? $this->db->escape_str($this->input->post('cmd', TRUE)) : '';
        $kode_posting = isset($_POST['kode_posting']) ? $this->db->escape_str($this->input->post('kode_posting', TRUE)) : '';
        $dept = isset($_POST['dept']) ? $this->db->escape_str($this->input->post('dept', TRUE)) : '';        
        $nama_rekening = isset($_POST['nama_rekening']) ? $this->db->escape_str($this->input->post('nama_rekening', TRUE)) : '';
        $debet = isset($_POST['debet']) ? $this->db->escape_str($this->input->post('debet', TRUE)) : '';
        $kredit = isset($_POST['kredit']) ? $this->db->escape_str($this->input->post('kredit', TRUE)) : '';

        $param = array($opt, $dept,$kode_posting, $nama_rekening, $debet, $kredit);
        $spname = 'sp_mst_account_biaya';
        $result = $this->acc_mp->SP_execData($spname, $param, true);
        echo $result;
    }
    
    
    public function delete_row() {
        $opt = isset($_POST['cmd']) ? $this->db->escape_str($this->input->post('cmd', TRUE)) : '';
        $data = isset($_POST['postdata']) ? json_decode($this->input->post('postdata', TRUE)): array(); 
        
        $kode_posting=$data->kode_posting;
        $dept='';
        $nama_rekening='';
        $debet='';
        $kredit='';              
        
        $param = array($opt, $dept,$kode_posting, $nama_rekening, $debet, $kredit);
        $spname = 'sp_mst_account_biaya';
        $result = $this->acc_mp->SP_execData($spname, $param, true);
        echo $result;
        
    }
    
}

?>
