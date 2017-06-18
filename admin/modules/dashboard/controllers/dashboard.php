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
class Dashboard extends MX_Controller {

    public $user_group;

    public function __construct() {
        parent::__construct();
        if (!$this->ion_auth->logged_in()) {
            redirect('login', 'refresh');
        }
    }

    public function index() {
        $data = array(
            'title' => 'Dashboard : '.TITLE,
            'title_page' => 'Dashboard'
            );

        if ($this->ion_auth->is_admin()) {
            $this->template->load('master', 'dashboard/admin/index', $data);
        } elseif ($this->ion_auth->in_group('owner')) {
            $this->template->load('master', 'dashboard/owner/index', $data);
        } elseif ($this->ion_auth->in_group('employee')) {
            $this->template->load('master', 'dashboard/employee/index', $data);
        } elseif ($this->ion_auth->in_group('teacher')) {
            $this->template->load('master', 'dashboard/teacher/index', $data);
        } elseif ($this->ion_auth->in_group('store')) {
            $this->template->load('master', 'dashboard/store/index', $data);
        } else {

        }
    }

    function delete_user(){
        $this->load->model('users/Users_model');
        $this->Users_model->delete_user_all();
    }

    function update_code($branch_id){
        $this->load->model('users/Users_model');
        $this->Users_model->update_code($branch_id);
    }

}
