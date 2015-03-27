<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

//  CI 2.0 Compatibility
if (!class_exists('CI_Model')) {

    class CI_Model extends Model {
        
    }

}

class Auth_model extends CI_Model {

    /**
     * @author dhamarsu
     * @editedby luxse
     * @lastedited 2 jan 2012
     */
    public function __construct() {
        parent::__construct();

        $this->salt_length = $this->config->item('salt_length');
        $this->min_password_length = $this->config->item('min_password_length');

        /**
         * Checks if salt length is at least the length
         * of the minimum password length.
         * */
        if ($this->salt_length < $this->min_password_length) {
            $this->salt_length = $this->min_password_length;
        }
    }

    /**
     * @author dhamarsu
     * @editedby luxse
     * @lastedited 2 jan 2012
     */
    public function login($username, $password, $remember = false) {
        if (empty($username) || empty($password)) {
            return FALSE;
        }
        $sql = "";
        $query = NULL;
        $param = array($username,$password);
        
            $genparam = join(',', array_fill(0, count($param), '?'));
            $sql = "call sp_login($genparam)";
            $query = $this->db->query($sql, $param);
        

        $rows = array();
        $total = 0;
        if ($query->num_rows() === 1) {
            $result = $query->row();
            {

                $session_data = array(
                    'username' => $result->user_id,                    
                    'rolename' => $result->role_name,
//                    'departement' => $result->departement,
                    'roleid' => $result->role_id                  
                );
//                $sesdata=  json_encode($session_data);
                $this->session->set_userdata($session_data);
                
//                $param_data = $this->loadParameter();
//                foreach ($param_data as $param){
//                    $param_array = array(
//                        $param->kd_parameter    => $param->nilai_parameter
//                    );
//                    $this->session->set_userdata($param_array);
//                }
                return TRUE;
            }
        }
        return FALSE;        
    }
    
    public function loadParameter(){
        $this->db->select('kd_parameter, nilai_parameter');
        $query = $this->db->get('mst.t_parameter');
        return $query->result();
    }

    /**
     * @author dhamarsu
     * @editedby luxse
     * @lastedited 2 jan 2012
     */
    public function change_password($username, $old, $new) {
        $query = $this->db->select('passwd')
                ->where('username', $username)
                ->where('aktif is true', NULL)
                ->limit(1)
                ->get('secman.t_user');

        $result = $query->row();

        $db_password = $result->passwd;
        $old = $this->md5_password($old);
        $new = $this->md5_password($new);

        if ($db_password === $old) {
            //store the new password
            $data = array(
                'passwd' => $new
            );

            $this->db->where('username', $username);
            $this->db->update('secman.t_user', $data);

            return TRUE;
        }

        return FALSE;
    }

    /**
     * @author dhamarsu
     * @editedby luxse
     * @lastedited 2 jan 2012
     */
    public function hash_password($password) {
        if (empty($password)) {
            return FALSE;
        }

        $salt = $this->salt();
        return $salt . substr(sha1($salt . $password), 0, -$this->salt_length);
    }

    /**
     * @author dhamarsu
     * @editedby luxse
     * @lastedited 2 jan 2012
     */
    public function hash_password_db($username, $password) {
        if (empty($username) || empty($password)) {
            return FALSE;
        }

        $query = $this->db->select('passwd')
                ->where('username', $username)
                ->where('aktif is true', NULL)
                ->limit(1)
                ->get('secman.t_user');

        $result = $query->row();

        if ($query->num_rows() !== 1) {
            return FALSE;
        }


        $salt = substr($result->passwd, 0, $this->salt_length);

        return $salt . substr(sha1($salt . $password), 0, -$this->salt_length);
    }
    
    /**
     * @author dhamarsu
     * @editedby luxse
     * @lastedited 2 jan 2012
     */
    public function md5_password($password) {
       

        return md5($password);
    }

    /**
     * @author dhamarsu
     * @editedby luxse
     * @lastedited 2 jan 2012
     */
    public function salt() {
        return substr(md5(uniqid(rand(), true)), 0, $this->salt_length);
    }

    /**
     * @author dhamarsu
     * @editedby luxse
     * @lastedited 2 jan 2012
     */
    public function get_accordion_menu($kd_group) {
        $this->db->select("b.*");
        $this->db->where("a.kd_group", $kd_group);
        $this->db->where("a.aktif is true", NULL);
        $this->db->where("b.aktif", 1);
        $this->db->where("(b.kd_parent_menu = '' OR b.kd_parent_menu is null)", NULL);
        $this->db->join("secman.t_menu b", "a.kd_menu = b.kd_menu");
        $query = $this->db->get("secman.t_groupmenu a");

        if ($query->num_rows() === 0) {
            return FALSE;
        }

        return $query->result();
    }

    /**
     * @author dhamarsu
     * @editedby luxse
     * @lastedited 2 jan 2012
     */
    public function get_tree_menu($menu_parent, $kd_group) {
        $sql = "SELECT 
					kd_menu, kd_parent_menu, menu_id as id, menu_text as text
				FROM
					secman.t_menu
				WHERE
					kd_parent_menu = '" . $menu_parent . "'
				AND
					kd_menu IN (
						SELECT kd_menu FROM secman.t_groupmenu
						WHERE kd_group = '" . $kd_group . "' AND aktif is true
					)
				AND aktif = 1";

        $query = $this->db->query($sql);

        if ($query->num_rows() === 0) {
            return FALSE;
        }

        $rows = $query->result();

        foreach ($rows as $obj) {
            $obj->leaf = true;
            $have_children = $this->get_tree_menu($obj->kd_menu, $kd_group);

            if ($have_children) {
                $obj->children = $have_children;
                $obj->leaf = false;
                $obj->expanded = true;
            }
        }

        return $rows;
    }

}
