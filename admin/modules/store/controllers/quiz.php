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
class Quiz extends MX_Controller {

	public function __construct() {
		parent::__construct();
		if (!$this->ion_auth->logged_in()) {
			redirect('login', 'refresh');
		}
		$this->load->model("tutor/Quiz_model");
		$this->load->model("tutor/Course_model");
	}

	public function index() {

		$data = array(
			'title' => 'บันทึกคะแนนสอบ : '. TITLE,
			'title_page' => 'บันทึกคะแนนสอบ',
			'ddl_branch' => $this->Common_model->get_branch_ddl(),
			'ddl_course' => $this->Course_model->get_course_ddl()
			);

		$group = array('admin','owner');
		if ($this->ion_auth->in_group($group))
		{
			$this->template->load('master', 'tutor/owner/quiz/index', $data);
		}else{
			$this->template->load('master', 'templates/not_permission', $data);
		}
	}

	function listall(){
		echo $this->Quiz_model->listall();
	}

	public function add() {
		$data = array(
			'title' => 'Quiz Add : '.TITLE,
			'title_page' => 'Quiz Add',
			'breadcrumbs' => array(
				'Quiz Overview' => 'tutor/quiz',
				'Quiz add' => '#'
				),
			'ddl_branch' => $this->Common_model->get_branch_ddl()
			);
		$group = array('admin','owner');
		if ($this->ion_auth->in_group($group))
		{
			$this->template->load('master', 'tutor/owner/quiz/add', $data);
		}else{
			$this->template->load('master', 'templates/not_permission', $data);
		}
	}

	function load_student_listall(){
		echo $this->Quiz_model->load_student_listall();
	}

	function add_save(){
		$rs = $this->Quiz_model->add_save();
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

	public function view() {
		$item = $this->Quiz_model->get_item($this->uri->segment(4));
		$desc_result = $this->Quiz_model->get_quiz_desc_result($item->course_id);
		$data = array(
			'title' => 'Quiz View : '.TITLE,
			'title_page' => 'Quiz View',
			'breadcrumbs' => array(
				'Quiz Overview' => 'tutor/quiz',
				'Quiz View' => '#'
				),
			'item' => $item,
			'desc_result'=>$desc_result->result()
			);
		$group = array('admin','owner');
		if ($this->ion_auth->in_group($group))
		{
			$this->template->load('master', 'tutor/owner/quiz/view', $data);
		}else{
			$this->template->load('master', 'templates/not_permission', $data);
		}
	}

	function viewscore(){
		$item = $this->Quiz_model->get_item($this->uri->segment(4));
		$desc_result = $this->Quiz_model->get_quiz_desc_result($item->id);
		$data = array(
			'title' => 'Quiz View : '.TITLE,
			'title_page' => 'Quiz View',
			'breadcrumbs' => array(
				'Quiz Overview' => 'tutor/quiz',
				'Quiz View' => '#'
				),
			'item' => $item,
			'desc_result'=>$desc_result->result()
			);
		$group = array('admin','owner');
		if ($this->ion_auth->in_group($group))
		{
			$this->template->load('master', 'tutor/owner/quiz/viewscore', $data);
		}else{
			$this->template->load('master', 'templates/not_permission', $data);
		}
	}

}
