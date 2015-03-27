<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class masteraccount extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('masteraccount_model', 'macc_model');
    } 

    public function get_rows() {
//        $start  =   ($this->input->post('start', TRUE) ? $this->input->post('start', TRUE) : 0);
        $page   =   ($this->input->post('page', TRUE) ? $this->input->post('page', TRUE) : 1);
//        $limit  =   ($this->input->post('limit', TRUE) ? $this->input->post('limit', TRUE) : 10);
            
        $start = isset($_POST['start']) ? $this->db->escape_str($this->input->post('start', TRUE)) : 0;
        $limit = isset($_POST['limit']) ? $this->db->escape_str($this->input->post('limit', TRUE)) : $this->config->item("length_records");
        $search = isset($_POST['query']) ? $this->db->escape_str($this->input->post('query', TRUE)) : '';

        $result = $this->macc_model->get_rows($search, $start, $limit);
        echo $result;
    }
    
    public function get_jenis() {
        $result = $this->macc_model->get_jenis();
        echo $result;
    }
    
    public function get_kelompok($search) {
//        $search = isset($_POST['search']) ? $this->db->escape_str($this->input->post('search', TRUE)) : '';
        $result = $this->macc_model->get_kelompok($search);
        echo $result;
    }
    
    
    public function update_rows() {
        $opt = isset($_POST['cmd']) ? $this->db->escape_str($this->input->post('cmd', TRUE)) : '';
        $jenis = isset($_POST['jenis']) ? $this->db->escape_str($this->input->post('jenis', TRUE)) : '';
        $kelompok = isset($_POST['kelompok']) ? $this->db->escape_str($this->input->post('kelompok', TRUE)) : '';
        $rekening = isset($_POST['rekening']) ? $this->db->escape_str($this->input->post('rekening', TRUE)) : '';
        $namarekening = isset($_POST['nama_rekening']) ? $this->db->escape_str($this->input->post('nama_rekening', TRUE)) : '';
        
        $param=array($opt,$rekening,$namarekening,$kelompok,$jenis);
        $spname='sp_mstaccount';
        $result = $this->macc_model->SP_execData($spname, $param, true);
        echo $result;
        
    }
    
    public function delete_row() {
        $opt = isset($_POST['cmd']) ? $this->db->escape_str($this->input->post('cmd', TRUE)) : '';
//        $data = isset($_POST['postdata']) ? $this->db->escape_str($this->input->post('postdata', TRUE)) : '';
        $data = isset($_POST['postdata']) ? json_decode($this->input->post('postdata', TRUE)): array(); 
//        $data='{"rekening":"1110.10","nama_rekening":"kas cbb (rupiah)"}';
//        $datain = json_decode($data);
        $rekening=$data->rekening;
        $namarekening=' ';
        $kelompok=' ';
        $jenis=' ';
        
        $param=array($opt,$rekening,$namarekening,$kelompok,$jenis);
        $spname='sp_mstaccount';
        $result = $this->macc_model->SP_execData($spname, $param, true);
//        $json = array(
//                    "success" => true,
//                    "msg" => $rekening
//                );
//        $result= json_encode($json);
        echo $result;
        
    }
    
}

?>
