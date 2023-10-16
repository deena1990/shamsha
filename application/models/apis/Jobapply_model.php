<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Jobapply_model extends CI_Model {

    function upload($user) {
        $this->db->set($user);
        return $this->db->insert('wc_job_applicants');
    }
 
}
