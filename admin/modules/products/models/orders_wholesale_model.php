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
class Orders_wholesale_model extends CI_Model {

    function get_listall() {
        $this->load->helper('products/useful');
        $this->load->helper('users/useful');
        $this->load->library('datatables');
        $this->datatables->select(''
                . 'orders.id as order_id, '
                . 'orders.orders_code as orders_code, '
                . 'users.company as company, '
                . 'orders.order_counter as order_counter, '
                . 'orders.sum_price as sum_price, '
                . 'shipping_item.title as shipping, '
                . 'orders.user_id_ref as seller_id, '
                . 'orders.created_at as created_at, '
                . 'orders.status as status'
                . '');
        $this->datatables->from('orders');
        $this->datatables->join('users', 'users.id=orders.user_id', 'inner');
        $this->datatables->join('shipping_item', 'shipping_item.id=orders.shipping_id', 'inner');
//        $this->datatables->join('orders_status_log', 'orders_status_log.order_id=orders.id', 'left');
        $this->datatables->where('orders.user_branch_id_ref', $this->ion_auth->get_user_id());
        if ($this->input->post('ord_from', TRUE)) {
            $date = new DateTime($this->input->post('ord_from') . " 00:00:01");
            $this->datatables->where('orders.created_at >=', $date->getTimestamp());
        }
        if ($this->input->post('ord_to', TRUE)) {
            $date2 = new DateTime($this->input->post('ord_to') . " 24:59:59");
            $this->datatables->where('orders.created_at <=', $date2->getTimestamp());
        }
        if ($this->input->post('order_status', TRUE)) {
            $this->datatables->where('orders.status', $this->input->post('order_status'));
        }

        $this->datatables->edit_column('seller_id', '$1', 'get_seller_action(order_id)');
        $this->datatables->edit_column('sum_price', '$1', 'number_format(sum_price)');
        $this->datatables->edit_column('status', '$1', 'check_status_orders_wholesale(status,order_id)');

        $link = "<div class=\"dropdown\">";
        $link .= "<a class=\"dropdown-toggle\" data-toggle=\"dropdown\" href=\"javascript:;\"><span class=\"fa fa-pencil-square-o\"></span ></a>";
        $link .= "<ul class=\"dropdown-menu\" role=\"menu\" aria-labelledby=\"dLabel\">";
        $link .= "<li><a href=\"" . base_url() . index_page() . "products/backend/order/view/$1\" target=\"_blank\">แสดงรายละเอียด</a></li>";
        $link .= "<li><a href=\"javascript:;\" id=\"btnCancel\">ยกเลิกรายการ</a></li>";
        $link .= "</ul>";
        $link .= "</div>";
        $this->datatables->edit_column('order_id', $link, 'order_id');
        $this->datatables->edit_column('seller_id', '$1', 'get_seller_action(order_id)');
        $this->datatables->edit_column('created_at', '$1', 'get_datethai(created_at,2)');

        return $this->datatables->generate();
    }

    public function get_orders_product($param) {
        $this->db->select('*');
        $this->db->from('orders_desc');
        $this->db->join('stk_product', 'stk_product.product_id=orders_desc.product_id', 'inner');
        $this->db->join('cms_content', 'cms_content.cnt_id=stk_product.cnt_id');
        $this->db->where('orders_desc.orders_id', $param);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    public function get_file_slip($param) {
        $query = $this->db->get_where('payment_transfer', array('order_id' => $param));
        if ($query->num_rows() > 0) {
            $row = $query->first_row();
            return $row->slip;
        } else {
            return false;
        }
    }

}
