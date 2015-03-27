<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of main
 *
 * @author faroq
 */
class main extends MY_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model("loadmenu");
    }

    public function index() {
        $data['username'] = $this->session->userdata('username');
	$data['jabatan'] = $this->session->userdata('jabatan');
        $data['departement']= $this->session->userdata('departement');
        $data['roleid']= $this->session->userdata('roleid');
//        $roleid =$this->session->userdata('roleid');
//	$accordion_menu = $this->my_auth->get_accordion_menu($this->session->userdata('kd_group'));
//	$data['accordion_menu'] = $accordion_menu;
									
        $this->load->view('main', $data);  
//        $this->load->view('main');
    }

    public function getMainMenu_lm() {       
        $roleid = ($this->input->post('roleid', TRUE) ? $this->input->post('roleid', TRUE) : "1");
        $menu = $this->loadmenu->getMenu();
        foreach ($menu->result_array() as $ret) {
            $retload = $ret['retval'];
        }
        echo $retload;
    }
    
    
    
    
    public function get_child_level($findhead, $child, $level) {
        $resArr = array();
//        print 'find '.$findhead."\n";

        foreach ($child as $c) {
            if ($c->parentmenu == $findhead) {
                $levelt = $level + 1;
                //array_push($resArr, array('groupakun'=>$c->groupakun,'kd_akun' => $levelt . '-' . $c->kd_akun, 'nama' => $c->nama, 'jumlah' => $c->jumlah));
//                array_push($resArr, array('groupakun'=>$c->groupakun,'isheader' => $c->header_status,'kd_akun' => $c->kd_akun, 'nama' => $c->nama, 'jumlah' => $c->jumlah,'total' => NULL ));
                $arrget = $this->get_child_level($c->idmenu, $child, $levelt);
                if (count($arrget) > 0){
                    array_push($resArr, array('id'=>$c->idmenu,'text' => $c->namemenu,'expanded' => false, 'children' => $arrget));
                }else{
                    array_push($resArr, array('id'=>$c->idmenu,'text' => $c->namemenu,'iconCls'=>'icon-save','leaf'=>true));
                }
                
            }
        }
        return $resArr;
    }

    public function get_max_level($head, $child) {
        $resArr = array();
        $level = 0;
//        print json_encode($child)."\n";

        foreach ($head as $h) {
            //array_push($resArr, array('kd_akun' => $level.'-'.$h->kd_akun,'parent_kd_akun' =>''));
            $arrch = $this->get_child_level($h->idmenu, $child, $level);
            if (count($arrch) > 0) {
                array_push($resArr, array('id'=>$h->idmenu,'text' => $h->namemenu,'expanded' => true, 'children' => $arrch));
//                foreach ($arrch as $ac) {
//                    array_push($resArr, $ac);
//                }
            }else{
                array_push($resArr, array('id'=>$h->idmenu,'text' => $h->namemenu,'iconCls'=>'icon-save','leaf'=>true));
            }
            $level = 0;
        }
        return $resArr;
    }
    
    public function getMainMenu() {       
        $roleid = ($this->input->post('roleid', TRUE) ? $this->input->post('roleid', TRUE) : "1");
        $head = $this->loadmenu->get_menu_head($roleid);
        $child = $this->loadmenu->get_menu_child($roleid);
        $resArr=array();
        $resArr = $this->get_max_level($head, $child);
        echo json_encode($resArr);
    }

}

?>
