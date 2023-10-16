<?php  
class Dashboard_model extends CI_Model  
{  
    function get_victim(){
        $sql = "SELECT COUNT(wcvtid) AS victim_count,created_at FROM wc_victim";
        return $this->db->query($sql)->row()->victim_count;
    }
    
    function get_graph_start_month(){
        // $graph_start_month = (strtotime(date('Y-m-d',strtotime('- 11 day'))))*1000;
        $graph_start_month = (strtotime(date('Y-m-d',strtotime('- 11 month'))))*1000;
        return $graph_start_month;
    }

    function get_victim_graphValues(){
        for ($i=11;$i>=0;$i--){
            // $currunt_date = date('Y-m-d',strtotime('- '.$i.' day'));
            $currunt_month = date('m',strtotime('- '.$i.' month'));
            $currunt_year = date('Y',strtotime('- '.$i.' month'));
            // $sql = "SELECT COUNT(wcvtid) AS victim_count,created_at FROM wc_victim WHERE cast(created_at as Date) = '$currunt_date'";
            $sql = "SELECT COUNT(wcvtid) AS victim_count,created_at FROM wc_victim WHERE MONTH(created_at) = '$currunt_month' AND YEAR(created_at) = '$currunt_year'";
            $victim_graphValues[] = $this->db->query($sql)->row()->victim_count;
        }
        return $victim_graphValues;
    }
    
    function get_active_volunteer(){
         $sql = "SELECT COUNT(wc_vid) AS active_volunteer_count FROM wc_voulnteer WHERE onduty_status=1 AND status != 'Deleted'";
       // print_r($sql);
        return $this->db->query($sql)->row()->active_volunteer_count;
    }

    function get_min_active_volunteer(){
        $this->db->where('id',1);
        $query = $this->db->get('wc_min_active_vol_count')->row();
        return $query->count;
   }

    function get_volunteer(){
        $sql = "SELECT COUNT(wc_vid) AS volunteer_count FROM wc_voulnteer WHERE status != 'Deleted'";
      // print_r($sql);
    //   print_r($this->db->query($sql)->row()->volunteer_count);die;
       return $this->db->query($sql)->row()->volunteer_count;
   }

   function get_volunteer_growth(){        
       $currunt_month = Date('m');
       $currunt_year = Date('Y');
       $last_month = date("m",strtotime("-1 month"));
       $sql = "SELECT COUNT(wc_vid) AS current_month_volunteer_count FROM wc_voulnteer WHERE YEAR(created_at) = $currunt_year AND MONTH(created_at) = $currunt_month";
       $current_month_volunteer_count = $this->db->query($sql)->row()->current_month_volunteer_count;
       $sql1 = "SELECT COUNT(wc_vid) AS last_month_volunteer_count FROM wc_voulnteer WHERE YEAR(created_at) = $currunt_year AND MONTH(created_at) = $last_month";
       $last_month_volunteer_count = $this->db->query($sql1)->row()->last_month_volunteer_count;
       if ($last_month_volunteer_count == 0){
           $volunteer_growth = $current_month_volunteer_count - $last_month_volunteer_count;
       }else{
           $volunteer_growth = ((($current_month_volunteer_count - $last_month_volunteer_count)/$last_month_volunteer_count)*100);
       }
       return $volunteer_growth;
   }
    
    function get_job(){
         $sql = "SELECT COUNT(wcjid) AS job_count FROM wc_jobs";
       // print_r($sql);
        return $this->db->query($sql)->row()->job_count;
    }
    
    function get_event(){
         $sql = "SELECT COUNT(wceid) AS event_count FROM wc_events";
       // print_r($sql);
        return $this->db->query($sql)->row()->event_count;
    }

    //Deena
    function get_case(){
        $sql = "SELECT COUNT(id) AS case_count FROM victim";
        return $this->db->query($sql)->row()->case_count;
    }

    function get_case_growth(){        
        $currunt_month = Date('m');
        $currunt_year = Date('Y');
        $last_month = date("m",strtotime("-1 month"));
        $sql = "SELECT COUNT(id) AS current_month_case_count FROM victim WHERE YEAR(created_at) = $currunt_year AND MONTH(created_at) = $currunt_month";
        $current_month_case_count = $this->db->query($sql)->row()->current_month_case_count;
        $sql1 = "SELECT COUNT(id) AS last_month_case_count FROM victim WHERE YEAR(created_at) = $currunt_year AND MONTH(created_at) = $last_month";
        $last_month_case_count = $this->db->query($sql1)->row()->last_month_case_count;
        if ($last_month_case_count == 0){
            $case_growth = $current_month_case_count - $last_month_case_count;
        }else{
            $case_growth = ((($current_month_case_count - $last_month_case_count)/$last_month_case_count)*100);
        }
        return $case_growth;
    }

    function get_case_report(){
        $sql = "SELECT COUNT(id) AS case_report_count FROM wc_cr_report";
        return $this->db->query($sql)->row()->case_report_count;
    }

    function get_case_report_growth(){        
        $currunt_month = Date('m');
        $currunt_year = Date('Y');
        $last_month = date("m",strtotime("-1 month"));
        $sql = "SELECT COUNT(id) AS current_month_case_report_count FROM wc_cr_report WHERE YEAR(created_at) = $currunt_year AND MONTH(created_at) = $currunt_month";
        $current_month_case_report_count = $this->db->query($sql)->row()->current_month_case_report_count;
        $sql1 = "SELECT COUNT(id) AS last_month_case_report_count FROM wc_cr_report WHERE YEAR(created_at) = $currunt_year AND MONTH(created_at) = $last_month";
        $last_month_case_report_count = $this->db->query($sql1)->row()->last_month_case_report_count;
        if ($last_month_case_report_count == 0){
            $case_report_growth = $current_month_case_report_count - $last_month_case_report_count;
        }else{
            $case_report_growth = ((($current_month_case_report_count - $last_month_case_report_count)/$last_month_case_report_count)*100);
        }
        return $case_report_growth;
    }

    function get_case_graphValues(){
        for ($i=11;$i>=0;$i--){
            // $currunt_date = date('Y-m-d',strtotime('- '.$i.' day'));
            $currunt_month = date('m',strtotime('- '.$i.' month'));
            $currunt_year = date('Y',strtotime('- '.$i.' month'));
            // $sql = "SELECT COUNT(id) AS case_count,created_at FROM wc_cr_report WHERE cast(created_at as Date) = '$currunt_date'";
            $sql = "SELECT COUNT(id) AS case_count,created_at FROM wc_cr_report WHERE MONTH(created_at) = '$currunt_month' AND YEAR(created_at) = '$currunt_year'";
            $case_graphValues[] = $this->db->query($sql)->row()->case_count;
        }
        return $case_graphValues;
    }

    function get_call(){
        $sql = "SELECT COUNT(voiceCall_status) AS call_count FROM wc_conversation_details WHERE voiceCall_status != 0";
      // print_r($sql);
       return $this->db->query($sql)->row()->call_count;
    }

    function get_call_growth(){        
        $currunt_month = Date('m');
        $currunt_year = Date('Y');
        $last_month = date("m",strtotime("-1 month"));
        $sql = "SELECT COUNT(voiceCall_status) AS current_month_call_count FROM wc_conversation_details WHERE voiceCall_status != 0 AND YEAR(created_at) = $currunt_year AND MONTH(created_at) = $currunt_month";
        $current_month_call_count = $this->db->query($sql)->row()->current_month_call_count;
        $sql1 = "SELECT COUNT(voiceCall_status) AS last_month_call_count FROM wc_conversation_details WHERE  voiceCall_status != 0 AND YEAR(created_at) = $currunt_year AND MONTH(created_at) = $last_month";
        $last_month_call_count = $this->db->query($sql1)->row()->last_month_call_count;
        if ($last_month_call_count == 0){
            $call_growth = $current_month_call_count - $last_month_call_count;
        }else{
            $call_growth = ((($current_month_call_count - $last_month_call_count)/$last_month_call_count)*100);
        }
        return $call_growth;
    }

    function get_video_call(){
        $sql = "SELECT COUNT(videoCall_status) AS video_call_count FROM wc_conversation_details WHERE videoCall_status != 0";
      // print_r($sql);
       return $this->db->query($sql)->row()->video_call_count;
    }

    function get_video_call_growth(){        
        $currunt_month = Date('m');
        $currunt_year = Date('Y');
        $last_month = date("m",strtotime("-1 month"));
        $sql = "SELECT COUNT(videoCall_status) AS current_month_video_call_count FROM wc_conversation_details WHERE videoCall_status != 0 AND YEAR(created_at) = $currunt_year AND MONTH(created_at) = $currunt_month";
        $current_month_video_call_count = $this->db->query($sql)->row()->current_month_video_call_count;
        $sql1 = "SELECT COUNT(videoCall_status) AS last_month_video_call_count FROM wc_conversation_details WHERE  videoCall_status != 0 AND YEAR(created_at) = $currunt_year AND MONTH(created_at) = $last_month";
        $last_month_video_call_count = $this->db->query($sql1)->row()->last_month_video_call_count;
        if ($last_month_video_call_count == 0){
            $video_call_growth = $current_month_video_call_count - $last_month_video_call_count;
        }else{
            $video_call_growth = ((($current_month_video_call_count - $last_month_video_call_count)/$last_month_video_call_count)*100);
        }
        return $video_call_growth;
    }

    function get_call_missed_graphValues(){
        for ($i=11;$i>=0;$i--){
            // $currunt_date = date('Y-m-d',strtotime('- '.$i.' day'));
            $currunt_month = date('m',strtotime('- '.$i.' month'));
            $currunt_year = date('Y',strtotime('- '.$i.' month'));
            // $sql = "SELECT COUNT(connection_type) AS call_missed_count,created_at FROM victim WHERE (connection_type = 'call' OR connection_type = 'cellularCall') AND chat_opened = 0 AND cast(created_at as Date) = '$currunt_date'";
            $sql = "SELECT COUNT(connection_type) AS call_missed_count,created_at FROM victim WHERE (connection_type = 'call' OR connection_type = 'cellularCall') AND chat_opened = 0 AND MONTH(created_at) = '$currunt_month' AND YEAR(created_at) = '$currunt_year'";
            $call_missed_graphValues[] = $this->db->query($sql)->row()->call_missed_count;
        }
        return $call_missed_graphValues;
    }

    function get_call_graphValues(){
        for ($i=11;$i>=0;$i--){
            // $currunt_date = date('Y-m-d',strtotime('- '.$i.' day'));
            $currunt_month = date('m',strtotime('- '.$i.' month'));
            $currunt_year = date('Y',strtotime('- '.$i.' month'));
            // $sql = "SELECT COUNT(connection_type) AS call_missed_count,created_at FROM victim WHERE (connection_type = 'call' OR connection_type = 'cellularCall') AND chat_opened = 0 AND cast(created_at as Date) = '$currunt_date'";
            $sql = "SELECT COUNT(connection_type) AS call_missed_count,created_at FROM victim WHERE (connection_type = 'call' OR connection_type = 'cellularCall') AND chat_opened = 0 AND MONTH(created_at) = '$currunt_month' AND YEAR(created_at) = '$currunt_year'";
            $call_missed_graphValues[] = $this->db->query($sql)->row()->call_missed_count;
        }
        return $call_missed_graphValues;
    }
    
    function get_chat(){
        $sql = "SELECT COUNT(chat_opened) AS chat_count FROM victim WHERE chat_opened = 2";
      // print_r($sql);
       return $this->db->query($sql)->row()->chat_count;
    }

    function get_chat_growth(){        
        $currunt_month = Date('m');
        $currunt_year = Date('Y');
        $last_month = date("m",strtotime("-1 month"));
        $sql = "SELECT COUNT(chat_opened) AS current_month_chat_count FROM victim WHERE chat_opened = 2 AND YEAR(created_at) = $currunt_year AND MONTH(created_at) = $currunt_month";
        $current_month_chat_count = $this->db->query($sql)->row()->current_month_chat_count;
        $sql1 = "SELECT COUNT(chat_opened) AS last_month_chat_count FROM victim WHERE chat_opened = 2 AND YEAR(created_at) = $currunt_year AND MONTH(created_at) = $last_month";
        $last_month_chat_count = $this->db->query($sql1)->row()->last_month_chat_count;
        if ($last_month_chat_count == 0){
            $chat_growth = $current_month_chat_count - $last_month_chat_count;
        }else{
            $chat_growth = ((($current_month_chat_count - $last_month_chat_count)/$last_month_chat_count)*100);
        }
        return $chat_growth;
    }

    function get_chat_missed_graphValues(){
        for ($i=11;$i>=0;$i--){
            // $currunt_date = date('Y-m-d',strtotime('- '.$i.' day'));
            $currunt_month = date('m',strtotime('- '.$i.' month'));
            $currunt_year = date('Y',strtotime('- '.$i.' month'));
            // $sql = "SELECT COUNT(connection_type) AS chat_missed_count,created_at FROM victim WHERE connection_type = 'chat' AND chat_opened = 0 AND cast(created_at as Date) = '$currunt_date'";
            $sql = "SELECT COUNT(connection_type) AS chat_missed_count,created_at FROM victim WHERE connection_type = 'chat' AND chat_opened = 0 AND MONTH(created_at) = '$currunt_month' AND YEAR(created_at) = '$currunt_year'";
            $chat_missed_graphValues[] = $this->db->query($sql)->row()->chat_missed_count;
        }
        return $chat_missed_graphValues;
    }

    function get_victim_growth(){        
        $currunt_month = Date('m');
        $currunt_year = Date('Y');
        $last_month = date("m",strtotime("-1 month"));
        $sql = "SELECT COUNT(wcvtid) AS current_month_victim_count FROM wc_victim WHERE YEAR(created_at) = $currunt_year AND MONTH(created_at) = $currunt_month";
        $current_month_victim_count = $this->db->query($sql)->row()->current_month_victim_count;
        $sql1 = "SELECT COUNT(wcvtid) AS last_month_victim_count FROM wc_victim WHERE YEAR(created_at) = $currunt_year AND MONTH(created_at) = $last_month";
        $last_month_victim_count = $this->db->query($sql1)->row()->last_month_victim_count;
        if ($last_month_victim_count == 0){
            $victim_growth = $current_month_victim_count - $last_month_victim_count;
        }else{
            $victim_growth = ((($current_month_victim_count - $last_month_victim_count)/$last_month_victim_count)*100);
        }
        return $victim_growth;
    }

    function get_job_growth(){        
        $currunt_month = Date('m');
        $currunt_year = Date('Y');
        $last_month = date("m",strtotime("-1 month"));
        $sql = "SELECT COUNT(wcjid) AS current_month_job_count FROM wc_jobs WHERE YEAR(created_at) = $currunt_year AND MONTH(created_at) = $currunt_month";
        $current_month_job_count = $this->db->query($sql)->row()->current_month_job_count;
        $sql1 = "SELECT COUNT(wcjid) AS last_month_job_count FROM wc_jobs WHERE YEAR(created_at) = $currunt_year AND MONTH(created_at) = $last_month";
        $last_month_job_count = $this->db->query($sql1)->row()->last_month_job_count;
        if ($last_month_job_count == 0){
            $job_growth = $current_month_job_count - $last_month_job_count;
        }else{
            $job_growth = ((($current_month_job_count - $last_month_job_count)/$last_month_job_count)*100);
        }
        return $job_growth;
    }

    function get_event_growth(){        
        $currunt_month = Date('m');
        $currunt_year = Date('Y');
        $last_month = date("m",strtotime("-1 month"));
        $sql = "SELECT COUNT(wceid) AS current_month_event_count FROM wc_events WHERE YEAR(created_at) = $currunt_year AND MONTH(created_at) = $currunt_month";
        $current_month_event_count = $this->db->query($sql)->row()->current_month_event_count;
        $sql1 = "SELECT COUNT(wceid) AS last_month_event_count FROM wc_events WHERE YEAR(created_at) = $currunt_year AND MONTH(created_at) = $last_month";
        $last_month_event_count = $this->db->query($sql1)->row()->last_month_event_count;
        if ($last_month_event_count == 0){
            $event_growth = $current_month_event_count - $last_month_event_count;
        }else{
            $event_growth = ((($current_month_event_count - $last_month_event_count)/$last_month_event_count)*100);
        }
        return $event_growth;
    }
    //Deena
    
    function get_today_shift(){
        $date = Date('Y-m-d');
        $sql = "SELECT a.w_sch_id, a.schedule_id, date_format(a.date, '%d %M %Y') AS date, a.volunteer_assign, a.schedule_status, b.shift_name, b.shift_language, b.color, b.image, b.shift_time, 
        c.vname, c.profile_pic FROM wc_schedule a JOIN wc_shifts b ON a.shift_id=b.wcsid LEFT JOIN wc_voulnteer c 
        ON a.volunteer_assign = c.vounter_id WHERE a.date='$date' ORDER BY b.shift_language DESC";
        
        
        //print_r($sql);
        $data = $this->db->query($sql);
        return $data->result();
    }
    
    function get_upcoming_shift(){
        $date1 = date("Y-m-d",strtotime("tomorrow")); 
        //print_r($date);
        // $date = Date('Y-m-d');
        $sql = "SELECT a.w_sch_id, a.schedule_id, date_format(a.date, '%D %M %Y') AS date , a.volunteer_assign, a.schedule_status, b.shift_name, b.shift_language, b.color, b.image, b.shift_time, 
        c.vname, c.profile_pic FROM wc_schedule a JOIN wc_shifts b ON a.shift_id=b.wcsid LEFT JOIN wc_voulnteer c 
        ON a.volunteer_assign = c.vounter_id WHERE a.date='$date1' ORDER BY b.shift_language DESC";
        
        //print_r($sql);
        $data = $this->db->query($sql);
        return $data->result();
    }
	
}  