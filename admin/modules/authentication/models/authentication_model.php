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

    function register() {
        $this->load->helper('directory');

        $upload_config = array(
            'upload_path' => 'uploads/users/files/' . date('Ymd') . '/',
            'allowed_types' => 'doc|docx|pdf',
            'file_name' => time()
        );
        $this->load->library('upload', $upload_config);
        $dir_exist = true;
        if (!is_dir($upload_config['upload_path'])) {
            mkdir($upload_config['upload_path'], 0777, true);
            $dir_exist = false;
        }
        if ($this->upload->do_upload('file1')) {
            $data = $this->upload->data();
            $file_1 = $upload_config['upload_path'] . $data['file_name'];
        }
        if ($this->upload->do_upload('file2')) {
            $data = $this->upload->data();
            $file_2 = $upload_config['upload_path'] . $data['file_name'];
        }
        if ($this->upload->do_upload('file3')) {
            $data = $this->upload->data();
            $file_3 = $upload_config['upload_path'] . $data['file_name'];
        }
        if ($this->upload->do_upload('file4')) {
            $data = $this->upload->data();
            $file_4 = $upload_config['upload_path'] . $data['file_name'];
        }
        if ($this->upload->do_upload('file5')) {
            $data = $this->upload->data();
            $file_5 = $upload_config['upload_path'] . $data['file_name'];
        }
        $this->store_salt = $this->config->item('store_salt', 'ion_auth');
        $salt = $this->store_salt ? $this->Ion_auth_model->salt() : FALSE;
        $password = $this->Ion_auth_model->hash_password(trim($this->input->post('password')), $salt);
        $array1 = array(
            'first_name' => trim($this->input->post('first_name')),
            'last_name' => trim($this->input->post('last_name')),
            'password' => $password,
            'salt' => $salt,
            'email' => trim($this->input->post('email')),
            'id_card' => trim($this->input->post('id_card')),
            'phone' => trim($this->input->post('phone')),
            'company' => trim($this->input->post('company')),
            'tax_number' => trim($this->input->post('tax_number')),
            'address' => trim($this->input->post('address')),
            'province' => trim($this->input->post('province_id')),
            'amphur' => $this->input->post('amphur_id'),
            'district' => $this->input->post('district_id'),
            'zipcode' => $this->input->post('zipcode'),
            'copy_address' => $this->input->post('copy_address', true),
            'ip_address' => $this->input->ip_address(),
            'created_on' => time(),
            'biz_type' => ($this->input->post('biz_type', TRUE) ? $this->input->post('biz_type') : NULL),
            'file1' => (isset($file_1) ? $file_1 : NULL),
            'file2' => (isset($file_2) ? $file_2 : NULL),
            'file3' => (isset($file_3) ? $file_3 : NULL),
            'file4' => (isset($file_4) ? $file_4 : NULL),
            'file5' => (isset($file_5) ? $file_5 : NULL)
        );
        if (!$this->input->post('copy_address', true)) {
            $array2 = array(
                'tax_company' => trim($this->input->post('tax_company')),
                'tax_address' => trim($this->input->post('tax_address')),
                'tax_province' => $this->input->post('tax_province_id'),
                'tax_amphur' => $this->input->post('tax_amphur_id'),
                'tax_district' => $this->input->post('tax_district_id'),
                'tax_zipcode' => $this->input->post('tax_zipcode'),
                'tax_number' => trim($this->input->post('tax_number'))
            );
        } else {
            $array2 = array(
                'tax_company' => trim($this->input->post('company')),
                'tax_address' => trim($this->input->post('address')),
                'tax_province' => $this->input->post('province_id'),
                'tax_amphur' => $this->input->post('amphur_id'),
                'tax_district' => $this->input->post('district_id'),
                'tax_zipcode' => $this->input->post('zipcode'),
                'tax_number' => trim($this->input->post('tax_number'))
            );
        }
        $result = array_merge($array1, $array2);
        $this->db->insert('users', $result);
        $user_id = $this->db->insert_id();

        $query = $this->db->get_where('users_temp_register', array('keys' => $this->input->post('user_keys')));
        if ($query->num_rows() > 0) {
            $row = $query->first_row();
            $this->db->insert('users_groups', array('user_id' => $user_id, 'group_id' => 10, 'user_parent' => $row->user_id_ref));
            $this->db->insert('users_branch', array('user_id' => $user_id, 'user_parent' => $row->user_id_ref));
            $this->db->update('users_temp_register', array('status' => 1), array('keys' => $this->input->post('user_keys'), 'updated_at' => date('Y-m-d H:i:s')));
            $data4 = array(
                'type' => 'notice',
                'pk_id' => $user_id,
                'user_id' => 0,
                'assign' => array($row->user_id_ref, $row->user_id),
                'title' => 'มีรายการสมัครสมาชิกใหม่',
                'module' => 'users',
                'url' => 'users/backend/user/edit/' . $user_id,
                'icon' => 'fa fa-user'
            );
            $this->Common_model->set_notifications($data4);
        }
        //Send Email        
        $this->load->library('email');
        $email_config = $this->Common_model->get_config_email();
        $this->email->initialize($email_config);
        $this->email->from('noreply@jib.co.th', 'JIB COMPUTER GROUP (WHOLESALE)');
        $this->email->to(trim($this->input->post('email')));
        $this->email->subject('New Register : JIB COMPUTER GROUP (WHOLESALE)');
        $data = array(
            'fullname' => trim($this->input->post('first_name')) . " " . trim($this->input->post('last_name')),
            'link_confirm' => anchor(base_url() . index_page() . 'register/confirm/' . base64url_encode($salt), 'ยืนยันข้อมูลการสมัคร')
        );
        $email = $this->load->view('authentication/frontend/email/register', $data, TRUE);
        $this->email->message($email);
        $this->email->send();

        $rdata = array(
            'status' => TRUE,
            'redirect' => 'backend/login',
            'message' => '<p class="text-center"><i class="fa fa-check-circle fa-3x text-success"></i><br />ข้อมูลสมัครตัวแทนจำหน่ายถูกส่งเสร็จเรียบร้อยแล้ว<br /> ลูกค้าสามารถเข้าใช้งานเพื่อซื้อสินค้าได้ในราคาปกติ<br /> ก่อนอื่นกรุณายืนยันการสมัครทางอีเมล์ที่ได้กรอกไว้ ขอบคุณค่ะ</p>'
        );
        return $rdata;
    }

    public function fb_reg() {
        if ($this->input->post('gender') == 'male') {
            $gender = 1;
        } else {
            $gender = 0;
        }
//        $date = date("Y-m-d", strtotime($this->input->post('birthday')));

        $this->store_salt = $this->config->item('store_salt', 'ion_auth');
        $salt = $this->store_salt ? $this->Ion_auth_model->salt() : FALSE;
        $password = $this->Ion_auth_model->hash_password('facebookdoesnothavepass123^&*%', $salt);
        $array1 = array(
            'fb_id' => trim($this->input->post('id')),
            'first_name' => trim($this->input->post('first_name')),
            'last_name' => trim($this->input->post('last_name')),
//            'birthday' => $date,
            'gender' => $gender,
            'fb_link' => $this->input->post('link'),
            'password' => $password,
            'salt' => $salt,
            'email' => trim($this->input->post('email')),
            'ip_address' => $this->input->ip_address(),
            'created_on' => time(),
            'active' => 1
        );

        $this->db->insert('users', $array1);
        $user_id = $this->db->insert_id();
        $this->db->insert('users_groups', array('user_id' => $user_id, 'group_id' => 10, 'user_parent' => 21));
        $this->db->insert('users_branch', array('user_id' => $user_id, 'user_parent' => 21));

        $this->ion_auth->login($this->input->post('email'), 'facebookdoesnothavepass123^&*%', 1);
        $rdata = array(
            'status' => TRUE
        );
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
