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

if (!function_exists('set_badge')) {

    function set_badge($param) {
        return '<span class="badge">' . $param . '</span>';
    }

}

if (!function_exists('get_full_name')) {

    function get_full_name($param) {
        $CI = & get_instance();
        $CI->load->database();
        $query = $CI->db->get_where('users', array('id' => $param));
        if ($query->num_rows() > 0) {
            $row = $query->first_row();
            $str = $row->first_name . " " . $row->last_name . ($row->nick_name != NULL ? " (" . $row->nick_name . ")" : "");
        } else {
            $str = '';
        }

        return $str;
    }

}

if (!function_exists('check_dealer_label')) {

    function check_dealer_label($param) {
        $CI = & get_instance();
        $CI->load->database();
        $query = $CI->db->get_where('users', array('id' => $param));
        if ($query->num_rows() > 0) {
            $row = $query->first_row();
            $dealer = (int) $row->dealer_status;
            if ($dealer === 1) {
                $str = "<label class=\"text-success\">" . $row->company . "</label>";
            } else {
                $str = "<label class=\"text-warning\">" . $row->company . "</label>";
            }
        } else {
            $str = '';
        }

        return $str;
    }

}