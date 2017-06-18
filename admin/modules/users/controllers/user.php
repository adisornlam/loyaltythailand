<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 *  @Auther : Adisorn Lamsombuth
 *  @Email : postyim@gmail.com
 *  @Website : esabay.com 
 */

/**
 * Description of users
 *
 * @author R-D-6
 */
class User extends MX_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->ion_auth->logged_in()) {
            redirect('login', 'refresh');
        }
        $this->load->model('users/Users_model');
        $this->load->model('common/Common_model');
    }

    public function index() {
        $data = array(
            'title' => 'Users List : '.TITLE,
            'breadcrumbs' => array(
                'Users Overview' => 'users/backend',
                'Users List' => 'users/user'
                )
            );
        if ($this->ion_auth->is_admin()) {
            $this->template->load('master', 'users/admin/users_index', $data);
        } elseif ($this->ion_auth->in_group('wholesale')) {
            $this->template->load('master', 'users/wholesale/users_index', $data);
        } elseif ($this->ion_auth->in_group('dealer')) {
            $this->template->load('master', 'users/dealer/users_index', $data);
        } elseif ($this->ion_auth->in_group('seller')) {
            $this->template->load('master', 'users/seller/users_index', $data);
        } else {
            
        }
    }

    public function add() {
        $data = array(
            'title' => 'Users Add : '.TITLE,
            'breadcrumbs' => array(
                'Users List' => 'users/user',
                'Add User' => '#'
                ),
            'province' => $this->Common_model->get_province()
            );
        if ($this->ion_auth->is_admin()) {
            $this->load->view('users/admin/users_add');
        } elseif ($this->ion_auth->in_group('wholesale')) {
            $this->template->load('master', 'users/wholesale/users_add', $data);
        } elseif ($this->ion_auth->in_group('seller')) {
            $this->template->load('master', 'users/seller/users_add', $data);
        } elseif ($this->ion_auth->in_group('dealer')) {
            $this->load->view('users/dealer/users_add');
        } else {
            
        }
    }

    public function add_address() {
        $data = array(
            'title' => 'edit Address : '.TITLE,
            'province' => $this->Common_model->get_province()
            );
        if ($this->ion_auth->is_admin()) {
            $this->load->view('users/admin/users_add');
        } elseif ($this->ion_auth->in_group('wholesale')) {
            $this->template->load('master', 'users/wholesale/users_add', $data);
        } elseif ($this->ion_auth->in_group('dealer')) {
            $this->load->view('users/dealer/users_add_address', $data);
        } else {
            
        }
    }

    public function edit() {
        $rs = $this->Users_model->get_edit($this->uri->segment(5));
        if ($this->ion_auth->is_admin()) {
            $data = array(
                'title' => 'edit Users : '.TITLE,
                'item' => $rs,
                'province' => $this->Common_model->get_province(),
                'breadcrumbs' => array(
                    'Users List' => 'users/user',
                    'Edit User' => '#'
                    )
                );
            $this->template->load('master', 'users/admin/users_edit', $data);
        } elseif ($this->ion_auth->in_group('wholesale')) {
            $data = array(
                'title' => 'edit Users : '.TITLE,
                'item' => $rs,
                'province' => $this->Common_model->get_province(),
                'breadcrumbs' => array(
                    'Users List' => 'users/user',
                    'Edit User' => '#'
                    )
                );
            $this->template->load('master', 'users/wholesale/users_edit', $data);
        } elseif ($this->ion_auth->in_group('dealer')) {
            $this->load->view('users/dealer/users_edit', $data);
        } elseif ($this->ion_auth->in_group('seller')) {
            $data = array(
                'title' => 'edit Users : '.TITLE,
                'item' => $rs,
                'province' => $this->Common_model->get_province(),
                'breadcrumbs' => array(
                    'Users List' => 'users/user',
                    'Edit User' => '#'
                    )
                );
            $this->template->load('master', 'users/seller/users_edit', $data);
        } else {
            
        }
    }

    public function register_generate() {
        if ($this->ion_auth->is_admin()) {
            
        } elseif ($this->ion_auth->in_group('seller')) {
            $data = array(
                'key' => $this->Users_seller_model->set_register_generate(time())
                );
            $this->load->view('users/seller/users_gen_link', $data);
        } else {
            
        }
    }

    public function view() {
        
        $rs = $this->Users_model->get_edit($this->uri->segment(5));
        $data = array(
            'item' => $rs
            );
        $this->load->view('users/dealer/users_info_dialog', $data);
    }

}
