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
class Result_category extends MX_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->ion_auth->logged_in()) {
            redirect('backend/login', 'refresh');
        }

        $this->load->model('products/Category_model', 'category');
        $this->load->model('products/Category_owner_model');
    }

    public function listall() {
        if ($this->ion_auth->is_admin()) {
            echo $this->category->get_listall();
        } elseif ($this->ion_auth->in_group('owner')) {
            echo $this->Category_owner_model->get_listall();
        }
    }

    public function add() {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('title', 'หัวข้อ', 'required');
        $this->form_validation->set_rules('weight', 'ลำดับ', 'numeric');
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
        if ($this->form_validation->run() == FALSE) {
            $data = array(
                'error' => array(
                    'status' => FALSE,
                    'message' => $this->form_validation->getErrorsArray()
                ), 400);
            echo json_encode($data);
        } else {
            $rs = $this->Category_owner_model->add();
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
        $this->form_validation->set_rules('title', 'หัวข้อ', 'required');
        $this->form_validation->set_rules('weight', 'ลำดับ', 'numeric');
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
        if ($this->form_validation->run() == FALSE) {
            $data = array(
                'error' => array(
                    'status' => FALSE,
                    'message' => $this->form_validation->getErrorsArray()
                ), 400);
            echo json_encode($data);
        } else {
            $rs = $this->Category_owner_model->edit();
            $data = array(
                'error' => array(
                    'status' => $rs['status'],
                    'redirect' => $rs['redirect'],
                    'message' => $rs['message']
            ));
            echo json_encode($data);
        }
    }

    public function move() {
        $rs = $this->Category_owner_model->move();
        $data = array(
            'error' => array(
                'status' => $rs['status'],
                'redirect' => $rs['redirect'],
                'message' => $rs['message']
        ));
        echo json_encode($data);
    }

    public function delete() {
        $rs = $this->Category_owner_model->delete();
        $data = array(
            'error' => array(
                'status' => $rs['status'],
                'redirect' => $rs['redirect'],
                'message' => $rs['message']
        ));
        echo json_encode($data);
    }

}
