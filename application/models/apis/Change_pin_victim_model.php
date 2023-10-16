<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Change_pin_victim_model extends CI_Model {

	function create_pin_victim(){
		$data = array(
			'pin' => $this->input->get_post('pin'),
		);
		$this->db->where('mobile',$this->input->get_post('mobile'));
        return $this->db->update('wc_victim',$data);
	}

    function check_victim_exist(){
		$this->db->where('mobile',$this->input->get_post('mobile'));
		$this->db->from('wc_victim');
		return $this->db->count_all_results();
	}

    function check_pin_victim_exist(){
		$this->db->where('mobile',$this->input->get_post('mobile'));
		$this->db->where('pin','');
		$this->db->from('wc_victim');
		return $this->db->count_all_results();
	}
    
}
