<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 *  @Auther : Adisorn Lamsombuth
 *  @Email : postyim@gmail.com
 *  @Website : esabay.com 
 */

/**
 * Description of users_model
 *
 * @author R-D-6
 */
class Users_model extends CI_Model {
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

    public function edit_save() {
        $data = array(
            'first_name' => trim($this->input->post('first_name')),
            'last_name' => trim($this->input->post('last_name')),
            'nick_name' => trim($this->input->post('nick_name')),
            'parent_first_name' => trim($this->input->post('parent_first_name')),
            'parent_last_name' => trim($this->input->post('parent_last_name')),
            'parent_address' => trim($this->input->post('parent_address')),
            'parent_phone' => trim($this->input->post('parent_phone')),
            'degree_id' => trim($this->input->post('degree_id'))
            );
        if($this->input->post('chkpass',true)){
            $password = $this->Ion_auth_model->hash_password($this->input->post('new_password'), FALSE);
            $data2 = array('password'=>$password);
        }else{
            $data2 = array();
        }
        $result = array_merge($data, $data2);
        $this->db->update('users', $result,array('id'=>$this->input->post('id')));
        
        $rdata = array(
            'status' => TRUE,
            'redirect' => 'profile/edit',
            'message_info' => 'Save data success.'
            );

        return $rdata;
    }   
}
