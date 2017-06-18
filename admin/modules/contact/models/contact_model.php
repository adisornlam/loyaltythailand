<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 *  @Auther : Adisorn Lamsombuth
 *  @Email : postyim@gmail.com
 *  @Website : esabay.com 
 */

/**
 * Description of products_model
 *
 * @author R-D-6
 */
class Contact_model extends CI_Model {

    public function add() {
        $query = $this->db->get_where('system_config_website', array('id' => 1));
        $row = $query->first_row();
        $data = array(
            'fullname' => trim($this->input->post('fullname')),
            'mobile' => trim($this->input->post('mobile')),
            'long_desc' => $this->input->post('long_desc'),
            'email' => trim($this->input->post('email')),
            'created_at' => time()
        );
        $this->db->trans_start();
        $this->db->insert('contact', $data);

        $email_config = $this->Common_model->get_config_email();
        $this->email->initialize($email_config);
        $this->email->from($row->from_email, $row->useragent);
        $this->email->to($row->receive_email);
        $this->email->subject('New Contact');
        $data2 = array(
            'fullname' => trim($this->input->post('fullname', TRUE)),
            'mobile' => ($this->input->post('mobile', TRUE) ? $this->input->post('mobile') : ''),
            'long_desc' => $this->input->post('long_desc'),
            'email' => ($this->input->post('email', TRUE) ? $this->input->post('email') : ''),
            'created_at' => get_datethai(time())
        );
        $email = $this->load->view('contact/frontend/email/contact', $data2, TRUE);
        $this->email->message($email);
        if (!$this->email->send()) {
            echo $this->email->print_debugger();
        } else {
            $this->db->trans_commit();
            $rdata = array(
                'status' => TRUE,
                'redirect' => 'contact',
                'message' => 'ส่งข้อมูลเสร็จเรียบร้อยแล้ว.'
            );
        }

        return $rdata;
    }

}
