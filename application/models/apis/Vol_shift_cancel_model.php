<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Vol_shift_cancel_model extends CI_Model {

    function cancel_shift() {
       $dt = Date('Y-m-d');
        $volunteer_id = trim($this->input->post('volunteer_id'));
       // $shift_type = trim($this->input->post('shift_id'));
        $schedule_id = trim($this->input->post('schedule_id'));
        $reason = trim($this->input->post('reason'));
        $add_days = date('Y-m-d', strtotime($dt. ' + 14 days'));
        
        $sql = "SELECT * FROM wc_schedule WHERE w_sch_id=$schedule_id";
        $shift_date = $this->db->query($sql)->row()->date;
        
       // print_r($shift_date);
    //    print_r($add_days);
        
        if($shift_date>=$add_days){
            $sql = "UPDATE wc_schedule SET volunteer_assign = '', schedule_status='Cancelled' WHERE w_sch_id=$schedule_id";
            return $this->db->query($sql);
            $sql1 = "INSERT INTO wc_schedule_reasons_for_cancel(schedule_id, volunteer, reason) VALUES ('$schedule_id','$volunteer_id','$reason')";
            return $this->db->query($sql1);
        }
        
         
       // return $data->result();
    }

    
}
