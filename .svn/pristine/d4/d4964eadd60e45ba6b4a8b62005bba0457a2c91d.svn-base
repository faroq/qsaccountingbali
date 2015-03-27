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
class main extends CI_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model("loadmenu");
    }

    public function index() {
        $this->load->view('main');
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
