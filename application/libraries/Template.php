<?php

/*
 *  @Auther : Adisorn Lamsombuth
 *  @Email : postyim@gmail.com
 *  @Website : esabay.com 
 */

/**
 * Description of Template
 *
 * @author R-D-6
 */
class Template {

    var $ci;

    function __construct() {
        $this->ci = & get_instance();
    }

    function load($tpl_view, $body_view = null, $data = null) {
        if (!is_null($body_view)) {

            $body_view_path = $body_view;

            $body = $this->ci->load->view($body_view_path, $data, TRUE);

            if (is_null($data)) {
                $data = array('body' => $body);
            } else if (is_array($data)) {
                $data['body'] = $body;
            } else if (is_object($data)) {
                $data->body = $body;
            }
        }

        $this->ci->load->view('templates/' . $tpl_view, $data);
    }

}
