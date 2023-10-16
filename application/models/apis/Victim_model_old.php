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

    function update_victim($victim) {
        $this->db->where('id', $victim['case_id']);
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
        //$this->db->where('victim.status =', '1');
        $this->db->where('victim.opened_date >=', $yday); //'NOW() - INTERVAL 2 DAY'
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
        $this->db->update('helpvictim',array('status'=>'Active'));
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
        $sql = "SELECT * FROM helpvictim WHERE created_at >= DATE_SUB(NOW(),INTERVAL 1 HOUR) ORDER BY id DESC";
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
}
