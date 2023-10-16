<?php
class Feedback_model extends CI_Model{
    function insert($data)
    {
        return $this->db->insert('feedback_form',$data);
    }
}
