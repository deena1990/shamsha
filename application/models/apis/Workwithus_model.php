<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Workwithus_model extends CI_Model {

    function get_data() {
        $this->db->select("title_en, content_en, title_ar, content_ar");
        $this->db->where('wcp_id', 9);
        $data = $this->db->get('wc_pages');
        return $data->row();
    }
    
    function save_form_data($data) {
        return $this->db->insert('tbl_workwithus_form_data', $data);
    }
    
}
