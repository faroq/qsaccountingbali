<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of balance_sheet
 *
 * @author faroq
 */
class balance_sheet extends MY_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('base_model', 'bm');
    }

    public function get_max_bls($loop_count, $child_d, $child_k) {
        $resArr = array();
        $level = 0;
        $total_aktiva=0;
        $total_passiva=0;
//        $arrField=array('jenis','rekening','subtotal','total','cls');
        for ($i = 0; $i < $loop_count; $i++) {

//            $arr_k = $child_k[$i];
            if ($i < count($child_d)) {
                $arr_d = $child_d[$i];
                $jenis_d = $arr_d['jenis'];
                $rekening_d = $arr_d['rekening'];
                $subtotal_d = $arr_d['subtotal'];
                $total_d = $arr_d['total'];
                $cls_d=$arr_d['cls'];
            } else {
                $jenis_d = NULL;
                $rekening_d = NULL;
                $subtotal_d = NULL;
                $total_d = NULL;
                $cls_d=NULL;
            }

            if ($i < count($child_k)) {
                $arr_k = $child_k[$i];
                $jenis_k = $arr_k['jenis'];
                $rekening_k = $arr_k['rekening'];
                $subtotal_k = $arr_k['subtotal'];
                $total_k = $arr_k['total'];
                $cls_k=$arr_k['cls'];
            } else {
                $jenis_k = NULL;
                $rekening_k = NULL;
                $subtotal_k = NULL;
                $total_k = NULL;
                $cls_k=NULL;
            }
            if($total_d){
                $total_aktiva=$total_aktiva+$total_d;
            }
            if($total_k){
                if($jenis_k){
                    $total_passiva=$total_passiva+$total_k;
                }
                
            }


            $arr = array(
                'jenis_d' => $jenis_d,
                'rekening_d' => $rekening_d,
                'subtotal_d' => $subtotal_d,
                'total_d' => $total_d,
                'cls_d' => $cls_d,
                'jenis_k' => $jenis_k,
                'rekening_k' => $rekening_k,
                'subtotal_k' => $subtotal_k,
                'total_k' => $total_k,
                'cls_k' => $cls_k
            );
            array_push($resArr, $arr);
            
        }
        
        $arr = array(
                'jenis_d' => 'TOTAL AKTIVA',
                'rekening_d' => NULL,
                'subtotal_d' => NULL,
                'total_d' => $total_aktiva,
                'cls_d' => 'x-bls-header',
                'jenis_k' => 'TOTAL PASSIVA',
                'rekening_k' => NULL,
                'subtotal_k' => NULL,
                'total_k' => $total_passiva,
                'cls_k' => 'x-bls-header'
            );
        array_push($resArr, $arr);
        return $resArr;
    }

    public function get_child($findhead, $child) {
        $resArr = array();
        foreach ($child as $c) {
            if ($c->kelompok == $findhead) {
                array_push($resArr, array(
                    'jenis' => NULL,
                    'rekening' => $c->rekening . '-' . $c->nama_rekening,
                    'subtotal' => $c->saldo,
                    'total' => NULL,
                    'cls' => NULL));
            }
        }
        return $resArr;
    }

    public function get_max_d($head, $child) {
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
                $jenis = $h->jenis;
                array_push($resArr, array(
                    'jenis' => $h->jenis . '-' . $h->nama_jenis,
                    'rekening' => NULL,
                    'subtotal' => NULL,
                    'total' => NULL,
                    'cls' => 'x-bls-header'));
            }

            array_push($resArr, array(
                'jenis' => NULL,
                'rekening' => $h->kelompok . '-' . $h->nama_kelompok,
                'subtotal' => NULL,
                'total' => NULL,
                'cls' => 'x-bls-header1'));
            $arrch = $this->get_child($h->kelompok, $child);
            $total = 0;
            if (count($arrch) > 0) {
                foreach ($arrch as $v) {
                    $total = $total + $v['subtotal'];

                    array_push($resArr, $v);
                }
            }
            array_push($resArr, array(
                'jenis' => NULL,
                'rekening' => 'TOTAL ' . $h->kelompok . '-' . $h->nama_kelompok,
                'subtotal' => $total,
                'total' => $total,
                'cls' => 'x-bls-header2'));
            $level = 0;
        }
        return $resArr;
    }

    public function get_max_k($head, $child) {
        $resArr = array();
        $level = 0;
        $jenis = '';
        $nama_jenis = '';
        if (count($head) == 0) {
            return $resArr;
        }
        $total = 0;
        $total_t = 0;

        foreach ($head as $h) {
            if ($jenis != $h->jenis) {
                if ($jenis != '') {
                    array_push($resArr, array(
                        'jenis' => 'TOTAL ' . $jenis . '-' . $nama_jenis,
                        'rekening' => NULL,
                        'subtotal' => NULL,
                        'total' => $total_t,
                        'cls' => 'x-bls-header'));
                }

                $nama_jenis = $h->nama_jenis;

                $jenis = $h->jenis;

                array_push($resArr, array(
                    'jenis' => $h->jenis . '-' . $h->nama_jenis,
                    'rekening' => NULL,
                    'subtotal' => NULL,
                    'total' => NULL,
                    'cls' => 'x-bls-header'));
                $total_t = 0;
            }

            array_push($resArr, array(
                'jenis' => NULL,
                'rekening' => $h->kelompok . '-' . $h->nama_kelompok,
                'subtotal' => NULL,
                'total' => NULL,
                'cls' => 'x-bls-header1'));
            $arrch = $this->get_child($h->kelompok, $child);
            $total = 0;
            if (count($arrch) > 0) {
                foreach ($arrch as $v) {
                    $total = $total + $v['subtotal'];
                    $total_t = $total_t + $v['subtotal'];
                    array_push($resArr, $v);
                }
            }
            array_push($resArr, array(
                'jenis' => NULL,
                'rekening' => 'TOTAL ' . $h->kelompok . '-' . $h->nama_kelompok,
                'subtotal' => $total,
                'total' => $total,
                'cls' => 'x-bls-header2'));
            $level = 0;
        }
        array_push($resArr, array(
            'jenis' => 'TOTAL ' . $jenis . '-' . $nama_jenis,
            'rekening' => NULL,
            'subtotal' => NULL,
            'total' => $total_t,
            'cls' => 'x-bls-header'));
        return $resArr;
    }

    public function get_rows() {
        $thbl = isset($_POST['thbl']) ? json_decode($this->input->post('thbl', TRUE)) : null;
        $head_d = $this->bm->get_account_kelompok(array(1));
        $head_k = $this->bm->get_account_kelompok(array(2, 3));
        $child_d = $this->bm->get_balancesheet_child($thbl, 'D');
        $child_k = $this->bm->get_balancesheet_child($thbl, 'K');

        $child_arr_d = $this->get_max_d($head_d, $child_d);
        $child_arr_k = $this->get_max_k($head_k, $child_k);

        $loop_count = count($child_arr_d);
        if (count($child_arr_k) > count($child_arr_d)) {
            $first_loop = count($child_k);
        }
        $result = array();
        $result = $this->get_max_bls($loop_count, $child_arr_d, $child_arr_k);
        $total = count($result);
        echo '{success:true,record:' . $total . ',data:' . json_encode($result) . '}';
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
    public function bs_pdf()
    {
        $thbl = $_GET['thbl'];
        $head_d = $this->bm->get_account_kelompok(array(1));
        $head_k = $this->bm->get_account_kelompok(array(2, 3));
        $child_d = $this->bm->get_balancesheet_child($thbl, 'D');
        $child_k = $this->bm->get_balancesheet_child($thbl, 'K');

        $child_arr_d = $this->get_max_d($head_d, $child_d);
        $child_arr_k = $this->get_max_k($head_k, $child_k);

        $loop_count = count($child_arr_d);
        if (count($child_arr_k) > count($child_arr_d)) {
            $first_loop = count($child_k);
        }
        $result = array();
        $result = $this->get_max_bls($loop_count, $child_arr_d, $child_arr_k);
        
        //echo json_encode($result);
        $pdf=new balancesheet_pdf();
        $pdf->AliasNbPages();

        //$pdf->SetAuthor('Arief Himawan');
        $pdf->SetTitle('Balance Sheet');

        $pdf->SetFont('Arial','',14);
        $pdf->AddPage('L');
        $pdf->create_pdf($this->getthbl($thbl), json_encode($result));
        $pdf->Output("bsprint","I");
//        $pdf->Output();
    }
}

?>
