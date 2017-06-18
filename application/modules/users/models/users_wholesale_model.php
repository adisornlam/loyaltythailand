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
class Users_wholesale_model extends CI_Model {

    function get_listall() {
        $this->load->library('datatables');
        $this->load->helper('users/useful');

        $this->datatables->select(
                'users.id as id, '
                . 'code_member, '
                . 'email, '
                . 'company, '
                . 'phone, '
                . 'created_on, '
                . 'last_login, '
                . 'dealer_status, '
                . 'active'
                . '');
        $this->datatables->from('users');
        $this->datatables->join('users_groups', 'users_groups.user_id=users.id', 'inner');
        $this->datatables->join('groups', 'groups.id=users_groups.group_id', 'inner');
        $this->datatables->join('users_branch', 'users_branch.user_id=users.id', 'inner');
        $this->datatables->where('groups.name', 'dealer');
        $this->datatables->where('users_branch.user_parent', $this->ion_auth->get_user_id());
        $this->datatables->where('users.deleted_at', 0);
        $link = "<div class=\"dropdown\">";
        $link .= "<a class=\"dropdown-toggle\" data-toggle=\"dropdown\" href=\"javascript:;\"><span class=\"fa fa-pencil-square-o\"></span ></a>";
        $link .= "<ul class=\"dropdown-menu\" role=\"menu\" aria-labelledby=\"dLabel\">";
        $link .= "<li><a href=\"" . base_url() . index_page() . "users/backend/user/edit/$1\" title=\"Edit Users\">Edit Users (Dealer)</a></li>";
        $link .= "<li><a href=\"javascript:;\" rel=\"users/backend/result_user/delete/$1\" class=\"link_dialog delete\" title=\"Delete Users\">Delete Users</a></li>";
        $link .= "</ul>";
        $link .= "</div>";

        $this->datatables->edit_column('id', $link, 'id');
        $this->datatables->edit_column('dealer_status', '$1', 'check_disabled(dealer_status,1)');
        $this->datatables->edit_column('active', '$1', 'check_disabled(active,1)');
        $this->datatables->edit_column('created_on', '$1', 'date("d-m-Y H:i:s",created_on)');
        $this->datatables->edit_column('last_login', '$1', 'date("d-m-Y H:i:s",last_login)');
        return $this->datatables->generate();
    }

    function add() {
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
        if ($this->input->post('password', true)) {
            $password = $this->Ion_auth_model->hash_password(trim($this->input->post('password')), FALSE);
        }
        $array1 = array(
            'code_member' => trim($this->input->post('code_member')),
            'first_name' => trim($this->input->post('first_name')),
            'last_name' => trim($this->input->post('last_name')),
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
            'ip_address' => $this->input->ip_address(),
            'created_on' => time(),
            'biz_type' => ($this->input->post('biz_type', TRUE) ? $this->input->post('biz_type') : NULL),
            'dealer_status' => ($this->input->post('dealer_status', TRUE) ? 1 : 0),
            'group_price' => ($this->input->post('group_price', TRUE) ? $this->input->post('group_price') : NULL),
            'active' => ($this->input->post('active', TRUE) ? 1 : 0)
        );
        $array2 = (isset($file_1) ? array('file1' => $file_1) : array());
        $array3 = (isset($file_2) ? array('file2' => $file_2) : array());
        $array4 = (isset($file_3) ? array('file3' => $file_3) : array());
        $array5 = (isset($file_4) ? array('file4' => $file_4) : array());
        $array6 = (isset($file_5) ? array('file5' => $file_5) : array());
        $array7 = (isset($password) ? array('password' => $password) : array());

        if (!$this->input->post('copy_address', true)) {
            $array8 = array(
                'tax_company' => trim($this->input->post('tax_company')),
                'tax_address' => trim($this->input->post('tax_address')),
                'tax_province' => $this->input->post('tax_province_id'),
                'tax_amphur' => $this->input->post('tax_amphur_id'),
                'tax_district' => $this->input->post('tax_district_id'),
                'tax_zipcode' => $this->input->post('tax_zipcode')
            );
        } else {
            $array8 = array(
                'tax_company' => trim($this->input->post('company')),
                'tax_address' => trim($this->input->post('address')),
                'tax_province' => $this->input->post('province_id'),
                'tax_amphur' => $this->input->post('amphur_id'),
                'tax_district' => $this->input->post('district_id'),
                'tax_zipcode' => $this->input->post('zipcode')
            );
        }

        $result = array_merge($array1, $array2, $array3, $array4, $array5, $array6, $array7, $array8);
        $this->db->insert('users', $result);
        $user_id = $this->db->insert_id();
        $this->db->insert('users_groups', array('user_id' => $user_id, 'group_id' => $this->input->post('group_id')));
        $this->db->insert('users_branch', array('user_id' => $user_id, 'user_parent' => $this->ion_auth->get_user_id()));
        $rdata = array(
            'status' => TRUE,
            'redirect' => 'users/backend/user',
            'message' => 'บันทึกข้อมูลเสร็จเรียบร้อย'
        );

        return $rdata;
    }

    public function edit() {
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
        if ($this->input->post('password', true)) {
            $password = $this->Ion_auth_model->hash_password(trim($this->input->post('password')), FALSE);
        }
        $array1 = array(
            'code_member' => trim($this->input->post('code_member')),
            'first_name' => trim($this->input->post('first_name')),
            'last_name' => trim($this->input->post('last_name')),
            'id_card' => trim($this->input->post('id_card')),
            'phone' => trim($this->input->post('phone')),
            'company' => trim($this->input->post('company')),
            'tax_number' => trim($this->input->post('tax_number')),
            'address' => trim($this->input->post('address')),
            'province' => trim($this->input->post('province_id')),
            'amphur' => $this->input->post('amphur_id'),
            'district' => $this->input->post('district_id'),
            'zipcode' => $this->input->post('zipcode'),
            'tax_company' => trim($this->input->post('tax_company')),
            'tax_address' => trim($this->input->post('tax_address')),
            'tax_province' => $this->input->post('tax_province'),
            'tax_amphur' => $this->input->post('tax_amphur'),
            'tax_district' => $this->input->post('tax_district'),
            'tax_zipcode' => $this->input->post('tax_zipcode'),
            'tax_number' => trim($this->input->post('tax_number')),
            'ip_address' => $this->input->ip_address(),
            'updated_on' => time(),
            'biz_type' => ($this->input->post('biz_type', TRUE) ? $this->input->post('biz_type') : NULL),
            'group_price' => ($this->input->post('group_price', TRUE) ? $this->input->post('group_price') : NULL)
        );
        $array2 = (isset($file_1) ? array('file1' => $file_1) : array());
        $array3 = (isset($file_2) ? array('file2' => $file_2) : array());
        $array4 = (isset($file_3) ? array('file3' => $file_3) : array());
        $array5 = (isset($file_4) ? array('file4' => $file_4) : array());
        $array6 = (isset($file_5) ? array('file5' => $file_5) : array());
        $array7 = (isset($password) ? array('password' => $password) : array());

        $result = array_merge($array1, $array2, $array3, $array4, $array5, $array6, $array7);
        $this->db->update('users', $result, array('id' => $this->input->post('user_id')));
        $rdata = array(
            'status' => TRUE,
            'redirect' => 'settings/backend/users',
            'message' => 'Save data success.'
        );

        return $rdata;
    }

    public function add_address() {
        $data = array(
            'user_id' => $this->ion_auth->get_user_id(),
            'receive_name' => trim($this->input->post('receive_name')),
            'address' => trim($this->input->post('address')),
            'province' => trim($this->input->post('province_id')),
            'amphur' => $this->input->post('amphur_id'),
            'district' => $this->input->post('district_id'),
            'zipcode' => $this->input->post('zipcode'),
            'created_at' => date('Y-m-d h:i:s'),
        );
        $this->db->insert('user_shipping_address', $data);
        $rdata = array(
            'status' => TRUE,
            'redirect' => $this->input->post('redirect'),
            'message' => 'Save data success.'
        );

        return $rdata;
    }

}
