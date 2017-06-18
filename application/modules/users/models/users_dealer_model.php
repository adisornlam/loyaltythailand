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
class Users_dealer_model extends CI_Model {

    function get_listall() {
        $this->load->library('datatables');
        $this->load->helper('users/useful');

        $this->datatables->select(
                'users.id as id, '
                . 'username, '
                . 'email, '
                . 'first_name, '
                . 'last_name, '
                . 'company, '
                . 'phone, '
                . 'created_on, '
                . 'last_login, '
                . 'active'
                . '');
        $this->datatables->from('users');
        $this->datatables->join('users_groups', 'users_groups.user_id=users.id', 'inner');
        $this->datatables->join('groups', 'groups.id=users_groups.group_id', 'inner');
        $this->datatables->join('users_branch', 'users_branch.user_id=users.id', 'inner');
        $this->datatables->where('groups.id', $this->input->post('group_id'));
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
        $this->datatables->edit_column('first_name', '$1 $2', 'first_name, last_name');
        $this->datatables->edit_column('active', '$1', 'check_disabled(active,1)');
        $this->datatables->edit_column('created_on', '$1', 'date("d-m-Y h:i:s",created_on)');
        $this->datatables->edit_column('last_login', '$1', 'date("d-m-Y h:i:s",last_login)');
        $this->datatables->unset_column('last_name');
        return $this->datatables->generate();
    }

    function add() {
        $this->load->helper('directory');

        $upload_config = array(
            'upload_path' => 'uploads/users/files/' . date('Ymd') . '/',
            'allowed_types' => 'doc|docx',
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
        $password = $this->Ion_auth_model->hash_password(trim($this->input->post('password')), FALSE);
        $data = array(
            'first_name' => trim($this->input->post('first_name')),
            'last_name' => trim($this->input->post('last_name')),
            'username' => trim($this->input->post('username')),
            'password' => $password,
            'email' => trim($this->input->post('email')),
            'id_card' => trim($this->input->post('id_card')),
            'company' => trim($this->input->post('company')),
            'address' => trim($this->input->post('address')),
            'province' => trim($this->input->post('province_id')),
            'amphur' => $this->input->post('amphur_id'),
            'district' => $this->input->post('district_id'),
            'zipcode' => $this->input->post('zipcode'),
            'tax_company' => trim($this->input->post('tax_company')),
            'tax_address' => trim($this->input->post('tax_address')),
            'tax_number' => trim($this->input->post('tax_number')),
            'ip_address' => $this->input->ip_address(),
            'created_on' => time(),
            'active' => ($this->input->post('active', TRUE) ? 1 : 0),
            'biz_type' => ($this->input->post('biz_type', TRUE) ? $this->input->post('biz_type') : NULL),
            'file1' => (isset($file_1) ? $file_1 : NULL),
            'file2' => (isset($file_2) ? $file_2 : NULL),
            'file3' => (isset($file_3) ? $file_3 : NULL),
            'file4' => (isset($file_4) ? $file_4 : NULL),
            'file5' => (isset($file_5) ? $file_5 : NULL)
        );
        $this->db->insert('users', $data);
        $user_id = $this->db->insert_id();
        $this->db->insert('users_groups', array('user_id' => $user_id, 'group_id' => $this->input->post('group_id')));
        $this->db->insert('users_branch', array('user_id' => $user_id, 'user_parent' => $this->ion_auth->get_user_id()));
        $rdata = array(
            'status' => TRUE,
            'redirect' => 'users/backend/user',
            'message' => 'Save data success.'
        );

        return $rdata;
    }

    function edit() {
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
            'biz_type' => ($this->input->post('biz_type', TRUE) ? $this->input->post('biz_type') : NULL)
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
            'redirect' => 'users/profile',
            'message' => 'Save data success.'
        );

        return $rdata;
    }

    public function user_upload($file, $path) {
        $upload_config = array(
            'upload_path' => 'uploads/' . $path,
            'allowed_types' => 'doc,docx,pdf',
            'encrypt_name' => TRUE
        );

        $this->load->library('upload', $upload_config);

        $dir_exist = true;
        if (!is_dir('uploads/' . $path)) {
            mkdir('./uploads/' . $path, 0777, true);
            $dir_exist = false;
        }

        if (!$this->upload->do_upload($file)) {
            $error = array('error' => $this->upload->display_errors());
            return $error;
        } else {

            $upload_data = $this->upload->data();
            return $upload_data;
        }
    }

    public function get_address_full($param) {
        $q_adds = $this->db->get_where('user_shipping_address', array('user_id' => $param));
        if ($q_adds->num_rows() <= 0) {
            $this->db->distinct();
            $this->db->select(''
                    . 'users.first_name,'
                    . 'users.last_name,'
                    . 'users.address,'
                    . 'new_district.district_name,'
                    . 'new_amphur.AMPHUR_NAME,'
                    . 'new_province.province_name,'
                    . 'users.zipcode'
                    . '');
            $this->db->from('users');
            $this->db->join('new_province', 'users.province = new_province.province_id');
            $this->db->join('new_amphur', 'users.amphur = new_amphur.amphur_id');
            $this->db->join('new_district', 'users.district = new_district.district_id');
            $this->db->where('users.id', $param);
            $query1 = $this->db->get();
            if ($query1->num_rows() > 0) {
                $row = $query1->first_row();
                $adds1[] = array(
                    'id' => 0,
                    'address' => $row->first_name . " " . $row->last_name . " " . $row->address . " <strong>ตำบล/แขวง</strong> " . $row->district_name . "     <strong>อำเภอ/เขต</strong> " . $row->AMPHUR_NAME . "    <strong>จังหวัด</strong> " . $row->province_name . "    <strong>รหัสไปรษณียร์</strong> " . $row->zipcode . ""
                );
            } else {
                $adds1 = array();
            }
        } else {
            $adds1 = array();
        }

        $this->db->select(''
                . 'user_shipping_address.id,'
                . 'user_shipping_address.receive_name,'
                . 'user_shipping_address.address,'
                . 'new_district.district_name,'
                . 'new_amphur.AMPHUR_NAME,'
                . 'new_province.province_name,'
                . 'user_shipping_address.zipcode'
                . '');
        $this->db->from('user_shipping_address');
        $this->db->join('new_province', 'user_shipping_address.province = new_province.province_id');
        $this->db->join('new_amphur', 'user_shipping_address.amphur = new_amphur.amphur_id');
        $this->db->join('new_district', 'user_shipping_address.district = new_district.district_id');
        $this->db->where('user_shipping_address.user_id', $param);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $adds[] = array(
                    'id' => $row->id,
                    'address' => $row->receive_name . " " . $row->address . " <strong>ตำบล/แขวง</strong> " . $row->district_name . "     <strong>อำเภอ/เขต</strong> " . $row->AMPHUR_NAME . "    <strong>จังหวัด</strong> " . $row->province_name . "    <strong>รหัสไปรษณียร์</strong> " . $row->zipcode . ""
                );
            }
        } else {
            $adds = array();
        }
        $result = array_merge($adds1, $adds);
        return $result;
    }

    public function get_greater_dealer($param) {
        $this->db->distinct();
        $this->db->select(''
                . 'new_amphur.amphur_status'
                . '');
        $this->db->from('user_shipping_address');
        $this->db->join('new_amphur', 'new_amphur.amphur_id = user_shipping_address.amphur');
        $this->db->where('user_shipping_address.id', $param);
        $query1 = $this->db->get();
        if ($query1->num_rows() > 0) {
            $row = $query1->first_row();
            $rs = $row->amphur_status;
        } else {
            $rs = 0;
        }
        return $rs;
    }

}
