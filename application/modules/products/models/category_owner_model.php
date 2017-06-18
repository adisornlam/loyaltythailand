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
class Category_owner_model extends CI_Model {

    function get_listall() {
        $this->load->library('datatables');
        $this->load->helper('products/useful');

        $id = ($this->uri->segment(5) ? $this->uri->segment(5) : 0);

        $this->datatables->select(''
                . 'categories.id as id, '
                . 'categories.title as title, '
                . 'categories.description as description, '
                . 'categories.weight as weight, '
                . 'categories.disabled as disabled'
                . '');
        $this->datatables->from('categories');
        $this->datatables->join('category_hierarchy', 'category_hierarchy.category_id=categories.id', 'inner');
        $this->datatables->where('category_hierarchy.category_parent_id', $id);
        $this->datatables->where('categories.type', 'products');

        $this->datatables->edit_column('title', '<a href="' . base_Url() . index_page() . 'products/backend/category/sub/$1">$2</a> $3', 'id,title, count_cat(id)');
        $link = "<div class=\"dropdown\">";
        $link .= "<a class=\"dropdown-toggle\" data-toggle=\"dropdown\" href=\"javascript:;\"><span class=\"fa fa-pencil-square-o\"></span ></a>";
        $link .= "<ul class=\"dropdown-menu\" role=\"menu\" aria-labelledby=\"dLabel\">";
        $link .= "<li><a href=\"javascript:;\" rel=\"products/backend/category/edit/" . $id . "/$1\" class=\"link_dialog\" title=\"แก้ไข\">แก้ไข</a></li>";
        //$link .= "<li><a href=\"javascript:;\" rel=\"products/backend/category/move/$1\" class=\"link_dialog\" title=\"ย้าย\">ย้าย</a></li>";
        $link .= "<li><a href=\"javascript:;\" rel=\"products/backend/result_category/delete/" . $id . "/$1\" class=\"link_dialog delete\" title=\"ลบ\">ลบ</a></li>";
        $link .= "</ul>";
        $link .= "</div>";
        $this->datatables->edit_column('id', $link, 'id');
        $this->datatables->edit_column('disabled', '$1', 'check_disabled(disabled,0)');
        return $this->datatables->generate();
    }

    public function get_view($id) {
        $query = $this->db->get_where('categories', array('id' => $id));
        return $query->first_row();
    }

    public function get_ddl($edit = TRUE) {
        $this->db->select('*');
        $this->db->from('categories');
        $this->db->join('category_hierarchy', 'category_hierarchy.category_id=categories.id');
        $this->db->where('category_hierarchy.category_parent_id', 0);
        $this->db->where('categories.type', 'products');
        $this->db->where('categories.disabled', 0);
        $query1 = $this->db->get();
        if ($edit) {
            $arr_cat = array(
                '' => 'เลือกหมวดหมู่'
            );
        }
        foreach ($query1->result() as $val) {
            $arr_cat[$val->id] = $val->title;
        }

        return $arr_cat;
    }

    public function get_list() {
        $this->db->select('*');
        $this->db->from('categories');
        $this->db->join('category_hierarchy', 'category_hierarchy.category_id=categories.id');
        $this->db->where('category_hierarchy.category_parent_id', 0);
        $this->db->where('categories.type', 'products');
        $this->db->where('categories.disabled', 0);
        return $this->db->get();
    }

    function add() {
        $data = array(
            'type' => trim($this->input->post('type')),
            'title' => trim($this->input->post('title')),
            'description' => trim($this->input->post('description')),
            'weight' => trim($this->input->post('weight')),
            'disabled' => ($this->input->post('disabled', TRUE) ? 0 : 1)
        );
        $this->db->trans_start();
        $this->db->insert('categories', $data);

        $this->db->insert('category_hierarchy', array('category_id' => $this->db->insert_id(), 'category_parent_id' => ($this->input->post('parent_id') != '' ? $this->input->post('parent_id') : 0)));
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
                'redirect' => 'products/backend/category' . ($this->input->post('parent_id') != '' ? '/sub/' . $this->input->post('parent_id') : ''),
                'message' => NULL
            );
        }
        return $rdata;
    }

    function edit() {
        $data = array(
            'title' => trim($this->input->post('title')),
            'description' => trim($this->input->post('description')),
            'weight' => trim($this->input->post('weight')),
            'disabled' => ($this->input->post('disabled', TRUE) ? 0 : 1)
        );

        $this->db->trans_start();
        $this->db->where('id', $this->input->post('id'));
        $this->db->update('categories', $data);

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
                'redirect' => 'products/backend/category' . ($this->input->post('parent_id') > 0 ? '/sub/' . $this->input->post('parent_id') : ''),
                'message' => NULL
            );
        }

        return $rdata;
    }

    public function delete() {
        $this->db->trans_start();
        $this->db->delete('categories', array('id' => $this->uri->segment(6)));
        $this->db->delete('category_hierarchy', array('category_id' => $this->uri->segment(6)));
        $this->db->delete('category_hierarchy', array('category_parent_id' => $this->uri->segment(6)));
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
                'redirect' => 'products/backend/category' . ($this->uri->segment(5) > 0 ? '/sub/' . $this->uri->segment(5) : ''),
                'message' => 'ลบรายการสำเร็จ'
            );
        }

        return $rdata;
    }

}
