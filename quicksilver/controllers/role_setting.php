<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of role_setting
 *
 * @author faroq
 */
class role_setting extends MY_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('userman_model', 'um');
//        $this->load->model('loadmenu','lm');
    }

    public function get_rows() {

        $page = ($this->input->post('page', TRUE) ? $this->input->post('page', TRUE) : 1);
        $start = isset($_POST['start']) ? $this->db->escape_str($this->input->post('start', TRUE)) : 0;
        $limit = isset($_POST['limit']) ? $this->db->escape_str($this->input->post('limit', TRUE)) : $this->config->item("length_records");
        $search = isset($_POST['query']) ? $this->db->escape_str($this->input->post('query', TRUE)) : '';

        $result = $this->um->get_role_rows($search, $start, $limit);
        echo $result;
    }

    public function get_child_level($findhead, $child, $level) {
        $resArr = array();

        foreach ($child as $c) {
            if ($c->parentmenu == $findhead) {
                $levelt = $level + 1;
                $arrget = $this->get_child_level($c->idmenu, $child, $levelt);
                if (count($arrget) > 0) {
                    array_push($resArr, array('id' => $c->idmenu, 'text' => $c->namemenu, 'expanded' => false, 'children' => $arrget));
                } else {
                    array_push($resArr, array('id' => $c->idmenu, 'text' => $c->namemenu, 'iconCls' => 'icon-save', 'leaf' => true));
                }
            }
        }
        return $resArr;
    }

    public function get_max_level($head, $child) {
        $resArr = array();
        $level = 0;

        foreach ($head as $h) {

            $arrch = $this->get_child_level($h->idmenu, $child, $level);
            if (count($arrch) > 0) {
                array_push($resArr, array('id' => $h->idmenu, 'text' => $h->namemenu, 'expanded' => true, 'children' => $arrch));
            } else {
                array_push($resArr, array('id' => $h->idmenu, 'text' => $h->namemenu, 'iconCls' => 'icon-save', 'leaf' => true));
            }
            $level = 0;
        }
        return $resArr;
    }

    public function get_child_level_all($findhead, $child, $level) {
        $resArr = array();
        $hselect = false;
        foreach ($child as $c) {
            if ($c->parentmenu == $findhead) {
                $hselect = false;
                if ($c->selected == 0) {
                    $hselect = false;
                } elseif ($c->selected == 1) {
                    $hselect = true;
                }
                $levelt = $level + 1;
                $arrget = $this->get_child_level_all($c->idmenu, $child, $levelt);
                if (count($arrget) > 0) {
                    array_push($resArr, array('id' => $c->idmenu, 'text' => $c->namemenu, 'expanded' => true, 'checked' => $hselect, 'children' => $arrget));
                } else {
                    array_push($resArr, array('id' => $c->idmenu, 'text' => $c->namemenu, 'iconCls' => 'icon-save', 'checked' => $hselect, 'leaf' => true));
                }
            }
        }
        return $resArr;
    }

    public function get_max_level_All($head, $child) {
        $resArr = array();
        $level = 0;
        $hselect = false;
        foreach ($head as $h) {
            $hselect = false;
            if ($h->selected == 0) {
                $hselect = false;
            } elseif ($h->selected == 1) {
                $hselect = true;
            }
            $arrch = $this->get_child_level_all($h->idmenu, $child, $level);
            if (count($arrch) > 0) {
                array_push($resArr, array('id' => $h->idmenu, 'text' => $h->namemenu, 'expanded' => true, 'checked' => $hselect, 'children' => $arrch));
            } else {
                array_push($resArr, array('id' => $h->idmenu, 'text' => $h->namemenu, 'iconCls' => 'icon-save', 'leaf' => true, 'checked' => $hselect));
            }
            $level = 0;
        }
        return $resArr;
    }

    public function get_detail() {
        $roleid = isset($_GET['roleid']) ? $this->db->escape_str($this->input->get('roleid', TRUE)) : '0';
        $head = $this->um->get_menu_head($roleid);
        $child = $this->um->get_menu_child($roleid);
        $resArr = array();
        $resArr = $this->get_max_level($head, $child);
        echo json_encode($resArr);
    }

    public function get_detail_edit() {
        $role_id = isset($_GET['roleid']) ? $this->db->escape_str($this->input->get('roleid', TRUE)) : NULL;
        $checked = isset($_GET['checked']) ? $this->db->escape_str($this->input->get('checked', TRUE)) : 0;
//        echo $role_id;
        $head = $this->um->get_menu_head_all($checked,$role_id);
        $child = $this->um->get_menu_child_all($checked,$role_id);
//        echo json_encode($head) .' '. json_encode($child);
        $resArr = array();
        $resArr = $this->get_max_level_all($head, $child);
        echo json_encode($resArr);
    }

    public function update_rows() {
        $opt = isset($_POST['cmd']) ? $this->db->escape_str($this->input->post('cmd', TRUE)) : '';
        $role_id = isset($_POST['role_id']) ? $this->db->escape_str($this->input->post('role_id', TRUE)) : FALSE;
        $role_name = isset($_POST['role_name']) ? $this->db->escape_str($this->input->post('role_name', TRUE)) : '';
        $active = isset($_POST['active']) ? $this->db->escape_str($this->input->post('active', TRUE)) : FALSE;
        $data = isset($_POST['rolemenu']) ? json_decode($this->input->post('rolemenu', TRUE)) : array();
        if ($active=='on'){
            $active=1;
        }else{
            $active=0;
        }
//        echo $opt.' '.$role_id;
//        return;
        $result='';
        $param = array($opt, $role_id, $role_name, $active);
        $spname = 'sp_role';
        $retval = $this->um->SP_execData($spname, $param, false);
        $result=$retval;
        $jresult = json_decode($retval);
        
            if ($jresult->success) {
                $param = array('delete', $role_id, NULL);
                $spname = 'sp_rolemenu';
                $retval = $this->um->SP_execData($spname, $param, true);

                foreach ($data as $r) {
                    $param = array('insert', $role_id, $r->idmenu);
                    $spname = 'sp_rolemenu';
                    $retval = $this->um->SP_execData($spname, $param, true);
                }
            }
      
        echo $result;
    }
    public function delete_row() {
        $opt = isset($_POST['cmd']) ? $this->db->escape_str($this->input->post('cmd', TRUE)) : '';
        $data = isset($_POST['postdata']) ? json_decode($this->input->post('postdata', TRUE)): array(); 
        
        $role_id=$data->role_id;
        $role_name='';
        $active=0;
        
        
        $param = array($opt, $role_id,$role_name, $active);
        $spname = 'sp_role';
        $result = $this->um->SP_execData($spname, $param, true);
        echo $result;
        
    }

}

?>
