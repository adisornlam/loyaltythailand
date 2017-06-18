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
        if (!$this->ion_auth->logged_in()) {
            redirect('backend/login', 'refresh');
        }
    }

    public function get_sub() {
        $this->load->model('products/Category_model');
        $cat = $this->Category_model->get_sub($this->uri->segment(5));
        echo json_encode($cat);
    }

    public function index() {
        if ($this->ion_auth->is_admin()) {
            $data = array(
                'title' => 'Category : E-Office System Management 2014'
            );
            $this->template->load('backend/master', 'products/backend/category/admin/category_index', $data);
        } elseif ($this->ion_auth->in_group('owner')) {
            $data = array(
                'title' => 'หมวดหมู่'
            );
            $this->template->load('backend/master', 'products/backend/category/owner/category_index', $data);
        }
    }

    public function sub() {
        if ($this->ion_auth->is_admin()) {
            $data = array(
                'title' => 'Sub Category : E-Office System Management 2014',
                'breadcrumbs' => array(
                    'Category Overview' => 'products/backend/category',
                    'Category Sub' => '#'
                )
            );
            $this->template->load('backend/master', 'products/backend/category/admin/category_sub', $data);
        } elseif ($this->ion_auth->in_group('owner')) {
            $this->load->model('products/Category_owner_model');
            $rs = $this->Category_owner_model->get_view($this->uri->segment(5));
            $data = array(
                'title' => 'รายการหมวดหมู่',
                'breadcrumbs' => array(
                    'หมวดหมู่' => 'products/backend/category',
                    $rs->title => '#'
                )
            );
            $this->template->load('backend/master', 'products/backend/category/owner/category_sub', $data);
        }
    }

    public function add() {
        $this->load->view('products/backend/category/owner/category_add');
    }

    public function edit() {
        $this->load->model('products/Category_owner_model');
        $rs = $this->Category_owner_model->get_view($this->uri->segment(6));
        $data = array(
            'item' => $rs
        );
        $this->load->view('products/backend/category/owner/category_edit', $data);
    }

    public function move() {
        $this->load->model('products/Category_model', 'category');
        $rs = $this->category->get_category();
        $data = array(
            'result' => $rs
        );
        $this->load->view('products/backend/category/admin/category_move', $data);
    }

    public function get_spec_html() {
        $this->db->select('*');
        $this->db->from('stk_prod_spec');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $row = $query->result_array();
            for ($i = 0; $i <= 20; $i++) {
                $code = str_pad($i, 2, "0", STR_PAD_LEFT);
                $label = $row['prod_spec_' . $code . '_label'];
                echo "<tr>";
                echo "<td>" . $label . "</td>";
                echo "<td>&nbsp;</td>";
                echo "</tr>";
            }
        }
    }

}
