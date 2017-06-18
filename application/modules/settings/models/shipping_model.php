<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 *  @Auther : Adisorn Lamsombuth
 *  @Email : postyim@gmail.com
 *  @Website : esabay.com 
 */

/**
 * Description of shipping_model
 *
 * @author R-D-6
 */
class shipping_model extends CI_Model {

    function get_listall() {
        $this->load->library('datatables');
        $this->load->helper('settings/useful');


        $this->datatables->select('id, title, active');
        $this->datatables->from('shipping_item');
        $this->datatables->where('user_id', $this->ion_auth->get_user_id());
        $link = "<div class=\"dropdown\">";
        $link .= "<a class=\"dropdown-toggle\" data-toggle=\"dropdown\" href=\"javascript:;\"><span class=\"fa fa-pencil-square-o\"></span ></a>";
        $link .= "<ul class=\"dropdown-menu\" role=\"menu\" aria-labelledby=\"dLabel\">";
        $link .= "<li><a href=\"javascript:;\" rel=\"settings/backend/shipping/edit/$1\" class=\"link_dialog\" title=\"Edit Details\">Edit Details</a></li>";
        $link .= "<li><a href=\"javascript:;\" rel=\"settings/backend/result_shipping/delete/$1\" class=\"link_dialog delete\" title=\"Delete Shipping\">Delete Shipping</a></li>";
        $link .= "</ul>";
        $link .= "</div>";
        $this->datatables->edit_column('id', $link, 'id');
        $this->datatables->edit_column('active', '$1', 'check_disabled(active,1)');
        return $this->datatables->generate();
    }

    function add() {
        $data = array(
            'title' => trim($this->input->post('title')),
            'user_id' => $this->ion_auth->get_user_id(),
            'active' => ($this->input->post('active', TRUE) ? 1 : 0),
            'created_at' => date('Y-m-d h:i:s'),
        );
        $this->db->insert('shipping_item', $data);
        $rdata = array(
            'status' => TRUE,
            'redirect' => 'settings/backend/shipping',
            'message' => 'Save data success.'
        );

        return $rdata;
    }

    public function get_edit($id) {
        $query = $this->db->get_where('shipping_item', array('id' => $id));
        return $query->result();
    }

    function edit() {
        $data = array(
            'title' => trim($this->input->post('title')),
            'active' => ($this->input->post('active', TRUE) ? 1 : 0),
            'updated_at' => date('Y-m-d h:i:s'),
        );
        $this->db->update('shipping_item', $data, array('id' => $this->input->post('id')));
        $rdata = array(
            'status' => TRUE,
            'redirect' => 'settings/backend/shipping',
            'message' => 'Save data success.'
        );
        return $rdata;
    }

    public function delete() {
        $this->db->delete('shipping_item', array('id' => $this->uri->segment(5)));
        $rdata = array(
            'status' => TRUE,
            'redirect' => 'settings/backend/shipping',
            'message' => 'Save data success.'
        );

        return $rdata;
    }

    public function get_shipping($param, $id = 0) {
        $this->db->select('*');
        $this->db->from('shipping_item');
        $this->db->where('user_id', $param);
        $this->db->where('active', 1);
        if ($id != 0) {
            $this->db->where('id', $id);
        }
        $query = $this->db->get();
//        $arr = array(
//            '' => 'Please select'
//        );
        foreach ($query->result() as $val) {
            $arr[$val->id] = $val->title;
        }
        return $arr;
    }

    public function get_shipping_item($param) {
        $this->db->select('*');
        $this->db->from('shipping_item');
        $this->db->where('id', $param);
        $this->db->where('active', 1);
        $query = $this->db->get();
        return $query->first_row();
    }

}
