<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Event_model extends CI_Model {

    function get_data(){
        $date = date('Y-m-d');
        $this->db->select("wceid, event_for, title_en, title_ar, event_type, req_registration, short_en, content_en, content_ar, event_pic, price, venu, venu_time, date_format(`date`, '%d %b %Y'), status");
        $this->db->where('status', 'Open');
        $this->db->where('date >=', $date);
        $data = $this->db->get('wc_events');
        return $data->result();
    }

    function get_data_vol(){
        $date = date('Y-m-d');
        $this->db->select("wceid, event_for, title_en, title_ar, event_type, req_registration, short_en, content_en, content_ar, event_pic, price, venu, venu_ar, venu_time, date, status");
        $this->db->where('status', 'Open');
        $this->db->where('event_for', 'Volunteer');
        $this->db->where('date >=', $date);
        $data = $this->db->get('wc_events');
        return $data->result();
    }

    function get_media_photo(){
        $data = $this->db->get('wc_events_images');
        return $data->result();
    }

    function get_media_article(){
        $data = $this->db->get('wc_media_articles');
        return $data->result();
    }
    
    function get_detail_info(){
        $date = date('Y-m-d');
        $jobid = trim($this->input->post('eventid'));
        $this->db->select("wceid, event_id, title, job_type, brief, detail, date_format(`jdate`, '%d %b %Y') 
        AS jdate, detail, date_format(`edate`, '%d %b %Y') AS edate,  status");
        $this->db->where('wceid', $eventid);
        $this->db->where('edate >=', $date);
        $data = $this->db->get('wc_events');
        return $data->result();
    }
    
}
