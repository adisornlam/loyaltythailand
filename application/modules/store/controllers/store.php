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
class Store extends MX_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("store/store_model");
    }

    public function my($name) {
        $this->load->library('pagination');
        $this->load->library('paginationlib');


        $product_count = $this->store_model->count_product_list($name);
        $pagingConfig = $this->paginationlib->initPagination(index_page() . "store/my/" . $this->uri->segment(3), $product_count);
        $page = ($this->uri->segment($pagingConfig['uri_segment']) != "" ? $this->uri->segment($pagingConfig['uri_segment']) : 1);

        if ($name) {
            $data = array(
                'title_web' => TITLE,
                'title_page' => TITLE,
                'logo_text' => $this->store_model->get_logo_text($this->uri->segment(3)),
                'result_product' => $this->store_model->get_product_list($name, (($page - 1) * $pagingConfig['per_page']), $pagingConfig['per_page']),
                'pagination_helper' => $this->pagination
            );
            $this->template->load('master_store', 'store/store/index', $data);
        } else {
            $data = array(
                'title_page' => 'Not found store :' . TITLE
            );
            $this->template->load('master_store', 'store/notfound_store', $data);
        }
    }

    public function aboutus($name) {
        $data = array(
            'title_page' => 'เกี่ยวกับเรา',
            'logo_text' => $this->store_model->get_logo_text($this->uri->segment(3)),
            'long_desc' => $this->store_model->get_page_static($name, $this->uri->segment(2))
        );
        $this->template->load('master_store', 'store/store/aboutus', $data);
    }

    public function contactus($name) {
        $data = array(
            'title_page' => 'ติดต่อเรา',
            'logo_text' => $this->store_model->get_logo_text($this->uri->segment(3)),
            'long_desc' => $this->store_model->get_page_static($name, $this->uri->segment(2))
        );
        $this->template->load('master_store', 'store/store/contactus', $data);
    }

    public function cart($name) {
        $this->load->library('cart');
        $data = array(
            'title_web' => 'ตะกร้าสินค้า',
            'title_page' => 'ตะกร้าสินค้า',
            'logo_text' => $this->store_model->get_logo_text($this->uri->segment(3))
        );
        $this->template->load('master_store', 'store/store/cart', $data);
    }

    public function add_cart($name) {
        $this->load->library('cart');
        $this->load->model("products/Products_model");

        $item = $this->Products_model->get_item($this->uri->segment(4));

        $insert_data = array(
            'id' => $item->id,
            'name' => $item->title,
            'price' => $item->unit_price,
            'qty' => 1
        );

        $this->cart->insert($insert_data);
        redirect('store/cart/' . $name);
    }

    public function login() {
        $data = array(
            'title_web' => 'เข้าสู่ระบบ',
            'title_page' => 'เข้าสู่ระบบ',
            'logo_text' => $this->store_model->get_logo_text($this->uri->segment(3))
        );
        $this->template->load('master_store', 'store/login', $data);
    }

}
