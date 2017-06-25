<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 *  @Auther : Adisorn Lamsombuth
 *  @Email : postyim@gmail.com
 *  @Website : esabay.com 
 */

/**
 * Description of category
 *
 * @author R-D-6
 */
class Category extends MX_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->ion_auth->logged_in()) {
            redirect('backend/login', 'refresh');
        }
        $this->load->model('products/Category_model');
    }

    public function index() {
        $data = array(
            'title_page' => 'Category'
        );
        if ($this->ion_auth->is_admin()) {
            $this->template->load('master', 'products/admin/category/index', $data);
        } elseif ($this->ion_auth->in_group('store')) {
            $this->template->load('master', 'products/store/category/index', $data);
        }
    }

    function listall() {
        echo $this->Category_model->listall();
    }

    public function add() {
        $this->load->view('products/store/category/add');
    }

    public function edit() {
        $cat_id = $this->uri->segment(4);
        $item = $this->Category_model->get_item($cat_id);
        $data = array(
            'item' => $item
        );
        $this->load->view('products/store/category/edit', $data);
    }

    public function save() {
        if ($this->uri->segment(4) == 'add') {
            $rs = $this->Category_model->add_save();
        } else if ($this->uri->segment(4) == 'edit') {
            $rs = $this->Category_model->edit_save();
        } else if ($this->uri->segment(4) == 'delete') {
            $rs = $this->Category_model->delete_save();
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
