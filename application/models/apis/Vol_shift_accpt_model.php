<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vol_shift_accpt_model extends CI_Model {

    function accept_shift() {
        //$dt = date('Y-m-d');
        $date = trim($this->input->post('date'));
        $volunteer_id = trim($this->input->post('volunteer_id'));
        $schedule_id = trim($this->input->post('schedule_id'));

        $sql = "SELECT * FROM wc_schedule WHERE w_sch_id='$schedule_id'";
        //$shift_date = $this->db->query($sql)->row()->date;

        $this->db->where('w_sch_id',$schedule_id);
        $result=$this->db->update('wc_schedule',array('volunteer_assign'=>$volunteer_id, 'schedule_status'=>'Accepted'));

        return $result;

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
