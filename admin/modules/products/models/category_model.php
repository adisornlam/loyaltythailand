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
class Category_model extends CI_Model {

    function get_listall() {
        $this->load->library('datatables');
        $this->load->helper('products/useful');

        $id = ($this->uri->segment(5) ? $this->uri->segment(5) : 0);

        $this->datatables->select(''
                . 'cat_id, '
                . 'cat_title, '
                . 'cat_title_en, '
                . 'cat_description, '
                . 'cat_front, '
                . 'cat_disabled'
                . '');
        $this->datatables->from('categories');
        $this->datatables->join('category_hierarchy', 'category_hierarchy.cath_category_id=categories.cat_id', 'inner');
        $this->datatables->where('category_hierarchy.cath_category_parent_id', $id);
        $this->datatables->edit_column('cat_title', '<a href="' . base_Url() . index_page() . 'products/backend/category/sub/$1">$2</a>', 'cat_id,cat_title');
        $this->datatables->edit_column('options', '$1', 'check_option(cat_id)');
        $link = "<div class=\"dropdown\">";
        $link .= "<a class=\"dropdown-toggle\" data-toggle=\"dropdown\" href=\"javascript:;\"><span class=\"fa fa-pencil-square-o\"></span ></a>";
        $link .= "<ul class=\"dropdown-menu\" role=\"menu\" aria-labelledby=\"dLabel\">";
        $link .= "<li><a href=\"javascript:;\" rel=\"products/backend/category/edit/" . $id . "/$1\" class=\"link_dialog\" title=\"Edit Details\">Edit Details</a></li>";
        $link .= "<li><a href=\"javascript:;\" rel=\"products/backend/category/move/$1\" class=\"link_dialog\" title=\"Move Category\">Move Category</a></li>";
        $link .= "<li><a href=\"javascript:;\" rel=\"products/backend/result_category/delete/$1\" class=\"link_dialog delete\" title=\"Delete Category\">Delete Category</a></li>";
        $link .= "</ul>";
        $link .= "</div>";
        $this->datatables->edit_column('cat_id', $link, 'cat_id');
        $this->datatables->edit_column('cat_front', '$1', 'check_disabled(cat_front)');
        $this->datatables->edit_column('cat_disabled', '$1', 'check_disabled(cat_disabled)');
        return $this->datatables->generate();
    }

    public function get_count_category_sub($param) {
        $this->db->select('*');
        $this->db->from('categories');
        $this->db->join('category_hierarchy', 'category_hierarchy.cath_category_id=categories.cat_id');
        $this->db->where('category_hierarchy.cath_category_parent_id', $param);
        $query = $this->db->get();
        return $query->num_rows();
    }

    function get_name($param) {
        $query = $this->db->get_where('categories', array('cat_id' => $param));
        return $query->first_row->cat_title;
    }

    public function get_category_root() {
        $this->db->select('*');
        $this->db->from('categories');
        $this->db->join('category_hierarchy', 'category_hierarchy.cath_category_id=categories.cat_id');
        $this->db->where('category_hierarchy.cath_category_parent_id', 0);
        $query1 = $this->db->get();

        $arr_cat = array(
            '' => 'Please select'
        );
        foreach ($query1->result() as $val) {
            $arr_cat[$val->cat_id] = $val->cat_title;
        }

        return $arr_cat;
    }

    public function get_stk_category() {
        $this->db->select('*');
        $this->db->from('stk_category');
        $this->db->where('cat_parent', 0);
        $this->db->or_where('cat_parent', NULL);
        $this->db->where('cat_active', 'Y');
        $this->db->order_by('cat_order');
        $query1 = $this->db->get();
        foreach ($query1->result() as $val) {
            $arr_cat[$val->cat_id] = $val->cat_name;
        }

        return $arr_cat;
    }

    public function get_stk_category_sub($id) {
        $this->db->select('*');
        $this->db->from('stk_category');
        $this->db->where('cat_parent', $id);
        $this->db->where('cat_active', 'Y');
        $this->db->order_by('cat_order');
        $query1 = $this->db->get();
        foreach ($query1->result() as $val) {
            $arr_cat[$val->cat_id] = $val->cat_name;
        }

        return $arr_cat;
    }

    function get_category() {
        $this->db->select('*');
        $this->db->from('categories');
        $this->db->join('category_hierarchy', 'category_hierarchy.cath_category_id=categories.cat_id');
        $this->db->where('category_hierarchy.cath_category_parent_id', 0);
        $query1 = $this->db->get();

        foreach ($query1->result() as $val) {
            $arr_cat[$val->cat_id] = $val->cat_title;
        }

        return $arr_cat;
    }

    public function get_sub($id) {
        $this->db->select('categories.id, categories.title');
        $this->db->from('categories');
        $this->db->join('category_hierarchy', 'category_hierarchy.category_id=categories.id');
        $this->db->where('category_hierarchy.category_parent_id', $id);
        $query = $this->db->get();
        foreach ($query->result() as $val) {
            $arr_cat[$val->id] = $val->title;
        }

        return $arr_cat;
    }

    public function get_sub_id($param) {
        $this->db->select('category_hierarchy.category_parent_id');
        $this->db->from('categories');
        $this->db->join('category_hierarchy', 'category_hierarchy.category_id=categories.id');
        $this->db->where('categories.id', $param);
        $query = $this->db->get();
        $row = $query->first_row();
        return $row->category_parent_id;
    }

    public function get_edit($id) {
        $query = $this->db->get_where('categories', array('cat_id' => $id));
        return $query->result();
    }

    public function get_option_category($id) {
        $this->db->select('group_id');
        $this->db->from('product_option_category');
        $this->db->where('category_id', $id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $data = $query->result();
        } else {
            $data = null;
        }
        return $data;
    }

    function add() {
        $data = array(
            'cat_code' => $this->input->post('cat_code'),
            'cat_type' => 'product',
            'cat_title' => $this->input->post('cat_title'),
            'cat_title_en' => $this->input->post('cat_title_en'),
            'cat_description' => $this->input->post('cat_description'),
            'cat_disabled' => ($this->input->post('cat_disabled', TRUE) ? 0 : 1)
        );
        $this->db->trans_start();
        $this->db->insert('categories', $data);
        $this->db->insert('category_hierarchy', array('cath_category_id' => $this->db->insert_id(), 'cath_category_parent_id' => ($this->input->post('cat_id', TRUE) !== '' ? $this->input->post('cat_id') : 0)));

        if ($this->input->post('group_id')) {
            foreach ($this->input->post('group_id') as $item) {
                $this->db->insert('product_option_category', array('group_id' => $item, 'category_id' => $this->db->insert_id()));
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
                'redirect' => 'products/backend/category' . ($this->input->post('cat_id', TRUE) ? '/sub/' . $this->input->post('cat_id', TRUE) : ''),
                'message' => 'Save data success.'
            );
        }

        return $rdata;
    }

    function edit() {
        $data = array(
            'cat_code' => $this->input->post('cat_code'),
            'cat_type' => 'product',
            'cat_title' => $this->input->post('cat_title'),
            'cat_title_en' => $this->input->post('cat_title_en'),
            'cat_description' => $this->input->post('cat_description'),
            'cat_front' => ($this->input->post('cat_front', TRUE) ? 0 : 1),
            'cat_disabled' => ($this->input->post('cat_disabled', TRUE) ? 0 : 1)
        );

        $this->db->trans_start();
        $this->db->where('cat_id', $this->input->post('cat_id'));
        $this->db->update('categories', $data);

        if ($this->db->get_where('product_option_category', array('category_id' => $this->input->post('cat_id')))->num_rows() > 0) {
            $this->db->delete('product_option_category', array('category_id' => $this->input->post('cat_id')));
        }
        if ($this->input->post('group_id')) {
            foreach ($this->input->post('group_id') as $item) {
                $this->db->insert('product_option_category', array('group_id' => $item, 'category_id' => $this->input->post('cat_id')));
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
                'redirect' => 'products/backend/category' . ($this->input->post('cat_parent_id', TRUE) ? '/sub/' . $this->input->post('cat_parent_id', TRUE) : ''),
                'message' => 'Save data success.'
            );
        }

        return $rdata;
    }

    function move() {
        $this->db->trans_start();
        $this->db->delete('category_hierarchy', array('cath_category_id' => $this->input->post('cat_id')));
        $this->db->insert('category_hierarchy', array('cath_category_id' => $this->input->post('cat_id'), 'cath_category_parent_id' => $this->input->post('new_cat_id')));
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
                'redirect' => 'products/backend/category' . ($this->input->post('new_cat_id', TRUE) ? '/sub/' . $this->input->post('new_cat_id', TRUE) : ''),
                'message' => 'Save data success.'
            );
        }

        return $rdata;
    }

    public function delete() {
        $this->db->trans_start();
        $this->db->delete('categories', array('cat_id' => $this->uri->segment(5)));
        $this->db->delete('category_hierarchy', array('cath_category_id' => $this->uri->segment(5)));
        $this->db->delete('category_hierarchy', array('cath_category_parent_id' => $this->uri->segment(5)));
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
                'redirect' => 'products/backend/category',
                'message' => 'Save data success.'
            );
        }

        return $rdata;
    }

    public function gen_breadcrumb($param) {
        $this->db->select('categories.cat_id, categories.cat_title');
        $this->db->from('category_hierarchy');
        $this->db->join('categories', 'categories.cat_id=category_hierarchy.cath_category_id');
        $this->db->where('category_hierarchy.cath_category_id', $param);
        $query = $this->db->get();
        foreach ($query->result() as $item) {
            $data[] = array(
                $item->cat_title => 'products/backend/category'
            );
        }
    }

    public function get_stk_category_arr($param) {
        $query = $this->db->get_where('stk_category', array('cat_id' => $param));
        $row = $query->first_row();
        $arr = array(
            'id' => $row->cat_id,
            'cat_parent' => $row->cat_parent,
            'cat_name' => $row->cat_name
        );
        return $arr;
    }

    public function get_breadcrumb_view($param) {
        $this->db->select(''
                . 'stk_product.cat_id,'
                . 'cms_content.cnt_title,'
                . 'stk_category.cat_name '
                . '');
        $this->db->from('stk_product');
        $this->db->join('cms_content', 'cms_content.cnt_id=stk_product.cnt_id');
        $this->db->join('stk_category', 'stk_category.cat_id=stk_product.cat_id');
        $this->db->where('stk_product.product_id', $param);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $row = $query->first_row();
            $cat = $this->get_stk_category_arr($row->cat_id);
            $cat1 = $this->get_stk_category_arr($cat['cat_parent']);
            $data = array(
                'สินค้าทั้งหมด' => 'products',
                $cat1['cat_name'] => 'products/search?category_id=' . $cat['cat_parent'] . '&sub=1',
                $cat['cat_name'] => 'products/search?category_id=' . $row->cat_id,
                $row->cnt_title => '#'
            );
        }
        return $data;
    }

    public function get_breadcrumb_cat($param) {
        if ($this->input->get('sub') == 1) {
            $query_root = $this->db->get_where('stk_category', array('cat_id' => $param));
            if ($query_root->num_rows() > 0) {
                $row_root = $query_root->first_row();
                $data = array(
                    'สินค้าทั้งหมด' => 'products',
                    $row_root->cat_name => '#',
                );
            } else {
                $data = NULL;
            }
        } else {
            $query_sub1 = $this->db->get_where('stk_category', array('cat_id' => $param));
            if ($query_sub1->num_rows() > 0) {
                $row_sub1 = $query_sub1->first_row();

                $query_root = $this->db->get_where('stk_category', array('cat_id' => $row_sub1->cat_parent));
                $row_root = $query_root->first_row();
                $data = array(
                    'สินค้าทั้งหมด' => 'products',
                    $row_root->cat_name => 'products/search?category_id=' . $row_root->cat_id . '&sub=1',
                    $row_sub1->cat_name => '#'
                );
            } else {
                $data = NULL;
            }
        }

        return $data;
    }

}
