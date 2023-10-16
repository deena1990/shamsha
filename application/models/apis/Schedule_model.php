<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Schedule_model extends CI_Model {

    function get_data() {
        $sql =  "SELECT a.w_sch_id, a.schedule_id, a.date, 
        a.volunteer_assign, a.schedule_status, b.shift_name, b.shift_time, b.image, b.shift_language FROM wc_schedule a LEFT JOIN wc_shifts b ON 
        a.shift_id = b.wcsid";

        $data = $this->db->query($sql);
        return $data->result();
    }

    function get_volun_schedule_data(){
        $vol = $this->input->post('volunteer_id');
        $month = $this->input->post('month');

        /*  $sql = "SELECT a.w_sch_id, a.schedule_id, a.date,
          a.volunteer_assign, a.schedule_status, b.shift_name, b.shift_time, b.image, b.shift_language FROM wc_schedule a LEFT JOIN wc_shifts b ON
          a.shift_id = b.wcsid WHERE volunteer_assign='$vol' AND
          MONTH(date) = MONTH(CURRENT_DATE()) AND YEAR(date) = YEAR(CURRENT_DATE())";*/

        $sql = "SELECT a.w_sch_id, a.schedule_id, a.date, a.volunteer_assign, a.schedule_status, b.shift_name, b.shift_language, b.color, b.image, b.shift_time, 
c.vname, c.profile_pic FROM wc_schedule a JOIN wc_shifts b ON a.shift_id=b.wcsid LEFT JOIN wc_voulnteer c 
ON a.volunteer_assign = c.vounter_id WHERE MONTH(a.date) = Month('$month') AND volunteer_assign='$vol' ORDER BY a.date ASC";

        //print_r($sql);
        $data = $this->db->query($sql);
        return $data->result();
    }

    function get_schedule_data_openshift_onmonth(){
        $month = $this->input->post('month');
        $sql = "SELECT a.w_sch_id, a.schedule_id, a.date, a.volunteer_assign, a.schedule_status, b.shift_name, b.shift_language, b.color, b.image, b.shift_time, 
c.vname, c.profile_pic FROM wc_schedule a JOIN wc_shifts b ON a.shift_id=b.wcsid LEFT JOIN wc_voulnteer c 
ON a.volunteer_assign = c.vounter_id WHERE MONTH(a.date) = MONTH('$month') ORDER BY a.date ASC";

        $data = $this->db->query($sql);
        return $data->result();

        /* $sql = "select date from wc_schedule WHERE MONTH(date) = MONTH('$month') group by date ORDER BY date ASC";

         $data = $this->db->query($sql);
         $data1 = array();
         foreach($data->result() as $row){
            $sql1 = "SELECT a.w_sch_id, a.schedule_id, a.date, a.volunteer_assign, a.schedule_status, b.shift_name, b.shift_language, b.color, b.image, b.shift_time,
 c.vname, c.profile_pic FROM wc_schedule a JOIN wc_shifts b ON a.shift_id=b.wcsid LEFT JOIN wc_voulnteer c
 ON a.volunteer_assign = c.vounter_id WHERE a.date='$row->date' ORDER BY b.shift_language DESC, b.shift_time";
 //echo $sql1;
             $data1[$row->date] = $this->db->query($sql1)->result();
         }
         return $data1;*/
    }

    function get_volun_upcoming_schedule_data(){
        $vol = $this->input->post('volunteer_id');
        $date = date('Y-m-d');
        // echo $date;
//         $sql = "select a.w_sch_id, a.schedule_id, a.date,
//         a.volunteer_assign, a.schedule_status, b.shift_name, b.shift_time, b.image, b.shift_language, c.vname, c.profile_pic
// from wc_schedule a, wc_shifts b, wc_voulnteer c
// where a.shift_id = b.wcsid  AND a.volunteer_assign = c.vounter_id AND a.volunteer_assign='$vol' AND MONTH(a.date) = MONTH(CURRENT_DATE())
// AND YEAR(a.date) = YEAR(CURRENT_DATE())
//         ORDER BY a.w_sch_id ASC LIMIT 1";
        $sql = "select a.w_sch_id, a.schedule_id, a.date, 
        a.volunteer_assign, a.schedule_status, b.shift_name, b.shift_time, b.image, b.shift_language, b.color, c.vname, c.profile_pic
from wc_schedule a, wc_shifts b, wc_voulnteer c
where a.shift_id = b.wcsid  AND a.volunteer_assign = c.vounter_id AND a.volunteer_assign='$vol' AND a.date > CURDATE()
        ORDER BY a.w_sch_id ASC LIMIT 1";
        //print_r($sql);
        $data = $this->db->query($sql);
        return $data->result();
    }

    function upcoming_openschedule_list(){
        $date = $this->input->post('date');
        $language = strtolower($this->input->post('language'));
        $andWhere = '';

        if($language == "english" || $language == "arabic"){
            $andWhere .= " AND b.shift_language = '$language'";
        }
        $sql = "select date from wc_schedule WHERE date>='$date' group by date ORDER BY date ASC";

        /* $sql = "select a.w_sch_id, a.schedule_id, a.date,
         a.volunteer_assign, a.schedule_status, b.shift_name, b.shift_time, b.color, b.image, b.shift_language, c.vname, c.profile_pic
 from wc_schedule a, wc_shifts b, wc_voulnteer c
 where a.shift_id = b.wcsid  AND  a.volunteer_assign = c.vounter_id  AND a.date>='$date' ORDER BY a.date ASC";*/
        //print_r($sql);
        $data = $this->db->query($sql);
        $data1 = array();
        foreach($data->result() as $row){
            // $sql1 = "select * from wc_schedule WHERE date='$date'  ORDER BY date ASC";
            $sql1 = "SELECT a.w_sch_id, a.schedule_id, a.date, a.volunteer_assign, a.schedule_status, b.shift_name, b.shift_language, b.color, b.image, b.shift_time, 
c.vname, c.profile_pic FROM wc_schedule a JOIN wc_shifts b ON a.shift_id=b.wcsid LEFT JOIN wc_voulnteer c 
ON a.volunteer_assign = c.vounter_id WHERE a.date='$row->date' $andWhere ORDER BY b.shift_language DESC, b.shift_time";
//echo $sql1;
            $data1[$row->date] = $this->db->query($sql1)->result();
        }
        return $data1;



    }

    function upcoming_openschedule_list_ios(){
        $date = $this->input->post('date');
        $shift = strtolower($this->input->post('shift'));
        $language = strtolower($this->input->post('language'));
        $andWhere = '';
        if($shift == "evening shift" || $shift == "morning shift"){
            $andWhere .= " AND b.shift_name = '$shift'";
        }
        if($language == "english" || $language == "arabic"){
            $andWhere .= " AND b.shift_language = '$language'";
        }
        $sql = "select date from wc_schedule WHERE date>='$date' group by date ORDER BY date ASC";

        /* $sql = "select a.w_sch_id, a.schedule_id, a.date,
         a.volunteer_assign, a.schedule_status, b.shift_name, b.shift_time, b.color, b.image, b.shift_language, c.vname, c.profile_pic
 from wc_schedule a, wc_shifts b, wc_voulnteer c
 where a.shift_id = b.wcsid  AND  a.volunteer_assign = c.vounter_id  AND a.date>='$date' ORDER BY a.date ASC";*/
        //print_r($sql);
        $data = $this->db->query($sql);
        $data1 = array();
        $i = 0;
        foreach($data->result() as $row){
            // $sql1 = "select * from wc_schedule WHERE date='$date'  ORDER BY date ASC";
            $sql1 = "SELECT a.w_sch_id, a.schedule_id, a.date, a.volunteer_assign, a.schedule_status, b.shift_name, b.shift_language, b.color, b.image, b.shift_time, 
c.vname, c.profile_pic FROM wc_schedule a JOIN wc_shifts b ON a.shift_id=b.wcsid LEFT JOIN wc_voulnteer c 
ON a.volunteer_assign = c.vounter_id WHERE a.date='$row->date' $andWhere ORDER BY b.shift_language DESC, b.shift_time";
//echo $sql1;

            $data1[$i]['date'] = $row->date;
            $data1[$i]['result'] = $this->db->query($sql1)->result();
            $i++;
        }
        return $data1;



    }

    function upcoming_openschedule_shiftlist(){
        $date = $this->input->post('date');
        $shift = $this->input->post('shift');
        $language = strtolower($this->input->post('language'));
        $andWhere = '';

        if($language == "english" || $language == "arabic"){
            $andWhere .= " AND b.shift_language = '$language'";
        }

        $sql = "select date from wc_schedule WHERE date>='$date' group by date ORDER BY date ASC";

        /* $sql = "select a.w_sch_id, a.schedule_id, a.date,
         a.volunteer_assign, a.schedule_status, b.shift_name, b.shift_time, b.color, b.image, b.shift_language, c.vname, c.profile_pic
 from wc_schedule a, wc_shifts b, wc_voulnteer c
 where a.shift_id = b.wcsid  AND  a.volunteer_assign = c.vounter_id  AND a.date>='$date' ORDER BY a.date ASC";*/
        //print_r($sql);
        $data = $this->db->query($sql);
        $data1 = array();
        foreach($data->result() as $row){
            // $sql1 = "select * from wc_schedule WHERE date='$date'  ORDER BY date ASC";
            $sql1 = "SELECT a.w_sch_id, a.schedule_id, a.date, a.volunteer_assign, a.schedule_status, b.shift_name, b.shift_language, b.color, b.image, b.shift_time, 
c.vname, c.profile_pic FROM wc_schedule a JOIN wc_shifts b ON a.shift_id=b.wcsid LEFT JOIN wc_voulnteer c 
ON a.volunteer_assign = c.vounter_id WHERE a.date='$row->date' AND b.shift_name='$shift' $andWhere ORDER BY date ASC";
            $data1[$row->date] = $this->db->query($sql1)->result();
        }
        return $data1;



    }



    function upcoming_oopenschedule_list($result){
        $N = count($result);
        for($i=0; $i<=$N; $i++){
            print_r($result[$i]);
            $sql = "select a.w_sch_id, 
        a.volunteer_assign, a.schedule_status, b.shift_name, b.shift_time, b.color, b.image, b.shift_language, c.vname, c.profile_pic
from wc_schedule a, wc_shifts b, wc_voulnteer c
where a.shift_id = b.wcsid  AND  a.volunteer_assign = c.vounter_id  AND a.date='$result[$i]'";
            $data = $this->db->query($sql);
        }
        return $data->result();

    }


    function upcoming_schedule_list(){
        $sql = "select a.w_sch_id, a.schedule_id, a.date, 
        a.volunteer_assign, a.schedule_status, b.shift_name, b.shift_time, b.image, b.color, b.shift_language, c.vname, c.profile_pic
from wc_schedule a, wc_shifts b, wc_voulnteer c
where a.shift_id = b.wcsid  AND a.volunteer_assign = c.vounter_id AND a.date > CURDATE() 
        ORDER BY a.date ASC";

        //print_r($sql);
        $data = $this->db->query($sql);
        return $data->result();
    }

    function get_volun_upcoming_schedule_list_data(){
        $vol = $this->input->post('volunteer_id');

        $sql = "select a.w_sch_id, a.schedule_id, a.date, 
        a.volunteer_assign, a.schedule_status, b.shift_name, b.shift_time, b.image, b.color, b.shift_language, c.vname, c.profile_pic
from wc_schedule a, wc_shifts b, wc_voulnteer c
where a.shift_id = b.wcsid  AND a.volunteer_assign = c.vounter_id AND a.volunteer_assign='$vol' AND a.date > CURDATE() 
        ORDER BY a.date ASC";
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
        $sql = "select a.w_sch_id, a.schedule_id, a.date, 
        a.volunteer_assign, a.schedule_status, b.shift_name, b.shift_time, b.image, b.shift_language, c.vname, c.profile_pic
from wc_schedule a, wc_shifts b, wc_voulnteer c
where a.shift_id = b.wcsid  AND a.volunteer_assign = c.vounter_id AND a.volunteer_assign='$volunteer_id' 
AND Year(a.date) = Year(CURRENT_DATE())";
        //  print_r($sql);
        $data = $this->db->query($sql);
        return $data->result();

    }
    function get_shiftdata_ondate(){
        $date = $this->input->post('date');

        /* $sql = "select a.w_sch_id, a.schedule_id, a.date,
         a.volunteer_assign, a.schedule_status, b.shift_name, b.shift_time, b.image, b.shift_language
 from wc_schedule a, wc_shifts b
 where a.shift_id = b.wcsid AND a.date = '$date'";*/

        $sql = "SELECT a.w_sch_id, a.schedule_id, a.date, a.volunteer_assign, a.schedule_status, b.shift_name, b.shift_language, b.color, b.image, b.shift_time, 
c.vname, c.profile_pic FROM wc_schedule a JOIN wc_shifts b ON a.shift_id=b.wcsid LEFT JOIN wc_voulnteer c 
ON a.volunteer_assign = c.vounter_id WHERE a.date='$date' ORDER BY b.shift_language DESC, b.shift_time asc";

        //print_r($sql);
        $data = $this->db->query($sql);
        return $data->result();
    }


    function get_schedule_data_oncurmonth(){



        $sql = "SELECT w_sch_id, schedule_id, date, shift_type, shift_time, shift_lang, 
        volunteer_assign, schedule_status FROM `wc_schedule` WHERE MONTH(date) = MONTH(CURRENT_DATE())";
        //print_r($sql);
        $data = $this->db->query($sql);
        return $data->result();

    }

    function get_schedule_data_onmonth(){
        $month = $this->input->post('month');

        $sql = "SELECT a.w_sch_id, a.schedule_id, a.date, a.volunteer_assign, a.schedule_status, b.shift_name, b.shift_language, b.color, b.image, b.shift_time, 
c.vname, c.profile_pic FROM wc_schedule a JOIN wc_shifts b ON a.shift_id=b.wcsid LEFT JOIN wc_voulnteer c 
ON a.volunteer_assign = c.vounter_id WHERE MONTH(a.date) = MONTH('$month') ORDER BY a.date ASC";
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
        $sql =  "select a.w_sch_id, a.schedule_id, a.date, 
        a.volunteer_assign, a.schedule_status, b.shift_name, b.shift_time, b.image, b.shift_language
from wc_schedule a, wc_shifts b
where a.shift_id = b.wcsid  AND a.volunteer_assign='' AND Year(a.date) = Year(CURRENT_DATE())";

        //print($sql);

        $data = $this->db->query($sql);
        return $data->result();

    }
    
    function get_timer($volunteer){
        date_default_timezone_set('Asia/Kuwait');
        $sql = "SELECT start_time FROM `wc_schedule` WHERE NOW() BETWEEN (start_time - interval 30 minute) and start_time and volunteer_assign = '$volunteer'";
       // print_r($sql); exit;
        $data = $this->db->query($sql);
        return $data->row();
    }

}
