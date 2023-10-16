<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Pin_victim_model extends CI_Model {

	function create_pin_victim(){
		$data = array(
			'email' => $this->input->get_post('email'),
			'pin' => $this->input->get_post('pin'),
		);
		$this->db->where(['device_id'=>$this->input->get_post('deviceid'), 'status'=>'Active']);
        return $this->db->update('wc_victim',$data);
	}

    function check_victim_exist(){
		$this->db->where('device_id',$this->input->get_post('deviceid'));
		$this->db->where('status','Active');
		$this->db->from('wc_victim');
		return $this->db->count_all_results();
	}

    function check_pin_victim_exist(){
		$this->db->where('device_id',$this->input->get_post('deviceid'));
		$this->db->where('pin','');
		$this->db->where('status','Active');
		$this->db->from('wc_victim');
		return $this->db->count_all_results();
	}

	function check_correct_pin_victim_exist(){
		$this->db->where('device_id',$this->input->get_post('deviceid'));
		$this->db->where('pin',$this->input->get_post('pin'));
		$this->db->where('status','Active');
		$this->db->from('wc_victim');
		return $this->db->count_all_results();
	}
	
	function update_pin_victim(){
		$data = array(
			'pin' => $this->input->get_post('new_pin'),
		);
		$this->db->where(['device_id'=>$this->input->get_post('deviceid'), 'status'=>'Active']);
        return $this->db->update('wc_victim',$data);
	}

	function disable_pin_victim(){
		$data = array(
			'pin' => '',
		);
		$this->db->where(['device_id'=>$this->input->get_post('deviceid'), 'status'=>'Active']);
        return $this->db->update('wc_victim',$data);
	}

	function checkDevice(){
		$this->db->where('device_id',$this->input->get_post('deviceid'));
		$this->db->where('status','Active');
		$this->db->from('wc_victim');
		return $this->db->count_all_results();
	}
}
