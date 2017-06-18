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
class Result_content extends MX_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->ion_auth->logged_in()) {
            redirect('backend/login', 'refresh');
        }

        $this->load->model('contents/Contents_model');
    }

    public function listall() {
        echo $this->Contents_model->get_listall();
    }

    public function add() {
        $this->load->library('form_validation');
        $this->load->helper('directory');
        $upload_config = array(
            'upload_path' => 'uploads/contents/' . date('Ymd') . '/',
            'allowed_types' => 'jpg|jpeg|png',
            'file_name' => time()
        );
        $this->load->library('upload', $upload_config);
        $dir_exist = true;
        if (!is_dir($upload_config['upload_path'])) {
            mkdir($upload_config['upload_path'], 0777, true);
            $dir_exist = false;
        }
        $this->form_validation->set_rules('title', 'หัวข้อ', 'required');
        $this->form_validation->set_rules('short_desc', 'คำอธิบายย่อ', 'max_length[255]');
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

        if ($this->form_validation->run() == FALSE) {
            $data = array(
                'error' => array(
                    'status' => FALSE,
                    'message' => $this->form_validation->getErrorsArray()
                ), 400);
            echo json_encode($data);
        } else {
            $file = array();
            for ($i = 0; $i <= 1; $i++) {
                if (!empty($_FILES['photo' . $i]['tmp_name'])) {
                    if ($this->upload->do_upload('photo' . $i)) {
                        $file[] = array('upload_data_photo' . $i => $this->upload->data());
                    }
                } else {
                    $file[] = array('upload_data_photo' . $i => NULL);
                }
            }
            $rs = $this->Contents_model->add($file);
            $data = array(
                'error' => array(
                    'status' => $rs['status'],
                    'redirect' => $rs['redirect'],
                    'message' => $rs['message']
            ));
            echo json_encode($data);
        }
    }

    public function edit() {
        $this->load->library('form_validation');
        $this->load->helper('directory');

        $upload_config = array(
            'upload_path' => 'uploads/contents/' . date('Ymd') . '/',
            'allowed_types' => 'jpg|jpeg|png',
            'file_name' => time()
        );
        $this->load->library('upload', $upload_config);
        $dir_exist = true;
        if (!is_dir($upload_config['upload_path'])) {
            mkdir($upload_config['upload_path'], 0777, true);
            $dir_exist = false;
        }
        $this->form_validation->set_rules('title', 'หัวข้อ', 'required');
        $this->form_validation->set_rules('short_desc', 'คำอธิบายย่อ', 'max_length[255]');
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

        if ($this->form_validation->run() == FALSE) {
            $data = array(
                'error' => array(
                    'status' => FALSE,
                    'message' => $this->form_validation->getErrorsArray()
                ), 400);
            echo json_encode($data);
        } else {
            $file = array();
            for ($i = 0; $i <= 1; $i++) {
                if (!empty($_FILES['photo' . $i]['tmp_name'])) {
                    if ($this->upload->do_upload('photo' . $i)) {
                        $file[] = array('upload_data_photo' . $i => $this->upload->data());
                    }
                } else {
                    $file[] = array('upload_data_photo' . $i => NULL);
                }
            }
            $rs = $this->Contents_model->edit($file);
            $data = array(
                'error' => array(
                    'status' => $rs['status'],
                    'redirect' => $rs['redirect'],
                    'message' => $rs['message']
            ));
            echo json_encode($data);
        }
    }

    public function delete() {
        $rs = $this->Contents_model->delete();
        $data = array(
            'error' => array(
                'status' => $rs['status'],
                'redirect' => $rs['redirect'],
                'message' => $rs['message']
        ));
        echo json_encode($data);
    }

}
