<?php  
class about_model extends CI_Model  
{  
    function add_home($user)
	{
    	$this->db->where('wcp_id',1);
        $this->db->update('wc_pages',$user);
	}   
	function hget($id){
    	$sql = "SELECT * FROM wc_pages WHERE wcp_id = 1";
    	$query =$this->db->query($sql); 
            return $query->result();
    }
    function add_about($user)
	{
    	$this->db->where('wcp_id',8);
        $this->db->update('wc_pages',$user);
	}   
	function aget($id){
    	$sql = "SELECT * FROM wc_pages WHERE wcp_id = 8";
    	$query =$this->db->query($sql); 
            return $query->result();
    }
    function add_vol_con($user)
	{
    	$this->db->where('wcp_id',5);
        $this->db->update('wc_pages',$user);
	}   
	function get_vol_con($id){
    	$sql = "SELECT * FROM wc_pages WHERE wcp_id = 5";
    	$query =$this->db->query($sql); 
            return $query->result();
    }
	
}  