<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of base_report
 *
 * @author faroq
 */
class base_report extends MY_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('base_model', 'bm');
        $this->load->library('../controllers/global_reference');
    }

    public function get_row_gl() {
        $search = isset($_POST['query']) ? json_decode($this->input->post('query', TRUE)) : array();

        $param = array();
        foreach ($search as $value) {
            array_push($param, $value->value);
        }
        $spname = 'sp_generalledger';
        $result = $this->bm->SP_getData($spname, $param);

        echo $result;
    }

    public function get_child_tb($findhead, $child, $level) {
        $resArr = array();
        foreach ($child as $c) {
            if ($c->kelompok == $findhead) {
                $levelt = $level + 1;
                array_push($resArr, array(
                    'jenis' => $c->jenis . '-' . $c->nama_jenis,
//                        'kelompok'=>NULL,// $c->kelompok.'-'.$c->nama_kelompok,
                    'rekening' => $c->rekening . '-' . $c->nama_rekening,
                    'debet_awal' => $c->debet_awal, 'kredit_awal' => $c->kredit_awal,
                    'mutasi_d' => $c->mutasi_d, 'mutasi_k' => $c->mutasi_k,
                    'debet_akhir' => $c->debet_akhir, 'kredit_akhir' => $c->kredit_akhir,
                    'debet_rl' => $c->debet_rl, 'kredit_rl' => $c->kredit_rl,
                    'debet_nr' => $c->debet_nr, 'kredit_nr' => $c->kredit_nr,
                    'cls' => NULL));

            }
        }
        return $resArr;
    }

    public function get_max_tb($head, $child) {
        $resArr = array();
        $level = 0;
        $jenis = '';
        if (count($head) == 0) {
            return $resArr;
        }
        foreach ($head as $h) {
            $arrch = $this->get_child_tb($h->kelompok, $child, $level);
            if ($jenis != $h->jenis) {
                $jenis = $h->jenis;
//                array_push($resArr, array(
//                    'jenis'=>$h->nama_jenis,
//                    'kelompok'=>$h->kelompok.'-'.$h->nama_kelompok,
//                    'rekening'=>NULL,
//                    'debet_awal'=>NULL,'kredit_awal'=>NULL,
//                    'mutasi_d'=>NULL,'mutasi_k'=>NULL,
//                    'debet_akhir'=>NULL,'kredit_akhir'=>NULL,
//                    'cls'=>'x-hira-header'));
            }
            array_push($resArr, array(
                'jenis' => $h->jenis . '-' . $h->nama_jenis,
//                    'kelompok'=>$h->kelompok.'-'.$h->nama_kelompok,
                'rekening' => $h->kelompok . '-' . $h->nama_kelompok,
                'debet_awal' => NULL, 'kredit_awal' => NULL,
                'mutasi_d' => NULL, 'mutasi_k' => NULL,
                'debet_akhir' => NULL, 'kredit_akhir' => NULL,
                'debet_rl' => NULL, 'kredit_rl' => NULL,
                'debet_nr' => NULL, 'kredit_nr' => NULL,
                'cls' => 'x-hira-header'));
            if (count($arrch) > 0) {
                foreach ($arrch as $v) {
                    array_push($resArr, $v);
                }
            }
            $level = 0;
        }
        $maxjenis = $this->get_max_jenis_account();
        $maxjenis = $maxjenis + 1;

        $total_d_awal = 0;
        $total_k_awal = 0;
        $total_md = 0;
        $total_mk = 0;
        $total_d_akhir = 0;
        $total_k_akhir = 0;
        $total_d_rl = 0;
        $total_k_rl = 0;
        $total_d_nr = 0;
        $total_k_nr = 0;
        $i=0;
        foreach ($resArr as $value) {            
            if (!$value['cls']) {
//                echo 'disini';
                $total_d_awal = $total_d_awal + $value['debet_awal'];
                $total_k_awal = $total_k_awal + $value['kredit_awal'];
                $total_md = $total_md + $value['mutasi_d'];
                $total_mk = $total_mk + $value['mutasi_k'];
                $total_d_akhir = $total_d_akhir + $value['debet_akhir'];
                $total_k_akhir = $total_k_akhir + $value['kredit_akhir'];
                $total_d_rl = $total_d_rl + $value['debet_rl'];
                $total_k_rl = $total_k_rl + $value['kredit_rl'];
                $total_d_nr = $total_d_nr + $value['debet_nr'];
                $total_k_nr = $total_k_nr + $value['kredit_nr'];
            }
        }
        array_push($resArr, array(
            'jenis' => $maxjenis . '-Total',
//                    'kelompok'=>$h->kelompok.'-'.$h->nama_kelompok,
            'rekening' => 'Sub Total',
            'debet_awal' => $total_d_awal, 'kredit_awal' => $total_k_awal,
            'mutasi_d' => $total_md, 'mutasi_k' => $total_mk,
            'debet_akhir' => $total_d_akhir, 'kredit_akhir' => $total_k_akhir,
            'debet_rl' => $total_d_rl, 'kredit_rl' => $total_k_rl,
            'debet_nr' => $total_d_nr, 'kredit_nr' => $total_k_nr,
            'cls' => 'x-hira-header'));
        $d_lr=0;
        $k_lr=0;
        $d_nr=0;
        $k_nr=0;
        
        if ($total_d_rl>$total_k_rl){
            $k_lr=$total_d_rl-$total_k_rl;
        }elseif ($total_d_rl<$total_k_rl){
            $d_lr=$total_k_rl-$total_d_rl;
        }
        
        if ($total_d_nr>$total_k_nr){
            $k_nr=$total_d_nr-$total_k_nr;
        }elseif ($total_d_nr<$total_k_nr){
            $d_nr=$total_k_nr-$total_d_nr;
        }
        $sel_d_awal=0;
        $sel_k_awal=0;
        $sel_d_mut=0;
        $sel_k_mut=0;
        $sel_d_akhir=0;
        $sel_k_akhir=0;
        if ($total_d_awal>$total_k_awal){
            $sel_k_awal=$total_d_awal-$total_k_awal;
        }elseif($total_d_awal<$total_k_awal){
            $sel_d_awal=$total_k_awal-$total_d_awal;
        }
        
        if ($total_md>$total_mk){
            $sel_k_mut=$total_md-$total_mk;
        }elseif($total_md<$total_mk){
            $sel_d_mut=$total_mk-$total_md;
        }
        
        if ($total_d_akhir>$total_k_akhir){
            $sel_k_akhir=$total_d_akhir-$total_k_akhir;
        }elseif($total_d_akhir<$total_k_akhir){
            $sel_d_akhir=$total_k_akhir-$total_d_akhir;
        }
        
        array_push($resArr, array(
            'jenis' => $maxjenis . '-Total',
//                    'kelompok'=>$h->kelompok.'-'.$h->nama_kelompok,
            'rekening' => 'Rugi Laba',
            'debet_awal' => $sel_d_awal, 'kredit_awal' => $sel_k_awal,
            'mutasi_d' => $sel_d_mut, 'mutasi_k' => $sel_k_mut,
            'debet_akhir' => $sel_d_akhir, 'kredit_akhir' => $sel_k_akhir,
            'debet_rl' => $d_lr, 'kredit_rl' => $k_lr,
            'debet_nr' => $d_nr, 'kredit_nr' => $k_nr,
            'cls' => 'x-hira-header'));
        array_push($resArr, array(
            'jenis' => $maxjenis . '-Total',
//                    'kelompok'=>$h->kelompok.'-'.$h->nama_kelompok,
            'rekening' => 'Total',
            'debet_awal' => $total_d_awal+$sel_d_awal, 'kredit_awal' => $total_k_awal+$sel_k_awal,
            'mutasi_d' => $total_md+$sel_d_mut, 'mutasi_k' => $total_mk+$sel_k_mut,
             'debet_akhir' => $total_d_akhir+$sel_d_akhir, 'kredit_akhir' => $total_k_akhir+$sel_k_akhir,
            'debet_rl' => $total_d_rl+$d_lr, 'kredit_rl' => $total_k_rl+$k_lr,
            'debet_nr' => $total_d_nr+$d_nr, 'kredit_nr' => $total_k_nr+$k_nr,
            'cls' => 'x-hira-header'));
        return $resArr;
    }

    public function get_row_trialbalance() {
        $thbl = isset($_POST['thbl']) ? json_decode($this->input->post('thbl', TRUE)) : null;
        $head = $this->bm->get_account_kelompok();
        $child = $this->bm->get_trialbalance_child($thbl);

        $result = array();
        $result = $this->get_max_tb($head, $child);
        $total = count($result);
        echo '{success:true,record:' . $total . ',data:' . json_encode($result) . '}';
    }

    public function get_max_jenis_account() {
        return $this->bm->get_max_jenis_account();
    }

}

?>
