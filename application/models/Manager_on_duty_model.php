<?php

class Manager_on_duty_model extends CI_Model
{
    function __construct() {
        // Set orderable column fields
        $this->column_order = array(null, 'id','name','email','contact_no','status','id');
        // Set searchable column fields
        $this->column_search = array('id','name','email','contact_no','status','id');
        // Set default order
        $this->order = array('id' => 'desc');
    }

    function  all(){
        $query = $this->db->get('manager_on_duty');
        return $query->result();
    }

    function add($data){
       return $this->db->insert('manager_on_duty', $data);
    }
    function update($data){
        $this->db->where('id', $data['id']);
        return $this->db->update('manager_on_duty', $data);
    }
    function get_row($id){
        $this->db->where('id', $id);
        return $query = $this->db->get('manager_on_duty')->row();
    }

    function delete($id){
        return $this->db->delete('manager_on_duty', array('id' => $id));
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
        $this->db->from('manager_on_duty');
        $this->db->where('status !=', "Deleted");
        return $this->db->count_all_results();
    }

    public function countFiltered($postData){
        $this->_get_datatables_query($postData);
        $query = $this->db->get();
        return $query->num_rows();
    }

    private function _get_datatables_query($postData){

        $this->db->from('manager_on_duty');
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

    function checkAvailability($date, $id = ''){
        if(!empty($id)){
            $this->db->where('id !=', $id);
        }
        $this->db->where("'$date'".' BETWEEN start_date and end_date', '',false);
        return $this->db->get('manager_on_duty')->num_rows();
    }

    function get_row_api(){
        $date = date('Y-m-d');
        $this->db->where('status =', 'Active');
        $this->db->where("'$date'".' BETWEEN start_date and end_date', '',false);
        return $query = $this->db->get('manager_on_duty')->row();
    }

}  