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
        } elseif ($this->ion_auth->in_group('teacher')) {
            $this->template->load('master', 'tutor/teacher/student/index', $data);
        } else {
            $this->template->load('master', 'templates/not_permission', $data);
        }
    }


    function listall(){
        if ($this->ion_auth->is_admin()) {
         echo $this->Student_model->listall();
     } elseif ($this->ion_auth->in_group('owner')) {
        echo $this->Student_model->listall();
    } elseif ($this->ion_auth->in_group('employee')) {
     echo $this->Student_model->listall();
 } elseif ($this->ion_auth->in_group('teacher')) {
     echo $this->Student_model->teacher_listall();
 }else{

 }
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
        'item'=>$item,
        'result_course'=>$this->Student_model->get_course_result($this->uri->segment(4))
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
    } elseif ($this->ion_auth->in_group('teacher')) {
        $this->template->load('master', 'tutor/teacher/student/view', $data);
    } else {
        $this->template->load('master', 'templates/not_permission', $data);
    }     
}

function sendpassword(){
    $data = array(
        'item'=>$this->Student_model->get_view($this->uri->segment(4))
        );
    
    $this->load->view('tutor/owner/student/sendpassword',$data);
}

public function edit_course() {
    $item = $this->Student_model->get_item($this->uri->segment(4));
    $data = array(
        'title' => 'Edit Course : '.TITLE,
        'title_page' => 'Edit Course',
        'breadcrumbs' => array(
            'Student Overview' => 'tutor/student',
            'Student Edit' => '#'
            ),
        'ddl_branch' => $this->Common_model->get_branch_ddl(1),
        'item'=>$item,
        'result_course'=>$this->Student_model->get_course_result($this->uri->segment(4))
        );
    if ($this->ion_auth->is_admin()) {
        $this->template->load('master', 'tutor/admin/student/edit_course', $data);
    } elseif ($this->ion_auth->in_group('owner')) {
        $this->template->load('master', 'tutor/owner/student/edit_course', $data);
    } elseif ($this->ion_auth->in_group('employee')) {
        $this->template->load('master', 'tutor/employee/student/edit_course', $data);
    } else {
        $this->template->load('master', 'templates/not_permission', $data);
    }     
}

public function add_course() {
    $data = array(
        'ddl_branch' => $this->Common_model->get_branch_ddl(),
        'ddl_course' => $this->Course_model->get_course_ddl()
        );
    if ($this->ion_auth->is_admin()) {
        $this->load->view('tutor/admin/student/add_course',$data);
    } elseif ($this->ion_auth->in_group('owner')) {
        $this->load->view('tutor/owner/student/add_course',$data);
    } elseif ($this->ion_auth->in_group('employee')) {
        $this->load->view('tutor/employee/student/add_course',$data);
    } else {
        $this->template->load('master', 'templates/not_permission', $data);
    }     
}

public function comment() {
    $item = $this->Student_model->get_comment($this->uri->segment(4));
    $data = array(
        'title' => 'Student Comment : '.TITLE,
        'title_page' => 'Student Comment',
        'breadcrumbs' => array(
            'Student Overview' => 'tutor/student',
            'Student View' => 'tutor/student/view/'.$item->user_id,
            'Student Comment' => '#'
            ),
        'item'=>$item
        );
    if ($this->ion_auth->is_admin()) {
        $this->template->load('master', 'tutor/admin/student/comment', $data);
    } elseif ($this->ion_auth->in_group('owner')) {
        $this->template->load('master', 'tutor/owner/student/comment', $data);
    } elseif ($this->ion_auth->in_group('teacher')) {
        $this->template->load('master', 'tutor/teacher/student/comment', $data);
    } else {
        $this->template->load('master', 'templates/not_permission', $data);
    }     
}

public function add_comment() {
    $item = $this->Student_model->get_comment($this->uri->segment(4));
    $data = array(
        'title' => 'Student Comment Add : '.TITLE,
        'title_page' => 'Student Comment Add',
        'breadcrumbs' => array(
            'Student Overview' => 'tutor/student',
            'Student View' => 'tutor/student/view/'.$item->user_id,
            'Student Comment' => 'tutor/student/comment/'.$item->id,
            'Student Comment Add' => '#'
            ),
        'item'=>$item
        );
    if ($this->ion_auth->is_admin()) {
        $this->template->load('master', 'tutor/admin/student/add_comment', $data);
    } elseif ($this->ion_auth->in_group('owner')) {
        $this->template->load('master', 'tutor/owner/student/add_comment', $data);
    } elseif ($this->ion_auth->in_group('teacher')) {
        $this->template->load('master', 'tutor/teacher/student/add_comment', $data);
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
    }else if($this->uri->segment(4)=='comment_add'){
        $rs = $this->Student_model->comment_add();
    }else if($this->uri->segment(4)=='course_delete'){
        $rs = $this->Student_model->course_delete();
    }else if($this->uri->segment(4)=='course_add'){
        $rs = $this->Student_model->course_add();
    }else if($this->uri->segment(4)=='sendpassword'){
        $rs = $this->Student_model->sendpassword();
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
