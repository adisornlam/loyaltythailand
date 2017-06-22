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
class Article_model extends CI_Model {

    function get_listall() {
        $this->load->library('datatables');
        $this->datatables->select(''
                . 'contents.id as id, '
                . 'contents.title as title, '
                . 'contents.created_at as created_at, '
                . 'contents.updated_at as updated_at, '
                . 'contents.disabled as disabled'
                . '');
        $this->datatables->from('contents');
        $this->datatables->join('categories', 'categories.id=contents.group_id', 'inner');
        $this->datatables->where('categories.type', 'article');
        $this->datatables->where('contents.deleted_at', 0);

        $link = "<div class=\"dropdown\">";
        $link .= "<a class=\"dropdown-toggle\" data-toggle=\"dropdown\" href=\"javascript:;\"><span class=\"fa fa-pencil-square-o\"></span ></a>";
        $link .= "<ul class=\"dropdown-menu\" role=\"menu\" aria-labelledby=\"dLabel\">";
        $link .= "<li><a href=\"" . base_url() . index_page() . "contents/backend/article/edit/$1\"\" title=\"แก้ไขบทความ\">แก้ไขบทความ</a></li>";
        $link .= "<li><a href=\"javascript:;\" rel=\"contents/backend/result_article/delete/$1\" class=\"link_dialog delete\" title=\"ลบบทความ\">ลบบทความ</a></li>";
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
            'group_id' => 3,
            'title' => trim($this->input->post('title')),
            'short_desc' => $this->input->post('short_desc'),
            'long_desc' => $this->input->post('long_desc'),
            'img_cover' => (isset($param['upload_data']['file_name']) ? 'uploads/contents/' . date('Ymd') . '/' . $param['upload_data']['file_name'] : NULL),
            'description' => trim($this->input->post('description')),
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
                'redirect' => 'contents/backend/article',
                'message' => 'บันทึกสำเร็จ'
            );
        }

        return $rdata;
    }

    public function edit($param = array()) {
        $data = array(
            'title' => trim($this->input->post('title')),
            'short_desc' => $this->input->post('short_desc'),
            'long_desc' => $this->input->post('long_desc'),
            'img_cover' => (isset($param['upload_data']['file_name']) ? 'uploads/contents/' . date('Ymd') . '/' . $param['upload_data']['file_name'] : $this->input->post('img_cover_hidden')),
            'description' => trim($this->input->post('description')),
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
                'redirect' => 'contents/backend/article/edit/' . $this->input->post('id'),
                'message' => NULL
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

    public function get_content_slide() {
        $this->db->select('*');
        $this->db->from('contents');
        $this->db->join('contents_group', 'contents_group.id=contents.group_id', 'inner');
        $this->db->where('contents.disabled', 1);
        $this->db->where('start <=', time());
        $this->db->where('finish >=', time());
        $this->db->where('contents_group.code', 'slide');
        $query = $this->db->get();
        return $query;
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

}
