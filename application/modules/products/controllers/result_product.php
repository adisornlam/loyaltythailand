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
class Result_product extends MX_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('products/Products_model');
        $this->load->model('products/Products_owner_model');
    }

    public function check_stock() {
        $rs = $this->Products_model->check_stock();
        $data = array(
            'error' => array(
                'status' => $rs['status']
        ));
        echo json_encode($data);
    }

}
