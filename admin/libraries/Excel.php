<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require_once APPPATH . "/third_party/PHPExcel.php";

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Excel
 *
 * @author adisornlam
 */
class Excel extends PHPExcel {

    public function __construct() {
        parent::__construct();
    }

}
