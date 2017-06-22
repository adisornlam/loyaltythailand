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
class Contents_model extends CI_Model {

    function get_listall() {
        $user_id = $this->ion_auth->user()->row()->id;
        $this->load->library('datatables');
        $this->datatables->select(''
                . 'contents.id as id, '
                . 'contents.title as title, '
                . 'categories.title as group_title, '
                . 'contents.created_at as created_at, '
                . 'contents.updated_at as updated_at, '
                . 'contents.disabled as disabled'
                . '');
        $this->datatables->from('contents');
        $this->datatables->join('categories', 'categories.id=contents.cat_id', 'inner');
        $this->datatables->where('categories.type', 'contents');
        $this->datatables->where('contents.deleted_at', NULL);
        $this->datatables->where('contents.user_id', $user_id);

        $link = "<div class=\"dropdown\">";
        $link .= "<a class=\"dropdown-toggle\" data-toggle=\"dropdown\" href=\"javascript:;\"><span class=\"fa fa-pencil-square-o\"></span ></a>";
        $link .= "<ul class=\"dropdown-menu\" role=\"menu\" aria-labelledby=\"dLabel\">";
        $link .= "<li><a href=\"" . base_url() . index_page() . "contents/edit/$1\"\" title=\"แก้ไขเนื้อหา\">แก้ไขเนื้อหา</a></li>";
        $link .= "<li><a href=\"javascript:;\" rel=\"contents/delete/$1\" class=\"link_dialog delete\" title=\"ลบเนื้อหา\">ลบเนื้อหา</a></li>";
        $link .= "</ul>";
        $link .= "</div>";
        $this->datatables->edit_column('id', $link, 'id');
        $this->datatables->edit_column('disabled', '$1', 'check_active(disabled,0)');
        return $this->datatables->generate();
    }

    function get_static_item($code_no = 'aboutus') {
        $user_id = (int) $this->ion_auth->get_user_id();
        $this->db->select("contents.id, contents.long_desc,contents.description, contents.keywords");
        $this->db->from("contents");
        $this->db->join("categories", "contents.cat_id = categories.id");
        $this->db->join("contents_group", "contents_group.id = contents.group_id");
        $this->db->where("contents.user_id", $user_id);
        $this->db->where("contents_group.code_no", $code_no);
        $query = $this->db->get();
        if ($query->num_rows() <= 0) {
            $row_group = $this->db->get_where("contents_group", array("code_no" => $code_no))->first_row();
            $data = array("cat_id" => 2, "group_id" => $row_group->id, "user_id" => $user_id, "title" => $row_group->title, "created_at" => date("Y-m-d H:i:s"));
            $this->db->insert("contents", $data);
        }
        return $query->row();
    }

    public function add($param = array()) {
        $data = array(
            'short_desc' => $this->input->post('short_desc'),
            'long_desc' => $this->input->post('long_desc'),
            'description' => trim($this->input->post('description')),
            'keywords' => trim($this->input->post('keywords')),
            'disabled' => 1,
            'user_created' => (int) $this->ion_auth->get_user_id(),
            'created_at' => time(),
            'updated_at' => time()
        );
        $this->db->trans_start();
        $this->db->update('contents', $data, array("id"));
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
                'redirect' => 'contents/aboutus',
                'message' => 'บันทึกสำเร็จ'
            );
        }

        return $rdata;
    }

    public function edit_save() {
        $data = array(
            'long_desc' => $this->input->post('long_desc'),
            'description' => trim($this->input->post('description')),
            'keywords' => trim($this->input->post('keywords')),
            'updated_at' => date("Y-m-d H:i:s")
        );
        $this->db->trans_start();
        $this->db->update('contents', $data, array('id' => $this->input->post('id')));
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
                'redirect' => 'contents/' . $this->input->post("redirect"),
                'message' => 'Save data success.'
            );
        }

        return $rdata;
    }

}
