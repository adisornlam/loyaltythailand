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
class Article extends MX_Controller {

    function __construct() {
        parent::__construct();
        if (!$this->ion_auth->logged_in()) {
            redirect('backend/login', 'refresh');
        }
    }

    public function index() {
        $data = array(
            'title' => 'รายการบทความ'
        );
        $this->template->load('backend/master', 'contents/backend/contents/owner/article_index', $data);
    }

    public function add() {
        $data = array(
            'title' => 'เพิ่มบทความ',
            'breadcrumbs' => array(
                'รายการบทความ' => 'contents/backend/article',
                'เพิ่มบทความ' => '#'
            )
        );
        $this->template->load('backend/master', 'contents/backend/contents/owner/article_add', $data);
    }

    public function edit() {
        $this->load->model('contents/Article_model');
        $rs = $this->Article_model->get_view($this->uri->segment(5));
        $data = array(
            'title' => 'แก้ไขเนื้อหา',
            'breadcrumbs' => array(
                'รายการบทความ' => 'contents/backend/article',
                'แก้ไขบทความ' => '#'
            ),
            'item' => $rs
        );
        $this->template->load('backend/master', 'contents/backend/contents/owner/article_edit', $data);
    }

}
