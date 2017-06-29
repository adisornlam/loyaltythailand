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
class Products_model extends CI_Model {

    function get_item($id) {
        $this->db->select("product_item.*, product_categories.cat_id, users_products.user_id");
        $this->db->from("product_item");
        $this->db->join("product_categories", "product_item.id = product_categories.product_id");
        $this->db->join("users_products", "product_item.id = users_products.product_id");
        $this->db->where("product_item.disabled", 1);
        $this->db->where("product_item.deleted_at", NULL);
        $this->db->where("product_item.id", $id);
        $query = $this->db->get();
        return $query->row();
    }

}
