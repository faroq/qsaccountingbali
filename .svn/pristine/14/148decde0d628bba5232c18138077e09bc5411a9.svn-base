<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of user_setting
 *
 * @author faroq
 */
class user_setting extends MY_Controller{
    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('userman_model','usermodel');        
    }
    public function get_rows() {

        $page = ($this->input->post('page', TRUE) ? $this->input->post('page', TRUE) : 1);
        $start = isset($_POST['start']) ? $this->db->escape_str($this->input->post('start', TRUE)) : 0;
        $limit = isset($_POST['limit']) ? $this->db->escape_str($this->input->post('limit', TRUE)) : $this->config->item("length_records");
        $search = isset($_POST['query']) ? $this->db->escape_str($this->input->post('query', TRUE)) : '';

        $result = $this->usermodel->get_user_rows($search, $start, $limit);
        echo $result;
    } 
    
    public function get_role() {
        
        $results = $this->usermodel->get_role();
        echo $results; 
    }
    
    public function update_rows() {
        $opt = isset($_POST['cmd']) ? $this->db->escape_str($this->input->post('cmd', TRUE)) : '';
        $user_id = isset($_POST['user_id']) ? $this->db->escape_str($this->input->post('user_id', TRUE)) : FALSE;
        $user_password = isset($_POST['user_password']) ? $this->db->escape_str($this->input->post('user_password', TRUE)) : '';
        $new_password = isset($_POST['user_password']) ? $this->db->escape_str($this->input->post('user_password', TRUE)) : NULL;
        $role_id = isset($_POST['role_id']) ? $this->db->escape_str($this->input->post('role_id', TRUE)) : FALSE;        
        $aktif = isset($_POST['aktif']) ? $this->db->escape_str($this->input->post('aktif', TRUE)) : FALSE;
        
        if ($aktif=='on'){
            $aktif=1;
        }else{
            $aktif=0;
        }

        $result='';
        $param = array($opt,$user_id,$user_password, $role_id, $aktif, $new_password);
        $spname = 'sp_user';
        $retval = $this->usermodel->SP_execData($spname, $param, true);
        $result=$retval;
        
        echo $result;
    }
    public function delete_row() {
        $opt = isset($_POST['cmd']) ? $this->db->escape_str($this->input->post('cmd', TRUE)) : '';
        $data = isset($_POST['postdata']) ? json_decode($this->input->post('postdata', TRUE)): array(); 
        
        $user_id=$data->user_id;
        $user_password=NULL;
        $role_id=NULL; 
        $aktif=NULL; 
        $new_password=NULL;
        
        
        $param = array($opt,$user_id,$user_password, $role_id, $aktif, $new_password);
        $spname = 'sp_user';
        $result = $this->usermodel->SP_execData($spname, $param, true);
        echo $result;
        
    }
    
    public function reset_password() {
        $opt = isset($_POST['cmd']) ? $this->db->escape_str($this->input->post('cmd', TRUE)) : '';
        $user_id = isset($_POST['user_id']) ? $this->db->escape_str($this->input->post('user_id', TRUE)) : FALSE;
        $user_password = isset($_POST['user_password']) ? $this->db->escape_str($this->input->post('user_password', TRUE)) : '';
        
//        $user_id=$data->user_id;
//        $user_password=$data->user_password;
        $role_id=NULL; 
        $aktif=NULL; 
        $new_password=NULL;
        
        
        $param = array($opt,$user_id,$user_password, $role_id, $aktif, $new_password);
        $spname = 'sp_user';
        $result = $this->usermodel->SP_execData($spname, $param, true);
        echo $result;
        
    }
    public function update_password() {
        $opt = isset($_POST['cmd']) ? $this->db->escape_str($this->input->post('cmd', TRUE)) : '';
        $user_id = isset($_POST['user_id']) ? $this->db->escape_str($this->input->post('user_id', TRUE)) : FALSE;
        $user_password = isset($_POST['user_password']) ? $this->db->escape_str($this->input->post('user_password', TRUE)) : '';
        $new_password = isset($_POST['new_password']) ? $this->db->escape_str($this->input->post('new_password', TRUE)) : NULL;
//        $data = isset($_POST['postdata']) ? json_decode($this->input->post('postdata', TRUE)): array(); 
        
//        $user_id=$data->user_id;
//        $user_password=$data->user_password;
        $role_id=NULL; 
        $aktif=NULL; 
//        $new_password=$data->new_password;
        
        
        $param = array($opt,$user_id,$user_password, $role_id, $aktif, $new_password);
        $spname = 'sp_user';
        $result = $this->usermodel->SP_execData($spname, $param, true);
        echo $result;
        
    }
    public function set_aktif() {
        $opt = isset($_POST['cmd']) ? $this->db->escape_str($this->input->post('cmd', TRUE)) : '';
        $data = isset($_POST['postdata']) ? json_decode($this->input->post('postdata', TRUE)): array(); 
        
        $user_id=$data->user_id;
        $user_password=NULL;
        $role_id=NULL; 
        $aktif=$data->aktif; 
        $new_password=NULL;
        
        
        $param = array($opt,$user_id,$user_password, $role_id, $aktif, $new_password);
        $spname = 'sp_user';
        $result = $this->usermodel->SP_execData($spname, $param, true);
        echo $result;
        
    }
}

?>
