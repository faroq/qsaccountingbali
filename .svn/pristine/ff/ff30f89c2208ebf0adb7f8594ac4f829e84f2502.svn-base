<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class mst_account_kel extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('mst_accountkel', 'makel');
    } 

    public function get_rows()
    {
        $page   =   ($this->input->post('page', TRUE) ? $this->input->post('page', TRUE) : 1);
        $start = isset($_POST['start']) ? $this->db->escape_str($this->input->post('start', TRUE)) : 0;
        $limit = isset($_POST['limit']) ? $this->db->escape_str($this->input->post('limit', TRUE)) : $this->config->item("length_records");
        $search = isset($_POST['query']) ? $this->db->escape_str($this->input->post('query', TRUE)) : '';

        $result = $this->makel->get_rows($search, $start, $limit);
        echo $result;
    }

    public function update_rows()
    {
        $opt = isset($_POST['cmd']) ? $this->db->escape_str($this->input->post('cmd', TRUE)) : '';
        $jenis = isset($_POST['jenis']) ? $this->db->escape_str($this->input->post('jenis', TRUE)) : '';
        $dk = isset($_POST['dk']) ? $this->db->escape_str($this->input->post('dk', TRUE)) : '';
        $kelompok = isset($_POST['kelompok']) ? $this->db->escape_str($this->input->post('kelompok', TRUE)) : '';
        $nama_kelompok = isset($_POST['nama_kelompok']) ? $this->db->escape_str($this->input->post('nama_kelompok', TRUE)) : '';
        $kode_asosiasi = isset($_POST['kode_asosiasi']) ? $this->db->escape_str($this->input->post('kode_asosiasi', TRUE)) : '';
        $nilai = isset($_POST['nilai']) ? $this->db->escape_str($this->input->post('nilai', TRUE)) : '';
        $flag = isset($_POST['flag']) ? $this->db->escape_str($this->input->post('flag', TRUE)) : '';
        
        $param=array($opt,$jenis,$dk,$kelompok,$nama_kelompok,$kode_asosiasi,$nilai,);
        $spname='sp_mst_account_kel';
        $result = $this->makel->SP_execData($spname, $param, true);
        echo $result;
        
    }
    
    public function delete_row()
    {
        $opt = isset($_POST['cmd']) ? $this->db->escape_str($this->input->post('cmd', TRUE)) : '';
        $data = isset($_POST['postdata']) ? json_decode($this->input->post('postdata', TRUE)): array(); 
        $jenis = ' ';
        $dk = ' ';
        $kelompok=$data->kelompok;
        $nama_kelompok = ' ';
        $kode_asosiasi = ' ';
        $nilai = ' ';
        $flag = ' ';
        
        $param=array($opt,$jenis,$dk,$kelompok,$nama_kelompok,$kode_asosiasi,$nilai,);
        $spname='sp_mst_account_kel';
        $result = $this->makel->SP_execData($spname, $param, true);
        echo $result;
        
    }
}

?>
