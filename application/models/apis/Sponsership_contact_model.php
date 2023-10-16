<?php
class Sponsership_contact_model extends CI_Model{
    function insert($data)
    {
        return $this->db->insert('sponsership_contact',$data);
    }
}
