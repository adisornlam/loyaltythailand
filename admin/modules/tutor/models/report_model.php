<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

/*
 *  @Auther : Adisorn Lamsombuth
 *  @Email : postyim@gmail.com
 *  @Website : esabay.com 
 */

/**
 * Description of Tutor_model
 *
 * @author R-D-6
 */
class Report_model extends CI_Model {

	function __construct() {
		parent::__construct();
	}

	public function studentcourse_listall() {
		$this->load->library('datatables');
		$this->datatables->select(
			'users.id as id, '
			. 'users.id as id2, '
			. 'users.code_member as code_member, '
			. 'users.email as email, '
			. 'users.first_name as first_name, '
			. 'users.last_name as last_name, '
			. 'users.parent_phone as parent_phone, '
			. 'users.created_on as created_on, '
			. 'users.last_login as last_login, '
			. 'users.active as active, '
			. 'branch_item.title as branch_title'
			. '');
		$this->datatables->from('users');
		$this->datatables->join('users_groups', 'users_groups.user_id=users.id', 'inner');
		$this->datatables->join('users_branchs', 'users_branchs.user_id=users.id', 'inner');
		$this->datatables->join('users_courses', 'users_courses.user_id=users.id', 'inner');
		$this->datatables->join('branch_item', 'branch_item.id=users_branchs.branch_id');
		$this->datatables->where('users_groups.group_id',19);
		$this->datatables->where('users.active',1);

		if($this->input->post('branch_id',true)){
			$this->datatables->where('users_branchs.branch_id',$this->input->post('branch_id'));
		}

		if($this->input->post('course_id',true)){
			$this->datatables->where('users_courses.course_id',$this->input->post('course_id'));
		}

		$this->datatables->edit_column('id', '$1', 'id');
		$this->datatables->edit_column('code_member', '<a href="'.base_url().index_page().'tutor/student/view/$1" title="View">$2</a>', 'id2, code_member');
		$this->datatables->add_column('full_name', '$1 $2', 'first_name, last_name');
		$this->datatables->edit_column('active', '$1', 'check_disabled(active,1)');
		return $this->datatables->generate();
	}

	function studentcourse_export_excel(){
		if($this->input->post('branch_id',true)){
			$query_branch = $this->db->get_where('branch_item',array('id'=>$this->input->post('branch_id')));
			$row_branch = $query_branch->row();
		}

		if($this->input->post('branch_id',true)){
			$query_course = $this->db->get_where('course_item',array('id'=>$this->input->post('course_id')));
			$row_course = $query_course->row();
		}

		$this->db->select('users.*, branch_item.title as branch_title, provinces.PROVINCE_NAME as school_provine_title, degree.title as degree_title');
		$this->db->from('users');
		$this->db->join('users_groups', 'users_groups.user_id=users.id', 'inner');
		$this->db->join('users_branchs', 'users_branchs.user_id=users.id', 'inner');
		$this->db->join('users_courses', 'users_courses.user_id=users.id', 'inner');
		$this->db->join('branch_item', 'branch_item.id=users_branchs.branch_id');
		$this->db->join('provinces','provinces.PROVINCE_ID=users.school_province_id','left');
		$this->db->join('degree','degree.id=users.degree_id','left');
		$this->db->where('users_groups.group_id',19);
		$this->db->where('users.active',1);

		if($this->input->post('branch_id',true)){
			$this->db->where('users_branchs.branch_id',$this->input->post('branch_id'));
		}

		if($this->input->post('course_id',true)){
			$this->db->where('users_courses.course_id',$this->input->post('course_id'));
		}
		$query = $this->db->get();
		if (!$query)
			return false;

		$this->load->library('excel');
		$this->excel->setActiveSheetIndex(0);
		$this->excel->getActiveSheet()->getDefaultStyle()->getFont()->setName('angsana new')->setSize(14);

		$fields = $query->list_fields();
		$this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
		$this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
		$this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
		$this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
		$this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(40);
		$this->excel->getActiveSheet()->getColumnDimension('G')->setWidth(30);
		$this->excel->getActiveSheet()->getColumnDimension('H')->setWidth(30);
		$this->excel->getActiveSheet()->getColumnDimension('I')->setWidth(30);
		$this->excel->getActiveSheet()->getColumnDimension('J')->setWidth(15);
		$this->excel->getActiveSheet()->getColumnDimension('K')->setWidth(80);

		$styleArray = array(
			'borders' => array(
				'allborders' => array(
					'style' => PHPExcel_Style_Border::BORDER_THIN
					)
				)
			);

        //merge
		$this->excel->getActiveSheet()->mergeCells('A1:K1');
		$this->excel->getActiveSheet()->mergeCells('A2:K2');
        //bold
		$this->excel->getActiveSheet()->getStyle('A1:K1')->getFont()->setSize(16)->setBold(true);
		$this->excel->getActiveSheet()->getStyle('A2:K2')->getFont()->setSize(14)->setBold(true);
        //center
		$this->excel->getActiveSheet()->getStyle('A1:K2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        //header
		$this->excel->getActiveSheet()->setCellValue("A1", "รายการนักเรียนทั้งหมด");
		$this->excel->getActiveSheet()->setCellValue("A2", $row_course->title.' '.$row_branch->title);

		$this->excel->getActiveSheet()->getStyle('A3:K3')->applyFromArray($styleArray);
		$this->excel->getActiveSheet()->getStyle('A3:K3')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('7FE287');
		$this->excel->getActiveSheet()->getStyle('A3:K3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        //header table
		$this->excel->getActiveSheet()->setCellValue("A3", "No.");
		$this->excel->getActiveSheet()->setCellValue("B3", "Code");
		$this->excel->getActiveSheet()->setCellValue("C3", "Full Name");
		$this->excel->getActiveSheet()->setCellValue("D3", "Nick Name");
		$this->excel->getActiveSheet()->setCellValue("E3", "Degree");
		$this->excel->getActiveSheet()->setCellValue("F3", "School Name");
		$this->excel->getActiveSheet()->setCellValue("G3", "School Province");
		$this->excel->getActiveSheet()->setCellValue("H3", "Parent Name");
		$this->excel->getActiveSheet()->setCellValue("I3", "Email");
		$this->excel->getActiveSheet()->setCellValue("J3", "Phone");
		$this->excel->getActiveSheet()->setCellValue("K3", "Address");

		$row = 4;
		$i = 1;
		foreach ($query->result() as $item) {
			$this->excel->getActiveSheet()->getStyle('A' . $row . ':K' . $row . '')->applyFromArray($styleArray);

			$this->excel->getActiveSheet()->setCellValueExplicit("A" . $row, $i, PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValue("B" . $row, $item->code_member);
			$this->excel->getActiveSheet()->setCellValue("C" . $row, $item->first_name.' '.$item->last_name);
			$this->excel->getActiveSheet()->setCellValue("D" . $row, $item->nick_name);
			$this->excel->getActiveSheet()->setCellValue("E" . $row, $item->degree_title);
			$this->excel->getActiveSheet()->setCellValue("F" . $row, $item->school_name);
			$this->excel->getActiveSheet()->setCellValue("G" . $row, $item->school_provine_title);
			$this->excel->getActiveSheet()->setCellValue("H" . $row, $item->parent_first_name.' '.$item->parent_last_name);
			$this->excel->getActiveSheet()->setCellValue("I" . $row, $item->parent_email);
			$this->excel->getActiveSheet()->setCellValue("J" . $row, $item->parent_phone);
			$this->excel->getActiveSheet()->setCellValue("K" . $row, $item->parent_address);

			$row++;
			$i++;
		}

		$filename = 'report_studentcourse_' . date('Ymd') . '.xlsx';
		$type = 'Excel2007';

		header('Content-type: application/octet-stream; charset=UTF-8');
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="' . $filename . '"');
		header('Cache-Control: max-age=0');

		$cacheMethod = PHPExcel_CachedObjectStorageFactory:: cache_to_phpTemp;
		$cacheSettings = array(' memoryCacheSize ' => '512MB');
		PHPExcel_Settings::setCacheStorageMethod($cacheMethod, $cacheSettings);

		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, $type);
		$objWriter->save('php://output');
	}

	public function get_studentcourse_result(){
		$this->db->select('users.*, branch_item.title as branch_title, provinces.PROVINCE_NAME as school_provine_title, degree.title as degree_title');
		$this->db->from('users');
		$this->db->join('users_groups', 'users_groups.user_id=users.id', 'inner');
		$this->db->join('users_branchs', 'users_branchs.user_id=users.id', 'inner');
		$this->db->join('users_courses', 'users_courses.user_id=users.id', 'inner');
		$this->db->join('branch_item', 'branch_item.id=users_branchs.branch_id');
		$this->db->join('provinces','provinces.PROVINCE_ID=users.school_province_id','left');
		$this->db->join('degree','degree.id=users.degree_id','left');
		$this->db->where('users_groups.group_id',19);
		$this->db->where('users.active',1);

		if($this->input->post('branch_id',true)){
			$this->db->where('users_branchs.branch_id',$this->input->post('branch_id'));
		}

		if($this->input->post('course_id',true)){
			$this->db->where('users_courses.course_id',$this->input->post('course_id'));
		}
		$query = $this->db->get();
		return $query;
	}

	public function book_listall() {
		$this->load->library('datatables');
		$this->datatables->select(
			'users.id as id, '
			. 'users.id as id2, '
			. 'users.code_member as code_member, '
			. 'users.email as email, '
			. 'users.first_name as first_name, '
			. 'users.last_name as last_name, '
			. 'users.parent_phone as parent_phone, '
			. 'users.created_on as created_on, '
			. 'users.last_login as last_login, '
			. 'users.active as active, '
			. 'branch_item.title as branch_title'
			. '');
		$this->datatables->from('users');
		$this->datatables->join('users_groups', 'users_groups.user_id=users.id', 'inner');
		$this->datatables->join('users_branchs', 'users_branchs.user_id=users.id', 'inner');
		$this->datatables->join('users_courses', 'users_courses.user_id=users.id', 'inner');
		$this->datatables->join('branch_item', 'branch_item.id=users_branchs.branch_id');
		$this->datatables->where('users_groups.group_id',19);
		$this->datatables->where('users.active',1);

		if($this->input->post('branch_id',true)){
			$this->datatables->where('users_branchs.branch_id',$this->input->post('branch_id'));
		}

		if($this->input->post('course_id',true)){
			$this->datatables->where('users_courses.course_id',$this->input->post('course_id'));
		}

		$this->datatables->edit_column('id', '$1', 'id');
		$this->datatables->edit_column('code_member', '<a href="'.base_url().index_page().'tutor/student/view/$1" title="View">$2</a>', 'id2, code_member');
		$this->datatables->add_column('full_name', '$1 $2', 'first_name, last_name');
		$this->datatables->edit_column('active', '$1', 'check_disabled(active,1)');
		return $this->datatables->generate();
	}

	function book_export_excel(){
		if($this->input->post('branch_id',true)){
			$query_branch = $this->db->get_where('branch_item',array('id'=>$this->input->post('branch_id')));
			$row_branch = $query_branch->row();
		}

		if($this->input->post('branch_id',true)){
			$query_course = $this->db->get_where('course_item',array('id'=>$this->input->post('course_id')));
			$row_course = $query_course->row();
		}

		$this->db->select('users.*, branch_item.title as branch_title, provinces.PROVINCE_NAME as school_provine_title, degree.title as degree_title');
		$this->db->from('users');
		$this->db->join('users_groups', 'users_groups.user_id=users.id', 'inner');
		$this->db->join('users_branchs', 'users_branchs.user_id=users.id', 'inner');
		$this->db->join('users_courses', 'users_courses.user_id=users.id', 'inner');
		$this->db->join('branch_item', 'branch_item.id=users_branchs.branch_id');
		$this->db->join('provinces','provinces.PROVINCE_ID=users.school_province_id','left');
		$this->db->join('degree','degree.id=users.degree_id','left');
		$this->db->where('users_groups.group_id',19);
		$this->db->where('users.active',1);

		if($this->input->post('branch_id',true)){
			$this->db->where('users_branchs.branch_id',$this->input->post('branch_id'));
		}

		if($this->input->post('course_id',true)){
			$this->db->where('users_courses.course_id',$this->input->post('course_id'));
		}
		$query = $this->db->get();
		if (!$query)
			return false;

		$this->load->library('excel');
		$this->excel->setActiveSheetIndex(0);
		$this->excel->getActiveSheet()->getDefaultStyle()->getFont()->setName('angsana new')->setSize(14);

		$fields = $query->list_fields();
		$this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
		$this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(30);
		$this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
		$this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
		$this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(40);

		$styleArray = array(
			'borders' => array(
				'allborders' => array(
					'style' => PHPExcel_Style_Border::BORDER_THIN
					)
				)
			);

        //merge
		$this->excel->getActiveSheet()->mergeCells('A1:F1');
		$this->excel->getActiveSheet()->mergeCells('A2:F2');
        //bold
		$this->excel->getActiveSheet()->getStyle('A1:F1')->getFont()->setSize(16)->setBold(true);
		$this->excel->getActiveSheet()->getStyle('A2:F2')->getFont()->setSize(14)->setBold(true);
        //center
		$this->excel->getActiveSheet()->getStyle('A1:F2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        //header
		$this->excel->getActiveSheet()->setCellValue("A1", "ใบรับตำราเรียน");
		$this->excel->getActiveSheet()->setCellValue("A2", $row_course->title.' '.$row_branch->title);

		$this->excel->getActiveSheet()->getStyle('A3:F3')->applyFromArray($styleArray);
		$this->excel->getActiveSheet()->getStyle('A3:F3')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('7FE287');
		$this->excel->getActiveSheet()->getStyle('A3:F3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        //header table
		$this->excel->getActiveSheet()->setCellValue("A3", "No.");
		$this->excel->getActiveSheet()->setCellValue("B3", "Full Name");
		$this->excel->getActiveSheet()->setCellValue("C3", "Nick Name");
		$this->excel->getActiveSheet()->setCellValue("D3", "Phone");
		$this->excel->getActiveSheet()->setCellValue("E3", "Signature");
		$this->excel->getActiveSheet()->setCellValue("F3", "Remark");

		$row = 4;
		$i = 1;
		foreach ($query->result() as $item) {
			$this->excel->getActiveSheet()->getStyle('A' . $row . ':F' . $row . '')->applyFromArray($styleArray);

			$this->excel->getActiveSheet()->setCellValueExplicit("A" . $row, $i, PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValue("B" . $row, $item->first_name.' '.$item->last_name);
			$this->excel->getActiveSheet()->setCellValue("C" . $row, $item->nick_name);
			$this->excel->getActiveSheet()->setCellValue("D" . $row, $item->parent_phone);
			$this->excel->getActiveSheet()->setCellValue("E" . $row, '');
			$this->excel->getActiveSheet()->setCellValue("F" . $row, '');

			$row++;
			$i++;
		}

		$filename = 'report_receive_book_' . date('Ymd') . '.xlsx';
		$type = 'Excel2007';

		header('Content-type: application/octet-stream; charset=UTF-8');
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="' . $filename . '"');
		header('Cache-Control: max-age=0');

		$cacheMethod = PHPExcel_CachedObjectStorageFactory:: cache_to_phpTemp;
		$cacheSettings = array(' memoryCacheSize ' => '512MB');
		PHPExcel_Settings::setCacheStorageMethod($cacheMethod, $cacheSettings);

		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, $type);
		$objWriter->save('php://output');
	}

	function get_book_result(){
		$this->db->select('users.*, branch_item.title as branch_title, provinces.PROVINCE_NAME as school_provine_title, degree.title as degree_title');
		$this->db->from('users');
		$this->db->join('users_groups', 'users_groups.user_id=users.id', 'inner');
		$this->db->join('users_branchs', 'users_branchs.user_id=users.id', 'inner');
		$this->db->join('users_courses', 'users_courses.user_id=users.id', 'inner');
		$this->db->join('branch_item', 'branch_item.id=users_branchs.branch_id');
		$this->db->join('provinces','provinces.PROVINCE_ID=users.school_province_id','left');
		$this->db->join('degree','degree.id=users.degree_id','left');
		$this->db->where('users_groups.group_id',19);
		$this->db->where('users.active',1);

		if($this->input->post('branch_id',true)){
			$this->db->where('users_branchs.branch_id',$this->input->post('branch_id'));
		}

		if($this->input->post('course_id',true)){
			$this->db->where('users_courses.course_id',$this->input->post('course_id'));
		}
		$query = $this->db->get();
		return $query;
	}

	public function checkname_listall() {
		$this->load->library('datatables');
		$this->datatables->select(
			'users.id as id, '
			. 'users.id as id2, '
			. 'users.code_member as code_member, '
			. 'users.email as email, '
			. 'users.first_name as first_name, '
			. 'users.last_name as last_name, '
			. 'users.parent_phone as parent_phone, '
			. 'users.created_on as created_on, '
			. 'users.last_login as last_login, '
			. 'users.active as active, '
			. 'branch_item.title as branch_title'
			. '');
		$this->datatables->from('users');
		$this->datatables->join('users_groups', 'users_groups.user_id=users.id', 'inner');
		$this->datatables->join('users_branchs', 'users_branchs.user_id=users.id', 'inner');
		$this->datatables->join('users_courses', 'users_courses.user_id=users.id', 'inner');
		$this->datatables->join('branch_item', 'branch_item.id=users_branchs.branch_id');
		$this->datatables->where('users_groups.group_id',19);
		$this->datatables->where('users.active',1);

		if($this->input->post('branch_id',true)){
			$this->datatables->where('users_branchs.branch_id',$this->input->post('branch_id'));
		}

		if($this->input->post('course_id',true)){
			$this->datatables->where('users_courses.course_id',$this->input->post('course_id'));
		}

		$this->datatables->edit_column('id', '$1', 'id');
		$this->datatables->edit_column('code_member', '<a href="'.base_url().index_page().'tutor/student/view/$1" title="View">$2</a>', 'id2, code_member');
		$this->datatables->add_column('full_name', '$1 $2', 'first_name, last_name');
		$this->datatables->edit_column('active', '$1', 'check_disabled(active,1)');
		return $this->datatables->generate();
	}

	function checkname_export_excel(){
		if($this->input->post('branch_id',true)){
			$query_branch = $this->db->get_where('branch_item',array('id'=>$this->input->post('branch_id')));
			$row_branch = $query_branch->row();
		}

		if($this->input->post('branch_id',true)){
			$query_course = $this->db->get_where('course_item',array('id'=>$this->input->post('course_id')));
			$row_course = $query_course->row();
		}

		$this->db->select('users.*, branch_item.title as branch_title, provinces.PROVINCE_NAME as school_provine_title, degree.title as degree_title');
		$this->db->from('users');
		$this->db->join('users_groups', 'users_groups.user_id=users.id', 'inner');
		$this->db->join('users_branchs', 'users_branchs.user_id=users.id', 'inner');
		$this->db->join('users_courses', 'users_courses.user_id=users.id', 'inner');
		$this->db->join('branch_item', 'branch_item.id=users_branchs.branch_id');
		$this->db->join('provinces','provinces.PROVINCE_ID=users.school_province_id','left');
		$this->db->join('degree','degree.id=users.degree_id','left');
		$this->db->where('users_groups.group_id',19);
		$this->db->where('users.active',1);

		if($this->input->post('branch_id',true)){
			$this->db->where('users_branchs.branch_id',$this->input->post('branch_id'));
		}

		if($this->input->post('course_id',true)){
			$this->db->where('users_courses.course_id',$this->input->post('course_id'));
		}
		$query = $this->db->get();
		if (!$query)
			return false;

		$this->load->library('excel');
		$this->excel->setActiveSheetIndex(0);
		$this->excel->getActiveSheet()->getDefaultStyle()->getFont()->setName('angsana new')->setSize(14);

		$fields = $query->list_fields();
		$this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
		$this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(30);
		$this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
		$this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
		$this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(5);
		$this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(5);
		$this->excel->getActiveSheet()->getColumnDimension('G')->setWidth(5);
		$this->excel->getActiveSheet()->getColumnDimension('H')->setWidth(5);
		$this->excel->getActiveSheet()->getColumnDimension('I')->setWidth(5);
		$this->excel->getActiveSheet()->getColumnDimension('J')->setWidth(5);
		$this->excel->getActiveSheet()->getColumnDimension('K')->setWidth(5);
		$this->excel->getActiveSheet()->getColumnDimension('L')->setWidth(5);
		$this->excel->getActiveSheet()->getColumnDimension('M')->setWidth(5);
		$this->excel->getActiveSheet()->getColumnDimension('N')->setWidth(5);
		$this->excel->getActiveSheet()->getColumnDimension('O')->setWidth(5);
		$this->excel->getActiveSheet()->getColumnDimension('P')->setWidth(5);
		$this->excel->getActiveSheet()->getColumnDimension('Q')->setWidth(40);

		$styleArray = array(
			'borders' => array(
				'allborders' => array(
					'style' => PHPExcel_Style_Border::BORDER_THIN
					)
				)
			);

        //merge
		$this->excel->getActiveSheet()->mergeCells('A1:Q1');
		$this->excel->getActiveSheet()->mergeCells('A2:Q2');
        //bold
		$this->excel->getActiveSheet()->getStyle('A1:Q1')->getFont()->setSize(16)->setBold(true);
		$this->excel->getActiveSheet()->getStyle('A2:Q2')->getFont()->setSize(14)->setBold(true);
        //center
		$this->excel->getActiveSheet()->getStyle('A1:Q2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        //header
		$this->excel->getActiveSheet()->setCellValue("A1", "ใบเช็คชื่อนักเรียน");
		$this->excel->getActiveSheet()->setCellValue("A2", $row_course->title.' '.$row_branch->title);

		$this->excel->getActiveSheet()->getStyle('A3:Q3')->applyFromArray($styleArray);
		$this->excel->getActiveSheet()->getStyle('A3:Q3')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('7FE287');
		$this->excel->getActiveSheet()->getStyle('A3:Q3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        //header table
		$this->excel->getActiveSheet()->setCellValue("A3", "No.");
		$this->excel->getActiveSheet()->setCellValue("B3", "Full Name");
		$this->excel->getActiveSheet()->setCellValue("C3", "Nick Name");
		$this->excel->getActiveSheet()->setCellValue("D3", "Phone");
		$this->excel->getActiveSheet()->setCellValue("E3", "1");
		$this->excel->getActiveSheet()->setCellValue("F3", "2");
		$this->excel->getActiveSheet()->setCellValue("G3", "3");
		$this->excel->getActiveSheet()->setCellValue("H3", "4");
		$this->excel->getActiveSheet()->setCellValue("I3", "5");
		$this->excel->getActiveSheet()->setCellValue("J3", "6");
		$this->excel->getActiveSheet()->setCellValue("K3", "7");
		$this->excel->getActiveSheet()->setCellValue("L3", "8");
		$this->excel->getActiveSheet()->setCellValue("M3", "9");
		$this->excel->getActiveSheet()->setCellValue("N3", "10");
		$this->excel->getActiveSheet()->setCellValue("O3", "11");
		$this->excel->getActiveSheet()->setCellValue("P3", "12");
		$this->excel->getActiveSheet()->setCellValue("Q3", "Remark");

		$row = 4;
		$i = 1;
		foreach ($query->result() as $item) {
			$this->excel->getActiveSheet()->getStyle('A' . $row . ':Q' . $row . '')->applyFromArray($styleArray);

			$this->excel->getActiveSheet()->setCellValueExplicit("A" . $row, $i, PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValue("B" . $row, $item->first_name.' '.$item->last_name);
			$this->excel->getActiveSheet()->setCellValue("C" . $row, $item->nick_name);
			$this->excel->getActiveSheet()->setCellValue("D" . $row, $item->parent_phone);
			$this->excel->getActiveSheet()->setCellValue("E" . $row, '');
			$this->excel->getActiveSheet()->setCellValue("F" . $row, '');
			$this->excel->getActiveSheet()->setCellValue("G" . $row, '');
			$this->excel->getActiveSheet()->setCellValue("H" . $row, '');
			$this->excel->getActiveSheet()->setCellValue("I" . $row, '');
			$this->excel->getActiveSheet()->setCellValue("J" . $row, '');
			$this->excel->getActiveSheet()->setCellValue("K" . $row, '');
			$this->excel->getActiveSheet()->setCellValue("L" . $row, '');
			$this->excel->getActiveSheet()->setCellValue("M" . $row, '');
			$this->excel->getActiveSheet()->setCellValue("N" . $row, '');
			$this->excel->getActiveSheet()->setCellValue("O" . $row, '');
			$this->excel->getActiveSheet()->setCellValue("P" . $row, '');
			$this->excel->getActiveSheet()->setCellValue("Q" . $row, '');

			$row++;
			$i++;
		}

		$filename = 'report_checkname_' . date('Ymd') . '.xlsx';
		$type = 'Excel2007';

		header('Content-type: application/octet-stream; charset=UTF-8');
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="' . $filename . '"');
		header('Cache-Control: max-age=0');

		$cacheMethod = PHPExcel_CachedObjectStorageFactory:: cache_to_phpTemp;
		$cacheSettings = array(' memoryCacheSize ' => '512MB');
		PHPExcel_Settings::setCacheStorageMethod($cacheMethod, $cacheSettings);

		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, $type);
		$objWriter->save('php://output');
	}

	function get_checkname_result(){
		$this->db->select('users.*, branch_item.title as branch_title, provinces.PROVINCE_NAME as school_provine_title, degree.title as degree_title');
		$this->db->from('users');
		$this->db->join('users_groups', 'users_groups.user_id=users.id', 'inner');
		$this->db->join('users_branchs', 'users_branchs.user_id=users.id', 'inner');
		$this->db->join('users_courses', 'users_courses.user_id=users.id', 'inner');
		$this->db->join('branch_item', 'branch_item.id=users_branchs.branch_id');
		$this->db->join('provinces','provinces.PROVINCE_ID=users.school_province_id','left');
		$this->db->join('degree','degree.id=users.degree_id','left');
		$this->db->where('users_groups.group_id',19);
		$this->db->where('users.active',1);

		if($this->input->post('branch_id',true)){
			$this->db->where('users_branchs.branch_id',$this->input->post('branch_id'));
		}

		if($this->input->post('course_id',true)){
			$this->db->where('users_courses.course_id',$this->input->post('course_id'));
		}
		$query = $this->db->get();
		return $query;
	}

	public function studentall_listall() {
		$this->load->library('datatables');
		$this->datatables->select(
			'users.id as id, '
			. 'users.id as id2, '
			. 'users.code_member as code_member, '
			. 'users.email as email, '
			. 'users.first_name as first_name, '
			. 'users.last_name as last_name, '
			. 'users.parent_phone as parent_phone, '
			. 'users.created_on as created_on, '
			. 'users.last_login as last_login, '
			. 'users.active as active, '
			. 'branch_item.title as branch_title'
			. '');
		$this->datatables->from('users');
		$this->datatables->join('users_groups', 'users_groups.user_id=users.id', 'inner');
		$this->datatables->join('users_branchs', 'users_branchs.user_id=users.id', 'inner');
		$this->datatables->join('branch_item', 'branch_item.id=users_branchs.branch_id');
		$this->datatables->where('users_groups.group_id',19);
		$this->datatables->where('users.active',1);
		if($this->input->post('text_search',true)){
			$this->datatables->like('users.first_name',$this->input->post('text_search'));
		}

		if($this->input->post('branch_id',true)){
			$this->datatables->where('users_branchs.branch_id',$this->input->post('branch_id'));
		}

		$link = "<div class=\"dropdown\">";
		$link .= "<a class=\"dropdown-toggle\" data-toggle=\"dropdown\" href=\"javascript:;\"><span class=\"fa fa-pencil-square-o\"></span ></a>";
		$link .= "<ul class=\"dropdown-menu\" role=\"menu\" aria-labelledby=\"dLabel\">";
		$link .= "<li><a href=\"".base_url().index_page()."tutor/student/edit/$1\" class=\"\" title=\"Edit Users\"><i class=\"fa fa-pencil-square-o\" aria-hidden=\"true\"></i>
		Edit</a></li>";
		$link .= "<li><a href=\"javascript:;\" rel=\"settings/users/delete/$1\" class=\"link_dialog delete\" title=\"Delete Users\"><i class=\"fa fa-trash-o\" aria-hidden=\"true\"></i>
		Delete</a></li>";
		$link .= "</ul>";
		$link .= "</div>";

		$this->datatables->edit_column('id', $link, 'id');
		$this->datatables->edit_column('code_member', '<a href="'.base_url().index_page().'tutor/student/view/$1" title="View">$2</a>', 'id2, code_member');
		$this->datatables->add_column('full_name', '$1 $2', 'first_name, last_name');
		$this->datatables->edit_column('active', '$1', 'check_disabled(active,1)');
		return $this->datatables->generate();
	}

	function studentall_export_excel(){
		if($this->input->post('branch_id',true)){
			$query_branch = $this->db->get_where('branch_item',array('id'=>$this->input->post('branch_id')));
			$row_branch = $query_branch->row();
		}

		$this->db->select('users.*, branch_item.title as branch_title, provinces.PROVINCE_NAME as school_provine_title, degree.title as degree_title');
		$this->db->from('users');
		$this->db->join('users_groups', 'users_groups.user_id=users.id', 'inner');
		$this->db->join('users_branchs', 'users_branchs.user_id=users.id', 'inner');
		$this->db->join('branch_item', 'branch_item.id=users_branchs.branch_id');
		$this->db->join('provinces','provinces.PROVINCE_ID=users.school_province_id','left');
		$this->db->join('degree','degree.id=users.degree_id','left');
		$this->db->where('users_groups.group_id',19);
		$this->db->where('users.active',1);
		if($this->input->post('text_search',true)){
			$this->db->like('users.first_name',$this->input->post('text_search'));
		}

		if($this->input->post('branch_id',true)){
			$this->db->where('users_branchs.branch_id',$this->input->post('branch_id'));
		}
		$query = $this->db->get();
		if (!$query)
			return false;

		$this->load->library('excel');
		$this->excel->setActiveSheetIndex(0);
		$this->excel->getActiveSheet()->getDefaultStyle()->getFont()->setName('angsana new')->setSize(14);

		$fields = $query->list_fields();
		$this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
		$this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
		$this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
		$this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
		$this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(40);
		$this->excel->getActiveSheet()->getColumnDimension('G')->setWidth(30);
		$this->excel->getActiveSheet()->getColumnDimension('H')->setWidth(30);
		$this->excel->getActiveSheet()->getColumnDimension('I')->setWidth(30);
		$this->excel->getActiveSheet()->getColumnDimension('J')->setWidth(15);
		$this->excel->getActiveSheet()->getColumnDimension('K')->setWidth(80);

		$styleArray = array(
			'borders' => array(
				'allborders' => array(
					'style' => PHPExcel_Style_Border::BORDER_THIN
					)
				)
			);

        //merge
		$this->excel->getActiveSheet()->mergeCells('A1:K1');
		$this->excel->getActiveSheet()->mergeCells('A2:K2');
        //bold
		$this->excel->getActiveSheet()->getStyle('A1:K1')->getFont()->setSize(16)->setBold(true);
		$this->excel->getActiveSheet()->getStyle('A2:K2')->getFont()->setSize(14)->setBold(true);
        //center
		$this->excel->getActiveSheet()->getStyle('A1:K2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        //header
		$this->excel->getActiveSheet()->setCellValue("A1", "รายการนักเรียนทั้งหมด");
		$this->excel->getActiveSheet()->setCellValue("A2", ($this->input->post('branch_id',true)?$row_branch->title:''));

		$this->excel->getActiveSheet()->getStyle('A3:K3')->applyFromArray($styleArray);
		$this->excel->getActiveSheet()->getStyle('A3:K3')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('7FE287');
		$this->excel->getActiveSheet()->getStyle('A3:K3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        //header table
		$this->excel->getActiveSheet()->setCellValue("A3", "No.");
		$this->excel->getActiveSheet()->setCellValue("B3", "Code");
		$this->excel->getActiveSheet()->setCellValue("C3", "Full Name");
		$this->excel->getActiveSheet()->setCellValue("D3", "Nick Name");
		$this->excel->getActiveSheet()->setCellValue("E3", "Degree");
		$this->excel->getActiveSheet()->setCellValue("F3", "School Name");
		$this->excel->getActiveSheet()->setCellValue("G3", "School Province");
		$this->excel->getActiveSheet()->setCellValue("H3", "Parent Name");
		$this->excel->getActiveSheet()->setCellValue("I3", "Email");
		$this->excel->getActiveSheet()->setCellValue("J3", "Phone");
		$this->excel->getActiveSheet()->setCellValue("K3", "Address");

		$row = 4;
		$i = 1;
		foreach ($query->result() as $item) {
			$this->excel->getActiveSheet()->getStyle('A' . $row . ':K' . $row . '')->applyFromArray($styleArray);

			$this->excel->getActiveSheet()->setCellValueExplicit("A" . $row, $i, PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValue("B" . $row, $item->code_member);
			$this->excel->getActiveSheet()->setCellValue("C" . $row, $item->first_name.' '.$item->last_name);
			$this->excel->getActiveSheet()->setCellValue("D" . $row, $item->nick_name);
			$this->excel->getActiveSheet()->setCellValue("E" . $row, $item->degree_title);
			$this->excel->getActiveSheet()->setCellValue("F" . $row, $item->school_name);
			$this->excel->getActiveSheet()->setCellValue("G" . $row, $item->school_provine_title);
			$this->excel->getActiveSheet()->setCellValue("H" . $row, $item->parent_first_name.' '.$item->parent_last_name);
			$this->excel->getActiveSheet()->setCellValue("I" . $row, $item->parent_email);
			$this->excel->getActiveSheet()->setCellValue("J" . $row, $item->parent_phone);
			$this->excel->getActiveSheet()->setCellValue("K" . $row, $item->parent_address);

			$row++;
			$i++;
		}

		$filename = 'report_studentall_' . date('Ymd') . '.xlsx';
		$type = 'Excel2007';

		header('Content-type: application/octet-stream; charset=UTF-8');
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="' . $filename . '"');
		header('Cache-Control: max-age=0');

		$cacheMethod = PHPExcel_CachedObjectStorageFactory:: cache_to_phpTemp;
		$cacheSettings = array(' memoryCacheSize ' => '512MB');
		PHPExcel_Settings::setCacheStorageMethod($cacheMethod, $cacheSettings);

		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, $type);
		$objWriter->save('php://output');
	}

	function get_studentall_result(){
		$this->db->select('users.*, branch_item.title as branch_title, provinces.PROVINCE_NAME as school_provine_title, degree.title as degree_title');
		$this->db->from('users');
		$this->db->join('users_groups', 'users_groups.user_id=users.id', 'inner');
		$this->db->join('users_branchs', 'users_branchs.user_id=users.id', 'inner');
		$this->db->join('branch_item', 'branch_item.id=users_branchs.branch_id');
		$this->db->join('provinces','provinces.PROVINCE_ID=users.school_province_id','left');
		$this->db->join('degree','degree.id=users.degree_id','left');
		$this->db->where('users_groups.group_id',19);
		$this->db->where('users.active',1);
		if($this->input->post('text_search',true)){
			$this->db->like('users.first_name',$this->input->post('text_search'));
		}

		if($this->input->post('branch_id',true)){
			$this->db->where('users_branchs.branch_id',$this->input->post('branch_id'));
		}
		$query = $this->db->get();
		return $query;
	}

	public function signtest_listall() {
		$this->load->library('datatables');
		$this->datatables->select(
			'users.id as id, '
			. 'users.id as id2, '
			. 'users.code_member as code_member, '
			. 'users.email as email, '
			. 'users.first_name as first_name, '
			. 'users.last_name as last_name, '
			. 'users.parent_phone as parent_phone, '
			. 'users.created_on as created_on, '
			. 'users.last_login as last_login, '
			. 'users.active as active, '
			. 'branch_item.title as branch_title'
			. '');
		$this->datatables->from('users');
		$this->datatables->join('users_groups', 'users_groups.user_id=users.id', 'inner');
		$this->datatables->join('users_branchs', 'users_branchs.user_id=users.id', 'inner');
		$this->datatables->join('users_courses', 'users_courses.user_id=users.id', 'inner');
		$this->datatables->join('branch_item', 'branch_item.id=users_branchs.branch_id');
		$this->datatables->where('users_groups.group_id',19);
		$this->datatables->where('users.active',1);

		if($this->input->post('branch_id',true)){
			$this->datatables->where('users_branchs.branch_id',$this->input->post('branch_id'));
		}

		if($this->input->post('course_id',true)){
			$this->datatables->where('users_courses.course_id',$this->input->post('course_id'));
		}

		$this->datatables->edit_column('id', '$1', 'id');
		$this->datatables->edit_column('code_member', '<a href="'.base_url().index_page().'tutor/student/view/$1" title="View">$2</a>', 'id2, code_member');
		$this->datatables->add_column('full_name', '$1 $2', 'first_name, last_name');
		$this->datatables->edit_column('active', '$1', 'check_disabled(active,1)');
		return $this->datatables->generate();
	}

	function signtest_export_excel(){
		if($this->input->post('branch_id',true)){
			$query_branch = $this->db->get_where('branch_item',array('id'=>$this->input->post('branch_id')));
			$row_branch = $query_branch->row();
		}

		if($this->input->post('course_id',true)){
			$query_course = $this->db->get_where('course_item',array('id'=>$this->input->post('course_id')));
			$row_course = $query_course->row();
		}

		$this->db->select('users.*, branch_item.title as branch_title, provinces.PROVINCE_NAME as school_provine_title, degree.title as degree_title');
		$this->db->from('users');
		$this->db->join('users_groups', 'users_groups.user_id=users.id', 'inner');
		$this->db->join('users_branchs', 'users_branchs.user_id=users.id', 'inner');
		$this->db->join('users_courses', 'users_courses.user_id=users.id', 'inner');
		$this->db->join('branch_item', 'branch_item.id=users_branchs.branch_id');
		$this->db->join('provinces','provinces.PROVINCE_ID=users.school_province_id','left');
		$this->db->join('degree','degree.id=users.degree_id','left');
		$this->db->where('users_groups.group_id',19);
		$this->db->where('users.active',1);

		if($this->input->post('branch_id',true)){
			$this->db->where('users_branchs.branch_id',$this->input->post('branch_id'));
		}

		if($this->input->post('course_id',true)){
			$this->db->where('users_courses.course_id',$this->input->post('course_id'));
		}
		$query = $this->db->get();
		if (!$query)
			return false;

		$this->load->library('excel');
		$this->excel->setActiveSheetIndex(0);
		$this->excel->getActiveSheet()->getDefaultStyle()->getFont()->setName('angsana new')->setSize(14);

		$fields = $query->list_fields();
		$this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
		$this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(30);
		$this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
		$this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(40);
		$this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(30);

		$styleArray = array(
			'borders' => array(
				'allborders' => array(
					'style' => PHPExcel_Style_Border::BORDER_THIN
					)
				)
			);

        //merge
		$this->excel->getActiveSheet()->mergeCells('A1:F1');
		$this->excel->getActiveSheet()->mergeCells('A2:F2');
        //bold
		$this->excel->getActiveSheet()->getStyle('A1:F1')->getFont()->setSize(16)->setBold(true);
		$this->excel->getActiveSheet()->getStyle('A2:F2')->getFont()->setSize(14)->setBold(true);
        //center
		$this->excel->getActiveSheet()->getStyle('A1:F2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        //header
		$this->excel->getActiveSheet()->setCellValue("A1", "ใบรายชื่อนักเรียนเข้าห้องสอบ");
		$this->excel->getActiveSheet()->setCellValue("A2", $row_course->title.' '.$row_branch->title);

		$this->excel->getActiveSheet()->getStyle('A3:F3')->applyFromArray($styleArray);
		$this->excel->getActiveSheet()->getStyle('A3:F3')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('7FE287');
		$this->excel->getActiveSheet()->getStyle('A3:F3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        //header table
		$this->excel->getActiveSheet()->setCellValue("A3", "No.");
		$this->excel->getActiveSheet()->setCellValue("B3", "Full Name");
		$this->excel->getActiveSheet()->setCellValue("C3", "Nick Name");
		$this->excel->getActiveSheet()->setCellValue("D3", "School Name");
		$this->excel->getActiveSheet()->setCellValue("E3", "Signature");
		$this->excel->getActiveSheet()->setCellValue("F3", "Score........");

		$row = 4;
		$i = 1;
		foreach ($query->result() as $item) {
			$this->excel->getActiveSheet()->getStyle('A' . $row . ':F' . $row . '')->applyFromArray($styleArray);

			$this->excel->getActiveSheet()->setCellValueExplicit("A" . $row, $i, PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValue("B" . $row, $item->first_name.' '.$item->last_name);
			$this->excel->getActiveSheet()->setCellValue("C" . $row, $item->nick_name);
			$this->excel->getActiveSheet()->setCellValue("D" . $row, $item->school_name);
			$this->excel->getActiveSheet()->setCellValue("E" . $row, '');
			$this->excel->getActiveSheet()->setCellValue("F" . $row, '');

			$row++;
			$i++;
		}

		$filename = 'report_signtest_' . date('Ymd') . '.xlsx';
		$type = 'Excel2007';

		header('Content-type: application/octet-stream; charset=UTF-8');
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="' . $filename . '"');
		header('Cache-Control: max-age=0');

		$cacheMethod = PHPExcel_CachedObjectStorageFactory:: cache_to_phpTemp;
		$cacheSettings = array(' memoryCacheSize ' => '512MB');
		PHPExcel_Settings::setCacheStorageMethod($cacheMethod, $cacheSettings);

		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, $type);
		$objWriter->save('php://output');
	}

	function get_signtest_result(){
		$this->db->select('users.*, branch_item.title as branch_title, provinces.PROVINCE_NAME as school_provine_title, degree.title as degree_title');
		$this->db->from('users');
		$this->db->join('users_groups', 'users_groups.user_id=users.id', 'inner');
		$this->db->join('users_branchs', 'users_branchs.user_id=users.id', 'inner');
		$this->db->join('users_courses', 'users_courses.user_id=users.id', 'inner');
		$this->db->join('branch_item', 'branch_item.id=users_branchs.branch_id');
		$this->db->join('provinces','provinces.PROVINCE_ID=users.school_province_id','left');
		$this->db->join('degree','degree.id=users.degree_id','left');
		$this->db->where('users_groups.group_id',19);
		$this->db->where('users.active',1);

		if($this->input->post('branch_id',true)){
			$this->db->where('users_branchs.branch_id',$this->input->post('branch_id'));
		}

		if($this->input->post('course_id',true)){
			$this->db->where('users_courses.course_id',$this->input->post('course_id'));
		}
		$query = $this->db->get();
		return $query;
	}

	public function examresult_listall() {
		$this->load->library('datatables');
		$this->datatables->select(
			'us.code_member as code_member, '
			. 'us.first_name as first_name, '
			. 'us.last_name as last_name, '
			. 'uc.total_score as total_score'
			. '');
		$this->datatables->from('users_courses uc');
		$this->datatables->join('users us', 'us.id = uc.user_id', 'inner');

		if($this->input->post('course_id',true)){
			$this->datatables->where('uc.course_id',$this->input->post('course_id'));
		}

		$this->datatables->add_column('full_name', '$1 $2', 'first_name, last_name');
		return $this->datatables->generate();
	}

	function examresult_export_excel(){
		if($this->input->post('branch_id',true)){
			$query_branch = $this->db->get_where('branch_item',array('id'=>$this->input->post('branch_id')));
			$row_branch = $query_branch->row();
		}
		if($this->input->post('course_id',true)){
			$query_course = $this->db->get_where('course_item',array('id'=>$this->input->post('course_id')));
			$row_course = $query_course->row();
		}

		$this->db->select('us.code_member as code_member, us.first_name as first_name, us.last_name as last_name, uc.total_score as total_score');
		$this->db->from('users_courses uc');
		$this->db->join('users us', 'us.id = uc.user_id', 'inner');
		if($this->input->post('course_id',true)){
			$this->db->where('uc.course_id',$this->input->post('course_id'));
		}
		$this->db->order_by('total_score','desc');
		$query = $this->db->get();
		if (!$query)
			return false;

		$this->load->library('excel');
		$this->excel->setActiveSheetIndex(0);
		$this->excel->getActiveSheet()->getDefaultStyle()->getFont()->setName('angsana new')->setSize(14);

		$fields = $query->list_fields();
		$this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(80);
		$this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(15);

		$styleArray = array(
			'borders' => array(
				'allborders' => array(
					'style' => PHPExcel_Style_Border::BORDER_THIN
					)
				)
			);

        //merge
		$this->excel->getActiveSheet()->mergeCells('A1:C1');
		$this->excel->getActiveSheet()->mergeCells('A2:C2');
        //bold
		$this->excel->getActiveSheet()->getStyle('A1:C1')->getFont()->setSize(16)->setBold(true);
		$this->excel->getActiveSheet()->getStyle('A2:C2')->getFont()->setSize(14)->setBold(true);
        //center
		$this->excel->getActiveSheet()->getStyle('A1:C2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        //header
		$this->excel->getActiveSheet()->setCellValue("A1", "ใบประกาศผลสอบ");
		$this->excel->getActiveSheet()->setCellValue("A2", $row_course->code_no.' '.$row_course->title.' '.$row_branch->title);

		$this->excel->getActiveSheet()->getStyle('A3:C3')->applyFromArray($styleArray);
		$this->excel->getActiveSheet()->getStyle('A3:C3')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('7FE287');
		$this->excel->getActiveSheet()->getStyle('A3:C3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        //header table
		$this->excel->getActiveSheet()->setCellValue("A3", "Code");
		$this->excel->getActiveSheet()->setCellValue("B3", "Full Name");
		$this->excel->getActiveSheet()->setCellValue("C3", "Score");

		$row = 4;
		$i = 1;
		foreach ($query->result() as $item) {
			$this->excel->getActiveSheet()->getStyle('A' . $row . ':C' . $row . '')->applyFromArray($styleArray);

			$this->excel->getActiveSheet()->setCellValueExplicit("A" . $row, $item->code_member);
			$this->excel->getActiveSheet()->setCellValue("B" . $row, $item->first_name.' '.$item->last_name);
			$this->excel->getActiveSheet()->setCellValue("C" . $row, $item->total_score);

			$row++;
			$i++;
		}

		$filename = 'report_examresult_' . date('Ymd') . '.xlsx';
		$type = 'Excel2007';

		header('Content-type: application/octet-stream; charset=UTF-8');
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="' . $filename . '"');
		header('Cache-Control: max-age=0');

		$cacheMethod = PHPExcel_CachedObjectStorageFactory:: cache_to_phpTemp;
		$cacheSettings = array(' memoryCacheSize ' => '512MB');
		PHPExcel_Settings::setCacheStorageMethod($cacheMethod, $cacheSettings);

		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, $type);
		$objWriter->save('php://output');
	}

	function get_examresult_result(){
		$this->db->select('us.code_member as code_member, us.first_name as first_name, us.last_name as last_name, uc.total_score as total_score');
		$this->db->from('users_courses uc');
		$this->db->join('users us', 'us.id = uc.user_id', 'inner');
		if($this->input->post('course_id',true)){
			$this->db->where('uc.course_id',$this->input->post('course_id'));
		}
		$this->db->order_by('total_score','desc');
		$query = $this->db->get();
		return $query;
	}

	public function confirmprivate_listall() {
		$this->load->library('datatables');
		$this->datatables->select(
			'users.id as id, '
			. 'users.id as id2, '
			. 'users.code_member as code_member, '
			. 'users.email as email, '
			. 'users.first_name as first_name, '
			. 'users.last_name as last_name, '
			. 'users.parent_phone as parent_phone, '
			. 'users.created_on as created_on, '
			. 'users.last_login as last_login, '
			. 'users.active as active, '
			. 'branch_item.title as branch_title'
			. '');
		$this->datatables->from('users');
		$this->datatables->join('users_groups', 'users_groups.user_id=users.id', 'inner');
		$this->datatables->join('users_branchs', 'users_branchs.user_id=users.id', 'inner');
		$this->datatables->join('users_courses', 'users_courses.user_id=users.id', 'inner');
		$this->datatables->join('branch_item', 'branch_item.id=users_branchs.branch_id');
		$this->datatables->where('users_groups.group_id',19);
		$this->datatables->where('users.active',1);
		$this->datatables->where('users.private',1);

		if($this->input->post('branch_id',true)){
			$this->datatables->where('users_branchs.branch_id',$this->input->post('branch_id'));
		}

		if($this->input->post('course_id',true)){
			$this->datatables->where('users_courses.course_id',$this->input->post('course_id'));
		}

		$this->datatables->edit_column('id', '$1', 'id');
		$this->datatables->edit_column('code_member', '<a href="'.base_url().index_page().'tutor/student/view/$1" title="View">$2</a>', 'id2, code_member');
		$this->datatables->add_column('full_name', '$1 $2', 'first_name, last_name');
		$this->datatables->edit_column('active', '$1', 'check_disabled(active,1)');
		return $this->datatables->generate();
	}

	function confirmprivate_export_excel(){
		if($this->input->post('branch_id',true)){
			$query_branch = $this->db->get_where('branch_item',array('id'=>$this->input->post('branch_id')));
			$row_branch = $query_branch->row();
		}

		if($this->input->post('branch_id',true)){
			$query_course = $this->db->get_where('course_item',array('id'=>$this->input->post('course_id')));
			$row_course = $query_course->row();
		}

		$this->db->select('users.*, branch_item.title as branch_title, provinces.PROVINCE_NAME as school_provine_title, degree.title as degree_title');
		$this->db->from('users');
		$this->db->join('users_groups', 'users_groups.user_id=users.id', 'inner');
		$this->db->join('users_branchs', 'users_branchs.user_id=users.id', 'inner');
		$this->db->join('users_courses', 'users_courses.user_id=users.id', 'inner');
		$this->db->join('branch_item', 'branch_item.id=users_branchs.branch_id');
		$this->db->join('provinces','provinces.PROVINCE_ID=users.school_province_id','left');
		$this->db->join('degree','degree.id=users.degree_id','left');
		$this->db->where('users_groups.group_id',19);
		$this->db->where('users.active',1);
		$this->db->where('users.private',1);

		if($this->input->post('branch_id',true)){
			$this->db->where('users_branchs.branch_id',$this->input->post('branch_id'));
		}

		if($this->input->post('course_id',true)){
			$this->db->where('users_courses.course_id',$this->input->post('course_id'));
		}
		$query = $this->db->get();
		if (!$query)
			return false;

		$this->load->library('excel');
		$this->excel->setActiveSheetIndex(0);
		$this->excel->getActiveSheet()->getDefaultStyle()->getFont()->setName('angsana new')->setSize(14);

		$fields = $query->list_fields();
		$this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
		$this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
		$this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
		$this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
		$this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(40);
		$this->excel->getActiveSheet()->getColumnDimension('G')->setWidth(30);
		$this->excel->getActiveSheet()->getColumnDimension('H')->setWidth(30);
		$this->excel->getActiveSheet()->getColumnDimension('I')->setWidth(30);
		$this->excel->getActiveSheet()->getColumnDimension('J')->setWidth(15);
		$this->excel->getActiveSheet()->getColumnDimension('K')->setWidth(80);

		$styleArray = array(
			'borders' => array(
				'allborders' => array(
					'style' => PHPExcel_Style_Border::BORDER_THIN
					)
				)
			);

        //merge
		$this->excel->getActiveSheet()->mergeCells('A1:K1');
		$this->excel->getActiveSheet()->mergeCells('A2:K2');
        //bold
		$this->excel->getActiveSheet()->getStyle('A1:K1')->getFont()->setSize(16)->setBold(true);
		$this->excel->getActiveSheet()->getStyle('A2:K2')->getFont()->setSize(14)->setBold(true);
        //center
		$this->excel->getActiveSheet()->getStyle('A1:K2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        //header
		$this->excel->getActiveSheet()->setCellValue("A1", "รายการนักเรียน Private");
		$this->excel->getActiveSheet()->setCellValue("A2", $row_course->title.' '.$row_branch->title);

		$this->excel->getActiveSheet()->getStyle('A3:K3')->applyFromArray($styleArray);
		$this->excel->getActiveSheet()->getStyle('A3:K3')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('7FE287');
		$this->excel->getActiveSheet()->getStyle('A3:K3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        //header table
		$this->excel->getActiveSheet()->setCellValue("A3", "No.");
		$this->excel->getActiveSheet()->setCellValue("B3", "Code");
		$this->excel->getActiveSheet()->setCellValue("C3", "Full Name");
		$this->excel->getActiveSheet()->setCellValue("D3", "Nick Name");
		$this->excel->getActiveSheet()->setCellValue("E3", "Degree");
		$this->excel->getActiveSheet()->setCellValue("F3", "School Name");
		$this->excel->getActiveSheet()->setCellValue("G3", "School Province");
		$this->excel->getActiveSheet()->setCellValue("H3", "Parent Name");
		$this->excel->getActiveSheet()->setCellValue("I3", "Email");
		$this->excel->getActiveSheet()->setCellValue("J3", "Phone");
		$this->excel->getActiveSheet()->setCellValue("K3", "Address");

		$row = 4;
		$i = 1;
		foreach ($query->result() as $item) {
			$this->excel->getActiveSheet()->getStyle('A' . $row . ':K' . $row . '')->applyFromArray($styleArray);

			$this->excel->getActiveSheet()->setCellValueExplicit("A" . $row, $i, PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValue("B" . $row, $item->code_member);
			$this->excel->getActiveSheet()->setCellValue("C" . $row, $item->first_name.' '.$item->last_name);
			$this->excel->getActiveSheet()->setCellValue("D" . $row, $item->nick_name);
			$this->excel->getActiveSheet()->setCellValue("E" . $row, $item->degree_title);
			$this->excel->getActiveSheet()->setCellValue("F" . $row, $item->school_name);
			$this->excel->getActiveSheet()->setCellValue("G" . $row, $item->school_provine_title);
			$this->excel->getActiveSheet()->setCellValue("H" . $row, $item->parent_first_name.' '.$item->parent_last_name);
			$this->excel->getActiveSheet()->setCellValue("I" . $row, $item->parent_email);
			$this->excel->getActiveSheet()->setCellValue("J" . $row, $item->parent_phone);
			$this->excel->getActiveSheet()->setCellValue("K" . $row, $item->parent_address);

			$row++;
			$i++;
		}

		$filename = 'report_student_private_' . date('Ymd') . '.xlsx';
		$type = 'Excel2007';

		header('Content-type: application/octet-stream; charset=UTF-8');
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="' . $filename . '"');
		header('Cache-Control: max-age=0');

		$cacheMethod = PHPExcel_CachedObjectStorageFactory:: cache_to_phpTemp;
		$cacheSettings = array(' memoryCacheSize ' => '512MB');
		PHPExcel_Settings::setCacheStorageMethod($cacheMethod, $cacheSettings);

		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, $type);
		$objWriter->save('php://output');
	}

	function get_confirmprivate_result(){
		$this->db->select('users.*, branch_item.title as branch_title, provinces.PROVINCE_NAME as school_provine_title, degree.title as degree_title');
		$this->db->from('users');
		$this->db->join('users_groups', 'users_groups.user_id=users.id', 'inner');
		$this->db->join('users_branchs', 'users_branchs.user_id=users.id', 'inner');
		$this->db->join('users_courses', 'users_courses.user_id=users.id', 'inner');
		$this->db->join('branch_item', 'branch_item.id=users_branchs.branch_id');
		$this->db->join('provinces','provinces.PROVINCE_ID=users.school_province_id','left');
		$this->db->join('degree','degree.id=users.degree_id','left');
		$this->db->where('users_groups.group_id',19);
		$this->db->where('users.active',1);
		$this->db->where('users.private',1);

		if($this->input->post('branch_id',true)){
			$this->db->where('users_branchs.branch_id',$this->input->post('branch_id'));
		}

		if($this->input->post('course_id',true)){
			$this->db->where('users_courses.course_id',$this->input->post('course_id'));
		}
		$query = $this->db->get();
		return $query;
	}

	public function signname_listall() {
		$this->load->library('datatables');
		$this->datatables->select(
			'users.id as id, '
			. 'users.id as id2, '
			. 'users.code_member as code_member, '
			. 'users.email as email, '
			. 'users.first_name as first_name, '
			. 'users.last_name as last_name, '
			. 'users.parent_phone as parent_phone, '
			. 'users.created_on as created_on, '
			. 'users.last_login as last_login, '
			. 'users.active as active, '
			. 'branch_item.title as branch_title'
			. '');
		$this->datatables->from('users');
		$this->datatables->join('users_groups', 'users_groups.user_id=users.id', 'inner');
		$this->datatables->join('users_branchs', 'users_branchs.user_id=users.id', 'inner');
		$this->datatables->join('users_courses', 'users_courses.user_id=users.id', 'inner');
		$this->datatables->join('branch_item', 'branch_item.id=users_branchs.branch_id');
		$this->datatables->where('users_groups.group_id',19);
		$this->datatables->where('users.active',1);

		if($this->input->post('branch_id',true)){
			$this->datatables->where('users_branchs.branch_id',$this->input->post('branch_id'));
		}

		if($this->input->post('course_id',true)){
			$this->datatables->where('users_courses.course_id',$this->input->post('course_id'));
		}

		$this->datatables->edit_column('id', '$1', 'id');
		$this->datatables->edit_column('code_member', '<a href="'.base_url().index_page().'tutor/student/view/$1" title="View">$2</a>', 'id2, code_member');
		$this->datatables->add_column('full_name', '$1 $2', 'first_name, last_name');
		$this->datatables->edit_column('active', '$1', 'check_disabled(active,1)');
		return $this->datatables->generate();
	}

	function signname_export_excel(){
		if($this->input->post('branch_id',true)){
			$query_branch = $this->db->get_where('branch_item',array('id'=>$this->input->post('branch_id')));
			$row_branch = $query_branch->row();
		}

		if($this->input->post('course_id',true)){
			$query_course = $this->db->get_where('course_item',array('id'=>$this->input->post('course_id')));
			$row_course = $query_course->row();
		}

		$this->db->select('users.*, branch_item.title as branch_title, provinces.PROVINCE_NAME as school_provine_title, degree.title as degree_title');
		$this->db->from('users');
		$this->db->join('users_groups', 'users_groups.user_id=users.id', 'inner');
		$this->db->join('users_branchs', 'users_branchs.user_id=users.id', 'inner');
		$this->db->join('users_courses', 'users_courses.user_id=users.id', 'inner');
		$this->db->join('branch_item', 'branch_item.id=users_branchs.branch_id');
		$this->db->join('provinces','provinces.PROVINCE_ID=users.school_province_id','left');
		$this->db->join('degree','degree.id=users.degree_id','left');
		$this->db->where('users_groups.group_id',19);
		$this->db->where('users.active',1);

		if($this->input->post('branch_id',true)){
			$this->db->where('users_branchs.branch_id',$this->input->post('branch_id'));
		}

		if($this->input->post('course_id',true)){
			$this->db->where('users_courses.course_id',$this->input->post('course_id'));
		}
		$query = $this->db->get();
		if (!$query)
			return false;

		$this->load->library('excel');
		$this->excel->setActiveSheetIndex(0);
		$this->excel->getActiveSheet()->getDefaultStyle()->getFont()->setName('angsana new')->setSize(14);

		$fields = $query->list_fields();
		$this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
		$this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(30);
		$this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
		$this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
		$this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(40);

		$styleArray = array(
			'borders' => array(
				'allborders' => array(
					'style' => PHPExcel_Style_Border::BORDER_THIN
					)
				)
			);

        //merge
		$this->excel->getActiveSheet()->mergeCells('A1:F1');
		$this->excel->getActiveSheet()->mergeCells('A2:F2');
        //bold
		$this->excel->getActiveSheet()->getStyle('A1:F1')->getFont()->setSize(16)->setBold(true);
		$this->excel->getActiveSheet()->getStyle('A2:F2')->getFont()->setSize(14)->setBold(true);
        //center
		$this->excel->getActiveSheet()->getStyle('A1:F2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        //header
		$this->excel->getActiveSheet()->setCellValue("A1", "ใบเช็คชื่อ");
		$this->excel->getActiveSheet()->setCellValue("A2", $row_course->title.' '.$row_branch->title);

		$this->excel->getActiveSheet()->getStyle('A3:F3')->applyFromArray($styleArray);
		$this->excel->getActiveSheet()->getStyle('A3:F3')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('7FE287');
		$this->excel->getActiveSheet()->getStyle('A3:F3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        //header table
		$this->excel->getActiveSheet()->setCellValue("A3", "No.");
		$this->excel->getActiveSheet()->setCellValue("B3", "Full Name");
		$this->excel->getActiveSheet()->setCellValue("C3", "Nick Name");
		$this->excel->getActiveSheet()->setCellValue("D3", "Phone");
		$this->excel->getActiveSheet()->setCellValue("E3", "Signature");
		$this->excel->getActiveSheet()->setCellValue("F3", "Remark");

		$row = 4;
		$i = 1;
		foreach ($query->result() as $item) {
			$this->excel->getActiveSheet()->getStyle('A' . $row . ':F' . $row . '')->applyFromArray($styleArray);

			$this->excel->getActiveSheet()->setCellValueExplicit("A" . $row, $i, PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValue("B" . $row, $item->first_name.' '.$item->last_name);
			$this->excel->getActiveSheet()->setCellValue("C" . $row, $item->nick_name);
			$this->excel->getActiveSheet()->setCellValue("D" . $row, $item->parent_phone);
			$this->excel->getActiveSheet()->setCellValue("E" . $row, '');
			$this->excel->getActiveSheet()->setCellValue("F" . $row, '');

			$row++;
			$i++;
		}

		$filename = 'report_signname_' . date('Ymd') . '.xlsx';
		$type = 'Excel2007';

		header('Content-type: application/octet-stream; charset=UTF-8');
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="' . $filename . '"');
		header('Cache-Control: max-age=0');

		$cacheMethod = PHPExcel_CachedObjectStorageFactory:: cache_to_phpTemp;
		$cacheSettings = array(' memoryCacheSize ' => '512MB');
		PHPExcel_Settings::setCacheStorageMethod($cacheMethod, $cacheSettings);

		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, $type);
		$objWriter->save('php://output');
	}

	function get_signname_result(){
		$this->db->select('users.*, branch_item.title as branch_title, provinces.PROVINCE_NAME as school_provine_title, degree.title as degree_title');
		$this->db->from('users');
		$this->db->join('users_groups', 'users_groups.user_id=users.id', 'inner');
		$this->db->join('users_branchs', 'users_branchs.user_id=users.id', 'inner');
		$this->db->join('users_courses', 'users_courses.user_id=users.id', 'inner');
		$this->db->join('branch_item', 'branch_item.id=users_branchs.branch_id');
		$this->db->join('provinces','provinces.PROVINCE_ID=users.school_province_id','left');
		$this->db->join('degree','degree.id=users.degree_id','left');
		$this->db->where('users_groups.group_id',19);
		$this->db->where('users.active',1);

		if($this->input->post('branch_id',true)){
			$this->db->where('users_branchs.branch_id',$this->input->post('branch_id'));
		}

		if($this->input->post('course_id',true)){
			$this->db->where('users_courses.course_id',$this->input->post('course_id'));
		}
		$query = $this->db->get();
		return $query;
	}

	public function timeattendance_listall() {
		$this->load->library('datatables');
		$this->datatables->select(
			'a.id as id, '
			. 'a.code_member as code_member, '
			. 'a.user_id as user_id, '
			. 'u.first_name as first_name, '
			. 'u.last_name as last_name, '
			. 'a.created_at as date, '
			. 'MIN(a.created_at) as first_time, '
			. 'MAX(a.created_at) as last_time'
			. '');
		$this->datatables->from('time_attendance_student a');
		$this->datatables->join('users u', 'u.id=a.user_id', 'inner');

		$this->datatables->where("a.created_at BETWEEN '" . $this->input->post('date_from') . " 00:00:01' AND '" . $this->input->post('date_to') . " 23:59:59' ", NULL, FALSE);

		$this->datatables->where('u.active',1);
		$this->datatables->group_by(array('a.user_id','date(a.created_at)'));

		$this->datatables->add_column('full_name', '$1 $2', 'first_name, last_name');
		return $this->datatables->generate();
	}

	function timeattendance_export_excel(){
		if($this->input->post('branch_id',true)){
			$query_branch = $this->db->get_where('branch_item',array('id'=>$this->input->post('branch_id')));
			$row_branch = $query_branch->row();
		}
		$this->db->select(
			'a.id as id, '
			. 'a.code_member as code_member, '
			. 'a.user_id as user_id, '
			. 'u.first_name as first_name, '
			. 'u.last_name as last_name, '
			. 'a.created_at as date, '
			. 'MIN(a.created_at) as first_time, '
			. 'MAX(a.created_at) as last_time'
			. '');
		$this->db->from('time_attendance_student a');
		$this->db->join('users u', 'u.id=a.user_id', 'inner');

		$this->db->where("a.created_at BETWEEN '" . $this->input->post('date_from') . " 00:00:01' AND '" . $this->input->post('date_to') . " 23:59:59' ", NULL, FALSE);
		$this->db->where('u.active',1);
		$this->db->group_by(array('a.user_id','date(a.created_at)'));
		$query = $this->db->get();
		if (!$query)
			return false;

		$this->load->library('excel');
		$this->excel->setActiveSheetIndex(0);
		$this->excel->getActiveSheet()->getDefaultStyle()->getFont()->setName('angsana new')->setSize(14);

		$fields = $query->list_fields();
		$this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
		$this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
		$this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
		$this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(20);

		$styleArray = array(
			'borders' => array(
				'allborders' => array(
					'style' => PHPExcel_Style_Border::BORDER_THIN
					)
				)
			);

        //merge
		$this->excel->getActiveSheet()->mergeCells('A1:E1');
		$this->excel->getActiveSheet()->mergeCells('A2:E2');
        //bold
		$this->excel->getActiveSheet()->getStyle('A1:E1')->getFont()->setSize(16)->setBold(true);
		$this->excel->getActiveSheet()->getStyle('A2:E2')->getFont()->setSize(14)->setBold(true);
        //center
		$this->excel->getActiveSheet()->getStyle('A1:E2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        //header
		$this->excel->getActiveSheet()->setCellValue("A1", "ใบสรุปเวลาเข้าเรียน");
		$this->excel->getActiveSheet()->setCellValue("A2", cDate2($this->input->post('date_from')).' - '.cDate2($this->input->post('date_to')).' '.$row_branch->title);

		$this->excel->getActiveSheet()->getStyle('A3:E3')->applyFromArray($styleArray);
		$this->excel->getActiveSheet()->getStyle('A3:E3')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('7FE287');
		$this->excel->getActiveSheet()->getStyle('A3:E3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        //header table
		$this->excel->getActiveSheet()->setCellValue("A3", "No.");
		$this->excel->getActiveSheet()->setCellValue("B3", "Code");
		$this->excel->getActiveSheet()->setCellValue("C3", "Full Name");
		$this->excel->getActiveSheet()->setCellValue("D3", "First Time");
		$this->excel->getActiveSheet()->setCellValue("E3", "Last Time");

		$row = 4;
		$i = 1;
		foreach ($query->result() as $item) {
			$this->excel->getActiveSheet()->getStyle('A' . $row . ':E' . $row . '')->applyFromArray($styleArray);

			$this->excel->getActiveSheet()->setCellValueExplicit("A" . $row, $i, PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValue("B" . $row, $item->code_member);
			$this->excel->getActiveSheet()->setCellValue("C" . $row, $item->first_name.' '.$item->last_name);
			$this->excel->getActiveSheet()->setCellValue("D" . $row, $item->first_time);
			$this->excel->getActiveSheet()->setCellValue("E" . $row, $item->last_time);

			$row++;
			$i++;
		}

		$filename = 'report_timeattendance_' . date('Ymd') . '.xlsx';
		$type = 'Excel2007';

		header('Content-type: application/octet-stream; charset=UTF-8');
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="' . $filename . '"');
		header('Cache-Control: max-age=0');

		$cacheMethod = PHPExcel_CachedObjectStorageFactory:: cache_to_phpTemp;
		$cacheSettings = array(' memoryCacheSize ' => '512MB');
		PHPExcel_Settings::setCacheStorageMethod($cacheMethod, $cacheSettings);

		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, $type);
		$objWriter->save('php://output');
	}

	function get_timeattendance_result(){
		$this->db->select(
			'a.id as id, '
			. 'a.code_member as code_member, '
			. 'a.user_id as user_id, '
			. 'u.first_name as first_name, '
			. 'u.last_name as last_name, '
			. 'a.created_at as date, '
			. 'MIN(a.created_at) as first_time, '
			. 'MAX(a.created_at) as last_time'
			. '');
		$this->db->from('time_attendance_student a');
		$this->db->join('users u', 'u.id=a.user_id', 'inner');

		$this->db->where("a.created_at BETWEEN '" . $this->input->post('date_from') . " 00:00:01' AND '" . $this->input->post('date_to') . " 23:59:59' ", NULL, FALSE);
		$this->db->where('u.active',1);
		$this->db->group_by(array('a.user_id','date(a.created_at)'));
		$query = $this->db->get();
		return $query;
	}
}
