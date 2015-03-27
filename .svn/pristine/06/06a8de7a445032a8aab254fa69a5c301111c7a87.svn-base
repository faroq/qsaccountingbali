<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of loadmenu
 *
 * @author faroq
 */
class loadmenu extends CI_Model {

    function __construct() {
        parent::__construct();
        // $this->load->database();
    }

    function getMenu() {
        $db =$this->load->database('default', TRUE);
        $sql = 'call getRoleMenu("1")';
        $result = $db->query($sql);

        return $result;
    }

    //put your code here
    function safe_escape(&$data) {
        if (count($data) <= 0) {
            return $data;
        }

        foreach ($data as $node) {
            $node = $this->db->escape($node);
        }

        return $data;
    }

}

?>