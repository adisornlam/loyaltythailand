<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 *  @Auther : Adisorn Lamsombuth
 *  @Email : postyim@gmail.com
 *  @Website : esabay.com 
 */

/**
 * Description of result_users
 *
 * @author R-D-6
 */
class Result_user extends MX_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->ion_auth->logged_in()) {
            redirect('backend/login', 'refresh');
        }

        $this->load->model('users/Users_model');
    }

    public function listall() {
        echo $this->Users_model->get_listall();
    }

    public function add() {
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
            $rs = $this->Users_model->add();
            $data = array(
                'error' => array(
                    'status' => $rs['status'],
                    'redirect' => $rs['redirect'],
                    'message' => $rs['message']
            ));
            echo json_encode($data);
        }
    }

    public function add_address() {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('first_name', 'First Name', 'required');
        $this->form_validation->set_rules('last_name', 'Last Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|email');
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('group_id', 'Group', 'required');
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
        if ($this->form_validation->run() == FALSE) {
            $data = array(
                'error' => array(
                    'status' => FALSE,
                    'message' => validation_errors(),
                ), 400);
            echo json_encode($data);
        } else {
            $rs = $this->Users_model->add();
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

        $this->form_validation->set_rules('first_name', 'ชื่อ', 'required');
        $this->form_validation->set_rules('last_name', 'นามสกุล', 'required');
        $this->form_validation->set_rules('company', 'ชื่อบริษัท/ร้าน', 'required');
        $this->form_validation->set_rules('id_card', 'เลขประจำตัวประชาชน', 'required');
        $this->form_validation->set_rules('phone', 'เบอร์ติดต่อ', 'required');
        $this->form_validation->set_rules('address', 'ที่อยู่', 'required');
        $this->form_validation->set_rules('province_id', 'จังหวัด', 'required');
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
        if ($this->form_validation->run() == FALSE) {
            $data = array(
                'error' => array(
                    'status' => FALSE,
                    'message' => validation_errors(),
                ), 400);
            echo json_encode($data);
        } else {
            $rs = $this->Users_model->edit();
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
        $rs = $this->Users_model->delete();
        $data = array(
            'error' => array(
                'status' => $rs['status'],
                'redirect' => $rs['redirect'],
                'message' => $rs['message']
        ));
        echo json_encode($data);
    }

    public function update_dealer_status() {
        $this->Users_model->update_dealer_status();
    }

    public function update_active() {
        $this->Users_model->update_active();
    }

}
