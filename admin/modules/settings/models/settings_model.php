<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 *  @Auther : Adisorn Lamsombuth
 *  @Email : postyim@gmail.com
 *  @Website : esabay.com 
 */

/**
 * Description of Setting_model
 *
 * @author R-D-6
 */
class Settings_model extends CI_Model {

    public function get_item($id) {
        $query = $this->db->get_where('system_config_website', array('id' => $id));
        $row = $query->row();
        return $row;
    }

    function edit() {
        $data = array(
            'site_name' => trim($this->input->post('site_name')),
            'keywords' => trim($this->input->post('keywords')),
            'description' => trim($this->input->post('description')),
            'useragent' => trim($this->input->post('useragent')),
            'host' => trim($this->input->post('host')),
            'port' => trim($this->input->post('port')),
            'from_email' => trim($this->input->post('from_email')),
            'receive_email' => trim($this->input->post('receive_email')),
            'username' => trim($this->input->post('username')),
            'password' => trim($this->input->post('password'))
        );
        $this->db->update('system_config_website', $data, array('id' => 1));
        $rdata = array(
            'status' => TRUE,
            'redirect' => 'settings',
            'message' => 'Save data success.'
        );
        return $rdata;
    }

}
