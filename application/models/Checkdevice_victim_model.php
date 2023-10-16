<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Checkdevice_victim_model extends CI_Model {

    function checkdevice_status() {

        $data = array(
            'device_id' => $this->input->get_post('deviceid'),
        );
        $device_id = $data['device_id'];
        $this->db->select("status");
        $this->db->where('device_id', $device_id);
        $qry = $this->db->get('wc_victim');
        $result = $qry->result();
        echo '<pre>'; print_r($result); exit;
        /*$status='';
        $stat='';*/

        /*foreach ($result as $row){
            $status=$row->status;
        }
        if($status=='Active'){
            $stat='Inactive';
        }
        else{
            $stat='Active';
        }*/
        return $result;
    }

    function checkdevice_update($status) {
        $data = array(
            'device_id' => $this->input->get_post('deviceid'),
        );
        $device_id = $data['device_id'];
        $this->db->where('device_id',$device_id);
        $change_pin=$this->db->update('wc_victim',array('status'=>$status));
        return $change_pin;
    }
    
}
