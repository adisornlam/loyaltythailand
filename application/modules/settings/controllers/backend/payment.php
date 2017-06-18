<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 *  @Auther : Adisorn Lamsombuth
 *  @Email : postyim@gmail.com
 *  @Website : esabay.com 
 */

/**
 * Description of category
 *
 * @author R-D-6
 */
class Payment extends MX_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->ion_auth->logged_in()) {
            redirect('backend/login', 'refresh');
        }
        $this->load->model('settings/Payment_model');
    }

    public function index() {
        $data = array(
            'title' => 'Payment : E-Office System Management 2014'
        );

        if ($this->ion_auth->in_group('wholesale')) {
            $this->template->load('backend/master', 'settings/backend/payment/wholesale/payment_index', $data);
        } elseif ($this->ion_auth->in_group('dealer')) {
            
        } else {
            
        }
    }

    public function add() {
        $data = array(
            'type' => $this->Payment_model->get_payment_type()
        );
        $this->load->view('settings/backend/payment/wholesale/payment_add', $data);
    }

    public function edit() {
        $rs = $this->Payment_model->get_edit($this->uri->segment(5));
        $data = array(
            'item' => $rs[0],
            'type' => $this->Payment_model->get_payment_type()
        );
        $this->load->view('settings/backend/payment/wholesale/payment_edit', $data);
    }

}
