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
        $this->db->join("config_website", "config_website.user_id=users.id");
        $this->db->where('users.code_member', $name);
        $this->db->or_where('config_website.storename', $name);
        $this->db->where('users.active', 1);
        $this->db->where('users.deleted_at', NULL);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return true;
        }
        return false;
    }

    function get_aboutus($store_name) {
        $this->db->select('users.id');
        $this->db->from('users');
        $this->db->join("config_website", "config_website.user_id=users.id");
        $this->db->where('users.code_member', $store_name);
        $this->db->or_where('config_website.storename', $store_name);
        $this->db->where('users.active', 1);
        $this->db->where('users.deleted_at', NULL);
        $query_id = $this->db->get();
        $row_id = $query_id->row();

        $query = $this->db->get_where("contents", array("user_id" => $row_id->id, 'disabled' => 1, 'deleted_at' => NULL));
        $row = $query->row();
        return $row->long_desc;
    }

    function get_page_static($store_name, $code_no) {
        $this->db->select('users.id');
        $this->db->from('users');
        $this->db->join("config_website", "config_website.user_id=users.id");
        $this->db->where('users.code_member', $store_name);
        $this->db->or_where('config_website.storename', $store_name);
        $this->db->where('users.active', 1);
        $this->db->where('users.deleted_at', NULL);
        $query_id = $this->db->get();
        $row_id = $query_id->row();

        $this->db->select("contents.long_desc,contents.description, contents.keywords");
        $this->db->from("contents");
        $this->db->join("categories", "contents.cat_id = categories.id");
        $this->db->join("contents_group", "contents_group.id = contents.group_id");
        $this->db->where("contents.user_id", $row_id->id);
        $this->db->where("contents_group.code_no", $code_no);
        $query = $this->db->get();
        $row = $query->row();
        return $row->long_desc;
    }

}
