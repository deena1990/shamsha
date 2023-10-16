<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Vol_cases_model extends CI_Model {

    
    function checkVolExist($vol_id){
        $this->db->where('vounter_id', $vol_id);
        return $this->db->get('wc_voulnteer')->num_rows();
    }

    function get_vol_cases($vol_id){
        $sql='SELECT vc.id as vc_id,vc.case_id,vc.volunteer_id FROM volunteer_cases as vc WHERE vc.volunteer_id="'.$vol_id.'" ORDER BY id DESC';
        // print_r($sql);die;
        $cases = $this->db->query($sql)->result();
        // print_r($cases);die;
        $array_data = array();
        foreach($cases as $val)
        {
            $check_caseid = $this->db->get_where('wc_cr_report',['case_id'=>$val->case_id])->num_rows();
            if($check_caseid==0){
                array_push($array_data,array('case_id'=>$val->case_id));
            }
            
        }
    //    print_r($array_data);die;
        
        $data = array();
        foreach ($array_data as $key => $value) {
            $this->db->where('case_id',$value['case_id']);
            $chat_form = $this->db->get('chat_form')->row();
            $this->db->where('case_id',$value['case_id']);
            $victim = $this->db->get('victim')->row();

            $data[] = [
                'case_id' => $chat_form->case_id,
                'case_language' => strtolower($victim->language),
                'fullname' => $chat_form->screen_name,
                'age' => $chat_form->age,
                'content' => $chat_form->hear_about_us,
                'dateTime' => $chat_form->created_date,
            ];
        }
        // print_r($data);die;
        return $data;
    }

}