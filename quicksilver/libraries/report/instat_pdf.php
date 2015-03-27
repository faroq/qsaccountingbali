<?php

class instat_pdf extends FPDF
{
    //Page header
    function Header()
    {
            //Logo
            $this->Image('logo.jpg',10,8,33);
            //Arial bold 15
            $this->SetFont('Arial','B',15);
            //Move to the right
            $this->Cell(90);
            //Title
            $this->Cell(10,10,'Income Statemen',0,0,'C');
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
        $header=array('Jenis', 'Rekening', 'ThBl1', 'ThBl');
        //Colors, line width and bold font

        $this->SetDrawColor(128,0,0);
        $this->SetLineWidth(.3);
        //$this->SetFont('','B');
        $this->SetFont('Arial','B',10);
        //Header
        
        $w=array(50, 90, 25, 25);
        //$this->SetFont('');
        $this->SetFont('Arial','',8);
        $json = json_decode($data, true);
        //echo $data;

        $lastjenis = "";
        $fill=false;
        for($i=0; $i<count($json);$i++)
        {
            $this->SetFillColor(220,235,205);
            $this->SetTextColor(0);
            if (($i % 45) == 0)
            {
                if($i!=0) $this->AddPage('P');
                $this->SetFont('Arial','B',12);
                $this->Cell(95,5,'Tanggal Cetak : '.date("d-m-Y H:i:s"),0,0,'L',false);
                $this->Cell(95,5,'Bulan : '.$filter,0,0,'R',false);
                $this->Ln();

                $this->SetFillColor(205,0,0);
                $this->SetTextColor(205);
                $this->Cell($w[0],5,$header[0],1,0,'C',true);
                $this->Cell($w[1],5,$header[1],1,0,'C',true);
                $this->Cell($w[2],5,$header[2],1,0,'C',true);
                $this->Cell($w[3],5,$header[3],1,0,'C',true);
                $this->Ln();
            }
            //[{"jenis":"4-PENDAPATAN","nama_jenis":"PENDAPATAN","rekening":null,"thbl_t":"201309","thbl":201310,"cls":"x-incs-header"}
            $this->SetFont('Arial','',8);
            $this->SetTextColor(0);
            if ($lastjenis != $json[$i]['jenis'])
            {
                $this->SetFillColor(205,205,0);
                $fill = true;
                $lastjenis = $json[$i]['jenis'];
                $this->Cell($w[0],5,$json[$i]['jenis'],1,0,'L',$fill);
                $this->Cell($w[1]+$w[2]+$w[3], 5,' ',1,0,'L',$fill);
                $this->Ln();
            }
            $blank = '   ';
            if ($json[$i]['rekening'] == null)
            {
                $this->SetFillColor(0,205,0);
                $fill = true;
                $blank = '   ';
                $this->Cell($w[0],5,$blank.$json[$i]['nama_jenis'],1,0,'L',$fill);
                $this->Cell($w[1],5,$blank,1,0,'L',$fill);
                $this->Cell($w[2],5,$json[$i]['thbl_t'],1,0,'R',$fill);
                $this->Cell($w[3],5,$json[$i]['thbl'],1,0,'R',$fill);
                $this->Ln();
            }
            else
            {
                $fill = false;
                $blank = '      ';
                $this->Cell($w[0],5,$blank,1,0,'L',$fill);
                $this->Cell($w[1],5,$json[$i]['rekening'],1,0,'L',$fill);
                $this->Cell($w[2],5,number_format($json[$i]['thbl_t']),1,0,'R',$fill);
                $this->Cell($w[3],5,number_format($json[$i]['thbl']),1,0,'R',$fill);
                $this->Ln();
            }
            
        }
        $this->Cell(array_sum($w),0,'','T');
    }
}
?>