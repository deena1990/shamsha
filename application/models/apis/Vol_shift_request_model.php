<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vol_shift_request_model extends CI_Model {

    function shift_request() {
        $dt = Date('Y-m-d');
        $volunteer_id = trim($this->input->post('volunteer_id'));
        $shift_type = trim($this->input->post('shift_id'));
        $schedule_id = trim($this->input->post('schedule_id'));
        $reason = trim($this->input->post('reason'));
        $add_days = date('Y-m-d', strtotime($dt. ' + 14 days'));
        $requested_date_time = date("Y-m-d H:i:s");
        $request_end_date = date("Y-m-d H:i:s", strtotime($requested_date_time. ' + 6 hour'));

        $sql = "SELECT * FROM wc_schedule WHERE w_sch_id=$schedule_id";
        $shift_date = $this->db->query($sql)->row();
        if($shift_date->date <= $add_days){
            $sql = "UPDATE wc_schedule SET schedule_status='Requested',requested_by='$volunteer_id',request_end_time='$request_end_date', requested_date_time='$requested_date_time'  WHERE w_sch_id=$schedule_id";
            //echo $sql; exit;
            if($this->db->query($sql)){
                $sql1 = "INSERT INTO wc_schedule_reasons_for_request(schedule_id, volunteer, reason) VALUES ('$schedule_id','$volunteer_id','$reason')";
                return $this->db->query($sql1);
            }
            else{
                return false;
            }

        }
    }

    function shift_request_list(){
        $volunteer_id = trim($this->input->post('volunteer_id'));
        $current_date_time = date("Y-m-d H:i:s");
		//print_r($volunteer_id);
        $sql = "SELECT * FROM wc_voulnteer WHERE vounter_id='$volunteer_id'";
        $volunteer_detail = $this->db->query($sql)->row();
		//print_r($volunteer_detail);
        if(!empty($volunteer_detail)){
            $andQry = "";
            if($volunteer_detail->shift_language == "English"){
                $andQry = ' and sh.shift_language = "English"';
            }
            $rsql = 'SELECT sh.shift_language, sh.shift_name, sh.color, sh.shift_time, sh.image, ws.* FROM `wc_schedule` ws INNER JOIN wc_shifts as sh on ws.shift_id = sh.wcsid  WHERE requested_by !="'.$volunteer_id.'" and request_end_time >= "'. $current_date_time.'" and `schedule_status` = "Requested"'. $andQry. "order by request_end_time asc" ;
			//print_r($this->db->query($rsql)->result());
            return $this->db->query($rsql)->result();
        }
        return false;

    }

    function shift_accept(){
        $date = trim($this->input->post('date'));
        $dt = date("Y-m-d", strtotime($date));
        $time = date("h:i:s", strtotime($date));
        $volunteer_id = trim($this->input->post('volunteer_id'));
        $shift_type = trim($this->input->post('schedule_id'));
        $sql33 = "UPDATE wc_schedule SET volunteer_assign='$volunteer_id', schedule_status='Accepted', accept_time='$time'  
                WHERE w_sch_id=$shift_type";
        return  $this->db->query($sql33);
    }
    



}
