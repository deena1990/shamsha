<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Language_model extends CI_Model {

    function get_data() {
        $this->db->select("wcl_id, lname, status");
        $data = $this->db->get('wc_languages');
        return $data->result();
    }
    
}
