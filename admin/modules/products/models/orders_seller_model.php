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
class Orders_seller_model extends CI_Model {

    function get_listall() {
        $this->load->helper('products/useful');
        $this->load->helper('users/useful');
        $this->load->library('datatables');
        $parent_id = $this->Ion_auth_model->get_group_id($this->ion_auth->get_user_id());

        $this->datatables->select(''
                . 'orders.id as order_id, '
                . 'users.id as user_id, '
                . 'orders.orders_code as orders_code, '
                . 'users.company as company, '
                . 'orders.sum_price as sum_price, '
                . 'shipping_item.title as shipping, '
                . 'orders.created_at as created_at, '
                . 'orders.status as status, '
                . 'users.first_name as first_name, '
                . 'users.last_name as last_name'
                . '');
        $this->datatables->from('orders');
        $this->datatables->join('users', 'users.id=orders.user_id', 'inner');
        $this->datatables->join('shipping_item', 'shipping_item.id=orders.shipping_id', 'inner');
        $this->datatables->where('orders.user_id_ref', $parent_id);
        $this->datatables->where('orders.sum_price !=', 0);
        if ($this->input->post('txtSearch', TRUE)) {
            $array = array(
                'orders.orders_code' => $this->input->post('txtSearch'),
                'users.company' => $this->input->post('txtSearch'),
            );
            $this->datatables->like($array, NULL, FALSE);
        }
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
        $this->datatables->unset_column('user_id');
        $this->datatables->unset_column('last_name');
        $this->datatables->edit_column('first_name', '<a href="javascript:;" rel="users/backend/user/view/$3" class="link_dialog" title="ข้อมูลลูกค้า">$1 $2</a>', 'first_name, last_name, user_id');
        $this->datatables->edit_column('sum_price', '$1', 'number_format(sum_price)');
        $this->datatables->edit_column('company', '$1', 'check_dealer_label(user_id)');
        $this->datatables->edit_column('status', '$1', 'check_status_orders_wholesale(status,order_id)');

        $link = "<div class=\"dropdown\">";
        $link .= "<a class=\"dropdown-toggle\" data-toggle=\"dropdown\" href=\"javascript:;\"><span class=\"fa fa-pencil-square-o\"></span ></a>";
        $link .= "<ul class=\"dropdown-menu\" role=\"menu\" aria-labelledby=\"dLabel\">";
        $link .= "<li><a href=\"" . base_url() . index_page() . "products/backend/order/view/$1\" target=\"_blank\">ดูรายละเอียด</a></li>";
        $link .= "<li><a href=\"javascript:;\" rel=\"products/backend/order/change_status/$1\" class=\"link_dialog\" id=\"btnCancel\" title=\"เปลี่ยนสถานะ\">เปลี่ยนสถานะ</a></li>";
        $link .= "</ul>";
        $link .= "</div>";
        $this->datatables->edit_column('order_id', $link, 'order_id');
        $this->datatables->edit_column('created_at', '$1', 'get_datethai(created_at,2)');

        return $this->datatables->generate();
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
            $arr_cat[$val->name] = $val->title2;
        }

        return $arr_cat;
    }

    public function change_status() {
        $this->load->model('products/Orders_model');
        $this->load->model('products/Products_dealer_model');

        $parent_id = $this->Ion_auth_model->get_group_id($this->ion_auth->get_user_id());

        $this->db->update('orders', array('status' => $this->input->post('status_id'), 'updated_at' => time()), array('id' => $this->input->post('order_id')));

        $this->Products_dealer_model->set_product_dealer($this->input->post('order_id'));

        $this->db->insert('orders_status_log', array('order_id' => $this->input->post('order_id'), 'status' => $this->input->post('status_id'), 'user_id' => $this->ion_auth->get_user_id(), 'remark' => $this->input->post('remark'), 'created_at' => time()));
        $rs = $this->Orders_model->get_view($this->input->post('order_id'));

        if ($this->input->post('notice', TRUE)) {
            $ass = array($rs->user_id, $parent_id);
        } else {
            $ass = array($parent_id);
        }
        $data4 = array(
            'type' => 'notice',
            'pk_id' => $this->input->post('order_id'),
            'user_id' => $this->ion_auth->get_user_id(),
            'assign' => $ass,
            'title' => 'มีรายการแจ้งเตือนใหม่',
            'module' => 'products',
            'url' => 'products/order/view/' . $this->input->post('order_id')
        );
        $this->Common_model->set_notifications($data4);

        $rdata = array(
            'status' => TRUE,
            'redirect' => 'products/backend/order/view/' . $this->input->post('order_id'),
            'message' => 'Save data success.'
        );
        return $rdata;
    }

}
