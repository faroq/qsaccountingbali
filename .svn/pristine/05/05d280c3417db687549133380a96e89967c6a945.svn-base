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

    public function getMainMenu() {       
        $roleid = ($this->input->post('roleid', TRUE) ? $this->input->post('roleid', TRUE) : "1");
        $menu = $this->loadmenu->getMenu();
        foreach ($menu->result_array() as $ret) {
            $retload = $ret['retval'];
        }
        echo $retload;
    }

}

?>
