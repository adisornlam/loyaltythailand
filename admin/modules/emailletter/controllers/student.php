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
class Student extends MX_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->ion_auth->logged_in()) {
            redirect('login', 'refresh');
        }
        $this->load->model("tutor/Student_model");
        $this->load->model("tutor/Course_model");
    }

    function index(){
        $data = array(
            'title' => 'Student : '. TITLE,
            'title_page' => 'Student',
            'ddl_branch' => $this->Common_model->get_branch_ddl(),
            'ddl_course' => $this->Course_model->get_course_ddl()
            );

        if ($this->ion_auth->is_admin()) {
            $this->template->load('master', 'tutor/admin/student/index', $data);
        } elseif ($this->ion_auth->in_group('owner')) {
            $this->template->load('master', 'tutor/owner/student/index', $data);
        } elseif ($this->ion_auth->in_group('employee')) {
            $this->template->load('master', 'tutor/employee/student/index', $data);
        } else {
            $this->template->load('master', 'templates/not_permission', $data);
        }
    }


    function listall(){
        echo $this->Student_model->listall();
    }

    public function add() {
        $data = array(
            'title' => 'Student Add : '.TITLE,
            'title_page' => 'Student Add',
            'breadcrumbs' => array(
                'Student Overview' => 'tutor/student',
                'Student add' => '#'
                ),
            'ddl_branch' => $this->Common_model->get_branch_ddl(),
            'ddl_degree' => $this->Common_model->get_degree_ddl(),
            'ddl_province' => $this->Common_model->get_province_ddl(),
            'ddl_course' => $this->Course_model->get_course_ddl()
            );
        if ($this->ion_auth->is_admin()) {
            $this->template->load('master', 'tutor/admin/student/add', $data);
        } elseif ($this->ion_auth->in_group('owner')) {
            $this->template->load('master', 'tutor/owner/student/add', $data);
        } elseif ($this->ion_auth->in_group('employee')) {
            $this->template->load('master', 'tutor/employee/student/add', $data);
        } else {
            $this->template->load('master', 'templates/not_permission', $data);
        }     
    }

    public function edit() {
        $item = $this->Student_model->get_item($this->uri->segment(4));
        $arr_course = $this->Student_model->get_course_stu($this->uri->segment(4));
        $data = array(
            'title' => 'Student Edit : '.TITLE,
            'title_page' => 'Student Edit',
            'breadcrumbs' => array(
                'Student Overview' => 'tutor/student',
                'Student Edit' => '#'
                ),
            'ddl_branch' => $this->Common_model->get_branch_ddl(1),
            'ddl_degree' => $this->Common_model->get_degree_ddl(1),
            'ddl_province' => $this->Common_model->get_province_ddl(1),
            'ddl_course' => $this->Course_model->get_course_ddl(1),
            'item'=>$item,
            'arr_course'=>$arr_course
            );
        if ($this->ion_auth->is_admin()) {
            $this->template->load('master', 'tutor/admin/student/edit', $data);
        } elseif ($this->ion_auth->in_group('owner')) {
            $this->template->load('master', 'tutor/owner/student/edit', $data);
        } elseif ($this->ion_auth->in_group('employee')) {
            $this->template->load('master', 'tutor/employee/student/edit', $data);
        } else {
            $this->template->load('master', 'templates/not_permission', $data);
        }     
    }

    public function view() {
        $data = array(
            'title' => 'Student View : '.TITLE,
            'title_page' => 'Student View',
            'breadcrumbs' => array(
                'Student Overview' => 'tutor/student',
                'Student View' => '#'
                ),
            'item'=>$this->Student_model->get_view($this->uri->segment(4)),
            'result_course'=>$this->Student_model->get_course_result($this->uri->segment(4))
            );
        if ($this->ion_auth->is_admin()) {
            $this->template->load('master', 'tutor/admin/student/view', $data);
        } elseif ($this->ion_auth->in_group('owner')) {
            $this->template->load('master', 'tutor/owner/student/view', $data);
        } elseif ($this->ion_auth->in_group('employee')) {
            $this->template->load('master', 'tutor/employee/student/view', $data);
        } else {
            $this->template->load('master', 'templates/not_permission', $data);
        }     
    }

    public function save() {

        if($this->uri->segment(4)=='add'){
            $rs = $this->Student_model->add_save();
        }else if($this->uri->segment(4)=='edit'){
            $rs = $this->Student_model->edit_save();
        }else if($this->uri->segment(4)=='delete'){
            $rs = $this->Student_model->delete_save();
        }else{
            $rs = array();
        }

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

    function export(){
        if($this->uri->segment('4')=='excel'){
            $this->Student_model->export();
        }
    }

}
