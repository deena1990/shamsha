<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Event_registration_model extends CI_Model {

    function upload($user) {
        $this->db->set($user);
        return $this->db->insert('wc_events_registration');
    }

    function getData($id){
        $sql = "SELECT * FROM wc_events_registration WHERE wc_ev_reg_id = $id";
        $query =$this->db->query($sql);
        return $query->row();
    }

    function getEvent($id){
        $sql = "SELECT * FROM wc_events WHERE wceid = $id";
        $query =$this->db->query($sql);
        return $query->row();
    }

    function update_payment($data,$vid){
        $id = $data['isysid'];
        unset($data['isysid']);
        $data['return_hash'] = $data['hash'];
        unset($data['hash']);
        $this->db->where('isysid',$id);
        $update = $this->db->update('wc_payment',$data);
        if($update){
            $data1['transaction_id'] = $id;
            $data1['payment_status'] = $data['result'];
            $data1['payment_date'] = date('Y-m-d H:i:s');
            $this->db->where('id',$vid);
            $update = $this->db->update('wc_events_registration',$data1);
            return "success";
        }
        else{
            return "failure";
        }
    }
 
}
