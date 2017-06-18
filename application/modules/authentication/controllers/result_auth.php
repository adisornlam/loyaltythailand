<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 *  @Auther : Adisorn Lamsombuth
 *  @Email : postyim@gmail.com
 *  @Website : esabay.com 
 */

/**
 * Description of result_authentication
 *
 * @author R-D-6
 */
class Result_auth extends MX_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('authentication/Authentication_model');
    }

    public function login() {
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
        $this->form_validation->set_rules('identity', 'Email', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == true) {
            $remember = ($this->input->post('remember', TRUE) ? 1 : 0);
            if ($this->ion_auth->login($this->input->post('identity'), $this->input->post('password'), $remember)) {
                $data = array(
                    'error' => array(
                        'status' => TRUE
                    ), 200);
                echo json_encode($data);
            } else {
                $data = array(
                    'error' => array(
                        'status' => FALSE,
                        'message' => $this->ion_auth->errors(),
                    ), 400);
                echo json_encode($data);
            }
        } else {
            $data = array(
                'error' => array(
                    'status' => FALSE,
                    'message' => validation_errors(),
                ), 400);
            echo json_encode($data);
        }
    }

    public function register() {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('first_name', 'ชื่อ', 'required');
        $this->form_validation->set_rules('last_name', 'นามสกุล', 'required');
        $this->form_validation->set_rules('company', 'ชื่อบริษัท/ร้าน', 'required');
        $this->form_validation->set_rules('id_card', 'เลขประจำตัวประชาชน', 'required');
        $this->form_validation->set_rules('phone', 'เบอร์ติดต่อ', 'required');
        $this->form_validation->set_rules('address', 'ที่อยู่', 'required');
        $this->form_validation->set_rules('province_id', 'จังหวัด', 'required');
        $this->form_validation->set_rules('email', 'อีเมล์', 'required');
        $this->form_validation->set_rules('password', 'รหัสผ่าน', 'required');
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
        if ($this->form_validation->run() == FALSE) {
            $data = array(
                'error' => array(
                    'status' => FALSE,
                    'message' => validation_errors(),
                ), 400);
            echo json_encode($data);
        } else {
            $rs = $this->Authentication_model->register();
            $data = array(
                'error' => array(
                    'status' => $rs['status'],
                    'redirect' => $rs['redirect'],
                    'message' => $rs['message']
            ));
            echo json_encode($data);
        }
    }

    public function forgotpassword() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('email', 'อีเมล์', 'required|email');
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
        if ($this->form_validation->run() == FALSE) {
            $data = array(
                'error' => array(
                    'status' => FALSE,
                    'message' => validation_errors(),
                ), 400);
            echo json_encode($data);
        } else {
            $rs = $this->Authentication_model->forgotpassword();
            $data = array(
                'error' => array(
                    'status' => $rs['status'],
                    'redirect' => $rs['redirect'],
                    'message' => $rs['message']
            ));
            echo json_encode($data);
        }
    }

    public function changepassword() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]|max_length[20]|matches[passconf]');
        $this->form_validation->set_rules('passconf', 'Password Confirmation', 'trim|required|min_length[6]|max_length[20]');
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
        if ($this->form_validation->run() == FALSE) {
            $data = array(
                'error' => array(
                    'status' => FALSE,
                    'message' => validation_errors(),
                ), 400);
            echo json_encode($data);
        } else {
            $rs = $this->Authentication_model->changepassword();
            $data = array(
                'error' => array(
                    'status' => $rs['status'],
                    'redirect' => $rs['redirect'],
                    'message' => $rs['message']
            ));
            echo json_encode($data);
        }
    }

    public function fb_reg() {
        $this->load->model('authentication/Ion_auth_model');
        if ($this->Ion_auth_model->email_check($this->input->post('email'))) {
            $login = $this->ion_auth->fb_login($this->input->post('email'), 'facebookdoesnothavepass123^&*%', 1);
            if ($login) {
                $data = array(
                    'error' => array(
                        'status' => TRUE,
                        'redirect' => base_url() . index_page()
                ));
                echo json_encode($data);
            } else {
                $data = array(
                    'error' => array(
                        'status' => FALSE
                ));
                echo json_encode($data);
            }
        } else {
            $rs = $this->Authentication_model->fb_reg();
            $data = array(
                'error' => array(
                    'status' => $rs['status'],
                    'redirect' => base_url() . index_page() . 'users/profile'
            ));
            echo json_encode($data);
        }
    }

}
