<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class global_reference extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('global_reference_model', 'global_reference_model');
    } 
    
    public function get_jenis()
    {
        $result = $this->global_reference_model->get_jenis();
        echo $result;
    }

    public function get_dk()
    {
        $result = $this->global_reference_model->get_dk();
        echo $result;
    }

    public function get_mst_account()
    {
        $result = $this->global_reference_model->get_mst_account();
        echo $result;
    }

    public function rep_journalmonitor()
    {
        $page   =   ($this->input->post('page', TRUE) ? $this->input->post('page', TRUE) : 1);
        $start = isset($_POST['start']) ? $this->db->escape_str($this->input->post('start', TRUE)) : 0;
        $limit = isset($_POST['limit']) ? $this->db->escape_str($this->input->post('limit', TRUE)) : $this->config->item("length_records");
        $tgl1 = isset($_POST['tgl1']) ? $this->db->escape_str($this->input->post('tgl1', TRUE)) : '';
        $tgl2 = isset($_POST['tgl2']) ? $this->db->escape_str($this->input->post('tgl2', TRUE)) : '';
        $akun = isset($_POST['akun']) ? $this->db->escape_str($this->input->post('akun', TRUE)) : '';
        $result = $this->global_reference_model->get_journalmonitor($tgl1="", $tgl2="", $akun="", $start, $limit);
        echo $result;
    }

}

?>
