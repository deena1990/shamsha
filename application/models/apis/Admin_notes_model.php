<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_notes_model extends CI_Model {

    function get_data() {
        
        $this->db->select("`type`, `subject_en`, `image`, `image_type`, `content_en`, `date`");
        $this->db->order_by("date", "desc");
        $data = $this->db->get('wc_notes_admin');
        return $data->result();
      
      /* $sql = "SELECT image_type FROM wc_notes_admin ORDER BY wcnid DESC";
      $announcementlist = $this->db->query($sql)->result();
       	 $j=0;
       	 $data = array();
     for($i=0; $i<count($announcementlist);$i++) {
            $img = $announcementlist[$i]->image_type;
            if($img == ''){
            $sql2 = "SELECT `type`, `subject_en`, `content_en`, `date` FROM wc_notes_admin WHERE image_type='$img'  ORDER BY wcnid DESC";
            $data[] = $this->db->query($sql2)->result();
        }else if($img != ''){
           // print_r('hello');
            $sql2 = "SELECT `type`, `subject_en`, `image`, `image_type`, `date` FROM wc_notes_admin WHERE image_type='$img' ORDER BY wcnid DESC";
             $data[] =  $this->db->query($sql2)->result();
        }
}
return $data;
       */
       
    }
    function get_data_by_volunteer($volunteer_id) {
        $data = $this->db->select("`type`, `subject_en`, `image`, `image_type`, `content_en`, `date`")
            ->from('wc_notes_admin n')
            ->join('wc_notes_admin_send_list sl', 'sl.notes_id = n.wcnid')
            ->where('sl.volunteer_id', $volunteer_id)
            ->order_by("wcnid", "desc")
            ->get();

        return $data->result();
    }

    
}
