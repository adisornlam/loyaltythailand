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
        $this->datatables->join('categories', 'categories.id=contents.group_id', 'inner');
        $this->datatables->where('categories.type', 'contents');
        $this->datatables->where('contents.deleted_at', 0);

        $link = "<div class=\"dropdown\">";
        $link .= "<a class=\"dropdown-toggle\" data-toggle=\"dropdown\" href=\"javascript:;\"><span class=\"fa fa-pencil-square-o\"></span ></a>";
        $link .= "<ul class=\"dropdown-menu\" role=\"menu\" aria-labelledby=\"dLabel\">";
        $link .= "<li><a href=\"" . base_url() . index_page() . "contents/backend/content/edit/$1\"\" title=\"แก้ไขเนื้อหา\">แก้ไขเนื้อหา</a></li>";
        $link .= "<li><a href=\"javascript:;\" rel=\"contents/backend/result_contents/delete/$1\" class=\"link_dialog delete\" title=\"ลบเนื้อหา\">ลบเนื้อหา</a></li>";
        $link .= "</ul>";
        $link .= "</div>";
        $this->datatables->edit_column('id', $link, 'id');
        $this->datatables->edit_column('created_at', '$1', 'get_datethai(created_at,2)');
        $this->datatables->edit_column('updated_at', '$1', 'get_datethai(updated_at,2)');
        $this->datatables->edit_column('disabled', '$1', 'check_active(disabled,0)');
        return $this->datatables->generate();
    }

    public function get_view($id) {
        $query = $this->db->get_where('contents', array('id' => $id, 'deleted_at' => 0));
        if ($query->num_rows() > 0) {
            $row = $query->first_row();
        } else {
            $row = NULL;
        }
        return $row;
    }

    public function add($param = array()) {
        $data = array(
            'group_id' => (int) $this->input->post('group_id'),
            'title' => trim($this->input->post('title')),
            'short_desc' => $this->input->post('short_desc'),
            'long_desc' => $this->input->post('long_desc'),
            'description' => trim($this->input->post('description')),
            'links' => trim($this->input->post('links')),
            'img_cover' => (isset($param[0]['upload_data_photo0']['file_name']) ? 'uploads/contents/' . date('Ymd') . '/' . $param[0]['upload_data_photo0']['file_name'] : NULL),
            'img_slide' => (isset($param[1]['upload_data_photo1']['file_name']) ? 'uploads/contents/' . date('Ymd') . '/' . $param[1]['upload_data_photo1']['file_name'] : NULL),
            'keywords' => trim($this->input->post('keywords')),
            'disabled' => ($this->input->post('disabled', TRUE) ? 0 : 1),
            'user_created' => (int) $this->ion_auth->get_user_id(),
            'created_at' => time(),
            'updated_at' => time()
        );
        $this->db->trans_start();
        $this->db->insert('contents', $data);
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
                'redirect' => 'contents/backend/content',
                'message' => 'บันทึกสำเร็จ'
            );
        }

        return $rdata;
    }

    public function edit($param = array()) {
        $data = array(
            'group_id' => (int) $this->input->post('group_id'),
            'title' => trim($this->input->post('title')),
            'short_desc' => $this->input->post('short_desc'),
            'long_desc' => $this->input->post('long_desc'),
            'description' => trim($this->input->post('description')),
            'links' => trim($this->input->post('links')),
            'img_cover' => (isset($param[0]['upload_data_photo0']['file_name']) ? 'uploads/contents/' . date('Ymd') . '/' . $param[0]['upload_data_photo0']['file_name'] : $this->input->post('img_cover_hidden')),
            'img_slide' => (isset($param[1]['upload_data_photo1']['file_name']) ? 'uploads/contents/' . date('Ymd') . '/' . $param[1]['upload_data_photo1']['file_name'] : $this->input->post('img_slide_hidden')),
            'keywords' => trim($this->input->post('keywords')),
            'disabled' => ($this->input->post('disabled', TRUE) ? 0 : 1),
            'user_updated' => (int) $this->ion_auth->get_user_id(),
            'updated_at' => time()
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
                'redirect' => 'contents/backend/content/edit/' . $this->input->post('id'),
                'message' => 'Save data success.'
            );
        }

        return $rdata;
    }

    public function delete() {
        $this->db->trans_start();
        $this->db->update('contents', array('deleted_at' => 1, 'user_updated' => $this->ion_auth->get_user_id(), 'updated_at' => time()), array('id' => $this->uri->segment(5)));
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
                'redirect' => 'contents/backend/contents',
                'message' => 'Save data success.'
            );
        }

        return $rdata;
    }

    public function get_slide() {
        $this->db->select('*');
        $this->db->from('contents');
        $this->db->where('group_id', 12);
        $this->db->where('disabled', 0);
        $this->db->where('deleted_at', 0);
        $this->db->order_by('id', 'desc');
        return $this->db->get();
    }

    public function get_view_fixed($param) {
        $this->db->select('long_desc');
        $this->db->from('contents');
        $this->db->where('id', $param);
        $this->db->where('disabled', 0);
        $query = $this->db->get();
        $row = $query->first_row();
        return $row->long_desc;
    }

    public function get_home_list($limit = 0, $rand = FALSE) {
        $this->db->select('contents.id, contents.title, contents.short_desc, contents.img_cover, categories.type');
        $this->db->from('contents');
        $this->db->join('categories', 'categories.id=contents.group_id', 'inner');
        $this->db->where('contents.disabled', 0);
        $this->db->where('categories.disabled', 0);
        $this->db->where('contents.deleted_at', 0);
        $this->db->where_in('categories.id', array(3, 4));
        $this->db->limit($limit);
        if ($rand) {
            $this->db->order_by('id', 'random');
        } else {
            $this->db->order_by('id', 'desc');
        }
        return $this->db->get();
    }

}
