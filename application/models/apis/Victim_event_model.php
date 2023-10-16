<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Victim_event_model extends CI_Model {

    function get_data() {
        $event_for = 'Victim';
        /*$this->db->select("wceid, event_type, price, title_en, title_ar, short_en, content_en, content_ar, venu, venu_time, date, status");
        $this->db->where('event_for', $event_for);
        $data = $this->db->get('wc_events');
            return $data->result();*/
        
       
        
       $sql = "SELECT * FROM wc_events WHERE wc_events.event_for='$event_for' and wc_events.status='Active' order by wc_events.wceid desc";
      // print_r($sql); exit;
        $data =  $this->db->query($sql);
        return $data->result();
        
    }
    
    function get_info_detail(){
        $event = $this->input->post('event_id');
        $sql = "SELECT *
FROM wc_events WHERE wceid='$event'";  
      //  print_r($sql);
        $data =  $this->db->query($sql);
        return $data->result();
    }
    
    function get_imagedata() {
        $event = $this->input->post('event_id');
        $this->db->select("wceiid,image");
        $this->db->where('event_id', $event);
        $data = $this->db->get('wc_events_images');
            return $data->result();
        
      
        
    }
    
    
}
