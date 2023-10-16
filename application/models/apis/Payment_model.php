<?php  
class Payment_model extends CI_Model  
{  
	function add_payment($data){
	    unset($data['url']);
	    $insert = $this->db->insert('wc_payment', $data);
	    if($insert){
	        return "success";
	    }
	    else{
	         return "failure";
	    }
	}
	function update_payment($data){
	    
	    $id = $data['isysid'];
	    unset($data['isysid']);
	    $data['return_hash'] = $data['hash'];
	     unset($data['hash']);
    	$this->db->where('isysid',$id);
   		$update = $this->db->update('wc_payment',$data);
   		if($update){
   		    $this->update_sponsor($data);
	        return "success";
	    }
	    else{
	         return "failure";
	    }
	}

	function  update_sponsor($data){
        $id = $data['isysid'];
        $result['result'] = $data['result'];
        $this->db->where('transaction_id',$id);
        $update = $this->db->update(' wc_sponsership_bookings',$data);
        if($update){
            return "success";
        }
        else{
            return "failure";
        }
    }
    
}  