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
class result_authentication extends MX_Controller {

    public function register() {
        $this->load->model('authentication/Authentication_model');
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

    public function register_confirm() {
        $query = $this->db->get_where('users', array('salt' => base64url_decode($this->uri->segment(3)), 'active' => 0));
        if ($query->num_rows() > 0) {
            $row = $query->first_row();
            $this->db->update('users', array('active' => 1, 'updated_on' => time()), array('id' => $row->id));
            $alt = '<div class="alert alert-success alert-dismissable">';
            $alt .='<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>';
            $alt .= 'Account เปิดใช้งานเรียบร้อยแล้ว คุณสามารถเข้าสู่ระบบได้ทันที';
            $alt .='</div >';
            $data = array(
                'title' => 'Active Account : E-Office System Management 2014',
                'message' => NULL,
                'msg' => $alt
            );

            $this->template->load('backend/login', 'authentication/backend/login', $data);
        } else {
            $alt = '<div class="alert alert-danger alert-dismissable">';
            $alt .='<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>';
            $alt .= 'เสียใจด้วย Account นี้เปิดใช้งานแล้ว กรุณาตรวจสอบใหม่อีกครั้ง';
            $alt .='</div >';
            $data = array(
                'title' => 'Active Account : E-Office System Management 2014',
                'message' => NULL,
                'msg' => $alt
            );
            $this->template->load('backend/login', 'authentication/backend/login', $data);
        }
    }

}
