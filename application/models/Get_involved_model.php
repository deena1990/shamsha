<?php  
class Get_involved_model extends CI_Model  
{  
    function add($user)
	{
    	$this->db->where('wcp_id',3);
        $this->db->update('wc_pages',$user);
	}   
	function get($id){
    	$sql = "SELECT * FROM wc_pages WHERE wcp_id = 3";
    	$query =$this->db->query($sql); 
            return $query->result();
    }
   
	
}  