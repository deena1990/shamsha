<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Volunteer_alerts_model extends CI_Model {

    function checkVolunteer(){
        $this->db->where('vounter_id', $this->input->post('volunteer_id'));       
        return $this->db->get('wc_voulnteer')->row();
    }

    function checkVolunteerLoginStatus(){
        $this->db->where('vounter_id', $this->input->post('volunteer_id'));       
        $this->db->where('onduty_status', 1);       
        return $this->db->get('wc_voulnteer')->row();
    }

    function getVolunteerLang(){
        $this->db->where('vounter_id', $this->input->post('volunteer_id'));      
        return $this->db->get('wc_voulnteer')->row()->shift_language;
    }

    function get_en_case_alerts(){
        $this->db->where('language', 'english');        
        $this->db->where('connection_type', 'chat');        
        $this->db->where('chat_opened', 0);
        $this->db->order_by('id' , 'desc');         
        $en_case_alerts = $this->db->get('victim')->result();
        foreach ($en_case_alerts as $key => $value) {
            if($value->case_assign_by!=$this->input->post('volunteer_id')){
                $this->db->where('case_id', $value->case_id);
                $volDetails = $this->db->get('chat_form')->row();
                if($volDetails){
                    $volName = $volDetails->screen_name;
                }else{
                    $volName = "Optional";
                }
                
                $data[] = [
                    'case_id' => $value->case_id,
                    'name' => $volName,
                    'connection_type' => $value->connection_type,
                    'dateTime' => $value->opened_date,
                ];
            }
        }
        return $data;
    }

    function get_ar_case_alerts(){
        $this->db->where('language', 'arabic');        
        $this->db->where('connection_type', 'chat');        
        $this->db->where('chat_opened', 0);
        $this->db->order_by('id' , 'desc');        
        $en_case_alerts = $this->db->get('victim')->result();
        foreach ($en_case_alerts as $key => $value) {
            if($value->case_assign_by!=$this->input->post('volunteer_id')){
                $this->db->where('case_id', $value->case_id);
                $volDetails = $this->db->get('chat_form')->row();
                if($volDetails){
                    $volName = $volDetails->screen_name;
                }else{
                    $volName = "Optional";
                }
                $data[] = [
                    'case_id' => $value->case_id,
                    'name' => $volName,
                    'connection_type' => $value->connection_type,
                    'dateTime' => $value->opened_date,
                ];
            }
        }
        return $data;
    }

    function volResponded($insert){
        date_default_timezone_set('Asia/Kolkata');
        $this->db->insert('volunteer_cases',$insert);
    }

    function victimUpdate(){
        date_default_timezone_set('Asia/Kolkata');
        $this->db->where('case_id', $this->input->post('case_id'));
        $this->db->update('victim', array('chat_opened'=>1,'reported_date'=>date('Y-m-d H:i:s')));
    }

    function checkRespond(){
        $this->db->where('case_id', $this->input->post('case_id'));
        // $this->db->where('volunteer_id', $this->input->post('volunteer_id'));
        return $this->db->get('wc_conversation_details')->num_rows();
    }

    function updateNewVolunteer(){
        $this->db->where('case_id', $this->input->post('case_id'));
        $this->db->update('wc_conversation_details',array('reassign_volunteer_id'=>$this->input->post('volunteer_id')));
    }
    
    function updateVolunteerCases(){
        date_default_timezone_set('Asia/Kolkata');
        $this->db->where('case_id', $this->input->post('case_id'));
        $this->db->update('volunteer_cases',array('volunteer_id'=>$this->input->post('volunteer_id'), 'attened_date'=>date('Y-m-d H:i:s')));
    }

    function checkVictimReqForVideoCall(){
        $this->db->where('case_id',$this->input->post('case_id'));
        $this->db->where('videoCall_status',1);
        return $this->db->get('wc_conversation_details')->num_rows();
    }

    function checkVictimReqForVoiceCall(){
        $this->db->where('case_id',$this->input->post('case_id'));
        $this->db->where('voiceCall_status',1);
        return $this->db->get('wc_conversation_details')->num_rows();
    }
    
    function updateVideoCallStatus(){
        $this->db->where('case_id',$this->input->post('case_id'));
        $this->db->update('wc_conversation_details', array('videoCall_status'=>$this->input->post('action')));
    }

    function updateVoiceCallStatus(){
        $this->db->where('case_id',$this->input->post('case_id'));
        $this->db->update('wc_conversation_details', array('voiceCall_status'=>$this->input->post('action')));
    }

    function getChatWindowAutoResponseMessages(){
        $this->db->where('title','Chat Window');
        $this->db->where('status', 1);
        $data = $this->db->get('wc_messages')->result();
        foreach ($data as $key => $value) {
            if ($this->input->post('language') == "en"){
                $getData[] = [
                    'message' => str_replace("&#39;", "'", str_replace(array("&nbsp;", "\n", "\t", "\r"), " ", strip_tags($value->message_en)))
                ];
            }else if ($this->input->post('language') == "ar"){
                $getData[] = [
                    'message' => str_replace(array("&nbsp;", "\n", "\t", "\r"), " ", strip_tags($value->message_ar))
                ];
            } 
        }
        return $getData;
        
    }

    function get_volunteer($case_id){
        $this->db->where('case_id',$this->input->post('case_id'));
        $this->db->where('videoCall_status',1);
        $volunteer_id = $this->db->get('wc_conversation_details')->row()->volunteer_id;
        $sql = "select * from wc_voulnteer where vounter_id = '$volunteer_id'";
        $data =  $this->db->query($sql);
        return $data->row();
    }

    function check_caseId(){
        $this->db->where('case_id',$this->input->post('case_id'));
        return $this->db->get('wc_conversation_details')->num_rows();
    }

    function get_new_language_volunteer_count($language)
    {
        $sql = "select * from wc_voulnteer where onduty_status = 1 and shift_language = '$language' group by vounter_id";
        $query =$this->db->query($sql);
        return $query->num_rows();
    }

    function get_new_language_volunteer($language,$volunteer_id)
    {
        $sql = "select * from wc_voulnteer where onduty_status = 1 and shift_language = '$language' and not vounter_id = '$volunteer_id' group by vounter_id";
        $query =$this->db->query($sql);
        $row = $query->result();
        // print_r($row);die;
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
        date_default_timezone_set('Asia/Kolkata');
        // print_r($insert);die;
        $this->db->insert('wc_notifications',$insert);
    }

    function updateVictimCaseLangNStatus(){
        date_default_timezone_set('Asia/Kolkata');
        $this->db->where('case_id',$this->input->post('case_id'));
        $this->db->update('victim', array('chat_opened'=>0, 'reported_date'=>null, 'opened_date'=>date('Y-m-d H:i:s'), 'language'=>$this->input->post('new_language'), 'case_assign_by'=>$this->input->post('volunteer_id')));
    }


}
