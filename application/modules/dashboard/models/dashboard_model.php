<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Dashboard_model
 *
 * @author adisornlam
 */
class Dashboard_model extends CI_Model {

	function __construct() {
		parent::__construct();
	}

	function get_view($id){
		$this->db->select('users.*, branch_item.title as branch_title, provinces.PROVINCE_NAME as school_provine_title, degree.title as degree_title');
		$this->db->from('users');
		$this->db->join('users_branchs', 'users_branchs.user_id=users.id', 'inner');
		$this->db->join('branch_item','branch_item.id=users_branchs.branch_id');
		$this->db->join('provinces','provinces.PROVINCE_ID=users.school_province_id','left');
		$this->db->join('degree','degree.id=users.degree_id','left');
		$this->db->where('users.id',$id);
		$query = $this->db->get();
		return $query->row();
	}

	function get_course_result($id){
		$this->db->select('course_item.*, users_courses.register_date');
		$this->db->from('course_item');
		$this->db->join('users_courses','users_courses.course_id=course_item.id');
		$this->db->where('users_courses.user_id',$id);
		$query = $this->db->get();
		return $query->result();
	}

}
