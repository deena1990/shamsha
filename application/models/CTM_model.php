<?php  
class CTM_model extends CI_Model  
{  
    function add($user)
	{
    	$this->db->insert('wc_core_team',$user);
	}   
	function get_entries()
	{
		$query = $this->db->get('wc_core_team');
  		return $query->result();
    }
    function delete_entry($id)
    {
       $this->db->delete('wc_core_team', array('id' => $id));
    }
    function update_entry($user,$id)
    {
        $this->db->where('id',$id);
   		$this->db->update('wc_core_team',$user);
    }
 	function get($id){
    	$sql = "SELECT * FROM wc_core_team WHERE id = ?";
    	$query =$this->db->query($sql, array($id)); 
            return $query->result();
    }
    
}  