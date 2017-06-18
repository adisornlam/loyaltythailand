<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 *  @Auther : Adisorn Lamsombuth
 *  @Email : postyim@gmail.com
 *  @Website : esabay.com 
 */
if (!function_exists('time_elapsed_string')) {

    function time_elapsed_string($ptime) {
        $etime = time() - $ptime;
        if ($etime < 1) {
            return '0 seconds';
        }
        $a = array(12 * 30 * 24 * 60 * 60 => 'year',
            30 * 24 * 60 * 60 => 'month',
            24 * 60 * 60 => 'day',
            60 * 60 => 'hour',
            60 => 'minute',
            1 => 'second'
            );
        foreach ($a as $secs => $str) {
            $d = $etime / $secs;
            if ($d >= 1) {
                $r = round($d);
                return $r . ' ' . $str . ($r > 1 ? 's' : '') . ' ago';
            }
        }
    }

}

if (!function_exists('get_datethai')) {

    function get_datethai($strDate, $t = 0) {
        $strYear = date("Y", $strDate) + 543;
        $strMonth = date("n", $strDate);
        $strDay = date("j", $strDate);
        $strWeek = date("w", $strDate);
        $strHour = date("H", $strDate);
        $strMinute = date("i", $strDate);
        $strSeconds = date("s", $strDate);
        $strWeekCut = array("วันอาทิตย์", "วันจันทร์", "วันอังคาร", "วันพุธ", "วันพฤหัส", "วันศุกร์", "วันเสาร์");
        $strMonthCut = array("", "มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");
        $strWeekThai = $strWeekCut[$strWeek];
        $strMonthThai = $strMonthCut[$strMonth];
        if ($t == 1) {
            $rs = $strWeekThai . " " . $strDay . " " . $strMonthThai . " " . $strYear;
        } elseif ($t == 2) {
            $rs = $strDay . " " . $strMonthThai . " " . $strYear . " " . $strHour . ":" . $strMinute;
        } elseif ($t == 3) {
            $rs = $strDay . " " . $strMonthThai . " " . $strYear;
        } else {
            $rs = $strWeekThai . " " . $strDay . " " . $strMonthThai . " " . $strYear . " เวลา " . $strHour . ":" . $strMinute;
        }
        return $rs;
    }

}

if (!function_exists('DateThai')) {
    function DateThai($strDate)
    {
        $strYear = date("Y",strtotime($strDate))+543;
        $strMonth= date("n",strtotime($strDate));
        $strDay= date("j",strtotime($strDate));
        $strHour= date("H",strtotime($strDate));
        $strMinute= date("i",strtotime($strDate));
        $strSeconds= date("s",strtotime($strDate));
        $strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
        $strMonthThai=$strMonthCut[$strMonth];
        return "$strDay $strMonthThai $strYear";
    }
}

if (!function_exists('get_convert_date')) {

    function get_convert_date($param) {
        return date('Y-m-d H:i:s', $param);
    }

}

if (!function_exists('base64url_encode')) {

    function base64url_encode($s) {
        $base_64 = base64_encode($s);
        $url_param = rtrim($base_64, '=');
        return $url_param;
    }

}
if (!function_exists('base64url_decode')) {

    function base64url_decode($s) {
        $base_64 = $s . str_repeat('=', strlen($s) % 4);
        $data = base64_decode($base_64);
        return $data;
    }

}

if (!function_exists('check_active')) {

    function check_active($param, $ch = 0) {
        return ($param == $ch ? '<span class="label label-success">Yes</span>' : '<span class="label label-warning">No</span>');
    }

}

if (!function_exists('current_full_url')) {

    function current_full_url() {
        $CI = & get_instance();

        $url = $CI->config->site_url($CI->uri->uri_string());
        return $_SERVER['QUERY_STRING'] ? $url . '?' . $_SERVER['QUERY_STRING'] : $url;
    }

}

if (!function_exists('seo_title')) {

    function seo_web($param) {
        $CI = & get_instance();
        $CI->load->database();

        $query = $CI->db->get_where('system_config_website', array('id' => 1));
        if ($query->num_rows() > 0) {
            $row = $query->first_row();
            if ($param === 'site_name') {
                $str = $row->site_name;
            } else if ($param === 'keywords') {
                $str = $row->keywords;
            } else if ($param === 'description') {
                $str = $row->description;
            }
        }
        return $str;
    }

}

if (!function_exists('form_dropdown_count')) {

    function form_dropdown_count($name, $param, $ch = 1) {
        $arr_cat = array();
        for ($i = 1; $i <= $param; $i++) {
            $arr_cat[$i] = $i;
        }

        $str = form_dropdown($name, $arr_cat, $ch, 'id="' . $name . '" class="ddl_count"');
        return $str;
    }

}

if (!function_exists('clear_url')) {

    function clear_url($s) {
        return trim(preg_replace('/[^a-zA-Z0-9]+/', ' ', html_entity_decode($s, ENT_QUOTES)));
    }

}