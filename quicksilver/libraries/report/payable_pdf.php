<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/**
 * Description of payable_pdf
 *
 * @author miyzan
 */
class payable_pdf extends MY_FPDF{
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
            else $this->Cell(400,5,$this->dataheader[1],1,0,'L',false);
            $this->SetY(36);
            //Line break 37 y
            $this->Ln(1);
    }
    function Footer()
    {
            //Position at 1.5 cm from bottom
            $this->SetY(-15);
            //Arial italic 8
            $this->SetFont('Arial','I',8);
            //Page number
            $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
    }
    
     public function set_header_column($w) {
        $head=array("Tanggal", "Keterangan", "Referensi", "Debet", "Kredit", "Jumlah");        
        $alignhead=array('C', 'C', 'C', 'C', 'C', 'C');
        $borderhead=array('TB', 'TB', 'TB', 'TB', 'TB', 'TB');
        $this->SetFont('Arial', 'B', 10);
        $this->SetX(10);
        for($i=0;$i<count($w);$i++){
            $this->Cell($w[$i], 6, $head[$i], $borderhead[$i], 0,$alignhead[$i]);
        }
        
        $this->Ln();
        $this->SetFont('Arial', '', 10);
    } 
    
    function create_pdf($filter1,$filter2, $data)
    {
        $this->AddPage();
        $this->SetAutoPageBreak(true,18);
        $this->SetDrawColor(0);
        $this->SetLineWidth(.3);
        
        $w=array(40, 160, 50, 50, 50, 50);  
        $al=array('C', 'L', 'C','R','R','R');
        $this->SetWidths($w);
        $this->SetAligns($al);
        $this->lineh=5;
        $this->set_header_column($w);
                
//        $json = json_decode($data, true);
        $lastjenis = "";
        $fill=false;
        $number=0;
        foreach ($data as $v) {
            if ($filter2 == 'Semua Rekening'){
                if($v->rekening !== $lastjenis){
                    
                    $this->CheckPageBreak($this->lineh+10);
                    $this->SetY($this->GetY()+2);
                    $lastjenis =$v->rekening;
                    $this->SetDrawColor(0);
                    $this->SetFont('Arial','B',10);
                    $this->Cell($w[0]+$w[1]+$w[2]+$w[3]+$w[4]+$w[5],5,$v->rekening,'B',0,'L',$fill);
                    $this->SetFont('Arial','',10);
                    $this->Ln();
                }
            }
//            if($v->kd_kelas !== $kelas)
//            {
////                if($kelas !== ''){
//                    $this->Ln();
////                }
//                $number=0;
//                $kelas=$v->kd_kelas;
//                $this->CheckPageBreak($this->lineh+8);
////                $this->lineh=$h;
//                $this->SetFont('Arial', 'BI', 8);
//                $this->SetX(5);
//                $this->Cell(200, $this->lineh, $v->kelas, 0, 0, 'L', false);
//                $this->Ln();
//            }
            $number++;
            $this->SetFont('Arial', '', 10);
            if($v->keterangan=='SALDO AWAL' || $v->keterangan=='SALDO AKHIR'){
                $this->SetFont('Arial', 'B', 10);
                $this->RowHead(
                        array(                            
                            $v->tanggal,
                            $v->keterangan,
                            $v->referensi,
                            number_format($v->debet),
                            number_format($v->kredit),
                            number_format($v->jumlah)
                        ),
                        $w,
                        $al,   
                        $this->lineh,0,1
                    );
            }else{
                $this->RowHead(
                        array(                            
                            $v->tanggal,
                            $v->keterangan,
                            $v->referensi,
                            number_format($v->debet),
                            number_format($v->kredit),
                            number_format($v->jumlah)
                        ),
                        $w,
                        $al,   
                        $this->lineh,0,1
                    );
            }
            
            

//            $this->RowHead(
//                        array(                            
//                            $v->tanggal,
//                            $v->keterangan,
//                            $v->referensi,
//                            number_format($v->debet),
//                            number_format($v->kredit),
//                            number_format($v->jumlah)
//                        ),
//                        $w,
//                        $al,   
//                        $this->lineh,0,1
//                    );
            if($v->keterangan=='SALDO AKHIR'){
                                $this->SetDrawColor(194,193,193);
                    
                        $this->Line(10, $this->GetY(), 410, $this->GetY());
                        $this->SetDrawColor(0);
                    }
        }
    }
    
}

?>
