<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Forgetpass_voulnteer_model extends CI_Model {

    function get_voulnteer_email() {
        $this->db->select("vemail,vpassword");
        $this->db->where(array( 'vemail' => $this->input->post('email'), 'status' => 'Active' ));
        $query = $this->db->get('wc_voulnteer');
        // echo"<pre>";print_r($query->row());die;
        if($query->row() !='')
        {
            return $query->row();
        }
        
    }
}
