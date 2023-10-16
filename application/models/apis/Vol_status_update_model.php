<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Vol_status_update_model extends CI_Model {

    function get_user_info(){
        $this->db->where('vounter_id', $this->input->post('volunteer_id'));
        $data = $this->db->get('wc_voulnteer');
        return $data->row();
    }

    function save_vol_status(){
        $data = [
            'volunteer_id' => $this->input->post('volunteer_id'),
            'onduty_status' => $this->input->post('status')
        ];
        $this->db->insert('vol_onduty_status', $data);
        $data1 = [
            'onduty_status' => $this->input->post('status')
        ];
        $this->db->where('vounter_id',$this->input->post('volunteer_id'));
        $this->db->update('wc_voulnteer', $data1);
    }
    
}
