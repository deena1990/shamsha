<?php  
class sponser_model extends CI_Model  
{
    function __construct() {
        // Set orderable column fields
        $this->column_order = array(null, 'name','email','mobile','address','price','created_at','pay_result','wcsbid');
        // Set searchable column fields
        $this->column_search = array('name','email','mobile','address','price','created_at','pay_result','wcsbid');
        // Set default order
        $this->order = array('wcsbid' => 'desc');
    }
      
	function get_entries()
	{
		$query = $this->db->get('wc_sponsership_bookings');
  		return $query->result();
    }
    function delete_entry($id)
    {
       $this->db->delete('wc_sponsership_bookings', array('wcsbid' => $id));
    }
    function update_entry($user,$id)
    {
        $this->db->where('wcsbid',$id);
   		$this->db->update('wc_sponsership_bookings',$user);
    }
 	function get($id){
    	$sql = "SELECT * FROM wc_sponsership_bookings WHERE wcsbid = ?";
    	$query =$this->db->query($sql, array($id)); 
            return $query->result();
    }

    function get_row($id){
        $sql = "SELECT * FROM wc_sponsership_bookings WHERE wcsbid = ?";
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
        $this->db->from('wc_sponsership_bookings');
        return $this->db->count_all_results();
    }

    public function countFiltered($postData){
        $this->_get_datatables_query($postData);
        $query = $this->db->get();
        return $query->num_rows();
    }

    private function _get_datatables_query($postData){

        $this->db->from('wc_sponsership_bookings');

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

    }