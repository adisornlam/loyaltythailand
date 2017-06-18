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

    public function index()
    {
        $data = array(
            'title_web' => TITLE
            );
        $this->template->load('master', 'home/guest/index', $data);
    }

    public function aboutus()
    {
        $data = array(
            'title_page' => TITLE
            );
        $this->template->load('master', 'home/guest/aboutus', $data);
    }

    public function contactus()
    {
        $data = array(
            'title_page' => TITLE
            );
        $this->template->load('master', 'home/guest/contactus', $data);
    }

    public function register() {
        $data = array(
            'title_page' => 'สมัครสมาชิก',
            );
        $this->template->load('master', 'home/guest/register', $data);
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

    public function login() {

        $data = array(
            'web_title' => TITLE
            );
        $this->template->load('template_1', 'home/guest/login', $data);
    }
}
