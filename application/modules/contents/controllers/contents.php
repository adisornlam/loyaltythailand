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
class Contents extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('contents/Contents_model');
        $this->load->model('products/Category_owner_model');
    }

    public function index() {
        $data = array(
            'title' => 'ข่าวสารและบทความ',
        );
        $this->template->load('frontend/master_sidebar_right', 'contents/frontend/contents/content_index', $data);
    }

    public function view($id = 0) {
        $rs = $this->Contents_model->get_view($id);
        if ($rs) {
            $data = array(
                'title' => $rs->title,
                'item' => $rs
            );
        } else {
            $data = array(
                'title' => NULL,
                'item' => NULL
            );
        }
        $this->template->load('frontend/master_inner', 'contents/frontend/contents/content_view', $data);
    }

}
