<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 *  @Auther : Adisorn Lamsombuth
 *  @Email : postyim@gmail.com
 *  @Website : esabay.com 
 */

/**
 * Description of category
 *
 * @author R-D-6
 */
class Shipping extends MX_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->ion_auth->logged_in()) {
            redirect('backend/login', 'refresh');
        }
        $this->load->model('settings/Shipping_model');
    }

    public function index() {
        $data = array(
            'title' => 'Shipping : E-Office System Management 2014'
        );

        if ($this->ion_auth->in_group('wholesale')) {
            $this->template->load('backend/master', 'settings/backend/shipping/wholesale/shipping_index', $data);
        } elseif ($this->ion_auth->in_group('dealer')) {
            
        } else {
            
        }
    }

    public function add() {
        $this->load->view('settings/backend/shipping/wholesale/shipping_add');
    }

    public function edit() {
        $rs = $this->Shipping_model->get_edit($this->uri->segment(5));
        $data = array(
            'item' => $rs[0]
        );
        $this->load->view('settings/backend/shipping/wholesale/shipping_edit', $data);
    }

}
