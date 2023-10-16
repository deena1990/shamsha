<?php


class Permission_model extends CI_Model
{
    function __construct() {
        // Set orderable column fields
        $this->column_order = array('name','display_name','description','created_at','status','id');
        // Set searchable column fields
        $this->column_search = array('name','display_name','description','created_at','status','id');
        // Set default order
        $this->order = array('id' => 'desc');
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
        $this->db->from('permissions');
        return $this->db->count_all_results();
    }

    public function countFiltered($postData){
        $this->_get_datatables_query($postData);
        $query = $this->db->get();
        return $query->num_rows();
    }

    private function _get_datatables_query($postData){

        $this->db->from('permissions');
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

    public function get_all_roles(){
        $query = $this->db->get('roles');
        return $query->result();
    }

    public function add_module($data)
    {
        return $this->db->insert('modules', $data);
    }
    public function get_all_modules(){
        $this->db->where('status',1);
        $query = $this->db->get('modules');
        return $query->result();
    }
}