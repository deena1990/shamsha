<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cron_model extends CI_Model
{
    public function getTodayShiftVolunteer(){
        date_default_timezone_set('Asia/Kuwait');
        $date = date('Y-m-d');
       $row = $this->db->select('TIMESTAMPDIFF(MINUTE,NOW(),ws.start_time) as timeLeft,s.shift_name, ws.date, s.shift_language, s.shift_time, v.vol_token_id, v.device, v.vname')
            ->from('wc_schedule as ws')
             ->where('ws.date', $date)
             ->where("now() BETWEEN (ws.start_time - INTERVAL 1 HOUR) AND ws.start_time")
            ->join('wc_shifts as s', 'ws.shift_id = s.wcsid', 'INNER')
            ->join('wc_voulnteer as v', 'v.vounter_id = ws.volunteer_assign', "INNER")
            ->get();
        //print_r($this->db->last_query()); exit;
        return $row->result();
    }

    public function getTomorrowShiftVolunteer(){
        date_default_timezone_set('Asia/Kuwait');
        $date = date('Y-m-d', strtotime(' +1 day'));
        $row = $this->db->select('s.shift_name, ws.date, s.shift_language, s.shift_time, v.vol_token_id, v.device, v.vname')
            ->from('wc_schedule as ws')
            ->where('ws.date', $date)
            ->join('wc_shifts as s', 'ws.shift_id = s.wcsid', 'INNER')
            ->join('wc_voulnteer as v', 'v.vounter_id = ws.volunteer_assign', "INNER")
            ->get();
        //print_r($this->db->last_query()); exit;
        return $row->result();
    }
}

?>