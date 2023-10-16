<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class cp_model extends CI_Model{
    
    function fetch_pass($session_id)
    {
        $fetch_pass=$this->db->query("select * from wc_admin where username='$session_id'");
        $res=$fetch_pass->result();
    }
    function change_pass($session_id,$new_pass)
    {
        $update_pass=$this->db->query("UPDATE wc_admin set password='$new_pass'  where username='$session_id'");
    }

    function change_pass_admin($id,$new_pass)
    {
        return $this->db->query("UPDATE users set password='$new_pass'  where id='$id'");
    }
    
}
?>