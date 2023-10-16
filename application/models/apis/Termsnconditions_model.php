<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Termsnconditions_model extends CI_Model {

    function get_data() {
        $this->db->select("title_en, content_en, title_ar, content_ar");
        $this->db->where('wcp_id', 2);
        $data = $this->db->get('wc_pages');
        return $data->result();
    }
    
}
