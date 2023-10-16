<?php  
class Job_model extends CI_Model  
{  
    function add($user)
	{
    	$this->db->insert('wc_jobs',$user);
	}   
	function get_entries()
	{
		$query = $this->db->get('wc_jobs');
  		return $query->result();
    }
    function delete_entry($id)
    {
       $this->db->delete('wc_jobs', array('wcjid' => $id));
    }
    function delete_jobapplicant_entry($id)
    {
       $this->db->delete('wc_job_applicants', array('wcjaid' => $id));
    }
    function update_entry($user,$id)
    {
        $this->db->where('wcjid',$id);
   		$this->db->update('wc_jobs',$user);
    }
 	function get($id){
    	$sql = "SELECT * FROM wc_jobs WHERE wcjid = ?";
    	$query =$this->db->query($sql, array($id)); 
            return $query->result();
    }
    function get_applicant_entries($id){
    	$sql = "SELECT * FROM wc_job_applicants WHERE job_id = ?";
    	$query =$this->db->query($sql, array($id)); 
            return $query->result();
    }
    function update_jobid_entry($insert_id){
    	$RANDOM = 'WCJ00'.$insert_id;
    	$this->db->where('wcjid',$insert_id);
   		$this->db->update('wc_jobs',array('job_id'=>$RANDOM, 'status'=>'Open'));
    }

    function get_row($id){
        $sql = "SELECT * FROM wc_jobs WHERE wcjid = ?";
        $query =$this->db->query($sql, array($id));
        return $query->row();
    }

    function get_applicant_row($id){
        $sql = "SELECT * FROM wc_job_applicants WHERE wcjaid = ?";
        $query =$this->db->query($sql, array($id));
        return $query->row();
    }
    
}  