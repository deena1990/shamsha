<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Getinvolved_model extends CI_Model {

    function get_data() {
        // $this->db->select("title_en, content_en, title_ar, content_ar");
        $this->db->where('wcp_id', 3);
        $data = $this->db->get('wc_pages');
        return $data->row();
    }
    
    function vget_data() {
        $this->db->select("title_en, content_en, title_ar, content_ar, vol_form_con_en, vol_form_con_ar, vol_goo_con_en, vol_goo_con_ar");
        $this->db->where('wcp_id', 5);
        $data = $this->db->get('wc_pages');
        return $data->result();
    }
    
    function isget_data() {
        $this->db->select("title_en, content_en, title_ar, content_ar");
        $this->db->where('wcp_id', 6);
        $data = $this->db->get('wc_pages');
        return $data->result();
    }
    
    function csget_data() {
        $this->db->select("title_en, content_en, title_ar, content_ar");
        $this->db->where('wcp_id', 7);
        $data = $this->db->get('wc_pages');
        return $data->result();
    }
    
}
