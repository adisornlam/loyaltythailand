<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 *  @Auther : Adisorn Lamsombuth
 *  @Email : postyim@gmail.com
 *  @Website : esabay.com 
 */

/**
 * Description of dashboard
 *
 * @author R-D-6
 */
class Common extends MX_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function province() {
        return $this->Common_model->get_province();
    }

    public function amphur() {
        echo json_encode($this->Common_model->get_amphur($this->input->get('id')));
    }

    public function district() {
        echo json_encode($this->Common_model->get_district($this->input->get('id')));
    }

    public function zipcode() {
        echo json_encode($this->Common_model->get_zipcode($this->input->get('amphur_id')));
    }

    public function get_course_ddl() {
        echo json_encode($this->Common_model->get_course_ddl($this->input->get('branch_id')));
    }

    public function get_course_sub_ddl() {
        echo json_encode($this->Common_model->get_course_sub_ddl($this->input->get('course_id')));
    }

    public function get_user_email() {
        echo json_encode($this->Common_model->get_user_email($this->input->get('branch_id')));
    }

    public function get_check_session($param) {
        $session_id = $this->session->userdata($param);
        if ($session_id) {
            $data = array('status' => TRUE);
        } else {
            $data = array('status' => FALSE);
        }
        echo json_encode($data);
    }

    public function notification_topbar($param) {
        return $this->Common_model->get_notification_topbar();
    }

    public function notification_clear() {
        return $this->Common_model->notification_clear();
    }

    public function test_email() {
//        $this->load->library('email');
//        $email_config = $this->Common_model->get_config_email();
//        $this->email->initialize($email_config);
//        $this->email->from('noreply@jib.co.th', 'INSIDE IT DISTRIBUTION');
//        $this->email->to('adisorn.l@outlook.com');
//        $this->email->subject('Test : INSIDE IT DISTRIBUTION');
//
//        $data = array(
//            'fullname' => "กิติ สิงห์หาปัต",
//            'link_confirm' => anchor('backend/register/confirm/agdsdfsesd654s6e5sdsdfe', 'ยืนยันข้อมูลการสมัคร')
//        );
//        $email = $this->load->view('products/email/notice_new_order', $data, TRUE);
//        $this->email->message($email);
//        $this->email->send();
//        echo "Success";
        $this->load->view('products/email/notice_new_order');
    }

}
