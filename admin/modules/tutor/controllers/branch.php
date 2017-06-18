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
class Branch extends MX_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->ion_auth->logged_in()) {
            redirect('login', 'refresh');
        }
        $this->load->model("tutor/Branch_model");
    }

    function index(){
        $data = array(
            'title' => 'Branch : '. TITLE,
            'title_page' => 'Branch'
            );

        $group = array('admin','owner');
        if ($this->ion_auth->in_group($group))
        {
            $this->template->load('master', 'tutor/owner/branch/index', $data);
        }else{
            $this->template->load('master', 'templates/not_permission', $data);
        }
    }


    function listall(){
        echo $this->Branch_model->listall();
    }

    public function add() {
        $this->load->view('tutor/owner/branch/add');
    }

    public function edit() {
        $data = array(
            'item'=>$this->Branch_model->get_item($this->uri->segment(4))
            );
        $this->load->view('tutor/owner/branch/edit',$data);
    }

    public function save() {
        if($this->uri->segment(4)=='add'){
            $rs = $this->Branch_model->add_save();
        }else if($this->uri->segment(4)=='edit'){
            $rs = $this->Branch_model->edit_save();
        }else if($this->uri->segment(4)=='delete'){
            $rs = $this->Branch_model->delete_save();
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
