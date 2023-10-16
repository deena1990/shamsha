<?php
class Notification_model extends CI_Model{

    public function getNotifications(){
        $this->db->order_by('id', 'desc');
        return $this->db->get('wc_notifications')->result();
    }
    
}