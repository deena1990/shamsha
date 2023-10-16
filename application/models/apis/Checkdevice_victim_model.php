<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Checkdevice_victim_model extends CI_Model {

    function checkdevice_status() {

        $device_id = trim($this->input->post('deviceid'));

        $this->db->select("status");
        $this->db->where('device_id', $device_id);
        $qry = $this->db->get('wc_victim');
        $result = $qry->result();
        $status='';
        $stat='';

        foreach ($result as $row){
            $status=$row->status;
        }
        if($status=='Active'){
            $stat='Inactive';
        }
        else{
            $stat='Active';
        }
        return $stat;
    }

    function checkdevice_update($status) {
        if($status == "")
        $device_id = trim($this->input->post('deviceid'));
        $this->db->where('device_id',$device_id);
        $change_pin=$this->db->update('wc_victim',array('status'=>$status));
        return $change_pin;
    }
    
    function checkdevice_delete() {
        $device_id = trim($this->input->post('deviceid'));
        $this->db->where('device_id',$device_id);
        $change_pin=$this->db->delete('wc_victim');
        return $change_pin;
    }
    
}
