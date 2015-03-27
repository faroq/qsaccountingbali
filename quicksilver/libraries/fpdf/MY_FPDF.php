<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class MY_FPDF extends FPDF {
    var $cetak;
    var $lineh;
    var $hfill;
    var $hheader;
    var $revdata;
    var $logourl;
    var $companyname;
    var $companyaddress;
    var $dataheader;
    var $CI;
//    public function MY_FPDF(){
//        
//    }
    //===============
        var $widths;
	var $aligns;

    
   
        
 public function set_header_column($w){
     
 }
        
	function SetWidths($w)
	{
		//Set the array of column widths
		$this->widths=$w;
	}
 
	function SetAligns($a)
	{
		//Set the array of column alignments
		$this->aligns=$a;
	}
        function RowHead($data,$wd,$al,$hkali,$rect,$pb=0,$b=0,$bcolumn=NULL,
                $usenumberformat=false,$numbercolumn=NULL,$bordertype=NULL)
	{
		//Calculate the height of the row
		$nb=0;
		for($i=0;$i<count($data);$i++)
			$nb=max($nb,$this->NbLines($wd[$i],$data[$i]));
		$h=$hkali*$nb;
		//Issue a page break first if needed
                if($pb==1){
                    $this->CheckPageBreak($h);
                }
		//Draw the cells of the row
		for($i=0;$i<count($data);$i++)
		{
			$w=$wd[$i];
			$a=isset($al[$i]) ? $al[$i] : 'L';
			//Save the current position
			$x=$this->GetX();
			$y=$this->GetY();
			//Draw the border
                        if($rect==1){
                            $this->Rect($x,$y,$w,$h);
                        }
//			
			//Print the text
                        if($usenumberformat){
                            if($numbercolumn){
                                foreach($numbercolumn as $k){
                                    if($k==$i){
                                        if(is_numeric($data[$i])){
                                            $data[$i]=number_format($data[$i]);
                                        }
                                    }
                                }
                            }else{
                                if(is_numeric($data[$i])){
                                    $data[$i]=number_format($data[$i]);
                                }
                            }
                            
                        }
                        $bt=$b;
                        if($bcolumn){
                            $ada=0;
                            if($bordertype){
                                if(count($bordertype) == count($bcolumn)){
                                    for($ib=0;$ib<$bcolumn;$ib++){
                                        if($ib == $i){
                                            $ada=2;
                                            $bt=$bordertype[$ib];
                                        }
                                    }
                                }
                                
                            }else{
                                foreach($bcolumn as $k){
                                    if($k==$i){
                                        $ada=1;
                                    }
                                }
                            }
                            
                            if($ada==1){
                                $this->MultiCell($w,$hkali,$data[$i],$b,$a);
                            }elseif ($ada==2) {
                                $this->MultiCell($w,$hkali,$data[$i],$bt,$a);
                            } else{
                                $this->MultiCell($w,$hkali,$data[$i],0,$a);
                            }
                            
                        }else{
                            $this->MultiCell($w,$hkali,$data[$i],0,$a);
                        }
			//Put the position to the right of the cell
			$this->SetXY($x+$w,$y);
                       
                        
                        
                        
		}
                
		//Go to the next line
		$this->Ln($h);
                $this->lineh=$h;
                
                
	}
        
	function Row($data,$st)
	{
		//Calculate the height of the row
		$nb=0;
		for($i=0;$i<count($data);$i++)
			$nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
		$h=4*$nb;
		//Issue a page break first if needed
		$this->CheckPageBreak($h,$st);
		//Draw the cells of the row
		for($i=0;$i<count($data);$i++)
		{
			$w=$this->widths[$i];
			$a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
			//Save the current position
			$x=$this->GetX();
			$y=$this->GetY();
			//Draw the border
			$this->Rect($x,$y,$w,$h);
			//Print the text
                        if(is_numeric($data[$i])){
                            $data[$i]=number_format($data[$i]);
                        }
			$this->MultiCell($w,4,$data[$i],0,$a);
			//Put the position to the right of the cell
			$this->SetXY($x+$w,$y);
                       
                        
                        
                        
		}
                
		//Go to the next line
		$this->Ln($h);
                $this->lineh=$h;
                
                
	}
 
        function CheckPageBreakLegal($h,$st=array())
	{
		//If the height h would cause an overflow, add a new page immediately
		if($this->GetY()+$h>$this->PageBreakTrigger){
                    	$this->AddPage($this->CurOrientation);
                        $this->set_subtitle($st);
//                        $this->set_header_column($this->widths);
                }
		
                
	}
	function CheckPageBreak($h,$setheader=true,$st=array())
	{
		//If the height h would cause an overflow, add a new page immediately
		if($this->GetY()+$h>$this->PageBreakTrigger){
                    	$this->AddPage($this->CurOrientation);
//                        $this->set_subtitle($st);
                        if($setheader){
                            $this->set_header_column($this->widths);
                        }
                        
                }
		
                
	}
        
        
 
	function NbLines($w,$txt)
	{
		//Computes the number of lines a MultiCell of width w will take
		$cw=&$this->CurrentFont['cw'];
		if($w==0)
			$w=$this->w-$this->rMargin-$this->x;
		$wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
		$s=str_replace("\r",'',$txt);
		$nb=strlen($s);
		if($nb>0 and $s[$nb-1]=="\n")
			$nb--;
		$sep=-1;
		$i=0;
		$j=0;
		$l=0;
		$nl=1;
		while($i<$nb)
		{
			$c=$s[$i];
			if($c=="\n")
			{
				$i++;
				$sep=-1;
				$j=$i;
				$l=0;
				$nl++;
				continue;
			}
			if($c==' ')
				$sep=$i;
			$l+=$cw[$c];
			if($l>$wmax)
			{
				if($sep==-1)
				{
					if($i==$j)
						$i++;
				}
				else
					$i=$sep+1;
				$sep=-1;
				$j=$i;
				$l=0;
				$nl++;
			}
			else
				$i++;
		}
		return $nl;
	}
//===================================================  
    public function setUrlLogo($url) {
        $this->logourl = $url;
    }

    public function setCompany($name,$address) {
        $this->companyname =  $name;
        $this->companyaddress = $address;
//        $this->namasekolah = $value;
    }
//
//    public function setAlamat($value) {
//        $this->alamat = $value;
//    }

    public function setDataheader($value) {
        $this->dataheader = $value;
    }
}
?>
