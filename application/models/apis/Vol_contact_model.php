<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Vol_contact_model extends CI_Model {

    function insert_con($user) {
       
        $this->db->set($user);
        return $this->db->insert('wc_volunteer_contacts');
    }
 
}
