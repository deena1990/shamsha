<?php  
class Partner_model extends CI_Model  
{  
    function add($user)
	{
    	$this->db->insert('wc_partners',$user);
	}   
	function get_entries()
	{
		$query = $this->db->get('wc_partners');
  		return $query->result();
    }
    function delete_entry($id)
    {
       $this->db->delete('wc_partners', array('id' => $id));
    }
    function update_entry($user,$id)
    {
        $this->db->where('id',$id);
   		$this->db->update('wc_partners',$user);
    }
 	function get($id){
    	$sql = "SELECT * FROM wc_partners WHERE id = ?";
    	$query =$this->db->query($sql, array($id)); 
            return $query->result();
    }
    
}  