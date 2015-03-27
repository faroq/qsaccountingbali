<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class acc_master_posting extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('acc_masterposting', 'mapost');
    } 

    public function get_rows()
    {
        $page   =   ($this->input->post('page', TRUE) ? $this->input->post('page', TRUE) : 1);
        $start = isset($_POST['start']) ? $this->db->escape_str($this->input->post('start', TRUE)) : 0;
        $limit = isset($_POST['limit']) ? $this->db->escape_str($this->input->post('limit', TRUE)) : $this->config->item("length_records");
        $search = isset($_POST['query']) ? $this->db->escape_str($this->input->post('query', TRUE)) : '';

        $result = $this->mapost->get_rows($search, $start, $limit);
        echo $result;
    }

    public function update_rows()
    {
        $opt = isset($_POST['cmd']) ? $this->db->escape_str($this->input->post('cmd', TRUE)) : '';

        $id = isset($_POST['jenis']) ? $this->db->escape_str($this->input->post('id', TRUE)) : '';
        $tablefrom = isset($_POST['jenis']) ? $this->db->escape_str($this->input->post('tablefrom', TRUE)) : '';
        $validation = isset($_POST['jenis']) ? $this->db->escape_str($this->input->post('validation', TRUE)) : '';
        $isselisih = isset($_POST['jenis']) ? $this->db->escape_str($this->input->post('isselisih', TRUE)) : '';
        $debet = isset($_POST['jenis']) ? $this->db->escape_str($this->input->post('deber', TRUE)) : '';
        $kredit = isset($_POST['jenis']) ? $this->db->escape_str($this->input->post('kredit', TRUE)) : '';
        $akun_selisih = isset($_POST['jenis']) ? $this->db->escape_str($this->input->post('akun_selisih', TRUE)) : '';
        
        $param=array($opt,$id,$tablefrom,$validation,$isselisih,$debet,$kredit,$akun_selisih);
        $spname='sp_acc_master_posting';
        $result = $this->mapost->SP_execData($spname, $param, true);
        echo $result;
        
    }
    
    public function delete_row()
    {
        $opt = isset($_POST['cmd']) ? $this->db->escape_str($this->input->post('cmd', TRUE)) : '';
        $id = isset($_POST['postdata']) ? json_decode($this->input->post('postdata', TRUE)): array();
        $tablefrom = ' ';
        $validation = ' ';
        $isselisih = ' ';
        $debet = ' ';
        $kredit = ' ';
        $akun_selisih = ' ';
        
        $param=array($opt,$id,$tablefrom,$validation,$isselisih,$debet,$kredit,$akun_selisih);
        $spname='sp_acc_master_posting';
        $result = $this->mapost->SP_execData($spname, $param, true);
        echo $result;
        
    }
}

?>
