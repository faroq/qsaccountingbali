<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class global_reference extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('global_reference_model', 'global_reference_model');
    } 
    
    public function get_jenis()
    {
        $result = $this->global_reference_model->get_jenis();
        echo $result;
    }

    public function get_dk()
    {
        $result = $this->global_reference_model->get_dk();
        echo $result;
    }
}

?>
