<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 *  @Auther : Adisorn Lamsombuth
 *  @Email : postyim@gmail.com
 *  @Website : esabay.com 
 */

/**
 * Description of Student_model
 *
 * @author R-D-6
 */
class Student_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    public function listall() {
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

    function add_save(){
        $this->load->helper('string');
        $password = $this->Ion_auth_model->hash_password(random_string('alnum', 8), FALSE);
        $data = array(
            'code_member'=>$this->gen_code($this->input->post('branch_id')),
            'first_name' => trim($this->input->post('first_name')),
            'last_name' => trim($this->input->post('last_name')),
            'nick_name' => trim($this->input->post('nick_name')),
            'password' => $password,
            'email' => trim($this->input->post('parent_email')),
            'ip_address' => $this->input->ip_address(),
            'created_on' => time(),
            'active' => 1,
            'parent_first_name' => trim($this->input->post('parent_first_name')),
            'parent_last_name' => trim($this->input->post('parent_last_name')),
            'parent_mobile' => trim($this->input->post('parent_mobile')),
            'parent_address' => trim($this->input->post('parent_address')),
            'parent_phone' => trim($this->input->post('parent_phone')),
            'parent_email' => trim($this->input->post('parent_email')),
            'parent_facebook' => trim($this->input->post('parent_facebook')),
            'degree_id' => trim($this->input->post('degree_id')),
            'school_name' => trim($this->input->post('school_name')),
            'school_province_id' => trim($this->input->post('school_province_id')),
            'stuold' => ($this->input->post('stuold', TRUE) ? 1 : 0)
            );
        $this->db->insert('users', $data);
        $uer_id = $this->db->insert_id();
        $this->db->insert('users_groups', array('user_id' => $uer_id , 'group_id' => 19));
        $this->db->insert('users_branchs', array('user_id' => $uer_id, 'branch_id' => $this->input->post('branch_id')));

        foreach($this->input->post('course_id') as $course_item){
            $this->db->insert('users_courses', array('user_id' => $uer_id, 'course_id' => $course_item));
        }

        $rdata = array(
            'status' => TRUE,
            'redirect' => 'tutor/student',
            'message_info' => 'Save data success.'
            );

        return $rdata;
    }

    function edit_save(){

        $data = array(
            'first_name' => trim($this->input->post('first_name')),
            'last_name' => trim($this->input->post('last_name')),
            'nick_name' => trim($this->input->post('nick_name')),
            'email' => trim($this->input->post('parent_email')),
            'active' => ($this->input->post('active', TRUE) ? 1 : 0),
            'parent_first_name' => trim($this->input->post('parent_first_name')),
            'parent_last_name' => trim($this->input->post('parent_last_name')),
            'parent_mobile' => trim($this->input->post('parent_mobile')),
            'parent_address' => trim($this->input->post('parent_address')),
            'parent_phone' => trim($this->input->post('parent_phone')),
            'parent_email' => trim($this->input->post('parent_email')),
            'parent_facebook' => trim($this->input->post('parent_facebook')),
            'degree_id' => trim($this->input->post('degree_id')),
            'school_name' => trim($this->input->post('school_name')),
            'school_province_id' => trim($this->input->post('school_province_id')),
            'stuold' => ($this->input->post('stuold', TRUE) ? 1 : 0),
            'updated_on' => time()
            );
        $this->db->update('users', $data,array('id'=>$this->input->post('id')));
        $this->db->update('users_branchs', array('branch_id' => $this->input->post('branch_id')),array('user_id'=>$this->input->post('id')));

        $this->db->delete('users_courses',array('user_id'=>$this->input->post('id')));
        foreach($this->input->post('course_id') as $course_item){
            $this->db->insert('users_courses', array('user_id' => $this->input->post('id'), 'course_id' => $course_item));
        }


        $rdata = array(
            'status' => TRUE,
            'redirect' => 'tutor/student/edit/'.$this->input->post('id'),
            'message_info' => 'Save data success.'
            );

        return $rdata;
    }

    function export(){
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

        $filename = 'report_student_' . date('Ymd') . '.xlsx';
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

    //function
    function get_item($id){
        $this->db->select('users.*, users_branchs.branch_id as branch_id');
        $this->db->from('users');
        $this->db->join('users_branchs', 'users_branchs.user_id=users.id', 'inner');
        $this->db->where('users.id',$id);
        $query = $this->db->get();
        return $query->row();
    }

    function get_view($id){
        $this->db->select('users.*, branch_item.title as branch_title, provinces.PROVINCE_NAME as school_provine_title, degree.title as degree_title');
        $this->db->from('users');
        $this->db->join('users_branchs', 'users_branchs.user_id=users.id', 'inner');
        $this->db->join('branch_item','branch_item.id=users_branchs.branch_id');
        $this->db->join('provinces','provinces.PROVINCE_ID=users.school_province_id','left');
        $this->db->join('degree','degree.id=users.degree_id','left');
        $this->db->where('users.id',$id);
        $query = $this->db->get();
        return $query->row();
    }

    function get_course_stu($id){
        $query = $this->db->get_where('users_courses',array('user_id'=>$id));
        $arr = array();
        foreach($query->result() as $item){
            $arr[] = $item->course_id;
        }
        return $arr;
    }

    function get_course_result($id){
        $this->db->select('course_item.*');
        $this->db->from('course_item');
        $this->db->join('users_courses','users_courses.course_id=course_item.id');
        $this->db->where('users_courses.user_id',$id);
        $query = $this->db->get();
        return $query->result();
    }

    public function gen_code($id){
        $query_branch = $this->db->get_where('branch_item',array('id'=>$id));
        $row_branch = $query_branch->row();

        $this->db->select('users.id');
        $this->db->from('users');
        $this->db->join('users_branchs','users_branchs.user_id=users.id');
        $this->db->join('users_groups','users_groups.user_id=users.id');
        $this->db->where('users_groups.group_id',19);
        $this->db->where('users_branchs.branch_id',$id);
        $query = $this->db->get();
        if($query->num_rows()>0){
            $n = $query->num_rows()+1;
            $c = 'KDC'.$row_branch->code_no.str_pad($n, 6, "0", STR_PAD_LEFT);            
        }else{
            $c = 'KDC'.$row_branch->code_no.'000001';
        }
        return $c;
    }

    function get_result(){
        $this->db->select('users.*, branch_item.title as branch_title, provinces.PROVINCE_NAME as school_provine_title, degree.title as degree_title');
        $this->db->from('users');
        $this->db->join('users_groups', 'users_groups.user_id=users.id', 'inner','left');
        $this->db->join('users_branchs', 'users_branchs.user_id=users.id', 'inner','left');
        $this->db->join('branch_item', 'branch_item.id=users_branchs.branch_id', 'left');
        $this->db->join('provinces','provinces.PROVINCE_ID=users.school_province_id','left');
        $this->db->join('degree','degree.id=users.degree_id','left');
        $this->db->where('users_groups.group_id',19);
        if($this->input->post('text_search',true)){
            $this->db->like('users.first_name',$this->input->post('text_search'));
        }

        if($this->input->post('branch_id',true)){
            $this->db->where('users_branchs.branch_id',$this->input->post('branch_id'));
        }
        $query = $this->db->get();
        return $query->result();

    }
}
