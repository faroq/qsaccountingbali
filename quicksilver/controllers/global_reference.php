<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class global_reference extends MY_Controller {

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
    
    public function get_plusmin()
    {
        $result = $this->global_reference_model->get_plusmin();
        echo $result;
    }

    public function get_dept()
    {
        $result = $this->global_reference_model->get_dept();
        echo $result;
    }
    public function get_mst_account()
    {
        $result = $this->global_reference_model->get_mst_account();
        echo $result;
    }
    
    public function get_report_type()
    {
        $result = $this->global_reference_model->get_report_type();
        echo $result;
    }
    
    public function get_jurnal_type()
    {
        $result = $this->global_reference_model->get_jurnal_type();
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

    public function generate_idtrx($kode)
    {        
        $result = $this->global_reference_model->callFunction('genidtrx',array($kode));
        return $result;
    }
    
    public function getthbl($thbl)
    {
        $th = substr($thbl,0,4);
        $bl = substr($thbl,4,2);
        if ($bl == '01') $bl = 'Januari';
        else if ($bl == '02') $bl = 'Februari';
        else if ($bl == '03') $bl = 'Maret';
        else if ($bl == '04') $bl = 'April';
        else if ($bl == '05') $bl = 'Mei';
        else if ($bl == '06') $bl = 'Juni';
        else if ($bl == '07') $bl = 'Juli';
        else if ($bl == '08') $bl = 'Agustus';
        else if ($bl == '09') $bl = 'September';
        else if ($bl == '10') $bl = 'Oktober';
        else if ($bl == '11') $bl = 'Nopember';
        else if ($bl == '12') $bl = 'Desember';
        return $bl.' '.$th;
    }
}

?>
