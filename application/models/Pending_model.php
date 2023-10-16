<?php  
class Pending_model extends CI_Model  
{  
    function get_chats(){
        // $this->db->where('language', 'english');        
        $this->db->where('connection_type', 'chat');        
        $this->db->where('chat_opened', 2);
        return $this->db->get('victim')->result();
    }

    function get_chat($id){       
        $this->db->where('case_id', $id);
        $data = $this->db->get('victim')->row();
        $this->db->where('case_id', $id);
        $data1 = $this->db->get('chat_form')->row();
        $getData = (object)array_merge((array)$data,(array)$data1);
        return $getData;
    }

    function get_calls(){       
        $this->db->where('voiceCall_status !=', 0);
        return $this->db->get('wc_conversation_details')->result();
    }

    function get_call($id){       
        $this->db->where('case_id', $id);
        $data = $this->db->get('victim')->row();      
        $this->db->where('case_id', $id);
        $data1 = $this->db->get('wc_conversation_details')->row();
        $this->db->where('case_id', $id);
        $data2 = $this->db->get('chat_form')->row();
        $getData = (object)array_merge((array)$data,(array)$data1,(array)$data2);
        return $getData;
    }

    function get_video_calls(){       
        $this->db->where('videoCall_status !=', 0);
        return $this->db->get('wc_conversation_details')->result();
    }

    function get_video_call($id){       
        $this->db->where('case_id', $id);
        $data = $this->db->get('victim')->row();      
        $this->db->where('case_id', $id);
        $data1 = $this->db->get('wc_conversation_details')->row();
        $this->db->where('case_id', $id);
        $data2 = $this->db->get('chat_form')->row();
        $getData = (object)array_merge((array)$data,(array)$data1,(array)$data2);
        return $getData;
    }

    function get_volunteer_logs(){
        $this->db->order_by('id', 'desc');
        return $this->db->get('vol_onduty_status')->result();
    }

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
         $sql = "SELECT COUNT(wc_vid) AS active_volunteer_count FROM wc_voulnteer WHERE onduty_status=1";
       // print_r($sql);
        return $this->db->query($sql)->row()->active_volunteer_count;
    }

    function get_min_active_volunteer(){
        $this->db->where('id',1);
        $query = $this->db->get('wc_min_active_vol_count')->row();
        return $query->count;
   }

    function get_volunteer(){
        $sql = "SELECT COUNT(wc_vid) AS volunteer_count FROM wc_voulnteer";
      // print_r($sql);
       return $this->db->query($sql)->row()->volunteer_count;
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
    //   print_r($this->db->query($sql)->row()->case_count);die;
       return $this->db->query($sql)->row()->case_count;
    }

    function get_case_report(){
        $sql = "SELECT COUNT(id) AS case_report_count FROM wc_cr_report";
        return $this->db->query($sql)->row()->case_report_count;
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
    
    function get_call_missed(){
        $sql = "SELECT COUNT(connection_type) AS call_missed_count FROM victim WHERE (connection_type = 'call' OR connection_type = 'cellularCall') AND chat_opened = 0";
      // print_r($sql);
       return $this->db->query($sql)->row()->call_missed_count;
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
    
    function get_chat_missed(){
        $sql = "SELECT COUNT(connection_type) AS chat_missed_count FROM victim WHERE connection_type = 'chat' AND chat_opened = 0";
      // print_r($sql);
       return $this->db->query($sql)->row()->chat_missed_count;
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

    function get_case_growth(){        
        $currunt_month = Date('m');
        $currunt_year = Date('Y');
        $last_month = date("m",strtotime("-1 month"));
        $sql = "SELECT COUNT(id) AS current_month_case_count FROM wc_cr_report WHERE YEAR(created_at) = $currunt_year AND MONTH(created_at) = $currunt_month";
        $current_month_case_count = $this->db->query($sql)->row()->current_month_case_count;
        $sql1 = "SELECT COUNT(id) AS last_month_case_count FROM wc_cr_report WHERE YEAR(created_at) = $currunt_year AND MONTH(created_at) = $last_month";
        $last_month_case_count = $this->db->query($sql1)->row()->last_month_case_count;
        if ($last_month_case_count == 0){
            $case_growth = $current_month_case_count - $last_month_case_count;
        }else{
            $case_growth = ((($current_month_case_count - $last_month_case_count)/$last_month_case_count)*100);
        }
        return $case_growth;
    }

    function get_call_missed_growth(){        
        $currunt_month = Date('m');
        $currunt_year = Date('Y');
        $last_month = date("m",strtotime("-1 month"));
        $sql = "SELECT COUNT(connection_type) AS current_month_call_missed_count FROM victim WHERE (connection_type = 'call' OR connection_type = 'cellularCall') AND chat_opened = 0 AND YEAR(created_at) = $currunt_year AND MONTH(created_at) = $currunt_month";
        $current_month_call_missed_count = $this->db->query($sql)->row()->current_month_call_missed_count;
        $sql1 = "SELECT COUNT(connection_type) AS last_month_call_missed_count FROM victim WHERE (connection_type = 'call' OR connection_type = 'cellularCall') AND chat_opened = 0 AND YEAR(created_at) = $currunt_year AND MONTH(created_at) = $last_month";
        $last_month_call_missed_count = $this->db->query($sql1)->row()->last_month_call_missed_count;
        if ($last_month_call_missed_count == 0){
            $call_missed_growth = $current_month_call_missed_count - $last_month_call_missed_count;
        }else{
            $call_missed_growth = ((($current_month_call_missed_count - $last_month_call_missed_count)/$last_month_call_missed_count)*100);
        }
        return $call_missed_growth;
    }

    function get_chat_missed_growth(){        
        $currunt_month = Date('m');
        $currunt_year = Date('Y');
        $last_month = date("m",strtotime("-1 month"));
        $sql = "SELECT COUNT(connection_type) AS current_month_chat_missed_count FROM victim WHERE connection_type = 'chat' AND chat_opened = 0 AND YEAR(created_at) = $currunt_year AND MONTH(created_at) = $currunt_month";
        $current_month_chat_missed_count = $this->db->query($sql)->row()->current_month_chat_missed_count;
        $sql1 = "SELECT COUNT(connection_type) AS last_month_chat_missed_count FROM victim WHERE connection_type = 'chat' AND chat_opened = 0 AND YEAR(created_at) = $currunt_year AND MONTH(created_at) = $last_month";
        $last_month_chat_missed_count = $this->db->query($sql1)->row()->last_month_chat_missed_count;
        if ($last_month_chat_missed_count == 0){
            $chat_missed_growth = $current_month_chat_missed_count - $last_month_chat_missed_count;
        }else{
            $chat_missed_growth = ((($current_month_chat_missed_count - $last_month_chat_missed_count)/$last_month_chat_missed_count)*100);
        }
        return $chat_missed_growth;
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