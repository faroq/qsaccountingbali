<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of master_cashflow
 *
 * @author miyzan
 */
class master_cashflow extends MY_Controller{
    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('acc_mastercashflow', 'mcf');
    }
    
    public function get_rows() {
        $page = ($this->input->post('page', TRUE) ? $this->input->post('page', TRUE) : 1);
        $start = isset($_POST['start']) ? $this->db->escape_str($this->input->post('start', TRUE)) : 0;
        $limit = isset($_POST['limit']) ? $this->db->escape_str($this->input->post('limit', TRUE)) : $this->config->item("length_records");
        $search = isset($_POST['query']) ? $this->db->escape_str($this->input->post('query', TRUE)) : '';

        $result = $this->mcf->get_rows($search, $start, $limit);
        echo $result;
    }
    
    public function update_rows() {
        $opt = isset($_POST['cmd']) ? $this->db->escape_str($this->input->post('cmd', TRUE)) : '';
        $id = isset($_POST['id']) ? $this->db->escape_str($this->input->post('id', TRUE)) : '';
        $idformat = isset($_POST['idformat']) ? $this->db->escape_str($this->input->post('idformat', TRUE)) : '';        
        $rekening_debet = isset($_POST['rekening_debet']) ? $this->db->escape_str($this->input->post('rekening_debet', TRUE)) : '';
        $rekening_kredit = isset($_POST['rekening_kredit']) ? $this->db->escape_str($this->input->post('rekening_kredit', TRUE)) : '';

        $param = array($opt, $id,  $idformat,$rekening_debet,$rekening_kredit);
        $spname = 'sp_mst_cashflow';
        $result = $this->mcf->SP_execData($spname, $param, true);
        echo $result;
    }
    
    
    public function delete_row() {
        $opt = isset($_POST['cmd']) ? $this->db->escape_str($this->input->post('cmd', TRUE)) : '';
        $data = isset($_POST['postdata']) ? json_decode($this->input->post('postdata', TRUE)): array(); 
        
        $id=$data->id;                
        $idformat='';
        $rekening_debet='';
        $rekening_kredit='';         
        
        $param = array($opt, $id, $idformat,$rekening_debet,$rekening_kredit);
        $spname = 'sp_mst_cashflow';
        $result = $this->mcf->SP_execData($spname, $param, true);
        echo $result;
        
    }
    
    //=============================================
    
    public function get_rows_format() {
        $page = ($this->input->post('page', TRUE) ? $this->input->post('page', TRUE) : 1);
        $start = isset($_POST['start']) ? $this->db->escape_str($this->input->post('start', TRUE)) : 0;
        $limit = isset($_POST['limit']) ? $this->db->escape_str($this->input->post('limit', TRUE)) : $this->config->item("length_records");
        $search = isset($_POST['query']) ? $this->db->escape_str($this->input->post('query', TRUE)) : '';

        $result = $this->mcf->get_rows_format($search, $start, $limit);
        echo $result;
    }
    
    public function update_rows_format() {
        $opt = isset($_POST['cmd']) ? $this->db->escape_str($this->input->post('cmd', TRUE)) : '';
        $id = isset($_POST['id']) ? $this->db->escape_str($this->input->post('id', TRUE)) : '';
        $keterangan = isset($_POST['keterangan']) ? $this->db->escape_str($this->input->post('keterangan', TRUE)) : '';
        $mutasi = isset($_POST['mutasi']) ? $this->db->escape_str($this->input->post('mutasi', TRUE)) : '';
        
        $param = array($opt, $id,  $keterangan,$mutasi);
        $spname = 'sp_mst_cashflow_format';
        $result = $this->mcf->SP_execData($spname, $param, true);
        echo $result;
    }
    
    
    public function delete_row_format() {
        $opt = isset($_POST['cmd']) ? $this->db->escape_str($this->input->post('cmd', TRUE)) : '';
        $data = isset($_POST['postdata']) ? json_decode($this->input->post('postdata', TRUE)): array(); 
        
        $id=$data->id;        
        $mutasi='';
        $keterangan='';
                
        
        $param = array($opt, $id, $keterangan,$mutasi);
        $spname = 'sp_mst_cashflow_format';
        $result = $this->mcf->SP_execData($spname, $param, true);
        echo $result;
        
    }
    
    public function get_cashflowformat()
    {
        $result = $this->mcf->get_cashflowformat();
        echo $result;
    }
}

?>
