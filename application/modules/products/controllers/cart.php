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
class Cart extends MX_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->load->helper('products/useful');
        $data = array(
            'title' => 'Shopping Cart : E-Office System Management 2014',
            'link_wizad' => array(
                'step2' => ($this->cart->total_items() ? base_url() . index_page() . 'products/cart' : 'javascript:;'),
                'step3' => ($this->cart->total_items() ? base_url() . index_page() . 'products/cart/shipping' : 'javascript:;'),
                'step4' => ($this->input->cookie('shipping_id', TRUE) ? base_url() . index_page() . 'products/cart/payment' : 'javascript:;'),
                'step5' => ($this->input->cookie('payment_id', TRUE) ? base_url() . index_page() . 'products/cart/confirm' : 'javascript:;')
            )
        );
        if (!$this->input->is_ajax_request())
            $this->template->load('frontend/master_no_sidebar', 'products/frontend/product/shared/product_cart', $data);
        else
            $this->load->view('products/frontend/product/shared/product_cart', $data);
    }

    public function cart_dialog() {
        $this->load->helper('products/useful');
        $this->load->view('products/frontend/product/shared/cart_dialog');
    }

    public function shipping() {
        if (!$this->ion_auth->logged_in()) {
            redirect('authentication/auth/login', 'refresh');
        }
        $this->load->model('users/Users_model');
        $this->load->model('users/Users_dealer_model');
        $this->load->model('settings/Shipping_model');
        $this->load->model('products/Cart_model');
        $parent_id = $this->Users_model->get_user_parent($this->ion_auth->get_user_id());
        $data = array(
            'title' => 'Shipping : E-Office System Management 2014',
            'address' => $this->Users_model->get_address_full($this->ion_auth->get_user_id()),
            'shipping_type' => $this->Shipping_model->get_shipping($parent_id),
            'tax' => $this->Users_model->get_tax_address($this->ion_auth->get_user_id()),
            'link_wizad' => array(
                'step2' => ($this->cart->total_items() ? base_url() . index_page() . 'products/cart' : 'javascript:;'),
                'step3' => ($this->cart->total_items() ? base_url() . index_page() . 'products/cart/shipping' : 'javascript:;'),
                'step4' => ($this->cart->total_items() ? base_url() . index_page() . 'products/cart/payment' : 'javascript:;'),
                'step5' => ($this->input->cookie('payment_id', TRUE) ? base_url() . index_page() . 'products/cart/confirm' : 'javascript:;')
            )
        );
        if (!$this->input->is_ajax_request())
            $this->template->load('frontend/master_no_sidebar', 'products/frontend/product/shared/product_shipping', $data);
        else
            $this->load->view('products/frontend/product/shared/product_shipping', $data);
    }

    public function payment() {
        $this->load->model('products/Cart_model');
        $data = array(
            'title' => 'Payment : E-Office System Management 2014',
            'payment_type' => $this->Cart_model->get_payment_type(),
            'payment_item' => $this->Cart_model->get_payment_list(),
            'link_wizad' => array(
                'step2' => ($this->cart->total_items() ? base_url() . index_page() . 'products/cart' : 'javascript:;'),
                'step3' => ($this->cart->total_items() ? base_url() . index_page() . 'products/cart/shipping' : 'javascript:;'),
                'step4' => ($this->input->cookie('shipping_id', TRUE) ? base_url() . index_page() . 'products/cart/payment' : 'javascript:;'),
                'step5' => ($this->cart->total_items() ? base_url() . index_page() . 'products/cart/confirm' : 'javascript:;')
            )
        );
        if (!$this->input->is_ajax_request())
            $this->template->load('frontend/master_no_sidebar', 'products/frontend/product/shared/product_payment', $data);
        else
            $this->load->view('products/frontend/product/shared/product_payment', $data);
    }

    public function confirm() {
        $this->load->helper('products/useful');
        $this->load->model('users/Users_model');
        $this->load->model('users/Users_dealer_model');
        $this->load->model('users/Users_seller_model');
        $this->load->model('products/Cart_model');
        $this->load->model('products/Orders_model');
        $this->load->model('settings/Shipping_model');

        $id_u = ($this->input->cookie('address_id', true) ? $this->input->cookie('address_id') : 0);
        $chk_tax_2 = ($this->input->cookie('tax_2', true) ? $this->ion_auth->get_user_id() : 0);
        $data = array(
            'title' => 'Comfirm : E-Office System Management 2014',
            'address_1' => $this->Users_model->get_address_dealer($id_u, $this->ion_auth->get_user_id()),
            'address_tax' => $this->Users_model->get_tax_address($chk_tax_2),
            'link_wizad' => array(
                'step2' => ($this->cart->total_items() ? base_url() . index_page() . 'products/cart' : 'javascript:;'),
                'step3' => ($this->cart->total_items() ? base_url() . index_page() . 'products/cart/shipping' : 'javascript:;'),
                'step4' => ($this->cart->total_items() ? base_url() . index_page() . 'products/cart/payment' : 'javascript:;'),
                'step5' => ($this->input->cookie('payment_id', TRUE) ? base_url() . index_page() . 'products/cart/confirm' : 'javascript:;')
            ),
            'seller' => $this->Users_model->get_seller(),
            'payment_item' => $this->Cart_model->get_payment_item($this->input->cookie('payment_id')),
            'shipping_item' => $this->Shipping_model->get_shipping_item($this->input->cookie('shipping_id')),
            'credit_store' => $this->Orders_model->get_credit(array('total' => $this->cart->total()))
        );
        if (!$this->input->is_ajax_request())
            $this->template->load('frontend/master_no_sidebar', 'products/frontend/product/shared/product_confirm', $data);
        else
            $this->load->view('products/frontend/product/shared/product_confirm', $data);
    }

    public function get_shipping_type() {
        $this->load->model('products/Cart_model');
        $ship = $this->Cart_model->get_shipping_type();
        echo json_encode($ship);
    }

    public function get_nav_cart_list() {
        $this->load->view('products/shared/nav_cart_list');
    }

}
