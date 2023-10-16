<?php  
class BM_model extends CI_Model  
{  
    function add($user)
	{
    	$this->db->insert('wc_board_mem',$user);
	}   
	function get_entries()
	{
        $this->db->order_by("id", "desc");
		$query = $this->db->get('wc_board_mem');
  		return $query->result();
    }
    function delete_entry($id)
    {
       $this->db->delete('wc_board_mem', array('id' => $id));
    }
    function update_entry($user,$id)
    {
        $this->db->where('id',$id);
   		$this->db->update('wc_board_mem',$user);
    }
 	function get($id){
    	$sql = "SELECT * FROM wc_board_mem WHERE id = ?";
    	$query =$this->db->query($sql, array($id)); 
            return $query->result();
    }

    function get_bmember($id){
    	$sql = "SELECT * FROM wc_board_mem WHERE id = $id";
    	$query =$this->db->query($sql); 
            return $query->row();
    }
    
}  