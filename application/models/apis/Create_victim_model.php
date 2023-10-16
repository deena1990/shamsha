<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Create_victim_model extends CI_Model {

    function register_user() {
        $mobileNumber = $this->input->get_post('mobile');
        if ($mobileNumber != ""){
            $mobile = $mobileNumber;
        }else{
            $mobile = "";
        }
        $data = array(
            'device_id' => $this->input->get_post('deviceid'),
            'token_id' => $this->input->get_post('tokenid'),
            'device' => $this->input->get_post('device'),
            'mobile' => $mobile,
			'status' => "Active",
        );
        $this->db->set($data);
        $this->db->insert('wc_victim');
        $register_user = $this->db->insert_id();
        return $register_user;
    }
	
	function check_victim_exists(){
		$this->db->where('mobile',$this->input->get_post('mobile'));
		$this->db->from('wc_victim');
		return $this->db->count_all_results();
	}

    function check_victim_exist(){
		$this->db->where('device_id',$this->input->post('deviceid'));
		return $this->db->get('wc_victim')->num_rows();
	}
    
    function check_existing_device_noMobile(){
		
		$this->db->where([ 'device_id' => $this->input->get_post('deviceid'), 'mobile' => '' ]);
		$this->db->from('wc_victim');
		return $this->db->count_all_results();
	}

    function update_existing_device_noMobile(){
		$data = array(
			'mobile' => $this->input->get_post('mobile'),
			'status' => "Active",
		);
		
		$this->db->where([ 'device_id' => $this->input->get_post('deviceid'), 'mobile' => '' ]);
		
		$update=$this->db->update('wc_victim',$data);

        return $update;
	}

    function device_status_inactive(){
		$data = array(
			'status' => "Inactive",
		);
		
		$this->db->where([ 'device_id' => $this->input->get_post('deviceid') ]);
		
		$update=$this->db->update('wc_victim',$data);

        return $update;
	}

    function update_existing_victim_deviceid(){
		$data = array(
			'device_id' => $this->input->get_post('deviceid'),
			'status' => "Active",
		);
		
		$this->db->where('mobile',$this->input->get_post('mobile'));
		
		$update=$this->db->update('wc_victim',$data);

        return $update;
	}

    function delete_existing_deviceid_noMobile(){

		$this->db->where([ 'device_id' => $this->input->get_post('deviceid'), 'mobile' => '' ]);
		$delete=$this->db->delete('wc_victim');

        return $delete;
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

    function get_victim_details() {
        $mobile = $this->input->post('mobile');
        $this->db->where('mobile', $mobile);
        $data = $this->db->get('wc_victim');
        return $data->result();
    }

    function get_victim_cases() {
        $mobile = $this->input->post('mobile');
        $this->db->where('mobile', $mobile);
        $data = $this->db->get('wc_cr_report');
        return $data->result();
    }

    function getVictimDetails($id){
        $this->db->where('wcvtid',$id);
        return $this->db->get('wc_victim')->row();
    }
    
    function getExistingVictimDetails(){
		$this->db->where('device_id',$this->input->post('deviceid'));
        return $this->db->get('wc_victim')->row()->victim_id;
    }
}
