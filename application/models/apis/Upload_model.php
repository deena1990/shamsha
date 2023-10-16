<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Upload_model extends CI_Model {

    function upload($user) {
       
        $this->db->set($user);
        return $this->db->insert('upload');
    }
 
}
