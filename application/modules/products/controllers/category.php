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
class Category extends MX_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function get_sub() {
        $this->load->model('products/Category_model');
        $cat = $this->Category_model->get_sub($this->uri->segment(4));
        echo json_encode($cat);
    }

}
