<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 *  @Auther : Adisorn Lamsombuth
 *  @Email : postyim@gmail.com
 *  @Website : esabay.com 
 */

/**
 * Description of authentication_model
 *
 * @author R-D-6
 */
class Authentication_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->config('ion_auth', TRUE);
    }

    public function activate(){
        $query = $this->db->get_where('users', array('activation_code' => $this->input->post("salt"), 'active' => 0));
        if ($query->num_rows() > 0) {
            $row = $query->row();
            $this->db->update('users', array('active' => 1, 'updated_on' => time()), array('id' => $this->input->post("id")));
            $rdata = array(
                'status' => TRUE,
                'message_info' => 'ยืนยันอีเมล์เรียบร้อยแล้ว กรุณาเข้าสู่ระบบเพื่อจัดการข้อมูลได้เลยค่ะ'
                );
        } else {
            $rdata = array(
                'status' => FALSE,
                'message_info' => "การยืนยันอีเมล์ไม่ถูกต้อง กรุณาตรวจสอบอีกครั้ง"
                );
        }
        return $rdata;
    }

    public function check_login(){
        $identity = $this->input->post('identity');
        $password = $this->input->post('password');
        $remember = TRUE; // remember the user

        if($this->ion_auth->login($identity, $password, $remember)){
            $rdata = array(
                'status' => TRUE
                );
        }else{
            $rdata = array(
                'status' => FALSE,
                'message_info' => $this->ion_auth->errors()
                );
        }
        return $rdata;
    }

    public function check_changepassword($param) {
        $query = $this->db->get_where('users', array('salt' => $param));
        if ($query->num_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function check_forgotpassword(){
        $forgotten = $this->ion_auth->forgotten_password($this->input->post('email'));
        if ($forgotten) {
            $rdata = array(
                'status' => TRUE,
                'redirect' => 'login',
                'message_info' => $this->ion_auth->messages()
                );
        }
        else {
            $rdata = array(
                'status' => FALSE,
                'message_info' => $this->ion_auth->errors()
                );
        }
        return $rdata;
    }

    public function forgotpassword() {
        $query = $this->db->get_where('users', array('email' => $this->input->post('email')));
        if ($query->num_rows() > 0) {
            $row = $query->first_row();
            $this->store_salt = $this->config->item('store_salt', 'ion_auth');
            $salt = $this->store_salt ? $this->Ion_auth_model->salt() : FALSE;
            $this->db->update('users', array('salt' => $salt), array('email' => $row->email));

            //Send Email        
            $this->load->library('email');
            $email_config = $this->Common_model->get_config_email();
            $this->email->initialize($email_config);
            $this->email->from('noreply@jib.co.th', 'INSIDE IT DISTRIBUTION');
            $this->email->to($row->email);
            $this->email->subject('Forgot Password : INSIDE IT DISTRIBUTION');
            $data2 = array(
                'fullname' => $row->first_name . " " . $row->last_name,
                'link' => 'https://www.jib.co.th/ws/' . index_page() . 'authentication/auth/changepassword/' . base64url_encode($salt)
                );
            $email = $this->load->view('authentication/frontend/email/forgotpassword', $data2, TRUE);
            $this->email->message($email);
            if (!$this->email->send()) {
                $rdata = array(
                    'status' => FALSE,
                    'message' => '<p class="text-center"><i class="fa fa-frown-o fa-3x text-danger"></i><br />ส่งข้อมูลไม่สำเร็จ กรุณาตรวจสอบอีกครั้ง</p>'
                    );
                return $rdata;
            } else {
                $rdata = array(
                    'status' => TRUE,
                    'redirect' => 'authentication/auth/login',
                    'message' => '<p class="text-center"><i class="fa fa-check-circle fa-3x text-success"></i><br />ส่งข้อมูลเสร็จเรียบร้อยแล้ว กรุณาตรวจสอบอีเมล์ เพื่อทำการยืนยันการเปลี่ยนรหัสผ่านใหม่</p>'
                    );
                return $rdata;
            }
        } else {
            $rdata = array(
                'status' => FALSE,
                'redirect' => 'authentication/auth/login',
                'message' => '<p class="text-center"><i class="fa fa-frown-o fa-3x text-danger"></i><br />ไม่พบอีเมล์ที่คุณกรอก กรุณาตรวจสอบใหม่อีกครั้ง</p>'
                );
            return $rdata;
        }
    }

    public function changepassword() {
        $this->store_salt = $this->config->item('store_salt', 'ion_auth');
        $salt = $this->store_salt ? $this->Ion_auth_model->salt() : FALSE;
        $password = $this->Ion_auth_model->hash_password(trim($this->input->post('password')), $salt);
        if ($this->db->update('users', array('password' => $password), array('salt' => $this->uri->segment(4)))) {
            $rdata = array(
                'status' => TRUE,
                'redirect' => 'authentication/auth/login',
                'message' => '<p class="text-center"><i class="fa fa-check-circle fa-3x text-success"></i><br />เปลี่ยนรหัสผ่านใหม่เรียบร้อยแล้ว คุณสามารถเข้าสู่ระบบได้ทันที</p>'
                );
        } else {
            $rdata = array(
                'status' => FALSE,
                'redirect' => 'authentication/auth/login',
                'message' => '<p class="text-center"><i class="fa fa-frown-o fa-3x text-danger"></i><br />เปลี่ยนรหัสผ่านไม่สำเร็จ กรุณาตรวจสอบอีกครั้ง</p>'
                );
        }
        return $rdata;
    }

}
