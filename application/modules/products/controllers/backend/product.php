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
class Product extends MX_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->ion_auth->logged_in()) {
            redirect('backend/login', 'refresh');
        }
        $this->load->model('products/Products_model');
        $this->load->model('products/Products_owner_model');
        $this->load->model('products/Category_owner_model');
    }

    public function index() {
        if ($this->ion_auth->is_admin()) {
            $data = array(
                'title' => 'Product List : E-Office System Management 2014',
                'breadcrumbs' => array(
                    'Product Overview' => 'products/backend',
                    'Product List' => 'products/backend/product'
                ),
                'search_category' => $this->Category_model->get_stk_category()
            );
            $this->template->load('backend/master', 'products/backend/product/admin/product_index', $data);
        } elseif ($this->ion_auth->in_group('owner')) {
            $data = array(
                'title' => 'รายการสินค้า'
            );
            $this->template->load('backend/master', 'products/backend/product/owner/product_index', $data);
        } else {
            
        }
    }

    public function add() {

        $data = array(
            'title' => 'เพิ่มสินค้า',
            'breadcrumbs' => array(
                'รายการสินค้า' => 'products/backend/product',
                'เพิ่มสินค้า' => '#'
            ),
            'category' => $this->Category_owner_model->get_ddl()
        );
        $this->template->load('backend/master', 'products/backend/product/owner/product_add', $data);
    }

    public function edit() {
        $this->load->model('products/Category_model');
        $rs = $this->Products_owner_model->get_view($this->uri->segment(5));
        $data = array(
            'title' => 'เพิ่มสินค้า',
            'breadcrumbs' => array(
                'รายการสินค้า' => 'products/backend/product',
                'แก้ไขสินค้า' => '#'
            ),
            'item' => $rs,
            'category' => $this->Category_owner_model->get_ddl(FALSE),
            'cat_root_id' => $this->Category_model->get_sub_id($rs->cat_id)
        );
        $this->template->load('backend/master', 'products/backend/product/owner/product_edit', $data);
    }

    public function import() {
        $this->load->model('products/Category_owner_model');
        $data = array(
            'category' => $this->Category_owner_model->get_ddl()
        );
        $this->load->view('products/backend/product/owner/product_import', $data);
    }

    public function import_add() {
        $data = array(
            'title' => 'รายการสินค้านำเข้าไฟล์',
            'breadcrumbs' => array(
                'รายการสินค้า' => 'products/backend/product',
                'รายการสินค้านำเข้าไฟล์' => '#'
            )
        );
        $this->template->load('backend/master', 'products/backend/product/owner/product_import_add', $data);
    }

    public function spec() {
        $this->load->model('products/Category_model');
        $data = array(
            'item' => $this->Products_model->get_edit($this->uri->segment(5)),
            'prod_spec' => $this->Products_model->get_spec_html($this->uri->segment(5)),
            'product_gallery' => $this->Products_model->get_galler($this->uri->segment(5))
        );
        $this->load->view('products/backend/shared/product_spec_detail', $data);
    }

}
