<?php

/*
 *  @Auther : Adisorn Lamsombuth
 *  @Email : postyim@gmail.com
 *  @Website : esabay.com 
 */

/**
 * Description of menu_model
 *
 * @author R-D-6
 */
class Menu_model extends CI_Model {

    public function menu_backend() {
        $this->db->select('*');
        $this->db->from('menu');
        $this->db->join('menu_hierarchy', 'menu_hierarchy.menu_id = menu.id');
        $this->db->where('menu_hierarchy.menu_parent_id', 0);
        $query = $this->db->get();
    }

}
