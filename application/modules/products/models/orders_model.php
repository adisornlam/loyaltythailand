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
class Orders_model extends CI_Model {

    public function get_edit($param) {
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
                . 'payment_item.title as payment_title, '
                . 'payment_transfer.created_at as payment_created'
                . '');
        $this->db->from('orders');
        $this->db->join('users', 'users.id=orders.user_id', 'inner');
        $this->db->join('payment_transfer', 'payment_transfer.order_id=orders.id', 'left');
        $this->db->join('payment_item', 'payment_item.id=orders.payment_id', 'left');
        $this->db->where('orders.id', $param);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $row = $query->first_row();
            return $row;
        } else {
            return array();
        }
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
            $row = $query->first_row();
            return $row;
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

    public function transfer_add() {
        $this->load->library('pusher');
        $this->load->model('users/Users_model');
        $parent_id = $this->Ion_auth_model->get_group_id($this->ion_auth->get_user_id());
        $order_rs = $this->get_view($this->input->post('order_id'));
        $this->load->helper('directory');

        $upload_config = array(
            'upload_path' => 'uploads/products/slip/' . date('Ymd') . '/',
            'allowed_types' => 'jpg|jpeg|png|doc|docx|pdf',
            'file_name' => time()
        );
        $this->load->library('upload', $upload_config);
        $dir_exist = true;
        if (!is_dir($upload_config['upload_path'])) {
            mkdir($upload_config['upload_path'], 0777, true);
            $dir_exist = false;
        }
        if ($this->upload->do_upload('slip')) {
            $data_file = $this->upload->data();
            $slip = $upload_config['upload_path'] . $data_file['file_name'];
        } else {
            $slip = NULL;
        }

        $data = array(
            'order_id' => $this->input->post('order_id'),
            'name' => trim($this->input->post('name')),
            'total' => trim($this->input->post('total')),
            'fdate' => trim($this->input->post('fdate')),
            'ftime' => trim($this->input->post('ftime')),
            'from_bank' => trim($this->input->post('from_bank')),
            'to_bank' => trim($this->input->post('to_bank')),
            'branch_bank' => trim($this->input->post('branch_bank')),
            'slip' => $slip,
            'remark' => trim($this->input->post('remark')),
            'created_at' => time()
        );


        $this->db->trans_start();
        $this->db->insert('payment_transfer', $data);
        $this->db->update('orders', array('status' => 'notified', 'updated_at' => time()), array('id' => $this->input->post('order_id')));
        $this->db->insert('orders_status_log', array('order_id' => $this->input->post('order_id'), 'status' => 'notified', 'user_id' => $this->ion_auth->get_user_id(), 'created_at' => time()));
        //Set credit store

        $store = $this->Orders_model->get_credit(array('total' => $order_rs->total_price, 'transfer' => $this->input->post('total')));
        if ($store['balance'] > 0) {
            $param = array(
                'order_id' => $this->input->post('order_id'),
                'price_total' => $order_rs->total_price,
                'transfer' => trim($this->input->post('total'))
            );
            $this->set_credit_store($param);
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

            //Send Notifivation
            $arr_a = array($parent_id);
            foreach ($this->Users_model->get_seller() as $item) {
                $arr[] = $item->id;
            }
            $arr_m = array_merge($arr_a, $arr);

            $data3 = array(
                'type' => 'notice',
                'pk_id' => $this->input->post('order_id'),
                'user_id' => $this->ion_auth->get_user_id(),
                'assign' => $arr_m,
                'title' => 'มีรายการแจ้งชำระใหม่',
                'module' => 'products',
                'url' => 'products/backend/order/view/' . $this->input->post('order_id'),
                'icon' => 'fa fa-money'
            );
            $this->Common_model->set_notifications($data3);

            foreach ($arr_m as $value) {
                $this->pusher->trigger(
                        'my_channel_' . $value, 'my_event', array(
                    'message' => 'มีรายการแจ้งชำระเงิน รหัสสั่งซื้อ : ' . $this->get_orders($this->input->post('order_id'))->orders_code . '<br />ยอดชำระ : ' . number_format($this->input->post('total')) . ' บาท<br /> ดูรายละเอียด <a href="' . base_url() . index_page() . 'products/backend/order/view/' . $this->input->post('order_id') . '">คลิกที่นี่</a>')
                );
            }

            $rdata = array(
                'status' => TRUE,
                'redirect' => 'products/order',
                'message' => 'Save data success.'
            );
        }
        return $rdata;
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

    public function get_orders_log($param) {
        $parent_id = $this->Ion_auth_model->get_group_id($this->ion_auth->get_user_id());
        $this->db->select(''
                . 'orders_status.title2 as log_title, '
                . 'orders_status_log.created_at as log_time, '
                . 'orders_status_log.remark, '
                . 'orders_status_log.status, '
                . 'payment_transfer.name as tf_name, '
                . 'payment_transfer.total as tf_total, '
                . 'payment_transfer.fdate, '
                . 'payment_transfer.ftime, '
                . 'payment_transfer.from_bank, '
                . 'payment_transfer.to_bank, '
                . 'payment_transfer.slip, '
                . 'payment_transfer.remark as tf_remark '
                . '');
        $this->db->from('orders_status_log');
        $this->db->join('orders', 'orders.id=orders_status_log.order_id', 'inner');
        $this->db->join('orders_status', 'orders_status.name=orders_status_log.status', 'inner');
        $this->db->join('payment_transfer', 'payment_transfer.order_id=orders_status_log.order_id', 'left');
        $this->db->where('orders_status_log.order_id', $param);
        $this->db->where('orders_status.user_id', $parent_id);
        $this->db->order_by('orders_status_log.created_at', 'asc');
        $query = $this->db->get();
        return $query;
    }

    public function get_orders_status_item($param, $type = 0) {
        $parent_id = $this->Ion_auth_model->get_group_id($this->ion_auth->get_user_id());
        $query = $this->db->get_where('orders_status', array('user_id' => $parent_id, 'name' => $param));
        if ($query->num_rows() > 0) {
            $row = $query->first_row();
            if ($type == 1) {
                if ($param === 'pending') {
                    $rs = '<span class="label label-warning btnPayment" title="' . $row->title2 . '">' . $row->title2 . '</span>';
                } else if ($param === 'notified') {
                    $rs = '<span class="label label-info" title="' . $row->title2 . '">' . $row->title2 . '</span>';
                } else if ($param === 'pre-shipping') {
                    $rs = '<span class="label label-success" title="' . $row->title2 . '">' . $row->title2 . '</span>';
                } else {
                    $rs = '<span class="label label-warning">' . $row->title2 . '</span>';
                }
            } else {
                if ($param === 'pending') {
                    $rs = '<span class="label label-warning btnPayment" title="' . $row->title . '">' . $row->title . '</span>';
                } else if ($param === 'notified') {
                    $rs = '<span class="label label-info" title="' . $row->title . '">' . $row->title . '</span>';
                } else if ($param === 'pre-shipping') {
                    $rs = '<span class="label label-success" title="' . $row->title . '">' . $row->title . '</span>';
                } else {
                    $rs = '<span class="label label-warning">' . $row->title . '</span>';
                }
            }
            return $rs;
        }
    }

    public function change_status() {
        $this->load->model('products/Orders_model');
        $this->load->model('products/Products_dealer_model');
        $this->load->model('users/Users_model');

        $parent_id = $this->Ion_auth_model->get_group_id($this->ion_auth->get_user_id());

        $this->db->update('orders', array('status' => $this->input->post('status_id'), 'updated_at' => time()), array('id' => $this->input->post('order_id')));

        $this->Products_dealer_model->set_product_dealer($this->input->post('order_id'));

        $this->db->insert('orders_status_log', array('order_id' => $this->input->post('order_id'), 'status' => $this->input->post('status_id'), 'user_id' => $this->ion_auth->get_user_id(), 'remark' => $this->input->post('remark'), 'created_at' => time()));
        $rs = $this->Orders_model->get_view($this->input->post('order_id'));
        $user = $this->Users_model->get_edit($rs->user_id);


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

        if ($this->input->post('status_id') == 'pre-shipping') {
            //Send Email        
            $this->load->library('email');
            $email_config = $this->Common_model->get_config_email();
            $this->email->initialize($email_config);
            $this->email->from('noreply@jib.co.th', 'JIB COMPUTER GROUP (WHOLESALE)');
            $this->email->to($user->email);
            $this->email->subject('Pre Shipping : JIB COMPUTER GROUP (WHOLESALE)');
            $data2 = array(
                'fullname' => $user->first_name . " " . $user->last_name,
                'order_code' => $rs->orders_code,
                'link' => anchor('products/order/view/' . $rs->user_id, 'คลิกที่นี่')
            );
            $email = $this->load->view('products/email/pre_shipping', $data2, TRUE);
            $this->email->message($email);
            $this->email->send();
        }

        $rdata = array(
            'status' => TRUE,
            'redirect' => 'products/backend/order/view/' . $this->input->post('order_id'),
            'message' => 'Save data success.'
        );
        return $rdata;
    }

    public function get_credit_store($param) {
        $this->db->select('balance');
        $this->db->from('payment_credit_store');
        $this->db->where('user_id', $this->ion_auth->get_user_id());
        $this->db->order_by('id', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $row = $query->first_row();
            $total = $param['total'];
            $balance = $row->balance;

            if ($total > $balance) {
                $rs = array(
                    'total' => $balance,
                    'rs' => $total - $balance,
                    'mn' => 1
                );
            } else if ($balance > $total) {
                $rs = array(
                    'total' => $balance,
                    'rs' => $balance - $total,
                    'mn' => NULL
                );
            } else {
                $rs = array(
                    'total' => $balance,
                    'rs' => 0,
                    'mn' => NULL
                );
            }
        } else {
            $rs = array(
                'rs' => 0,
                'mn' => NULL
            );
        }
        return $rs;
    }

    public function set_credit_store($param) {
        $gtotal = $this->get_credit(array('total' => $param['price_total'], 'transfer' => $param['transfer']));

        $order_id = $param['order_id'];
        $transfer = (isset($param['transfer']) ? $param['transfer'] : 0);
        $price_total = $param['price_total'];
        $balance = $gtotal['balance'];

        if ($price_total > $balance) {
            if ($transfer > $price_total) {
                $tol = $transfer - $price_total;
                $mn = NULL;
            } else if ($transfer < $price_total) {
                if ($gtotal['mn'] == 1) {
                    $tol = ($price_total - $transfer) - $balance;
                    $mn = NULL;
                } else {
                    $tol = $price_total - $transfer;
                    $mn = 1;
                }
            } else if ($transfer == $price_total) {
                if ($gtotal['mn'] == 1) {
                    $tol = $balance;
                    $mn = NULL;
                } else {
                    $tol = 0;
                    $mn = 1;
                }
            } else {
                $tol = 0;
                $mn = NULL;
            }

            $data = array(
                'order_id' => $order_id,
                'user_id' => $this->ion_auth->get_user_id(),
                'price_total' => $price_total,
                'transfer' => $transfer,
                'balance' => $tol,
                'minus' => $mn,
                'created_at' => time()
            );
            $this->db->insert('payment_credit_store', $data);
        } else if ($balance >= $price_total) {
            $data = array(
                'order_id' => $order_id,
                'user_id' => $this->ion_auth->get_user_id(),
                'price_total' => $price_total,
                'transfer' => $transfer,
                'balance' => $gtotal['dif'],
                'created_at' => time()
            );
            $this->db->insert('payment_credit_store', $data);
        } else {

            $data = array(
                'order_id' => $order_id,
                'user_id' => $this->ion_auth->get_user_id(),
                'price_total' => $price_total,
                'transfer' => $transfer,
                'balance' => 0,
                'created_at' => time()
            );
            $this->db->insert('payment_credit_store', $data);
        }
        //return $data;
        return TRUE;
    }

    public function get_credit($param) {
        $this->db->select('balance');
        $this->db->from('payment_credit_store');
        $this->db->where('user_id', $this->ion_auth->get_user_id());
        $this->db->order_by('id', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get();
        $total_price = $param['total'];
        $transfer = (isset($param['transfer']) ? $param['transfer'] : 0);

        if ($query->num_rows() > 0) {
            $row = $query->first_row();
            $balance = $row->balance;
            if ($balance > $total_price) {
                $bal = $balance - $total_price;
                $mn = NULL;
            } elseif ($balance < $total_price) {
                $bal = $total_price - $balance;
                $mn = 1;
            } elseif ($balance == $total_price) {
                $bal = 0;
                $mn = NULL;
            } else {
                $bal = 0;
                $mn = NULL;
            }
            $rs = array(
                'balance' => $balance,
                'dif' => $bal,
                'mn' => $mn
            );
        } else {

            if ($transfer > $total_price && $transfer != 0) {
                $bal = $transfer - $total_price;
                $mn = NULL;
            } elseif ($transfer < $total_price && $transfer != 0) {
                $bal = $total_price - $transfer;
                $mn = 1;
            } else {
                $bal = 0;
                $mn = NULL;
            }
            $rs = array(
                'balance' => $bal,
                'mn' => $mn
            );
        }
        return $rs;
    }

    public function get_total_price_order() {
        $date = new DateTime(date('Y-m-d') . " 00:00:01");

        $this->db->select_sum('sum_price');
        $this->db->where('status', 'pre-shipping');
        $this->db->where('created_at >', $date->getTimestamp());
        $query = $this->db->get('orders');
        $total = $query->result();
        return $total[0]->sum_price;
    }
}
