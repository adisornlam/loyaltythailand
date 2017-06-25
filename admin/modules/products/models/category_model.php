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
class Category_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->helper("products/useful");
    }

    function listall() {
        $this->load->library('datatables');
        $user_id = $this->ion_auth->user()->row()->id;

        $this->datatables->select(''
                . 'cat.id, '
                . 'cat.title, '
                . 'cat.description, '
                . 'cat.disabled'
                . '');
        $this->datatables->from('categories cat');
        $this->datatables->join('category_hierarchy cath', 'cath.category_id=cat.id', 'inner');
        $this->datatables->join("users_categories ucat", "ucat.cat_id=cat.id");
        $this->datatables->where('cath.category_parent_id', 0);
        $this->datatables->where('ucat.user_id', $user_id);
        $this->datatables->where('cat.deleted_at', NULL);

        $link = "<div class=\"dropdown\">";
        $link .= "<a class=\"dropdown-toggle\" data-toggle=\"dropdown\" href=\"javascript:;\"><span class=\"fa fa-pencil-square-o\"></span ></a>";
        $link .= "<ul class=\"dropdown-menu\" role=\"menu\" aria-labelledby=\"dLabel\">";
        $link .= "<li><a href=\"javascript:;\" rel=\"products/category/edit/$1\" class=\"link_dialog\" title=\"Edit item\"><i class=\"fa fa-pencil\" aria-hidden=\"true\"></i> Edit Details</a></li>";
        $link .= "<li><a href=\"javascript:;\" rel=\"products/category/save/delete/$1\" class=\"link_dialog delete\" title=\"Delete item\"><i class=\"fa fa-trash\" aria-hidden=\"true\"></i> Delete Category</a></li>";
        $link .= "</ul>";
        $link .= "</div>";
        $this->datatables->edit_column('id', $link, 'id');
        $this->datatables->edit_column('disabled', '$1', 'check_disabled(disabled)');
        return $this->datatables->generate();
    }

    function get_item($id) {
        $row = $this->db->get_where("categories", array("id" => $id))->first_row();
        return $row;
    }

    function add_save() {
        $user_id = $this->ion_auth->user()->row()->id;
        $data = array(
            'title' => $this->input->post('title'),
            'description' => $this->input->post("description"),
            'type' => 'product',
            'weight' => 0,
            'disabled' => ($this->input->post('disabled', TRUE) ? 1 : 0),
            'created_at' => date('Y-m-d H:i:s')
        );
        $this->db->insert('categories', $data);
        $insert_id = $this->db->insert_id();

        $this->db->insert('category_hierarchy', array('category_id' => $insert_id, 'category_parent_id' => 0));
        $this->db->insert('users_categories', array('cat_id' => $insert_id, 'user_id' => $user_id));

        $rdata = array(
            'status' => TRUE,
            'redirect' => 'products/category',
            'message_info' => 'Save Successfully.'
        );

        return $rdata;
    }

    function edit_save() {
        $data = array(
            'title' => $this->input->post('title'),
            'description' => $this->input->post("description"),
            'updated_at' => date('Y-m-d H:i:s')
        );
        $this->db->update('categories', $data, array("id" => $this->input->post("id")));

        $rdata = array(
            'status' => TRUE,
            'redirect' => 'products/category',
            'message_info' => 'Save Successfully.'
        );

        return $rdata;
    }

    function delete_save() {
        $data = array(
            'deleted_at' => date('Y-m-d H:i:s'),
        );
        if (!$this->db->update('categories', $data, array('id' => $this->uri->segment(5)))) {
            $rdata = array(
                'status' => FALSE,
                'message' => $this->db->_error_message()
            );
        } else {
            $rdata = array(
                'status' => TRUE,
                'redirect' => 'products/category',
                'message_info' => 'Delete Successfully.'
            );
        }
        return $rdata;
    }

    function get_ddl() {
        $user_id = $this->ion_auth->user()->row()->id;
        $this->db->select(''
                . 'cat.id, '
                . 'cat.title'
                . '');
        $this->db->from('categories cat');
        $this->db->join('category_hierarchy cath', 'cath.category_id=cat.id', 'inner');
        $this->db->join("users_categories ucat", "ucat.cat_id=cat.id");
        $this->db->where('cath.category_parent_id', 0);
        $this->db->where('ucat.user_id', $user_id);
        $this->db->where('cat.deleted_at', NULL);
        $query = $this->db->get();
        $arr = array(
            '' => 'Please select'
        );
        foreach ($query->result() as $val) {
            $arr[$val->id] = $val->title;
        }

        return $arr;
    }

}
