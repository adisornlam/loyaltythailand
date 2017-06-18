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
class Orders_dealer_model extends CI_Model {

    function get_listall() {
        $this->load->helper('products/useful');
        $this->load->helper('users/useful');
        $this->load->library('datatables');

        $this->datatables->select(''
                . 'orders.id as order_id, '
                . 'orders.orders_code as orders_code, '
                . 'orders.sum_price as sum_price, '
                . 'shipping_item.title as shipping, '
                . 'orders.created_at as created_at, '
                . 'orders.user_id_ref as seller_id, '
                . 'orders.status as status'
                . '');
        $this->datatables->from('orders');
        $this->datatables->join('shipping_item', 'shipping_item.id=orders.shipping_id', 'inner');
        $this->datatables->where('orders.user_id', $this->ion_auth->get_user_id());
        $this->datatables->where('orders.sum_price !=', 0);
        if ($this->input->post('ord_from', TRUE)) {
            $date = new DateTime($this->input->post('ord_from') . " 00:00:01");
            $this->datatables->where('orders.created_at >=', (int) $date->getTimestamp());
        }
        if ($this->input->post('ord_to', TRUE)) {
            $date2 = new DateTime($this->input->post('ord_to') . " 24:59:59");
            $this->datatables->where('orders.created_at <=', (int) $date2->getTimestamp());
        }
        if ($this->input->post('order_status', TRUE)) {
            $this->datatables->where('orders.status', $this->input->post('order_status'));
        }
        $this->datatables->unset_column('user_id_ref');
        $this->datatables->edit_column('sum_price', '$1', 'number_format(sum_price)');
        $this->datatables->edit_column('disabled', '$1', 'check_disabled(disabled,1)');
        $this->datatables->edit_column('status', '$1', 'check_status_orders(status,order_id)');

        $link = "<div class=\"dropdown\">";
        $link .= "<a class=\"dropdown-toggle\" data-toggle=\"dropdown\" href=\"javascript:;\"><span class=\"fa fa-pencil-square-o\"></span ></a>";
        $link .= "<ul class=\"dropdown-menu\" role=\"menu\" aria-labelledby=\"dLabel\">";
        $link .= "<li><a href=\"" . base_url() . index_page() . "products/order/view/$1\">ดูรายละเอียด</a></li>";
        $link .= "<li><a href=\"javascript:;\" rel=\"products/order/order_cancel/$1\" class=\"link_dialog\" title=\"ยกเลิกรายการสั่งซื้อ\">ยกเลิกรายการ</a></li>";
        $link .= "</ul>";
        $link .= "</div>";
        $this->datatables->edit_column('order_id', $link, 'order_id');
        $this->datatables->edit_column('seller_id', '$1', 'get_full_name(seller_id)');
        $this->datatables->edit_column('created_at', '$1', 'get_datethai(created_at,2)');

        return $this->datatables->generate();
    }

    public function get_view($param) {
        $this->db->select(''
                . 'orders.id as order_id,'
                . 'orders.orders_code,'
                . 'users.id as user_id,'
                . 'orders.shipping_id,'
                . 'orders.address_id,'
                . 'orders.payment_id,'
                . 'orders.tax_1,'
                . 'orders.tax_2,'
                . 'orders.total_price,'
                . 'orders.sum_price,'
                . 'orders.order_expire,'
                . 'orders.remark,'
                . 'orders.created_at,'
                . 'orders.updated_at,'
                . 'orders.status,'
                . 'users.first_name,'
                . 'users.last_name,'
                . 'users.phone,'
                . 'users.address,'
                . 'users.province,'
                . 'users.amphur,'
                . 'users.district,'
                . 'users.zipcode, '
                . 'payment_transfer.slip, '
                . 'payment_transfer.created_at as payment_created'
                . '');
        $this->db->from('orders');
        $this->db->join('users', 'users.id=orders.user_id', 'inner');
        $this->db->join('payment_transfer', 'payment_transfer.order_id=orders.id', 'left');
        $this->db->where('orders.id', $param);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return array();
        }
    }    

    public function get_orders($param) {
        $query = $this->db->get_where('orders', array('id' => $param));
        if ($query->num_rows() > 0) {
            $row = $query->first_row();
        } else {
            $row = NULL;
        }
        return $row;
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

    public function order_cancel() {
        $this->load->model('products/Orders_model');
        $this->load->model('products/Products_dealer_model');

        $parent_id = $this->Ion_auth_model->get_group_id($this->ion_auth->get_user_id());
        $this->db->update('orders', array('status' => 'canceled', 'updated_at' => time()), array('id' => $this->input->post('order_id')));

        $this->db->insert('orders_status_log', array('order_id' => $this->input->post('order_id'), 'status' => 'canceled', 'user_id' => $this->ion_auth->get_user_id(), 'remark' => $this->input->post('remark'), 'created_at' => time()));

        if ($this->input->post('notice', TRUE)) {
            $data4 = array(
                'type' => 'notice',
                'pk_id' => $this->input->post('order_id'),
                'user_id' => $this->ion_auth->get_user_id(),
                'assign' => array($parent_id),
                'title' => 'มีการยกเลิกรายการสั่งซื้อ',
                'module' => 'products',
                'url' => 'products/backend/order/view/' . $this->input->post('order_id')
            );
            $this->Common_model->set_notifications($data4);
        }


        $rdata = array(
            'status' => TRUE,
            'redirect' => 'products/order',
            'message' => 'Save data success.'
        );
        return $rdata;
    }

    public function get_order_status() {
        $parent_id = $this->Ion_auth_model->get_group_id($this->ion_auth->get_user_id());
        $this->db->select('*');
        $this->db->from('orders_status');
        $this->db->where('user_id', $parent_id);
        $this->db->where('disabled', 0);
        $query1 = $this->db->get();

        $arr_cat = array(
            '' => 'สถานะสั่งซื้อ'
        );
        foreach ($query1->result() as $val) {
            $arr_cat[$val->name] = $val->title;
        }

        return $arr_cat;
    }

}
