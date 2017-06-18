<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 *  @Auther : Adisorn Lamsombuth
 *  @Email : postyim@gmail.com
 *  @Website : esabay.com 
 */

/**
 * Description of home
 *
 * @author R-D-6
 */
class Home extends MX_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("home/Home_model");
    }

    public function index() {
        $data = array();
        $this->template->load('master', 'home/guest/index', $data);
    }

    public function aboutus() {
        $data = array(
            'title_web' => 'เกี่ยวกับเรา',
            'title_page' => 'เกี่ยวกับเรา'
        );
        $this->template->load('master', 'home/guest/aboutus', $data);
    }

    public function contactus() {
        $data = array(
            'title_web' => 'ติดต่อเรา',
            'title_page' => 'ติดต่อเรา'
        );
        $this->template->load('master', 'home/guest/contactus', $data);
    }

    public function register() {
        $data = array(
            'title_web' => 'สมัครสมาชิก',
            'title_page' => 'สมัครสมาชิก',
        );
        $this->template->load('master', 'home/guest/register', $data);
    }

    public function login() {
        $data = array(
            'title_web' => 'เข้าสู่ระบบ',
            'title_page' => 'เข้าสู่ระบบ',
        );
        $this->template->load('master', 'home/guest/login', $data);
    }

    public function forgotpassword() {
        $data = array(
            'title_web' => 'ขอรหัสผ่านใหม่',
            'title_page' => 'ขอรหัสผ่านใหม่',
        );
        $this->template->load('master', 'home/guest/forgotpassword', $data);
    }

    public function register_save() {
        $rs = $this->Home_model->register_save();
        $data = array(
            'error' => array(
                'status' => $rs['status'],
                'redirect' => (isset($rs['redirect']) ? $rs['redirect'] : 0),
                'message' => (isset($rs['message']) ? $rs['message'] : 0),
                'message_info' => (isset($rs['message_info']) ? $rs['message_info'] : 0),
                'id' => (isset($rs['id']) ? $rs['id'] : 0),
            )
        );
        echo json_encode($data);
    }

}
