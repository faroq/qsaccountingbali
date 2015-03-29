<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of receivable_pdf
 *
 * @author miyzan
 */
class receivable_pdf extends MY_FPDF {
    //put your code here
    function Header()
    {
            //Logo
//            $this->Image('logo.jpg',10,8,33);
            //Arial bold 15
            $this->SetFont('Arial','',10);
            $this->SetY(10);
            $this->Cell(55,5,$this->companyname,0,0,'L');
            $this->SetY(15);
            $this->Cell(55,5,$this->companyaddress,0,0,'L');
            
            $this->SetY(10);
            $this->SetX(345);
            $this->Cell(65,5,'Tanggal Cetak : '.date("d-m-Y H:i:s"),0,0,'R',false);
            $this->SetFont('Arial','B',16);
            
            //Move to the right
//            $this->Cell(130);
            //Title
            $this->SetY(15);
            $this->SetX(10);
            $this->Cell(400,8,$this->title,0,0,'C');
            $this->SetY(24);
            $this->SetFont('Arial','B',12);
            $this->Cell(400,5,  $this->dataheader[0],0,0,'C',false);
            $this->SetY(32);
            if ($this->dataheader[1]=='Semua Rekening')
                $this->Cell(400,5,'',0,0,'L',false);
            else $this->Cell(400,5,$this->dataheader[1],0,0,'L',false);
            //Line break
            $this->Ln(1);
    }
    
    //Page footer
    function Footer()
    {
            //Position at 1.5 cm from bottom
            $this->SetY(-15);
            //Arial italic 8
            $this->SetFont('Arial','I',8);
            //Page number
            $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
    }

    function create_pdf($filter1,$filter2, $data)
    {
        $header=array("Tanggal", "Keterangan", "Referensi", "Debet", "Kredit", "Jumlah");
        //Colors, line width and bold font

//        $this->SetDrawColor(128,0,0);
//        $this->SetDrawColor(194,193,193);
        $this->SetDrawColor(0);
        $this->SetLineWidth(.3);
        //$this->SetFont('','B');
        $this->SetFont('Arial','B',10);
        //Header
        
        $w=array(40, 160, 50, 50, 50, 50);
        //$this->SetFont('');
        $this->SetFont('Arial','',10);
        $json = json_decode($data, true);
        //echo json_decode($json);

        $lastjenis = "";
        $fill=false;
        for($i=0; $i<count($json);$i++)
        {
            $this->SetFillColor(220,235,205);
            $this->SetTextColor(0);
            if (($i % 35) == 0)
            {
                if($i!=0) $this->AddPage('L');
                $this->SetFont('Arial','B',12);
//                $this->Cell(90,5,'Tanggal Cetak : '.date("d-m-Y H:i:s"),0,0,'L',false);
//                $this->Cell(90,5,$filter2,1,0,'L',false);
//                $this->Cell(90,5,$filter1,0,0,'R',false);
                $this->Ln();

                $this->SetFillColor(205,0,0);
                $this->SetFillColor(0,0,0);
                $this->SetTextColor(0);
                $this->Cell($w[0],8,$header[0],'TB',0,'C',false);
                $this->Cell($w[1],8,$header[1],'TB',0,'C',false);
                $this->Cell($w[2],8,$header[2],'TB',0,'C',false);
                $this->Cell($w[3],8,$header[3],'TB',0,'C',false);
                $this->Cell($w[4],8,$header[4],'TB',0,'C',false);
                $this->Cell($w[5],8,$header[5],'TB',0,'C',false);
                $this->Ln();
//                $this->Ln();
            }

            $header=array("Tanggal", "Keterangan", "Referensi", "Debet", "Kredit", "Jumlah");

            $this->SetFont('Arial','',10);
            $this->SetTextColor(0);
            
            if ($filter2 == 'Semua Rekening')
            {
                if ($lastjenis != $json[$i]['rekening'])
                {
//                    $this->SetFillColor(205,205,0);
                    $this->SetDrawColor(194,193,193);
                    $this->SetFillColor(222,222,221);
                    $fill = false;
                    $lastjenis = $json[$i]['rekening'];
                    $this->SetFont('Arial','B',10);
                    $this->Line(10, $this->GetY(), 410, $this->GetY());
                    $this->SetY($this->GetY()+2);
                    
                    $this->SetDrawColor(0);
                    $this->Cell($w[0]+$w[1]+$w[2]+$w[3]+$w[4]+$w[5],5,$json[$i]['rekening'],'B',0,'L',$fill);
                    $this->SetFont('Arial','',10);
                    $this->Ln();
                }
                
            }
            
            $fill = false;
            if($json[$i]['keterangan']=='SALDO AWAL' || $json[$i]['keterangan']=='SALDO AKHIR'){
                $this->SetFont('Arial','B',10);
            }  else {
                $this->SetFont('Arial','',10);
            }
            $this->Cell($w[0],6,$json[$i]['tanggal'],0,0,'C',$fill);
//            $this->setX(($w[0]-$lastx)+$lastx);
            $this->Cell($w[1],6,$json[$i]['keterangan'],0,0,'L',$fill);
            $this->Cell($w[2],6,$json[$i]['referensi'],0,0,'C',$fill);
            $this->Cell($w[3],6,number_format($json[$i]['debet']),0,0,'R',$fill);
            $this->Cell($w[4],6,number_format($json[$i]['kredit']),0,0,'R',$fill);
            $this->Cell($w[5],6,number_format($json[$i]['jumlah']),0,0,'R',$fill);
            $this->Ln();
        }
        $this->Cell(array_sum($w),0,'','T');
    }
    
}

?>
