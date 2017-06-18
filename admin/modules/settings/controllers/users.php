<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

/*
 *  @Auther : Adisorn Lamsombuth
 *  @Email : postyim@gmail.com
 *  @Website : esabay.com 
 */

/**
 * Description of category
 *
 * @author R-D-6
 */
class Users extends MX_Controller {

	public function __construct() {
		parent::__construct();
		if (!$this->ion_auth->logged_in()) {
			redirect('login', 'refresh');
		}
		$this->load->model('settings/Users_model');
		$this->load->model('tutor/Branch_model');
	}

	public function index() {
		$data = array(
			'title' => 'Users : '.TITLE,
			'title_page' => 'Users'
			);
		if ($this->ion_auth->is_admin()) {
			$this->template->load('master', 'settings/admin/users/index', $data);
		} elseif ($this->ion_auth->in_group('owner')) {
			$this->template->load('master', 'settings/owner/users/index', $data);
		}
	}

	public function users_listall() {
		if ($this->ion_auth->in_group('admin')){
			echo $this->Users_model->admin_listall();
		}else if($this->ion_auth->in_group('owner')){
			echo $this->Users_model->owner_listall();
		}
	}

	public function users_add() {
		if ($this->ion_auth->in_group('admin')) {
			$data = array(
				'group' => $this->Users_model->get_group_ddl()
				);
			$this->load->view('settings/admin/users/users_add', $data);
		} elseif ($this->ion_auth->in_group('owner')) {
			$data = array(
				'ddl_group'=>$this->Users_model->get_group_ddl(),
				'ddl_branch'=>$this->Branch_model->get_branch_ddl()
				);
			$this->load->view('settings/owner/users/users_add',$data);
		}
	}

	public function users_add_save() {

		$rs = $this->Users_model->users_add_save();
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

	public function group_add() {
		$this->load->view('settings/users/admin/group_add');
	}

	public function edit() {
		$data = array(
			'item' => $this->Users_model->get_item($this->uri->segment(4)),
			'ddl_group' => $this->Users_model->get_group_ddl()
			);

		$this->load->view('settings/owner/users/users_edit', $data);
	}

	public function users_edit_save() {
		$rs = $this->Users_model->users_edit_save();
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

	public function group() {
		$data = array(
			'title' => 'Group : '.TITLE,
			'breadcrumbs' => array(
				'Settings Overview' => 'settings/backend',
				'Users List' => 'settings/users',
				'Group List' => '#'
				)
			);
		$this->template->load('master', 'settings/users/admin/group_index', $data);
	}

	public function group_edit() {
		$this->load->model('settings/Menu_model', 'menu');
		$rs = $this->Users_model->get_group_edit($this->uri->segment(4));
		$rs2 = $this->Users_model->get_group_menu($this->uri->segment(4));
		if ($rs2) {
			foreach ($rs2 as $value) {
				$ar[] = $value->menu_id;
			}
		} else {
			$ar = array();
		}
		$data = array(
			'item' => $rs,
			'menu_val' => $ar
			);
		$this->load->view('settings/users/admin/group_edit', $data);
	}

}
