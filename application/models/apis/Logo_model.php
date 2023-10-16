<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Logo_model extends CI_Model {

    function get_data() {
        $this->db->select("site_logo");
        $this->db->where('wc_id', 1);
        $data = $this->db->get('wc_settings');
        return $data->result();
    }
    
}
