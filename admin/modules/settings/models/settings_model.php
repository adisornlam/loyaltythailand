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

    public function get_item() {
        $user_id = $this->ion_auth->user()->row()->id;
        $query = $this->db->get_where('config_website', array('user_id' => $user_id));
        $row = $query->row();
        return $row;
    }

    function edit_save() {
        $data = array(
            'storename' => trim($this->input->post('storename')),
            'site_name' => trim($this->input->post('site_name')),
            'keywords' => trim($this->input->post('keywords')),
            'description' => trim($this->input->post('description'))
        );
        $this->db->update('config_website', $data, array('user_id' => $this->input->post('user_id')));
        $rdata = array(
            'status' => TRUE,
            'redirect' => 'settings',
            'message' => 'Save data success.'
        );
        return $rdata;
    }

}
