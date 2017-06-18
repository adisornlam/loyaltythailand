<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 *  @Auther : Adisorn Lamsombuth
 *  @Email : postyim@gmail.com
 *  @Website : esabay.com 
 */

/**
 * Description of options_model
 *
 * @author R-D-6
 */
class Options_model extends CI_Model {

    public function get_title_group($param) {
        $query = $this->db->get_where('product_option_group', array('id' => $param));
        return $query->first_row()->title;
    }

    public function get_option_select($param) {
        $this->db->distinct();
        $this->db->select('product_option_group.id');
        $this->db->from('product_option_group');
        $this->db->join('product_option_category', 'product_option_category.group_id=product_option_group.id');
        $this->db->join('categories', 'categories.cat_id=product_option_category.category_id');
        $this->db->where('categories.cat_code', $param);
        $this->db->where('product_option_group.disabled', 0);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $data = $query->result();
        } else {
            $data = null;
        }
        return $data;
    }

    public function get_option_select_html($param, $val = array()) {

        $this->db->select('product_option_item.id,product_option_item.title');
        $this->db->from('product_option_item');
        $this->db->join('product_option_group', 'product_option_group.id=product_option_item.group_id');
        $this->db->where('product_option_item.group_id', $param);
        $this->db->where('product_option_group.disabled', 0);

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $options = array(
                '' => 'Please select.'
            );
            foreach ($query->result() as $item) {
                $options[$item->id] = $item->title;
            }
            $str = "<div class=\"form-group\">";
            $str .= "<label for=\"cat_id\" class=\"col-sm-2 control-label\">" . $this->get_title_group($param) . "</label>";
            $str .= "<div class=\"col-sm-4\">";
            if (in_array($param, array_keys($val))) {

                $str .= form_dropdown('option_id[]', $options, $val[$param], 'class="form-control" id="option_id"');
            } else {
                $str .= form_dropdown('option_id[]', $options, NULL, 'class="form-control" id="option_id"');
            }
            $str .= "</div>";
            $str .= "</div>";
        } else {
            $str = NULL;
        }


        return $str;
    }

    function get_listall() {
        $this->load->library('datatables');
        $this->load->helper('products/useful');

        $this->datatables->select(''
                . 'product_option_item.id as option_id, '
                . 'product_option_item.title as option_title, '
                . 'product_option_group.title as group_title, '
                . 'product_option_group.title2 as group_title2, '
                . 'product_option_item.disabled as option_disabled'
                . '');
        $this->datatables->from('product_option_item');
        $this->datatables->join('product_option_group', 'product_option_group.id = product_option_item.group_id', 'inner');
        $link = "<div class=\"dropdown\">";
        $link .= "<a class=\"dropdown-toggle\" data-toggle=\"dropdown\" href=\"javascript:;\"><span class=\"fa fa-pencil-square-o\"></span ></a>";
        $link .= "<ul class=\"dropdown-menu\" role=\"menu\" aria-labelledby=\"dLabel\">";
        $link .= "<li><a href=\"javascript:;\" rel=\"products/backend/options/edit/$1\" class=\"link_dialog\" title=\"Edit Option\">Edit Option</a></li>";
        $link .= "<li><a href=\"javascript:;\" rel=\"products/backend/result_options/delete/$1\" clss=\"link_dialog\" title=\"Delete Option\">Delete Option</a></li>";
        $link .= "</ul>";
        $link .= "</div>";
        $this->datatables->unset_column('group_title2');
        $this->datatables->add_column('option_id', $link, 'option_id');
        $this->datatables->edit_column('option_disabled', '$1', 'check_disabled(option_disabled,0)');
        $this->datatables->edit_column('group_title', '$1 ($2)', 'group_title,group_title2');
        return $this->datatables->generate();
    }

    function group() {

        $this->db->select('*');
        $this->db->from('product_option_group');
        $query = $this->db->get();

        return $query->result();
    }

    public function get_group() {
        $this->db->order_by('title', 'asc');
        $query = $this->db->get('product_option_group');

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return array();
        }
    }

    //@param = product_id
    public function get_option($param) {
        $query = $this->db->get_where('product_ref_option', array('product_id' => $param));
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return array();
        }
    }

    function add() {
        $data = array(
            'group_id' => $this->input->post('group_id'),
            'title' => $this->input->post('title'),
            'disabled' => ($this->input->post('disabled', TRUE) ? 0 : 1),
            'created_at' => date('Y-m-d h:i:s'),
            'updated_at' => date('Y-m-d h:i:s')
        );
        $this->db->trans_start();
        $this->db->insert('product_option_item', $data);
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
                'redirect' => 'products/backend/options',
                'message' => 'Save data success.'
            );
        }
        return $rdata;
    }

    public function get_edit($param) {
        $query = $this->db->get_where('product_option_item', array('id' => $param));
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return array();
        }
    }

    function edit() {
        $data = array(
            'group_id' => $this->input->post('group_id'),
            'title' => $this->input->post('title'),
            'disabled' => ($this->input->post('disabled', TRUE) ? 0 : 1),
            'updated_at' => date('Y-m-d h:i:s')
        );
        $this->db->trans_start();
        $this->db->where('id', $this->input->post('id'));
        $this->db->update('product_option_item', $data);
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
                'redirect' => 'products/backend/options',
                'message' => 'Save data success.'
            );
        }

        return $rdata;
    }

    public function delete() {
        $this->db->trans_start();
        $this->db->delete('product_option_item', array('id' => $this->input->get('id')));
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
                'redirect' => 'products/backend/options',
                'message' => 'Save data success.'
            );
        }

        return $rdata;
    }

    function group_add() {
        $this->load->helper('date');
        $data = array(
            'name' => $this->input->post('name'),
            'title' => $this->input->post('title'),
            'title2' => $this->input->post('title2'),
            'disabled' => ($this->input->post('disabled', TRUE) ? 0 : 1),
            'created_at' => date('Y-m-d h:i:s'),
            'updated_at' => date('Y-m-d h:i:s')
        );
        $this->db->trans_start();
        $this->db->insert('product_option_group', $data);
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
                'redirect' => 'products/backend/options',
                'message' => 'Save data success.'
            );
        }
        return $rdata;
    }

    public function get_group_edit($param) {
        $query = $this->db->get_where('product_option_group', array('id' => $param));
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return array();
        }
    }

    function group_edit() {
        $data = array(
            'name' => $this->input->post('name'),
            'title' => $this->input->post('title'),
            'title2' => $this->input->post('title2'),
            'disabled' => ($this->input->post('disabled', TRUE) ? 0 : 1),
            'updated_at' => date('Y-m-d h:i:s')
        );
        $this->db->trans_start();
        $this->db->where('id', $this->input->post('id'));
        $this->db->update('product_option_group', $data);
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
                'redirect' => 'products/backend/options/group',
                'message' => 'Save data success.'
            );
        }

        return $rdata;
    }

    public function group_delete() {
        $this->db->trans_start();
        $this->db->delete('product_option_group', array('id' => $this->input->get('id')));
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
                'redirect' => 'products/backend/options',
                'message' => 'Save data success.'
            );
        }

        return $rdata;
    }

}
