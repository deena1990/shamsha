<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Victim_model extends CI_Model {

    function create_victim($victim) {
        $this->db->set($victim);
        $this->db->insert('victim');
        $insert_id = $this->db->insert_id();
        $id = 'CI'.str_pad($insert_id, 6, '0', STR_PAD_LEFT);
        $this->db->where('id', $insert_id);
        $this->db->set('case_id', "$id");
        $this->db->update('victim');
        return $id;
    }

    function check_victim($case_id) {
        $this->db->where('case_id',$case_id);
        $result = $this->db->get('victim')->num_rows();
        return $result;
    }
	
	function get_victim_status($case_id) {
        $this->db->where('case_id',$case_id);
        $result = $this->db->get('victim')->result_array();
		//print_r( $result[0]["status"]);
        return $result[0]["status"];
    }

    function update_victim($victim) {
        $this->db->where('case_id', $victim['case_id']);
        $this->db->set($victim);
        $this->db->update('victim');
        return $victim['case_id'];
    }

    function getVolunteer($language){
        date_default_timezone_set('Asia/Kuwait');
        $date = Date('Y-m-d');
        $sql = "select v.*, sc.available_status from wc_schedule sc 
                inner join wc_shifts sh on sc.shift_id = sh.wcsid 
                inner join wc_voulnteer v on v.vounter_id = sc.volunteer_assign 
                where NOW() BETWEEN sc.start_time AND sc.end_time and sh.shift_language = '$language' and sc.schedule_status = 'Accepted' group by v.vounter_id";
        $data =  $this->db->query($sql);
        return $data->result();
    }

    function get_vccvolunteer($language){
        date_default_timezone_set('Asia/Kuwait');
        $date = Date('Y-m-d');
        $sql = "select * from wc_voulnteer where onduty_status = 1 and shift_language = '$language' group by vounter_id";
        $data =  $this->db->query($sql);
        return $data->result();
    }

    function get_volunteer($language)
    {
       $sql = "select * from wc_voulnteer where onduty_status = 1 and shift_language = '$language' group by vounter_id";
        $query =$this->db->query($sql);
        $row = $query->result();
        $volunteerList = [];
        $volunteerList['ios'] = [];
        $volunteerList['ios_user_id'] = [];
        $volunteerList['android'] = [];
        $volunteerList['android_user_id'] = [];
        foreach ($row as $v){
            if(!empty($v->vol_token_id)){
                if(strtolower($v->device) == 'android'){
                    $volunteerList['android'][] = $v->vol_token_id;
                    $volunteerList['android_user_id'][] = $v->vounter_id;
                }
                if(strtolower($v->device) == 'ios'){
                    $volunteerList['ios'][] = $v->vol_token_id;
                    $volunteerList['ios_user_id'][] = $v->vounter_id;
                }
            }
        }
        // echo"<pre>";print_r($volunteerList);die;
        return $volunteerList;
    }

    function insertNotification($insert){
        date_default_timezone_set('Asia/Kuwait');
        // date_default_timezone_set('Asia/Kolkata');
        // print_r($insert);die;
        $this->db->insert('wc_notifications',$insert);
    }

    function get_case_volunteer(){
        $this->db->where('case_id',$this->input->post('case_id'));
        $volunteer_id = $this->db->get('wc_conversation_details')->row()->volunteer_id;
        $sql = "select * from wc_voulnteer where onduty_status = 1 and vounter_id = '$volunteer_id'";
        $query =$this->db->query($sql);
        $row = $query->result();
        $volunteerList = [];
        $volunteerList['ios'] = [];
        $volunteerList['ios_user_id'] = [];
        $volunteerList['android'] = [];
        $volunteerList['android_user_id'] = [];
        foreach ($row as $v){
            if(!empty($v->vol_token_id)){
                if(strtolower($v->device) == 'android'){
                    $volunteerList['android'][] = $v->vol_token_id;
                    $volunteerList['android_user_id'][] = $v->vounter_id;
                }
                if(strtolower($v->device) == 'ios'){
                    $volunteerList['ios'][] = $v->vol_token_id;
                    $volunteerList['ios_user_id'][] = $v->vounter_id;
                }
            }
        }
        // echo"<pre>";print_r($volunteerList);die;
        return $volunteerList;
    }

    function get_case_victim(){
        $case_id = $this->input->post('case_id');
        $sql = "select * from victim where case_id = '$case_id'";
        $query =$this->db->query($sql);
        $row = $query->result();
        $volunteerList = [];
        $volunteerList['ios'] = [];
        $volunteerList['ios_user_id'] = [];
        $volunteerList['android'] = [];
        $volunteerList['android_user_id'] = [];
        foreach ($row as $v){
            if(!empty($v->vol_token_id)){
                if(strtolower($v->device) == 'android'){
                    $volunteerList['android'][] = $v->vol_token_id;
                    $volunteerList['android_user_id'][] = $v->victim_id;
                }
                if(strtolower($v->device) == 'ios'){
                    $volunteerList['ios'][] = $v->vol_token_id;
                    $volunteerList['ios_user_id'][] = $v->victim_id;
                }
            }
        }
        // echo"<pre>";print_r($volunteerList);die;
        return $volunteerList;
    }

    function checkAvailableStatus($language){
        date_default_timezone_set('Asia/Kuwait');
        $date = Date('Y-m-d');
        $sql = "select sc.* from wc_schedule sc 
                inner join wc_shifts sh on sc.shift_id = sh.wcsid 
                where sc.date = '$date' and NOW() BETWEEN sc.start_time AND sc.end_time and sh.shift_language = '$language'";
        $data =  $this->db->query($sql);
        return $data->row();
    }

    function create_chat_form($data) {
        return $this->db->insert('chat_form', $data);
    }

    function get_data() {

        $yday = date('Y-m-d h:i:s', strtotime("-2 day"));
        $this->db->select('
        victim.id as victim_id,
        victim.language,
        victim.status,
		victim.connection_type,
		victim.opened_date,
		victim.reported_date,
		victim.chat_opened,
        chat_form.screen_name,
        chat_form.are_you_in_crisis,
        chat_form.age,
        chat_form.gender,
        chat_form.race_or_ethnicity,
        chat_form.hear_about_us,
		chat_form.safe_to_call,
        victim.case_id,
        created_at as yesterday_date
        ')->from('victim');//
        $this->db->join('chat_form','victim.case_id=chat_form.case_id','LEFT');
        //$this->db->where('victim.status =', '3');
		//$this->db->where('victim.status =', '1');
		//$this->db->or_where('victim.status =', '3');
        //$this->db->where('victim.opened_date >=', $yday); //'CONVERT_TZ(NOW(),'+00:00','+3:00') - INTERVAL 2 DAY'
		//$this->db->where('victim.opened_date !=', NULL);
        $this->db->order_by('victim.id','DESC');
        $records = $this->db->get()->result();
        return $records;
    }


    /*New Functions 10-02-2020*/

   function helpStatusentry($data) {
        $this->db->set($data);
        $this->db->insert('helpvictim');
        $helpvictim = $this->db->insert_id();
        return $helpvictim;
    }

    function helpStatusupdate($id) {
        $this->db->where('id',$id);
        return $this->db->update('helpvictim',array('status'=>'Active'));
		// return $this->db->get('helpvictim');
    }
	
	function helpStatusdelete($id) {
		$sql = "delete from helpvictim where case_id = '$id'";
        $helpvictim = $this->db->query($sql);
        //if(!empty($helpvictim)){
        //    return $this->db->query($sql)->result();
        //}
        
		return $helpvictim;
    }

    function getHelpvolunteer($language){
        $qry = "";
        if(!empty($language)){
            $qry = " and `language_known` LIKE '%$language%' ";
        }
        date_default_timezone_set('Asia/Kuwait');
        $sql = "select * from wc_voulnteer where status = 'Active'".$qry;
        $data =  $this->db->query($sql);
        return $data->result();
    }

    function helpvictimlist(){
		$sql = "SELECT helpvictim.*,victim.connection_type FROM helpvictim LEFT JOIN victim ON helpvictim.case_id = victim.case_id WHERE helpvictim.created_at >= DATE_SUB(NOW(),INTERVAL 1 HOUR) ORDER BY helpvictim.id DESC";
        //$sql = "SELECT * FROM helpvictim WHERE created_at >= DATE_SUB(CONVERT_TZ(NOW(),'+00:00','+3:00'),INTERVAL 1 HOUR) ORDER BY id DESC";
		//$sql = "SELECT * FROM helpvictim ORDER BY id DESC";
        $helpvictim = $this->db->query($sql)->row();
        if(!empty($helpvictim)){
            return $this->db->query($sql)->result();
        }
        return false;
    }

    function language_list(){
        $sql = "SELECT * FROM wc_languages WHERE status='Active' ORDER BY lname ASC";
        $language_list = $this->db->query($sql)->row();
        if(!empty($language_list)){
            return $this->db->query($sql)->result();
        }
        return false;
    }
    
    function language_list1(){
        
         $sql = "select language_known from wc_voulnteer where status = 'Active'";
         $data =  $this->db->query($sql);
         $volLang =  $data->result_array();
		 //print_r($volLang);
		 //exit;
         $lang = array_unique(explode(',',implode(',',array_column($volLang,'language_known'))));
         $imp = "'" . implode( "','", $lang ) . "'";
        //  print_r($imp);
        //  exit;
        $sql = "SELECT * FROM wc_languages WHERE lname IN (" .$imp .") AND status='Active' ORDER BY lname ASC";
        //  print_r($sql);
        //  exit;
        $language_list = $this->db->query($sql)->row();
        if(!empty($language_list)){
            return $this->db->query($sql)->result();
        }
        return false;
    }

    function get_volExistingCases($deviceId){
        $getData = array();
        $this->db->where('device_id',$deviceId);
        $data = $this->db->get('wc_conversation_details')->result();
        foreach ($data as $key => $value) {
            $getData[] = [
                'case_id' => $value->case_id,
                'device_id' => $value->device_id,
                'conversation_sid' => $value->conversation_sid,
                'userIdentity' => $value->user_id,
                'volunteerIdentity' => $value->volunteer_id
            ];
        }
        // print_r($getData);die;
        return $getData;
    }

    function checkCaseExist(){
        $this->db->where('case_id',$this->input->post('case_id'));
        return $this->db->get('victim')->num_rows();
    }

    function getCaseDetails(){
        $this->db->select('victim.*, chat_form.id as chat_id, chat_form.screen_name, chat_form.are_you_in_crisis, chat_form.age, chat_form.gender, chat_form.race_or_ethnicity, chat_form.hear_about_us, chat_form.mobile, chat_form.safe_to_call, chat_form.created_date')
        ->from('victim')
        ->join('chat_form', 'victim.case_id = chat_form.case_id')
        ->where("victim.case_id",$this->input->post('case_id'));
        $result = $this->db->get()->row();
        $getData = [
            'case_id' => $result->case_id,
            'requester' => $result->screen_name,
            'requester_type' => $result->connection_type,
            'language' => $result->language,
            'mobile' => $result->mobile,
            'requested_on' => $result->opened_date,
            'content' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.",
        ];
        return $getData;
    }

    function getVolIdentity(){
        $this->db->where('case_id',$this->input->post('case_id'));
        return $this->db->get('volunteer_cases')->row()->volunteer_id;
    }

    function getAssignVolIdentity(){
        $this->db->where('case_id', $this->input->post('case_id'));
        return $this->db->get('wc_conversation_details')->row()->reassign_volunteer_id;
    }

    function checkCaseId(){
        $this->db->where('case_id',$this->input->post('case_id'));
        return $this->db->get('victim')->num_rows();
    }

    function get_victim_id(){
        $this->db->where('device_id',$this->input->post('device_id'));
        return $this->db->get('wc_victim')->row()->victim_id;
    }

    function checkVolunteerResponded(){
        $this->db->where('case_id',$this->input->post('case_id'));
        return $this->db->get('volunteer_cases')->num_rows();
    }

    function checkAssignVolunteerResponded(){
        $this->db->where('case_id',$this->input->post('case_id'));
        $this->db->where('reassign_number',null);
        return $this->db->get('wc_conversation_details')->num_rows();
    }

    function checkVictimExist(){
        $this->db->where('device_id',$this->input->post('device_id'));
        return $this->db->get('wc_victim')->num_rows();
    }

    function checkConversationCaseId(){
        $this->db->where('case_id',$this->input->post('case_id'));
        return $this->db->get('wc_conversation_details')->num_rows();
    }

    function updateVideoCallStatus($status){
        $callFromInput = $this->input->post('callFrom');
        if ($callFromInput == ""){ $callFrom = 0; }else{ $callFrom = $callFromInput; }
        $this->db->where('case_id',$this->input->post('case_id'));
        return $this->db->update('wc_conversation_details',array('videoCall_status' => $status, 'videoCall_from' => $callFrom));
    }

    function updateVoiceCallStatus($status){
        $callFromInput = $this->input->post('callFrom');
        if ($callFromInput == ""){ $callFrom = 0; }else{ $callFrom = $callFromInput; }
        $this->db->where('case_id',$this->input->post('case_id'));
        return $this->db->update('wc_conversation_details',array('voiceCall_status' => $status, 'voiceCall_from' => $callFrom));
    }

    function getUserNotifications(){
        $this->db->where('user_id', $this->input->post('user_id'));
        $this->db->order_by('id', 'desc');
        return $this->db->get('wc_notifications')->result();
    }
}
