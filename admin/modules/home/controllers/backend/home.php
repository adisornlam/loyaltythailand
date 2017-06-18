<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 *  @Auther : Adisorn Lamsombuth
 *  @Email : postyim@gmail.com
 *  @Website : esabay.com 
 */

/**
 * Description of dashboard
 *
 * @author R-D-6
 */
class Home extends MX_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->ion_auth->logged_in()) {
            redirect('backend/login', 'refresh');
        }
    }

    public function index() {
        $data = array(
            'title' => 'Dashboard : E-Office System Management 2014'
        );
        $this->template->load('backend/master', 'dashboard/backend/index', $data);
    }

}
