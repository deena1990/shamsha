<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Job_model extends CI_Model {

    function get_data(){
        $date = date('Y-m-d');
        $this->db->select("wcjid, job_id, title, job_type, brief, detail, date_format(`jdate`, '%d %b %Y') 
        AS jdate, date_format(`edate`, '%d %b %Y') AS edate");
        $this->db->where('status', 'Open');
        $this->db->where('edate >=', $date);
        $data = $this->db->get('wc_jobs');
        return $data->result();
    }
    
    function get_detail_info(){
        $date = date('Y-m-d');
        $jobid = trim($this->input->post('jobid'));
        $this->db->select("wcjid, job_id, title, job_type, brief, detail, date_format(`jdate`, '%d %b %Y') 
        AS jdate, detail, date_format(`edate`, '%d %b %Y') AS edate,  status");
        $this->db->where('wcjid', $jobid);
        $this->db->where('edate >=', $date);
        $data = $this->db->get('wc_jobs');
        return $data->result();
    }
    
}