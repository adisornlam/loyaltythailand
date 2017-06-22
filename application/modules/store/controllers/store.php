<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 *  @Auther : Adisorn Lamsombuth
 *  @Email : postyim@gmail.com
 *  @Website : esabay.com 
 */

/**
 * Description of home
 *
 * @author R-D-6
 */
class Store extends MX_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("store/store_model");
    }

    public function my($name) {
        $store = $this->store_model->getStore($name);
        if ($store) {
            $data = array(
                'web_title' => TITLE,
                'store_name' => $name
                );
            $this->template->load('master_store', 'store/member/index', $data);
        } else {
            $data = array(
                'web_title' => 'Not found store :' . TITLE
                );
            $this->template->load('master_store', 'store/notfound_store', $data);
        }
    }

    public function aboutus($name) {
        $data = array(
            'web_title' => 'เกี่ยวกับเรา',
            'long_desc' => $this->store_model->get_page_static($name, $this->uri->segment(2))
            );
        $this->template->load('master_store', 'store/aboutus', $data);
    }

    public function contactus($name) {
        $data = array(
            'web_title' => 'ติดต่อเรา',
            'long_desc' => $this->store_model->get_page_static($name, $this->uri->segment(2))
            );
        $this->template->load('master_store', 'store/contactus', $data);
    }

    public function cart($name) {
        $data = array(
            'web_title' => 'ตะกร้าสินค้า',
            'store_name' => $name
            );
        $this->template->load('master_store', 'store/cart', $data);
    }

    public function login() {
        $data = array(
            'title_web' => 'เข้าสู่ระบบ',
            'title_page' => 'เข้าสู่ระบบ',
            );
        $this->template->load('master_store', 'store/login', $data);
    }

}
