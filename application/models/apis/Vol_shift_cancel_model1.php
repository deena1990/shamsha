<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vol_shift_cancel_model extends CI_Model {

    function cancel_shift() {
        $dt = date('Y-m-d');
        $volunteer_id = trim($this->input->post('volunteer_id'));
        $schedule_id = trim($this->input->post('schedule_id'));
        $reason = trim($this->input->post('reason'));
        //$add_days = date('Y-m-d', strtotime($dt. ' + 14 days'));

        $add_days = strtotime($dt. ' + 14 days');

        $sql = "SELECT * FROM wc_schedule WHERE w_sch_id='$schedule_id'";
        $shift_date = $this->db->query($sql)->row()->date;

        $shift_date=strtotime($shift_date);

        if($shift_date>=$add_days){
            $this->db->where('w_sch_id',$schedule_id);
            $result=$this->db->update('wc_schedule',array('volunteer_assign'=>$volunteer_id, 'schedule_status'=>'Cancelled'));
            if($result)
            {
                $sql1=$this->db->insert('wc_schedule_reasons_for_cancel',array('schedule_id'=>$schedule_id, 'volunteer'=>$volunteer_id, 'reason'=>$reason));
                /*$sql1 = "INSERT INTO wc_schedule_reasons_for_cancel(schedule_id, volunteer, reason) VALUES ('$schedule_id','$volunteer_id','$reason')";
                $this->db->query($sql1)->result();*/
            }
            return $result;
        }

        /*if($shift_date>=$add_days){

            //$sql = "UPDATE wc_schedule SET volunteer_assign='$volunteer_id', schedule_status='Cancelled' WHERE w_sch_id='$schedule_id'";
            $sql = "UPDATE wc_schedule SET volunteer_assign='$volunteer_id', schedule_status='Cancelled' WHERE w_sch_id='$schedule_id'";
             $qry=$this->db->query($sql)->result_array();
             if($qry){
                 $sql1 = "INSERT INTO wc_schedule_reasons_for_cancel(schedule_id, volunteer, reason) VALUES ('$schedule_id','$volunteer_id','$reason')";
                 return $this->db->query($sql1)->result();
             }
        }*/
    }

}
