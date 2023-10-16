<?php

class Resource_location_model extends CI_Model
{

    function  all(){
        $query = $this->db->get('wc_resource_locations');
        return $query->result();
    }

    function add($data){
       return $this->db->insert('wc_resource_locations', $data);
    }
    function update($data){
        $this->db->where('wcrid', $data['wcrid']);
        return $this->db->update('wc_resource_locations', $data);
    }
    function get_row($id){
        $this->db->where('wcrid', $id);
        return $query = $this->db->get('wc_resource_locations')->row();
    }

    function delete($id){
        return $this->db->delete('wc_resource_locations', array('wcrid' => $id));
    }

}  