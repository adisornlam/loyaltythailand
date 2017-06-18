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
        $this->load->model("store/store_model");
    }

    public function my($name)
    {
        $store = $this->store_model->getStore($name);
        if($store){
            $data = array(
                'web_title' => TITLE,
                'store_name' => $name
                );
            $this->template->load('master2', 'store/member/index', $data);
        }else{
            $data = array(
                'web_title' => 'Not found store :'.TITLE
                );
            $this->template->load('master2', 'store/notfound_store', $data);
        }
        
    }

    public function aboutus($name)
    {
        $data = array(
            'web_title' => TITLE,
            'store_name' => $name
            );
        $this->template->load('master2', 'store/member/aboutus', $data);
    }


    public function contactus($name)
    {
        $data = array(
            'web_title' => TITLE,
            'store_name' => $name
            );
        $this->template->load('master2', 'store/member/contactus', $data);
    }

    public function cart($name)
    {
        $data = array(
            'web_title' => TITLE,
            'store_name' => $name
            );
        $this->template->load('master2', 'store/member/cart', $data);
    }

}
