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
class Payment_model extends CI_Model {

    function get_listall() {
        $this->load->library('datatables');
        $this->load->helper('settings/useful');


        $this->datatables->select('payment_item.id as id, payment_item.title as item_title,payment_type.title as type_title, payment_item.active as active');
        $this->datatables->from('payment_item');
        $this->datatables->join('payment_type', 'payment_type.id=payment_item.payment_id', 'inner');
        $this->datatables->where('payment_item.user_id', $this->ion_auth->get_user_id());
        $link = "<div class=\"dropdown\">";
        $link .= "<a class=\"dropdown-toggle\" data-toggle=\"dropdown\" href=\"javascript:;\"><span class=\"fa fa-pencil-square-o\"></span ></a>";
        $link .= "<ul class=\"dropdown-menu\" role=\"menu\" aria-labelledby=\"dLabel\">";
        $link .= "<li><a href=\"javascript:;\" rel=\"settings/backend/payment/edit/$1\" class=\"link_dialog\" title=\"Edit Details\">Edit Details</a></li>";
        $link .= "<li><a href=\"javascript:;\" rel=\"settings/backend/result_payment/delete/$1\" class=\"link_dialog delete\" title=\"Delete Payment\">Delete Payment</a></li>";
        $link .= "</ul>";
        $link .= "</div>";
        $this->datatables->edit_column('id', $link, 'id');
        $this->datatables->edit_column('active', '$1', 'check_disabled(active,1)');
        return $this->datatables->generate();
    }

    function add() {
        $data = array(
            'payment_id' => $this->input->post('payment_id'),
            'title' => trim($this->input->post('title')),
            'description' => $this->input->post('description'),
            'desc_invoice' => $this->input->post('desc_invoice'),
            'user_id' => $this->ion_auth->get_user_id(),
            'active' => ($this->input->post('active', TRUE) ? 1 : 0),
            'created_at' => date('Y-m-d h:i:s'),
        );
        $this->db->insert('payment_item', $data);
        $rdata = array(
            'status' => TRUE,
            'redirect' => 'settings/backend/payment',
            'message' => 'Save data success.'
        );

        return $rdata;
    }

    function get_payment_type() {
        $query = $this->db->get('payment_type');

        $arr_cat = array(
            '' => 'Please select payment'
        );
        foreach ($query->result() as $val) {
            $arr_cat[$val->id] = $val->title;
        }

        return $arr_cat;
    }

    public function get_edit($id) {
        $query = $this->db->get_where('payment_item', array('id' => $id));
        return $query->result();
    }

    function edit() {
        $data = array(
            'payment_id' => $this->input->post('payment_id'),
            'title' => trim($this->input->post('title')),
            'description' => $this->input->post('description'),
            'desc_invoice' => $this->input->post('desc_invoice'),
            'user_id' => $this->ion_auth->get_user_id(),
            'active' => ($this->input->post('active', TRUE) ? 1 : 0),
            'updated_at' => date('Y-m-d h:i:s'),
        );
        $this->db->update('payment_item', $data, array('id' => $this->input->post('id')));
        $rdata = array(
            'status' => TRUE,
            'redirect' => 'settings/backend/payment',
            'message' => 'Save data success.'
        );
        return $rdata;
    }

    public function delete() {
        $this->db->delete('payment_item', array('id' => $this->uri->segment(5)));
        $rdata = array(
            'status' => TRUE,
            'redirect' => 'settings/backend/payment',
            'message' => 'Save data success.'
        );

        return $rdata;
    }

}
