<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Home_model
 *
 * @author adisornlam
 */
class Home_model extends CI_Model {

	function __construct() {
		parent::__construct();
	}

    // add, update, delete
	public function register_save() {
		$this->load->helper('string');
		$rpassword = random_string('alnum', 8);
		$password = $this->Ion_auth_model->hash_password($rpassword, FALSE);
		$code_member = $this->gen_code($this->input->post('branch_id'));
		$data = array(
			'code_member'=>$code_member,
			'username'=>$code_member,
			'first_name' => trim($this->input->post('first_name')),
			'last_name' => trim($this->input->post('last_name')),
			'nick_name' => trim($this->input->post('nick_name')),
			'password' => $password,
			'email' => trim($this->input->post('parent_email')),
			'ip_address' => $this->input->ip_address(),
			'created_on' => time(),
			'active' => 0,
			'parent_first_name' => trim($this->input->post('parent_first_name')),
			'parent_last_name' => trim($this->input->post('parent_last_name')),
			'parent_mobile' => trim($this->input->post('parent_mobile')),
			'parent_address' => trim($this->input->post('parent_address')),
			'parent_phone' => trim($this->input->post('parent_phone')),
			'parent_email' => trim($this->input->post('parent_email')),
			'parent_facebook' => trim($this->input->post('parent_facebook')),
			'degree_id' => trim($this->input->post('degree_id')),
			'school_name' => trim($this->input->post('school_name')),
			'school_province_id' => trim($this->input->post('school_province_id')),
			'stuold' => 0
			);
		$this->db->insert('users', $data);
		$uer_id = $this->db->insert_id();
		$this->db->insert('users_groups', array('user_id' => $uer_id , 'group_id' => 19));
		$this->db->insert('users_branchs', array('user_id' => $uer_id, 'branch_id' => $this->input->post('branch_id')));

		if($this->input->post('course_id',true)){
			$this->db->insert('users_courses', array('user_id' => $uer_id, 'course_id' => $this->input->post('course_id'),'register_date'=>date('Y-m-d')));

		}

        //sendmail
		$config['protocol']    = 'smtp';
		$config['smtp_host']    = 'mail.getsmarteasy.com';
		$config['smtp_port']    = '25';
		$config['smtp_user']    = 'noreply@getsmarteasy.com';
		$config['smtp_pass']    = 'noreply2016';
		$config['charset']    = 'utf-8';
		$config['newline']    = "\r\n";
		$config['mailtype'] = 'html';
		$config['validation'] = TRUE;     

		$this->email->initialize($config);

		$this->email->from('noreply@getsmarteasy.com', 'noreply');
		$this->email->to($this->input->post('parent_email')); 

		$this->email->subject('Register KDC Tutor');
		$data_email = array(
			'full_name'=> trim($this->input->post('parent_first_name')).' '.trim($this->input->post('parent_last_name')),
			'new_username'=>$code_member,
			'new_password'=> $rpassword
			);
		$mesg = $this->load->view('authentication/email/register', $data_email, true);
		$this->email->message($mesg);  

		$this->email->send();


		$rdata = array(
			'status' => TRUE,
			'redirect' => 'tutor/student',
			'message_info' => 'Save data success.'
			);

		return $rdata;
	}   

	public function gen_code($id){
		$query_branch = $this->db->get_where('branch_item',array('id'=>$id));
		$row_branch = $query_branch->row();

		$this->db->select('users.id, users.code_member');
		$this->db->from('users');
		$this->db->join('users_branchs','users_branchs.user_id=users.id');
		$this->db->join('users_groups','users_groups.user_id=users.id');
		$this->db->where('users_groups.group_id',19);
		$this->db->where('users.deleted_at',NULL);
		$this->db->where('users_branchs.branch_id',$id);
		$this->db->order_by('users.id','desc');
		$this->db->limit(1);
		$query = $this->db->get();
		if($query->num_rows()>0){
			$row = $query->row();
			$nc = intval(substr($row->code_member,5,10));
			$n = $nc+1;
			$c = 'KDC'.$row_branch->code_no.str_pad($n, 6, "0", STR_PAD_LEFT);            
		}else{
			$c = 'KDC'.$row_branch->code_no.'000001';
		}
		return $c;
	}

}
