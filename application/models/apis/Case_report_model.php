<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Case_report_model extends CI_Model {

    function insert($data) {
        $this->db->set($data);
        return $this->db->insert('wc_cr_report');
    }

}
