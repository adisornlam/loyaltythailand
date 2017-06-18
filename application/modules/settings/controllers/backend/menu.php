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
class Menu extends MX_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->ion_auth->logged_in()) {
            redirect('backend/login', 'refresh');
        } elseif (!$this->ion_auth->is_admin()) {
            return show_error('You must be an administrator to view this page.');
        }
    }

    public function index() {
        $data = array(
            'title' => 'Menu : E-Office System Management 2014'
        );
        $this->template->load('backend/master', 'settings/backend/menu/menu_index', $data);
    }

    public function sub() {
        $data = array(
            'title' => 'Sub Menu : E-Office System Management 2014',
            'breadcrumbs' => array(
                'Menu Overview' => 'settings/backend/menu',
                'Menu Sub' => '#'
            )
        );
        $this->template->load('backend/master', 'settings/backend/menu/menu_sub', $data);
    }

    public function add() {
        $this->load->view('settings/backend/menu/menu_add');
    }

    public function edit() {
        $rs = $this->Menu_model->get_edit($this->uri->segment(5));
        $data = array(
            'item' => $rs[0]
        );
        $this->load->view('settings/backend/menu/menu_edit', $data);
    }

}
