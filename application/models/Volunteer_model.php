<?php  
class Volunteer_model extends CI_Model  
{

    function __construct() {
        // Set orderable column fields
        $this->column_order = array( null, 'vounter_id','vname', 'shift_language','vemail','vmobile','whatsapp','total_rewards','status','wc_vid');
        // Set searchable column fields
        $this->column_search = array('vounter_id','vname','shift_language','vemail','vmobile','whatsapp','total_rewards','status','wc_vid');
        // Set default order
        $this->order = array('wc_vid' => 'desc');
    }

    function add_user($user)
	{
    	$this->db->insert('wc_voulnteer',$user);
    
	}   
	function get_entries()
	{

		$query = $this->db->where('status !=', "Deleted")
        ->order_by("wc_vid", "desc")->get('wc_voulnteer');
        //print_r($this->db->last_query()); exit;
        return $query->result();
    }
    function get_language(){
        $query = $this->db->order_by("lname", "asc")->get('wc_languages');
  		return $query->result();
    }
    function delete_entry($id)
    {
       //$this->db->delete('wc_voulnteer', array('wc_vid' => $id));
       $this->db->where('wc_vid',$id);
   		return $this->db->update('wc_voulnteer',array('status'=>'Deleted'));
    }
    function update_entry($user,$id)
    {
        $this->db->where('wc_vid',$id);
   		return $this->db->update('wc_voulnteer',$user);
    }
 	function get($id){
    	$sql = "SELECT * FROM wc_voulnteer WHERE wc_vid = ?";
    	$query =$this->db->query($sql, array($id)); 
            return $query->result();
    }
    function update_entry_password($user,$id)
    {
        $this->db->where('wc_vid',$id);
   		$this->db->update('wc_voulnteer',$user);
    }
    function update_userid_entry($insert_id){
    	$RANDOM = 'SV'.str_pad($insert_id, 6, '0', STR_PAD_LEFT);
    	$this->db->where('wc_vid',$insert_id);
   		$this->db->update('wc_voulnteer',array('vounter_id'=>$RANDOM, 'status'=>'Active'));
    }

    function get_row($id){
        $sql = "SELECT * FROM wc_voulnteer WHERE wc_vid = ?";
        $query =$this->db->query($sql, array($id));
        return $query->row();
    }

    public function getRows($postData){
        $this->_get_datatables_query($postData);
        if($postData['length'] != -1){
            $this->db->limit($postData['length'], $postData['start']);
        }
        $query = $this->db->get();
        return $query->result();
    }

    public function countAll(){
        $this->db->from('wc_voulnteer');
        $this->db->where('status !=', "Deleted");
        return $this->db->count_all_results();
    }

    public function countFiltered($postData){
        $this->_get_datatables_query($postData);
        $query = $this->db->get();
        return $query->num_rows();
    }

    private function _get_datatables_query($postData){

        $this->db->from('wc_voulnteer');
        $this->db->where('status !=', "Deleted");
        $i = 0;
        // loop searchable columns
        foreach($this->column_search as $item){
            // if datatable send POST for search
            if($postData['search']['value']){
                // first loop
                if($i===0){
                    // open bracket
                    $this->db->group_start();
                    $this->db->like($item, $postData['search']['value']);
                }else{
                    $this->db->or_like($item, $postData['search']['value']);
                }

                // last loop
                if(count($this->column_search) - 1 == $i){
                    // close bracket
                    $this->db->group_end();
                }
            }
            $i++;
        }

        if(isset($postData['order'])){
            $this->db->order_by($this->column_order[$postData['order']['0']['column']], $postData['order']['0']['dir']);
        }else if(isset($this->order)){
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
    
    function email_validation($email){

        $this->db->where('vemail',$email);
        $this->db->where("status !=","Deleted");
        $query = $this->db->get('wc_voulnteer');
        return $query->num_rows();
    }

    function get_ActiveVolsCount(){
        $this->db->where('id',1);
        $query = $this->db->get('wc_min_active_vol_count')->row();
        return $query->count;
    }

    function saveActiveVolsCount(){
        $this->db->update('wc_min_active_vol_count',array('count'=>$this->input->post('activeVolsCount'), ));
    }
}  