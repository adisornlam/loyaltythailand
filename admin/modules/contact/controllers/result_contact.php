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
class Result_contact extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('contact/Contact_model');
        $this->load->model('products/Category_model');
    }

    public function add() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('fullname', 'ชื่อ-นามสกุล', 'trim|required|min_length[6]');
        $this->form_validation->set_rules('email', 'อีเมล์', 'trim|required|email');
        $this->form_validation->set_rules('long_desc', 'ข้อความ', 'required');
        $this->form_validation->set_rules('captcha', 'Captcha', 'required|captcha');
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

        if ($this->form_validation->run() == FALSE) {
            $data = array(
                'error' => array(
                    'status' => FALSE,
                    'message' => $this->form_validation->getErrorsArray()
                ), 400);
            echo json_encode($data);
        } else {
            $rs = $this->Contact_model->add();
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
