<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Vol_shift_accpt_model1 extends CI_Model {
    
    
    function check_shift(){
        $dt = Date('Y-m-d');
       $volunteer_id = trim($this->input->post('volunteer_id'));
        $shift_type = trim($this->input->post('schedule_id'));
        $sql = "SELECT COUNT(w_sch_id) as no_of_rows FROM wc_schedule WHERE date > '$dt' AND w_sch_id=$shift_type";
        return $this->db->query($sql)->row()->no_of_rows;
        //print_r($check);
    }
    
    function check_vol_shift(){
        $date = trim($this->input->post('date'));
        $dt = date("Y-m-d", strtotime($date));
        $volunteer_id = trim($this->input->post('volunteer_id'));
        $shift_type = trim($this->input->post('schedule_id'));
        $sql = "SELECT COUNT(w_sch_id) as no_of_rows FROM wc_schedule WHERE date = '$dt' AND volunteer_assign!=''";
        return $this->db->query($sql)->row()->no_of_rows;
    }
    
    function update_vol_shift(){
        $volunteer_id = trim($this->input->post('volunteer_id'));
        $shift_type = trim($this->input->post('schedule_id'));
        $date = trim($this->input->post('date'));
        $dt = date("Y-m-d", strtotime($date));
        
        $sql = "SELECT shift_language FROM wc_voulnteer WHERE vounter_id = '$volunteer_id'";
        $vol_language = $this->db->query($sql)->row()->shift_language;
      //  print_r($vol_language);
        $sql1 = "SELECT b.shift_language FROM wc_schedule a LEFT JOIN wc_shifts b ON a.shift_id = b.wcsid WHERE a.w_sch_id='$shift_type'";
        $sch_language = $this->db->query($sql1)->row()->shift_language;
       // echo $sql1;
      //  print_r($sch_language);
        
        if($vol_language == $sch_language && $vol_language == 'English'){
            //print_r('both english');
              $sql33 = "UPDATE wc_schedule SET volunteer_assign='$volunteer_id', schedule_status='Accepted' 
                WHERE w_sch_id=$shift_type";
                $this->db->query($sql33);
        }else if($vol_language == $sch_language && $vol_language == 'Arabic'){
          //  print_r('either arabic');
              $sql33 = "UPDATE wc_schedule SET volunteer_assign='$volunteer_id', schedule_status='Accepted' 
                WHERE w_sch_id=$shift_type";
                $this->db->query($sql33);
        }else if($sch_language == 'English' && $vol_language == 'Arabic'){
           // print_r('arabic can accept both');
              $sql33 = "UPDATE wc_schedule SET volunteer_assign='$volunteer_id', schedule_status='Accepted' 
                WHERE w_sch_id=$shift_type";
                $this->db->query($sql33);
        }else {
           // print_r('only english');
        }
       
    }
    
    function update_vol_shift_on_empty(){
        $date = trim($this->input->post('date'));
        $dt = date("Y-m-d", strtotime($date));
        $volunteer_id = trim($this->input->post('volunteer_id'));
        $shift_type = trim($this->input->post('schedule_id'));
        $sql = "SELECT COUNT(w_sch_id) as no_of_rows FROM wc_schedule WHERE 
        volunteer_assign = '$volunteer_id' AND date = '$dt' ";
        $count = $this->db->query($sql)->row()->no_of_rows;
        //print_r($count);
        if($count == 0){
            $sql = "SELECT shift_language FROM wc_voulnteer WHERE vounter_id = '$volunteer_id'";
        $vol_language = $this->db->query($sql)->row()->shift_language;
      //  print_r($vol_language);
        $sql11 = "SELECT b.shift_language FROM wc_schedule a LEFT JOIN wc_shifts b ON a.shift_id = b.wcsid WHERE a.w_sch_id='$shift_type'";
        $sch_language = $this->db->query($sql11)->row()->shift_language;
       // echo $sql1;
      //  print_r($sch_language);
        
        if($vol_language == $sch_language && $vol_language == 'English'){
            //print_r('both english');
              $sql33 = "UPDATE wc_schedule SET volunteer_assign='$volunteer_id', schedule_status='Accepted' 
                WHERE w_sch_id=$shift_type";
                $this->db->query($sql33);
        }else if($vol_language == $sch_language && $vol_language == 'Arabic'){
          //  print_r('either arabic');
              $sql33 = "UPDATE wc_schedule SET volunteer_assign='$volunteer_id', schedule_status='Accepted' 
                WHERE w_sch_id=$shift_type";
                $this->db->query($sql33);
        }else if($sch_language == 'English' && $vol_language == 'Arabic'){
           // print_r('arabic can accept both');
              $sql33 = "UPDATE wc_schedule SET volunteer_assign='$volunteer_id', schedule_status='Accepted' 
                WHERE w_sch_id=$shift_type";
                $this->db->query($sql33);
        }else {
            return 0;
        }
        }else{
            return $count;
        }
       
    }
    
    
    /*

    function check_shift_date() {
        $date = trim($this->input->post('date'));
        $dt = date("Y-m-d", strtotime($date));
        $this->db->select("`w_sch_id`, `schedule_id`, `date`, `shift_lang`, `shift_time`, `shift_type`, `volunteer_assign`, `schedule_status`");
        $this->db->where('date', $dt);
        $data = $this->db->get('wc_schedule');
        return $data->result();
    }

    

   

    function update_vol_shift(){
        $date = trim($this->input->post('date'));
        $dt = date("Y-m-d", strtotime($date));
        $volunteer_id = trim($this->input->post('volunteer_id'));
        $shift_type = trim($this->input->post('schedule_id'));
        
        $sql = "UPDATE wc_schedule SET volunteer_assign = '$volunteer_id', schedule_status='Accepted' WHERE w_sch_id='$shift_type'";
        $this->db->query($sql);
        //print_r($sql);
        //die();
    }

    // to update the shift 
  */
    
}
