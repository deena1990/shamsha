<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Schedule_model2 extends CI_Model {

    function get_data() {
        $sql =  "SELECT a.w_sch_id, a.schedule_id, a.date, 
        a.volunteer_assign, a.schedule_status, b.shift_name, b.shift_time, b.image, b.shift_language FROM wc_schedule2 a LEFT JOIN wc_shifts b ON 
        a.shift_id = b.wcsid";
       
        $data = $this->db->query($sql);
        return $data->result();
    }

     function get_volun_schedule_data(){
        $vol = $this->input->post('volunteer_id');
        
        $sql = "select w_sch_id, schedule_id, date, shift_type, shift_time, shift_lang, 
        volunteer_assign, schedule_status FROM `wc_schedule` WHERE volunteer_assign='$vol' AND MONTH(date) = MONTH(CURRENT_DATE()) AND YEAR(date) = YEAR(CURRENT_DATE())";
        //print_r($sql);
        $data = $this->db->query($sql);
        return $data->result();
    }
    
    function get_volun_upcoming_schedule_data(){
        $vol = $this->input->post('volunteer_id');
        
        $sql = "select w_sch_id, schedule_id, date, shift_type, shift_time, shift_lang, 
        volunteer_assign, schedule_status FROM `wc_schedule` WHERE volunteer_assign='$vol' AND MONTH(date) = MONTH(CURRENT_DATE()) AND YEAR(date) = YEAR(CURRENT_DATE()) ORDER BY w_sch_id ASC LIMIT 1";
        //print_r($sql);
        $data = $this->db->query($sql);
        return $data->result();
    }

    function check_schedule_data_oncurdate(){
        $volunteer_id = $this->input->post('volunteer_id');
        $date = Date('Y-m-d');
        $sql = "SELECT COUNT(w_sch_id) as no_of_rows FROM wc_schedule WHERE 
        volunteer_assign = '$volunteer_id' AND date = '$date'";
        return $this->db->query($sql)->row()->no_of_rows;
    }

    function get_schedule_data_oncurdate(){
        //$date = Date('Y-m-d');
        $date = $this->input->post('date');
        $volunteer_id = $this->input->post('volunteer_id');
        $this->db->select("w_sch_id, schedule_id, date, shift_type, shift_time, shift_lang, volunteer_assign, schedule_status");
        $this->db->where('volunteer_assign', $volunteer_id);
        $this->db->where('date', $date);
        $data = $this->db->get('wc_schedule');
        return $data->result();
    }
    function get_volun_schedule_data_by_year(){
        
        $volunteer_id = $this->input->post('volunteer_id');
         /*$sql = "select w_sch_id, schedule_id, date, shift_type, shift_time, shift_lang, 
        volunteer_assign, schedule_status FROM `wc_schedule` WHERE  volunteer_assign='$volunteer_id' AND Year(date) = Year(CURRENT_DATE())" ;*/
        $sql = "SELECT a.w_sch_id, a.schedule_id, a.date, a.shift_type, a.shift_time, a.shift_lang, 
        a.volunteer_assign, a.schedule_status, b.vname, b.profile_pic FROM wc_schedule a LEFT JOIN wc_voulnteer b ON 
        a.volunteer_assign = b.vounter_id WHERE a.volunteer_assign='$volunteer_id' AND Year(a.date) = Year(CURRENT_DATE())";
      //  print_r($sql);
        $data = $this->db->query($sql);
        return $data->result();
        
    }
    function get_shiftdata_ondate(){
        $date = $this->input->post('date');
        $sql = "SELECT a.w_sch_id, a.schedule_id, a.date, a.shift_type, a.shift_time, a.shift_lang, 
        a.volunteer_assign, a.schedule_status, b.vname, b.profile_pic FROM wc_schedule a LEFT JOIN wc_voulnteer b ON 
        a.volunteer_assign = b.vounter_id WHERE a.date = '$date'";
       /* $sql = "select w_sch_id, schedule_id, date, shift_type, shift_time, shift_lang, 
        volunteer_assign, schedule_status FROM `wc_schedule` WHERE date = '$date'";*/
       // print_r($sql);
        $data = $this->db->query($sql);
        return $data->result();
    }
    
    
    function get_schedule_data_oncurmonth(){
        
        
         $sql = "select w_sch_id, schedule_id, date, shift_type, shift_time, shift_lang, 
        volunteer_assign, schedule_status FROM `wc_schedule` WHERE MONTH(date) = MONTH(CURRENT_DATE())";
        //print_r($sql);
        $data = $this->db->query($sql);
        return $data->result();
        
    }
    
    function get_schedule_data_oncuryear(){
        
         $sql =  "SELECT a.w_sch_id, a.schedule_id, a.date, a.shift_type, a.shift_time, a.shift_lang, 
        a.volunteer_assign, a.schedule_status, b.vname, b.profile_pic FROM wc_schedule a LEFT JOIN wc_voulnteer b ON 
        a.volunteer_assign = b.vounter_id WHERE Year(a.date) = Year(CURRENT_DATE())";
        /* $sql = "select w_sch_id, schedule_id, date, shift_type, shift_time, shift_lang, 
        volunteer_assign, schedule_status FROM `wc_schedule` WHERE Year(date) = Year(CURRENT_DATE())";*/
        //print_r($sql);
        $data = $this->db->query($sql);
        return $data->result();
        
    }
    
     function get_schedule_openshiftdata_oncuryear(){
        
        /* $sql = "select w_sch_id, schedule_id, date, shift_type, shift_time, shift_lang, 
        volunteer_assign, schedule_status FROM `wc_schedule` WHERE  volunteer_assign='' AND Year(date) = Year(CURRENT_DATE())" ;*/
        $sql =  "SELECT a.w_sch_id, a.schedule_id, a.date, a.shift_type, a.shift_time, a.shift_lang, 
        a.volunteer_assign, a.schedule_status, b.vname, b.profile_pic FROM wc_schedule a LEFT JOIN wc_voulnteer b ON 
        a.volunteer_assign = b.vounter_id WHERE a.volunteer_assign='' AND Year(a.date) = Year(CURRENT_DATE())";
       
        $data = $this->db->query($sql);
        return $data->result();
        
    }

}
