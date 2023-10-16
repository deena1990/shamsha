<?php  
class shift_model extends CI_Model  
{  
    function add_shift($user)
	{
    	$this->db->insert('wc_shifts',$user);
    	//$last_id = mysqli_insert_id();
    	//$RANDOM = 'CEO1000'.$last_id;
    	//print_r($last_id);
    	//die();
    	//$this->db->where('ci_user_id',$last_id);
   		//$this->db->update('ci_user',array('userid'=>$RANDOM));
	}   
	function get_entries()
	{
		$query = $this->db->get('wc_shifts');
  		return $query->result();
    }
    function delete_entry($id)
    {
       $this->db->delete('wc_shifts', array('wcsid' => $id));
    }
    function update_entry($user,$id)
    {
        $this->db->where('wcsid',$id);
   		$this->db->update('wc_shifts',$user);
    }
 	function get($id){
    	$sql = "SELECT * FROM wc_shifts WHERE wcsid = ?";
    	$query =$this->db->query($sql, array($id)); 
            return $query->result();
    }
    
}  