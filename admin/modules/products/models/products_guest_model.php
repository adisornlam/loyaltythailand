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
class Products_guest_model extends CI_Model {

    public function get_galler($param) {
        $this->db->select('*');
        $this->db->from('stk_product');
        $this->db->join('cms_content', 'cms_content.cnt_id=stk_product.cnt_id', 'inner');
        $this->db->join('cms_gallery', 'cms_gallery.cnt_id=cms_content.cnt_id', 'inner');
        $this->db->where('stk_product.product_id', $param);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $str = '';
            foreach ($query->result() as $value) {
                $str .= '<div class="col-xs-6 col-md-4">';
                $str .= '<a href="javascript:;" class="thumbnail">';
                $str .='<img src="//www.jib.co.th/jib_content/images/gallery/' . $value->gallery_img_url . '" alt="Loading..." height="200" />';
                $str .='</a>';
                $str .='</div>';
            }
        }
        return $str;
    }    

}
