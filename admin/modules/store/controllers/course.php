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
class Course extends MX_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->ion_auth->logged_in()) {
            redirect('login', 'refresh');
        }
        $this->load->model("tutor/Course_model");
    }

    function index(){
        $data = array(
            'title' => 'Course : '. TITLE,
            'title_page' => 'Course'
            );

        if ($this->ion_auth->is_admin()) {
            $this->template->load('master', 'tutor/admin/course/index', $data);
        } elseif ($this->ion_auth->in_group('owner')) {
            $this->template->load('master', 'tutor/owner/course/index', $data);
        } elseif ($this->ion_auth->in_group('employee')) {
            $this->template->load('master', 'tutor/employee/course/index', $data);
        } else {
            $this->template->load('master', 'templates/not_permission', $data);
        }
    }


    function listall(){
        if ($this->ion_auth->is_admin()) {
            echo $this->Course_model->listall();
        } elseif ($this->ion_auth->in_group('owner')) {
            echo $this->Course_model->listall();
        } elseif ($this->ion_auth->in_group('employee')) {
            echo $this->Course_model->employee_listall();
        }
        
    }

    public function add() {
        $data = array(
            'title' => 'Course Add : '.TITLE,
            'title_page' => 'Course Add',
            'breadcrumbs' => array(
                'Course Overview' => 'tutor/course',
                'Course add' => '#'
                ),
            'ddl_branch' => $this->Common_model->get_branch_ddl()
            );
        $this->template->load('master', 'tutor/owner/course/add', $data);
    }

    public function add_save() {

        $rs = $this->Course_model->add_save();
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

    public function edit() {
        $item = $this->Course_model->get_item($this->uri->segment(4));
        $data = array(
            'title' => 'Course edit : '.TITLE,
            'title_page' => 'Course edit',
            'breadcrumbs' => array(
                'Course Overview' => 'tutor/course',
                'Course edit' => '#'
                ),
            'ddl_branch' => $this->Common_model->get_branch_ddl(),
            'item'=>$item
            );
        $this->template->load('master', 'tutor/owner/course/edit', $data);
    }

    public function edit_save() {
        $rs = $this->Course_model->edit_save();
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

    public function delete_save() {
        $rs = $this->Course_model->delete_save();
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

    function view(){
        $data = array(
            'title' => 'Course : '. TITLE,
            'title_page' => 'Course',
            'breadcrumbs' => array(
                'Course Overview' => 'tutor/course',
                'Course View' => '#'
                ),
            'item'=> $this->Course_model->get_item($this->uri->segment(4))
            );

        if ($this->ion_auth->is_admin()) {
            $this->template->load('master', 'tutor/admin/course/view', $data);
        } elseif ($this->ion_auth->in_group('owner')) {
            $this->template->load('master', 'tutor/owner/course/view', $data);
        } elseif ($this->ion_auth->in_group('employee')) {
            $this->template->load('master', 'tutor/employee/course/view', $data);
        } else {
            $this->template->load('master', 'templates/not_permission', $data);
        }
    }

}
