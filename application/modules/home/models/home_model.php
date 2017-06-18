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
        $password = $this->Ion_auth_model->hash_password($this->input->post('password'), FALSE);
        $data = array(
            'code_member' => time(),
            'first_name' => trim($this->input->post('first_name')),
            'last_name' => trim($this->input->post('last_name')),
            'password' => $password,
            'email' => trim($this->input->post('email')),
            'ip_address' => $this->input->ip_address(),
            'created_on' => time(),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
            'active' => 1
        );
        $this->db->insert('users', $data);
        $uer_id = $this->db->insert_id();
        $this->db->insert('users_groups', array('user_id' => $uer_id, 'group_id' => 3));

        $data2 = array(
            'user_id' => $uer_id
        );
        $this->db->insert('config_website', $data2);

        $this->ion_auth->login($this->input->post('email'), $this->input->post('password'), 1);

        $rdata = array(
            'status' => TRUE,
            'redirect' => base_url() . 'admin.php/dashboard',
            'message_info' => 'ลงทะเบียนเสร็จเรียบร้อยแล้ว<br />คุณสามารถเข้าสู่ระบบได้ทันที'
        );

        return $rdata;
    }

}
