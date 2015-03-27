<?php

class trialbalance_pdf extends FPDF
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
            $this->Cell(10,10,'Trial Balance',0,0,'C');
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
        $headmerge=array('Rekening', 'Saldo Awal', 'Mutasi', 'Saldo Akhir', 'Rugi/Laba', 'Neraca');
        $header=array('', 'Debet', 'Kredit', 'Debet', 'Kredit', 'Debet', 'Kredit', 'Debet', 'Kredit', 'Debet', 'Kredit');
        //Colors, line width and bold font

        $this->SetDrawColor(128,0,0);
        $this->SetLineWidth(.3);
        //$this->SetFont('','B');
        $this->SetFont('Arial','B',10);
        //Header
        
        $w=array(75, 20, 20, 20, 20, 20, 20, 20, 20, 20, 20);
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
            if (($i % 25) == 0)
            {
                if($i!=0) $this->AddPage('L');
                $this->SetFont('Arial','B',12);
                $this->Cell($w[0]+$w[1]+$w[2]+$w[3]+$w[4],5,'Tanggal Cetak : '.date("d-m-Y H:i:s"),0,0,'L',false);
                $this->Cell($w[5]+$w[6]+$w[7]+$w[8]+$w[9]+$w[10],5,'Bulan : '.$filter,0,0,'R',false);
                $this->Ln();

                $this->SetFillColor(205,0,0);
                $this->SetTextColor(205);
                $this->Cell($w[0],5,$headmerge[0],1,0,'C',true);
                $this->Cell($w[1]+$w[2],5,$headmerge[1],1,0,'C',true);
                $this->Cell($w[3]+$w[4],5,$headmerge[2],1,0,'C',true);
                $this->Cell($w[5]+$w[6],5,$headmerge[3],1,0,'C',true);
                $this->Cell($w[7]+$w[8],5,$headmerge[4],1,0,'C',true);
                $this->Cell($w[9]+$w[10],5,$headmerge[5],1,0,'C',true);
                $this->Ln();

                $this->Cell($w[0],5,$header[0],1,0,'C',true);
                $this->Cell($w[1],5,$header[1],1,0,'C',true);
                $this->Cell($w[2],5,$header[2],1,0,'C',true);
                $this->Cell($w[3],5,$header[3],1,0,'C',true);
                $this->Cell($w[4],5,$header[4],1,0,'C',true);
                $this->Cell($w[5],5,$header[5],1,0,'C',true);
                $this->Cell($w[6],5,$header[6],1,0,'C',true);
                $this->Cell($w[7],5,$header[7],1,0,'C',true);
                $this->Cell($w[8],5,$header[8],1,0,'C',true);
                $this->Cell($w[9],5,$header[9],1,0,'C',true);
                $this->Cell($w[10],5,$header[10],1,0,'C',true);
                $this->Ln();
            }
            
            $this->SetFont('Arial','',8);
            $this->SetTextColor(0);
            if ($lastjenis != $json[$i]['jenis'])
            {
                $this->SetFillColor(205,205,0);
                $fill = true;
                $lastjenis = $json[$i]['jenis'];
                $this->Cell($w[0],5,$json[$i]['jenis'],1,0,'L',$fill);
                $this->Cell($w[1]+$w[2]+$w[3]+$w[4]+$w[5]+$w[6]+$w[7]+$w[8]+$w[9]+$w[10], 5,' ',1,0,'L',$fill);
                $this->Ln();
            }
            $blank = '   ';
            if ($json[$i]['debet_awal'] == null)
            {
                $this->SetFillColor(0,205,0);
                $fill = true;
                $blank = '   ';
                /*$this->Cell($w[0],5,$blank.$json[$i]['rekening'],1,0,'L',$fill);
                //$this->Cell($w[1]+$w[2]+$w[3]+$w[4]+$w[5]+$w[6]+$w[7]+$w[8]+$w[9]+$w[10],5,'',1,0,'L',$fill);
                $this->Cell($w[1],5,number_format($json[$i]['debet_awal']),1,0,'R',$fill);
                $this->Cell($w[2],5,number_format($json[$i]['kredit_awal']),1,0,'R',$fill);
                $this->Cell($w[3],5,number_format($json[$i]['mutasi_d']),1,0,'R',$fill);
                $this->Cell($w[4],5,number_format($json[$i]['mutasi_k']),1,0,'R',$fill);

                $this->Cell($w[5],5,number_format($json[$i]['debet_akhir']),1,0,'R',$fill);
                $this->Cell($w[6],5,number_format($json[$i]['kredit_akhir']),1,0,'R',$fill);

                $this->Cell($w[7],5,number_format($json[$i]['debet_rl']),1,0,'R',$fill);
                $this->Cell($w[8],5,number_format($json[$i]['kredit_rl']),1,0,'R',$fill);
                $this->Cell($w[9],5,number_format($json[$i]['debet_nr']),1,0,'R',$fill);
                $this->Cell($w[10],5,number_format($json[$i]['kredit_nr']),1,0,'R',$fill);
                //$this->Cell($w[10],5,$json[$i]['cls'],1,0,'R',$fill);
                $this->Ln();*/
            }
            else
            {
                $fill = false;
                $blank = '      ';
            }
            $this->Cell($w[0],5,$blank.$json[$i]['rekening'],1,0,'L',$fill);
            $this->Cell($w[1],5,number_format($json[$i]['debet_awal']),1,0,'R',$fill);
            $this->Cell($w[2],5,number_format($json[$i]['kredit_awal']),1,0,'R',$fill);
            $this->Cell($w[3],5,number_format($json[$i]['mutasi_d']),1,0,'R',$fill);
            $this->Cell($w[4],5,number_format($json[$i]['mutasi_k']),1,0,'R',$fill);

            $this->Cell($w[5],5,number_format($json[$i]['debet_akhir']),1,0,'R',$fill);
            $this->Cell($w[6],5,number_format($json[$i]['kredit_akhir']),1,0,'R',$fill);

            $this->Cell($w[7],5,number_format($json[$i]['debet_rl']),1,0,'R',$fill);
            $this->Cell($w[8],5,number_format($json[$i]['kredit_rl']),1,0,'R',$fill);
            $this->Cell($w[9],5,number_format($json[$i]['debet_nr']),1,0,'R',$fill);
            $this->Cell($w[10],5,number_format($json[$i]['kredit_nr']),1,0,'R',$fill);
            //$this->Cell($w[10],5,$json[$i]['cls'],1,0,'R',$fill);
            $this->Ln();
        }
        $this->Cell(array_sum($w),0,'','T');
    }
}
?>