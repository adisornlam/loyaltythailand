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
class Products extends MX_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('products/useful');
        $this->load->model('products/Products_model');
        $this->load->model('products/Products_owner_model');
        $this->load->model('products/Category_owner_model');
    }

    public function index() {
        $this->load->library('pagination');

        $result_per_page = 28;
        $per_page = ($this->input->get('page', TRUE) ? $this->input->get('page') : 0);
        $rs = $this->Products_owner_model->get_items(array('word' => NULL, 'limit' => $result_per_page, 'offset' => $per_page));
        //$config = $this->Common_model->get_pagination_style_bootstrap();
        $config['base_url'] = base_url() . index_page() . 'products?';
        $config['num_links'] = 3;
        $config['total_rows'] = $rs['num_rows'];
        $config['per_page'] = $result_per_page;
        $this->pagination->initialize($config);

        $data = array(
            'title' => 'รายการสินค้าทั้งหมด',
            'keywords' => seo_web('keywords'),
            'description' => seo_web('description'),
            'result' => $rs['result'],
            'category' => $this->Category_owner_model->get_list(),
            'cat_list' => $this->Category_owner_model->get_ddl(),
            'links' => $this->pagination->create_links(),
            'total' => $config['total_rows']
        );
        $this->template->load('frontend/master', 'products/frontend/product/owner/index', $data);
    }

    public function categories() {
        $this->load->library('pagination');

        $result_per_page = 28;
        $per_page = ($this->input->get('page', TRUE) ? $this->input->get('page') : 0);
        $rs = $this->Products_owner_model->get_items(array('word' => NULL, 'limit' => $result_per_page, 'offset' => $per_page));
        //$config = $this->Common_model->get_pagination_style_bootstrap();
        $config['base_url'] = base_url() . index_page() . 'products?';
        $config['num_links'] = 3;
        $config['total_rows'] = $rs['num_rows'];
        $config['per_page'] = $result_per_page;
        $this->pagination->initialize($config);

        $data = array(
            'title' => 'รายการสินค้าทั้งหมด',
            'keywords' => seo_web('keywords'),
            'description' => seo_web('description'),
            'result' => $rs['result'],
            'category' => $this->Category_owner_model->get_list(),
            'cat_list' => $this->Category_owner_model->get_ddl(),
            'links' => $this->pagination->create_links(),
            'total' => $config['total_rows']
        );
        $this->template->load('frontend/master', 'products/frontend/product/owner/index', $data);
    }

    public function search() {
        $this->load->model('products/Category_model');
        $this->load->library('pagination');

        $result_per_page = 28;
        $per_page = ($this->input->get('page', TRUE) ? $this->input->get('page') : 0);
        $rs = $this->Products_model->SearchEntries(array('words' => trim($this->input->get('txtSearch')), 'limit' => $result_per_page, 'offset' => $per_page));

        $config = $this->Common_model->get_pagination_style_bootstrap();
        $config['base_url'] = base_url() . index_page() . 'products/search?' . '&' . http_build_query($query_string, '', "&");
        $config['num_links'] = 3;
        $config['total_rows'] = $rs['num_rows'];
        $config['per_page'] = $result_per_page;
        $this->pagination->initialize($config);
        $data = array(
            'title' => 'Product List : INSIDE IT DISTRIBUTION',
            'menu_left' => $this->load->view('templates/frontend/sidebar', NULL, TRUE),
            'breadcrumbs' => $this->Category_model->get_breadcrumb_cat($this->input->get('category_id')),
            'result' => $rs['result'],
            'links' => $this->pagination->create_ajax_links(),
            'total' => $config['total_rows']
        );
        if ($this->input->cookie('view_type', TRUE) and $this->input->cookie('view_type') == 'list') {
            $this->load->view('products/frontend/product/shared/product_list', $data);
        } else {
            if (!$this->input->is_ajax_request()) {
                $this->template->load('frontend/master', 'products/frontend/product/shared/product_grid', $data);
            } else {
                $this->load->view('products/frontend/product/shared/product_grid', $data);
            }
        }
    }

    public function view() {
        $this->load->model('contents/Contents_model');
        $rs = $this->Products_owner_model->get_view($this->uri->segment(2));
        $data = array(
            'title' => $rs->title,
            'description' => $rs->description,
            'item' => $rs,
            'banner_botton' => $this->Contents_model->get_view_fixed(19)
        );
        $this->template->load('frontend/master', 'products/frontend/product/owner/view', $data);
    }

}
