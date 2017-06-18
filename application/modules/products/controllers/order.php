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
class Order extends MX_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->ion_auth->logged_in()) {
            redirect('backend/login', 'refresh');
        }
        $this->load->helper('products/useful');
        $this->load->model('products/Orders_model');
        $this->load->model('products/Orders_wholesale_model');
        $this->load->model('products/Orders_seller_model');
        $this->load->model('products/Orders_dealer_model');
    }

    public function test() {
        $data = array(
            'order_id' => 82,
            'price_total' => 4900,
            'transfer' => 4800
        );
        $store = $this->Orders_model->set_credit_store($data);
        //$store = $this->Orders_model->get_credit($data);
        var_dump($store);
    }

    public function index() {
        if ($this->ion_auth->in_group('dealer') and $this->Ion_auth_model->check_dealer($this->ion_auth->get_user_id())) {
            $data = array(
                'title' => 'Orders List : E-Office System Management 2014',
                'breadcrumbs' => array(
                    'Product Overview' => 'products/backend',
                    'Orders List' => 'products/backend/orders'
                ),
                'order_status' => $this->Orders_dealer_model->get_order_status()
            );
            $this->template->load('frontend/master_no_sidebar', 'products/frontend/orders/shared/orders_index', $data);
        } else {
            $data = array(
                'title' => 'Orders List : E-Office System Management 2014',
                'breadcrumbs' => array(
                    'Product Overview' => 'products/backend',
                    'Orders List' => 'products/backend/orders'
                ),
                'order_status' => $this->Orders_seller_model->get_order_status()
            );
            $this->template->load('frontend/master_no_sidebar', 'products/frontend/orders/shared/orders_index', $data);
        }
    }

    public function transfer_add() {
        $rs = $this->Orders_model->get_edit($this->uri->segment(4));
        $data = array(
            'item' => $rs,
            'credit_store' => $this->Orders_model->get_credit(array('total' => $rs->sum_price))
        );
        $this->load->view('products/frontend/orders/shared/payment_transfer', $data);
    }

    public function order_cancel() {
        $this->load->view('products/frontend/orders/shared/orders_cancel');
    }

    public function view() {
        $this->load->model('users/Users_model');
        $this->load->model('products/Cart_model');
        $this->load->helper('products/useful');
        $this->load->model('settings/Shipping_model');

        $rs = $this->Orders_model->get_view($this->uri->segment(4));
        $rs2 = $this->Orders_model->get_orders_product($this->uri->segment(4));
        $rs3 = $this->Orders_model->get_orders_log($this->uri->segment(4));
        $data = array(
            'title' => 'View Orders : E-Office System Management 2014',
            'breadcrumbs' => array(
                'Orders List' => 'products/order',
                'Orders View' => '#'
            ),
            'item' => $rs,
            'prod' => $rs2,
            'address_1' => $this->Users_model->get_address_dealer($rs->address_id, $rs->user_id),
            'tax_1' => ($rs->tax_1 == 1 ? 1 : 0),
            'tax_2' => $this->Users_model->get_tax_address($rs->tax_2),
            'order_status' => $this->Orders_model->get_orders_status_item($rs->status),
            'order_log' => $rs3,
            'payment_item' => $this->Cart_model->get_payment_item($rs->payment_id),
            'shipping_item' => $this->Shipping_model->get_shipping_item($rs->shipping_id),
            'credit_store' => $this->Orders_model->get_credit(array('total' => $rs->sum_price))
        );
        $this->template->load('frontend/master_no_sidebar', 'products/frontend/orders/shared/orders_view', $data);
    }

    public function prints() {
        $this->load->model('users/Users_model');
        $this->load->model('products/Cart_model');
        $this->load->helper('products/useful');
        $this->load->model('settings/Shipping_model');

        $rs = $this->Orders_model->get_view($this->uri->segment(4));
        $rs2 = $this->Orders_model->get_orders_product($this->uri->segment(4));
        $rs3 = $this->Orders_model->get_orders_log($this->uri->segment(4));
        $data = array(
            'title' => 'View Orders : E-Office System Management 2014',
            'item' => $rs,
            'prod' => $rs2,
            'address_1' => $this->Users_model->get_address_dealer($rs->address_id, $rs->user_id),
            'tax_1' => ($rs->tax_1 == 1 ? 1 : 0),
            'tax_2' => $this->Users_model->get_tax_address($rs->tax_2),
            'order_status' => $this->Orders_model->get_orders_status_item($rs->status, 1),
            'order_log' => $rs3,
            'payment_item' => $this->Cart_model->get_payment_item($rs->payment_id),
            'shipping_item' => $this->Shipping_model->get_shipping_item($rs->shipping_id),
            'info_1' => $this->Contents_model->get_edit(15)->long_desc,
            'info_2' => $this->Contents_model->get_edit(16)->long_desc
        );
        $this->load->view('products/frontend/orders/shared/orders_print', $data);
    }

    public function change_status() {
        $data = array(
            'order_status' => $this->Orders_seller_model->get_order_status()
        );
        $this->load->view('products/backend/orders/shared/orders_change_status', $data);
    }

}
