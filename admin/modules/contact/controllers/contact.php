<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 *  @Auther : Adisorn Lamsombuth
 *  @Email : postyim@gmail.com
 *  @Website : esabay.com 
 */

/**
 * Description of authentication
 *
 * @author R-D-6
 */
class Contact extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('contact/Contact_model');
        $this->load->model('products/Category_owner_model');
    }

    public function index() {
        $this->load->model('contents/Contents_model');
        $this->load->helper('captcha');
        $this->load->library('form_validation');
        $data = array(
            'title' => 'ติดต่อเรา'
           // 'contact_info' => $this->Contents_model->get_view_fixed(29),
        );
        $this->template->load('frontend/master_inner', 'contact/frontend/contact/contact_index', $data);
    }

}
