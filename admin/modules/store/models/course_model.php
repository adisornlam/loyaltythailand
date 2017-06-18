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
class Course_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    public function listall() {
        $this->load->library('datatables');
        $this->datatables->select(''
            . 'course_item.id as id, '
            . 'course_item.code_no as code_no, '
            . 'course_item.title as title, '
            . 'course_item.cost as cost, '
            . 'course_item.qty as qty, '
            . 'course_item.start_datetime as start_datetime, '
            . 'course_item.end_datetime as end_datetime, '
            . 'branch_item.title as branch'
            . '');
        $this->datatables->from('course_item');
        $this->datatables->join('branch_item', 'branch_item.id = course_item.branch_id');
        $this->datatables->where('course_item.deleted_at', NULL);
        $manage = '<a href="'.base_url().index_page().'tutor/course/edit/$1" class="btn btn-primary btn-xs" title="Edit"><i class="fa fa-pencil-square-o"></i></a> ';
        $manage .= '<a href="'.base_url().index_page().'tutor/course/view/$1" class="btn btn-primary btn-xs" title="View"><i class="fa fa-eye" aria-hidden="true"></i></a> ';
        $manage .= '<a href="javascript:;" rel="tutor/course/delete_save/$1" class="link_dialog delete btn-danger btn btn-xs" title="Delete"><i class="fa fa-trash"></i></a>';
        $this->datatables->add_column('manage', $manage, 'id');
        return $this->datatables->generate();
    }

    public function employee_listall() {
        $this->load->library('datatables');
        $this->datatables->select(''
            . 'course_item.id as id, '
            . 'course_item.code_no as code_no, '
            . 'course_item.title as title, '
            . 'course_item.cost as cost, '
            . 'course_item.qty as qty, '
            . 'course_item.start_datetime as start_datetime, '
            . 'course_item.end_datetime as end_datetime, '
            . 'branch_item.title as branch'
            . '');
        $this->datatables->from('course_item');
        $this->datatables->join('branch_item', 'branch_item.id = course_item.branch_id');
        $this->datatables->where('course_item.deleted_at', NULL);
        if($this->input->post('txt_search',true)){
            $this->datatables->like('course_item.title',$this->input->post('txt_search'));
        }

        $manage = '<a href="'.base_url().index_page().'tutor/course/view/$1" class="btn btn-primary btn-xs" title="View"><i class="fa fa-eye" aria-hidden="true"></i></a> ';
        $this->datatables->add_column('manage', $manage, 'id');
        return $this->datatables->generate();
    }

    function add_save(){
        $data = array(
            'code_no' => $this->input->post('code_no'),
            'branch_id' => $this->input->post('branch_id'),
            'title' => $this->input->post('title'),
            'desc' => $this->input->post('desc'),
            'cost' => $this->input->post('cost'),
            'qty' => $this->input->post('qty'),
            'start_datetime' => $this->input->post('start_datetime'),
            'end_datetime' => $this->input->post('end_datetime'),
            'disabled' => ($this->input->post('disabled', TRUE) ? 1 : 0),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
            );
        if (!$this->db->insert('course_item', $data)) {
            $rdata = array(
                'status' => FALSE,
                'message' => $this->db->_error_message()
                );
        } else {
            $rdata = array(
                'status' => TRUE,
                'redirect'=>'tutor/course',
                'message_info' => 'Save Successfully.'
                );
        }
        return $rdata;
    }

    function edit_save(){
        $data = array(
            'code_no' => $this->input->post('code_no'),
            'branch_id' => $this->input->post('branch_id'),
            'title' => $this->input->post('title'),
            'desc' => $this->input->post('desc'),
            'cost' => $this->input->post('cost'),
            'qty' => $this->input->post('qty'),
            'start_datetime' => $this->input->post('start_datetime'),
            'end_datetime' => $this->input->post('end_datetime'),
            'disabled' => ($this->input->post('disabled', TRUE) ? 1 : 0),
            'updated_at' => date('Y-m-d H:i:s'),
            );
        if (!$this->db->update('course_item', $data,array('id'=>$this->input->post('id')))) {
            $rdata = array(
                'status' => FALSE,
                'message' => $this->db->_error_message()
                );
        } else {
            $rdata = array(
                'status' => TRUE,
                'redirect'=>'tutor/course',
                'message_info' => 'Save Successfully.'
                );
        }
        return $rdata;
    }

    function delete_save(){
        $data = array(
            'deleted_at' => date('Y-m-d H:i:s'),
            );
        if (!$this->db->update('course_item', $data,array('id'=>$this->uri->segment(4)))) {
            $rdata = array(
                'status' => FALSE,
                'message' => $this->db->_error_message()
                );
        } else {
            $rdata = array(
                'status' => TRUE,
                'redirect'=>'tutor/course',
                'message_info' => 'Delete Successfully.'
                );
        }
        return $rdata;
    }

        //function
    function get_course_ddl($edit=0) {
        $this->db->select('*');
        $this->db->from('course_item');
        $this->db->where('disabled',1);
        $this->db->where('deleted_at',NULL);
        $query = $this->db->get();
        if($edit==0){
            $arr = array(
                '' => 'Please select'
                );
        }else{
            $arr = array();
        }
        foreach ($query->result() as $val) {
            $arr[$val->id] = $val->code_no.' '.$val->title;
        }

        return $arr;
    }

    function get_item($id){
        $this->db->select('course_item.*, branch_item.title as branch_title');
        $this->db->from('course_item');
        $this->db->join('branch_item','branch_item.id=course_item.branch_id');
        $this->db->where('course_item.id',$id);
        $query = $this->db->get();

        return $query->row();
    }
}
