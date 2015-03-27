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
    
    public function get_menu_head($roleid) {       
//        $db =$this->load->database('default', TRUE);
        $this->db->where('role_id', $roleid);
        $this->db->where('isheader', true);
        $this->db->where('parentmenu', '0');
        $this->db->order_by('idmenu','asc');
        $query=$this->db->get('v_acc_rolemenu');        
        return $query->result();
    }
    
    public function get_menu_child($roleid) {     
        $sqlwhere="parentmenu <> '0'";
        $this->db->where('role_id', $roleid);
        $this->db->where($sqlwhere,NULL);
        $this->db->order_by('idmenu','asc');
        $query=$this->db->get('v_acc_rolemenu');        
        return $query->result();
    }

}

?>