<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 *  @Auther : Adisorn Lamsombuth
 *  @Email : postyim@gmail.com
 *  @Website : esabay.com 
 */



if (!function_exists('check_position')) {

    function check_position($param) {
        if ($param == 1) {
            $str = 'Slide';
        } elseif ($param == 2) {
            $str = 'Banner Right';
        } elseif ($param == 3) {
            $str = 'Promotion';
        } else {
            $str = '';
        }
        return $str;
    }

}
