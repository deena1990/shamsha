<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Changepin_victim_model extends CI_Model {

    function change_victim_pin() {
        /*$data = array(
            'device_id' => $this->input->get_post('deviceid'),
            'pin' => $this->input->get_post('pin'),
        );

        $device_id = $data['device_id'];
        $pin = $data['pin'];*/

        $device_id = trim($this->input->post('deviceid'));
        $pin = trim($this->input->post('pin'));

        $this->db->where('device_id',$device_id);
        $change_pin=$this->db->update('wc_victim',array('pin'=>$pin));

        return $change_pin;
    }
    
}
