<?php  
class Services_model extends CI_Model  
{  
	function book_ramada($data){
	    $data['booking_status'] = "Pending";
	    $insert = $this->db->insert('wc_ramada_booking', $data);
	    $insert_id = $this->db->insert_id();
	    if($insert){
	        return $insert_id;
	    }
	    else{
	         return "failure";
	    }
	}
	function update_ramada($data){
	    
	    $data['booking_status'] = "Confirmed";
    	$this->db->where('id',$data['id']);
   		$update = $this->db->update('wc_ramada_booking',$data);
   		if($update){
	        return "success";
	    }
	    else{
	         return "failure";
	    }
	}
	
	function get_volunteer_detail($data){
        $this->db->select("wc_voulnteer.vol_token_id,wc_voulnteer.device");
        $this->db->from('wc_ramada_booking');
        $this->db->join('wc_voulnteer', 'wc_voulnteer.vounter_id = wc_ramada_booking.volunteer_id');
        $this->db->where('id', $data['id']);
        $data = $this->db->get();
        return $data->row();
    }
    
}  