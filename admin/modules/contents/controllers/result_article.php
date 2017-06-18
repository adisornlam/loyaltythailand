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
class Result_article extends MX_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->ion_auth->logged_in()) {
            redirect('backend/login', 'refresh');
        }

        $this->load->model('contents/Article_model');
    }

    public function listall() {
        echo $this->Article_model->get_listall();
    }

    public function add() {
        $this->load->library('form_validation');
        $this->load->helper('directory');

        $upload_config = array(
            'upload_path' => 'uploads/contents/' . date('Ymd') . '/',
            'allowed_types' => 'jpg|jpeg|png',
            'max_size' => '512',
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
            if (!empty($_FILES['img_cover']['tmp_name'])) {
                if (!$this->upload->do_upload('img_cover')) {
                    $data = array(
                        'error' => array(
                            'status' => FALSE,
                            'message' => array(
                                'img_cover' => $this->upload->display_errors('<span class="help-block text-danger">', '</span>')
                            )
                        ), 400);
                    echo json_encode($data);
                } else {
                    $file = array('upload_data' => $this->upload->data());
                    $rs = $this->Article_model->add($file);
                    $data = array(
                        'error' => array(
                            'status' => $rs['status'],
                            'redirect' => $rs['redirect'],
                            'message' => $rs['message']
                    ));
                    echo json_encode($data);
                }
            } else {
                $rs = $this->Article_model->add();
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

    public function edit() {
        $this->load->library('form_validation');
        $this->load->helper('directory');

        $upload_config = array(
            'upload_path' => 'uploads/contents/' . date('Ymd') . '/',
            'allowed_types' => 'jpg|jpeg|png',
            'max_size' => '512',
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
            if (!empty($_FILES['img_cover']['tmp_name'])) {
                if (!$this->upload->do_upload('img_cover')) {
                    $data = array(
                        'error' => array(
                            'status' => FALSE,
                            'message' => array(
                                'img_cover' => $this->upload->display_errors('<span class="help-block text-danger">', '</span>')
                            )
                        ), 400);
                    echo json_encode($data);
                } else {
                    $file = array('upload_data' => $this->upload->data());
                    $rs = $this->Article_model->edit($file);
                    $data = array(
                        'error' => array(
                            'status' => $rs['status'],
                            'redirect' => $rs['redirect'],
                            'message' => $rs['message']
                    ));
                    echo json_encode($data);
                }
            } else {
                $rs = $this->Article_model->edit();
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

    public function delete() {
        $rs = $this->Article_model->delete();
        $data = array(
            'error' => array(
                'status' => $rs['status'],
                'redirect' => $rs['redirect'],
                'message' => $rs['message']
        ));
        echo json_encode($data);
    }

}
