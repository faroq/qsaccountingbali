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
        $this->load->library('../controllers/global_reference');
    }

    public function get_child($findhead, $child, $level) {
        $resArr = array();
        $childfind = $child;
        foreach ($child as $c) {
            if ($c->kelompok == $findhead) {
                $levelt = $level + 1;

                if ($c->header == 1) {

                   $arc = $this->get_child_3($c->rekening, $childfind, $level);
                    if ($arc) {
                        array_push($resArr, array(
                            'jenis' => $c->jenis . '-' . $c->nama_jenis,
                            'nama_jenis' => NULL,
                            'rekening' => $c->rekening . '-' . $c->nama_rekening,
                            'thbl_t' => $c->saldo_t, 'thbl' => $c->saldo, 'tahunberjalan' => $c->tahunberjalan,
                            'cls' => 'x-hirabold-header'));

                        foreach ($arc as  $arrch) {
                            array_push($resArr, array(
                                'jenis' => $arrch->jenis . '-' . $arrch->nama_jenis,
                                'nama_jenis' => NULL,
                                'rekening' => '==>      ' . $arrch->rekening . '-' . $arrch->nama_rekening,
                                'thbl_t' => $arrch->saldo_t, 'thbl' => $arrch->saldo, 'tahunberjalan' => $arrch->tahunberjalan,
                                'cls' => NULL));
                        }
                    } else {
                        array_push($resArr, array(
                            'jenis' => $c->jenis . '-' . $c->nama_jenis,
                            'nama_jenis' => NULL,
                            'rekening' => $c->rekening . '-' . $c->nama_rekening,
                            'thbl_t' => $c->saldo_t, 'thbl' => $c->saldo, 'tahunberjalan' => $c->tahunberjalan,
                            'cls' => NULL));
                    }
                } else {
                    array_push($resArr, array(
                        'jenis' => $c->jenis . '-' . $c->nama_jenis,
                        'nama_jenis' => NULL,
                        'rekening' => $c->rekening . '-' . $c->nama_rekening,
                        'thbl_t' => $c->saldo_t, 'thbl' => $c->saldo, 'tahunberjalan' => $c->tahunberjalan,
                        'cls' => NULL));
                }
            }
        }
        return $resArr;
    }

    public function get_child_3($findhead, $child, $level) {
        $resArr = array();
        foreach ($child as $c) {
            if ($c->kelompok == $findhead) {
                $levelt = $level + 1;
                array_push($resArr, $c);
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
        $totalth = 0;
        $total_last = 0;
        $total_t_last = 0;
        $totalth_last = 0;
        foreach ($head as $h) {
            if ($jenis != $h->jenis) {
                if ($jenis != '') {
                    array_push($resArr, array(
                        'jenis' => $jenis . '-' . $nama_jenis,
                        'nama_jenis' => 'TOTAL ' . $nama_jenis,
                        'rekening' => NULL,
                        'thbl_t' => $total_t, 'thbl' => $total, 'tahunberjalan' => $totalth,
                        'cls' => 'x-incs-header'));
                    $total = 0;
                    $total_t = 0;
                    $totalth = 0;
                }
                $jenis = $h->jenis;
                $nama_jenis = $h->nama_jenis;
                array_push($resArr, array(
                    'jenis' => $h->jenis . '-' . $h->nama_jenis,
                    'nama_jenis' => $h->nama_jenis,
                    'rekening' => NULL,
                    'thbl_t' => $thbl_t, 'thbl' => $thbl, 'tahunberjalan' => $thbl_t,
                    'cls' => 'x-incs-header'));
            }
            $arrch = $this->get_child($h->kelompok, $child, $level);
            array_push($resArr, array(
                'jenis' => $h->jenis . '-' . $h->nama_jenis,
                'nama_jenis' => NULL,
                'rekening' => $h->kelompok . '-' . $h->nama_kelompok,
                'thbl_t' => NULL, 'thbl' => NULL, 'tahunberjalan' => NULL,
                'cls' => 'x-hira-header'));
            if (count($arrch) > 0) {
                foreach ($arrch as $v) {
                    $total_t = $total_t + $v['thbl_t'];
                    $total = $total + $v['thbl'];
                    $totalth = $totalth + $v['tahunberjalan'];
                    array_push($resArr, $v);
                }
            }
            $level = 0;
        }

        array_push($resArr, array(
            'jenis' => $jenis . '-' . $nama_jenis,
            'nama_jenis' => 'TOTAL ' . $nama_jenis,
            'rekening' => NULL,
            'thbl_t' => $total_t, 'thbl' => $total, 'tahunberjalan' => $totalth,
            'cls' => 'x-incs-header'));

        $jenis = $jenis . '-' . $nama_jenis;
        foreach ($resArr as $v) {
            if (!$v['cls']) {
                if ($v['jenis'] != $jenis) {

                    $total_t_last = $total_t_last + $v['thbl_t'];
                    $total_last = $total_last + $v['thbl'];
                    $totalth_last = $totalth_last + $v['tahunberjalan'];
                }
            }
        }
        $max = $this->get_max_jenis_account();
        $total_t_last = $total_t_last - $total_t;
        $total_last = $total_last - $total;
        $totalth_last = $totalth_last - $totalth;
//        echo $total_last;
        array_push($resArr, array(
            'jenis' => $max + 1 . '-' . 'TOTAL INCOME',
            'nama_jenis' => 'TOTAL INCOME',
            'rekening' => NULL,
            'thbl_t' => $total_t_last, 'thbl' => $total_last, 'tahunberjalan' => $totalth_last,
            'cls' => 'x-incs-header'));
        return $resArr;
    }

    public function get_max_incs_header($head, $child, $thbl, $thbl_t) {
        $resArr = array();
        $level = 0;
        $jenis = '';
        $nama_jenis = '';
        if (count($head) == 0) {
            return $resArr;
        }
        $total = 0;
        $total_t = 0;
        $totalth = 0;
        $total_last = 0;
        $total_t_last = 0;
        $totalth_last = 0;
        foreach ($head as $h) {
            if ($jenis != $h->jenis) {
                if ($jenis != '') {
                    array_push($resArr, array(
                        'jenis' => $jenis . '-' . $nama_jenis,
                        'nama_jenis' => 'TOTAL ' . $nama_jenis,
                        'rekening' => NULL,
                        'thbl_t' => $total_t, 'thbl' => $total, 'tahunberjalan' => $totalth,
                        'cls' => 'x-incs-header'));
                    $total = 0;
                    $total_t = 0;
                    $totalth = 0;
                }
                $jenis = $h->jenis;
                $nama_jenis = $h->nama_jenis;
                array_push($resArr, array(
                    'jenis' => $h->jenis . '-' . $h->nama_jenis,
                    'nama_jenis' => $h->nama_jenis,
                    'rekening' => NULL,
                    'thbl_t' => $thbl_t, 'thbl' => $thbl, 'tahunberjalan' => $thbl_t,
                    'cls' => 'x-incs-header'));
            }
            $arrch = $this->get_child($h->kelompok, $child, $level);
//            array_push($resArr, array(
//                'jenis' => $h->jenis . '-' . $h->nama_jenis,
//                'nama_jenis' => NULL,
//                'rekening' => $h->kelompok . '-' . $h->nama_kelompok,
//                'thbl_t' => NULL, 'thbl' => NULL, 'tahunberjalan' => NULL,
//                'cls' => 'x-hira-header'));
            if (count($arrch) > 0) {
                foreach ($arrch as $v) {
                    $total_t = $total_t + $v['thbl_t'];
                    $total = $total + $v['thbl'];
                    $totalth = $totalth + $v['tahunberjalan'];
                    array_push($resArr, $v);
                }
            }
            $level = 0;
        }

        array_push($resArr, array(
            'jenis' => $jenis . '-' . $nama_jenis,
            'nama_jenis' => 'TOTAL ' . $nama_jenis,
            'rekening' => NULL,
            'thbl_t' => $total_t, 'thbl' => $total, 'tahunberjalan' => $totalth,
            'cls' => 'x-incs-header'));

        $jenis = $jenis . '-' . $nama_jenis;
        foreach ($resArr as $v) {
            if (!$v['cls']) {
                if ($v['jenis'] != $jenis) {

                    $total_t_last = $total_t_last + $v['thbl_t'];
                    $total_last = $total_last + $v['thbl'];
                    $totalth_last = $totalth_last + $v['tahunberjalan'];
                }
            }
        }
        $max = $this->get_max_jenis_account();
        $total_t_last = $total_t_last - $total_t;
        $total_last = $total_last - $total;
        $totalth_last = $totalth_last - $totalth;
//        echo $total_last;
        array_push($resArr, array(
            'jenis' => $max + 1 . '-' . 'TOTAL INCOME',
            'nama_jenis' => 'TOTAL INCOME',
            'rekening' => NULL,
            'thbl_t' => $total_t_last, 'thbl' => $total_last, 'tahunberjalan' => $totalth_last,
            'cls' => 'x-incs-header'));
        return $resArr;
    }

    public function get_rows() {
        $thbl = isset($_POST['thbl']) ? json_decode($this->input->post('thbl', TRUE)) : null;
        $head = $this->bm->get_accountincs_level1(array(4, 5));
        $child = $this->bm->get_incomestatement_child($thbl);
        $thbl_t = $this->get_periodeadd_thbl($thbl, -1);

        $result = array();
        $result = $this->get_max_incs($head, $child, $thbl, $thbl_t);
        $total = count($result);
        echo '{success:true,record:' . $total . ',data:' . json_encode($result) . '}';
    }

    public function get_rows_header() {
        $thbl = isset($_POST['thbl']) ? json_decode($this->input->post('thbl', TRUE)) : null;
        $head = $this->bm->get_accountincs_level1(array(4, 5));
        $child = $this->bm->get_incomestatement_child_header($thbl);
        $thbl_t = $this->get_periodeadd_thbl($thbl, -1);

        $result = array();
        $result = $this->get_max_incs($head, $child, $thbl, $thbl_t);
        $total = count($result);
        echo '{success:true,record:' . $total . ',data:' . json_encode($result) . '}';
    }
    
    public function get_rows_lv1() {
        $thbl = isset($_POST['thbl']) ? json_decode($this->input->post('thbl', TRUE)) : null;
        $head = $this->bm->get_accountincs_level1(array(4, 5));
        $child = $this->bm->get_incomestatement_child_lv1($thbl);
        $thbl_t = $this->get_periodeadd_thbl($thbl, -1);

        $result = array();
        $result = $this->get_max_incs_header($head, $child, $thbl, $thbl_t);
        $total = count($result);
        echo '{success:true,record:' . $total . ',data:' . json_encode($result) . '}';
    }

    public function get_max_jenis_account() {
        return $this->bm->get_max_jenis_account();
    }

    public function get_periodeadd_thbl($thbl = null, $ival = 0) {
        $result = $this->bm->callFunction('period_add', array($thbl, $ival));
        if (count($result)) {
            return $result[0]->retval;
        } else {
            return 0;
        }
    }

    public function instat_pdf() {
        $thbl = isset($_GET['thbl']) ? json_decode($_GET['thbl']) : null;
        $head = $this->bm->get_accountincs_level1(array(4, 5));
        $child = $this->bm->get_incomestatement_child($thbl);
        $thbl_t = $this->get_periodeadd_thbl($thbl, -1);

        $result = array();
        $result = $this->get_max_incs($head, $child, $thbl, $thbl_t);
        $this->load->library('report/instat_pdf');
        $pdf = new instat_pdf();
        $pdf->AliasNbPages();
        $pdf->SetTitle('Income Statemen');
        $pdf->SetFont('Arial', '', 14);
        $pdf->AddPage('P');        
        $pdf->create_pdf($this-> global_reference->getthbl($thbl), json_encode($result));       
        $pdf->Output('incsprint', 'I');
    }
    
    public function instat_pdf_header() {
        $thbl = isset($_GET['thbl']) ? json_decode($_GET['thbl']) : null;
        $head = $this->bm->get_accountincs_level1(array(4, 5));
        $child = $this->bm->get_incomestatement_child_header($thbl);
        $thbl_t = $this->get_periodeadd_thbl($thbl, -1);

        $result = array();
        $result = $this->get_max_incs($head, $child, $thbl, $thbl_t);
        $this->load->library('report/instat_pdf');
        $pdf = new instat_pdf();
        $pdf->AliasNbPages();
        $pdf->SetTitle('Income Statemen');
        $pdf->SetFont('Arial', '', 14);
        $pdf->AddPage('P');        
        $pdf->create_pdf($this-> global_reference->getthbl($thbl), json_encode($result));       
        $pdf->Output('incsprint', 'I');
    }
    
    public function instat_pdf_lv1() {
        $thbl = isset($_GET['thbl']) ? json_decode($_GET['thbl']) : null;
        $head = $this->bm->get_accountincs_level1(array(4, 5));
        $child = $this->bm->get_incomestatement_child_lv1($thbl);
        $thbl_t = $this->get_periodeadd_thbl($thbl, -1);

        $result = array();
        $result = $this->get_max_incs_header($head, $child, $thbl, $thbl_t);
        $this->load->library('report/instat_pdf');
        $pdf = new instat_pdf();
        $pdf->AliasNbPages();
        $pdf->SetTitle('Income Statement');
        $pdf->SetFont('Arial', '', 14);
        $pdf->AddPage('P');        
        $pdf->create_pdf($this-> global_reference->getthbl($thbl), json_encode($result));       
        $pdf->Output('incsprint', 'I');
    }

}

?>
