<?php  
class Sponsership_model extends CI_Model  
{  
    function add_isponser($user)
	{
    	$this->db->where('wcp_id',6);
        $this->db->update('wc_pages',$user);
	}   
	function iget($id){
    	$sql = "SELECT * FROM wc_pages WHERE wcp_id = 6";
    	$query =$this->db->query($sql); 
            return $query->result();
    }
    function add_csponser($user)
	{
    	$this->db->where('wcp_id',7);
        $this->db->update('wc_pages',$user);
	}   
	function cget($id){
    	$sql = "SELECT * FROM wc_pages WHERE wcp_id = 7";
    	$query =$this->db->query($sql); 
            return $query->result();
    }
	
}  