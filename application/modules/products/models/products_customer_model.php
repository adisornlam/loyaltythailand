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
class Products_customer_model extends CI_Model {

    public function get_product_my_listall() {
        $this->load->library('datatables');
        $columns = $this->input->post('columns');
        $this->datatables->select(''
                . 'stk_product.product_code as product_code, '
                . 'cms_content.cnt_title as cnt_title, '
                . 'stk_category.cat_name as cat_name, '
                . 'product_dealer.stock as stock, '
                . 'stk_product.price_5 as price_5, '
                . 'stk_product.product_id as product_id'
                . '');
        $this->datatables->from('stk_product');
        $this->datatables->join('cms_content', 'cms_content.cnt_id = stk_product.cnt_id', 'inner');
        $this->datatables->join('stk_category', 'stk_category.cat_id = stk_product.cat_id', 'inner');
        $this->datatables->join('product_dealer', 'product_dealer.product_id = stk_product.product_id', 'inner');
        $this->datatables->where('product_dealer.user_id', $this->ion_auth->get_user_id());
        if ($columns[3]['search']['value']) {
            $this->datatables->where('stk_product.cat_id', $columns[3]['search']['value']);
        }
        $this->datatables->unset_column('product_id');
        $this->datatables->edit_column('cnt_title', '$1 <a href="javascript:;" rel="products/backend/product/spec/$2" class="link_dialog" title="Product Spec"><i class="fa fa-picture-o"></i></a>', 'cnt_title,product_id');
        $this->datatables->edit_column('price_5', '$1', 'number_format(price_5)');
        return $this->datatables->generate();
    }

    public function get_galler($param) {
        $this->db->select('*');
        $this->db->from('stk_product');
        $this->db->join('cms_content', 'cms_content.cnt_id=stk_product.cnt_id', 'inner');
        $this->db->join('cms_gallery', 'cms_gallery.cnt_id=cms_content.cnt_id', 'inner');
        $this->db->where('stk_product.product_id', $param);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $str = '';
            foreach ($query->result() as $value) {
                $str .= '<div class="col-xs-6 col-md-4">';
                $str .= '<a href="javascript:;" class="thumbnail">';
                $str .='<img src="//www.jib.co.th/jib_content/images/gallery/' . $value->gallery_img_url . '" alt="Loading..." height="200" />';
                $str .='</a>';
                $str .='</div>';
            }
        }
        return $str;
    }

    public function get_product_list() {
        $this->db->select(''
                . 'stk_product.product_id, '
                . 'stk_product.product_code, '
                . 'stk_product.price_1, '
                . 'stk_product.price_5, '
                . 'cms_content.cnt_title, '
                . 'cms_content.cnt_thumb_url'
                . '');
        $this->db->from('stk_product');
        $this->db->join('cms_content', 'cms_content.cnt_id=stk_product.cnt_id', 'inner');
        $this->db->where('stk_product.stock_qty >', 0);
        $this->db->limit(20);
        return $this->db->get();
    }    
}
