<?php

class gl_pdf extends FPDF
{
    //Page header
    function Header()
    {
            //Logo
            $this->Image('logo.jpg',10,8,33);
            //Arial bold 15
            $this->SetFont('Arial','B',15);
            //Move to the right
            $this->Cell(130);
            //Title
            $this->Cell(10,10,'General Ledger',0,0,'C');
            //Line break
            $this->Ln(20);
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

        $this->SetDrawColor(128,0,0);
        $this->SetLineWidth(.3);
        //$this->SetFont('','B');
        $this->SetFont('Arial','B',10);
        //Header
        
        $w=array(50, 100, 30, 30, 30, 30);
        //$this->SetFont('');
        $this->SetFont('Arial','',8);
        $json = json_decode($data, true);
        //echo json_decode($json);

        $lastjenis = "";
        $fill=false;
        for($i=0; $i<count($json);$i++)
        {
            $this->SetFillColor(220,235,205);
            $this->SetTextColor(0);
            if (($i % 19) == 0)
            {
                if($i!=0) $this->AddPage('L');
                $this->SetFont('Arial','B',12);
                $this->Cell(90,5,'Tanggal Cetak : '.date("d-m-Y H:i:s"),0,0,'L',false);
                $this->Cell(90,5,$filter2,0,0,'C',false);
                $this->Cell(90,5,$filter1,0,0,'R',false);
                $this->Ln();

                $this->SetFillColor(205,0,0);
                $this->SetTextColor(205);
                $this->Cell($w[0],5,$header[0],1,0,'C',true);
                $this->Cell($w[1],5,$header[1],1,0,'C',true);
                $this->Cell($w[2],5,$header[2],1,0,'C',true);
                $this->Cell($w[3],5,$header[3],1,0,'C',true);
                $this->Cell($w[4],5,$header[4],1,0,'C',true);
                $this->Cell($w[5],5,$header[5],1,0,'C',true);
                $this->Ln();
            }

            $header=array("Tanggal", "Keterangan", "Referensi", "Debet", "Kredit", "Jumlah");

            $this->SetFont('Arial','',8);
            $this->SetTextColor(0);
            if ($filter2 == 'Semua Rekening')
            {
                if ($lastjenis != $json[$i]['rekening'])
                {
                    $this->SetFillColor(205,205,0);
                    $fill = true;
                    $lastjenis = $json[$i]['rekening'];
                    $this->Cell($w[0]+$w[1]+$w[2]+$w[3]+$w[4]+$w[5],5,'Rekening : '.$json[$i]['rekening'],1,0,'L',$fill);
                    $this->Ln();
                }
            }
            $blank = '   ';
            $fill = false;
            $this->Cell($w[0],5,$blank.$json[$i]['tanggal'],1,0,'L',$fill);
            $this->Cell($w[1],5,$json[$i]['keterangan'],1,0,'L',$fill);
            $this->Cell($w[2],5,$json[$i]['referensi'],1,0,'L',$fill);
            $this->Cell($w[3],5,number_format($json[$i]['debet']),1,0,'R',$fill);
            $this->Cell($w[4],5,number_format($json[$i]['kredit']),1,0,'R',$fill);
            $this->Cell($w[5],5,number_format($json[$i]['jumlah']),1,0,'R',$fill);
            $this->Ln();
        }
        $this->Cell(array_sum($w),0,'','T');
    }
}
?>