<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Checkvictim_model extends CI_Model {

    function check_user() {
        $deviceid = trim($this->input->post('deviceid'));
        $pin = trim($this->input->post('pin'));
        $sql = "SELECT COUNT(wcvtid) as no_of_rows FROM wc_victim WHERE device_id = '$deviceid' and pin='$pin'";
        return $this->db->query($sql)->row()->no_of_rows;
    }

  
    
    function get_victim() {
        $deviceid = trim($this->input->post('deviceid'));
        $pin = trim($this->input->post('pin'));
        $sql = "SELECT `wcvtid`, `victim_id`, `device_id`, `name`, `email`, `mobile`, `address`, `nationality`, `status` FROM `wc_victim` WHERE `device_id` = '$deviceid' and `pin`='$pin'";
        $data = $this->db->query($sql);
        return $data->result();
    }

    
    
}
