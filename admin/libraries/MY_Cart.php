<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 *  @Auther : Adisorn Lamsombuth
 *  @Email : postyim@gmail.com
 *  @Website : esabay.com 
 */

/**
 * Description of MY_Cart
 *
 * @author R-D-6
 */
class MY_Cart extends CI_Cart {

    function __construct() {
        parent::__construct();

        // Remove limitations in product names
        $this->product_name_rules = '\d\D';
    }

}
