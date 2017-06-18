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
class Result_user_wholesale extends MX_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->ion_auth->logged_in()) {
            redirect('backend/login', 'refresh');
        }
        $this->load->model('users/Users_wholesale_model');
    }

    public function listall() {
        echo $this->Users_wholesale_model->get_listall();
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
            $rs = $this->Users_wholesale_model->add();
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
            $rs = $this->Users_wholesale_model->edit();
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

        $this->form_validation->set_rules('receive_name', 'Name', 'required');
        $this->form_validation->set_rules('address', 'Address', 'required');
        $this->form_validation->set_rules('province_id', 'Arovince', 'required|email');
        $this->form_validation->set_rules('amphur_id', 'Amphur', 'required');
        $this->form_validation->set_rules('district_id', 'District', 'required');
        $this->form_validation->set_rules('zipcode', 'Zipcode', 'required');
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
        if ($this->form_validation->run() == FALSE) {
            $data = array(
                'error' => array(
                    'status' => FALSE,
                    'message' => validation_errors(),
                ), 400);
            echo json_encode($data);
        } else {
            $rs = $this->Users_wholesale_model->add_address();
            $data = array(
                'error' => array(
                    'status' => $rs['status'],
                    'redirect' => $rs['redirect'],
                    'message' => $rs['message']
            ));
            echo json_encode($data);
        }
    }

    public function get_file_download() {
        $this->load->helper('download');
        $rs = $this->Users_wholesale_model->get_edit($this->uri->segment(5));
        if ($rs->num_rows() > 0) {
            $row = $rs->first_row();
            if ($this->uri->segment(6) == 'file1') {
                $data = file_get_contents($row->file1);
                $ext = pathinfo($row->file1, PATHINFO_EXTENSION);
            } elseif ($this->uri->segment(6) == 'file2') {
                $data = file_get_contents($row->file2);
                $ext = pathinfo($row->file2, PATHINFO_EXTENSION);
            } elseif ($this->uri->segment(6) == 'file3') {
                $data = file_get_contents($row->file3);
                $ext = pathinfo($row->file3, PATHINFO_EXTENSION);
            } elseif ($this->uri->segment(6) == 'file4') {
                $data = file_get_contents($row->file4);
                $ext = pathinfo($row->file4, PATHINFO_EXTENSION);
            } elseif ($this->uri->segment(6) == 'file5') {
                $data = file_get_contents($row->file5);
                $ext = pathinfo($row->file5, PATHINFO_EXTENSION);
            }

            force_download('' . time() . '.' . $ext, $data);
        }
    }

    public function set_file_delete() {
        $this->load->helper("file");
        delete_files($path);
        $rs = $this->Users_wholesale_model->get_edit($this->uri->segment(5));
        if ($rs->num_rows() > 0) {
            $row = $rs->first_row();
            if ($this->uri->segment(6) == 'file1') {
                $data = file_get_contents($row->file1);
                $ext = pathinfo($row->file1, PATHINFO_EXTENSION);
            } elseif ($this->uri->segment(6) == 'file2') {
                $data = file_get_contents($row->file2);
                $ext = pathinfo($row->file2, PATHINFO_EXTENSION);
            } elseif ($this->uri->segment(6) == 'file3') {
                $data = file_get_contents($row->file3);
                $ext = pathinfo($row->file3, PATHINFO_EXTENSION);
            } elseif ($this->uri->segment(6) == 'file4') {
                $data = file_get_contents($row->file4);
                $ext = pathinfo($row->file4, PATHINFO_EXTENSION);
            } elseif ($this->uri->segment(6) == 'file5') {
                $data = file_get_contents($row->file5);
                $ext = pathinfo($row->file5, PATHINFO_EXTENSION);
            }

            force_download('' . time() . '.' . $ext, $data);
        }
    }

}
