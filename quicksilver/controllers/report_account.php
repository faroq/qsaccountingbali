<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of report_account
 *
 * @author miyzan
 */
class report_account extends MY_Controller {
    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('report_account_model', 'ra_model');
//        $this->load->library('../controllers/global_reference');
    }
    
    public function get_rows() {
//        $start  =   ($this->input->post('start', TRUE) ? $this->input->post('start', TRUE) : 0);
        $page   =   ($this->input->post('page', TRUE) ? $this->input->post('page', TRUE) : 1);
//        $limit  =   ($this->input->post('limit', TRUE) ? $this->input->post('limit', TRUE) : 10);
            
        $start = isset($_POST['start']) ? $this->db->escape_str($this->input->post('start', TRUE)) : 0;
        $limit = isset($_POST['limit']) ? $this->db->escape_str($this->input->post('limit', TRUE)) : $this->config->item("length_records");
        $search = isset($_POST['query']) ? $this->db->escape_str($this->input->post('query', TRUE)) : '';

        $result = $this->ra_model->get_rows($search, $start, $limit);
        echo $result;
    }
    
    public function update_rows() {
        $opt = isset($_POST['cmd']) ? $this->db->escape_str($this->input->post('cmd', TRUE)) : '';
        $id = isset($_POST['id']) ? $this->db->escape_str($this->input->post('id', TRUE)) : '';
        $report_type = isset($_POST['report_type']) ? $this->db->escape_str($this->input->post('report_type', TRUE)) : '';
        $rekening = isset($_POST['rekening']) ? $this->db->escape_str($this->input->post('rekening', TRUE)) : '';
        
        
        $param=array($opt,$id,$report_type,$rekening);
        $spname='sp_mst_report_account';
        $result = $this->ra_model->SP_execData($spname, $param, true);
        echo $result;
        
    }
    
    public function delete_row() {
        $opt = isset($_POST['cmd']) ? $this->db->escape_str($this->input->post('cmd', TRUE)) : '';
        $data = isset($_POST['postdata']) ? json_decode($this->input->post('postdata', TRUE)): array(); 
        
        $id=$data->id;
        $report_type=$data->report_type;
        $rekening=$data->rekening;
        
        
        $param=array($opt,$id,$report_type,$rekening);
        $spname='sp_mst_report_account';
        $result = $this->ra_model->SP_execData($spname, $param, true);
//        $json = array(
//                    "success" => true,
//                    "msg" => $rekening
//                );
//        $result= json_encode($json);
        echo $result;
        
    }
    
}

?>
