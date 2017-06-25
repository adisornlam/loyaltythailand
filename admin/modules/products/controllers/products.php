<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 *  @Auther : Adisorn Lamsombuth
 *  @Email : postyim@gmail.com
 *  @Website : adisornlam.com 
 */

/**
 * Description of dashboard
 *
 * @author R-D-6
 */
class Products extends MX_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->ion_auth->logged_in()) {
            redirect('backend/login', 'refresh');
        }
        $this->load->model('products/Products_model');
        $this->load->model('products/Category_model');
    }

    public function index() {
        $data = array(
            'title_page' => 'รายการสินค้า'
        );

        if ($this->ion_auth->is_admin()) {
            $this->template->load('master', 'products/admin/index', $data);
        } elseif ($this->ion_auth->in_group('store')) {
            $this->template->load('master', 'products/store/product/index', $data);
        } else {
            $this->template->load('master', 'templates/not_permission', $data);
        }
    }

    function listall() {
        echo $this->Products_model->listall();
    }

    public function add() {

        $data = array(
            'title_page' => 'เพิ่มสินค้า',
            'breadcrumbs' => array(
                'รายการสินค้า' => 'products',
                'เพิ่มสินค้า' => '#'
            ),
            'ddl_cat' => $this->Category_model->get_ddl()
        );
        $this->template->load('master', 'products/store/product/add', $data);
    }

    public function add_save() {
        $this->load->library('form_validation');
        $this->load->helper('directory');

        $upload_config = array(
            'upload_path' => 'uploads/products/' . date('Ymd') . '/',
            'allowed_types' => 'jpg|jpeg|png',
            'file_name' => time()
        );
        $this->load->library('upload', $upload_config);
        $dir_exist = true;
        if (!is_dir($upload_config['upload_path'])) {
            mkdir($upload_config['upload_path'], 0777, true);
            $dir_exist = false;
        }
        $this->form_validation->set_rules('title', 'ชื่อสินค้า', 'required');
        $this->form_validation->set_rules('code_no', 'รหัสสินค้า', 'required');
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
        if ($this->form_validation->run() == FALSE) {
            $data = array(
                'error' => array(
                    'status' => FALSE,
                    'message' => $this->form_validation->getErrorsArray(),
                ), 400);
            echo json_encode($data);
        } else {
            $file = NULL;
            if (!empty($_FILES['cover_img']['tmp_name'])) {
                if ($this->upload->do_upload('photo')) {
                    $file = array('upload_data' => $this->upload->data());
                }
            }
            $rs = $this->Products_model->add_save($file);
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

    public function edit() {
        $this->load->model('products/Category_model');
        $rs = $this->Products_owner_model->get_view($this->uri->segment(5));
        $data = array(
            'title' => 'เพิ่มสินค้า',
            'breadcrumbs' => array(
                'รายการสินค้า' => 'products/backend/product',
                'แก้ไขสินค้า' => '#'
            ),
            'item' => $rs,
            'category' => $this->Category_owner_model->get_ddl(FALSE),
            'cat_root_id' => $this->Category_model->get_sub_id($rs->cat_id)
        );
        $this->template->load('backend/master', 'products/backend/product/owner/product_edit', $data);
    }

    public function import() {
        $this->load->model('products/Category_owner_model');
        $data = array(
            'category' => $this->Category_owner_model->get_ddl()
        );
        $this->load->view('products/backend/product/owner/product_import', $data);
    }

    public function import_add() {
        $data = array(
            'title' => 'รายการสินค้านำเข้าไฟล์',
            'breadcrumbs' => array(
                'รายการสินค้า' => 'products/backend/product',
                'รายการสินค้านำเข้าไฟล์' => '#'
            )
        );
        $this->template->load('backend/master', 'products/backend/product/owner/product_import_add', $data);
    }

    public function spec() {
        $this->load->model('products/Category_model');
        $data = array(
            'item' => $this->Products_model->get_edit($this->uri->segment(5)),
            'prod_spec' => $this->Products_model->get_spec_html($this->uri->segment(5)),
            'product_gallery' => $this->Products_model->get_galler($this->uri->segment(5))
        );
        $this->load->view('products/backend/shared/product_spec_detail', $data);
    }

}
