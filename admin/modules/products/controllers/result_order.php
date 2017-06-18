<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 *  @Auther : Adisorn Lamsombuth
 *  @Email : postyim@gmail.com
 *  @Website : esabay.com 
 */

/**
 * Description of result_data
 *
 * @author R-D-6
 */
class Result_order extends MX_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->ion_auth->logged_in()) {
            redirect('backend/login', 'refresh');
        }
        $this->load->model('products/Orders_model');
        $this->load->model('products/Orders_dealer_model');
        $this->load->model('products/Orders_wholesale_model');
        $this->load->model('products/Orders_seller_model');
    }

    public function listall() {
        if ($this->ion_auth->is_admin()) {
            
        } elseif ($this->ion_auth->in_group('wholesale')) {
            echo $this->Orders_wholesale_model->get_listall();
        } elseif ($this->ion_auth->in_group('dealer')) {
            echo $this->Orders_dealer_model->get_listall();
        } elseif ($this->ion_auth->in_group('seller')) {
            echo $this->Orders_seller_model->get_listall();
        } else {
            
        }
    }

    public function change_status() {
        $rs = $this->Orders_model->change_status();
        $data = array(
            'error' => array(
                'status' => $rs['status'],
                'redirect' => $rs['redirect'],
                'message' => $rs['message']
        ));

        echo json_encode($data);
    }

    public function order_cancel() {
        $rs = $this->Orders_dealer_model->order_cancel();
        $data = array(
            'error' => array(
                'status' => $rs['status'],
                'redirect' => $rs['redirect'],
                'message' => $rs['message']
        ));

        echo json_encode($data);
    }

}
