<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 *  @Auther : Adisorn Lamsombuth
 *  @Email : postyim@gmail.com
 *  @Website : esabay.com 
 */

if (!function_exists('cal_math1')) {

    function cal_math1($n1, $total) {

        if($total>0){
            $sum1 = ($n1/$total)*100;
            $sum = (is_int($sum1) ? $sum1 : number_format($sum1,2));
        }else{
            $sum = 0;
        }
        return $sum;
    }

}