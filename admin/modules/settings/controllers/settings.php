<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 *  @Auther : Adisorn Lamsombuth
 *  @Email : postyim@gmail.com
 *  @Website : esabay.com 
 */

/**
 * Description of Setting
 *
 * @author R-D-6
 */
class Settings extends MX_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->ion_auth->logged_in()) {
            redirect('login', 'refresh');
        }
        $this->load->model('settings/Settings_model');
    }

    public function index() {

        $data = array(
            'title' => 'Config : '.TITLE,
            'title_page'=>'Config',
            'item' => $this->Settings_model->get_item(1)
            );
        if ($this->ion_auth->is_admin()) {
            $this->template->load('master', 'settings/setting/admin/index', $data);
        } elseif ($this->ion_auth->in_group('owner')) {
            $this->template->load('master', 'settings/setting/owner/index', $data);
        }else{
            $this->template->load('master', 'templates/not_permission', $data);
        }
    }

    public function backupdb(){
        $fileName = date('Ymd').'_mybackup.gz';
        $this->load->dbutil();

        $backup = $this->dbutil->backup();

        $this->load->helper('file');
        //write_file('/downloads/'.$fileName, $backup);

        //$this->load->helper('download');
        //force_download('mybackup.gz', $backup);
        echo $fileName;
    }

}
