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
class Article extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('contents/Article_model');
        $this->load->model('contents/Contents_model');
        $this->load->model('products/Category_owner_model');
    }

    public function index() {
        $data = array(
            'title' => 'ข่าวสารและบทความ',
            'result' => $this->Contents_model->get_home_list(10),
//            'result_left' => $this->Contents_model->get_home_list(5, TRUE),
//            'banner_botton' => $this->Contents_model->get_view_fixed(19),
        );
        $this->template->load('frontend/master_sidebar_right', 'contents/frontend/article/index', $data);
    }

    public function view() {
        $rs = $this->Article_model->get_view($this->uri->segment(2));
        $data = array(
            'title' => $rs->title,
            'item' => $rs
        );
        $this->template->load('frontend/master_sidebar_right', 'contents/frontend/article/view', $data);
    }

}
