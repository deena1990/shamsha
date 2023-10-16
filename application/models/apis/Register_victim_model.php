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
	
	function check_victim_exists(){
		//echo "check if deviceId exists\n";
		$this->db->where('device_id',$this->input->get_post('deviceid'));
		$this->db->from('wc_victim');
		//print_r($this->db->count_all_results());
		return $this->db->count_all_results();
	}

	function update_victim_user(){
		$data = array(
			'email' => $this->input->get_post('email'),
			'pin' => $this->input->get_post('pin'),
		);
		
		$this->db->where('device_id',$this->input->get_post('deviceid'));
		
		$update=$this->db->update('wc_victim',$data);

        return $update;
	}

    function update_victimid_entry($insert_id){
    	$RANDOM = 'WCVT0000'.$insert_id;
    	$this->db->where('wcvtid',$insert_id);
   		$this->db->update('wc_victim',array('victim_id'=>$RANDOM, 'status'=>'Active'));
    }

    function change_victim_pin() {
        $data = array(
            'device_id' => $this->input->get_post('deviceid'),
            'pin' => $this->input->get_post('pin'),
        );

        $this->db->where('device_id',$data['device_id']);
        $change_pin=$this->db->update('wc_victim',array('pin'=>$data['pin']));

        return $change_pin;
    }

    function get_victim_email() {
        $device_id = $this->input->post('deviceid');
        $this->db->select("email,pin");
        $this->db->where('device_id', $device_id);
        $data = $this->db->get('wc_victim');
        return $data->result();
    }
    
}
