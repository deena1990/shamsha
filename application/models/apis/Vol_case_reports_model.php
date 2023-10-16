<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Vol_case_reports_model extends CI_Model {

    
    function checkVolExist($vol_id){
        $this->db->where('vounter_id', $vol_id);
        return $this->db->get('wc_voulnteer')->num_rows();
    }

    function get_vol_case_reports($vol_id){
        $getData = array();
        $this->db->where('volunteer', $vol_id);
        $this->db->order_by('id', 'DESC');
        $data = $this->db->get('wc_cr_report')->result();
        foreach ($data as $key => $value) {
           $getData[] = [
                'case_id' => $value->case_id,
                'case_language' => strtolower($value->recomment_care),
                'fullname' => $value->client_first_name.' '.$value->client_last_name,
                'age' => $value->client_age,
                'content' => $value->final_notes_n_thought_abt_client,
                'dateTime' => $value->created_at,
           ];
        }
        return $getData;
    }

}