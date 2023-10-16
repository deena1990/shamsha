<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Vol_chats_model extends CI_Model {

    
    function checkVolExist($vol_id){
        $this->db->where('vounter_id', $vol_id);
        return $this->db->get('wc_voulnteer')->num_rows();
    }

    function get_vol_incoming_chats($vol_id){
        $getData = array();
        $sql = "SELECT * FROM volunteer_cases WHERE volunteer_id = '".$vol_id."' ORDER BY id DESC";
        $cases = $this->db->query($sql)->result();
        foreach ($cases as $key => $value) {            
            $this->db->where('case_id',$value->case_id);
            $conversation_details = $this->db->get('wc_conversation_details');
            if($conversation_details->num_rows()!=0){
                $this->db->where('case_id',$value->case_id);
                $this->db->where('chat_opened',1);
                $victim = $this->db->get('victim');
                if($victim->num_rows()!=0){                    
                    $this->db->where('case_id',$value->case_id);
                    $chat_form = $this->db->get('chat_form')->row();
                    $language = strtolower($victim->row()->language);
                    $getData[] = [
                        'case_id' => $value->case_id,
                        'case_language' => $language,
                        'fullname' => $chat_form->screen_name,
                        'dateTime' => $value->attened_date,
                        'conversation_sid' => $conversation_details->row()->conversation_sid,
                    ];
                }
            }
        }
        return $getData;
    }

    function get_vol_incomings_chats($vol_id){
        $getData = array();
        $sql = "SELECT * FROM wc_conversation_details WHERE volunteer_id = '".$vol_id."' OR reassign_volunteer_id = '".$vol_id."' AND DATE(created_at) = CURDATE() ORDER BY id DESC";
        $cases = $this->db->query($sql)->result();
        foreach ($cases as $key => $value) {
            $this->db->where('case_id',$value->case_id);
            $this->db->where('chat_opened',1);
            $victim = $this->db->get('victim')->row();
            if($victim){
                $this->db->where('case_id',$victim->case_id);
                $chat_form = $this->db->get('chat_form')->row();
                $getData[] = [
                    'case_id' => $victim->case_id,
                    'case_language' => $victim->language,
                    'fullname' => $chat_form->screen_name,
                    'dateTime' => $value->created_at,
                    'conversation_sid' => $value->conversation_sid,
                ];
            } 
        }
        return $getData;
    }

    function get_vol_pasts_chats($vol_id){
        $getData = array();
        $sql = "SELECT * FROM wc_conversation_details WHERE volunteer_id = '".$vol_id."' OR reassign_volunteer_id = '".$vol_id."' ORDER BY id DESC";
        $cases = $this->db->query($sql)->result();
        foreach ($cases as $key => $value) {
            $this->db->where('case_id',$value->case_id);
            $this->db->where('chat_opened',2);
            $victim = $this->db->get('victim')->row();
            if($victim){
                $this->db->where('case_id',$victim->case_id);
                $chat_form = $this->db->get('chat_form')->row();
                $getData[] = [
                    'case_id' => $victim->case_id,
                    'case_language' => $victim->language,
                    'fullname' => $chat_form->screen_name,
                    'dateTime' => $value->created_at,
                    'chat_end_dateTime' => $victim->chat_end_dateTime,
                    'conversation_sid' => $value->conversation_sid,
                ];
            } 
        }
        return $getData;
    }

    function get_vol_past_chats($vol_id){
        $getData = array();
        $sql = "SELECT * FROM volunteer_cases WHERE volunteer_id = '".$vol_id."' ORDER BY attened_date DESC";
        $cases = $this->db->query($sql)->result();
        foreach ($cases as $key => $value) {
            $this->db->where('case_id',$value->case_id);
            $conversation_details = $this->db->get('wc_conversation_details');
            if($conversation_details->num_rows()!=0){
                $this->db->where('case_id',$value->case_id);
                $this->db->where('chat_opened',2);
                $victim = $this->db->get('victim'); 
                if($victim->num_rows()!=0){
                    $this->db->where('case_id',$value->case_id);
                    $chat_form = $this->db->get('chat_form')->row();
                    $language = strtolower($victim->row()->language);
                
                    $getData[] = [
                        'case_id' => $value->case_id,
                        'case_language' => $language,
                        'fullname' => $chat_form->screen_name,
                        'dateTime' => $value->attened_date,
                        'chat_end_dateTime' => $victim->row()->chat_end_dateTime,
                        'conversation_sid' => $conversation_details->row()->conversation_sid,
                    ];
                }
            }
        }
        return $getData;
    }

}