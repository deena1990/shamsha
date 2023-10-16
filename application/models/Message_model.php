<?php  
class Message_model extends CI_Model  
{  
    function add($user)
	{
    	$this->db->insert('wc_messages',$user);
	}  
	function get_entries()
	{
        $this->db->order_by("id", "desc");
		$query = $this->db->get('wc_messages');
  		return $query->result();
    }
    function delete_entry($id)
    {
       $this->db->delete('wc_messages', array('id' => $id));
    }
    function update_entry($user,$id)
    {
        $this->db->where('id',$id);
   		$this->db->update('wc_messages',$user);
    }
 	function get($id){
    	$sql = "SELECT * FROM wc_messages WHERE id = ?";
    	$query =$this->db->query($sql, array($id));
            return $query->result();
    }
    function get_message($id){
    	$sql = "SELECT * FROM wc_messages WHERE id = $id";
    	$query =$this->db->query($sql);
            return $query->row();
    }

  
    function add_title($user)
	{
    	$this->db->insert('wc_message_titles',$user);
	}
    function get_title_list()
	{
        $this->db->order_by("id", "desc");
		$query = $this->db->get('wc_message_titles');
  		return $query->result();
    } 
    function update_title($user,$id)
    {
        $this->db->where('id',$id);
   		$this->db->update('wc_message_titles',$user);
    }
 	function get_title($id){
    	$sql = "SELECT * FROM wc_message_titles WHERE id = ?";
    	$query =$this->db->query($sql, array($id));
            return $query->result();
    }
    function delete_title($id)
    {
       $this->db->delete('wc_message_titles', array('id' => $id));
    }
    
}  