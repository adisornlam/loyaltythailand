<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 *  @Auther : Adisorn Lamsombuth
 *  @Email : postyim@gmail.com
 *  @Website : esabay.com 
 */

/**
 * Description of dashboard
 *
 * @author R-D-6
 */
class Result_cart extends MX_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->ion_auth->logged_in()) {
            redirect('backend/login', 'refresh');
        }
        $this->load->model('products/Cart_model');
    }

    public function index() {
        $data = array(
            'title' => 'Product List : E-Office System Management 2014',
            'breadcrumbs' => array(
                'Product Overview' => 'products/backend',
                'Product List' => 'products/backend/product'
            )
        );
        if ($this->ion_auth->is_admin()) {
            $this->template->load('backend/master', 'products/backend/product/admin/product_index', $data);
        } elseif ($this->ion_auth->in_group('wholesale')) {
            $this->template->load('backend/master', 'products/backend/product/wholesale/product_index', $data);
        } elseif ($this->ion_auth->in_group('dealer')) {
            $this->template->load('backend/master', 'products/backend/product/dealer/product_index', $data);
        } else {
            
        }
    }

    public function add() {
        if ($this->ion_auth->in_group('dealer')) {
            $this->Cart_model->add();
        } else {
            
        }
    }

    public function update() {
        if ($this->ion_auth->in_group('dealer')) {
            $this->Cart_model->update();
        } else {
            
        }
    }

    public function confirm() {
        $rs = $this->Cart_model->set_comfirm_order();
        $data = array(
            'error' => array(
                'status' => $rs['status'],
                'redirect' => $rs['redirect'],
                'message' => $rs['message']
        ));
        echo json_encode($data);
    }

}
