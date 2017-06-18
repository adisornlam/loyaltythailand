<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 *  @Auther : Adisorn Lamsombuth
 *  @Email : postyim@gmail.com
 *  @Website : esabay.com 
 */

/**
 * Description of Dashboard
 *
 * @author R-D-6
 */
class Dashboard extends MX_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->ion_auth->logged_in()) {
            redirect('login', 'refresh');
        }
        $this->load->model("dashboard/Dashboard_model");
    }

    public function index() {
        $user_id = $this->ion_auth->user()->row()->id;
        $data = array(
            'web_title' => TITLE,
            'item'=>$this->Dashboard_model->get_view($user_id),
            'result_course'=>$this->Dashboard_model->get_course_result($user_id)
            );
        $this->template->load('master', 'dashboard/parent/index', $data);
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
