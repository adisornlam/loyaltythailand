<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 *  @Auther : Adisorn Lamsombuth
 *  @Email : postyim@gmail.com
 *  @Website : esabay.com 
 */

/**
 * Description of products_model
 *
 * @author R-D-6
 */
class Common_model extends CI_Model {

    public function get_province() {
        $this->db->select('*');
        $this->db->from('new_province');
        $this->db->order_by('province_name');
        $query = $this->db->get();
        $arr_cat = array(
            '' => 'Please select'
            );
        foreach ($query->result() as $val) {
            $arr_cat[$val->province_id] = $val->province_name;
        }
        return $arr_cat;
    }

    public function get_province_ddl($edit=0) {
        $this->db->select('*');
        $this->db->from('provinces');
        $this->db->order_by('PROVINCE_NAME');
        $query = $this->db->get();  
        if($edit==0){
            $arr = array(
                '' => 'Please select province.'
                );
        }else{
            $arr = array();
        }
        foreach ($query->result() as $val) {
            $arr[$val->PROVINCE_ID] = $val->PROVINCE_NAME;
        }
        return $arr;
    }

    public function get_amphur($id = 0) {
        $this->db->select('*');
        $this->db->from('new_amphur');
        $this->db->order_by('AMPHUR_NAME');
        $this->db->where('province_id', $id);
        $query = $this->db->get();
        $arr_cat = array(
            '' => 'Please select'
            );
        foreach ($query->result() as $val) {
            $arr_cat[$val->amphur_id] = $val->AMPHUR_NAME;
        }
        return $arr_cat;
    }

    public function get_district($id = 0) {
        $this->db->select('*');
        $this->db->from('new_district');
        $this->db->order_by('district_name');
        $this->db->where('amphur_id', $id);
        $query = $this->db->get();
        $arr_cat = array(
            '' => 'Please select'
            );
        foreach ($query->result() as $val) {
            $arr_cat[$val->district_id] = $val->district_name;
        }
        return $arr_cat;
    }

    public function get_zipcode($id = 0) {
        $query = $this->db->get_where('new_amphur_postcode', array('amphur_id' => $id));
        $arr_cat = array(
            '' => 'Please select'
            );
        foreach ($query->result() as $val) {
            $arr_cat[$val->post_code] = $val->post_code;
        }
        return $arr_cat;
    }

    public function upload($album_id, $album) {
        $album = strtolower($album);

        $upload_config = array('upload_path' => './uploads/' . $album, 'allowed_types' =>
            'jpg|jpeg|gif|png', 'max_size' => '2000', 'max_width' => '680', 'max_height' =>
            '435',);
        $this->load->library('upload', $upload_config);
        if (!is_dir('uploads')) {
            mkdir('./uploads', 0777, true);
        }
        $dir_exist = true;
        if (!is_dir('uploads/' . $album)) {
            mkdir('./uploads/' . $album, 0777, true);
            $dir_exist = false;
        } else {

        }

        if (!$this->upload->do_upload('imgfile')) {
            if (!$dir_exist)
                rmdir('./uploads/' . $album);

            return array('error' => $this->upload->display_errors('<span>', '</span>'));
        } else {
            $upload_data = $this->upload->data();
            return true;
        }
    }

    public function get_ddl_branch(){
        $query = $this->db->get_where('branch_item',array('disabled'=>1,'deleted_at'=>NULL));
        foreach ($query->result() as $val) {
            $arr[$val->id] = $val->title;
        }
        return $arr;
    }

    public function get_branch_ddl($edit=0){
        $query = $this->db->get_where('branch_item',array('disabled'=>1,'deleted_at'=>NULL));
        if($edit==0){
            $arr = array(
                '' => 'Please select branch.'
                );
        }else{
            $arr = array();
        }

        foreach ($query->result() as $val) {
            $arr[$val->id] = $val->title;
        }
        return $arr;
    }

    public function get_course_ddl($id=0){
        if($id>0){
            $this->db->select('id, code_no, title');
            $this->db->from('course_item');
            if($id!=0){
                $this->db->where('branch_id',$id);
            }
            $this->db->where('disabled',1);
            $this->db->where('deleted_at',NULL);
            $this->db->where('private',0);
            $query = $this->db->get();
            $arr = array();
            if($query->num_rows()>0){
                foreach ($query->result() as $val) {
                    $arr[$val->id] = $val->code_no.' '.$val->title;
                }
            }else{
                $arr = array(''=>'ไม่พบข้อมูล.');
            }
        }else{
            $arr = array(''=>'ไม่พบข้อมูล.');
        }
        return $arr;
    }

    public function get_degree_ddl($edit=0){
        $this->db->select('*');
        $this->db->from('degree');
        $this->db->where('disabled',1);
        $this->db->order_by('weight','asc');
        $query = $this->db->get();
        if($edit==0){
            $arr = array(
                '' => 'Please select degree.'
                );
        }else{
            $arr = array();
        }
        foreach ($query->result() as $val) {
            $arr[$val->id] = $val->title;
        }
        return $arr;
    }

}
