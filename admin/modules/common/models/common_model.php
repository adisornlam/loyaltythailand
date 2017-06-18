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

    public function get_province_ddl($edit=0) {
        $this->db->select('*');
        $this->db->from('provinces');
        $this->db->order_by('PROVINCE_NAME');
        $query = $this->db->get();  
        if($edit==0){
            $arr = array(
                '' => 'Please select'
                );
        }else{
            $arr = array();
        }
        foreach ($query->result() as $val) {
            $arr[$val->PROVINCE_ID] = $val->PROVINCE_NAME;
        }
        return $arr;
    }

    public function get_amphur_ddl($id = 0) {
        $this->db->select('*');
        $this->db->from('amphur');
        $this->db->order_by('AMPHUR_NAME');
        $this->db->where('province_id', $id);
        $query = $this->db->get();
        $arr = array(
            '' => 'Please select'
            );
        foreach ($query->result() as $val) {
            $arr[$val->amphur_id] = $val->AMPHUR_NAME;
        }
        return $arr;
    }

    public function get_district_ddl($id = 0) {
        $this->db->select('*');
        $this->db->from('district');
        $this->db->order_by('district_name');
        $this->db->where('amphur_id', $id);
        $query = $this->db->get();
        $arr = array(
            '' => 'Please select'
            );
        foreach ($query->result() as $val) {
            $arr[$val->district_id] = $val->district_name;
        }
        return $arr;
    }

    public function get_zipcode($id = 0) {
        $query = $this->db->get_where('amphur_postcode', array('amphur_id' => $id));
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


    public function get_config_email() {
        $query = $this->db->get_where('system_config_website', array('id' => 1));
        $row = $query->first_row();
        $config['useragent'] = $row->useragent;
        $config['protocol'] = 'smtp';
        $config['mailpath'] = '/usr/sbin/sendmail';
        $config['smtp_host'] = $row->host;
        $config['smtp_user'] = $row->username;
        $config['smtp_pass'] = $row->password;
        $config['smtp_port'] =  $row->port;
        $config['smtp_timeout'] = 5;
        $config['wordwrap'] = TRUE;
        $config['wrapchars'] = 76;
        $config['mailtype'] = 'html';
        $config['charset'] = 'utf-8';
        $config['validate'] = FALSE;
        $config['priority'] = 3;
        $config['crlf'] = "\r\n";
        $config['newline'] = "\r\n";
        $config['bcc_batch_mode'] = FALSE;
        $config['bcc_batch_size'] = 200;
        return $config;
    }

    public function get_branch_ddl($edit=0){
        $query = $this->db->get_where('branch_item',array('disabled'=>1,'deleted_at'=>NULL));
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

    public function get_branch_ddl2(){
        $query = $this->db->get_where('branch_item',array('disabled'=>1,'deleted_at'=>NULL));
        $arr = array(
            '' => 'Please select',
            'all'=> 'Select All'
            );

        foreach ($query->result() as $val) {
            $arr[$val->id] = $val->title;
        }
        return $arr;
    }

    public function get_course_ddl($id){
        $this->db->select('id, code_no, title');
        $this->db->from('course_item');
        $this->db->where('branch_id',$id);
        $this->db->where('disabled',1);
        $this->db->where('deleted_at',NULL);
        $query = $this->db->get();
        if($query->num_rows()>0){
            foreach ($query->result() as $val) {
                $arr[$val->id] = $val->code_no.' '.$val->title;
            }
        }else{
            $arr = array(''=>'ไม่พบข้อมูล.');
        }
        return $arr;

    }

    function get_course_sub_ddl($id){
        $this->db->select('course_sub.id, course_sub.title');
        $this->db->from('course_sub');
        $this->db->join('course_item_sub','course_item_sub.course_sub_id = course_sub.id','inner');
        $this->db->where('course_item_sub.course_item_id',$id);
        $query = $this->db->get();
        if($query->num_rows()>0){
            foreach ($query->result() as $val) {
                $arr[$val->id] = $val->title;
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

    public function get_branch_result($edit=0){
        $query = $this->db->get_where('branch_item',array('disabled'=>1,'deleted_at'=>NULL));
        return $query;
    }

    function get_user_email($id){
        $this->db->select('users.email as email');
        $this->db->from('users');
        $this->db->join('users_branchs', 'users_branchs.user_id=users.id', 'inner');
        $this->db->join('users_groups', 'users_groups.user_id=users.id', 'inner');
        if($id!='all'){
            $this->db->where('users_branchs.branch_id',$id);
        }
        $this->db->where('users_groups.group_id',19);
        $this->db->where('users.active',1);
        $this->db->where('users.deleted_at',NULL);
        $query = $this->db->get();
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
