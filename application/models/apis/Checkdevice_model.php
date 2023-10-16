<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Checkdevice_model extends CI_Model {

    function check_device() {
        $deviceid = trim($this->input->post('deviceid'));
        $sql = "SELECT COUNT(wcvtid) as no_of_rows FROM wc_victim WHERE device_id = '$deviceid' AND status='Active'";
    //    print_r($sql);die;
        return $this->db->query($sql)->row()->no_of_rows;
    }

  
    
    function check_victim() {
        $deviceid = trim($this->input->post('deviceid'));
        $sql = "SELECT COUNT(wcvtid) as no_of_rows FROM wc_victim WHERE device_id = '$deviceid'";
        return $this->db->query($sql)->row()->no_of_rows;
    }

    
    
}
