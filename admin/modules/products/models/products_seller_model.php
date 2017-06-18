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
class Products_seller_model extends CI_Model {

    function get_listall() {
        $this->load->library('datatables');
        $this->load->helper('products/useful');
        $parent_id = $this->Ion_auth_model->get_group_id($this->ion_auth->get_user_id());
        $this->datatables->select(''
                . 'stk_product.product_id as prod_id, '
                . 'stk_product.product_code as product_code, '
                . 'cms_content.cnt_thumb_url as cnt_thumb_url, '
                . 'cms_content.cnt_title as cnt_title, '
                . 'stk_category.cat_name as cat_name, '
                . 'stk_product.stock_qty as stock_qty, '
                . 'stk_product.warranty as warranty, '
                . 'stk_product.price_1 as price_1, '
                . 'stk_product.price_5 as price_5, '
                . 'stk_product.prod_active as prod_active '
                . '');
        $this->datatables->from('stk_product');
        $this->datatables->join('cms_content', 'cms_content.cnt_id = stk_product.cnt_id', 'inner');
        $this->datatables->join('stk_category', 'stk_category.cat_id = stk_product.cat_id', 'inner');
        if ($this->input->post('txtSearch', TRUE)) {
            $array = array(
                'stk_product.product_code' => $this->input->post('txtSearch'),
                'cms_content.cnt_title' => $this->input->post('txtSearch'),
                'stk_category.cat_name' => $this->input->post('txtSearch')
            );
            $this->datatables->like($array, NULL, FALSE);
        }
        if ($this->input->post('myCat', TRUE)) {
            $this->datatables->where('stk_category.cat_id', $this->input->post('myCat'));
        }
        $this->datatables->unset_column('prod_id');
        $this->datatables->unset_column('cnt_thumb_url');
        $this->datatables->edit_column('cnt_title', '<img src="https://www.jib.co.th/jib_content/images/content/$1" width="75" /> <a href="javascript:;" rel="products/backend/product/spec/$3" class="link_dialog" title="Product Spec"> $2</a>', 'cnt_thumb_url, cnt_title,prod_id');
        $this->datatables->edit_column('prod_active', '$1', 'check_disabled(prod_active,Y)');
        $this->datatables->edit_column('price_1', '$1', 'number_format(price_1)');
        $this->datatables->edit_column('price_5', '$1', 'number_format(price_5)');
        return $this->datatables->generate();
    }

    public function get_edit($id) {
        $this->db->select(''
                . 'stk_product.product_id,'
                . 'stk_product.cat_id,'
                . 'stk_product.category_sub_1,'
                . 'stk_product.category_sub_2,'
                . 'stk_product.category_sub_3,'
                . 'stk_product.category_sub_4,'
                . 'stk_product.product_code,'
                . 'cms_content.cnt_title as product_name,'
                . 'stk_product.stock_qty as qty,'
                . 'stk_product.price_1,'
                . 'stk_product.price_5,'
                . 'stk_product.prod_active'
                . '');
        $this->db->from('stk_product');
        $this->db->join('cms_content', 'cms_content.cnt_id=stk_product.cnt_id');
        $this->db->where('stk_product.product_id', $id);
        $query = $this->db->get();

        return $query->result();
    }

}
