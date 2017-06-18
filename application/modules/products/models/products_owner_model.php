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
class Products_owner_model extends CI_Model {

    function get_listall() {
        $this->load->library('datatables');
        $this->load->helper('products/useful');
        $this->datatables->select(''
                . 'products.id as id, '
                . 'products.prod_code as prod_code, '
                . 'products.title as title, '
                . 'categories.title as cat_name, '
                . 'products.stock as stock, '
                . 'products.price as price, '
                . 'products.disabled as disabled '
                . '');
        $this->datatables->from('products');
        $this->datatables->join('categories', 'categories.id = products.cat_id', 'inner');
        if ($this->input->post('txtSearch', TRUE)) {
            $array = array(
                'products.title' => $this->input->post('txtSearch'),
            );
            $this->datatables->like($array, NULL, FALSE);
        }
        if ($this->input->post('myCat', TRUE)) {
            $this->datatables->where('categories.id', $this->input->post('myCat'));
        }
        $link = "<div class=\"dropdown\">";
        $link .= "<a class=\"dropdown-toggle\" data-toggle=\"dropdown\" href=\"javascript:;\"><span class=\"fa fa-pencil-square-o\"></span ></a>";
        $link .= "<ul class=\"dropdown-menu\" role=\"menu\" aria-labelledby=\"dLabel\">";
        $link .= "<li><a href=\"" . base_url() . index_page() . "products/backend/product/edit/$1\" title=\"แก้ไขรายการ\">แก้ไขรายการ</a></li>";
        $link .= "<li><a href=\"javascript:;\" rel=\"contents/backend/result_product/delete/$1\" class=\"link_dialog delete\" title=\"ลบรายการ\">ลบรายการ</a></li>";
        $link .= "</ul>";
        $link .= "</div>";
        $this->datatables->edit_column('id', $link, 'id');
        $this->datatables->edit_column('disabled', '$1', 'check_disabled(disabled,0)');
        $this->datatables->edit_column('price', '$1', 'number_format(price)');
        return $this->datatables->generate();
    }

    function get_import_listall() {
        $this->load->library('datatables');
        $this->load->helper('products/useful');
        $this->datatables->select(''
                . 'products_tmp_imp.id as id,'
                . 'products_tmp_imp.product_code as product_code, '
                . 'products_tmp_imp.title as title, '
                . 'categories.title as cat_name, '
                . 'products_tmp_imp.stock as stock, '
                . 'products_tmp_imp.price as price '
                . '');
        $this->datatables->from('products_tmp_imp');
        $this->datatables->join('categories', 'categories.id=products_tmp_imp.cat_id');
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

    public function get_view($param) {
        $this->db->select(''
                . 'products.*, '
                . 'categories.title as cat_name'
                . '');
        $this->db->from('products');
        $this->db->join('categories', 'categories.id=products.cat_id');
        $this->db->where('products.id', $param);
        $query = $this->db->get();
        return $query->first_row();
    }

    public function add($param = array()) {
        $data = array(
            'cat_id' => (int) $this->input->post('cat_sub_1'),
            'prod_code' => trim($this->input->post('prod_code')),
            'title' => trim($this->input->post('title')),
            'short_desc' => $this->input->post('short_desc'),
            'long_desc' => $this->input->post('long_desc'),
            'stock' => trim($this->input->post('stock')),
            'price' => trim($this->input->post('price')),
            'img_cover' => (isset($param[0]['upload_data_photo0']['file_name']) ? 'uploads/products/' . date('Ymd') . '/' . $param[0]['upload_data_photo0']['file_name'] : NULL),
            'photo1' => (isset($param[1]['upload_data_photo1']['file_name']) ? 'uploads/products/' . date('Ymd') . '/' . $param[1]['upload_data_photo1']['file_name'] : NULL),
            'photo2' => (isset($param[2]['upload_data_photo2']['file_name']) ? 'uploads/products/' . date('Ymd') . '/' . $param[2]['upload_data_photo2']['file_name'] : NULL),
            'photo3' => (isset($param[3]['upload_data_photo3']['file_name']) ? 'uploads/products/' . date('Ymd') . '/' . $param[3]['upload_data_photo3']['file_name'] : NULL),
            'photo4' => (isset($param[4]['upload_data_photo4']['file_name']) ? 'uploads/products/' . date('Ymd') . '/' . $param[4]['upload_data_photo4']['file_name'] : NULL),
            'photo5' => (isset($param[5]['upload_data_photo5']['file_name']) ? 'uploads/products/' . date('Ymd') . '/' . $param[5]['upload_data_photo5']['file_name'] : NULL),
            'description' => trim($this->input->post('description')),
            'keywords' => trim($this->input->post('keywords')),
            'disabled' => ($this->input->post('disabled', TRUE) ? 0 : 1),
            'created_user' => (int) $this->ion_auth->get_user_id(),
            'created_at' => time(),
            'updated_at' => time()
        );
        $this->db->trans_start();
        $this->db->insert('products', $data);
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
                'message' => NULL
            );
        }

        return $rdata;
    }

    public function add_import() {
        $query = $this->db->get('products_tmp_imp');
        foreach ($query->result() as $value) {
            $data = array(
                'cat_id' => $value->cat_id,
                'prod_code' => $value->product_code,
                'title' => $value->title,
                'stock' => $value->stock,
                'price' => $value->price,
                'created_user' => (int) $this->ion_auth->get_user_id(),
                'created_at' => time(),
                'updated_at' => time()
            );
            $this->db->insert('products', $data);
        }
        $rdata = array(
            'status' => TRUE,
            'redirect' => 'products/backend/product',
            'message' => NULL
        );
        return $rdata;
    }

    public function import($param = array()) {
        $this->load->library('csvimport');
        $file_path = (isset($param['upload_data']['file_name']) ? 'uploads/products/import/' . date('Ymd') . '/' . $param['upload_data']['file_name'] : NULL);
        if ($this->csvimport->get_array($file_path)) {
            $csv_array = $this->csvimport->get_array($file_path);
            $this->db->truncate('products_tmp_imp');
            foreach ($csv_array as $row) {
                $insert_data = array(
                    'cat_id' => $this->input->post('cat_sub_1'),
                    'product_code' => $row['code'],
                    'title' => $row['title'],
                    'stock' => $row['stock'],
                    'price' => $row['price'],
                    'created_at' => time()
                );
                $this->db->insert('products_tmp_imp', $insert_data);
            }
            $rdata = array(
                'status' => TRUE,
                'redirect' => 'products/backend/product/import_add',
                'message' => NULL
            );
        }
        return $rdata;
    }

    public function edit($param = array()) {
        $data = array(
            'cat_id' => (int) $this->input->post('cat_sub_1'),
            'prod_code' => trim($this->input->post('prod_code')),
            'title' => trim($this->input->post('title')),
            'short_desc' => $this->input->post('short_desc'),
            'long_desc' => $this->input->post('long_desc'),
            'stock' => trim($this->input->post('stock')),
            'price' => trim($this->input->post('price')),
            'img_cover' => (isset($param[0]['upload_data_photo0']['file_name']) ? 'uploads/products/' . date('Ymd') . '/' . $param[0]['upload_data_photo0']['file_name'] : $this->input->post('img_cover_hidden')),
            'photo1' => (isset($param[1]['upload_data_photo1']['file_name']) ? 'uploads/products/' . date('Ymd') . '/' . $param[1]['upload_data_photo1']['file_name'] : $this->input->post('photo1_hidden')),
            'photo2' => (isset($param[2]['upload_data_photo2']['file_name']) ? 'uploads/products/' . date('Ymd') . '/' . $param[2]['upload_data_photo2']['file_name'] : $this->input->post('photo2_hidden')),
            'photo3' => (isset($param[3]['upload_data_photo3']['file_name']) ? 'uploads/products/' . date('Ymd') . '/' . $param[3]['upload_data_photo3']['file_name'] : $this->input->post('photo3_hidden')),
            'photo4' => (isset($param[4]['upload_data_photo4']['file_name']) ? 'uploads/products/' . date('Ymd') . '/' . $param[4]['upload_data_photo4']['file_name'] : $this->input->post('photo4_hidden')),
            'photo5' => (isset($param[5]['upload_data_photo5']['file_name']) ? 'uploads/products/' . date('Ymd') . '/' . $param[5]['upload_data_photo5']['file_name'] : $this->input->post('photo5_hidden')),
            'description' => trim($this->input->post('description')),
            'keywords' => trim($this->input->post('keywords')),
            'disabled' => ($this->input->post('disabled', TRUE) ? 0 : 1),
            'updated_user' => (int) $this->ion_auth->get_user_id(),
            'updated_at' => time()
        );
        $this->db->trans_start();
        $this->db->update('products', $data, array('id' => $this->input->post('id')));
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
                'redirect' => 'products/backend/product/edit/' . $this->input->post('id'),
                'message' => NULL
            );
        }

        return $rdata;
    }

    function count_items($param = array()) {
        if ($this->uri->segment(3) != '') {
            $query_cat = $this->db->get_where('category_hierarchy', array('category_parent_id' => $this->uri->segment(3)));
            foreach ($query_cat->result() as $cat_item) {
                $cat_id[] = $cat_item->category_id;
            }
        } else {
            $cat_id = $this->uri->segment(3);
        }
        $this->db->
                select('*');
        $this->db->from('products');
        $this->db->join('categories', 'categories.id=products.cat_id', 'inner');
        $this->db->where('products.disabled', 0);
        $this->db->where('products.deleted_at', 0);
        $this->db->where('categories.disabled', 0);
        if ($this->uri->segment(3) === TRUE) {
            $this->db->where_in('products.cat_id', $cat_id);
        }
        $query = $this->db->get();
        return $query->num_rows();
    }

    function get_items($param = array()) {
        if ($this->uri->segment(3) != '') {
            $query_cat = $this->db->get_where('category_hierarchy', array('category_parent_id' => $this->uri->segment(3)));
            foreach ($query_cat->result() as $cat_item) {
                $cat_id[] = $cat_item->category_id;
            }
        } else {
            $cat_id = $this->uri->segment(3);
        }
        $this->db->select(''
                . 'products.id, '
                . 'products.title, ' . 'products.short_desc, '
                . 'products.price'
                . '');
        $this->db->from('products');
        $this->db->join('categories', 'categories.id=products.cat_id', 'inner');
        $this->db->where('products.disabled', 0);
        $this->db->where('products.deleted_at', 0);
        $this->db->where('categories.disabled', 0);
        if ($this->uri->segment(3)) {
            $this->db->where_in('products.cat_id', $cat_id);
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

//
        $search_result = array_merge($search_result, $this->get_items(array('word' => trim($options['words']), 'limit' => $options['limit'], 'offset' => $options['offset'])));
        $words = explode(" ", $options['words']);
        foreach ($words as $word) {
            $op = array(
                'word' => trim($word),
                'limit' => $options['limit'],
                'offset' => $options['offset'],
                'order' => (isset($options['order']) ? $options['order'] : NULL));
            if (isset($options['limit']) && isset($options['offset'])) {
                $search_result = array_merge($search_result, $this->get_items($op));
            } else {
                $search_result = array_merge($search_result, $this->get_items($op));
            }
        }
        $new = array();
        $exclude = array("");
        for ($i = 0; $i <= count($search_result['result']) - 1; $i++) {
            if (!in_array(trim($search_result['result'][$i]->id), $exclude)) {
                $new[] = $search_result['result'][$i];
                $exclude[] = trim($search_result['result'][$i]->id);
            }
        }
        $data = array(
            'result' => $new,
            'num_rows' => $search_result['num_rows']
        );
        return $data;
    }

}
