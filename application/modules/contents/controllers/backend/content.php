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
class Content extends MX_Controller {

    function __construct() {
        parent::__construct();
        if (!$this->ion_auth->logged_in()) {
            redirect('backend/login', 'refresh');
        }
    }

    public function index() {
        $data = array(
            'title' => 'รายการเนื้อหา'
        );
        $this->template->load('backend/master', 'contents/backend/contents/owner/content_index', $data);
    }

    public function add() {
        $this->load->model('contents/Group_model');
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

    public function edit() {
        $this->load->model('contents/Contents_model');
        $this->load->model('contents/Group_model');
        $rs = $this->Contents_model->get_view($this->uri->segment(5));
        $data = array(
            'title' => 'แก้ไขเนื้อหา',
            'breadcrumbs' => array(
                'รายการเนื้อหา' => 'contents/backend/content',
                'แก้ไขเนื้อหา' => '#'
            ),
            'item' => $rs,
            'group' => $this->Group_model->get_ddl()
        );
        $this->template->load('backend/master', 'contents/backend/contents/owner/content_edit', $data);
    }

}
