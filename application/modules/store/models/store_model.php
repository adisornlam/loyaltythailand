<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Store_model
 *
 * @author adisornlam
 */
class Store_model extends CI_Model {

	function __construct() {
		parent::__construct();
	}

    // add, update, delete
	public function getStore($name)
	{
		$query = $this->db->get_where('users',array('storename'=>$name,'active'=>1,'deleted_at'=>NULL));
		if($query->num_rows()>0){
			return true;
		}
		return false;
	}

}
