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
                $str .= '<a href="//www.jib.co.th/jib_content/images/gallery/' . $value->gallery_img_url . '" class="thumbnail" title="' . $value->cnt_title . '" data-gallery>';
                $str .='<img class="img-responsive" src="//www.jib.co.th/jib_content/images/gallery/' . $value->gallery_img_url . '" alt="Loading..." height="200" />';
                $str .='</a>';
                $str .='</div>';
            }
        } else {
            $str = 'ไม่มีข้อมูล กรุณาลองใหม่อีกครั้ง';
        }

        return $str;
    }

    public function get_galler_list($param) {
        $this->db->select('*');
        $this->db->from('stk_product');
        $this->db->join('cms_content', 'cms_content.cnt_id=stk_product.cnt_id', 'inner');
        $this->db->join('cms_gallery', 'cms_gallery.cnt_id=cms_content.cnt_id', 'inner');
        $this->db->where('stk_product.product_id', $param);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_edit($id) {
        $this->db->select(''
                . 'stk_product.product_id,'
                . 'stk_product.product_code,'
                . 'stk_product.cat_id,'
                . 'stk_product.category_sub_1,'
                . 'stk_product.category_sub_2,'
                . 'stk_product.category_sub_3,'
                . 'stk_product.category_sub_4,'
                . 'stk_product.product_code,'
                . 'cms_content.cnt_title as product_name,'
                . 'cms_content.cnt_sum_info,'
                . 'cms_content.cnt_htmlfile,'
                . 'cms_content.cnt_thumb_url,'
                . 'stk_product.stock_qty as qty,'
                . 'stk_product.price_1,'
                . 'stk_product.price_5,'
                . 'stk_product.warranty,'
                . 'stk_product.prod_active'
                . '');
        $this->db->from('stk_product');
        $this->db->join('cms_content', 'cms_content.cnt_id=stk_product.cnt_id');
        $this->db->where('stk_product.product_id', $id);
        $query = $this->db->get();
        $row = $query->first_row();

        return $row;
    }

    public function get_spec_html($param) {
        $this->db->select('stk_product.*, stk_category.prod_spec_id');
        $this->db->from('stk_product');
        $this->db->join('stk_category', 'stk_category.cat_id=stk_product.cat_id', 'inner');
        $this->db->where('stk_product.product_id', $param);
        $query_pro = $this->db->get();
        if ($query_pro->num_rows() > 0) {
            $row_prod = $query_pro->first_row();
            $this->db->select('*');
            $this->db->from('stk_prod_spec');
            $this->db->where('prod_spec_id', $row_prod->prod_spec_id);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                $row = $query->result_array();
                $row_spec = $query_pro->result_array();
                $str = '';
                for ($i = 0; $i < 20; $i++) {
                    $code = str_pad($i, 2, "0", STR_PAD_LEFT);
                    $label = $row[0]['prod_spec_' . $code . '_label'];
                    $spec = $row_spec[0]['prod_spec_' . $code . ''];
                    if ($label !== NULL && $spec != NULL) {
                        $str .= "<tr>";
                        $str .= "<td>" . $label . "</td>";
                        $str .= "<td>" . $spec . "</td>";
                        $str .= "</tr>";
                    }
                }
            }
        }
        return $str;
    }

    public function get_compare_spec_html($param = array()) {
        if ($this->input->cookie('product_compare_id', TRUE)) {
            $this->db->select('stk_product.*, stk_category.prod_spec_id, cms_content.cnt_title, cms_content.cnt_thumb_url');
            $this->db->from('stk_product');
            $this->db->join('stk_category', 'stk_category.cat_id=stk_product.cat_id', 'inner');
            $this->db->join('cms_content', 'cms_content.cnt_id=stk_product.cnt_id', 'inner');
            $this->db->where_in('stk_product.product_id', $param);
            $query_pro = $this->db->get();
            if ($query_pro->num_rows() > 0) {
                $row_prod = $query_pro->first_row();
                $this->db->select('*');
                $this->db->from('stk_prod_spec');
                $this->db->where('prod_spec_id', $row_prod->prod_spec_id);
                $query = $this->db->get();
                if ($query->num_rows() > 0) {
                    $row = $query->result_array();
                    $row_spec = $query_pro->result_array();
                    $str = '';
                    $str .='<table class="table table-striped">';
                    $str .= '<thead>';
                    $str .= '<tr>';
                    $str .= '<th>Spec</th>';
                    foreach ($row_spec as $item_info_1) {
                        $str .= '<th class="text-center">';
                        $str .='<a href="' . base_url() . index_page() . 'products/view/' . $item_info_1['product_id'] . '" target="_blank" class="text-center" title="ดูรายละเอียดสินค้า"><img src="https://www.jib.co.th/jib_content/images/content/' . $item_info_1['cnt_thumb_url'] . '" class="img-responsive" alt="Loading..." /></a>';
                        $str .= $item_info_1['cnt_title'];
                        $str .= '<p>ราคา <span class="badge alert-success">' . number_format(get_price_dealer($item_info_1['product_id'])) . '</span> บาท</p>';
                        $str .= '</th>';
                    }
                    $str .= '</tr>';
                    $str .= '</thead>';
                    for ($i = 0; $i < 20; $i++) {
                        $code = str_pad($i, 2, "0", STR_PAD_LEFT);
                        $label = $row[0]['prod_spec_' . $code . '_label'];
                        if ($label !== NULL) {
                            $str .= "<tr>";
                            $str .= "<td>" . $label . "</td>";
                            foreach ($row_spec as $item) {
                                $spec = $item['prod_spec_' . $code . ''];
                                $str .= "<td>" . $spec . "</td>";
                            }
                            $str .= "</tr>";
                        }
                    }
                    $str .='</table>';
                }
            }
            return $str;
        } else {
            return 'ไม่มีรายการเปรียบเทียบสินค้า';
        }
    }

    public function check_stock() {
        $query = $this->db->get_where('stk_product', array('product_id' => $this->input->post('product_id')));
        if ($query->num_rows() > 0) {
            $row = $query->first_row();
            if ($row->stock_qty > 0) {
                $rdata = array(
                    'status' => TRUE
                );
            } else {
                $rdata = array(
                    'status' => FALSE
                );
            }
        } else {
            $rdata = array(
                'status' => FALSE
            );
        }

        return $rdata;
    }

    public function get_product_recommend_normal() {
        $this->db->select('stk_product.product_id, stk_product.product_code, stk_product.price_1, stk_product.price_5, cms_content.cnt_title, cms_content.cnt_thumb_url');
        $this->db->from('stk_product');
        $this->db->join('cms_content', 'cms_content.cnt_id=stk_product.cnt_id', 'inner');
        $this->db->join('product_setting_wholesale', 'product_setting_wholesale.product_id=stk_product.product_id', 'inner');
        $this->db->join('product_sale', 'product_sale.product_id=stk_product.product_id', 'inner');
        $this->db->where('product_setting_wholesale.recommend', 1);
        $this->db->order_by('stk_product.product_id', 'random');
        $this->db->limit(8);
        $query = $this->db->get();
        return $query;
    }

    public function get_product_new_normal() {
        $this->db->select('stk_product.product_id, stk_product.product_code, stk_product.price_1, stk_product.price_5, cms_content.cnt_title, cms_content.cnt_thumb_url');
        $this->db->from('stk_product');
        $this->db->join('cms_content', 'cms_content.cnt_id=stk_product.cnt_id', 'inner');
        $this->db->join('product_sale', 'product_sale.product_id=stk_product.product_id', 'inner');
        $this->db->where('stk_product.price_1 >', 0);
        $this->db->where('stk_product.prod_active', 'Y');
        $this->db->order_by('stk_product.prod_cre_dat', 'DESC');
        $this->db->limit(8);
        $query = $this->db->get();
        return $query;
    }

    public function get_product_promotion_normal() {
        $this->db->select('stk_product.product_id, stk_product.product_code, stk_product.price_1, stk_product.price_5, cms_content.cnt_title, cms_content.cnt_thumb_url');
        $this->db->from('stk_product');
        $this->db->join('cms_content', 'cms_content.cnt_id=stk_product.cnt_id', 'inner');
        $this->db->join('product_setting_wholesale', 'product_setting_wholesale.product_id=stk_product.product_id', 'inner');
        $this->db->where('product_setting_wholesale.promotion', 1);
        $this->db->order_by('stk_product.product_id', 'random');
        $this->db->limit(4);
        $query = $this->db->get();
        return $query;
    }

    public function get_product_sale_normal() {
        $this->db->select('stk_product.product_id, stk_product.product_code, stk_product.price_1, stk_product.price_5, cms_content.cnt_title, cms_content.cnt_thumb_url');
        $this->db->from('stk_product');
        $this->db->join('cms_content', 'cms_content.cnt_id=stk_product.cnt_id', 'inner');
        $this->db->join('product_setting_wholesale', 'product_setting_wholesale.product_id=stk_product.product_id', 'inner');
        $this->db->join('product_sale', 'product_sale.product_id=stk_product.product_id', 'inner');
        $this->db->where('product_setting_wholesale.sale', 1);
        $this->db->order_by('stk_product.product_id', 'random');
        $this->db->limit(8);
        $query = $this->db->get();
        return $query;
    }

    public function get_product_right($cat_id) {
        $query_1 = $this->db->get_where('stk_category', array('cat_id' => $cat_id));
        $row_1 = $query_1->first_row();

        $this->db->select('stk_product.product_id, stk_product.product_code, stk_product.price_1, stk_product.price_5, cms_content.cnt_title, cms_content.cnt_thumb_url');
        $this->db->from('stk_product');
        $this->db->join('cms_content', 'cms_content.cnt_id=stk_product.cnt_id', 'inner');
        $this->db->join('product_sale', 'product_sale.product_id=stk_product.product_id', 'inner');
        $this->db->where('stk_product.price_1 >', 0);
        $this->db->where('stk_product.prod_active', 'Y');
        $this->db->where('cat_id', $row_1->cat_id);
        $this->db->order_by('stk_product.product_id', 'random');
        $this->db->limit(6);
        $query = $this->db->get();
        return $query;
    }

    function count_items($param = array()) {
        if ($this->input->get('sub', TRUE)) {
            $query_cat = $this->db->get_where('stk_category', array('cat_parent' => $this->input->get('category_id'), 'cat_active' => 'Y'));
            foreach ($query_cat->result() as $cat_item) {
                $cat_id[] = $cat_item->cat_id;
            }
        } else {
            $cat_id = $this->input->get('category_id');
        }

        $this->db->select('*');
        $this->db->from('stk_product');
        $this->db->join('cms_content', 'cms_content.cnt_id=stk_product.cnt_id', 'inner');
        $this->db->where('stk_product.stock_qty >', 0);
        $this->db->where('stk_product.price_1 >', 0);
        $this->db->where('stk_product.price_5 >', 0);
        $this->db->where('stk_product.prod_active', 'Y');
        if ($this->input->get('category_id', TRUE)) {
            if ($this->input->get('category_id') != '') {
                $this->db->where_in('stk_product.cat_id', $cat_id);
            }
        }
        if ($param['word'] != '') {
            $this->db->or_like('stk_product.product_code', $param['word'], 'both');
            $this->db->or_like('cms_content.cnt_title', $param['word'], 'both');
        }
        $query = $this->db->get();
        return $query->num_rows();
    }

    function get_items($param = array()) {
        if ($this->input->get('sub', TRUE)) {
            $query_cat = $this->db->get_where('stk_category', array('cat_parent' => $this->input->get('category_id'), 'cat_active' => 'Y'));
            foreach ($query_cat->result() as $cat_item) {
                $cat_id[] = $cat_item->cat_id;
            }
        } else {
            $cat_id = $this->input->get('category_id');
        }
        $this->db->select(''
                . 'stk_product.product_id, '
                . 'stk_product.product_code, '
                . 'stk_product.price_1, '
                . 'stk_product.price_5, '
                . 'stk_product.warranty, '
                . 'cms_content.cnt_title, '
                . 'cms_content.cnt_sum_info, '
                . 'cms_content.cnt_thumb_url'
                . '');
        $this->db->from('stk_product');
        $this->db->join('cms_content', 'cms_content.cnt_id=stk_product.cnt_id', 'inner');
        $this->db->join('stk_category', 'stk_category.cat_id=stk_product.cat_id', 'inner');
        $this->db->join('product_sale', 'product_sale.product_id=stk_product.product_id', 'inner');
        $this->db->where('stk_product.stock_qty >', 0);
        $this->db->where('stk_product.price_1 >', 0);
        $this->db->where('stk_product.price_5 >', 0);
        $this->db->where('stk_product.prod_active', 'Y');
        $this->db->where('stk_category.cat_active', 'Y');

        if ($this->input->get('category_id', TRUE)) {
            if ($this->input->get('category_id') != '') {
                $this->db->where_in('stk_product.cat_id', $cat_id);
            }
        }
        if ($param['word'] != '') {
            $this->db->or_like('stk_product.product_code', $param['word'], 'both');
            $this->db->or_like('cms_content.cnt_title', $param['word'], 'both');
        }
        if (isset($param['order'])) {
            $this->db->order_by($param['order']['field'], $param['order']['by']);
        } else {
            $this->db->order_by('stk_category.cat_order', 'asc');
        }
        $this->db->limit($param['limit'], $param['offset']);
        $query = $this->db->get();
        $data = array(
            'result' => $query->result(),
            'num_rows' => $this->count_items($param)
        );
        return $data;
    }

    /**
     * SearchEntries
     * 
     * Options: Values
     * ---------------
     * words
     *
     * @param array $options
     * @return bool
     */
    function SearchEntries($options = array()) {
        $search_result = array();

//        $search_result = array_merge($search_result, $this->get_items(array('word' => trim($options['words']), 'limit' => $options['limit'], 'offset' => $options['offset'])));

        $words = explode(" ", $options['words']);
        foreach ($words as $word) {
            $op = array(
                'word' => trim($word),
                'limit' => $options['limit'],
                'offset' => $options['offset'],
                'order' => (isset($options['order']) ? $options['order'] : NULL)
            );
            if (isset($options['limit']) && isset($options['offset'])) {
                $search_result = array_merge($search_result, $this->get_items($op));
            } else {
                $search_result = array_merge($search_result, $this->get_items($op));
            }
        }
        $new = array();
        $exclude = array("");
        for ($i = 0; $i <= count($search_result['result']) - 1; $i++) {
            if (!in_array(trim($search_result['result'][$i]->product_id), $exclude)) {
                $new[] = $search_result['result'][$i];
                $exclude[] = trim($search_result['result'][$i]->product_id);
            }
        }
        $data = array(
            'result' => $new,
            'num_rows' => $search_result['num_rows']
        );
        return $data;
    }

    public function get_array_compare($param, $val) {
        if ($param) {
            $ex = explode(',', $param);
            if (in_array($val, $ex)) {
                return TRUE;
            } else {
                return FALSE;
            }
        } else {
            return FALSE;
        }
    }

    public function get_price_html($param) {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('id', $this->ion_auth->get_user_id());
        $query = $this->db->get();

        $query2 = $this->db->get_where('stk_product', array('product_id' => $param));
        $row2 = $query2->result_array();

        $tb_label = array(
            'ขายปลีก' => 1,
            'ขายส่ง 1' => 5,
            'ขายส่ง 2' => 6,
            'ขายส่ง 3' => 7,
            'ขายส่ง 4' => 8,
            'ขายส่ง 5' => 9,
            'ขายส่ง 6' => 10,
        );
        $str = '';

        if ($query->num_rows() > 0) {
            $row = $query->first_row();
            $str .='<table class="table table-bordered">';
            $str .='<tbody>';
            $str .='<tr>';
            foreach ($tb_label as $key => $val) {
                if ($val <= $row->group_price) {
                    $str .='<td  align="center">' . $key . '</td>';
                }
            }
            $str .='</tr> ';
            $str .='<tr>';
            foreach ($tb_label as $key2 => $val2) {
                if ($val2 <= $row->group_price) {
                    $str .='<td align="center">';
                    $str .='<strong>' . $row2[0]['price_' . $val2] . '</strong>';
                    $str .='</td>';
                }
            }
            $str .='</tr> ';
            $str .='</tbody>';
            $str .='</table>';
        } else {
            $str .='ราคา <span class="badge alert-success">' . number_format(get_price_dealer($param)) . '</span> บาท';
        }
        return $str;
    }

    public function get_desc($prod_code) {
        $this->db->select(''
                . 'stk_product.product_id,'
                . 'stk_product.product_code,'
                . 'stk_product.cat_id,'
                . 'stk_product.category_sub_1,'
                . 'stk_product.category_sub_2,'
                . 'stk_product.category_sub_3,'
                . 'stk_product.category_sub_4,'
                . 'stk_product.product_code,'
                . 'cms_content.cnt_title as product_name,'
                . 'cms_content.cnt_sum_info,'
                . 'cms_content.cnt_htmlfile,'
                . 'cms_content.cnt_thumb_url,'
                . 'stk_product.stock_qty as qty,'
                . 'stk_product.price_1,'
                . 'stk_product.price_5,'
                . 'stk_product.warranty,'
                . 'stk_product.prod_active'
                . '');
        $this->db->from('stk_product');
        $this->db->join('cms_content', 'cms_content.cnt_id=stk_product.cnt_id');
        $this->db->where('stk_product.product_code', $prod_code);
        $query = $this->db->get();
        $row = $query->first_row();

        return $row;
    }

}
