<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 *  @Auther : Adisorn Lamsombuth
 *  @Email : postyim@gmail.com
 *  @Website : esabay.com 
 */

/**
 * Description of Setting
 *
 * @author R-D-6
 */
class Settings extends MX_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->ion_auth->logged_in()) {
            redirect('login', 'refresh');
        }
        $this->load->model('settings/Settings_model');
    }

    public function index() {

        $data = array(
            'title' => 'Config : ' . TITLE,
            'title_page' => 'Config',
            'item' => $this->Settings_model->get_item()
        );
        if ($this->ion_auth->is_admin()) {
            $this->template->load('master', 'settings/setting/admin/index', $data);
        } elseif ($this->ion_auth->in_group('owner')) {
            $this->template->load('master', 'settings/setting/owner/index', $data);
        } elseif ($this->ion_auth->in_group('store')) {
            $this->template->load('master', 'settings/setting/store/general', $data);
        } else {
            $this->template->load('master', 'templates/not_permission', $data);
        }
    }

    public function save() {

        if ($this->uri->segment(3) == 'add') {
            $rs = $this->Settings_model->add_save();
        } else if ($this->uri->segment(3) == 'edit') {
            $rs = $this->Settings_model->edit_save();
        } else if ($this->uri->segment(3) == 'delete') {
            $rs = $this->Settings_model->delete_save();
        } else {
            $rs = array();
        }

        $data = array(
            'error' => array(
                'status' => $rs['status'],
                'redirect' => (isset($rs['redirect']) ? $rs['redirect'] : 0),
                'message' => (isset($rs['message']) ? $rs['message'] : 0),
                'message_info' => (isset($rs['message_info']) ? $rs['message_info'] : 0),
                'id' => (isset($rs['id']) ? $rs['id'] : 0),
            )
        );
        echo json_encode($data);
    }

}
