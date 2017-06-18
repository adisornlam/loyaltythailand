<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 *  @Auther : Adisorn Lamsombuth
 *  @Email : postyim@gmail.com
 *  @Website : esabay.com 
 */

/**
 * Description of Student_model
 *
 * @author R-D-6
 */
class Branch_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    public function listall() {
        $this->load->library('datatables');
        $this->datatables->select(
            'branch_item.id as id, '
            . 'branch_item.code_no as code_no, '
            . 'branch_item.title as title, '
            . 'branch_item.disabled as disabled, '
            . 'branch_item.created_at as created_at'
            . '');
        $this->datatables->from('branch_item');
        $this->datatables->where('deleted_at',NULL);

        $manage = '<a href="javascript:;" rel="tutor/branch/edit/$1" class="link_dialog btn btn-primary btn-xs" title="Edit"><i class="fa fa-pencil-square-o"></i></a> ';
        $manage .= '<a href="javascript:;" rel="tutor/branch/save/delete/$1" class="link_dialog delete btn-danger btn btn-xs" title="Delete"><i class="fa fa-trash"></i></a>';

        $this->datatables->add_column('manage', $manage, 'id');
        $this->datatables->edit_column('disabled', '$1', 'check_disabled(disabled,1)');
        return $this->datatables->generate();
    }

    function add_save(){
        $data = array(
            'code_no' => $this->input->post('code_no'),
            'title' => $this->input->post('title'),
            'address' => $this->input->post('address'),
            'disabled' => ($this->input->post('disabled', TRUE) ? 1 : 0),
            'created_at' => date('Y-m-d H:i:s')
            );
        if (!$this->db->insert('branch_item', $data)) {
            $rdata = array(
                'status' => FALSE,
                'message' => $this->db->_error_message()
                );
        } else {
            $rdata = array(
                'status' => TRUE,
                'redirect'=>'tutor/branch',
                'message_info' => 'Save Successfully.'
                );
        }
        return $rdata;
    }

    function edit_save(){
        $data = array(
            'code_no' => $this->input->post('code_no'),
            'title' => $this->input->post('title'),
            'address' => $this->input->post('address'),
            'disabled' => ($this->input->post('disabled', TRUE) ? 1 : 0),
            'updated_at' => date('Y-m-d H:i:s')
            );
        if (!$this->db->update('branch_item', $data,array('id'=>$this->input->post('id')))) {
            $rdata = array(
                'status' => FALSE,
                'message' => $this->db->_error_message()
                );
        } else {
            $rdata = array(
                'status' => TRUE,
                'redirect'=>'tutor/branch',
                'message_info' => 'Save Successfully.'
                );
        }
        return $rdata;
    }

    function delete_save(){
        $data = array(
            'deleted_at' => date('Y-m-d H:i:s'),
            );
        if (!$this->db->update('branch_item', $data,array('id'=>$this->uri->segment(5)))) {
            $rdata = array(
                'status' => FALSE,
                'message' => $this->db->_error_message()
                );
        } else {
            $rdata = array(
                'status' => TRUE,
                'redirect'=>'tutor/branch',
                'message_info' => 'Delete Successfully.'
                );
        }
        return $rdata;
    }

    //function
    function get_branch_ddl($edit=0) {

        $this->db->select('*');
        $this->db->from('branch_item');
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
            $arr[$val->id] = $val->title;
        }

        return $arr;
    }

    function get_item($id){
        $query = $this->db->get_where('branch_item',array('id'=>$id));
        return $query->row();
    }
}
