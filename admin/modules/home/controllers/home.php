<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 *  @Auther : Adisorn Lamsombuth
 *  @Email : postyim@gmail.com
 *  @Website : esabay.com 
 */

/**
 * Description of home
 *
 * @author R-D-6
 */
class Home extends MX_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {

        $data = array(
            'title' => seo_web('site_name'),
        );
        $this->template->load('frontend/master_index', 'home/frontend/guest/index', $data);
    }

    public function homepage() {
        $this->load->helper('products/useful');
        $this->load->model('products/Products_model');
        $this->load->model('contents/Promotion_model');
        $data = array(
            'result_product_list_new' => $this->Products_model->get_product_new_normal(),
            'result_product_list_promotion' => $this->Products_model->get_product_promotion_normal(),
            'result_product_list_sale' => $this->Products_model->get_product_sale_normal(),
            'search_category' => $this->Category_model->get_stk_category(),
            'banner_slide' => $this->Contents_model->get_content_slide(),
            'promotion_slide' => $this->Promotion_model->get_promotion(1),
            'promotion_grid' => $this->Promotion_model->get_promotion(3, 9),
            'promotion_right' => $this->Promotion_model->get_promotion(2, 1)
        );
        $this->load->view('home/frontend/guest/index', $data);
    }

}
