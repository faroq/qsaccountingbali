<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of cashflow_report
 *
 * @author miyzan
 */
class cashflow_report extends MY_Controller{
    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('cashflow_report_model', 'crm');
        $this->load->library('../controllers/global_reference');
    }
    
    public function get_row() {
        $search = isset($_POST['query']) ? json_decode($this->input->post('query', TRUE)) : array();

        $param = array();
        foreach ($search as $value) {
            array_push($param, $value->value);
        }
        $result = $this->crm->get_row($param[1],$param[0],'y') ;
        echo $result;
    }
    public function cashflow_pdf() {
        $search = isset($_GET['query']) ? json_decode($_GET['query']) : array();

        $param = array();
        foreach ($search as $value) {
            array_push($param, $value->value);
        }
        $result = $this->crm->get_row($param[1],$param[0],'n') ;
        $this->load_report($result, $param);
        
//        $pdf->Output();
    }
    public function load_report($result,$param){
       
//        if ($param[1] == 'on'){
//            $fungrekening='get_nama_rekening';
//            $namarekening = $this->prm->callFunction($fungrekening, array($param[5]));
//        }
        
        
        $filter1 = '';
        $filter2 = '';
        
        if ($param[1] == 'PERIODE I')
            $filter1 = 'PERIODE I : Januari '.$param[0].' s/d Juni '.$param[0];
        
        if ($param[1] == 'PERIODE II')
            $filter1 = 'PERIODE II : Juni '.$param[0].' s/d Desember '.$param[0];

                
        $this->load->library('report/cashflow_pdf');
        $this->load->config('config');
        
        $pdf=new cashflow_pdf('L', 'mm', 'A4');
        $pdf->AliasNbPages();
        $pdf->SetMargins(5, 5, 5);        
        $pdf->SetTitle('Cash Flow Report');
        $pdf->setCompany($this->config->item('company_name'), $this->config->item('company_address'));
        $pdf->setDataheader(array($filter1,$param[1]));
        $pdf->SetFont('Arial','',14);
//        $pdf->AddPage('L');
        $pdf->create_pdf($result);
        $pdf->Output("cashflowprint","I");

    }
}

?>
