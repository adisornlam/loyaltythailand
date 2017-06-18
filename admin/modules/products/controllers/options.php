<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 *  @Auther : Adisorn Lamsombuth
 *  @Email : postyim@gmail.com
 *  @Website : esabay.com 
 */

/**
 * Description of options
 *
 * @author R-D-6
 */
class Options extends MX_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->ion_auth->logged_in()) {
            redirect('backend/login', 'refresh');
        } elseif (!$this->ion_auth->is_admin()) {
            return show_error('You must be an administrator to view this page.');
        }
        $this->load->model('products/Options_model', 'options');
    }

    public function index() {
        $data = array(
            'title' => 'Options : E-Office System Management 2014'
        );
        $this->template->load('backend/master', 'products/backend/options/options_index', $data);
    }

    public function add() {
        $group = $this->options->get_group();
        $options = array(
            '' => 'Please select group.'
        );

        if (is_array($group)) {
            foreach ($group as $item) {
                $options[$item->id] = $item->title . "(" . $item->title2 . ")";
            }
        }

        $data = array(
            'group' => $options
        );
        $this->load->view('products/backend/options/options_add', $data);
    }

    public function edit() {
        $group_edit = $this->options->get_edit($this->uri->segment(5));
        $group = $this->options->get_group();

        $options = array(
            '' => 'Please select group.'
        );

        if (is_array($group)) {
            foreach ($group as $item) {
                $options[$item->id] = $item->title . "(" . $item->title2 . ")";
            }
        }

        $data = array(
            'item' => $group_edit[0],
            'group' => $options
        );
        $this->load->view('products/backend/options/options_edit', $data);
    }

    public function group() {
        $data = array(
            'title' => 'Group : E-Office System Management 2014',
            'result' => $this->options->group()
        );
        $this->template->load('backend/master', 'products/backend/options/options_group_index', $data);
    }

    public function group_add() {
        $this->load->view('products/backend/options/options_group_add');
    }

    public function group_edit() {
        $group_edit = $this->options->get_group_edit($this->input->get('id'));
        $data = array(
            'item' => $group_edit[0],
        );
        $this->load->view('products/backend/options/options_group_edit', $data);
    }

}
