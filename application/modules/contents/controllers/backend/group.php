<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 *  @Auther : Adisorn Lamsombuth
 *  @Email : postyim@gmail.com
 *  @Website : esabay.com 
 */

/**
 * Description of Group
 *
 * @author R-D-6
 */
class Group extends MX_Controller {

    function __construct() {
        parent::__construct();
        if (!$this->ion_auth->logged_in()) {
            redirect('backend/login', 'refresh');
        }
        $this->load->model('contents/Contents_model');
    }

    public function index() {
        $data = array(
            'title' => 'หมวดหมู่',
            'breadcrumbs' => array(
                'รายการเนื้อหา' => 'contents/backend/content',
                'หมวดหมู่' => '#'
            ),
        );
        $this->template->load('backend/master', 'contents/backend/contents/owner/group_index', $data);
    }

    public function add() {
        $this->load->view('contents/backend/contents/owner/group_add');
    }

    public function edit() {
        $this->load->model('contents/Group_model');
        $data = array(
            'item' => $this->Group_model->get_view($this->uri->segment(5))
        );
        $this->load->view('contents/backend/contents/owner/group_edit', $data);
    }

}
