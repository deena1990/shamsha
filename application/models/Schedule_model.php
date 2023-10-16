<?php

class Schedule_model extends CI_Model
{

    function get_shift($shift)
    {
        $sql = "SELECT shift_name, shift_time FROM wc_shifts WHERE wcsid = ?";
        $query = $this->db->query($sql, array($shift));
        return $query->result();
    }

    function check_schdedule($dt, $shift_name, $shift_lang)
    {

        $sql = "SELECT COUNT(w_sch_id) as no_of_rows FROM wc_schedule WHERE date = '$dt' AND shift_type='$shift_name' AND shift_lang='$shift_lang'";
        return $this->db->query($sql)->row()->no_of_rows;
    }
//     function add_schdedule($user)
// 	{

// 		$this->db->insert('wc_schedule',$user);
// 	}  
    function add_schdedule_data($year, $shift)
    {
        $N = count($shift);
        // echo $N;
        $d1 = date($year . '-m-d', strtotime('first day of january this year'));
        $date_from = strtotime($d1);
        $d2 = date($year . '-m-d', strtotime('last day of december this year'));
        $date_to = strtotime($d2);

        for ($j = 0; $j < $N; $j++) {
            // echo $shift[$j];
            for ($i = $date_from; $i <= $date_to; $i += 86400) {
                $PRE = date("Y-m-d", $i);
                $checkSql = "select * from wc_schedule where date = '$PRE' and shift_id=$shift[$j]";
                $total = $this->db->query($checkSql)->num_rows();
                if ($total == 0) {
                    $sql = "INSERT INTO wc_schedule (date,shift_id,schedule_status) VALUES('$PRE',$shift[$j],'Active')";
                    //echo $sql;
                    $query = $this->db->query($sql);
                }

            }
        }
    }

    function add_schdedule($year)
    {
        $d1 = date($year . '-m-d', strtotime('first day of january this year'));
        $date_from = strtotime($d1);
        $d2 = date($year . '-m-d', strtotime('last day of december this year'));
        $date_to = strtotime($d2);
        $all_shifts = $this->get_all_shift();
//        echo "<pre>";
//        print_r($date_to); exit;
        while( $date_from <= $date_to ) {
                foreach ($all_shifts as $shift){
                    $PRE = date("Y-m-d", $date_from);
                    $start_date_time = date('Y-m-d H:i:s', strtotime($PRE.' '.$shift->start_time));
                    $end_date_time = date('Y-m-d H:i:s', strtotime($PRE.' '.$shift->end_time));
                    if($shift->end_time == '06:00:00'){
                        $end_date_time = date('Y-m-d H:i:s', strtotime($end_date_time . ' +1 day'));
                    }
                    $shift_id = $shift->wcsid;
                    $checkSql = "select * from wc_schedule where date = '$PRE' and shift_id='$shift_id'";
                    $total = $this->db->query($checkSql)->num_rows();
                    if ($total == 0) {
                        $sql = "INSERT INTO wc_schedule (date,shift_id,schedule_status,start_time,end_time) VALUES('$PRE','$shift_id','Active','$start_date_time','$end_date_time')";
                        //echo $sql;
                        $query = $this->db->query($sql);
                    }
                }
                $date_from = strtotime('+1 day', $date_from);

            }
    }

    function get_all_shift()
    {
        $sql = "SELECT * FROM wc_shifts ";
        $query = $this->db->query($sql);
        return $query->result();
    }


    function get_entries()
    {
        /*$sql = "SELECT a.w_sch_id, a.schedule_id, a.date,
        a.volunteer_assign, a.schedule_status, b.shift_name, b.shift_time, b.image, b.shift_language FROM wc_schedule a LEFT JOIN wc_shifts b ON 
        a.shift_id = b.wcsid";*/
        $sql = "SELECT distinct date FROM wc_schedule ORDER BY date ASC";
        $data = $this->db->query($sql);
        return $data->result();
    }

    function get_entries1($get)
    {
        $events = [];
        if (isset($get['start']) && isset($get['end'])) {
            $start = date("Y-m-d", strtotime($get['start']));
            $end = date("Y-m-d", strtotime($get['end']));
            $date1 = new DateTime($start);
            $date2 = new DateTime($end);
            $days = $date2->diff($date1)->format('%a');
            for ($i = 0; $i <= $days; $i++) {
                $eventdate = date('Y-m-d', strtotime('+' . $i . ' day', strtotime($start)));
                $sql = "SELECT * FROM wc_schedule where date = '$eventdate' and volunteer_assign = ''";

                $data = $this->db->query($sql);
                $result = $data->num_rows();
                if(!empty($get['volunteer_id'])){
                    $sql1 = "SELECT * FROM wc_schedule where date = '$eventdate' and volunteer_assign ='".$get['volunteer_id']."'";

                    $data1 = $this->db->query($sql1);
                    $res = $data1->num_rows();
                    if($res > 0){
                        $class = "yellowCell";
                    }
                    elseif ($result == 0) {
                        $class = "greenCell";
                    } else {
                        $class = "redCell";
                    }
                }
                else{
                    if ($result == 0) {
                        $class = "greenCell";
                    } else {
                        $class = "redCell";
                    }
                }

                $events[] = array(
                    'title' => "Test $i",
                    'start' => $eventdate,
                    'end' => $eventdate,
                    'className' => $class,
                    'rendering' => 'background'
                );
            }
            return $events;
        }
        return $events;
    }

    function getScheduleView($date)
    {

        if (!empty($date)) {
            $sql = "SELECT a.w_sch_id, a.schedule_id, a.date, a.volunteer_assign, a.schedule_status, b.shift_name, b.shift_language, b.color, b.image, b.shift_time, 
c.vname, c.profile_pic FROM wc_schedule a JOIN wc_shifts b ON a.shift_id=b.wcsid LEFT JOIN wc_voulnteer c 
ON a.volunteer_assign = c.vounter_id WHERE a.date='$date' order by b.shift_language desc, b.start_time asc";
            $data = $this->db->query($sql);
            return $data->result();
        } else {
            return [];
        }
    }

    function get_entries_by_date($id)
    {
        /*$sql = "SELECT a.w_sch_id, a.schedule_id, a.date,
        a.volunteer_assign, a.schedule_status, b.shift_name, b.shift_time, b.image, b.shift_language FROM wc_schedule a LEFT JOIN wc_shifts b ON 
        a.shift_id = b.wcsid";*/
        $sql = "SELECT a.w_sch_id, a.schedule_id, a.date, a.volunteer_assign, a.schedule_status, b.shift_name, b.shift_language, b.color, b.image, b.shift_time, 
c.vname, c.profile_pic FROM wc_schedule a JOIN wc_shifts b ON a.shift_id=b.wcsid LEFT JOIN wc_voulnteer c 
ON a.volunteer_assign = c.vounter_id WHERE a.date='$id'";

        $data = $this->db->query($sql);
        return $data->result();
    }

    function delete_entry($id)
    {
        $this->db->delete('wc_schedule', array('w_sch_id' => $id));
    }

    function update_entry($user, $id)
    {
        $this->db->where('w_sch_id', $id);
        $this->db->update('wc_schedule', $user);
    }

    function get($id)
    {
        $sql = "SELECT * FROM wc_schedule WHERE w_sch_id = ?";
        $query = $this->db->query($sql, array($id));
        return $query->result();
    }

    function update_scheduleid_entry($insert_id)
    {
        $RANDOM = 'WCSC0000' . $insert_id;
        $this->db->where('w_sch_id', $insert_id);
        $this->db->update('wc_schedule', array('schedule_id' => $RANDOM, 'schedule_status' => 'Active'));
    }

    function get_volunteers()
    {
        $sql = "SELECT * FROM wc_voulnteer where status='Active'";
        $query = $this->db->query($sql);
        $result = $query->result();

        return $result;
    }

    function get_volunteers_by_language($language)
    {
        $andQry = "";
        if ($language == "Arabic") {
            $andQry = " and shift_language = 'Arabic'";
        }
        $sql = "SELECT * FROM wc_voulnteer where status='Active'" . $andQry;
        //echo $sql; exit;
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }

    function get_volunteers_detail($id){
        $sql = "SELECT * FROM wc_voulnteer where vounter_id='$id'";
        $query = $this->db->query($sql);
        $result = $query->row();
        return $result;
    }

    function get_volunteers_by_filter($filter)
    {
        $andQry = "";
        if ($filter == "Arabic") {
            $andQry = "where shift_language = 'Arabic'";
        }
        if ($filter == "English") {
            $andQry = "where shift_language = 'English'";
        }
        if ($filter == "Active") {
            $andQry = "where status = 'Active'";
        }
        if ($filter == "Inactive") {
            $andQry = "where status = 'Inactive'";
        }
        if ($filter == "On Break") {
            $andQry = "where status = 'On Break'";
        }
        if ($filter == "Left") {
            $andQry = "where status = 'Left'";
        }

        $sql = "SELECT * FROM wc_voulnteer " . $andQry;
        $query = $this->db->query($sql);
        $result = $query->result();

        return $result;
    }

    function get_schedule_by_id($id)
    {
        $sql = "SELECT a.w_sch_id, a.schedule_id, a.date, a.volunteer_assign, a.schedule_status, b.shift_name, b.shift_language, b.color, b.image, b.shift_time, 
c.vname, c.profile_pic FROM wc_schedule a JOIN wc_shifts b ON a.shift_id=b.wcsid LEFT JOIN wc_voulnteer c 
ON a.volunteer_assign = c.vounter_id WHERE a.w_sch_id='$id'";

        $data = $this->db->query($sql);
        return $data->row();
    }

    function admin_shift_assign()
    {
        $volunteer_id = trim($this->input->post('data'));
        $scheduleId = trim($this->input->get('id'));
        if (empty($volunteer_id)) {
            $status = "Active";
        } else {
            $status = "Accepted";
        }
        $sql = "UPDATE wc_schedule SET volunteer_assign='$volunteer_id', schedule_status='$status'  
                WHERE w_sch_id=$scheduleId";

        //echo $sql; exit;
        return $this->db->query($sql);
    }

    function getschedule_by_id(){
        $scheduleId = trim($this->input->get('id'));
        $sql = "SELECT v.vname, v.device, v.vol_token_id, sh.shift_name,sh.shift_time, sh.shift_language,	s.*  FROM wc_schedule as s INNER JOIN wc_voulnteer as v ON v.vounter_id = s.volunteer_assign inner join wc_shifts sh on sh.wcsid = s.shift_id WHERE w_sch_id=$scheduleId";

        return $this->db->query($sql)->row();
    }

    function report($startDate, $endDate){
        $sql = "SELECT 
                SUM(CASE WHEN sh.shift_language ='Arabic' THEN 1 ELSE 0 END) AS arabic, 
                SUM(CASE WHEN sh.shift_language ='English' THEN 1 ELSE 0 END) AS english,
                v.vounter_id, v.vname
                FROM wc_voulnteer v 
                LEFT JOIN wc_schedule sc ON sc.volunteer_assign = v.vounter_id AND sc.schedule_status = 'Accepted' AND sc.date <= NOW() and sc.date BETWEEN '$startDate' AND '$endDate'
                LEFT JOIN wc_shifts sh ON sc.shift_id = sh.wcsid 
                GROUP BY v.vounter_id ORDER BY v.vname ASC";
       // echo $sql; exit;
        return $this->db->query($sql)->result();
    }




}  