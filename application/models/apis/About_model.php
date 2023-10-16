<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class About_model extends CI_Model {
    
    function get_hdata() {
        // $this->db->select("title_en, content_en, title_ar, content_ar");
        $this->db->where('wcp_id', 1);
        $data = $this->db->get('wc_pages');
        return $data->row();
    }

    function get_data() {
        // $this->db->select("title_en, content_en, title_ar, content_ar, team1, team2, vol_form_con_en, vol_form_con_ar, vol_goo_con_en, vol_goo_con_ar, team_a_info, team_b_info, team_a_name, team_b_name");
        $this->db->where('wcp_id', 8);
        $data = $this->db->get('wc_pages');
        return $data->row();
    }
    function get_bmember_data(){
        // $this->db->select("bname, image, designation");
        $data = $this->db->get('wc_board_mem');
        return $data->result();
    }
    function get_pmember_data(){
        $this->db->select("pname, image, website");
        $data = $this->db->get('wc_partners');
        return $data->result();
    }
    function get_ctmember_data(){
        $this->db->select("name, image, designation");
        $data = $this->db->get('wc_core_team');
        return $data->result();
    }
    
}
