<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 *  @Auther : Adisorn Lamsombuth
 *  @Email : postyim@gmail.com
 *  @Website : esabay.com 
 */

/**
 * Description of promotion_model
 *
 * @author R-D-6
 */
class Promotion_model extends CI_Model {

    function get_listall() {
        $this->load->library('datatables');
        $this->load->helper('contents/useful');
        $this->datatables->select(''
                . 'id, '
                . 'title, '
                . 'position, '
                . 'start, '
                . 'finish, '
                . 'created_at, '
                . 'disabled'
                . '');
        $this->datatables->from('product_promotion');
        $this->datatables->where('deleted_at', 0);

        $link = "<div class=\"dropdown\">";
        $link .= "<a class=\"dropdown-toggle\" data-toggle=\"dropdown\" href=\"javascript:;\"><span class=\"fa fa-pencil-square-o\"></span ></a>";
        $link .= "<ul class=\"dropdown-menu\" role=\"menu\" aria-labelledby=\"dLabel\">";
        $link .= "<li><a href=\"" . base_url() . index_page() . "contents/backend/promotion/edit/$1\"\" title=\"Edit Promotion\">Edit Promotion</a></li>";
        $link .= "<li><a href=\"javascript:;\" rel=\"contents/backend/result_promotion/delete/$1\" class=\"link_dialog delete\" title=\"Delete Promotion\">Delete Promotion</a></li>";
        $link .= "</ul>";
        $link .= "</div>";
        $this->datatables->edit_column('id', $link, 'id');
        $this->datatables->edit_column('position', '$1', 'check_position(position)');
        $this->datatables->edit_column('start', '$1', 'get_datethai(start,3)');
        $this->datatables->edit_column('finish', '$1', 'get_datethai(finish,3)');
        $this->datatables->edit_column('created_at', '$1', 'get_datethai(created_at,3)');
        $this->datatables->edit_column('disabled', '$1', 'check_active(disabled,1)');
        return $this->datatables->generate();
    }

    function get_listall_bk() {
        $this->load->library('datatables');
        $this->load->helper('products/useful');
        $col = $this->input->post('columns');

        $this->datatables->select(''
                . 'stk_product.product_id as prod_id, '
                . 'stk_product.product_code as prod_code, '
                . 'cms_content.cnt_thumb_url as prod_url, '
                . 'cms_content.cnt_title as prod_title, '
                . 'stk_category.cat_name as prod_cat_name, '
                . 'stk_product.stock_qty as prod_qty, '
                . 'stk_product.warranty as prod_warranty, '
                . 'stk_product.price_1 as prod_price_1, '
                . 'stk_product.price_5 as prod_price_5,'
                . 'stk_product.prod_active as prod_act'
                . '');
        $this->datatables->from('stk_product');
        $this->datatables->join('cms_content', 'cms_content.cnt_id = stk_product.cnt_id', 'inner');
        $this->datatables->join('stk_category', 'stk_category.cat_id = stk_product.cat_id', 'inner');

        if ($col[3]['search']['value']) {
            $this->datatables->where('stk_product.cat_id', $col[3]['search']['value']);
        }

        if ($this->input->post('txtSearch', TRUE)) {
            $array = array(
                'stk_product.product_code' => $this->input->post('txtSearch'),
                'cms_content.cnt_title' => $this->input->post('txtSearch'),
                'stk_category.cat_name' => $this->input->post('txtSearch')
            );
            $this->datatables->like($array, NULL, FALSE);
        }

        $this->datatables->unset_column('prod_url');

        $this->datatables->edit_column('prod_price_1', '$1', 'number_format(prod_price_1)');
        $this->datatables->edit_column('prod_price_5', '$1', 'number_format(prod_price_5)');

        $this->datatables->edit_column('prod_title', '<img src="https://www.jib.co.th/jib_content/images/content/$1" width="75" /> <a href="javascript:;" rel="products/backend/product/spec/$3" class="link_dialog" title="Product Spec"> $2</a>', 'prod_url, prod_title,prod_id');

        $link = "<div class=\"dropdown\">";
        $link .= "<a class=\"dropdown-toggle\" data-toggle=\"dropdown\" href=\"javascript:;\"><span class=\"fa fa-pencil-square-o\"></span ></a>";
        $link .= "<ul class=\"dropdown-menu\" role=\"menu\" aria-labelledby=\"dLabel\">";
        $link .= "<li><a href=\"" . base_url() . index_page() . "products/backend/product/edit/$1\">Edit Details</a></li>";
        $link .= "<li><a href=\"javascript:;\" id=\"btnDelete\">Delete Product</a></li>";
        $link .= "</ul>";
        $link .= "</div>";

        $this->datatables->edit_column('prod_id', $link, 'prod_id');

        $this->datatables->add_column('prod_recommend', '$1', 'product_wholesale_recommend(prod_id)');
        $this->datatables->add_column('prod_new', '$1', 'product_wholesale_new(prod_id)');
        $this->datatables->add_column('prod_promotion', '$1', 'product_wholesale_promotion(prod_id)');
        $this->datatables->add_column('prod_sale', '$1', 'product_wholesale_sale(prod_id)');
        $this->datatables->add_column('prod_by_order', '$1', 'product_wholesale_by_order(prod_id)');
        $this->datatables->add_column('prod_active', '$1', 'check_disabled(prod_id,Y)');
        return $this->datatables->generate();
    }

    public function get_edit($id) {
        $query = $this->db->get_where('product_promotion', array('id' => $id));
        $row = $query->first_row();
        return $row;
    }

    public function add() {
        $this->load->helper('cookie');
        if ($this->input->cookie('temp_promotion_id', TRUE)) {
            $start = new DateTime($this->input->post('start') . " 00:00:01");
            $finish = new DateTime($this->input->post('finish') . " 23:59:59");
            $this->load->helper('directory');
            $upload_config = array(
                'upload_path' => 'uploads/contents/' . date('Ymd') . '/',
                'allowed_types' => 'jpg|jpeg|png',
                'file_name' => time()
            );
            $this->load->library('upload', $upload_config);
            $dir_exist = true;
            if (!is_dir($upload_config['upload_path'])) {
                mkdir($upload_config['upload_path'], 0777, true);
                $dir_exist = false;
            }
            if ($this->upload->do_upload('thumbs')) {
                $data_cover = $this->upload->data();
                $img_cover = $upload_config['upload_path'] . $data_cover['file_name'];
            } else {
                $img_cover = $this->input->post('thumbs_hidden');
            }

            if ($this->input->post('product_id', TRUE)) {
                $prod = $this->db->get_where('stk_product', array('product_code' => $this->input->post('product_id')));
                if ($prod->num_rows() > 0) {
                    $prod_row = $prod->first_row();
                    $prod_id = $prod_row->product_id;
                } else {
                    
                }
            } else {
                $prod_id = NULL;
            }
            $data = array(
                'title' => trim($this->input->post('title')),
                'short_desc' => $this->input->post('short_desc'),
                'long_desc' => $this->input->post('long_desc'),
                'links' => ($this->input->post('links', TRUE) ? $this->input->post('links') : NULL),
                'chk_promotion' => $this->input->post('chk_promotion'),
                'product_id' => $prod_id,
                'cat_id' => ($this->input->post('cat_id', TRUE) ? $this->input->post('cat_id') : NULL),
                'thumbs' => $img_cover,
                'start' => $start->getTimestamp(),
                'finish' => $finish->getTimestamp(),
                'sale' => trim($this->input->post('sale')),
                'sale_opt' => trim($this->input->post('sale_opt')),
                'chk_links' => ($this->input->post('chk_links', TRUE) ? 1 : 0),
                'position' => $this->input->post('position'),
                'disabled' => ($this->input->post('disabled', TRUE) ? 1 : 0),
                'updated_user' => $this->ion_auth->get_user_id(),
                'updated_at' => time()
            );
            $this->db->trans_start();
            $this->db->update('product_promotion', $data, array('id' => $this->input->cookie('temp_promotion_id')));
            $this->db->trans_complete();
        } else {
            $start = new DateTime($this->input->post('start') . " 00:00:01");
            $finish = new DateTime($this->input->post('finish') . " 23:59:59");

            $this->load->helper('directory');
            $upload_config = array(
                'upload_path' => 'uploads/contents/' . date('Ymd') . '/',
                'allowed_types' => 'jpg|jpeg|png',
                'file_name' => time()
            );
            $this->load->library('upload', $upload_config);
            $dir_exist = true;
            if (!is_dir($upload_config['upload_path'])) {
                mkdir($upload_config['upload_path'], 0777, true);
                $dir_exist = false;
            }
            if ($this->upload->do_upload('thumbs')) {
                $data_cover = $this->upload->data();
                $img_cover = $upload_config['upload_path'] . $data_cover['file_name'];
            } else {
                $img_cover = NULL;
            }
            if ($this->input->post('product_id', TRUE)) {
                $prod = $this->db->get_where('stk_product', array('product_code' => $this->input->post('product_id')));
                if ($prod->num_rows() > 0) {
                    $prod_row = $prod->first_row();
                    $prod_id = $prod_row->product_id;
                } else {
                    
                }
            } else {
                $prod_id = NULL;
            }
            $data = array(
                'title' => trim($this->input->post('title')),
                'short_desc' => $this->input->post('short_desc'),
                'long_desc' => $this->input->post('long_desc'),
                'links' => ($this->input->post('links', TRUE) ? $this->input->post('links') : NULL),
                'chk_promotion' => $this->input->post('chk_promotion'),
                'product_id' => $prod_id,
                'cat_id' => ($this->input->post('cat_id', TRUE) ? $this->input->post('cat_id') : NULL),
                'thumbs' => $img_cover,
                'start' => $start->getTimestamp(),
                'finish' => $finish->getTimestamp(),
                'sale' => trim($this->input->post('sale')),
                'sale_opt' => trim($this->input->post('sale_opt')),
                'chk_links' => ($this->input->post('chk_links', TRUE) ? 1 : 0),
                'position' => $this->input->post('position'),
                'disabled' => ($this->input->post('disabled', TRUE) ? 1 : 0),
                'created_user' => $this->ion_auth->get_user_id(),
                'created_at' => time()
            );
            $this->db->trans_start();
            $this->db->insert('product_promotion', $data);
            $this->db->trans_complete();
        }
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $rdata = array(
                'status' => FALSE,
                'message' => $this->db->_error_message()
            );
        } else {
            delete_cookie("temp_promotion_id");
            $this->db->trans_commit();
            $rdata = array(
                'status' => TRUE,
                'redirect' => 'contents/backend/promotion',
                'message' => 'Save data success.'
            );
        }

        return $rdata;
    }

    public function add_temp() {
        $start = new DateTime($this->input->post('start') . " 00:00:01");
        $finish = new DateTime($this->input->post('finish') . " 23:59:59");
        $this->load->helper('cookie');
        $this->load->helper('directory');
        $upload_config = array(
            'upload_path' => 'uploads/contents/' . date('Ymd') . '/',
            'allowed_types' => 'jpg|jpeg|png',
            'file_name' => time()
        );
        $this->load->library('upload', $upload_config);
        $dir_exist = true;
        if (!is_dir($upload_config['upload_path'])) {
            mkdir($upload_config['upload_path'], 0777, true);
            $dir_exist = false;
        }
        if ($this->upload->do_upload('thumbs')) {
            $data_cover = $this->upload->data();
            $img_cover = $upload_config['upload_path'] . $data_cover['file_name'];
        } else {
            $img_cover = NULL;
        }
        if ($this->input->post('product_id', TRUE)) {
            $prod = $this->db->get_where('stk_product', array('product_code' => $this->input->post('product_id')));
            if ($prod->num_rows() > 0) {
                $prod_row = $prod->first_row();
                $prod_id = $prod_row->product_id;
            } else {
                
            }
        } else {
            $prod_id = NULL;
        }
        $data = array(
            'title' => ($this->input->post('title', TRUE) ? trim($this->input->post('title')) : 'หัวข้อฉบับร่าง'),
            'short_desc' => $this->input->post('short_desc'),
            'long_desc' => $this->input->post('long_desc'),
            'links' => ($this->input->post('links', TRUE) ? $this->input->post('links') : NULL),
            'chk_promotion' => $this->input->post('chk_promotion'),
            'product_id' => $prod_id,
            'cat_id' => ($this->input->post('cat_id', TRUE) ? $this->input->post('cat_id') : NULL),
            'thumbs' => $img_cover,
            'start' => $start->getTimestamp(),
            'finish' => $finish->getTimestamp(),
            'sale' => trim($this->input->post('sale')),
            'sale_opt' => trim($this->input->post('sale_opt')),
            'chk_links' => ($this->input->post('chk_links', TRUE) ? 1 : 0),
            'long_time' => ($this->input->post('long_time', TRUE) ? 1 : 0),
            'position' => $this->input->post('position'),
            'disabled' => 0,
            'created_user' => $this->ion_auth->get_user_id(),
            'created_at' => time()
        );
        $this->db->trans_start();
        $this->db->insert('product_promotion', $data);
        $promotion_id = $this->db->insert_id();
        $this->db->trans_complete();
        $this->db->trans_commit();
        $cookie = array(
            'name' => 'temp_promotion_id',
            'value' => $promotion_id,
            'expire' => '86500',
            'domain' => '.jib.co.th',
            'path' => '/'
        );
        $this->input->set_cookie($cookie);
        $rdata = array(
            'status' => TRUE,
            'redirect' => 'contents/backend/promotion',
            'message' => 'Save data success.'
        );

        return $rdata;
    }

    public function edit() {
        $start = new DateTime($this->input->post('start') . " 00:00:01");
        $finish = new DateTime($this->input->post('finish') . " 23:59:59");
        $this->load->helper('directory');
        $upload_config = array(
            'upload_path' => 'uploads/contents/' . date('Ymd') . '/',
            'allowed_types' => 'jpg|jpeg|png',
            'file_name' => time()
        );
        $this->load->library('upload', $upload_config);
        $dir_exist = true;
        if (!is_dir($upload_config['upload_path'])) {
            mkdir($upload_config['upload_path'], 0777, true);
            $dir_exist = false;
        }
        if ($this->upload->do_upload('thumbs')) {
            $data_cover = $this->upload->data();
            $img_cover = $upload_config['upload_path'] . $data_cover['file_name'];
        } else {
            $img_cover = $this->input->post('thumbs_hidden');
        }
        if ($this->input->post('product_id', TRUE)) {
            $prod = $this->db->get_where('stk_product', array('product_id' => $this->input->post('product_id')));
            if ($prod->num_rows() > 0) {
                $prod_row = $prod->first_row();
                $prod_id = $prod_row->product_id;
            } else {
                
            }
        } else {
            $prod_id = NULL;
        }
        $data = array(
            'title' => trim($this->input->post('title')),
            'short_desc' => $this->input->post('short_desc'),
            'long_desc' => $this->input->post('long_desc'),
            'links' => ($this->input->post('links', TRUE) ? $this->input->post('links') : NULL),
            'chk_promotion' => $this->input->post('chk_promotion'),
            'product_id' => $prod_id,
            'cat_id' => ($this->input->post('cat_id', TRUE) ? $this->input->post('cat_id') : NULL),
            'thumbs' => $img_cover,
            'start' => $start->getTimestamp(),
            'finish' => $finish->getTimestamp(),
            'sale' => trim($this->input->post('sale')),
            'sale_opt' => trim($this->input->post('sale_opt')),
            'chk_links' => ($this->input->post('chk_links', TRUE) ? 1 : 0),
            'long_time' => ($this->input->post('long_time', TRUE) ? 1 : 0),
            'position' => $this->input->post('position'),
            'disabled' => ($this->input->post('disabled', TRUE) ? 1 : 0),
            'updated_user' => $this->ion_auth->get_user_id(),
            'updated_at' => time()
        );
        $this->db->trans_start();
        $this->db->update('product_promotion', $data, array('id' => $this->input->post('id')));
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
                'redirect' => 'contents/backend/contents/edit/' . $this->input->post('id'),
                'message' => 'Save data success.'
            );
        }

        return $rdata;
    }

    public function delete() {
        $this->db->trans_start();
        $this->db->update('product_promotion', array('deleted_at' => 1, 'updated_user' => $this->ion_auth->get_user_id(), 'updated_at' => time()), array('id' => $this->uri->segment(5)));
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
                'redirect' => 'contents/backend/promotion',
                'message' => 'Save data success.'
            );
        }

        return $rdata;
    }

    public function get_promotion($type = 1, $limit = NULL) {
        $this->db->select('*');
        $this->db->from('product_promotion');
        $this->db->where('disabled', 1);
        $this->db->where('deleted_at', 0);
        $this->db->where('start <=', time());
        $this->db->where('finish >=', time());
        $this->db->where('position', $type);
        if ($limit != NULL) {
            $this->db->limit($limit);
        }
        $query = $this->db->get();
        return $query;
    }

}
