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
class Users extends MX_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->ion_auth->logged_in()) {
            redirect('backend/login', 'refresh');
        }
        $this->load->model('settings/Users_model', 'users');
        $this->load->model('settings/Users_wholesale_model');
    }

    public function index() {
        $data = array(
            'title' => 'Users : E-Office System Management 2014'
        );
        if ($this->ion_auth->is_admin()) {
            $this->template->load('backend/master', 'settings/backend/users/admin/users_index', $data);
        } elseif ($this->ion_auth->in_group('wholesale')) {
            $this->template->load('backend/master', 'settings/backend/users/wholesale/users_index', $data);
        } elseif ($this->ion_auth->in_group('dealer')) {
            
        }
    }

    public function group() {
        $data = array(
            'title' => 'Group : E-Office System Management 2014',
            'breadcrumbs' => array(
                'Settings Overview' => 'settings/backend',
                'Users List' => 'settings/backend/users',
                'Group List' => '#'
            )
        );
        $this->template->load('backend/master', 'settings/backend/users/admin/group_index', $data);
    }

    public function add() {
        if ($this->ion_auth->is_admin()) {
            $data = array(
                'group' => $this->users->get_group(),
                'user_parent' => $this->users->get_user_parent(array('admin', 'wholesale'))
            );
            $this->load->view('settings/backend/users/admin/users_add', $data);
        } elseif ($this->ion_auth->in_group('wholesale')) {
            $data = array(
                'group' => $rs = $this->Users_wholesale_model->get_group(array('members', 'seller'))
            );
            $this->load->view('settings/backend/users/wholesale/users_add', $data);
        }
    }

    public function group_add() {
        $this->load->view('settings/backend/users/admin/group_add');
    }

    public function edit() {
        if ($this->ion_auth->is_admin()) {
            $rs = $this->users->get_edit($this->uri->segment(5));
            $rs2 = $this->users->get_option_groups($this->uri->segment(5));
            $rs3 = $this->users->get_group();
            $data = array(
                'item' => $rs[0],
                'group' => $rs3,
                'group_option' => $rs2->first_row()->group_id,
                'user_parent' => $this->users->get_user_parent(array('admin', 'wholesale')),
                'group_parent_option' => $rs2->first_row()->user_parent,
            );
            $this->load->view('settings/backend/users/admin/users_edit', $data);
        } elseif ($this->ion_auth->in_group('wholesale')) {
            $rs = $this->Users_wholesale_model->get_edit($this->uri->segment(5));
            $data = array(
                'item' => $rs[0],
                'group' => $rs = $this->Users_wholesale_model->get_group(array('members', 'seller'))
            );
            $this->load->view('settings/backend/users/wholesale/users_edit', $data);
        }
    }

    public function group_edit() {
        $this->load->model('settings/Menu_model', 'menu');
        $rs = $this->users->get_group_edit($this->uri->segment(5));
        $rs2 = $this->users->get_group_menu($this->uri->segment(5));
        if ($rs2) {
            foreach ($rs2 as $value) {
                $ar[] = $value->menu_id;
            }
        } else {
            $ar = array();
        }
        $data = array(
            'item' => $rs[0],
            'menu_val' => $ar
        );
        $this->load->view('settings/backend/users/admin/group_edit', $data);
    }

}
