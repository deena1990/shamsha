<?php  
class termsncondition_model extends CI_Model  
{  
    function add_terms($user)
	{
    	$this->db->where('wcp_id',2);
        $this->db->update('wc_pages',$user);
	}   
	function get($id){
    	$sql = "SELECT * FROM wc_pages WHERE wcp_id = 2";
    	$query =$this->db->query($sql); 
            return $query->result();
    }
	
}  