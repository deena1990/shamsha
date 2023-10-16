<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Check_volunter_schedule_model extends CI_Model {

    function get_data() {
        date_default_timezone_set('Asia/Kuwait');
        $date = Date('Y-m-d');
		//for check whether it is morning or evening
		$hour = date ("G");
		$minute = date ("i");
		$second = date ("s");
		$msg = " Today is " . date ("l, M. d, Y.") . " And the time is " . date ("g:i a");
		
		if ($hour >= 6 && $hour <= 18 && $minute <= 59 && $second <= 59){
			$greet = "Morning";
		}else if ($hour >= 18 && $hour <= 6 && $minute <= 59 && $second <= 59){
			$greet = "Evening";
		}else {
			$greet = "Welcome,";
		}
		
		 $type =  $greet;
		//print_r($type);
		$datenow=date('Y-m-d H:i:s');
      
      	$volunteer_assign = $this->input->post('volunteer_id');

       $sql = "
			select 
					a.w_sch_id, a.schedule_id, a.date, a.volunteer_assign, a.schedule_status, 
					b.shift_name, b.shift_time, b.image, b.shift_language
			from 
				wc_schedule a, 
				wc_shifts b, 
				wc_voulnteer c
			where 
				a.shift_id = b.wcsid 
			AND 
				a.volunteer_assign = c.vounter_id 
			AND 
				'$datenow' BETWEEN a.start_time AND a.end_time 
			AND 
        		a.volunteer_assign='$volunteer_assign'";
       	//print_r($sql);
		/*AND a.date = '$date' */
        $data =  $this->db->query($sql);
		//print_r($data->result());
        return $data->result();
		
    }
    
}
