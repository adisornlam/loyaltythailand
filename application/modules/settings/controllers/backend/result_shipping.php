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
class Result_shipping extends MX_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->ion_auth->logged_in()) {
            redirect('backend/login', 'refresh');
        }
        $this->load->model('settings/Shipping_model');
    }

    public function listall() {
        echo $this->Shipping_model->get_listall();
    }

    public function add() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
        if ($this->form_validation->run() == FALSE) {
            $data = array(
                'error' => array(
                    'status' => FALSE,
                    'message' => validation_errors(),
                ), 400);
            echo json_encode($data);
        } else {
            $rs = $this->Shipping_model->add();
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
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
        if ($this->form_validation->run() == FALSE) {
            $data = array(
                'error' => array(
                    'status' => FALSE,
                    'message' => validation_errors(),
                ), 400);
            echo json_encode($data);
        } else {
            $rs = $this->Shipping_model->edit();
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
        $rs = $this->Shipping_model->delete();
        $data = array(
            'error' => array(
                'status' => $rs['status'],
                'redirect' => $rs['redirect'],
                'message' => $rs['message']
        ));
        echo json_encode($data);
    }

}
