<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 *  @Auther : Adisorn Lamsombuth
 *  @Email : postyim@gmail.com
 *  @Website : esabay.com 
 */

if (!function_exists('set_name')) {

    function check_disabled($param, $ch = 0) {
        return ($param == $ch ? '<span class="label label-success">Yes</span>' : '<span class="label label-warning">No</span>');
    }

    function set_badge($param) {
        return '<span class="badge">' . $param . '</span>';
    }

}