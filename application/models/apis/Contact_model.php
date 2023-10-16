<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Contact_model extends CI_Model {

    function get_data() {
        // $this->db->select("title_en, content_en, title_ar, content_ar, 
        // email, contact, address, google_map, latitude, longitude, facebook, twitter, linkden, instagram, website, ar_helpline, en_helpline,
        // ofc_timings");
        $this->db->where('wcp_id', 4);
        $data = $this->db->get('wc_pages');
        return $data->row();
    }
    
}
