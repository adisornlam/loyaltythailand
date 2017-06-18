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
class Promotion extends MX_Controller {

    function __construct() {
        parent::__construct();
        if (!$this->ion_auth->logged_in()) {
            redirect('backend/login', 'refresh');
        }
        $this->load->model('contents/Promotion_model');
    }

    public function index() {
        $data = array(
            'title' => 'Promotion : E-Office System Management 2014',
            'search_category' => $this->Category_model->get_stk_category()
        );
        $this->template->load('backend/master', 'contents/backend/promotion/employee/promotion_index', $data);
    }

    public function add() {
        $data = array(
            'title' => 'Promotion Add : E-Office System Management 2014',
            'breadcrumbs' => array(
                'Promotion List' => 'contents/backend/promotion',
                'Add Promotion' => '#'
            )
        );
        $this->template->load('backend/master', 'contents/backend/promotion/employee/promotion_add', $data);
    }

    public function edit() {
        $rs = $this->Promotion_model->get_edit($this->uri->segment(5));
        $data = array(
            'title' => 'Content Edit : E-Office System Management 2014',
            'breadcrumbs' => array(
                'Promotion List' => 'contents/backend/promotion',
                'Edit Promotion' => '#'
            ),
            'item' => $rs
        );
        $this->template->load('backend/master', 'contents/backend/promotion/employee/promotion_edit', $data);
    }

    public function add_coupon() {
        $this->load->view('contents/backend/promotion/employee/add_coupon');
    }

}
