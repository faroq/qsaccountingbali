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
        $query=null;
        if($search){
            $query=$search;
        }
//        $search = isset($_POST['search']) ? $this->db->escape_str($this->input->post('search', TRUE)) : '';
        $result = $this->macc_model->get_kelompok($query);
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

    function create_pdf()
    {        
        /*$pdf=new FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial','B',16);
        $pdf->Cell(40,10,'Hello World!');
        $pdf->Output();*/

        //Instanciation of inherited class
        $pdf=new PDF();
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->SetFont('Times','',12);
        for($i=1;$i<=40;$i++)
                $pdf->Cell(0,10,'Printing line number '.$i,0,1);
        $pdf->Output();


        /*$pdf=new PDF();
        //Column titles
        $header=array('Country','Capital','Area (sq km)','Pop. (thousands)');
        //Data loading
        $data=$pdf->LoadData('countries.txt');
        $pdf->SetFont('Arial','',14);
        $pdf->AddPage();
        $pdf->BasicTable($header,$data);
        $pdf->AddPage();
        $pdf->ImprovedTable($header,$data);
        $pdf->AddPage();
        $pdf->FancyTable($header,$data);
        $pdf->Output();*/

    }
}

?>
