<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of jurnal_monitor
 *
 * @author faroq
 */
class jurnal_monitor extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('base_model', 'jm_model');
        $this->load->library('../controllers/global_reference');

    } 
    function get_row_monitor(){
        $page   =   ($this->input->post('page', TRUE) ? $this->input->post('page', TRUE) : 1);            
        $start = isset($_POST['start']) ? $this->db->escape_str($this->input->post('start', TRUE)) : 0;
        $limit = isset($_POST['limit']) ? $this->db->escape_str($this->input->post('limit', TRUE)) : $this->config->item("length_records");
//        $search = isset($_POST['query']) ? $this->db->escape_str($this->input->post('query', TRUE)) : '';
        $search =isset($_POST['query']) ? json_decode($this->input->post('query', TRUE)): array(); 
        $sql_search="";
        if (count($search) > 0) {
            foreach ($search as $v) {
//                echo $v->name;
                if($v->name == 'tgl_awal'){
                   $sql_search=$sql_search."tgl_jurnal between '".$v->value."'";
                }
                if($v->name == 'tgl_akhir'){
                    $sql_search=$sql_search." and '".$v->value."'";
                }
                if($v->name == 'referensi' || $v->name == 'keterangan'){
                    if(strlen($sql_search) > 0){
                       $sql_search= $sql_search." and ".$v->name." like '%".$v->value."%'";
                    }
                    if(strlen($sql_search) == 0){
                        $sql_search=$v->name." like '%".$v->value."%'";
                    }
                    
                }
                if($v->name == 'rekening'){
                    if(strlen($sql_search)> 0){
                        $sql_search=$sql_search." and ".$v->name." = '".$v->value."'";
                    }
                    if(strlen($sql_search)== 0){
                        $sql_search=$v->name." = '".$v->value."'";
                    }
                    
                }
            }
        }
        $select="id_jurnal,nomor_jurnal,tgl_jurnal,referensi,keterangan,rekening,nama_rekening,debet,kredit,transaksi_cd,jurnal_by,jurnal_date";        
        $order=array("id_jurnal", "asc");     
        $table="v_jurnal_monitor";    
//        echo $sql_search;
        $result = $this->jm_model->get_rows_paging($sql_search,$start,$limit,$table,$select,$order);
        echo $result;
    }
    
//   function get_row
    //put your code here
}

?>
