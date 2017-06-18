<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class User_model extends CI_Model {

	function __construct()
	{
		parent::__construct();
	}

	public function get_item($id) {
		$query = $this->db->get_where('users', array('id' => $id));
		return $query->row();
	}

	function get_group() {
		$query = $this->db->get('groups');

		$arr_cat = array(
			'' => 'Please select'
			);
		foreach ($query->result() as $val) {
			$arr_cat[$val->id] = $val->name;
		}

		return $arr_cat;
	}
}