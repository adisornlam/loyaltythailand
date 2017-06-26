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

if (!function_exists('create_thumb')) {

    function create_thumb($filename) {
        $extension_pos = strrpos($filename, '.');
        $thumb = substr($filename, 0, $extension_pos) . '_thumb' . substr($filename, $extension_pos);
        return $thumb;
    }

}
