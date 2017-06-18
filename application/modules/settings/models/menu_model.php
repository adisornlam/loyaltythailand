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
class Menu_model extends CI_Model {

    function get_listall() {
        $this->load->library('datatables');
        $this->load->helper('settings/useful');

        $id = ($this->uri->segment(5) ? $this->uri->segment(5) : 0);

        $this->datatables->select('menu.id as id, title, type, description, url, icon, modules, weight, disabled');
        $this->datatables->from('menu');
        $this->datatables->join('menu_hierarchy', 'menu_hierarchy.menu_id=menu.id', 'inner');
        $this->datatables->where('menu_hierarchy.menu_parent_id', $id);
        $this->datatables->edit_column('title', '<a href="' . base_url() . index_page() . 'settings/backend/menu/sub/$1">$2</a>', 'id,title');
        $link = "<div class=\"dropdown\">";
        $link .= "<a class=\"dropdown-toggle\" data-toggle=\"dropdown\" href=\"javascript:;\"><span class=\"fa fa-pencil-square-o\"></span ></a>";
        $link .= "<ul class=\"dropdown-menu\" role=\"menu\" aria-labelledby=\"dLabel\">";
        $link .= "<li><a href=\"javascript:;\" rel=\"settings/backend/menu/edit/$1\" class=\"link_dialog\" title=\"Edit Details\">Edit Details</a></li>";
        $link .= "<li><a href=\"javascript:;\" rel=\"settings/backend/result_menu/delete/$1\" class=\"link_dialog delete\" title=\"Delete Menu\">Delete Menu</a></li>";
        $link .= "</ul>";
        $link .= "</div>";
        $this->datatables->edit_column('id', $link, 'id');
        $this->datatables->edit_column('disabled', '$1', 'check_disabled(disabled,0)');
        return $this->datatables->generate();
    }

    public function get_count_category_sub($param) {
        $this->db->select('*');
        $this->db->from('menu');
        $this->db->join('menu_hierarchy', 'menu_hierarchy.menu_id=menu.id');
        $this->db->where('menu_hierarchy.menu_parent_id', $param);
        $query = $this->db->get();
        return $query->num_rows();
    }

    function get_name($param) {
        $query = $this->db->get_where('menu', array('id' => $param));
        return $query->first_row->title;
    }

    public function get_menu_root($id = 0) {
        $this->db->select('menu.*');
        $this->db->from('menu');
        $this->db->join('menu_hierarchy', 'menu_hierarchy.menu_id=menu.id');
        $this->db->where('menu_hierarchy.menu_parent_id', $id);
        $this->db->order_by('weight', 'asc');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_menu_auth($menu_id = 0) {
        $user_groups = $this->ion_auth->get_users_groups($this->ion_auth->get_user_id())->result();
        if ($user_groups) {
            foreach ($user_groups as $value) {
                $ar[] = $value->id;
            }
        } else {
            $ar = array();
        }
        $this->db->distinct();
        $this->db->select('menu.*');
        $this->db->from('menu');
        $this->db->join('menu_hierarchy', 'menu_hierarchy.menu_id=menu.id');
        $this->db->join('menus_groups', 'menus_groups.menu_id = menu_hierarchy.menu_id');
        $this->db->where('menu_hierarchy.menu_parent_id', $menu_id);
        $this->db->where_in('menus_groups.group_id', $ar);
        $this->db->order_by('menu.weight', 'asc');
        $query = $this->db->get();
        return $query->result();
    }

    function get_menu() {
        $this->db->select('*');
        $this->db->from('menu');
        $this->db->join('menu_hierarchy', 'menu_hierarchy.menu_id=menu.id');
        $this->db->where('menu_hierarchy.menu_parent_id', 0);
        $this->db->order_by('weight', 'asc');
        $query1 = $this->db->get();

        foreach ($query1->result() as $val) {
            $arr_cat[$val->id] = $val->title;
        }

        return $arr_cat;
    }

    public function get_edit($id) {
        $query = $this->db->get_where('menu', array('id' => $id));
        return $query->result();
    }

    function add() {
        $data = array(
            'title' => trim($this->input->post('title')),
            'type' => 'backend',
            'description' => trim($this->input->post('description')),
            'url' => trim($this->input->post('url')),
            'icon' => trim($this->input->post('icon')),
            'modules' => trim($this->input->post('modules')),
            'weight' => $this->input->post('weight'),
            'disabled' => ($this->input->post('disabled', TRUE) ? 0 : 1)
        );
        $this->db->trans_start();
        $this->db->insert('menu', $data);
        $this->db->insert('menu_hierarchy', array('menu_id' => $this->db->insert_id(), 'menu_parent_id' => ($this->input->post('parent_id', TRUE) !== '' ? $this->input->post('parent_id') : 0)));
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $rdata = array(
                'status' => FALSE,
                'message' => $this->db->_error_message()
            );
        } else {
            $this->db->trans_commit();
            $rdata = array(
                'status' => TRUE,
                'redirect' => 'settings/backend/menu' . ($this->input->post('parent_id', TRUE) ? '/sub/' . $this->input->post('parent_id', TRUE) : ''),
                'message' => 'Save data success.'
            );
        }

        return $rdata;
    }

    function edit() {
        $data = array(
            'title' => trim($this->input->post('title')),
            'description' => trim($this->input->post('description')),
            'url' => $this->input->post('url'),
            'icon' => trim($this->input->post('icon')),
            'modules' => trim($this->input->post('modules')),
            'weight' => $this->input->post('weight'),
            'disabled' => ($this->input->post('disabled', TRUE) ? 0 : 1)
        );

        $this->db->trans_start();
        $this->db->where('id', $this->input->post('id'));
        $this->db->update('menu', $data);

        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $rdata = array(
                'status' => FALSE,
                'message' => $this->db->_error_message()
            );
        } else {
            $this->db->trans_commit();
            $rdata = array(
                'status' => TRUE,
                'redirect' => 'settings/backend/menu' . ($this->input->post('parent_id', TRUE) ? '/sub/' . $this->input->post('parent_id', TRUE) : ''),
                'message' => 'Save data success.'
            );
        }

        return $rdata;
    }

    public function delete() {
        $this->db->trans_start();
        $this->db->delete('menu', array('id' => $this->uri->segment(5)));
        $this->db->delete('menu_hierarchy', array('menu_id' => $this->uri->segment(5)));
        $this->db->delete('menu_hierarchy', array('menu_parent_id' => $this->uri->segment(5)));
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $rdata = array(
                'status' => FALSE,
                'message' => $this->db->_error_message()
            );
        } else {
            $this->db->trans_commit();
            $rdata = array(
                'status' => TRUE,
                'redirect' => 'settings/backend/menu',
                'message' => 'Save data success.'
            );
        }

        return $rdata;
    }

}
