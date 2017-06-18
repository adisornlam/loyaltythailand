<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Tutor_model
 *
 * @author adisornlam
 */
class Tutor_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function get_view($id) {
        $this->db->select('users.*, branch_item.title as branch_title, provinces.PROVINCE_NAME as school_provine_title, degree.title as degree_title');
        $this->db->from('users');
        $this->db->join('users_branchs', 'users_branchs.user_id=users.id', 'inner');
        $this->db->join('branch_item', 'branch_item.id=users_branchs.branch_id');
        $this->db->join('provinces', 'provinces.PROVINCE_ID=users.school_province_id', 'left');
        $this->db->join('degree', 'degree.id=users.degree_id', 'left');
        $this->db->where('users.id', $id);
        $query = $this->db->get();
        return $query->row();
    }

    function get_course_result($id) {
        $this->db->select('course_item.*, users_courses.register_date, users_courses.id as user_course_id, users_courses.user_id');
        $this->db->from('course_item');
        $this->db->join('users_courses', 'users_courses.course_id=course_item.id');
        $this->db->where('users_courses.user_id', $id);
        $query = $this->db->get();
        return $query->result();
    }

    function get_top5_score_result($id) {
        $sql = "SELECT us.code_member, CONCAT(us.first_name, ' ', us.last_name) AS full_name, uc.total_score FROM users_courses uc INNER JOIN users us ON us.id = uc.user_id WHERE uc.course_id = " . $id . " ORDER BY uc.total_score DESC LIMIT 5 ";
        return $this->db->query($sql);
    }

    function get_comment($id) {
        $this->db->select('users_courses.*');
        $this->db->from('users_courses');
        $this->db->where('users_courses.id ', $id);
        $this->db->where('users_courses.deleted_at', NULL);
        $query = $this->db->get();
        return $query->row();
    }

    function get_score_result($id, $student_id) {
        $this->db->select("quiz_item.times, quiz_item.full_score, quiz_desc.score");
        $this->db->from("quiz_item");
        $this->db->join("quiz_desc", "quiz_desc.quiz_id = quiz_item.quiz_id");
        $this->db->where("quiz_item.course_id", $id);
        $this->db->where("quiz_desc.student_id", $student_id);
        $this->db->where("quiz_desc.disabled", 1);
        $query = $this->db->get();
        return $query;
    }

    function get_score_sum($id, $student_id) {
        $query = $this->db->query("SELECT (SUM(quiz_desc.score / quiz_item.full_score)*100) as total FROM quiz_item JOIN quiz_desc ON quiz_desc.quiz_id = quiz_item.quiz_id WHERE quiz_item.course_id = " . $id . " AND quiz_desc.student_id = " . $student_id . " AND quiz_desc.disabled = 1");
        return $query;
    }

    function get_course_item($id) {
        $this->db->select('course_item.*');
        $this->db->from('course_item');
        $this->db->where('course_item.id', $id);
        $query = $this->db->get();
        return $query->row();
    }

    function get_course_sub_result($student_id, $course_id) {
        $query = $this->db->select('course_sub.id, course_sub.title')
                ->from('course_sub')
                ->join('course_item_sub', 'course_sub.id = course_item_sub.course_sub_id')
                ->join('users_courses', 'users_courses.course_id = course_item_sub.course_item_id')
                ->where('users_courses.user_id', $student_id)
                ->where('users_courses.course_id', $course_id)
                ->get();
        return $query;
    }

    function get_quiz_score_item($course_id, $course_sub_id, $times, $student_id) {
        $query = $this->db->select('qd.score, qd.sum_score, qi.full_score')
                ->from('quiz_desc qd')
                ->join('quiz_item qi', 'qi.quiz_id = qd.quiz_id')
                ->where('qi.course_id', $course_id)
                ->where('qi.course_sub_id', $course_sub_id)
                ->where('qi.times', $times)
                ->where('qd.student_id', $student_id)
                ->get();

        if ($query->num_rows() > 0) {
            $row = $query->row();
            $arr['sum'] = $row->score . '/' . $row->full_score;
            $arr['sum_per'] = $row->sum_score;
        } else {
            $arr['sum'] = 0;
            $arr['sum_per'] = 0;
        }
        return $arr;
    }

}
