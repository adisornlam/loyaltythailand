<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 *  @Auther : Adisorn Lamsombuth
 *  @Email : postyim@gmail.com
 *  @Website : esabay.com 
 */

/**
 * Description of home
 *
 * @author R-D-6
 */
class Tutor extends MX_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->ion_auth->logged_in()) {
            redirect('login', 'refresh');
        }
        $this->load->model("tutor/Tutor_model");
    }

    public function index() {

        $data = array(
            'title' => TITLE
            );
        $this->template->load('frontend/master_index', 'home/frontend/guest/index', $data);
    }

}
