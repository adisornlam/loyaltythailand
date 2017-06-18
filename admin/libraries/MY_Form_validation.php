<?php

/*
 *  @Auther : Adisorn Lamsombuth
 *  @Email : postyim@gmail.com
 *  @Website : esabay.com 
 */

/**
 * Description of MY_Form_validation
 *
 * @author R-D-6
 */
class MY_Form_validation extends CI_Form_validation {

    public function __construct() {
        $this->CI = & get_instance();
    }

    public function captcha() {
        // First, delete old captchas
        $expiration = time() - 7200; // Two hour limit
        $this->CI->db->query("DELETE FROM captcha WHERE captcha_time < " . $expiration);

        // Then see if a captcha exists:
        $sql = "SELECT COUNT(*) AS count FROM captcha WHERE word = ? AND ip_address = ? AND captcha_time > ?";
        $binds = array($this->CI->input->post('captcha'), $this->CI->input->ip_address(), $expiration);
        $query = $this->CI->db->query($sql, $binds);
        $row = $query->row();

        if ($row->count == 0) {
            //$this->set_message('captcha', 'Wrong captcha code, hmm are you the Terminator?');
            $this->set_message('captcha', 'The %s field must content a valid captcha code.');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    function get_captcha() {

        $vals = array(
            'word' => random_string('numeric', 6),
            'img_path' => './uploads/captcha/',
            'img_url' => base_url() . 'uploads/captcha/',
            'img_width' => '150',
            'img_height' => 30,
            'expiration' => 7200
        );

        $cap = create_captcha($vals);

        $data = array(
            'captcha_time' => $cap['time'],
            'ip_address' => $this->CI->input->ip_address(),
            'word' => $cap['word']
        );

        $query = $this->CI->db->insert_string('captcha', $data);
        $this->CI->db->query($query);

        return $cap['image'];
    }

    public function getErrorsArray() {
        return $this->_error_array;
    }

}
