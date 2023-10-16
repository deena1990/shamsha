<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Sponser_model extends CI_Model {

    function individual_sponser($user) {
        $this->db->set($user);
        return $this->db->insert('wc_sponsership_bookings');
    }
    function general_sponser($user) {
        $this->db->set($user);
        return $this->db->insert('wc_sponsership_bookings');
    }
    function coorporate_sponser($user) {
        $this->db->set($user);
        return $this->db->insert('wc_sponsership_bookings');
    }
    function update_sponserid_entry($insert_id){
    	$RANDOM = 'WCS0000'.$insert_id;
    	$this->db->where('wcsbid',$insert_id);
   		$this->db->update('wc_sponsership_bookings',array('sbooking_id'=>$RANDOM, 'status'=>'Active'));
    }
    
    
    
    
}
