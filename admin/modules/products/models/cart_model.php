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
class Cart_model extends CI_Model {

    public function add() {
        $this->load->helper('products/useful');
        $this->db->select(''
                . 'stk_product.product_id,'
                . 'stk_product.product_code,'
                . 'stk_product.price_1,'
                . 'stk_product.price_5,'
                . 'stk_product.stock_qty,'
                . 'cms_content.cnt_title'
                . '');
        $this->db->from('stk_product');
        $this->db->join('cms_content', 'cms_content.cnt_id=stk_product.cnt_id', 'inner');
        $this->db->join('product_sale', 'product_sale.product_id=stk_product.product_id', 'inner');
        $this->db->where('stk_product.product_id', $this->input->post('product_id'));
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $row = $query->first_row();
            $qty = ($this->input->post('qty') ? $this->input->post('qty') : 1);
            $price = get_price_dealer($row->product_id, 1);
            if ($price > 0) {
                $data = array(
                    'id' => $row->product_id,
                    'qty' => $qty,
                    'price' => $price,
                    'name' => $row->cnt_title,
                    'options' => array('code' => $row->product_code, 'stock' => $row->stock_qty)
                );
                if ($this->cart->insert($data)) {
                    $rows = count($this->cart->contents());
                    echo json_encode(array('status' => TRUE, 'total' => $rows));
                } else {
                    echo json_encode(array('status' => FALSE));
                }
            } else {
                echo json_encode(array('status' => FALSE, 'message' => 'สินค้าชิ้นนี้ยังไม่กำหนดราคา ถ้าลูกค้าต้องการซื้อ กรุณาติดต่อฝ่ายขาย ขอบคุณค่ะ'));
            }
        } else {
            echo json_encode(array('status' => FALSE));
        }
    }

    public function update() {
        $data = array(
            'rowid' => $this->input->post('rowid'),
            'qty' => $this->input->post('qty')
        );
        $this->cart->update($data);
        $rows = count($this->cart->contents());
        echo json_encode(array('status' => TRUE, 'total' => $rows));
    }

    public function delete() {
        $data = array(
            'rowid' => $this->input->post('rowid'),
            'qty' => 0
        );
        $this->cart->update($data);
        $rows = count($this->cart->contents());
        echo json_encode(array('status' => TRUE, 'total' => $rows));
    }

    public function get_cal_shipping_kerry($weight = 0, $status = 0) {
        /*
         * @param $weight int
         * @param $status int
         * @return int
         * update : 01-01-2014
         */

        $bk_2 = 80;
        $upc_2 = 90;

        $bk_5 = 110;
        $upc_5 = 120;
        $plus_per_kg = 15;
        $weight += 500;
        if ($weight > 5000) {
            $w = ($weight / 1000) - 5;
            $x = round($w, 0, PHP_ROUND_HALF_UP) * $plus_per_kg;
            $y = ($status >= 1 ? $bk_5 + $x : $upc_5 + $x);
        } elseif ($weight <= 2000) {
            $y = ($status >= 1 ? $bk_2 : $upc_2);
        } elseif ($weight <= 5000) {
            $y = ($status >= 1 ? $bk_5 : $upc_5);
        } else {
            $y = 0;
        }
        return $y;
    }

    public function get_shipping_type($id = 0) {
        $this->load->model('users/Users_dealer_model');
        $this->load->model('users/Users_model');
        $ac = $this->Users_dealer_model->get_greater_dealer($id);
        $group_id = $this->Users_model->get_user_parent($this->ion_auth->get_user_id());
        $this->db->select('*');
        $this->db->from('shipping_item');
        $this->db->where('user_id', $group_id);
        $this->db->where('active', 1);
        $query = $this->db->get();
        $arr = array();
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $arr[$row->id] = $row->title;
            }
        }
        return $arr;
    }

    public function get_payment_type() {
        $this->load->model('users/Users_model');
        $group_id = $this->Users_model->get_user_parent($this->ion_auth->get_user_id());

        $this->db->select('payment_type.id,payment_type.title');
        $this->db->from('payment_type');
        $this->db->join('payment_type_setting', 'payment_type_setting.payment_id=payment_type.id');
        $this->db->where('payment_type_setting.disabled', 1);
        $this->db->where('payment_type.active', 1);
        $this->db->where('payment_type_setting.user_id', $group_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $rs = $query->result();
        } else {
            $rs = array();
        }
        return $rs;
    }

    public function get_payment_item($id = 0) {
        $this->load->model('users/Users_model');
        //$group_id = $this->Users_model->get_user_parent($this->ion_auth->get_user_id());

        $this->db->select('*');
        $this->db->from('payment_item');
        $this->db->where('active', 1);
        $this->db->where('user_id', 21);
        if ($id != 0) {
            $this->db->where('id', $id);
        }
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $rs = $query->result();
        } else {
            $rs = array();
        }
        return $rs;
    }

    public function get_payment_list($id = 0) {
        $this->load->model('users/Users_model');
        $group_id = $this->Users_model->get_user_parent($this->ion_auth->get_user_id());

        $this->db->select('*');
        $this->db->from('payment_item');
        $this->db->where('active', 1);
        $this->db->where('user_id', $group_id);
        if ($id != 0) {
            $this->db->where('payment_id', $id);
        }
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $rs = $query->result();
        } else {
            $rs = array();
        }
        return $rs;
    }

    public function set_comfirm_order() {
        $this->load->library('pusher');
        $this->load->library('email');
        $this->load->helper('products/useful');
        $this->load->model('users/Users_dealer_model');
        $this->load->model('users/Users_model');
        $this->load->model('products/Orders_model');
        $this->load->model('settings/Shipping_model');

        $parent_id = $this->Ion_auth_model->get_group_id($this->ion_auth->get_user_id());
        $this->db->select('*');
        $this->db->from('orders');
        $this->db->where('user_branch_id_ref', $parent_id);
        $q_n = $this->db->get();
        $year = substr(date('Y') + 543, -2);
        if ($q_n->num_rows() > 0) {
            $this->db->select('order_counter');
            $this->db->from('orders');
            $this->db->order_by('order_counter', 'DESC');
            $this->db->limit(1);
            $query_count = $this->db->get();
            $row_count = $query_count->first_row();
            $n_order = $row_count->order_counter + 1;
            $c = $q_n->num_rows() + 1;
            $code = 'JW' . $year . date('md') . str_pad($c, 4, "0", STR_PAD_LEFT);
        } else {
            $n_order = 1;
            $code = 'JW' . $year . date('md') . str_pad(1, 4, "0", STR_PAD_LEFT);
        }
        $this->db->trans_start();
        $data = array(
            'orders_code' => $code,
            'user_id' => $this->ion_auth->get_user_id(),
            'address_id' => $this->input->get('address_id'),
            'tax_1' => $this->input->get('tax_1'),
            'tax_2' => $this->input->get('tax_2'),
            'shipping_id' => $this->input->get('shipping_id'),
            'payment_id' => $this->input->get('payment_id'),
            'total_price' => $this->cart->total(),
            'order_expire' => date('Y-m-d H:i:s', strtotime(' +3 day')),
            'order_counter' => $n_order,
            'user_id_ref' => ($this->input->get('seller_id') ? $this->input->get('seller_id') : $parent_id),
            'user_branch_id_ref' => $parent_id,
            'created_at' => time()
        );

        $this->db->insert('orders', $data);
        $order_id = $this->db->insert_id();
        foreach ($this->cart->contents() as $items):
            $data1 = array(
                'orders_id' => $order_id,
                'product_id' => $items['id'],
                'qty' => $items['qty'],
                'price' => $items['price'],
                'created_at' => date('Y-m-d H:i:s')
            );
            $this->db->insert('orders_desc', $data1);
        endforeach;
        $this->db->update('orders', array('sum_price' => $this->cart->total(), 'status' => 'pending'), array('id' => $order_id));
        $this->db->trans_complete();

        $arr_a = array($parent_id);
        foreach ($this->Users_model->get_seller() as $item) {
            $arr[] = $item->id;
        }
        $arr_m = array_merge($arr_a, $arr);
        $data3 = array(
            'type' => 'notice',
            'pk_id' => $order_id,
            'user_id' => $this->ion_auth->get_user_id(),
            'assign' => $arr_m,
            'title' => 'มีรายการสั่งซื้อใหม่',
            'module' => 'products',
            'icon' => 'fa fa-shopping-cart',
            'url' => 'products/backend/order/view/' . $order_id,
        );
        $this->Common_model->set_notifications($data3);

        if ($this->input->get('seller_id', TRUE)) {
            $this->pusher->trigger('my_channel_' . $this->input->get('seller_id'), 'my_event', array('message' => 'มีรายการสั่งซื้อใหม่ รหัสสั่งซื้อ:' . $code . '<br />ยอดสั่งซื้อ: ' . number_format($this->cart->total()) . ' บาท <a href="' . base_url() . index_page() . 'products/backend/order/view/' . $order_id . '">ดูรายการสั่งซื้อ</a>'));

            $this->pusher->trigger('my_channel_' . $parent_id, 'my_event', array('message' => 'มีรายการสั่งซื้อใหม่ รหัสสั่งซื้อ:' . $code . '<br />ยอดสั่งซื้อ: ' . number_format($this->cart->total()) . ' บาท <a href="' . base_url() . index_page() . 'products/backend/order/view/' . $order_id . '">ดูรายการสั่งซื้อ</a>'));
        } else {
            foreach ($arr_m as $value) {
                $this->pusher->trigger('my_channel_' . $value, 'my_event', array('message' => 'มีรายการสั่งซื้อใหม่ รหัสสั่งซื้อ:' . $code . '<br />ยอดสั่งซื้อ: ' . number_format($this->cart->total()) . ' บาท <a href="' . base_url() . index_page() . 'products/backend/order/view/' . $order_id . '">ดูรายการสั่งซื้อ</a>'));
            }
        }
        //Send Email   
        $rs = $this->Orders_model->get_view($order_id);
        $rs2 = $this->Orders_model->get_orders_product($order_id);

        $email_config = $this->Common_model->get_config_email();
        $this->email->initialize($email_config);
        $this->email->from('noreply@jib.co.th', 'JIB COMPUTER GROUP (WHOLESALE)');
        $this->email->to($this->ion_auth->user()->row()->email);
        $this->email->subject('New Order : JIB COMPUTER GROUP (WHOLESALE)');
        $data2 = array(
            'fullname' => $this->ion_auth->user()->row()->first_name . " " . $this->ion_auth->user()->row()->last_name,
            'order_code' => $code,
            'created_at' => get_datethai(time()),
            'total' => $this->cart->total(),
            'payment_item' => $this->get_payment_item($this->input->get('payment_id')),
            'link' => anchor('products/order/view/' . $order_id, 'คลิกที่นี่'),
            'long_desc' => $this->Contents_model->get_edit(13)->long_desc,
            'item' => $rs,
            'prod' => $rs2,
            'address_1' => $this->Users_model->get_address_dealer($rs->address_id, $rs->user_id),
            'tax_1' => ($rs->tax_1 == 1 ? 1 : 0),
            'tax_2' => $this->Users_model->get_tax_address($rs->tax_2),
            'order_status' => $this->Orders_model->get_orders_status_item($rs->status),
            'payment_item' => $this->get_payment_item($rs->payment_id),
            'shipping_item' => $this->Shipping_model->get_shipping_item($rs->shipping_id),
            'info_1' => $this->Contents_model->get_edit(15)->long_desc,
            'info_2' => $this->Contents_model->get_edit(16)->long_desc
        );
        $email = $this->load->view('products/email/notice_new_order', $data2, TRUE);
        $this->email->message($email);
        $this->email->send();

        $this->cart->destroy();
        $rdata = array(
            'status' => TRUE,
            'redirect' => 'products/order/view/' . $order_id,
            'message' => 'สั่งซื้อสินค้าเสร็จเรียบร้อยแล้ว'
        );
        return $rdata;
    }

}
