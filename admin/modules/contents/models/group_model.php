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
class Group_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function get_listall() {
        $this->load->library('datatables');
        $this->load->helper('common/useful');

        $this->datatables->select(''
                . 'categories.id as id, '
                . 'categories.title as title, '
                . 'categories.description as description, '
                . 'categories.disabled as disabled'
                . '');
        $this->datatables->from('categories');
        $this->datatables->join('category_hierarchy', 'category_hierarchy.category_id=categories.id', 'inner');
        $this->datatables->where('categories.type', 'contents');
        $link = "<div class=\"dropdown\">";
        $link .= "<a class=\"dropdown-toggle\" data-toggle=\"dropdown\" href=\"javascript:;\"><span class=\"fa fa-pencil-square-o\"></span ></a>";
        $link .= "<ul class=\"dropdown-menu\" role=\"menu\" aria-labelledby=\"dLabel\">";
        $link .= "<li><a href=\"javascript:;\" rel=\"contents/backend/group/edit/$1\" class=\"link_dialog\" title=\"แก้ไขกลุ่ม\">แก้ไขกลุ่ม</a></li>";
        $link .= "<li><a href=\"javascript:;\" rel=\"contents/backend/group/move/$1\" class=\"link_dialog\" title=\"ย้ายกลุ่ม\">ย้ายกลุ่ม</a></li>";
        $link .= "<li><a href=\"javascript:;\" rel=\"contents/backend/result_group/delete/$1\" class=\"link_dialog delete\" title=\"ลบกลุ่ม\">ลบกลุ่ม</a></li>";
        $link .= "</ul>";
        $link .= "</div>";
        $this->datatables->edit_column('id', $link, 'id');
        $this->datatables->edit_column('disabled', '$1', 'check_active(disabled,0)');
        return $this->datatables->generate();
    }

    function get_name($param) {
        $query = $this->db->get_where('categories', array('cat_id' => $param));
        return $query->first_row->cat_title;
    }

    public function get_ddl() {
        $this->db->select('*');
        $this->db->from('categories');
        $this->db->join('category_hierarchy', 'category_hierarchy.category_id=categories.id');
        $this->db->where('category_hierarchy.category_parent_id', 0);
        $this->db->where('categories.type', 'contents');
        $this->db->where('categories.disabled', 0);
        $query1 = $this->db->get();

        $arr_cat = array(
            '' => 'กรุณาเลือกกลุ่ม'
        );
        foreach ($query1->result() as $val) {
            $arr_cat[$val->id] = $val->title;
        }

        return $arr_cat;
    }

    public function get_view($id) {
        $query = $this->db->get_where('categories', array('id' => $id));
        $row = $query->first_row();
        return $row;
    }

    function add() {
        $data = array(
            'type' => trim($this->input->post('type')),
            'title' => trim($this->input->post('title')),
            'description' => trim($this->input->post('description')),
            'disabled' => ($this->input->post('disabled', TRUE) ? 0 : 1)
        );
        $this->db->insert('categories', $data);
        $cat_id = $this->db->insert_id();
        $this->db->insert('category_hierarchy', array('category_id' => $cat_id, 'category_parent_id' => 0));
        $rdata = array(
            'status' => TRUE,
            'redirect' => 'contents/backend/group',
            'message' => 'บันทึกข้อมูลสำเร็จ'
        );

        return $rdata;
    }

    function edit() {
        $data = array(
            'title' => trim($this->input->post('title')),
            'description' => trim($this->input->post('description')),
            'disabled' => ($this->input->post('disabled', TRUE) ? 0 : 1)
        );
        $this->db->update('categories', $data, array('id' => $this->input->post('id')));
        $rdata = array(
            'status' => TRUE,
            'redirect' => 'contents/backend/group',
            'message' => 'บันทึกข้อมูลสำเร็จ'
        );

        return $rdata;
    }

    function move() {
        $this->db->delete('category_hierarchy', array('category_id' => $this->input->post('id')));
        $this->db->insert('category_hierarchy', array('category_id' => $this->input->post('id'), 'category_parent_id' => $this->input->post('new_id')));
        $rdata = array(
            'status' => TRUE,
            'redirect' => 'contents/backend/group',
            'message' => 'บันทึกข้อมูลสำเร็จ'
        );

        return $rdata;
    }

    public function delete() {
        $this->db->delete('categories', array('id' => $this->uri->segment(5)));
        $this->db->delete('category_hierarchy', array('category_id' => $this->uri->segment(5)));
        $this->db->delete('category_hierarchy', array('category_parent_id' => $this->uri->segment(5)));
        $rdata = array(
            'status' => TRUE,
            'redirect' => 'contents/backend/group',
            'message' => 'บันทึกข้อมูลสำเร็จ'
        );
        return $rdata;
    }

}
