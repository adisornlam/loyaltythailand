<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

/*
 *  @Auther : Adisorn Lamsombuth
 *  @Email : postyim@gmail.com
 *  @Website : esabay.com 
 */

/**
 * Description of Tutor_model
 *
 * @author R-D-6
 */
class Emailletter_model extends CI_Model {

	function __construct() {
		parent::__construct();
	}

	public function listall() {
		$this->load->library('datatables');
		$this->datatables->select(
			'emailletter_item.id as id, '
			. 'emailletter_item.id as id2, '
			. 'emailletter_item.title as title, '
			. 'emailletter_item.disabled as disabled, '
			. 'emailletter_item.created_at as created_at'
			. '');
		$this->datatables->from('emailletter_item');
		$this->datatables->where('disabled',1);
		$this->datatables->where('deleted_at',NULL);

		$manage = '<a href="'.site_url().'emailletter/resend/$1" class="btn-success btn btn-xs" title="Re send"><i class="fa fa-share-square-o" aria-hidden="true"></i></a> <a href="javascript:;" rel="emailletter/save/delete/$1" class="link_dialog delete btn-danger btn btn-xs" title="Delete"><i class="fa fa-trash"></i></a>';

		$this->datatables->add_column('manage', $manage, 'id');
		$this->datatables->edit_column('title', '<a href="'.site_url().'emailletter/view/$1" title="View">$2</a>', 'id2,title');
		$this->datatables->edit_column('disabled', '$1', 'check_disabled(disabled,1)');
		return $this->datatables->generate();
	}

	function add_save(){
		$user = $this->ion_auth->user()->row();

		$data = array(
			'title'=>$this->input->post('title'),
			'branch_id'=>$this->input->post('branch_id'),
			'created_at'=>date('Y-m-d H:i:s'),
			'created_user'=>$user->id,
			'updated_at'=>date('Y-m-d H:i:s')
			);
		$this->db->insert('emailletter_item',$data);
		$insert_id = $this->db->insert_id();

		$email = $this->input->post('desc_email');
		$ex_email = explode(";", $email);
		foreach ($ex_email as $item) {
			$query = $this->db->get_where('users',array('email'=>trim($item)));
			if($query->num_rows()>0){
				$row = $query->row();
				$this->db->insert('users_email',array('group_email_id'=>$insert_id,'user_id'=>$row->id));
			}
		}
		
		$rdata = array(
			'status' => TRUE,
			'redirect' => 'emailletter',
			'message_info' => 'ส่งข้อมูลเสร็จเรียบร้อยแล้ว.'
			);

		return $rdata;
	}

	function resend_save(){
		$email = $this->input->post('desc_email');
		$ex_email = explode(";", $email);
		foreach ($ex_email as $item) {
			$query = $this->db->get_where('users',array('email'=>trim($item)));
			if($query->num_rows()>0){
				$row = $query->row();
				$this->db->insert('users_email',array('group_email_id'=>$this->input->post('id'),'user_id'=>$row->id));
			}
		}
		
		$rdata = array(
			'status' => TRUE,
			'redirect' => 'emailletter',
			'message_info' => 'ส่งข้อมูลเสร็จเรียบร้อยแล้ว.'
			);

		return $rdata;
	}

	function delete_save(){
		$data = array(
			'deleted_at' => date('Y-m-d H:i:s'),
			);
		if (!$this->db->update('emailletter_item', $data,array('id'=>$this->uri->segment(4)))) {
			$rdata = array(
				'status' => FALSE,
				'message' => $this->db->_error_message()
				);
		} else {
			$rdata = array(
				'status' => TRUE,
				'redirect'=>'emailletter',
				'message_info' => 'Delete Successfully.'
				);
		}
		return $rdata;
	}

	//function
	function get_item($id){
		$this->db->select('emailletter_item.*, branch_item.title as branch_title');
		$this->db->from('emailletter_item');
		$this->db->join('branch_item','branch_item.id = emailletter_item.branch_id');
		$this->db->where('emailletter_item.id',$id);
		$this->db->where('emailletter_item.deleted_at',NULL);
		$query = $this->db->get();
		return $query->row();
	}

	function get_result_email($id){
		$this->db->select('users.*');
		$this->db->from('users');
		$this->db->join('users_email','users_email.user_id=users.id');
		$this->db->where('users_email.group_email_id',$id);
		$query = $this->db->get();
		return $query;
	}

	function get_result_email_not($id, $branch_id){
		$sql = "SELECT users.* FROM users_branchs INNER JOIN users ON users.id = users_branchs.user_id WHERE NOT EXISTS ( SELECT users_email.user_id FROM users_email WHERE users_email.user_id = users_branchs.user_id AND users_email.group_email_id = ".$id." ) AND users_branchs.branch_id = ".$branch_id." ";
		$query = $this->db->query($sql);
		return $query;
	}

	function get_email_not_list($id, $branch_id){
		$sql = "SELECT users.email FROM users_branchs INNER JOIN users ON users.id = users_branchs.user_id WHERE NOT EXISTS ( SELECT users_email.user_id FROM users_email WHERE users_email.user_id = users_branchs.user_id AND users_email.group_email_id = ".$id." ) AND users_branchs.branch_id = ".$branch_id." ";
		$query = $this->db->query($sql);
		$arr = array();
		if($query->num_rows()>0){
			foreach ($query->result() as $item) {
				$arr[] = $item->email;
			}
			$arr_email = implode(";\n", $arr);
		}else{
			$arr_email = "Not found.";
		}
		return $arr_email;
	}
}
