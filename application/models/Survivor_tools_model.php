<?php


class Survivor_tools_model extends CI_Model
{
    function __construct() {
        // Set orderable column fields
        $this->column_order = array('s_id','name','path');
        // Set searchable column fields
        $this->column_search = array('s_id','name','path');
        // Set default order
        $this->order = array('s_id' => 'desc');
    }
    public function list_all_user(){
        $query = $this->db->get('wc_survivor_tools');
        return $query->result();
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
        $this->db->select('*');
        $this->db->from('wc_survivor_tools');
        return $this->db->count_all_results();
    }

    public function countFiltered($postData){
        $this->_get_datatables_query($postData);
        $query = $this->db->get();
        return $query->num_rows();
    }

    private function _get_datatables_query($postData){

        $this->db->select('*');
        $this->db->from('wc_survivor_tools');
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

    function add($data)
    {
        return $this->db->insert('wc_survivor_tools',$data);

    }

    function get($id){
        $sql = "SELECT * FROM wc_survivor_tools WHERE s_id = ?";
        $query =$this->db->query($sql, array($id));
        return $query->row();
    }

    function update_entry($data,$id)
    {
        $this->db->where('s_id',$id);
        return $this->db->update('wc_survivor_tools',$data);
    }

    function delete($id)
    {
        $this->db->where('s_id',$id);
        return $this->db->delete('wc_survivor_tools');;
    }


}