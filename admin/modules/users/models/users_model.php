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

    public function get_edit($id) {
        $query = $this->db->get_where('users', array('id' => $id));
        $row = $query->first_row();
        return $row;
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

        if (!$this->input->post('copy_address', true)) {
            $array8 = array(
                'tax_company' => trim($this->input->post('tax_company')),
                'tax_address' => trim($this->input->post('tax_address')),
                'tax_province' => $this->input->post('tax_province_id'),
                'tax_amphur' => $this->input->post('tax_amphur_id'),
                'tax_district' => $this->input->post('tax_district_id'),
                'tax_zipcode' => $this->input->post('tax_zipcode'),
                );
        } else {
            $array8 = array(
                'tax_company' => trim($this->input->post('company')),
                'tax_address' => trim($this->input->post('address')),
                'tax_province' => $this->input->post('province_id'),
                'tax_amphur' => $this->input->post('amphur_id'),
                'tax_district' => $this->input->post('district_id'),
                'tax_zipcode' => $this->input->post('zipcode'),
                );
        }

        $result = array_merge($array1, $array2, $array3, $array4, $array5, $array6, $array7, $array8);
        $this->db->update('users', $result, array('id' => $this->input->post('user_id')));
        $rdata = array(
            'status' => TRUE,
            'redirect' => $this->input->post('redirect'),
            'message' => 'Save data success.'
            );

        return $rdata;
    }

    public function delete() {
        $this->db->update('users', array('deleted_at' => 1), array('id' => $this->uri->segment(5)));
        $rdata = array(
            'status' => TRUE,
            'redirect' => 'users/backend/user',
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
        $this->db->insert('users_shipping_address', $data);
        $rdata = array(
            'status' => TRUE,
            'redirect' => $this->input->post('redirect'),
            'message' => 'Save data success.'
            );

        return $rdata;
    }

    public function get_address_full($param) {

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
                'address' => $row->address . " <strong>ตำบล/แขวง</strong> " . $row->district_name . "     <strong>อำเภอ/เขต</strong> " . $row->AMPHUR_NAME . "    <strong>จังหวัด</strong> " . $row->province_name . "    <strong>รหัสไปรษณียร์</strong> " . $row->zipcode . ""
                );
        } else {
            $adds1 = array();
        }


        $this->db->select(''
            . 'users_shipping_address.id,'
            . 'users_shipping_address.receive_name,'
            . 'users_shipping_address.address,'
            . 'new_district.district_name,'
            . 'new_amphur.AMPHUR_NAME,'
            . 'new_province.province_name,'
            . 'users_shipping_address.zipcode'
            . '');
        $this->db->from('users_shipping_address');
        $this->db->join('new_province', 'users_shipping_address.province = new_province.province_id');
        $this->db->join('new_amphur', 'users_shipping_address.amphur = new_amphur.amphur_id');
        $this->db->join('new_district', 'users_shipping_address.district = new_district.district_id');
        $this->db->where('users_shipping_address.user_id', $param);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $adds[] = array(
                    'id' => $row->id,
                    'address' => $row->address . " <strong>ตำบล/แขวง</strong> " . $row->district_name . "     <strong>อำเภอ/เขต</strong> " . $row->AMPHUR_NAME . "    <strong>จังหวัด</strong> " . $row->province_name . "    <strong>รหัสไปรษณียร์</strong> " . $row->zipcode . ""
                    );
            }
        } else {
            $adds = array();
        }
        $result = array_merge($adds1, $adds);
        return $result;
    }

    public function get_tax_address($param) {
        $this->db->distinct();
        $this->db->select(''
            . 'users.tax_company,'
            . 'users.tax_number,'
            . 'users.tax_address,'
            . 'new_district.district_name,'
            . 'new_amphur.AMPHUR_NAME,'
            . 'new_province.province_name,'
            . 'users.zipcode'
            . '');
        $this->db->from('users');
        $this->db->join('new_province', 'users.tax_province = new_province.province_id');
        $this->db->join('new_amphur', 'users.tax_amphur = new_amphur.amphur_id');
        $this->db->join('new_district', 'users.tax_district = new_district.district_id');
        $this->db->where('users.id', $param);
        $query1 = $this->db->get();
        if ($query1->num_rows() > 0) {
            $row = $query1->first_row();
            $adds[] = $row->tax_company . " เลขที่ใบกำกับภาษี : " . $row->tax_number . " <br />ที่อยู่ : " . $row->tax_address . " <strong>ตำบล/แขวง</strong> " . $row->district_name . "     <strong>อำเภอ/เขต</strong> " . $row->AMPHUR_NAME . "    <strong>จังหวัด</strong> " . $row->province_name . "    <strong>รหัสไปรษณียร์</strong> " . $row->zipcode . "";
        } else {
            $adds = array();
        }

        return $adds;
    }

    public function get_address_dealer($param = 0, $id) {
        $param = (int) $param;
        if ($param <= 0) {
            $this->db->distinct();
            $this->db->select(''
                . 'users.first_name,'
                . 'users.last_name,'
                . 'users.address as user_address,'
                . 'new_district.district_name,'
                . 'new_amphur.AMPHUR_NAME,'
                . 'new_province.province_name,'
                . 'users.zipcode'
                . '');
            $this->db->from('users');
            $this->db->join('new_province', 'users.province = new_province.province_id');
            $this->db->join('new_amphur', 'users.amphur = new_amphur.amphur_id');
            $this->db->join('new_district', 'users.district = new_district.district_id');
            $this->db->where('users.id', $id);
        } else {
            $this->db->select(''
                . 'users_shipping_address.id,'
                . 'users_shipping_address.receive_name,'
                . 'users_shipping_address.address,'
                . 'new_district.district_name,'
                . 'new_amphur.AMPHUR_NAME,'
                . 'new_province.province_name,'
                . 'users_shipping_address.zipcode'
                . '');
            $this->db->from('users_shipping_address');
            $this->db->join('new_province', 'users_shipping_address.province = new_province.province_id');
            $this->db->join('new_amphur', 'users_shipping_address.amphur = new_amphur.amphur_id');
            $this->db->join('new_district', 'users_shipping_address.district = new_district.district_id');
            $this->db->where('users_shipping_address.id', $param);
        }
        $query1 = $this->db->get();
        if ($query1->num_rows() > 0) {
            $row = $query1->first_row();
            if ($param <= 0) {
                $adds1 = $row->user_address . " <strong>ตำบล/แขวง</strong> " . $row->district_name . "     <strong>อำเภอ/เขต</strong> " . $row->AMPHUR_NAME . "    <strong>จังหวัด</strong> " . $row->province_name . "    <strong>รหัสไปรษณียร์</strong> " . $row->zipcode . "";
            } else {
                $adds1 = $row->address . " <strong>ตำบล/แขวง</strong> " . $row->district_name . "     <strong>อำเภอ/เขต</strong> " . $row->AMPHUR_NAME . "    <strong>จังหวัด</strong> " . $row->province_name . "    <strong>รหัสไปรษณียร์</strong> " . $row->zipcode . "";
            }
        } else {
            $adds1 = $param;
        }
        return $adds1;
    }

    public function get_user_parent($param) {
        $query = $this->db->get_where('users_branch', array('user_id' => $param));
        if ($query->num_rows() > 0) {
            $row = $query->first_row();
            $rs = $row->user_parent;
        } else {
            $rs = 0;
        }
        return $rs;
    }

    public function get_seller() {
        $parent_id = $this->Ion_auth_model->get_group_id($this->ion_auth->get_user_id());
        $this->db->select('users.id, users.first_name, users.last_name, users.nick_name');
        $this->db->from('users');
        $this->db->join('users_groups', 'users_groups.user_id=users.id', 'inner');
        $this->db->join('groups', 'groups.id=users_groups.group_id', 'inner');
        $this->db->where('users_groups.user_parent', $parent_id);
        $this->db->where_in('groups.name', array('seller'));
        $query = $this->db->get();

        return $query->result();
    }

    public function update_dealer_status() {
        $id = (int) $this->input->get('user_id');
        $this->db->update('users', array('dealer_status' => $this->input->get('status')), array('id' => $id));
        return true;
    }

    public function update_active() {
        $id = (int) $this->input->get('user_id');
        $this->db->update('users', array('active' => $this->input->get('status')), array('id' => $id));
        return true;
    }

    function delete_user_all($id){
       // $tables = array('table1', 'table2', 'table3');
       // $this->db->where('id', $id);
       // $this->db->delete($tables);
    }

    function update_code($id){
        $this->db->select('us.id, us.code_member');
        $this->db->from('users us');
        $this->db->join('users_branchs usb','usb.user_id = us.id');
        $this->db->where('usb.branch_id',$id);
        $this->db->order_by('us.id','asc');
        $query = $this->db->get();
        $i=1;
        $query_b = $this->db->get_where('branch_item',array('id'=>$id));
        $row_b = $query_b->row();
        foreach ($query->result() as $value) {
            $c = 'KDC'.$row_b->code_no.str_pad($i, 6, "0", STR_PAD_LEFT);

            $sql = "UPDATE users SET code_member = '".$c."', username= '".$c."' WHERE id=".$value->id.";";
            $this->db->query($sql);
            echo $sql."<br />";
            $i++;
        }
    }

}
