<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Conversation_model extends CI_Model {

    function checkCaseExist(){
        $this->db->where('case_id',$this->input->post('case_id'));
        return $this->db->get('volunteer_cases')->num_rows();
    }

    function saveConversationDetails(){
        $checkcaseid = $this->db->get_where('wc_conversation_details',['case_id'=>$this->input->post('case_id')])->num_rows();
        if($checkcaseid == 0){
            $details = array(
                'case_id' => $this->input->post('case_id'),
                'device_id' => $this->input->post('device_id'),
                'conversation_sid' => $this->input->post('conversation_sid'),
                'user_id' => $this->input->post('userIdentity'),
                'volunteer_id' => $this->input->post('volunteerIdentity'),
            );
            $this->db->insert('wc_conversation_details',$details);
        }else{
            $details = array(
                'reassign_volunteer_id'=>$this->input->post('volunteerIdentity')
            );
            $this->db->where('case_id',$this->input->post('case_id'));
            $this->db->update('wc_conversation_details',$details);
        }
        
    }

    function addVolunteer(){
        $this->db->where('case_id',$this->input->post('case_id'));
        $this->db->update('wc_conversation_details',array('volunteer_id' => $this->input->post('volunteer_id')));
    }

    function checkConversationCreated(){
        $this->db->where('case_id',$this->input->post('case_id'));
        //$this->db->where('reassign_number',null);
        // $this->db->where('reassign_volunteer_id',null);
        return $this->db->get('wc_conversation_details')->num_rows();
    }

    function checkConversationUpdated(){
        $this->db->where('case_id',$this->input->post('case_id'));
        $this->db->where('reassign_volunteer_id',null);
        return $this->db->get('wc_conversation_details')->num_rows();
    }

    function getConversationSid(){
        $this->db->where('case_id',$this->input->post('case_id'));
        return $this->db->get('wc_conversation_details')->row()->conversation_sid;
    }

    function victimUpdate(){
        date_default_timezone_set('Asia/Kuwait');
        // date_default_timezone_set('Asia/Kolkata');
        // print_r(date('Y-m-d H:i:s'));die;
        $this->db->where('case_id', $this->input->post('case_id'));
        $this->db->update('victim', array('chat_opened'=>2, 'chat_end_dateTime'=>date('Y-m-d H:i:s')));
    }

    function get_case_victim(){
        $case_id = $this->input->post('case_id');
        $sql = "select * from victim join wc_conversation_details on victim.case_id=wc_conversation_details.case_id where victim.case_id = '$case_id'";
        $query =$this->db->query($sql);
        $row = $query->result();
        // print_r($row[0]->user_id);die;
        $volunteerList = [];
        $volunteerList['ios'] = [];
        $volunteerList['ios_user_id'] = [];
        $volunteerList['android'] = [];
        $volunteerList['android_user_id'] = [];
        foreach ($row as $v){
            if(!empty($v->fcm_token)){
                if(strtolower($v->device_type) == 'android'){
                    $volunteerList['android'][] = $v->fcm_token;
                    $volunteerList['android_user_id'][] = $v->user_id;
                }
                if(strtolower($v->device_type) == 'ios'){
                    $volunteerList['ios'][] = $v->fcm_token;
                    $volunteerList['ios_user_id'][] = $v->user_id;
                }
            }
        }
        // echo"<pre>";print_r($volunteerList);die;
        return $volunteerList;
    }

    function get_volunteer($volunteer_id){
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

    function insertNotification($insert){
        date_default_timezone_set('Asia/Kuwait');
        // date_default_timezone_set('Asia/Kolkata');
        // print_r($insert);die;
        $this->db->insert('wc_notifications',$insert);
    }

}