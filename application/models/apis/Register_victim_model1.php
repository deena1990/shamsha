<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Register_victim_model extends CI_Model {

    function register_user() {
        $data = array(
            'device_id' => $this->input->get_post('deviceid'),
            'name' => $this->input->get_post('name'),
            'email' => $this->input->get_post('email'),
            'mobile' => $this->input->get_post('mobile'),
            'address' => $this->input->get_post('address'),
            'nationality' => $this->input->get_post('nationality'),
            'pin' => $this->input->get_post('pin'),
            'status' => 'Active',
        );
        $this->db->set($data);
        $this->db->insert('wc_victim');
        $register_user = $this->db->insert_id();
        return $register_user;
    }
    function update_victimid_entry($insert_id){
    	$RANDOM = 'WCVT0000'.$insert_id;
    	$this->db->where('wcvtid',$insert_id);
   		$this->db->update('wc_victim',array('victim_id'=>$RANDOM, 'status'=>'Active'));
    }
    
}
