<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of cashflow_pdf
 *
 * @author miyzan
 */
class cashflow_pdf extends MY_FPDF {

    function Header() {
        //Logo
//            $this->Image('logo.jpg',10,8,33);
        //Arial bold 15
        $this->SetFont('Arial', '', 10);
        $this->SetY(10);
        $this->Cell(55, 5, $this->companyname, 0, 0, 'L');
        $this->SetY(15);
        $this->Cell(55, 5, $this->companyaddress, 0, 0, 'L');

        $this->SetY(10);
        $this->SetX(227);
        $this->Cell(65, 5, 'Tanggal Cetak : ' . date("d-m-Y H:i:s"), 0, 0, 'R', false);
        $this->SetFont('Arial', 'B', 16);

        //Move to the right
//            $this->Cell(130);
        //Title
        $this->SetY(15);
        $this->SetX(5);
        $this->Cell(287, 8, $this->title, 0, 0, 'C');
        $this->SetY(24);
//        $this->Line(5, $this->GetY(), 292, $this->GetY());
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(287, 5, $this->dataheader[0], 0, 0, 'C', false);
        $this->SetY(32);
        //Line break 37 y
        $this->Ln(1);
    }

    function Footer() {
        //Position at 1.5 cm from bottom
        $this->SetY(-15);
        //Arial italic 8
        $this->SetFont('Arial', 'I', 8);
        //Page number
        $this->Cell(0, 10, 'Page ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }

    public function set_header_column($w) {
        $head = array();
        if ($this->dataheader[1] == 'PERIODE I') {
            $head = array("KETERANGAN", "JANUARI", "FEBRUARI", "MARET", "APRIL", "MEI", "JUNI");
        }
        if ($this->dataheader[1] == 'PERIODE II') {
            $head = array("KETERANGAN", "JULI", "AGUSTUS", "SEPTEMBER", "OKTOBER", "NOVEMBER", "DESEMBER");
        }

        $alignhead = array('C', 'C', 'C', 'C', 'C', 'C', 'C');
        $borderhead = array(1, 'RTB', 'RTB', 'RTB', 'RTB', 'RTB', 1);
        $this->SetFont('Arial', 'B', 10);
        $this->SetX(5);
        for ($i = 0; $i < count($w); $i++) {
            $this->Cell($w[$i], 5, $head[$i], $borderhead[$i], 0, $alignhead[$i]);
        }

        $this->Ln();
        $this->SetFont('Arial', '', 10);
    }

    function create_pdf($data) {
        $this->AddPage();
        $this->SetAutoPageBreak(true, 18);
        $this->SetDrawColor(0);
        $this->SetLineWidth(.3);

        $w = array(59, 38, 38, 38, 38, 38, 38);
        $al = array('L', 'R', 'R', 'R', 'R', 'R', 'R');
        $this->SetWidths($w);
        $this->SetAligns($al);
        $this->lineh = 5;
        $this->set_header_column($w);
//       echo  $data;        
//        $json = json_decode($data, true);
        $lastjenis = "";
        $fill = false;
        $number = 0;
        foreach ($data as $v) {

            $this->SetFont('Arial', '', 10);
            if ($v['keterangan'] == 'SALDO AWAL' || $v['keterangan'] == 'SALDO AKHIR' ||
                    $v['keterangan'] == 'TOTAL MUTASI ( - )' || $v['keterangan'] == 'TOTAL MUTASI ( + )' ||
                    $v['keterangan'] == 'LABA/RUGI PERIODE BERJALAN' ) {
                $this->SetFont('Arial', 'B', 10);
                $datarow = array();
                if ($this->dataheader[1] == 'PERIODE I') {
                    $datarow = array(
                        $v['keterangan'],
                        number_format($v['jan']),
                        number_format($v['feb']),
                        number_format($v['mar']),
                        number_format($v['apr']),
                        number_format($v['mei']),
                        number_format($v['jun'])
                    );
                }
                if ($this->dataheader[1] == 'PERIODE II') {
                    $datarow = array(
                        $v['keterangan'],
                        number_format($v['jul']),
                        number_format($v['agust']),
                        number_format($v['sept']),
                        number_format($v['okt']),
                        number_format($v['nov']),
                        number_format($v['des'])
                    );
                }
                if ($v['keterangan'] == 'TOTAL MUTASI ( - )' || $v['keterangan'] == 'TOTAL MUTASI ( + )' ){
                    $this->RowHead($datarow
                        , $w, $al, $this->lineh, 0, 1,1,
                        array(0,1,2,3,4,5,6)
                        ,false,null,
                        array(1,'TBR','TBR','TBR','TBR','TBR','TBR')
                    );
                }elseif($v['keterangan'] == 'LABA/RUGI PERIODE BERJALAN' || $v['keterangan'] == 'SALDO AKHIR'){
                    $this->RowHead($datarow
                        , $w, $al, $this->lineh, 0, 1,1,
                        array(0,1,2,3,4,5,6)
                        ,false,null,
                        array('LBR','BR','BR','BR','BR','BR','BR')
                    );
                }else{
                    $this->RowHead($datarow
                       , $w, $al, $this->lineh, 0, 1,1,
                        array(0,1,2,3,4,5,6)
                        ,false,null,
                        array('LR','R','R','R','R','R','R')
                    );
                }
                
            }
           elseif ($v['keterangan'] == 'MUTASI ( + )' || $v['keterangan'] == 'MUTASI ( - )') {
                $this->SetFont('Arial', 'B', 10);
                $this->RowHead(
                        array(
                    $v['keterangan'],
                    null,
                    null,
                    null,
                    null,
                    null,
                    null
                        ), $w, $al, $this->lineh, 0, 1,1,
                        array(0,1,2,3,4,5,6)
                        ,false,null,
                        array('LR','R','R','R','R','R','R')
                );
            }else{ 
                $this->SetFont('Arial', '',10);
                if ($this->dataheader[1] == 'PERIODE I') {
                    $datarow = array(
                        $v['keterangan'],
                        number_format($v['jan']),
                        number_format($v['feb']),
                        number_format($v['mar']),
                        number_format($v['apr']),
                        number_format($v['mei']),
                        number_format($v['jun'])
                    );
                } 
                if ($this->dataheader[1] == 'PERIODE II') {
                    $datarow = array(
                        $v['keterangan'],
                        number_format($v['jul']),
                        number_format($v['agust']),
                        number_format($v['sept']),
                        number_format($v['okt']),
                        number_format($v['nov']),
                        number_format($v['des'])
                    );
                }
                $this->RowHead($datarow
                       , $w, $al, $this->lineh, 0, 1,1,
                        array(0,1,2,3,4,5,6)
                        ,false,null,
                        array('LR','R','R','R','R','R','R')
                );
            }
        }
    }

}

?>
