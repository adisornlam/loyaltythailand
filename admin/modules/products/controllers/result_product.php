<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 *  @Auther : Adisorn Lamsombuth
 *  @Email : postyim@gmail.com
 *  @Website : esabay.com 
 */

/**
 * Description of result_data
 *
 * @author R-D-6
 */
class Result_product extends MX_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->ion_auth->logged_in()) {
            redirect('backend/login', 'refresh');
        }

        $this->load->model('products/Products_model');
        $this->load->model('products/Products_owner_model');
    }

    public function listall() {
        if ($this->ion_auth->is_admin()) {
            echo $this->Products_admin_model->get_listall();
        } elseif ($this->ion_auth->in_group('owner')) {
            echo $this->Products_owner_model->get_listall();
        } else {
            
        }
    }

    public function product_import_listall() {
        echo $this->Products_owner_model->get_import_listall();
    }

    public function add() {
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
        $this->form_validation->set_rules('prod_code', 'รหัสสินค้า', 'required');
        $this->form_validation->set_rules('cat_id', 'หมวดหมู่', 'required');
        $this->form_validation->set_rules('cat_sub_1', 'หมวดหมู่', 'required');
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
        if ($this->form_validation->run() == FALSE) {
            $data = array(
                'error' => array(
                    'status' => FALSE,
                    'message' => $this->form_validation->getErrorsArray(),
                ), 400);
            echo json_encode($data);
        } else {
            $file = array();
            for ($i = 0; $i <= 5; $i++) {
                if (!empty($_FILES['photo' . $i]['tmp_name'])) {
                    if ($this->upload->do_upload('photo' . $i)) {
                        $file[] = array('upload_data_photo' . $i => $this->upload->data());
                    }
                }
            }
            $rs = $this->Products_owner_model->add($file);
            $data = array(
                'error' => array(
                    'status' => $rs['status'],
                    'redirect' => $rs['redirect'],
                    'message' => $rs['message']
            ));
            echo json_encode($data);
        }
    }

    public function import() {
        $this->load->library('form_validation');
        $this->load->helper('directory');

        $upload_config = array(
            'upload_path' => 'uploads/products/import/' . date('Ymd') . '/',
            'allowed_types' => 'csv',
            'file_name' => time()
        );
        $this->load->library('upload', $upload_config);
        $dir_exist = true;
        if (!is_dir($upload_config['upload_path'])) {
            mkdir($upload_config['upload_path'], 0777, true);
            $dir_exist = false;
        }
        if (!$this->upload->do_upload('file_imp')) {
            $data = array(
                'error' => array(
                    'status' => FALSE,
                    'message' => array(
                        'file_imp' => $this->upload->display_errors('<span class="help-block text-danger">', '</span>')
                    )
                ), 400);
            echo json_encode($data);
        } else {
            $file = array('upload_data' => $this->upload->data());
            $rs = $this->Products_owner_model->import($file);
            $data = array(
                'error' => array(
                    'status' => $rs['status'],
                    'redirect' => $rs['redirect'],
                    'message' => $rs['message']
            ));
            echo json_encode($data);
        }
    }

    public function add_import() {
        $rs = $this->Products_owner_model->add_import();
        $data = array(
            'error' => array(
                'status' => $rs['status'],
                'redirect' => $rs['redirect'],
                'message' => $rs['message']
        ));
        echo json_encode($data);
    }

    public function edit() {
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
        $this->form_validation->set_rules('prod_code', 'รหัสสินค้า', 'required');
        $this->form_validation->set_rules('cat_id', 'หมวดหมู่', 'required');
        $this->form_validation->set_rules('cat_sub_1', 'หมวดหมู่', 'required');
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
        if ($this->form_validation->run() == FALSE) {
            $data = array(
                'error' => array(
                    'status' => FALSE,
                    'message' => $this->form_validation->getErrorsArray(),
                ), 400);
            echo json_encode($data);
        } else {
            $file = array();
            for ($i = 0; $i <= 5; $i++) {
                if (!empty($_FILES['photo' . $i]['tmp_name'])) {
                    if ($this->upload->do_upload('photo' . $i)) {
                        $file[] = array('upload_data_photo' . $i => $this->upload->data());
                    }
                }
            }
            $rs = $this->Products_owner_model->edit($file);
            $data = array(
                'error' => array(
                    'status' => $rs['status'],
                    'redirect' => $rs['redirect'],
                    'message' => $rs['message']
            ));
            echo json_encode($data);
        }
    }

}
