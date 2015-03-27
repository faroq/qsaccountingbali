<?php

class balancesheet_pdf extends FPDF
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
            $this->Cell(10,10,'Balance Sheet',0,0,'C');
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

    function create_pdf($filter, $data)
    {
        $header=array('Jenis', 'Rekening', 'Sub Total', 'Total', 'Jenis', 'Rekening', 'Sub Total', 'Total');

        $this->SetDrawColor(128,0,0);
        $this->SetLineWidth(.3);
        $this->SetFont('Arial','B',10);
        
        $w=array(35, 65, 20, 20, 30, 65, 20, 20);
        $this->SetFont('Arial','',8);
        $json = json_decode($data, true);

        $fill=false;
        for($i=0; $i<count($json);$i++)
        {
            $this->SetFillColor(220,235,205);
            $this->SetTextColor(0);
            if (($i % 25) == 0)
            {
                if($i!=0) $this->AddPage('L');
                $this->SetFont('Arial','B',12);
                $this->Cell($w[0]+$w[1]+$w[2]+$w[3],5,'Tanggal Cetak : '.date("d-m-Y H:i:s"),0,0,'L',false);
                $this->Cell($w[4]+$w[5]+$w[6]+$w[7],5,'Bulan : '.$filter,0,0,'R',false);
                $this->Ln();

                $this->SetFillColor(205,0,0);
                $this->SetTextColor(205);
                $this->Cell($w[0]+$w[1]+$w[2]+$w[3],5,'AKTIVA',1,0,'C',true);
                $this->Cell($w[4]+$w[5]+$w[6]+$w[7],5,'AKTIVA',1,0,'C',true);
                $this->Ln();

                $this->Cell($w[0],5,$header[0],1,0,'C',true);
                $this->Cell($w[1],5,$header[1],1,0,'C',true);
                $this->Cell($w[2],5,$header[2],1,0,'C',true);
                $this->Cell($w[3],5,$header[3],1,0,'C',true);
                $this->Cell($w[4],5,$header[4],1,0,'C',true);
                $this->Cell($w[5],5,$header[5],1,0,'C',true);
                $this->Cell($w[6],5,$header[6],1,0,'C',true);
                $this->Cell($w[7],5,$header[7],1,0,'C',true);
                $this->Ln();
            }
            $this->SetFont('Arial','',8);
            $this->SetTextColor(0);

            if ($json[$i]['cls_d'] == 'x-bls-header')
            {
                $this->SetFillColor(205,205,0);
                $fill = true;
            }
            else if ($json[$i]['cls_d'] == 'x-bls-header1')
            {
                $this->SetFillColor(0,205,0);
                $fill = true;
            }
            else
                $fill = false;
            
            $this->Cell($w[0],5,$json[$i]['jenis_d'],1,0,'L',$fill);
            $this->Cell($w[1],5,$json[$i]['rekening_d'],1,0,'L',$fill);
            $this->Cell($w[2],5,number_format($json[$i]['subtotal_d']),1,0,'R',$fill);
            $this->Cell($w[3],5,number_format($json[$i]['total_d']),1,0,'R',$fill);

            if ($json[$i]['cls_k'] == 'x-bls-header')
            {
                $this->SetFillColor(205,205,0);
                $fill = true;
            }
            else if ($json[$i]['cls_k'] == 'x-bls-header1')
            {
                $this->SetFillColor(0,205,0);
                $fill = true;
            }
            else
                $fill = false;
            $this->Cell($w[4],5,$json[$i]['jenis_k'],1,0,'L',$fill);
            $this->Cell($w[5],5,$json[$i]['rekening_k'],1,0,'L',$fill);
            $this->Cell($w[6],5,number_format($json[$i]['subtotal_k']),1,0,'R',$fill);
            $this->Cell($w[7],5,number_format($json[$i]['total_k']),1,0,'R',$fill);
            $this->Ln();


        }
        $this->Cell(array_sum($w),0,'','T');
    }
}
?>