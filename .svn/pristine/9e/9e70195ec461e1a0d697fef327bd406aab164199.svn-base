<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of income_statement
 *
 * @author faroq
 */
class income_statement extends MY_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('base_model', 'bm');
//        $this->load->library('../controllers/global_reference');
    }

    public function get_child($findhead, $child, $level) {
        $resArr = array();
        foreach ($child as $c) {
            if ($c->kelompok == $findhead) {
                $levelt = $level + 1;
                array_push($resArr, array(
                    'jenis' => $c->jenis . '-' . $c->nama_jenis,
                    'nama_jenis' => NULL,
                    'rekening' => $c->rekening . '-' . $c->nama_rekening,
                    'thbl_t' => $c->saldo_t, 'thbl' => $c->saldo,
                    'cls' => NULL));
            }
        }
        return $resArr;
    }

    public function get_max_incs($head, $child, $thbl, $thbl_t) {
        $resArr = array();
        $level = 0;
        $jenis = '';
        $nama_jenis = '';
        if (count($head) == 0) {
            return $resArr;
        }
        $total = 0;
        $total_t = 0;

        $total_last = 0;
        $total_t_last = 0;
        foreach ($head as $h) {
            if ($jenis != $h->jenis) {
                if ($jenis != '') {
                    array_push($resArr, array(
                        'jenis' => $jenis . '-' . $nama_jenis,
                        'nama_jenis' => 'TOTAL ' . $nama_jenis,
                        'rekening' => NULL,
                        'thbl_t' => $total_t, 'thbl' => $total,
                        'cls' => 'x-incs-header'));
                    $total = 0;
                    $total_t = 0;
                }
                $jenis = $h->jenis;
                $nama_jenis = $h->nama_jenis;
                array_push($resArr, array(
                    'jenis' => $h->jenis . '-' . $h->nama_jenis,
                    'nama_jenis' => $h->nama_jenis,
                    'rekening' => NULL,
                    'thbl_t' => $thbl_t, 'thbl' => $thbl,
                    'cls' => 'x-incs-header'));
            }
            $arrch = $this->get_child($h->kelompok, $child, $level);
            array_push($resArr, array(
                'jenis' => $h->jenis . '-' . $h->nama_jenis,
                'nama_jenis' => NULL,
                'rekening' => $h->kelompok . '-' . $h->nama_kelompok,
                'thbl_t' => NULL, 'thbl' => NULL,
                'cls' => 'x-hira-header'));
            if (count($arrch) > 0) {
                foreach ($arrch as $v) {
                    $total_t =$total_t+ $v['thbl_t'];
                    $total =$total+ $v['thbl'];
                    
                    array_push($resArr, $v);
                }
            }
            $level = 0;
        }

        array_push($resArr, array(
            'jenis' => $jenis . '-' . $nama_jenis,
            'nama_jenis' => 'TOTAL ' . $nama_jenis,
            'rekening' => NULL,
            'thbl_t' => $total_t, 'thbl' => $total,
            'cls' => 'x-incs-header'));
        
        $jenis = $jenis . '-' . $nama_jenis;
        foreach ($resArr as $v) {
            if (!$v['cls']) {
                if($v['jenis']!=$jenis){
                    
                    $total_t_last =$total_t_last+ $v['thbl_t'];
                    $total_last = $total_last+$v['thbl'];
                }
                
            }
        }
        $max=$this->get_max_jenis_account();
        $total_t_last=$total_t_last-$total_t;
        $total_last=$total_last-$total;
               
//        echo $total_last;
        array_push($resArr, array(
            'jenis' => $max+1 . '-' . 'TOTAL INCOME',
            'nama_jenis' => 'TOTAL INCOME',
            'rekening' => NULL,
            'thbl_t' => $total_t_last, 'thbl' =>$total_last,
            'cls' => 'x-incs-header'));
        return $resArr;
    }

    public function get_rows() {
        $thbl = isset($_POST['thbl']) ? json_decode($this->input->post('thbl', TRUE)) : null;
        $head = $this->bm->get_account_kelompok(array(4, 5));
        $child = $this->bm->get_incomestatement_child($thbl);
        $thbl_t = $this->get_periodeadd_thbl($thbl, -1);

        $result = array();
        $result = $this->get_max_incs($head, $child, $thbl, $thbl_t);
        $total = count($result);
        echo '{success:true,record:' . $total . ',data:' . json_encode($result) . '}';
    }

    public function get_max_jenis_account() {
        return $this->bm->get_max_jenis_account();
    }

    public function get_periodeadd_thbl($thbl = null, $ival = 0) {
        $result = $this->bm->callFunction('period_add', array($thbl, $ival));
        if(count($result)){
            return $result[0]->retval;
        }else{
            return 0;
        }
        
//        period_add(vthbl,-1)
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
    
    public function instat_pdf()
    {
        $thbl = isset($_GET['thbl']) ? json_decode($_GET['thbl']) : null;
        $head = $this->bm->get_account_kelompok(array(4, 5));
        $child = $this->bm->get_incomestatement_child($thbl);
        $thbl_t = $this->get_periodeadd_thbl($thbl, -1);

        $result = array();
        $result = $this->get_max_incs($head, $child, $thbl, $thbl_t);
        //$total = count($result);
        //echo '{success:true,record:' . $total . ',data:' . json_encode($result) . '}';
        //
        //echo $thbl.' '.$head.' '.$child.' '.$result;
        //$total = count($result);
        //echo '{success:true,record:' . $total . ',data:' . json_encode($result) . '}';


        $pdf=new instat_pdf();
        $pdf->AliasNbPages();

        //$pdf->SetAuthor('Arief Himawan');
        $pdf->SetTitle('Income Statemen');

        //Column titles

        //echo date("d-m-Y H:i:s");

        //Data loading
        //$data=$pdf->LoadData('countries.txt');
        $pdf->SetFont('Arial','',14);
        $pdf->AddPage('P');
        //$pdf->BasicTable($header,$result);
        //$pdf->AddPage();
        //$pdf->ImprovedTable($header,$result);
        //$pdf->AddPage();
        //echo json_encode($result);
        $pdf->create_pdf($this->getthbl($thbl), json_encode($result));
        //$pdf->Output('myPdf.pdf','F');
        $pdf->Output();
    }
}

?>
