<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Store_model
 *
 * @author adisornlam
 */
class Store_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    // add, update, delete
    public function getStore($name) {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('code_member', $name);
        $this->db->or_where('storename', $name);
        $this->db->where('active', 1);
        $this->db->where('deleted_at', NULL);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return true;
        }
        return false;
    }

}
