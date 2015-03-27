<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of payable_report
 *
 * @author miyzan
 */
class payable_report extends MY_Controller{
    public function __construct() {
        parent::__construct();
        $this->load->model('payable_report_model', 'prm');
//        $this->load->library('../controllers/global_reference');
    }
    //put your code here
    
    public function get_report_account()
    {
        //        $start  =   ($this->input->post('start', TRUE) ? $this->input->post('start', TRUE) : 0);
        $page   =   ($this->input->post('page', TRUE) ? $this->input->post('page', TRUE) : 1);
//        $limit  =   ($this->input->post('limit', TRUE) ? $this->input->post('limit', TRUE) : 10);
            
        $start = isset($_POST['start']) ? $this->db->escape_str($this->input->post('start', TRUE)) : 0;
        $limit = isset($_POST['limit']) ? $this->db->escape_str($this->input->post('limit', TRUE)) : $this->config->item("length_records");
        $search = isset($_POST['query']) ? $this->db->escape_str($this->input->post('query', TRUE)) : '';

        $result = $this->prm->get_report_account($search, $start, $limit);
        echo $result;
    }
    
    public function get_row_d() {
        $search = isset($_POST['query']) ? json_decode($this->input->post('query', TRUE)) : array();

        $param = array();
        foreach ($search as $value) {
            array_push($param, $value->value);
        }
        $spname = 'sp_payable_d';
        $result = $this->prm->SP_getData($spname, $param);      
//        echo '{success:true,record:1,data:[]}';
        echo $result;
    }
}

?>
