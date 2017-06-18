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
            'web_title' => TITLE
            );
        $this->template->load('master', 'home/guest/aboutus', $data);
    }

    public function contactus()
    {
        $data = array(
            'web_title' => TITLE
            );
        $this->template->load('master', 'home/guest/contactus', $data);
    }

    public function register() {
        $data = array(
            'web_title' => TITLE,
            'ddl_branch' => $this->Common_model->get_branch_ddl(),
            'ddl_degree' => $this->Common_model->get_degree_ddl(),
            'ddl_province' => $this->Common_model->get_province_ddl(),
            'ddl_course' => $this->Common_model->get_course_ddl()
            );
        $this->template->load('template_1', 'home/guest/index', $data);
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

    function testsendmail()
    {
        $config['protocol']    = 'smtp';
        $config['smtp_host']    = 'mail.getsmarteasy.com';
        $config['smtp_port']    = '25';
        $config['smtp_user']    = 'noreply@getsmarteasy.com';
        $config['smtp_pass']    = 'noreply2016';
        $config['charset']    = 'utf-8';
        $config['newline']    = "\r\n";
        $config['mailtype'] = 'html'; // or html
        $config['validation'] = TRUE; // bool whether to validate email or not      

        $this->email->initialize($config);

        $this->email->from('noreply@getsmarteasy.com', 'noreply');
        $this->email->to('adisorn.l@outlook.com'); 

        $this->email->subject('Email Test');
        $this->email->message('Testing the email class.');  

        $this->email->send();

        echo $this->email->print_debugger();
    }

    function gencode(){
        return  $this->Home_model->gen_code(1);
    }

}
