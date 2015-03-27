<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of userman_model
 *
 * @author faroq
 */
class userman_model extends MY_MODEL{
    //put your code here
    function __construct() {
        parent::__construct();
    }
    public function get_role_rows($search="",$start,$limit) {
        $sql_search="";
        if ($search != "") {
            $sql_search = "(lower(role_id) LIKE '%" . strtolower($search) . "%' or role_name LIKE '%" . strtolower($search) . "%')";
//            $this->db->where($sql_search, NULL);
        }
        $select="role_id,role_name,active";
        $order=array("role_id", "asc");     
        $table="acc_sys_role";
        
        $results = $this->get_rows_paging($sql_search,$start,$limit,$table,$select,$order);
        return $results;    
    }
    public function get_user_rows($search="",$start,$limit) {
        $sql_search="";
        if ($search != "") {
            $sql_search = "(lower(user_id) LIKE '%" . strtolower($search) . "%' or role_name LIKE '%" . strtolower($search) . "%')";
//            $this->db->where($sql_search, NULL);
        }
        $select="user_id, user_password, role_id, role_name, aktif ";
        $order=array("user_id", "asc");     
        $table="v_acc_user";
        
        $results = $this->get_rows_paging($sql_search,$start,$limit,$table,$select,$order);
        return $results;    
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
    
    public function get_menu_head_all($checked,$roleid) {       
        $param=array($checked,false,$roleid);
        $spname = 'sp_get_all_menu';
        $result=$this->SP_getData_array($spname, $param);
        return $result;
    }
    
    public function get_menu_child_all($checked,$roleid) {     
        $param=array($checked,true,$roleid);
        $spname = 'sp_get_all_menu';
        $result=$this->SP_getData_array($spname, $param);
        return $result;
    }
    
//    function get_jenis() {
//        $sql_search="";        
//        $select="jenis,nama_jenis";
//        $order=NULL;     
//        $table="acc_jenisaccount";
//        
//        $results = $this->get_rows_table($sql_search,$table,$select,$order);
//        return $results;       
//        
//    }   
    
   function get_role() {
        $sql_search="";        
        $select="role_id,role_name";
        $order=NULL;     
        $table="acc_sys_role";
        $results = $this->usermodel->get_rows_table($sql_search,$table,$select,$order);
        return $results; 
    }
}

?>
