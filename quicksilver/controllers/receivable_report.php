<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of receivable_report
 *
 * @author miyzan
 */
class receivable_report extends MY_Controller {
    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('receivable_report_model', 'rrm');
        $this->load->library('../controllers/global_reference');
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

        $result = $this->rrm->get_report_account($search, $start, $limit);
        echo $result;
    }
    
    public function get_row_d() {
        $search = isset($_POST['query']) ? json_decode($this->input->post('query', TRUE)) : array();

        $param = array();
        foreach ($search as $value) {
            array_push($param, $value->value);
        }
        $spname = 'sp_receivable_d';
        $result = $this->rrm->SP_getData($spname, $param);      
//        echo '{success:true,record:1,data:[]}';
        echo $result;
    }
    
    public function receivable_d_pdfA3() {
        $search = isset($_GET['query']) ? json_decode($_GET['query']) : array();

        $param = array();
        foreach ($search as $value)
        {
            array_push($param, $value->value);
            //echo $value->value.'<br>';
        }
        $spname = 'sp_receivable_d';
        $result = $this->rrm->SP_getData($spname, $param);

        $result = substr($result, 0, strpos($result, ']')+1);
        $result = substr($result, strpos($result, '['));
        
        if ($param[1] == 'on'){
            $fungrekening='get_nama_rekening';
            $namarekening = $this->rrm->callFunction($fungrekening, array($param[5]));
        }
        
        $this->load->library('report/receivable_pdf');
        $this->load->config('config');
        
//        $pdf = new DaftarSiswaPerkelas('P', 'mm', 'A4');
        $pdf=new receivable_pdf('L', 'mm', 'A3');
        $pdf->AliasNbPages();
        $pdf->SetMargins(10, 10, 10);        
        $pdf->SetTitle('Receivable Report');
        $pdf->setCompany($this->config->item('company_name'), $this->config->item('company_address'));

        $filter1 = '';
        $filter2 = '';
        
        if ($param[0] == 'bln')
//            $gf=new global_reference();
            $filter1 = 'Bulan : '.$this->global_reference->getthbl($param[2]);
        else
            $filter1 = 'Tanggal : '.$param[3].' s/d '.$param[4];

        if ($param[1] == 'off')
            $filter2 = 'Semua Rekening';
//            $filter2 = 'Semua Rekening';
        else
            $filter2 = $param[5].' '.$namarekening[0]->retval;
//            $filter2 = 'Rekening : '.$param[5].' '.$namarekening[0]->retval;
        $pdf->setDataheader(array($filter1,$filter2));
        $pdf->SetFont('Arial','',14);
        $pdf->AddPage('L');
        $pdf->create_pdf($filter1, $filter2, $result);
        $pdf->Output("receivableprint","I");
//        $pdf->Output();
    }
}

?>
