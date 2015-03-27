<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MY_MODEL
 *
 * @author faroq
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

if (!class_exists('CI_Model')) {

    class CI_Model extends Model {
        
    }

}

class MY_MODEL extends CI_Model {

    //put your code here

    function get_rows_paging($sql_search = "", $start, $limit, $table, $select = "", $order = NULL) {
        if ($sql_search != "") {
            $this->db->where($sql_search, NULL);
        }
        if ($select != "") {
            $this->db->select($select);
        }
        if ($order) {
            $this->db->order_by($order[0], $order[1]);
        }
//        $query =$this->db->limit($limit, $start)->get($table);
        $query = $this->db->get($table, $limit, $start);

        $rows = array();

        if ($query->num_rows() > 0) {
            $rows = $query->result();
            $total = $query->num_rows();
        }

        $total = 0;
        if ($sql_search != "") {
            $this->db->where($sql_search, NULL);
        }
        if ($select != "") {
            $this->db->select($select);
        }
        $total = $this->db->get($table)->num_rows();

        $results = '{success:true,record:' . $total . ',data:' . json_encode($rows) . '}';
        return $results;
    }

    function get_rows_table($sql_search = "", $table, $select = "", $order = NULL) {
        if ($sql_search != "") {
            $this->db->where($sql_search, NULL);
        }
        if ($select != "") {
            $this->db->select($select);
        }
        if ($order) {
            $this->db->order_by($order[0], $order[1]);
        }

        $query = $this->db->get($table);

        $rows = array();
        $total = 0;
        if ($query->num_rows() > 0) {
            $rows = $query->result();
            $total = $query->num_rows();
        }
        $results = '{success:true,record:' . $total . ',data:' . json_encode($rows) . '}';
        return $results;
    }

    function SP_getData($spname, $param = NULL) {
        $sql = "";
        $query = NULL;
        if ($param) {
            $genparam = join(',', array_fill(0, count($param), '?'));
            $sql = "call $spname($genparam)";
            $query = $this->db->query($sql, $param);
        } else {
            $sql = "call $spname()";
            $query = $this->db->query($sql);
        }

        $rows = array();
        $total = 0;
        if ($query->num_rows() > 0) {
            $rows = $query->result();
            $total = $query->num_rows();
        }
        $results = '{success:true,record:' . $total . ',data:' . json_encode($rows) . '}';
        return $results;
    }

    function SP_execData($spname, $param = NULL, $msg = false) {
        $sql = "";
        $query = NULL;
        if ($param) {
            $genparam = join(',', array_fill(0, count($param), '?'));
            $sql = "call $spname($genparam)";
            $query = $this->db->query($sql, $param);
        } else {
            $sql = "call $spname()";
            $query = $this->db->query($sql);
        }

        $rows = array();
        $total = 0;

        if ($msg) {
            if ($query->num_rows() > 0) {
                foreach ($query->result() as $row) {

                    if ($row->success) {
                        $success=true;
                        $msg = $row->message;
                    } else {
                        $success=false;
                        $msg = $row->message;
                    }


                    $json = array(
                        "success" => $success,
                        "msg" => $msg
                    );
                }
                $results = json_encode($json);
            } else {
                $json = array(
                    "success" => false,
                    "msg" => 'Execute Aborted'
                );
                $results = json_encode($json);
            }
        } else {
            if ($query->num_rows() > 0) {
                $json = array(
                    "success" => true,
                    "msg" => 'Execute Successfull'
                );
                $results = json_encode($json);
            }else{
                $json = array(
                    "success" => false,
                    "msg" => 'Execute Aborted'
                );
                $results = json_encode($json);
            }
                
        }

        return $results;
    }

}

?>
