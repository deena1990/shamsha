<?php  
class logo_model extends CI_Model  
{  
    function add_logo($user)
	{
    	$this->db->where('wc_id',1);
        $this->db->update('wc_settings',$user);
	}   
	function get($id){
    	$sql = "SELECT * FROM wc_settings WHERE wc_id = 1";
    	$query =$this->db->query($sql); 
            return $query->result();
    }
}  