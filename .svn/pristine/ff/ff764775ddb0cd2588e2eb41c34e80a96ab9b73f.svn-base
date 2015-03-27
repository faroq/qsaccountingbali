<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of entry_jurnal
 *
 * @author faroq
 */
class entry_jurnal extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('entry_jurnal_model', 'ej_model');
        $this->load->library('../controllers/global_reference');

    } 

    public function update_rows() {
        $opt = isset($_POST['cmd']) ? $this->db->escape_str($this->input->post('cmd', TRUE)) : '';                
        $tgl_jurnal=isset($_POST['tgl_jurnal']) ? $this->db->escape_str($this->input->post('tgl_jurnal', TRUE)) : FALSE;  
        $referensi = isset($_POST['referensi']) ? $this->db->escape_str($this->input->post('referensi', TRUE)) : '';
        $keterangan = isset($_POST['keterangan']) ? $this->db->escape_str($this->input->post('keterangan', TRUE)) : '';
        $data = isset($_POST['postdata']) ? json_decode($this->input->post('postdata', TRUE)): array(); 
        $jurnal_by = $this->session->userdata('username');
        
        $row=  $this->global_reference->generate_idtrx('EJ');
        $vnomor_entry=$row[0]->retval;
        
        
        $param=array($opt,$vnomor_entry,$tgl_jurnal,$referensi,$keterangan,$jurnal_by);
        $spname='sp_jurnalentry_h';
        $result = $this->ej_model->SP_execData($spname, $param, true);
        
//        $data=json_decode('[{"rekening":"1110.30","nama_rekening":"kas ws (rupiah)","debet":0,"kredit":100},{"rekening":"1110.21","nama_rekening":"kas ssa (valas)","debet":100,"kredit":0}]');
        foreach($data as $r){
            $param=array($vnomor_entry,$r->rekening,$r->debet,$r->kredit);
            $spname='sp_jurnalentry_d';
            $retval=$this->ej_model->SP_execData($spname, $param, true);
        }
        
        echo $result;
        
    }
    public function get_row_approval() {

        $page   =   ($this->input->post('page', TRUE) ? $this->input->post('page', TRUE) : 1);            
        $start = isset($_POST['start']) ? $this->db->escape_str($this->input->post('start', TRUE)) : 0;
        $limit = isset($_POST['limit']) ? $this->db->escape_str($this->input->post('limit', TRUE)) : $this->config->item("length_records");
        $search = isset($_POST['query']) ? $this->db->escape_str($this->input->post('query', TRUE)) : '';

        $result = $this->ej_model->get_row_approval($search, $start, $limit);
        echo $result;
    }
    
    public function get_row_approval_detail() {        
        $search = isset($_POST['query']) ? $this->db->escape_str($this->input->post('query', TRUE)) : '';
        $result = $this->ej_model->get_row_approval_detail($search);
        echo $result;
    }
    
    public function approval_entryjurnal() {        
        $approval_status = isset($_POST['status']) ? $this->db->escape_str($this->input->post('status', TRUE)) : '';
        $data =isset($_POST['postdata']) ? json_decode($this->input->post('postdata', TRUE)): array(); 
        $approval_by = $this->session->userdata('username');
        $retval='';
        foreach($data as $r){
            $param=array($r->nomor_entry,$approval_by,$approval_status);
            $spname='sp_approval_jurnal_entry';
            $retval=$this->ej_model->SP_execData($spname, $param, false);
        }        
        echo $retval;
    }
    

}

?>
