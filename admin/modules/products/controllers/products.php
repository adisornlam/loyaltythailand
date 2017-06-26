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

        $this->load->helper('products/useful');
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
                if ($this->upload->do_upload('cover_img')) {
                    $image_data = $this->upload->data();
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = $image_data['full_path'];
                    $config['maintain_ratio'] = TRUE;
                    $config['create_thumb'] = TRUE;
                    $config['width'] = 250;
                    $config['height'] = 250;
                    $this->load->library('image_lib', $config);
                    if (!$this->image_lib->resize()) {
                        $this->handle_error($this->image_lib->display_errors());
                    }
                    $file = array('upload_data' => $image_data);
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
        $data = array(
            'title_page' => 'แก้ไขสินค้า',
            'breadcrumbs' => array(
                'รายการสินค้า' => 'products',
                'เพิ่มสินค้า' => '#'
            ),
            'item' => $this->Products_model->get_item($this->uri->segment(3)),
            'ddl_cat' => $this->Category_model->get_ddl()
        );
        $this->template->load('master', 'products/store/product/edit', $data);
    }

    public function edit_save() {
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
                if ($this->upload->do_upload('cover_img')) {
                    $image_data = $this->upload->data();
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = $image_data['full_path'];
                    $config['maintain_ratio'] = TRUE;
                    $config['create_thumb'] = TRUE;
                    $config['width'] = 250;
                    $config['height'] = 250;
                    $this->load->library('image_lib', $config);
                    if (!$this->image_lib->resize()) {
                        $this->handle_error($this->image_lib->display_errors());
                    }
                    $file = array('upload_data' => $image_data);
                }
            } else {
                $file = $this->input->post("cover_img_hidden");
            }
            $rs = $this->Products_model->edit_save($file);
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

    public function index2() {
        if ($this->input->post('image_upload')) {
            $upload_path = './upload/';
            $config['upload_path'] = $upload_path;
            $config['allowed_types'] = 'jpg|png|gif';
            $config['max_size'] = '0';
            $config['max_filename'] = '255';
            $config['encrypt_name'] = TRUE;
            $image_data = array();
            $is_file_error = FALSE;
            if (!$_FILES) {
                $is_file_error = TRUE;
                $this->handle_error('Select an image file.');
            }
            if (!$is_file_error) {
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('image_name')) {
                    $this->handle_error($this->upload->display_errors());
                    $is_file_error = TRUE;
                } else {
                    $image_data = $this->upload->data();
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = $image_data['full_path'];
                    $config['maintain_ratio'] = TRUE;
                    $config['width'] = 150;
                    $config['height'] = 100;
                    $this->load->library('image_lib', $config);
                    if (!$this->image_lib->resize()) {
                        $this->handle_error($this->image_lib->display_errors());
                    }
                }
            }
            if ($is_file_error) {
                if ($image_data) {
                    $file = $upload_path . $image_data['file_name'];
                    if (file_exists($file)) {
                        unlink($file);
                    }
                }
            } else {
                $data['resize_img'] = $upload_path . $image_data['file_name'];
                $this->handle_success('Image was successfully uploaded to direcoty <strong>' . $upload_path . '</strong> and resized.');
            }
        }
        $data['errors'] = $this->error;
        $data['success'] = $this->success;
        return $data;
    }

}
