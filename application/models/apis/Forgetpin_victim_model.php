<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Forgetpin_victim_model extends CI_Model {

    function get_victim_email() {
        // $device_id=$this->input->post('deviceid');
        // echo "<pre>";print_r($device_id);die;
        $this->db->select("pin");
        $this->db->where(array( 'device_id' => $this->input->post('deviceid'), 'status' => 'Active' ));
        $qry = $this->db->get('wc_victim');
        if($qry->row() != '')
        {
            return $qry->row()->pin;
        }
        
    }
}
