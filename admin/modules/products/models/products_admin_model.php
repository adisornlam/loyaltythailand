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
class Products_admin_model extends CI_Model {

    function get_listall() {
        $this->load->library('datatables');
        $this->load->helper('products/useful');
        $cat = $this->input->post('columns');

        $this->datatables->select(''
                . 'product_id, '
                . 'product_id as prod_id, '
                . 'product_code, '
                . 'cnt_title, '
                . 'cat_name, '
                . 'stock_qty, '
                . 'price_1, '
                . 'price_5, '
                . 'prod_active'
                . '');
        $this->datatables->from('stk_product');
        $this->datatables->join('cms_content', 'cms_content.cnt_id = stk_product.cnt_id', 'inner');
        $this->datatables->join('stk_category', 'stk_category.cat_id = stk_product.cat_id', 'inner');
        if ($cat[3]['search']['value']) {
            $this->datatables->where('stk_product.cat_id', $cat[3]['search']['value']);
        }
        $this->datatables->unset_column('prod_id');
        $this->datatables->edit_column('price_1', '$1', 'number_format(price_1)');
        $this->datatables->edit_column('price_5', '$1', 'number_format(price_5)');
        $link = "<div class=\"dropdown\">";
        $link .= "<a class=\"dropdown-toggle\" data-toggle=\"dropdown\" href=\"javascript:;\"><span class=\"fa fa-pencil-square-o\"></span ></a>";
        $link .= "<ul class=\"dropdown-menu\" role=\"menu\" aria-labelledby=\"dLabel\">";
        $link .= "<li><a href=\"" . base_url() . index_page() . "products/backend/product/edit/$1\">Edit Details</a></li>";
        $link .= "<li><a href=\"javascript:;\" id=\"btnDelete\">Delete Product</a></li>";
        $link .= "</ul>";
        $link .= "</div>";
        $this->datatables->edit_column('cnt_title', '$1 <a href="javascript:;" rel="products/backend/product/spec/$2" class="link_dialog" title="Product Spec"><i class="fa fa-picture-o"></i></a>', 'cnt_title,prod_id');
        $this->datatables->add_column('product_id', $link, 'product_id');
        $this->datatables->edit_column('prod_active', '$1', 'check_disabled(prod_active,Y)');
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

    public function edit() {
        $cat_id = $this->input->post('category_id');
        $data = array(
            'category_sub_1' => (isset($cat_id[0]) ? $cat_id[0] : NULL),
            'category_sub_2' => (isset($cat_id[1]) ? $cat_id[1] : NULL),
            'category_sub_3' => (isset($cat_id[2]) ? $cat_id[2] : NULL),
            'category_sub_4' => (isset($cat_id[3]) ? $cat_id[3] : NULL)
        );

        $this->db->trans_start();
        $this->db->where('product_id', $this->input->post('product_id'));
        $this->db->update('stk_product', $data);

        if ($this->input->post('option_id')) {
            foreach ($this->input->post('option_id') as $item) {
                $qg = $this->db->get_where('product_option_item', array('id' => $item));
                if ($qg->num_rows() > 0) {
                    $row = $qg->first_row();
                    if ($item != '') {
                        $data_option = array(
                            'product_id' => $this->input->post('product_id'),
                            'group_id' => $row->group_id,
                            'option_item_id' => $item,
                            'created_at' => date('Y-m-d h:i:s'),
                            'updated_at' => date('Y-m-d h:i:s')
                        );
                        $this->db->insert('product_ref_option', $data_option);
                    }
                }
            }
        }
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $rdata = array(
                'status' => FALSE,
                'message' => $this->db->_error_message()
            );
        } else {
            $this->db->trans_commit();
            $rdata = array(
                'status' => TRUE,
                'redirect' => 'products/backend/product',
                'message' => 'Save data success.'
            );
        }

        return $rdata;
    }

}
