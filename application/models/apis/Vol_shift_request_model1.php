<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Vol_shift_request_model extends CI_Model {

    function request_shift() {
        $dt = date('Y-m-d');
        $date = trim($this->input->post('date'));
        $reason=$this->input->post('reason');
        $volunteer_id = trim($this->input->post('volunteer_id'));
        $schedule_id = trim($this->input->post('schedule_id'));

        $add_days = date('Y-m-d', strtotime($dt. ' + 14 days'));

        $sql = "SELECT * FROM wc_schedule WHERE w_sch_id='$schedule_id'";
        $shift_date = $this->db->query($sql)->row()->date;

        $this->db->where('w_sch_id',$schedule_id);
        $result=$this->db->update('wc_schedule',array('volunteer_assign'=>$volunteer_id, 'schedule_status'=>'Requested'));

        return $result;

        /*if($shift_date>=$add_days){

            $sql = "UPDATE wc_schedule SET volunteer_assign='$volunteer_id', schedule_status='Cancelled' WHERE w_sch_id='$schedule_id'";
            $qry=$this->db->query($sql)->result_array();
            if($qry){
                $sql1 = "INSERT INTO wc_schedule_reasons_for_cancel(schedule_id, volunteer, reason) VALUES ('$schedule_id','$volunteer_id','$reason')";
                return $this->db->query($sql1)->result();
            }
        }*/
    }

    function shift_request_list(){
        $volunteer_id = trim($this->input->post('volunteer_id'));
        $current_date_time = date("Y-m-d H:i:s");

        $sql = "SELECT * FROM wc_voulnteer WHERE vounter_id='$volunteer_id'";
        $volunteer_detail = $this->db->query($sql)->row();
        if(!empty($volunteer_detail)){
            $andQry = "";
            if($volunteer_detail->shift_language == "English"){
                $andQry = ' and sh.shift_language = "English"';
            }
            $rsql = 'SELECT sh.shift_language, sh.shift_name, sh.color, sh.shift_time, sh.image, ws.* FROM `wc_schedule` ws INNER JOIN wc_shifts as sh on ws.shift_id = sh.wcsid  WHERE requested_by !="'.$volunteer_id.'" and request_end_time >= "'. $current_date_time.'" and `schedule_status` = "Requested"'. $andQry. "order by request_end_time asc" ;
             print_r($rsql); exit;
            return $this->db->query($rsql)->result();
           
        }
        return false;

    }

}

