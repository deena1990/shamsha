<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Volunteer_login_model extends CI_Model {

    function check_user() {
        $email = trim($this->input->post('email'));
        $sql = "SELECT COUNT(wc_vid) as no_of_rows FROM wc_voulnteer WHERE vemail = '$email'";
        return $this->db->query($sql)->row()->no_of_rows;
    }

    function check_volunteer() {
        $this->db->where('vounter_id',$this->input->post('volunteer_id'));
        return $this->db->get('wc_voulnteer')->row();
    }
    
    function check_login_data() {
        
        $this->db->select("wc_vid, vounter_id, vname, vemail, vmobile, date_format(`date_of_birth`, '%D %M %Y') 
        AS dob, date_format(`date_of_joining`, '%D %M %Y') AS doj, profile_pic, gender, shift_language, language_known, address, total_rewards, status, password_login_first");
        $this->db->where('vemail', $this->input->post('email'));
        $this->db->where('vpassword', $this->input->post('password'));
        $data = $this->db->get('wc_voulnteer');
        if($data->num_rows() == 0)  
        {  
                return false;  
        }  
           else  
           {  
            return $data->row();     
           } 
        
    }

    function save_vol_device_info(){
        $deviceid = $this->input->post('deviceid');
        $tokenid = $this->input->post('tokenid');
        $email = $this->input->post('email');
        $dev = $this->input->post('device');
        $sql1 = "SELECT vol_device_id, vol_token_id FROM wc_voulnteer WHERE vemail = '$email'";
        $device = $this->db->query($sql1)->row()->vol_device_id;
        $token = $this->db->query($sql1)->row()->vol_token_id;
       // print_r($token);
        // if($device == '' && $token == ''){
            //echo "nil";
            $sql = "UPDATE wc_voulnteer SET vol_device_id='$deviceid', vol_token_id='$tokenid', device='$dev' WHERE vemail='$email'";
            $this->db->query($sql);
        // }else{
        //     $sql = "UPDATE wc_voulnteer SET device='$dev' WHERE vemail='$email'";
        //     $this->db->query($sql);
        // }
        
        
    }

    function save_log_data(){
        $email = $this->input->post('email');
        $check = "select vounter_id from wc_voulnteer WHERE vemail='$email'";
        $volunteer_id = $this->db->query($check)->row()->vounter_id;
        $ip = $this->input->ip_address();
        $sql = "insert into wc_volunter_logs (volunteer_id, log_ip_addr)
        values ('$volunteer_id', '$ip')";
        $this->db->query($sql);
    }

    function get_user_info(){
        $getData = array();
        $caseCount = $this->db->where('volunteer_id', $this->input->post('volunteer_id'))->get('volunteer_cases')->num_rows();
        $this->db->select("wc_vid, vounter_id, vname, vemail, vmobile, whatsapp, date_format(`date_of_birth`, '%d %M %Y') AS dob, date_format(`date_of_joining`, '%d %M %Y') AS doj, profile_pic, shift_language, language_known, address, residence, total_rewards, passport_r_cpr, status, password_login_first");
        $this->db->where('vounter_id', $this->input->post('volunteer_id'));
        $data = $this->db->get('wc_voulnteer')->row();
        if($caseCount >= 0 && $caseCount <= 20){ $level = "Beginner"; $stars = 1; }
        if($caseCount >= 21 && $caseCount <= 50){ $level = "Intermediate"; $stars = 2; }
        if($caseCount >= 51){ $level = "Advanced"; $stars = 3; }

        $getData = [
            'id' => $data->wc_vid,
            'image' => $data->profile_pic,
            'name' => $data->vname,
            'stars' => $stars,
            'mobile' => $data->vmobile,
            'whatsapp' => $data->whatsapp,
            'email' => $data->vemail,
            'address' => $data->address,
            'country' => $data->residence,
            'volunteer_id' => $data->vounter_id,
            'cpr_passport_number' => $data->passport_r_cpr,
            'case_taken' => $caseCount,
            'level' => $level,
            'primary_language' => $data->shift_language,
            'secondary_language' => $data->language_known,
            'dob' => $data->dob,
            'doj' => $data->doj,
        ];
        return $getData;
    }

    function get_vol_dashboard_info(){
        $volChats = $this->db->where('volunteer_id', $this->input->post('volunteer_id'))->get('volunteer_cases')->result();
        $volChatCount=0;
        foreach ($volChats as $key => $val) {
            $getVolChatCount = $this->db->where(array('case_id' => $val->case_id, 'connection_type' => 'chat'))->get('victim')->num_rows();
            $volChatCount += $getVolChatCount;
        }
        // print_r($volChatCount);die;
        $this->db->where('volunteer_id', $this->input->post('volunteer_id'));
        $caseCount = $this->db->get('volunteer_cases')->num_rows();
        $this->db->select('notes_id');
        $this->db->distinct();
        $this->db->where('volunteer_id', $this->input->post('volunteer_id'));
        $annoCount = $this->db->get('wc_notes_admin_send_list')->num_rows();
        $modName = array();
        $currDate = strtotime(date('Y-m-d'));
        $mod = $this->db->get('manager_on_duty')->result();
        foreach ($mod as $key => $value) {
            $stDate = strtotime($value->start_date);
            $enDate = strtotime($value->end_date);
            if (!($stDate >= $currDate || $enDate <= $currDate)){
                $name = $value->name;
            }else{
                $name = "";
            }
            array_push($modName,$name);
        }
        $modActive = implode('',$modName);
        // $this->db->select("wc_vid, vounter_id, vname, vemail, vmobile, whatsapp, date_format(`date_of_birth`, '%d %M %Y') AS dob, date_format(`date_of_joining`, '%d %M %Y') AS doj, profile_pic, shift_language, language_known, address, total_rewards, passport_r_cpr, status, password_login_first");
        $this->db->where('vounter_id', $this->input->post('volunteer_id'));
        $data = $this->db->get('wc_voulnteer')->row();
        if($caseCount >= 0 && $caseCount <= 20){ $level = "Beginner"; $stars = 1; }
        if($caseCount >= 21 && $caseCount <= 50){ $level = "Intermediate"; $stars = 2; }
        if($caseCount >= 51){ $level = "Advanced"; $stars = 3; }

        $info = [
            'name' => $data->vname,
            'level' => $level,
            'stars' => $stars,
            'image' => base_url().'uploads/'.$data->profile_pic,
            'modName' => $modActive,
            'status' => $data->onduty_status,
            'annoCount' => $annoCount,
            'chatCount' => $volChatCount,
            'caseCount' => $caseCount,
        ];
        return $info;
    }

    function getPreImage(){
        return $this->db->where('vounter_id',$this->input->post('volunteer_id'))->get('wc_voulnteer')->row()->profile_pic;
    }

    function update_user_info($update){
        $this->db->where('vounter_id',$this->input->post('volunteer_id'));
        $this->db->update('wc_voulnteer',$update);
        
    }

    function update_token(){
        if($this->input->post('user_type') == 1){
            $this->db->where('victim_id',$this->input->post('user_id'));
            $this->db->update('wc_victim',array('token_id'=>$this->input->post('token')));
        }else if($this->input->post('user_type') == 2){
            $this->db->where('vounter_id',$this->input->post('user_id'));
            $this->db->update('wc_voulnteer',array('vol_token_id'=>$this->input->post('token')));
        }
    }

    function update_user_picinfo(){
        $volunteer_id = $this->input->post('volunteer_id');
		$imageHasBeenUploaded = false;
        if(!empty($_FILES['profile_pic']['name'])){
            $config['upload_path'] = 'uploads/';
            $config['allowed_types'] = '*';//jpg|jpeg|png|gif
            //$config['max_size'] = 20000;
            //$config['max_width'] = 1500;
            //$config['max_height'] = 1500;
            $config['file_name'] = $_FILES['profile_pic']['name'];
			//echo "File data from request \n";
            //print_r($_FILES);
            //Load upload library and initialize configuration
            $this->load->library('upload',$config);
            $this->upload->initialize($config);
            
            if($this->upload->do_upload('profile_pic')){
                $uploadData = $this->upload->data();
                $picture = $uploadData['file_name'];
				$imageHasBeenUploaded=true;
				//echo "File Uploaded data\n";
				//print_r($uploadData);
            }else{
                $picture = '';
				echo "Error Uploaded failes\n";
				$error = array('error' => $this->upload->display_errors());
  				print_r($error);
            }
            $url = base_url();		      				
            $picture2 = $url.'uploads/'.$picture;
			
        }else{
			echo "Profile_pic is not inserted\n";
            $picture2 = $this->input->post('profile_pic2');
			
        }
        $sql = "UPDATE wc_voulnteer SET `profile_pic`='$picture2' WHERE vounter_id='$volunteer_id'";
        $this->db->query($sql);
		return $imageHasBeenUploaded;
    }

    function send_new_data($password){
        $email = $this->input->post('email');
        $sql = "UPDATE wc_voulnteer SET vpassword='$password', password_login_first='Yes' WHERE vemail='$email'";
        return $this->db->query($sql);
    }

    function volunteer_pin(){
        $deviceid = $this->input->post('deviceid');
        $pin = $this->input->post('pin');
        $volunteer_id = $this->input->post('volunteer_id');
        $sql = "UPDATE wc_voulnteer SET vol_device_id='$deviceid', vpin='$pin' WHERE vounter_id='$volunteer_id'";
        $this->db->query($sql);
    }
    
    function cpassword(){
        $password = $this->input->post('password');
        $vounter_id = $this->input->post('volunter_id');
        $sql = "UPDATE wc_voulnteer SET vpassword='$password', password_login_first='No' WHERE vounter_id='$vounter_id'";
        return $this->db->query($sql);
    }

    function user_single_detail($volunteer_id){
        $this->db->select("*");
        $this->db->where('vounter_id', $this->input->post('volunteer_id'));
        $data = $this->db->get('wc_voulnteer');
        return $data->row();
    }

    function updateShiftStatus($data){
        date_default_timezone_set('Asia/Kuwait');
        $date = date('Y-m-d');
        $dateTime = date('Y-m-d H:i:s');
        $volunteer_assign = $data['volunteer_assign'];
        $status = $data['status'];
        $sql = "select * from wc_schedule where start_time <= '$dateTime' and end_time >= '$dateTime' and volunteer_assign = '$volunteer_assign'";
        $data =  $this->db->query($sql);
        $check =  $data->row();
		//print_r($status);
		//print_r($date);
		//print_r($check);
        if(!empty($check)){
            $this->db->where('volunteer_assign', $volunteer_assign);
           	$this->db->where('start_time <=', $dateTime);
			$this->db->where('end_time >=', $dateTime);
			//$tmp = $this->db->get();
			//print_r($data);
			//foreach ($data->result() as $row){
			//		echo $row->volunteer_assign;	
			//}
			
            if($status == 'CheckIn'){
                //echo "oj"; exit;
				//if(is_null($check->shift_check_in)){
					$this->db->set('shift_check_in', $dateTime);
					$this->db->set('available_status', "Available");
					return $this->db->update('wc_schedule');
				//}
				//return $check;
            }
            if($status == 'CheckOut'){
                $this->db->set('shift_check_out', $dateTime);
                $this->db->set('available_status', "Completed");
				return $this->db->update('wc_schedule');
            }
			
        }
        else{
            return false;
        }
    }
//
    function updateRewards($volunteer_id){
        date_default_timezone_set('Asia/Kuwait');
        $date = Date('Y-m-d');
        $sql = "select ws.w_sch_id,ws.reward_status, wc.shift_language from wc_schedule ws INNER JOIN wc_shifts wc ON ws.shift_id = wc.wcsid where NOW() BETWEEN ws.start_time AND ws.end_time and ws.volunteer_assign = '$volunteer_id'";
        $data =  $this->db->query($sql);
        $check =  $data->row();
        if($check->reward_status == '0'){
            $this->db->where('w_sch_id', $check->w_sch_id);
            $this->db->set('reward_status', 1);
            $this->db->update('wc_schedule');

            $this->db->where('vounter_id', $volunteer_id);
            $this->db->set('total_rewards', 'total_rewards+1', FALSE);
            if($check->shift_language == 'Arabic'){
                $this->db->set('completed_ar_shift', 'completed_ar_shift+1', FALSE);
            }
            if($check->shift_language == 'English'){
                $this->db->set('completed_eng_shift', 'completed_eng_shift+1', FALSE);
            }
            return $this->db->update('wc_voulnteer');
        }
        else{
            return false;
        }
    }

    public function shiftAcceptRequest($volunteer_id){
        date_default_timezone_set('Asia/Kuwait');
        $date = Date('Y-m-d');
        $sql = "select * from wc_schedule  where date = '$date' and volunteer_assign = '$volunteer_id' AND NOW() BETWEEN DATE_SUB(start_time, INTERVAL 10 MINUTE) AND start_time";
        $data =  $this->db->query($sql);
        return $data->row();
    }
    
    public function availabilityUpdate($data){
        date_default_timezone_set('Asia/Kuwait');
        $date = Date('Y-m-d');
        $volunteer_id = $data['volunteer_id'];
        $status = $data['status'];
        $sql = "select ws.w_sch_id,ws.reward_status, wc.shift_language from wc_schedule ws INNER JOIN wc_shifts wc ON ws.shift_id = wc.wcsid where ws.date = '$date' and ws.volunteer_assign = '$volunteer_id'";
        $data =  $this->db->query($sql);
        $check =  $data->row();
       // print_r($check->w_sch_id); exit;
        if(!empty($check)){
             $this->db->where('w_sch_id', $check->w_sch_id);
             $this->db->set('available_status', $status);
            return $this->db->update('wc_schedule');
        }
        else{
            return false;
        }

    }

    public function vol_announces_detail($vol_id){
        $data = array();
        $this->db->select('notes_id');
        $this->db->distinct();
        $this->db->where('volunteer_id', $vol_id);
        $this->db->order_by("notes_id", "desc");
        $notes_ids = $this->db->get('wc_notes_admin_send_list')->result();
        foreach ($notes_ids as $key => $value) {
            $this->db->select('wcnid, subject_en, content_en, created_at');
            $this->db->where('wcnid', $value->notes_id);
            $this->db->where('status', 'Active');
            $announces = $this->db->get('wc_notes_admin')->row();
            $data[] = [
                'announce_id' => $announces->wcnid,
                'subject' => $announces->subject_en,
                'content' => str_replace(array("&nbsp;", "\n", "\t", "\r"), "", strip_tags($announces->content_en)),
                'dateTime' => $announces->created_at,
                'posted_by' => 'admin'
            ];
        }
        return $data;
    }

    public function saveEmailStatus(){
        $this->db->where('id', 1);
        $this->db->update('wc_min_active_vol_count', array('mailed'=>1,'mail_date'=>date('Y-m-d')));
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

    function getMailDate(){
        $this->db->where('id',1);
        $query = $this->db->get('wc_min_active_vol_count')->row();
        return $query->mail_date;
    }

    function updateMailedStatus(){
        $this->db->where('id', 1);
        $this->db->update('wc_min_active_vol_count', array('mailed'=>0));
    }

    function getMailedStatus(){
        $this->db->where('id',1);
        $query = $this->db->get('wc_min_active_vol_count')->row();
        return $query->mailed;
    }
    
}
