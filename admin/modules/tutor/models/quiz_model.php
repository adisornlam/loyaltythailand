<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

/*
 *  @Auther : Adisorn Lamsombuth
 *  @Email : postyim@gmail.com
 *  @Website : esabay.com 
 */

/**
 * Description of Examination_model
 *
 * @author R-D-6
 */
class Quiz_model extends CI_Model {

	function __construct() {
		parent::__construct();
	}

	public function load_student_listall() {
		$this->load->library('datatables');
		$this->datatables->select(
			'users.id as id, '
			. 'users.id as id2, '
			. 'users_courses.id as id3, '
			. 'users.code_member as code_member, '
			. 'users.first_name as first_name, '
			. 'users.last_name as last_name'
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
		$this->datatables->add_column('full_name', '$1 $2', 'first_name, last_name');
		$this->datatables->add_column('score_input', '<input name="score[$1]" type="number" style="width:80px;"><input type="hidden" name="users_courses_id[$1]" value="$2" />', 'id2, id3');
		return $this->datatables->generate();
	}

	public function listall() {
		$this->load->library('datatables');
		$this->datatables->distinct('ci.id');
		$this->datatables->select(''
			. 'ci.id as id, '
			. 'ci.code_no as code_no , '
			. 'ci.title as title'
			. '');
		$this->datatables->from('quiz_item qi');
		$this->datatables->join('course_item ci','ci.id=qi.course_id','inner');
		$this->datatables->where('qi.deleted_at', NULL);
		if($this->input->post('branch_id',true)){
			$this->datatables->where('ci.branch_id',$this->input->post('branch_id'));
		}
		// $manage = '<a href="'.base_url().index_page().'tutor/quiz/edit/$1" class="btn btn-primary btn-xs" title="Edit"><i class="fa fa-pencil-square-o"></i></a> ';
		$manage = '<a href="'.base_url().index_page().'tutor/quiz/viewscore/$1" class="btn btn-primary btn-xs" title="View"><i class="fa fa-eye" aria-hidden="true"></i></a> ';
		$manage .= '<a href="javascript:;" rel="tutor/quiz/save/delete/$1" class="link_dialog delete btn-danger btn btn-xs" title="Delete"><i class="fa fa-trash"></i></a>';

		$this->datatables->add_column('manage', $manage, 'id');

		return $this->datatables->generate();
	}

	public function add_save(){
		$user = $this->ion_auth->user()->row();

		$query = $this->db->get_where('quiz_item',array('course_id'=> $this->input->post('course_id'),'course_sub_id'=> $this->input->post('course_sub_id'),'times'=>$this->input->post('quiz_time')));
		if($query->num_rows()<=0){
			$data = array(
				'course_id'=> $this->input->post('course_id'),
				'course_sub_id'=> $this->input->post('course_sub_id'),
				'times'=> $this->input->post('quiz_time'),
				'full_score'=> $this->input->post('full_score'),
				'created_user'=> $user->id,
				'created_at'=>date('Y-m-d H:i:s')
				);
			$this->db->insert('quiz_item',$data);
			$insert_id = $this->db->insert_id();

			foreach($this->input->post('score') as $k=>$v){
				$sc = ($v>0 ? $v:0);
				$sum_s = ($sc*100)/$this->input->post('full_score');
				$data2 = array(
					'quiz_id'=>$insert_id,
					'student_id'=> ($k!=''?$k:0),
					'score'=> $sc,
					'sum_score'=> $sum_s
					);
				$this->db->insert('quiz_desc',$data2);

				$query_sc = $this->db->get_where('users_courses',array('user_id'=>$k,'course_id'=>$this->input->post('course_id')));
				$row_sc = $query_sc->row();
				$total_score = ($row_sc->total_score > 0 ? ($row_sc->total_score+$sum_s) : $sum_s);

				$this->db->update('users_courses',array('total_score'=>$total_score),array('user_id'=>$k,'course_id'=>$this->input->post('course_id')));
			}

			$rdata = array(
				'status' => TRUE,
				'redirect' => 'tutor/quiz',
				'message_info' => 'Save successfull.'
				);
		}else{
			$rdata = array(
				'status' => FALSE,
				'redirect' => 'tutor/quiz',
				'message_info' => 'มีการบันทึกผลสอบครั้งนี้แล้ว.'
				);
		}
		return $rdata;
	}

	function delete_save(){
		$this->db->delete('quiz_item',array('quiz_id'=>$this->uri->segment(5)));
		$this->db->delete('quiz_desc',array('quiz_id'=>$this->uri->segment(5)));
		$rdata = array(
			'status' => TRUE,
			'redirect'=>'tutor/student',
			'message_info' => 'Delete Successfully.'
			);
		return $rdata;
	}

		//function
	function get_item($id){
		$this->db->select('quiz_item.*, course_item.code_no as course_no, course_item.title as course_title, branch_item.title as branch_title');
		$this->db->from('quiz_item');
		$this->db->join('course_item','course_item.id=quiz_item.course_id','inner');
		$this->db->join('branch_item','branch_item.id=course_item.branch_id','inner');
		$this->db->where('quiz_item.disabled',1);
		$this->db->where('quiz_item.deleted_at',NULL);
		$this->db->where('course_item.id',$id);
		$query = $this->db->get();
		$row = $query->row();
		return $row;
	}

	function get_quiz_desc_result($id){
		$this->db->select('users.code_member as code_member, users.first_name, users.last_name, quiz_desc.student_id as student_id, quiz_desc.score as score');
		$this->db->from('quiz_desc');
		$this->db->join('users','users.id=quiz_desc.student_id','inner');
		$this->db->where('quiz_desc.quiz_id',$id);
		$this->db->where('quiz_desc.disabled',1);
		$this->db->where('users.active',1);
		$query = $this->db->get();
		return $query;
	}

	function get_score($course_id, $times, $student_id){
		$this->load->helper('tutor/useful');
		$this->db->select('quiz_desc.score, quiz_item.full_score');
		$this->db->from('quiz_item');
		$this->db->join('quiz_desc','quiz_desc.quiz_id=quiz_item.quiz_id');
		$this->db->where('quiz_item.course_id',$course_id);
		$this->db->where('quiz_item.times',$times);
		$this->db->where('quiz_desc.student_id',$student_id);
		$query = $this->db->get();
		if($query->num_rows()>0){
			$row = $query->row();
			$n = cal_math1($row->score, $row->full_score);
		}else{
			$n = 0;
		}
		return $n;
	}

	function get_course_sub_result($id){
		$query = $this->db->DISTINCT()
		->select('course_sub.id, course_sub.title')
		->from('quiz_item')
		->join('course_sub','course_sub.id = quiz_item.course_sub_id')
		->where('quiz_item.course_id',$id)
		->get();
		return $query;
	}

	function get_quiz_time_result($id){
		$query = $this->db->get_where('quiz_item',array('course_id'=>$id));
		return $query;
	}

	function get_quiz_score_item($course_id, $course_sub_id, $times, $student_id){
		$query = $this->db->select('qd.score, qd.sum_score')
		->from('quiz_desc qd')
		->join('quiz_item qi', 'qi.quiz_id = qd.quiz_id')
		->where('qi.course_id',$course_id)
		->where('qi.course_sub_id',$course_sub_id)
		->where('qi.times',$times)
		->where('qd.student_id',$student_id)
		->get();

		if($query->num_rows()>0){
			$row = $query->row();
			$arr['sum'] = $row->score;
			$arr['sum_per'] = $row->sum_score;
		}else{
			$arr['sum'] = 0;
			$arr['sum_per'] = 0;
		}
		return $arr;
	}

	function get_full_score_item($course_id, $course_sub_id,$times){
		$query = $this->db->get_where('quiz_item',array('course_id'=>$course_id,'course_sub_id'=>$course_sub_id,'times'=>$times));
		if($query->num_rows()>0){
			$row = $query->row();
			$str = $times.'/'.$row->full_score ;
		}else{
			$str = $times;
		}
		return $str;
	}


}
