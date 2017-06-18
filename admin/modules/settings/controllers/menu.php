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
            redirect('login', 'refresh');
        } elseif (!$this->ion_auth->is_admin()) {
            return show_error('You must be an administrator to view this page.');
        }

        $this->load->model("settings/Menu_model");
    }

    public function index() {
        $data = array(
            'title' => 'Menu : '.TITLE,
            'title_page'=>'Menu'
            );
        if ($this->ion_auth->is_admin()) {
            $this->template->load('master', 'settings/admin/menu/index', $data);
        }else{
            $this->template->load('master', 'templates/not_permission', $data);
        }
    }

    public function listall() {
        echo $this->Menu_model->listall();
    }

    public function sub() {
        $data = array(
            'title' => 'Sub Menu : '.TITLE,
            'title_page'=>'Sub Menu',
            'breadcrumbs' => array(
                'Menu Overview' => 'settings/menu',
                'Menu Sub' => '#'
                )
            );
        if ($this->ion_auth->is_admin()) {
            $this->template->load('master', 'settings/admin/menu/sub', $data);
        }else{
            $this->template->load('master', 'templates/not_permission', $data);
        }
    }

    public function add() {
        $this->load->view('settings/admin/menu/menu_add');
    }

    public function edit() {
        $rs = $this->Menu_model->get_item($this->uri->segment(4));
        $data = array(
            'item' => $rs
            );
        $this->load->view('settings/menu/menu_edit', $data);
    }

}
