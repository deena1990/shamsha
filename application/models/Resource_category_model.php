<?php

class Resource_category_model extends CI_Model
{

    function  all(){
        $query = $this->db->get('wc_resource_category');
        return $query->result();
    }

    function add($data){
       return $this->db->insert('wc_resource_category', $data);
    }
    function update($data){
        $this->db->where('wcrcid', $data['wcrcid']);
        return $this->db->update('wc_resource_category', $data);
    }
    function get_row($id){
        $this->db->where('wcrcid', $id);
        return $query = $this->db->get('wc_resource_category')->row();
    }

    function delete($id){
        return $this->db->delete('wc_resource_category', array('wcrcid' => $id));
    }

}  