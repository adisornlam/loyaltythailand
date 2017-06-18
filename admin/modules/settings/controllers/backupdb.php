<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

/*
 *  @Auther : Adisorn Lamsombuth
 *  @Email : postyim@gmail.com
 *  @Website : esabay.com 
 */

/**
 * Description of Backupdb
 *
 * @author R-D-6
 */
class Backupdb extends MX_Controller {

	public function __construct() {
		parent::__construct();
		if (!$this->ion_auth->logged_in()) {
			redirect('login', 'refresh');
		}
	}

	public function index2(){
		$fileName = date('Ymd').'_mybackup.gz';
		$this->load->dbutil();

		$prefs = array(     
			'format'      => 'zip',             
			'filename'    => 'my_db_backup.sql'
			);
		$backup =& $this->dbutil->backup($prefs); 
		$db_name = 'backup-on-'. date("Y-m-d-H-i-s") .'.zip';

		$this->load->helper('file');
		write_file('/home/getsmart/domains/getsmarteasy.com/public_html/downloads/'.$fileName, $backup);

		$this->load->helper('download');
		force_download('mybackup.gz', $backup);
	}

	public function index3()
	{
		$this->load->dbutil();
		$prefs = array(     
			'format'      => 'zip',             
			'filename'    => 'my_db_backup.sql'
			);
		$backup =& $this->dbutil->backup($prefs); 
		$db_name = 'backup-on-'. date("Y-m-d-H-i-s") .'.zip';
		$save = '/home/getsmart/domains/getsmarteasy.com/public_html/downloads/'.$db_name;
		$this->load->helper('file');
		write_file($save, $backup); 
		$this->load->helper('download');
		force_download($db_name, $backup);
	}

	function index($fileName='db_backup.zip'){
		$this->load->dbutil();
		$prefs = array(     
			'format'      => 'zip',             
			'filename'    => 'my_db_backup.sql'
			);
		$backup =& $this->dbutil->backup($prefs); 
		$db_name = 'backup-on-'. date("Y-m-d-H-i-s") .'.zip';
		$save = '/domains/getsmarteasy.com/public_html/downloads/'.$db_name;
		$this->load->helper('file');
		write_file($save, $backup); 
		$this->load->helper('download');
		force_download($db_name, $backup);
	}

}
