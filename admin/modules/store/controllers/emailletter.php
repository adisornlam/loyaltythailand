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
class Emailletter extends MX_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->ion_auth->logged_in()) {
            redirect('login', 'refresh');
        }
        $this->load->model("emailletter/Emailletter_model");
        $this->load->model("tutor/Student_model");
    }

    function index(){
        $data = array(
            'title' => 'Email-letter : '. TITLE,
            'title_page' => 'แจ้งข่าวสาร'
            );

        $group = array('admin','owner');
        if ($this->ion_auth->in_group($group))
        {
            $this->template->load('master', 'emailletter/owner/index', $data);
        }else{
            $this->template->load('master', 'templates/not_permission', $data);
        }
    }

    public function add() {
        $data = array(
            'title' => 'Email-letter Add : '.TITLE,
            'title_page' => 'Email-letter Add',
            'breadcrumbs' => array(
                'Email-letter Overview' => 'emailletter',
                'Email-letter add' => '#'
                ),
            'ddl_branch' => $this->Common_model->get_branch_ddl()
            );
        $this->template->load('master', 'emailletter/owner/add', $data);
    }

    public function resend() {
        $item = $this->Emailletter_model->get_item($this->uri->segment(3));
        $email_not_list = $this->Emailletter_model->get_email_not_list($item->id, $item->branch_id);
        $data = array(
            'title' => 'Email-letter Re send : '.TITLE,
            'title_page' => 'Email-letter Re send',
            'breadcrumbs' => array(
                'Email-letter Overview' => 'emailletter',
                'Email-letter re send' => '#'
                ),
            'item'=>$item,
            'ddl_branch' => $this->Common_model->get_branch_ddl(),
            'get_email_not_list'=>$email_not_list
            );
        $this->template->load('master', 'emailletter/owner/resend', $data);
    }

    public function save() {
        if($this->uri->segment(3)=='add'){
            $rs = $this->Emailletter_model->add_save();
        }else if($this->uri->segment(3)=='resend'){
            $rs = $this->Emailletter_model->resend_save();
        }else if($this->uri->segment(3)=='delete'){
            $rs = $this->Emailletter_model->delete_save();
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

    public function view() {
        $item = $this->Emailletter_model->get_item($this->uri->segment(3));
        $email_result = $this->Emailletter_model->get_result_email($this->uri->segment(3));
        $email_not_result = $this->Emailletter_model->get_result_email_not($item->id, $item->branch_id);
        $data = array(
            'title' => 'Email-letter View : '.TITLE,
            'title_page' => 'Email-letter View',
            'breadcrumbs' => array(
                'Email-letter Overview' => 'emailletter',
                'Email-letter View' => '#'
                ),
            'ddl_branch' => $this->Common_model->get_branch_ddl(),
            'item'=>$item,
            'email_result'=>$email_result,
            'email_not_result'=>$email_not_result,
            );
        $this->template->load('master', 'emailletter/owner/view', $data);
    }

    public function popup_email(){
        $data = array(
            'group'=>$this->Common_model->get_branch_result()
            );
        $this->load->view('emailletter/owner/popup_email_list',$data);
    }

    function listall(){
        echo $this->Emailletter_model->listall();
    }

}
