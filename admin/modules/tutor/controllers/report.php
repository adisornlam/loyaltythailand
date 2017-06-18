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
class Report extends MX_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->ion_auth->logged_in()) {
            redirect('login', 'refresh');
        }
        $this->load->model("tutor/Report_model");
        $this->load->model("tutor/Course_model");
    }

    function studentcourse(){
        $data = array(
            'title' => 'รายงาน : '. TITLE,
            'title_page' => 'รายงาน : รายชื่อนักเรียนตามคอร์ส',
            'ddl_branch' => $this->Common_model->get_branch_ddl(),
            'ddl_course' => $this->Course_model->get_course_ddl()
            );

        $group = array('admin','owner');
        if ($this->ion_auth->in_group($group))
        {
            $this->template->load('master', 'tutor/owner/report/studentcourse', $data);
        }else{
            $this->template->load('master', 'templates/not_permission', $data);
        }
    }

    function studentcourse_listall(){
        echo $this->Report_model->studentcourse_listall();
    }

    function studentcourse_export(){
        if($this->input->post('btnExport')=='excel'){
            $this->Report_model->studentcourse_export_excel();
        }else{
            $this->load->library('m_pdf'); 
            $data['result'] = $this->Report_model->get_studentcourse_result();
            $html = $this->load->view('tutor/owner/report/studentcourse_pdf',$data,true);
            $pdfFilePath = 'report_studentcourse_book_' . date('Ymd') . '.pdf';

            $pdf = $this->m_pdf->load();
            $pdf->WriteHTML($html);
            $pdf->Output($pdfFilePath, "D");
        }
    }

    function book(){
        $data = array(
            'title' => 'รายงาน : '. TITLE,
            'title_page' => 'รายงาน : ใบรับตำราเรียน',
            'ddl_branch' => $this->Common_model->get_branch_ddl(),
            'ddl_course' => $this->Course_model->get_course_ddl()
            );

        $group = array('admin','owner');
        if ($this->ion_auth->in_group($group))
        {
            $this->template->load('master', 'tutor/owner/report/book', $data);
        }else{
            $this->template->load('master', 'templates/not_permission', $data);
        }
    }

    function book_listall(){
        echo $this->Report_model->book_listall();
    }

    function book_export(){
        if($this->input->post('btnExport')=='excel'){
            $this->Report_model->book_export_excel();
        }else{
            $this->load->library('m_pdf');
            $data['result'] = $this->Report_model->get_book_result();
            $html = $this->load->view('tutor/owner/report/book_pdf',$data,true);
            $pdfFilePath = 'report_book_' . date('Ymd') . '.pdf';

            $pdf = $this->m_pdf->load();
            $pdf->WriteHTML($html);
            $pdf->Output($pdfFilePath, "D");
        }
    }

    function checkname(){
        $data = array(
            'title' => 'รายงาน : '. TITLE,
            'title_page' => 'รายงาน : ใบเช็คชื่อนักเรียน',
            'ddl_branch' => $this->Common_model->get_branch_ddl(),
            'ddl_course' => $this->Course_model->get_course_ddl()
            );

        $group = array('admin','owner');
        if ($this->ion_auth->in_group($group))
        {
            $this->template->load('master', 'tutor/owner/report/checkname', $data);
        }else{
            $this->template->load('master', 'templates/not_permission', $data);
        }
    }

    function checkname_listall(){
        echo $this->Report_model->checkname_listall();
    }

    function checkname_export(){
        if($this->input->post('btnExport')=='excel'){
            $this->Report_model->checkname_export_excel();
        }else{
            $this->load->library('m_pdf');
            $data['result'] = $this->Report_model->get_checkname_result();
            $html = $this->load->view('tutor/owner/report/checkname_pdf',$data,true);
            $pdfFilePath = 'report_checkname_' . date('Ymd') . '.pdf';

            $pdf = $this->m_pdf->load();
            $pdf->WriteHTML($html);
            $pdf->Output($pdfFilePath, "D");
        }
    }

    function studentall(){
        $data = array(
            'title' => 'รายงาน : '. TITLE,
            'title_page' => 'รายงาน : รายการนักเรียนทั้งหมด',
            'ddl_branch' => $this->Common_model->get_branch_ddl()
            );

        $group = array('admin','owner');
        if ($this->ion_auth->in_group($group))
        {
            $this->template->load('master', 'tutor/owner/report/studentall', $data);
        }else{
            $this->template->load('master', 'templates/not_permission', $data);
        }
    }

    function studentall_listall(){
        echo $this->Report_model->studentall_listall();
    }

    function studentall_export(){
        if($this->input->post('btnExport')=='excel'){
            $this->Report_model->studentall_export_excel();
        }else{
            $this->load->library('m_pdf');
            $data['result'] = $this->Report_model->get_studentall_result();
            $html = $this->load->view('tutor/owner/report/studentall_pdf',$data,true);
            $pdfFilePath = 'report_studentall_' . date('Ymd') . '.pdf';

            $pdf = $this->m_pdf->load();
            $pdf->WriteHTML($html);
            $pdf->Output($pdfFilePath, "D");
        }
    }

    function signtest(){
        $data = array(
            'title' => 'รายงาน : '. TITLE,
            'title_page' => 'รายงาน : ใบรายชื่อนักเรียนเข้าห้องสอบ',
            'ddl_branch' => $this->Common_model->get_branch_ddl(),
            'ddl_course' => $this->Course_model->get_course_ddl()
            );

        $group = array('admin','owner');
        if ($this->ion_auth->in_group($group))
        {
            $this->template->load('master', 'tutor/owner/report/signtest', $data);
        }else{
            $this->template->load('master', 'templates/not_permission', $data);
        }
    }

    function signtest_listall(){
        echo $this->Report_model->signtest_listall();
    }

    function signtest_export(){
        if($this->input->post('btnExport')=='excel'){
            $this->Report_model->signtest_export_excel();
        }else{
            $this->load->library('m_pdf');
            $data['result'] = $this->Report_model->get_signtest_result();
            $html = $this->load->view('tutor/owner/report/signtest_pdf',$data,true);
            $pdfFilePath = 'report_signtest_' . date('Ymd') . '.pdf';

            $pdf = $this->m_pdf->load();
            $pdf->WriteHTML($html);
            $pdf->Output($pdfFilePath, "D");
        }
    }

    function examresult(){
        $data = array(
            'title' => 'รายงาน : '. TITLE,
            'title_page' => 'รายงาน : ประกาศผลสอบ',
            'ddl_branch' => $this->Common_model->get_branch_ddl(),
            'ddl_course' => $this->Course_model->get_course_ddl()
            );

        $group = array('admin','owner');
        if ($this->ion_auth->in_group($group))
        {
            $this->template->load('master', 'tutor/owner/report/examresult', $data);
        }else{
            $this->template->load('master', 'templates/not_permission', $data);
        }
    }

    function examresult_listall(){
        echo $this->Report_model->examresult_listall();
    }

    function examresult_export(){
        if($this->input->post('btnExport')=='excel'){
            $this->Report_model->examresult_export_excel();
        }else{
            $this->load->library('m_pdf');
            $data['result'] = $this->Report_model->get_examresult_result();
            $html = $this->load->view('tutor/owner/report/examresult_pdf',$data,true);
            $pdfFilePath = 'report_examresult_' . date('Ymd') . '.pdf';

            $pdf = $this->m_pdf->load();
            $pdf->WriteHTML($html);
            $pdf->Output($pdfFilePath, "D");
        }
    }

    function confirmprivate(){
        $data = array(
            'title' => 'รายงาน : '. TITLE,
            'title_page' => 'รายงาน : รายชื่อนักเรียน Private',
            'ddl_branch' => $this->Common_model->get_branch_ddl(),
            'ddl_course' => $this->Course_model->get_course_ddl()
            );

        $group = array('admin','owner');
        if ($this->ion_auth->in_group($group))
        {
            $this->template->load('master', 'tutor/owner/report/confirmprivate', $data);
        }else{
            $this->template->load('master', 'templates/not_permission', $data);
        }
    }

    function confirmprivate_listall(){
        echo $this->Report_model->confirmprivate_listall();
    }

    function confirmprivate_export(){
        if($this->input->post('btnExport')=='excel'){
            $this->Report_model->confirmprivate_export_excel();
        }else{
            $this->load->library('m_pdf');
            $data['result'] = $this->Report_model->get_confirmprivate_result();
            $html = $this->load->view('tutor/owner/report/confirmprivate_pdf',$data,true);
            $pdfFilePath = 'report_confirmprivate_' . date('Ymd') . '.pdf';

            $pdf = $this->m_pdf->load();
            $pdf->WriteHTML($html);
            $pdf->Output($pdfFilePath, "D");
        }
    }

    function signname(){
        $data = array(
            'title' => 'รายงาน : '. TITLE,
            'title_page' => 'รายงาน : ใบเช็คชื่อ',
            'ddl_branch' => $this->Common_model->get_branch_ddl(),
            'ddl_course' => $this->Course_model->get_course_ddl()
            );

        $group = array('admin','owner');
        if ($this->ion_auth->in_group($group))
        {
            $this->template->load('master', 'tutor/owner/report/signname', $data);
        }else{
            $this->template->load('master', 'templates/not_permission', $data);
        }
    }

    function signname_listall(){
        echo $this->Report_model->signname_listall();
    }

    function signname_export(){
        if($this->input->post('btnExport')=='excel'){
            $this->Report_model->signname_export_excel();
        }else{
            $this->load->library('m_pdf');
            $data['result'] = $this->Report_model->get_signname_result();
            $html = $this->load->view('tutor/owner/report/signname_pdf',$data,true);
            $pdfFilePath = 'report_signname_' . date('Ymd') . '.pdf';

            $pdf = $this->m_pdf->load();
            $pdf->WriteHTML($html);
            $pdf->Output($pdfFilePath, "D");
        }
    }

    function timeattendance(){
        $data = array(
            'title' => 'รายงาน : '. TITLE,
            'title_page' => 'รายงาน : ใบสรุปเวลาเข้าเรียน',
            'ddl_branch' => $this->Common_model->get_branch_ddl(),
            'ddl_course' => $this->Course_model->get_course_ddl()
            );

        $group = array('admin','owner');
        if ($this->ion_auth->in_group($group))
        {
            $this->template->load('master', 'tutor/owner/report/timeattendance', $data);
        }else{
            $this->template->load('master', 'templates/not_permission', $data);
        }
    }

    function timeattendance_listall(){
        echo $this->Report_model->timeattendance_listall();
    }

    function timeattendance_export(){
        if($this->input->post('btnExport')=='excel'){
            $this->Report_model->timeattendance_export_excel();
        }else{
            $this->load->library('m_pdf');
            $data['result'] = $this->Report_model->get_timeattendance_result();
            $html = $this->load->view('tutor/owner/report/timeattendance_pdf',$data,true);
            $pdfFilePath = 'report_timeattendance_' . date('Ymd') . '.pdf';

            $pdf = $this->m_pdf->load();
            $pdf->WriteHTML($html);
            $pdf->Output($pdfFilePath, "D");
        }
    }

}
