<?php

/*
 *  @Auther : Adisorn Lamsombuth
 *  @Email : postyim@gmail.com
 *  @Website : esabay.com 
 */

/**
 * Description of Template
 *
 * @author R-D-6
 */
class Template {

    var $ci;

    function __construct() {
        $this->ci = & get_instance();
    }

    function load($tpl_view, $body_view = null, $data = null) {
        $this->ci->load->database();

        if (!is_null($body_view)) {

            $body_view_path = $body_view;

            if (($this->ci->uri->segment(2) == 'my') and ( $this->ci->uri->segment(3) != '')) {
                $this->ci->db->select('config_website.site_name, config_website.description, config_website.keywords');
                $this->ci->db->from('users');
                $this->ci->db->join("config_website", "config_website.user_id=users.id");
                $this->ci->db->where('users.code_member', $this->ci->uri->segment(3));
                $this->ci->db->or_where('config_website.storename', $this->ci->uri->segment(3));
                $this->ci->db->where('users.active', 1);
                $this->ci->db->where('users.deleted_at', NULL);
                $query = $this->ci->db->get();
                $row = $query->row();
                $data_des = array('title_web' => (isset($data['title_web']) ? $data['title_page'] . ' : ' . $row->site_name : $row->site_name), 'description' => $row->description, 'keywords' => $row->keywords);
            } else {
                $query = $this->ci->db->get_where('config_website', array('user_id' => 1));
                $row = $query->row();
                $data_des = array('title_web' => (isset($data['title_web']) ? $data['title_page'] . ' : ' . $row->site_name : $row->site_name), 'description' => $row->description, 'keywords' => $row->keywords);
            }
            $data = array_merge($data, $data_des);
            $body = $this->ci->load->view($body_view_path, $data, TRUE);

            if (is_null($data)) {
                $data = array('body' => $body);
            } else if (is_array($data)) {
                $data['body'] = $body;
            } else if (is_object($data)) {
                $data->body = $body;
            }
        }

        $this->ci->load->view('templates/' . $tpl_view, $data);
    }

}
