<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 *  @Auther : Adisorn Lamsombuth
 *  @Email : postyim@gmail.com
 *  @Website : esabay.com 
 */

/**
 * Description of authentication
 *
 * @author R-D-6
 */
class Contents extends MX_Controller {

    function __construct() {
        parent::__construct();
        if (!$this->ion_auth->logged_in()) {
            redirect('backend/login', 'refresh');
        }
        $this->load->model('contents/Contents_model');
    }

    public function index() {
        $data = array(
            'title_page' => 'รายการเนื้อหา'
        );
        if ($this->ion_auth->is_admin()) {
            $this->template->load('master', 'contents/admin/contents/index', $data);
        } elseif ($this->ion_auth->in_group('owner')) {
            $this->template->load('master', 'contents/owner/contents/index', $data);
        } elseif ($this->ion_auth->in_group('employee')) {
            $this->template->load('master', 'contents/employee/contents/index', $data);
        } elseif ($this->ion_auth->in_group('store')) {
            $this->template->load('master', 'contents/store/contents/index', $data);
        } else {
            $this->template->load('master', 'templates/not_permission', $data);
        }
    }

    public function listall() {
        echo $this->Contents_model->get_listall();
    }

    function aboutus() {
        $data = array(
            'title_page' => 'เกี่ยวกับเรา',
            'item' => $this->Contents_model->get_static_item()
        );
        if ($this->ion_auth->is_admin()) {
            $this->template->load('master', 'contents/admin/contents/aboutus', $data);
        } elseif ($this->ion_auth->in_group('owner')) {
            $this->template->load('master', 'contents/owner/contents/aboutus', $data);
        } elseif ($this->ion_auth->in_group('store')) {
            $this->template->load('master', 'contents/store/contents/aboutus', $data);
        } else {
            $this->template->load('master', 'templates/not_permission', $data);
        }
    }

    function contactus() {
        $data = array(
            'title_page' => 'ติดต่อเรา',
            'item' => $this->Contents_model->get_static_item('contactus')
        );
        if ($this->ion_auth->is_admin()) {
            $this->template->load('master', 'contents/admin/contents/contactus', $data);
        } elseif ($this->ion_auth->in_group('owner')) {
            $this->template->load('master', 'contents/owner/contents/contactus', $data);
        } elseif ($this->ion_auth->in_group('store')) {
            $this->template->load('master', 'contents/store/contents/contactus', $data);
        } else {
            $this->template->load('master', 'templates/not_permission', $data);
        }
    }

    public function add() {
        $data = array(
            'title' => 'เพิ่มเนื้อหา',
            'breadcrumbs' => array(
                'รายการเนื้อหา' => 'contents/backend/content',
                'เพิ่มเนื้อหา' => '#'
            ),
            'group' => $this->Group_model->get_ddl()
        );
        $this->template->load('backend/master', 'contents/backend/contents/owner/content_add', $data);
    }

    public function save() {

        if ($this->uri->segment(3) == 'add') {
            $rs = $this->Contents_model->add_save();
        } else if ($this->uri->segment(3) == 'edit') {
            $rs = $this->Contents_model->edit_save();
        } else if ($this->uri->segment(3) == 'delete') {
            $rs = $this->Contents_model->delete_save();
        } else {
            $rs = array();
        }

        $data = array(
            'error' => array(
                'status' => $rs['status'],
                'redirect' => (isset($rs['redirect']) ? $rs['redirect'] : 0),
                'message' => (isset($rs['message']) ? $rs['message'] : 0),
                'message_info' => (isset($rs['message_info']) ? $rs['message_info'] : 0),
                'id' => (isset($rs['id']) ? $rs['id'] : 0),
            )
        );
        echo json_encode($data);
    }

}
