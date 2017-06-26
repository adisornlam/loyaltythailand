<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 *  @Auther : Adisorn Lamsombuth
 *  @Email : postyim@gmail.com
 *  @Website : esabay.com 
 */

/**
 * Description of products_model
 *
 * @author R-D-6
 */
class Products_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->helper("products/useful");
    }

    public function listall() {
        $this->load->library('datatables');
        $user_id = $this->ion_auth->user()->row()->id;
        $this->datatables->select(
                'product_item.id as id, '
                . 'product_item.code_no as code_no, '
                . 'product_item.title as product_title, '
                . 'product_item.unit_price as unit_price, '
                . 'product_item.disabled as disabled, '
                . '');
        $this->datatables->from('product_item');
        $this->datatables->join('users_products', 'users_products.product_id=product_item.id', 'inner');
        $this->datatables->join('product_categories', 'product_categories.product_id=product_item.id', 'inner');
        $this->datatables->join('categories', 'categories.id=product_categories.cat_id', 'inner');
        $this->datatables->where('users_products.user_id', $user_id);
        $this->datatables->where('product_item.deleted_at', NULL);
        if ($this->input->post('text_search', true)) {
            $this->datatables->like('product_item.title', $this->input->post('text_search'));
        }

        $link = "<div class=\"dropdown\">";
        $link .= "<a class=\"dropdown-toggle\" data-toggle=\"dropdown\" href=\"javascript:;\"><span class=\"fa fa-pencil-square-o\"></span ></a>";
        $link .= "<ul class=\"dropdown-menu\" role=\"menu\" aria-labelledby=\"dLabel\">";
        $link .= "<li><a href=\"" . site_url() . "products/edit/$1\" class=\"\" title=\"Edit Product\"><i class=\"fa fa-pencil-square-o\" aria-hidden=\"true\"></i> Edit Product</a></li>";
        $link .= "<li><a href=\"javascript:;\" rel=\"products/save/delete/$1\" class=\"link_dialog delete\" title=\"Delete Product\"><i class=\"fa fa-trash-o\" aria-hidden=\"true\"></i> Delete Product</a></li>";
        $link .= "</ul>";
        $link .= "</div>";

        $this->datatables->edit_column('id', $link, 'id');
        $this->datatables->edit_column('disabled', '$1', 'check_disabled(disabled,1)');
        return $this->datatables->generate();
    }

    public function add_save($param) {
        $user_id = $this->ion_auth->user()->row()->id;
        $data = array(
            'code_no' => trim($this->input->post('code_no')),
            'title' => trim($this->input->post('title')),
            'desc_short' => $this->input->post('desc_short'),
            'desc_long' => $this->input->post('desc_long'),
            'stock' => trim($this->input->post('stock')),
            'unit_price' => trim($this->input->post('unit_price')),
            'point' => trim($this->input->post('point')),
            'cover_img' => (isset($param['upload_data']['file_name']) ? $param['upload_data']['file_name'] : NULL),
            'cover_img_thumb' => (isset($param['upload_data']['file_name']) ? create_thumb($param['upload_data']['file_name']) : NULL),
            'cover_img_path' => 'uploads/products/' . date('Ymd') . '/',
            'description' => trim($this->input->post('description')),
            'keywords' => trim($this->input->post('keywords')),
            'disabled' => ($this->input->post('disabled', TRUE) ? 1 : 0),
            'created_at' => date("Y-m-d H:i:s")
        );

        $this->db->insert('product_item', $data);
        $insert_id = $this->db->insert_id();

        $this->db->insert('product_categories', array('product_id' => $insert_id, 'cat_id' => $this->input->post('cat_id')));
        $this->db->insert('users_products', array('product_id' => $insert_id, 'user_id' => $user_id));

        $rdata = array(
            'status' => TRUE,
            'redirect' => 'products',
            'message_info' => 'Save Successfully.'
        );

        return $rdata;
    }

    public function edit_save($param) {
        $user_id = $this->ion_auth->user()->row()->id;
        $data = array(
            'code_no' => trim($this->input->post('code_no')),
            'title' => trim($this->input->post('title')),
            'desc_short' => $this->input->post('desc_short'),
            'desc_long' => $this->input->post('desc_long'),
            'stock' => trim($this->input->post('stock')),
            'unit_price' => trim($this->input->post('unit_price')),
            'point' => trim($this->input->post('point')),
            'cover_img' => (isset($param['upload_data']['file_name']) ? $param['upload_data']['file_name'] : $this->input->post('cover_img_hidden')),
            'cover_img_thumb' => (isset($param['upload_data']['file_name']) ? create_thumb($param['upload_data']['file_name']) : $this->input->post('cover_img_hidden')),
            'cover_img_path' => 'uploads/products/' . date('Ymd') . '/',
            'description' => trim($this->input->post('description')),
            'keywords' => trim($this->input->post('keywords')),
            'disabled' => ($this->input->post('disabled', TRUE) ? 1 : 0),
            'updated_at' => date("Y-m-d H:i:s")
        );

        $id = $this->input->post("id");
        $this->db->update('product_item', $data, array("id" => $id));

        $this->db->update('product_categories', array('cat_id' => $this->input->post('cat_id')), array('product_id' => $id));

        $rdata = array(
            'status' => TRUE,
            'redirect' => 'products/edit/' . $id,
            'message_info' => 'Save Successfully.'
        );

        return $rdata;
    }

    function get_item($id) {
        $this->db->select("product_item.*, product_categories.cat_id, users_products.user_id");
        $this->db->from("product_item");
        $this->db->join("product_categories", "product_item.id = product_categories.product_id");
        $this->db->join("users_products", "product_item.id = users_products.product_id");
        $this->db->where("product_item.disabled", 1);
        $this->db->where("product_item.deleted_at", NULL);
        $this->db->where("product_item.id", $id);
        $query = $this->db->get();
        return $query->row();
    }

}
