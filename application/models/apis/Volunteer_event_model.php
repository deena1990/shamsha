<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Volunteer_event_model extends CI_Model {

    function get_data() {
        $event_for = 'Volunteer';
        $sql = "SELECT * FROM wc_events WHERE wc_events.status='Active' order by wc_events.wceid desc";
      //  print_r($sql);
        $data =  $this->db->query($sql);
        return $data->result();
    }
    
}
