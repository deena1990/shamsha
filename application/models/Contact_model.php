<?php  
class Contact_model extends CI_Model  
{  
    function add($user)
	{
    	$this->db->where('wcp_id',4);
        $this->db->update('wc_pages',$user);
	}   
	function get($id){
    	$sql = "SELECT * FROM wc_pages WHERE wcp_id = 4";
    	$query =$this->db->query($sql); 
            return $query->result();
    }
    function userDetail($id){
        $query="SELECT * FROM wc_pages WHERE wcp_id = $id";
        $query1=$this->db->query($query);
        return $query1->row();
    }   
}  