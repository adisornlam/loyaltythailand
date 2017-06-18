<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 *  @Auther : Adisorn Lamsombuth
 *  @Email : postyim@gmail.com
 *  @Website : esabay.com 
 */

/**
 * Description of Tutor
 *
 * @author R-D-6
 */
class Tutor extends MX_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->ion_auth->logged_in()) {
            redirect('login', 'refresh');
        }
        $this->load->model("tutor/Tutor_model");
    }

    public function history_course() {
        $user_id = $this->ion_auth->user()->row()->id;
        $data = array(
            'web_title' => TITLE,
            'result_course'=>$this->Tutor_model->get_course_result($user_id)
            );
        $this->template->load('master', 'tutor/parent/history_course', $data);
    }

    function comment(){
        $data = array(
            'item'=>$this->Tutor_model->get_comment($this->uri->segment(3))
            );
        $this->load->view('tutor/parent/comment',$data);
    }

    function viewscore(){
        $this->load->helper("tutor/useful");

        $course_item = $this->Tutor_model->get_course_item($this->uri->segment(3));
        $user_id = $this->ion_auth->user()->row()->id;
        $data = array(
            'web_title' => $course_item->title.' '.TITLE,
            'page_title'=> 'คะแนนสอบรายวิชา '.$course_item->code_no.' '.$course_item->title,
            'result_score'=>$this->Tutor_model->get_score_result($this->uri->segment(3),$user_id),
            'result_course_sub' => $this->Tutor_model->get_course_sub_result($user_id, $this->uri->segment(3))
            );
        $this->template->load('master', 'tutor/parent/viewscore', $data);
    }

    public function top_score() {
        $user_id = $this->ion_auth->user()->row()->id;
        $data = array(
            'web_title' => TITLE,
            'result_course'=>$this->Tutor_model->get_course_result($user_id)
            );
        $this->template->load('master', 'tutor/parent/top_score', $data);
    }

    public function top5_score() {
        $course_item = $this->Tutor_model->get_course_item($this->uri->segment(3));
        $data = array(
            'page_title' => '5 อันดับคะแนนสอบรายวิชา '.$course_item->code_no.' '. $course_item->title,
            'web_title' => TITLE,
            'result_course'=>$this->Tutor_model->get_top5_score_result($this->uri->segment(3))
            );
        $this->template->load('master', 'tutor/parent/top5_score', $data);
    }

}
