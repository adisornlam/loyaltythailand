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
        if ($this->ion_auth->in_group('dealer')) {
            echo $this->Orders_dealer_model->get_listall();
        } else {
            echo $this->Orders_dealer_model->get_listall();
        }
    }

    public function transfer_add() {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('name', 'ชื่อผู้แจ้ง', 'required');
        $this->form_validation->set_rules('total', 'จำนวนเงิน', 'required');
        $this->form_validation->set_rules('fdate', 'วันที่', 'required');
        $this->form_validation->set_rules('ftime', 'เวลา', 'required');
        $this->form_validation->set_rules('from_bank', 'ธนาคารที่โอน', 'required');
        $this->form_validation->set_rules('to_bank', 'โอนเข้าธนาคาร', 'required');
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
        if ($this->form_validation->run() == FALSE) {
            $data = array(
                'error' => array(
                    'status' => FALSE,
                    'message' => validation_errors(),
                ), 400);
            echo json_encode($data);
        } else {
            $rs = $this->Orders_model->transfer_add();
            $data = array(
                'error' => array(
                    'status' => $rs['status'],
                    'redirect' => $rs['redirect'],
                    'message' => $rs['message']
            ));
            echo json_encode($data);
        }
    }

    public function change_status() {
        $rs = $this->Orders_seller_model->change_status();
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
