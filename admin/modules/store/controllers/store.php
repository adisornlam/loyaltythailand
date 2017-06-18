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
class Store extends MX_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->ion_auth->logged_in()) {
            redirect('login', 'refresh');
        }
        $this->load->model("store/store_model");
    }

    function index(){
        $data = array(
            'title' => 'Store : '. TITLE,
            'title_page' => 'Store'
            );

        $group = array('admin','owner');
        if ($this->ion_auth->in_group($group))
        {
            $this->template->load('master', 'store/member/index', $data);
        }else{
            $this->template->load('master', 'templates/not_permission', $data);
        }
    }


    function listall(){
        echo $this->store_model->listall();
    }

    public function add() {
        $this->load->view('tutor/owner/branch/add');
    }

    public function edit() {
        $data = array(
            'item'=>$this->store_model->get_item($this->uri->segment(4))
            );
        $this->load->view('tutor/owner/branch/edit',$data);
    }

    public function aboutus()
    {
        $data = array(
            'title' => 'About Us : '. TITLE,
            'title_page' => 'About Us'
            );

        $group = array('admin','owner','store');
        if ($this->ion_auth->in_group($group))
        {
            $this->template->load('master', 'store/member/aboutus', $data);
        }else{
            $this->template->load('master', 'templates/not_permission', $data);
        }
    }

    public function save() {

        if($this->uri->segment(4)=='add'){
            $rs = $this->store_model->add_save();
        }else if($this->uri->segment(4)=='edit'){
            $rs = $this->store_model->edit_save();
        }else if($this->uri->segment(4)=='delete'){
            $rs = $this->store_model->delete_save();
        }else{
            $rs = array();
        }
        
        $data = array(
            'error' => array(
                'status' => $rs['status'],
                'redirect' => (isset($rs['redirect']) ? $rs['redirect'] : 0),
                'message' => (isset($rs['message']) ? $rs['message'] : 0),
                'message_info' => (isset($rs['message_info']) ? $rs['message_info'] : 0),
                'id' => (isset($rs['id']) ? $rs['id'] : 0),
                )
            );
        echo json_encode($data);

    }

}
