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
class Products_wholesale_model extends CI_Model {

    function get_listall() {
        $this->load->library('datatables');
        $this->load->helper('products/useful');

        $this->datatables->select(''
                . 'stk_product.product_id as product_id, '
                . 'stk_product.product_id as prod_id, '
                . 'stk_product.product_code as product_code, '
                . 'cms_content.cnt_thumb_url as cnt_thumb_url, '
                . 'cms_content.cnt_title as cnt_title, '
                . 'stk_category.cat_name as cat_name, '
                . 'stk_product.stock_qty as stock_qty, '
                . 'stk_product.warranty as warranty, '
                . 'stk_product.price_1 as price_1, '
                . 'stk_product.price_5 as price_5,'
                . 'stk_product.prod_active as prod_dealer, '
                . 'stk_product.prod_active as prod_active'
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
        $this->datatables->unset_column('cnt_thumb_url');
        $this->datatables->unset_column('prod_active');
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
        $this->datatables->edit_column('product_id', $link, 'product_id');
        $this->datatables->edit_column('cnt_title', '<img src="https://www.jib.co.th/jib_content/images/content/$1" width="75" /> <a href="javascript:;" rel="products/backend/product/spec/$3" class="link_dialog" title="Product Spec"> $2</a>', 'cnt_thumb_url, cnt_title,prod_id');
        $this->datatables->add_column('prod_dealer', '$1', 'check_product_disabled_auth(product_id)');
        $this->datatables->add_column('prod_recommend', '$1', 'product_wholesale_recommend(product_id)');
        $this->datatables->add_column('prod_new', '$1', 'product_wholesale_new(product_id)');
        $this->datatables->add_column('prod_promotion', '$1', 'product_wholesale_promotion(product_id)');
        $this->datatables->add_column('prod_sale', '$1', 'product_wholesale_sale(product_id)');
        $this->datatables->add_column('prod_by_order', '$1', 'product_wholesale_by_order(product_id)');
        $this->datatables->add_column('prod_active', '$1', 'check_disabled(prod_active,Y)');
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

    public function set_update_status() {
        $query = $this->db->get_where('product_setting_ref', array('user_id' => $this->ion_auth->get_user_id(), 'product_id' => $this->input->post('product_id')));
        if ($query->num_rows() > 0) {
            $this->db->update('product_setting_ref', array('disabled' => $this->input->post('strState'), 'updated_at' => date('Y-m-d h:i:s')), array('user_id' => $this->ion_auth->get_user_id(), 'product_id' => $this->input->post('product_id')));
        } else {
            $this->db->insert('product_setting_ref', array('product_id' => $this->input->post('product_id'), 'user_id' => $this->ion_auth->get_user_id(), 'disabled' => $this->input->post('strState'), 'created_at' => date('Y-m-d h:i:s')));
        }
    }

    public function update_status_recommend() {
        $query = $this->db->get_where('product_setting_wholesale', array('user_id' => $this->ion_auth->get_user_id(), 'product_id' => $this->input->post('product_id')));
        if ($query->num_rows() > 0) {
            $this->db->update('product_setting_wholesale', array('recommend' => $this->input->post('strState'), 'updated_at' => time()), array('user_id' => $this->ion_auth->get_user_id(), 'product_id' => $this->input->post('product_id')));
        } else {
            $this->db->insert('product_setting_wholesale', array('product_id' => $this->input->post('product_id'), 'user_id' => $this->ion_auth->get_user_id(), 'recommend' => $this->input->post('strState'), 'created_at' => time()));
        }
    }

    public function update_status_new() {
        $query = $this->db->get_where('product_setting_wholesale', array('user_id' => $this->ion_auth->get_user_id(), 'product_id' => $this->input->post('product_id')));
        if ($query->num_rows() > 0) {
            $this->db->update('product_setting_wholesale', array('new' => $this->input->post('strState'), 'updated_at' => time()), array('user_id' => $this->ion_auth->get_user_id(), 'product_id' => $this->input->post('product_id')));
        } else {
            $this->db->insert('product_setting_wholesale', array('product_id' => $this->input->post('product_id'), 'user_id' => $this->ion_auth->get_user_id(), 'new' => $this->input->post('strState'), 'created_at' => time()));
        }
    }

    public function update_status_promotion() {
        $query = $this->db->get_where('product_setting_wholesale', array('user_id' => $this->ion_auth->get_user_id(), 'product_id' => $this->input->post('product_id')));
        if ($query->num_rows() > 0) {
            $this->db->update('product_setting_wholesale', array('promotion' => $this->input->post('strState'), 'updated_at' => time()), array('user_id' => $this->ion_auth->get_user_id(), 'product_id' => $this->input->post('product_id')));
        } else {
            $this->db->insert('product_setting_wholesale', array('product_id' => $this->input->post('product_id'), 'user_id' => $this->ion_auth->get_user_id(), 'promotion' => $this->input->post('strState'), 'created_at' => time()));
        }
    }

    public function update_status_sale() {
        $query = $this->db->get_where('product_setting_wholesale', array('user_id' => $this->ion_auth->get_user_id(), 'product_id' => $this->input->post('product_id')));
        if ($query->num_rows() > 0) {
            $this->db->update('product_setting_wholesale', array('sale' => $this->input->post('strState'), 'updated_at' => time()), array('user_id' => $this->ion_auth->get_user_id(), 'product_id' => $this->input->post('product_id')));
        } else {
            $this->db->insert('product_setting_wholesale', array('product_id' => $this->input->post('product_id'), 'user_id' => $this->ion_auth->get_user_id(), 'sale' => $this->input->post('strState'), 'created_at' => time()));
        }
    }

    public function update_status_by_order() {
        $query = $this->db->get_where('product_setting_wholesale', array('user_id' => $this->ion_auth->get_user_id(), 'product_id' => $this->input->post('product_id')));
        if ($query->num_rows() > 0) {
            $this->db->update('product_setting_wholesale', array('by_order' => $this->input->post('strState'), 'updated_at' => time()), array('user_id' => $this->ion_auth->get_user_id(), 'product_id' => $this->input->post('product_id')));
        } else {
            $this->db->insert('product_setting_wholesale', array('product_id' => $this->input->post('product_id'), 'user_id' => $this->ion_auth->get_user_id(), 'by_order' => $this->input->post('strState'), 'created_at' => time()));
        }
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
                $data_option = array(
                    'product_id' => $this->input->post('product_id'),
                    'group_id' => $qg->first_row()->group_id,
                    'option_item_id' => $item,
                    'created_at' => date('Y-m-d h:i:s'),
                    'updated_at' => date('Y-m-d h:i:s')
                );
                $this->db->insert('product_ref_option', $data_option);
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
