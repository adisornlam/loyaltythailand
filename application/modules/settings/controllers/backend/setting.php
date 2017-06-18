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
class Setting extends MX_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->ion_auth->logged_in()) {
            redirect('backend/login', 'refresh');
        }
        $this->load->model('settings/Setting_model');
    }

    public function index() {
        $data = array(
            'title' => 'ตั้งค่าทั่วไป',
            'item' => $this->Setting_model->get_view(1)
        );

        $this->template->load('backend/master', 'settings/backend/setting/index', $data);
    }

}
