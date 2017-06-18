<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 *  @Auther : Adisorn Lamsombuth
 *  @Email : postyim@gmail.com
 *  @Website : esabay.com 
 */

if (!function_exists('check_disabled')) {

    function check_disabled($param, $ch = 0) {
        return ($param == $ch ? '<span class="label label-success">Yes</span>' : '<span class="label label-warning">No</span>');
    }

}

if (!function_exists('check_status_orders')) {

    function check_status_orders($param = 'pending', $order_id) {
        $CI = & get_instance();
        $CI->load->database();
        $CI->load->library(array('ion_auth'));
        $CI->load->model('authentication/Ion_auth_model');
        $parent_id = $CI->Ion_auth_model->get_group_id($CI->ion_auth->get_user_id());

        $query = $CI->db->get_where('orders_status', array('name' => $param, 'user_id' => $parent_id));
        if ($query->num_rows() > 0) {
            $row = $query->first_row();
            if ($param === 'pending') {
                $rs = '<span class="label label-warning btnPayment" title="' . $row->title . '" id="' . $order_id . '">' . $row->title . '</span>';
            } else if ($param === 'notified') {
                $rs = '<span class="label label-info" title="' . $row->title . '">' . $row->title . '</span>';
            } else if ($param === 'pre-shipping') {
                $rs = '<span class="label label-success" title="' . $row->title . '">' . $row->title . '</span>';
            } else if ($param === 'expried') {
                $rs = '<span class="label label-default" title="' . $row->title . '">' . $row->title . '</span>';
            } else if ($param === 'canceled') {
                $rs = '<span class="label label-default" title="' . $row->title . '">' . $row->title . '</span>';
            } else {
                $rs = '<span class="label label-warning">' . $row->title . '</span>';
            }
            return $rs;
        }
    }

}

if (!function_exists('check_product_disabled_auth')) {

    function check_product_disabled_auth($product_id) {
        $CI = & get_instance();
        $CI->load->database();
        $CI->load->library(array('ion_auth'));

        $query = $CI->db->get_where('product_setting_ref', array('product_id' => $product_id, 'user_id' => $CI->ion_auth->get_user_id()));
        if ($query->num_rows() > 0) {
            $row = $query->first_row();
            if ($row->disabled === 'Y') {
                $str = '<input type="checkbox" name="' . $product_id . '" class="prod_chk" checked />';
            } else {
                $str = '<input type="checkbox" name="' . $product_id . '" class="prod_chk" />';
            }
        } else {
            $str = '<input type="checkbox" name="' . $product_id . '" class="prod_chk" />';
        }
        return $str;
    }

}

if (!function_exists('product_wholesale_recommend')) {

    function product_wholesale_recommend($product_id) {
        $CI = & get_instance();
        $CI->load->database();
        $CI->load->library(array('ion_auth'));

        $query = $CI->db->get_where('product_setting_wholesale', array('product_id' => $product_id, 'user_id' => $CI->ion_auth->get_user_id()));
        if ($query->num_rows() > 0) {
            $row = $query->first_row();
            $recommend = (int) $row->recommend;
            if ($recommend === 1) {
                $str = '<input type="checkbox" name="recommend_' . $product_id . '" class="prod_recommend" checked />';
            } else {
                $str = '<input type="checkbox" name="recommend_' . $product_id . '" class="prod_recommend" />';
            }
        } else {
            $str = '<input type="checkbox" name="recommend_' . $product_id . '" class="prod_recommend" />';
        }
        return $str;
    }

}

if (!function_exists('product_wholesale_new')) {

    function product_wholesale_new($product_id) {
        $CI = & get_instance();
        $CI->load->database();
        $CI->load->library(array('ion_auth'));

        $query = $CI->db->get_where('product_setting_wholesale', array('product_id' => $product_id, 'user_id' => $CI->ion_auth->get_user_id()));
        if ($query->num_rows() > 0) {
            $row = $query->first_row();
            $new = (int) $row->new;
            if ($new === 1) {
                $str = '<input type="checkbox" name="new_' . $product_id . '" class="prod_new" checked />';
            } else {
                $str = '<input type="checkbox" name="new_' . $product_id . '" class="prod_new" />';
            }
        } else {
            $str = '<input type="checkbox" name="new_' . $product_id . '" class="prod_new" />';
        }
        return $str;
    }

}

if (!function_exists('product_wholesale_promotion')) {

    function product_wholesale_promotion($product_id) {
        $CI = & get_instance();
        $CI->load->database();
        $CI->load->library(array('ion_auth'));

        $query = $CI->db->get_where('product_setting_wholesale', array('product_id' => $product_id, 'user_id' => $CI->ion_auth->get_user_id()));
        if ($query->num_rows() > 0) {
            $row = $query->first_row();
            $promotion = (int) $row->promotion;
            if ($promotion === 1) {
                $str = '<input type="checkbox" name="promotion_' . $product_id . '" class="prod_promotion" checked />';
            } else {
                $str = '<input type="checkbox" name="promotion_' . $product_id . '" class="prod_promotion" />';
            }
        } else {
            $str = '<input type="checkbox" name="promotion_' . $product_id . '" class="prod_promotion" />';
        }
        return $str;
    }

}

if (!function_exists('product_wholesale_sale')) {

    function product_wholesale_sale($product_id) {
        $CI = & get_instance();
        $CI->load->database();
        $CI->load->library(array('ion_auth'));

        $query = $CI->db->get_where('product_setting_wholesale', array('product_id' => $product_id, 'user_id' => $CI->ion_auth->get_user_id()));
        if ($query->num_rows() > 0) {
            $row = $query->first_row();
            $sale = (int) $row->sale;
            if ($sale === 1) {
                $str = '<input type="checkbox" name="sale_' . $product_id . '" class="prod_sale" checked />';
            } else {
                $str = '<input type="checkbox" name="sale_' . $product_id . '" class="prod_sale" />';
            }
        } else {
            $str = '<input type="checkbox" name="sale_' . $product_id . '" class="prod_sale" />';
        }
        return $str;
    }

}

if (!function_exists('product_wholesale_by_order')) {

    function product_wholesale_by_order($product_id) {
        $CI = & get_instance();
        $CI->load->database();
        $CI->load->library(array('ion_auth'));

        $query = $CI->db->get_where('product_setting_wholesale', array('product_id' => $product_id, 'user_id' => $CI->ion_auth->get_user_id()));
        if ($query->num_rows() > 0) {
            $row = $query->first_row();
            $by_order = (int) $row->by_order;
            if ($by_order === 1) {
                $str = '<input type="checkbox" name="by_order_' . $product_id . '" class="prod_by_order" checked />';
            } else {
                $str = '<input type="checkbox" name="by_order_' . $product_id . '" class="prod_by_order" />';
            }
        } else {
            $str = '<input type="checkbox" name="by_order_' . $product_id . '" class="prod_by_order" />';
        }
        return $str;
    }

}

if (!function_exists('check_option')) {

    function check_option($param) {
        $CI = & get_instance();
        $CI->load->database();
        $query = $CI->db->get_where('product_option_category', array('category_id' => $param));
        if ($query->num_rows() > 0) {
            $rs = '<span class="label label-info">Yes</span>';
        } else {
            $rs = '<span class="label label-danger">No</span>';
        }

        return $rs;
    }

}

if (!function_exists('check_status_orders_wholesale')) {

    function check_status_orders_wholesale($param = 0, $order_id = null) {
        $CI = & get_instance();
        $CI->load->database();
        $CI->load->library(array('ion_auth'));
        $CI->load->model('authentication/Ion_auth_model');
        $parent_id = $CI->Ion_auth_model->get_group_id($CI->ion_auth->get_user_id());

        $query = $CI->db->get_where('orders_status', array('name' => $param, 'user_id' => $parent_id));
        if ($query->num_rows() > 0) {
            $row = $query->first_row();
            if ($param === 'pending') {
                $rs = '<span class="label label-warning" title="' . $row->title2 . '">' . $row->title2 . '</span>';
            } else if ($param === 'notified') {
                $rs = '<span class="label label-info" title="' . $row->title2 . '">' . $row->title2 . '</span>';
            } else if ($param === 'pre-shipping') {
                $rs = '<span class="label label-success" title="' . $row->title2 . '">' . $row->title2 . '</span>';
            } else if ($param === 'expried') {
                $rs = '<span class="label label-default" title="' . $row->title2 . '">' . $row->title2 . '</span>';
            } else if ($param === 'canceled') {
                $rs = '<span class="label label-default" title="' . $row->title2 . '">' . $row->title2 . '</span>';
            } else {
                $rs = '<span class="label label-warning">' . $row->title2 . '</span>';
            }
            return $rs;
        }
    }

}

if (!function_exists('set_badge')) {

    function set_badge($param) {
        return '<span class="badge">' . $param . '</span>';
    }

}

if (!function_exists('get_seller_action')) {

    function get_seller_action($param) {
        $CI = & get_instance();
        $CI->load->database();

        $CI->db->select('*');
        $CI->db->from('orders_status_log');
        $CI->db->join('users', 'users.id=orders_status_log.user_id', 'inner');
        $CI->db->where_in('orders_status_log.status', 'pre-shipping');
        $CI->db->where('orders_status_log.order_id', $param);
        $query = $CI->db->get();
//        echo $CI->db->last_query($query);
        if ($query->num_rows() > 0) {
            $row = $query->first_row();
            return $row->first_name . " " . $row->last_name;
        }
    }

}

if (!function_exists('get_price_dealer')) {

    function get_price_dealer($param, $type = NULL) {
        $CI = & get_instance();
        $CI->load->database();
        $CI->load->library(array('ion_auth'));

        $CI->db->select('*');
        $CI->db->from('users');
        $CI->db->where('id', $CI->ion_auth->get_user_id());
        $query = $CI->db->get();
        $query2 = $CI->db->get_where('stk_product', array('product_id' => $param));
        $row2 = $query2->first_row();
        if ($query->num_rows() > 0) {
            $row = $query->first_row();
            if ($row->group_price <= 4) {
                $price = $row2->price_1;
            } elseif ($row->group_price == 5) {
                $price = $row2->price_5;
            } elseif ($row->group_price == 6) {
                $price = $row2->price_6;
            } elseif ($row->group_price == 7) {
                $price = $row2->price_7;
            } elseif ($row->group_price == 8) {
                $price = $row2->price_8;
            } elseif ($row->group_price == 9) {
                $price = $row2->price_9;
            } elseif ($row->group_price == 10) {
                $price = $row2->price_10;
            } else {
                $price = $row2->price_4;
            }
        } else {
            $price = $row2->price_1;
        }
        if ($type == 1) {
            $rs_price = $price - check_price($row2->product_id);
            $str = $rs_price;
        } else {
            $str = $price;
        }
        return $str;
    }

}

if (!function_exists('get_thumbs')) {

    function get_thumbs($product_id) {
        $CI = & get_instance();
        $CI->load->database();

        $CI->db->select('cms_content.cnt_thumb_url');
        $CI->db->from('stk_product');
        $CI->db->join('cms_content', 'cms_content.cnt_id=stk_product.cnt_id', 'inner');
        $CI->db->where('stk_product.product_id', $product_id);
        $query = $CI->db->get();
        if ($query->num_rows() > 0) {
            $row = $query->first_row();
            $img = 'https://www.jib.co.th/jib_content/images/content/' . $row->cnt_thumb_url;
        } else {
            $img = 'http://www.placehold.it/150x150/EFEFEF/AAAAAA&text=no+image';
        }
        return $img;
    }

}

if (!function_exists('check_price')) {

    function check_price($product_id) {
        $CI = & get_instance();
        $CI->load->database();

        $CI->db->select('sale');
        $CI->db->from('product_promotion');
        $CI->db->where('product_id', $product_id);
        $CI->db->where('disabled', 1);
        $CI->db->where('deleted_at', 0);
        $CI->db->where('start <=', time());
        $CI->db->where('finish >=', time());
        $query = $CI->db->get();
        if ($query->num_rows() > 0) {
            $row = $query->first_row();
            $p = $row->sale;
        } else {
            $p = 0;
        }
        return $p;
    }

}

if (!function_exists('count_cat')) {

    function count_cat($cat_id) {
        $CI = & get_instance();
        $CI->load->database();

        $CI->db->select('*');
        $CI->db->from('categories');
        $CI->db->join('category_hierarchy', 'category_hierarchy.category_id=categories.id');
        $CI->db->where('category_hierarchy.category_parent_id', $cat_id);
        $query = $CI->db->get();
        if ($query->num_rows() > 0) {
            $count = '(' . $query->num_rows() . ')';
        } else {
            $count = '';
        }
        return $count;
    }

}