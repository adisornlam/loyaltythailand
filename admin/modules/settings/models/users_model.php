<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 *  @Auther : Adisorn Lamsombuth
 *  @Email : postyim@gmail.com
 *  @Website : esabay.com 
 */

/**
 * Description of products_model
 *
 * @author R-D-6
 */
class Users_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->library('datatables');
        $this->load->helper('settings/useful');
    }

    //listall
    function admin_listall() {
        $this->datatables->select(
            'users.id as id, '
            . 'groups.name as group_name, '
            . 'email, '
            . 'first_name, '
            . 'last_name, '
            . 'created_on, '
            . 'last_login, '
            . 'active'
            . '');
        $this->datatables->from('users');
        $this->datatables->join('users_groups', 'users_groups.user_id=users.id', 'inner');
        $this->datatables->join('groups', 'groups.id=users_groups.group_id', 'inner');

        $link = "<div class=\"dropdown\">";
        $link .= "<a class=\"dropdown-toggle\" data-toggle=\"dropdown\" href=\"javascript:;\"><span class=\"fa fa-pencil-square-o\"></span ></a>";
        $link .= "<ul class=\"dropdown-menu\" role=\"menu\" aria-labelledby=\"dLabel\">";
        $link .= "<li><a href=\"javascript:;\" rel=\"settings/users/edit/$1\" class=\"link_dialog\" title=\"Edit Users\">Edit Users</a></li>";
        $link .= "<li><a href=\"javascript:;\" rel=\"settings/users/delete/$1\" class=\"link_dialog delete\" title=\"Delete Users\">Delete Users</a></li>";
        $link .= "</ul>";
        $link .= "</div>";

        $this->datatables->edit_column('id', $link, 'id');
        $this->datatables->add_column('full_name', '$1 $2', 'first_name, last_name');
        $this->datatables->edit_column('active', '$1', 'check_disabled(active,1)');
        $this->datatables->edit_column('created_on', '$1', 'date("d-m-Y h:i:s",created_on)');
        $this->datatables->edit_column('last_login', '$1', 'date("d-m-Y h:i:s",last_login)');
        return $this->datatables->generate();
    }

    function owner_listall() {
        $this->datatables->select(
            'users.id as id, '
            . 'users.code_member as code_member, '
            . 'groups.name as group_name, '
            . 'users.email as email, '
            . 'users.first_name as first_name, '
            . 'users.last_name as last_name, '
            . 'users.created_on as created_on, '
            . 'users.last_login as last_login, '
            . 'users.active as active, '
            . 'branch_item.title as branch_title'
            . '');
        $this->datatables->from('users');
        $this->datatables->join('users_groups', 'users_groups.user_id=users.id', 'inner');
        $this->datatables->join('users_branchs', 'users_branchs.user_id=users.id', 'left');
        $this->datatables->join('groups', 'groups.id=users_groups.group_id', 'inner');
        $this->datatables->join('branch_item', 'branch_item.id=users_branchs.branch_id', 'left');
        $this->datatables->where_in('groups.name',array('owner','employee','teacher'));

        $link = "<div class=\"dropdown\">";
        $link .= "<a class=\"dropdown-toggle\" data-toggle=\"dropdown\" href=\"javascript:;\"><span class=\"fa fa-pencil-square-o\"></span ></a>";
        $link .= "<ul class=\"dropdown-menu\" role=\"menu\" aria-labelledby=\"dLabel\">";
        $link .= "<li><a href=\"javascript:;\" rel=\"settings/users/edit/$1\" class=\"link_dialog\" title=\"Edit Users\">Edit Users</a></li>";
        $link .= "<li><a href=\"javascript:;\" rel=\"settings/users/delete/$1\" class=\"link_dialog delete\" title=\"Delete Users\">Delete Users</a></li>";
        $link .= "</ul>";
        $link .= "</div>";

        $this->datatables->edit_column('id', $link, 'id');
        $this->datatables->add_column('full_name', '$1 $2', 'first_name, last_name');
        $this->datatables->edit_column('active', '$1', 'check_disabled(active,1)');
        $this->datatables->edit_column('created_on', '$1', 'date("d-m-Y h:i:s",created_on)');
        $this->datatables->edit_column('last_login', '$1', 'date("d-m-Y h:i:s",last_login)');
        return $this->datatables->generate();
    }

    function get_group_listall() {
        $this->load->library('datatables');

        $this->datatables->select(
            'id, '
            . 'name, '
            . 'description'
            . '');
        $this->datatables->from('groups');

        $link = "<div class=\"dropdown\">";
        $link .= "<a class=\"dropdown-toggle\" data-toggle=\"dropdown\" href=\"javascript:;\"><span class=\"fa fa-pencil-square-o\"></span ></a>";
        $link .= "<ul class=\"dropdown-menu\" role=\"menu\" aria-labelledby=\"dLabel\">";
        $link .= "<li><a href=\"javascript:;\" rel=\"settings/users/group_edit/$1\" class=\"link_dialog\" title=\"Edit Group\">Edit Group</a></li>";
        $link .= "<li><a href=\"javascript:;\" rel=\"settings/result_users/group_delete/$1\" class=\"link_dialog delete\" title=\"Delete Group\">Delete Group</a></li>";
        $link .= "</ul>";
        $link .= "</div>";

        $this->datatables->edit_column('id', $link, 'id');
        return $this->datatables->generate();
    }

    //function
    public function get_item($id) {
        $this->db->select('users.*,users_groups.group_id');
        $this->db->from('users');
        $this->db->join('users_groups', 'users_groups.user_id=users.id', 'inner');
        $this->db->where('users.id', $id);
        $query = $this->db->get();
        return $query->row();
    }

    function get_group_ddl() {
        $group = array('owner');

        $this->db->select('*');
        $this->db->from('groups');
        $this->db->where('perms',0);
        $query = $this->db->get();
        $arr_cat = array(
            '' => 'Please select'
            );
        foreach ($query->result() as $val) {
            $arr_cat[$val->id] = $val->name;
        }

        return $arr_cat;
    }

    public function get_option_groups($id) {
        $query = $this->db->get_where('users_groups', array('user_id' => $id));
        if ($query->num_rows() > 0) {
            $data = $query;
        } else {
            $data = null;
        }
        return $data;
    }

    public function get_user_parent($id_array) {
        $this->db->select('users.id, users.username');
        $this->db->from('users');
        $this->db->join('users_groups', 'users_groups.user_id=users.id', 'inner');
        $this->db->join('groups', 'groups.id=users_groups.group_id', 'inner');
        $this->db->where_in('groups.name', $id_array);
        $query = $this->db->get();
        $arr_cat = array(
            '' => 'Please select'
            );
        foreach ($query->result() as $val) {
            $arr_cat[$val->id] = $val->username;
        }

        return $arr_cat;
    }

    public function get_group_edit($id) {
        $query = $this->db->get_where('groups', array('id' => $id));
        return $query->result();
    }

    public function get_group_menu($id) {
        $this->db->select('menu_id');
        $this->db->from('menus_groups');
        $this->db->where('group_id', $id);
        $query = $this->db->get();
        return $query->result();
    }

    function users_add_save() {
        $password = $this->Ion_auth_model->hash_password(trim($this->input->post('password')), FALSE);
        $data = array(
            'first_name' => trim($this->input->post('first_name')),
            'last_name' => trim($this->input->post('last_name')),
            'password' => $password,
            'email' => trim($this->input->post('email')),
            'ip_address' => $this->input->ip_address(),
            'created_on' => time(),
            'last_login' => time(),
            'active' => ($this->input->post('active', TRUE) ? 1 : 0)
            );
        $this->db->insert('users', $data);
        $uer_id = $this->db->insert_id();
        $this->db->insert('users_groups', array('user_id' => $uer_id , 'group_id' => $this->input->post('group_id')));
        $this->db->insert('users_branchs', array('user_id' => $uer_id, 'branch_id' => $this->input->post('branch_id')));
        $rdata = array(
            'status' => TRUE,
            'redirect' => 'settings/users',
            'message_info' => 'Save data success.'
            );

        return $rdata;
    }

    public function group_add() {
        $data = array(
            'name' => trim($this->input->post('name')),
            'description' => trim($this->input->post('description'))
            );
        $this->db->insert('groups', $data);
        $group_id = $this->db->insert_id();
        if ($this->input->post('menu')) {
            foreach ($this->input->post('menu') as $item) {
                $data2 = array(
                    'menu_id' => $item,
                    'group_id' => $group_id
                    );
                $this->db->insert('menus_groups', $data2);
            }
        }
        $rdata = array(
            'status' => TRUE,
            'redirect' => 'settings/users/group',
            'message' => 'Save data success.'
            );

        return $rdata;
    }

    function users_edit_save() {
        $this->db->delete('users_groups', array('user_id' => $this->input->post('id')));
        $this->db->insert('users_groups', array('user_id' => $this->input->post('id'), 'group_id' => $this->input->post('group_id')));
        $data = array(
            'first_name' => trim($this->input->post('first_name')),
            'last_name' => trim($this->input->post('last_name')),
            'active' => ($this->input->post('active', TRUE) ? 1 : 0)
            );
        $this->ion_auth->update($this->input->post('id'), $data);
        $rdata = array(
            'status' => TRUE,
            'redirect' => 'settings/users',
            'message_info' => 'Save data success.'
            );

        return $rdata;
    }

    public function group_edit() {
        $this->ion_auth->update_group($this->input->post('id'), trim($this->input->post('name')), trim($this->input->post('description')));
        if ($this->input->post('menu')) {
            $this->db->delete('menus_groups', array('group_id' => $this->input->post('id')));
            foreach ($this->input->post('menu') as $item) {
                $this->db->insert('menus_groups', array('menu_id' => $item, 'group_id' => $this->input->post('id')));
            }
        }
        $rdata = array(
            'status' => TRUE,
            'redirect' => 'settings/users/group',
            'message' => 'Save data success.'
            );

        return $rdata;
    }

    public function delete() {
        $this->ion_auth->delete_user($this->uri->segment(4));
        $rdata = array(
            'status' => TRUE,
            'redirect' => 'settings/users',
            'message' => 'Save data success.'
            );

        return $rdata;
    }

    public function group_delete() {
        $this->ion_auth->delete_group($this->uri->segment(4));
        $rdata = array(
            'status' => TRUE,
            'redirect' => 'settings/users/group',
            'message' => 'Save data success.'
            );

        return $rdata;
    }

}
