<?php  
class Advocacy_model extends CI_Model  
{  
       
	function get_entries()
	{
		$query = $this->db->get('wc_advocacy_training');
  		return $query->result();
    }
    function delete_entry($id)
    {
       $this->db->delete('wc_advocacy_training', array('id' => $id));
    }
    function update_entry($user,$id)
    {
        $this->db->where('id',$id);
   		return $this->db->update('wc_advocacy_training',$user);
    }
 	function get($id){
    	$sql = "SELECT * FROM wc_advocacy_training WHERE id = ?";
    	$query =$this->db->query($sql, array($id)); 
            return $query->result();
    }
    
    function getdetails($id){
    	$sql = "SELECT * FROM wc_advocacy_training WHERE id = ?";
    	$query =$this->db->query($sql, array($id)); 
            return $query->row();
    }
    
    function add($user) {
        $this->db->set($user);
        $insert = $this->db->insert('wc_advocacy_training');
        if($insert){
            $insert_id = $this->db->insert_id();
            return  $insert_id;
        }
        else{
            return "failed";
        }
        
    }
    
    function update_payment($data,$vid){
	    
	    $id = $data['isysid'];
	    unset($data['isysid']);
	    $data['return_hash'] = $data['hash'];
	     unset($data['hash']);
    	$this->db->where('isysid',$id);
   		$update = $this->db->update('wc_payment',$data);
   		if($update){
   		    $data1['transaction_id'] = $id;
   		    $data1['payment_status'] = $data['result'];
   		    $this->db->where('id',$vid);
   		    $update = $this->db->update('wc_advocacy_training',$data1);
	        return "success";
	    }
	    else{
	         return "failure";
	    }
	}
	
	function get_row($id){
        $this->db->where('id',$id);
        $query =$this->db->get('wc_advocacy_training');
        return $query->row();
    }
    
}  