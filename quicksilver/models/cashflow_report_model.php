<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of cashflow_report_model
 *
 * @author miyzan
 */
class cashflow_report_model extends MY_MODEL {

    //put your code here

    function __construct() {
        parent::__construct();
    }

    function get_row($periode, $tahun,$isjson=1) {
        $periode1=array('01','02','03','04','05','06');
        $periodename1=array('jan','feb','mar','apr','mei','jun');
        $periode2=array('07','08','09','10','11','12');
        $periodename2=array('jul','agust','sept','okt','nov','des');
        $rest1 = array();

        $results='';
        $thbl='';
        $data=array();
        $r=0;
        if ($periode=='PERIODE I'){
            for($i=0;$i<count($periode1);$i++){
                $thbl=$tahun.$periode1[$i];
                $data=  $this->get_data_periode($thbl);
                if($i==0){
                    foreach($data as $v) {
                        array_push($rest1, array(
                        'recgroup' => $v->repgroup, 
                        'groupname' => $v->groupname, 
                        'nomor' => $v->nomor, 
                        'keterangan' => $v->keterangan, 
                        'jan' => $v->saldo, 
                        'feb' => 0,
                        'mar' => 0, 
                        'apr' => 0, 
                        'mei' => 0, 
                        'jun' => 0));
                    }
                }else{
                    for($r=0;$r<count($rest1);$r++){
                        $rest1[$r][$periodename1[$i] ]=$data[$r]->saldo;
                    }
                }
            }
            
        }
        if($periode=='PERIODE II'){
            for($i=0;$i<count($periode2);$i++){
                $thbl=$tahun.$periode2[$i];
                $data=  $this->get_data_periode($thbl);
                if($i==0){
                    foreach($data as $v) {
                        array_push($rest1, array(
                        'recgroup' => $v->repgroup, 
                        'groupname' => $v->groupname, 
                        'nomor' => $v->nomor, 
                        'keterangan' => $v->keterangan, 
                        'jul' => $v->saldo, 
                        'agust' => 0,
                        'sept' => 0, 
                        'okt' => 0, 
                        'nov' => 0, 
                        'des' => 0));
                    }
                }else{
                    for($r=0;$r<count($rest1);$r++){
                        $rest1[$r][$periodename2[$i] ]=$data[$r]->saldo;
                    }
                }
            }
        }
        if($isjson=='y'){
            $results = '{success:true,record:' . count($rest1) . ',data:' . json_encode($rest1) . '}';
        }else{
            $results =$rest1;
        }
        
        return $results;
    }

    function get_data_periode($thbl) {
        $spname = 'sp_cashflow_report';
        $result = $this->SP_getData_array($spname, $thbl); 
        return $result;
    }

}

?>
