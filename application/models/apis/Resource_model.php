<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Resource_model extends CI_Model {

    function get_loc_data() {
        // $this->db->select("wcrid, location_name, location_name_ar");
        $this->db->where('status','Active');
        $data = $this->db->get('wc_resource_locations');
        return $data->result();
    }
    function get_cat_data() {
        $location = $this->input->post('location');
        
       // $sql = "SELECT wcrcid, category_name, category_icon  FROM `wc_resource_category` WHERE `loc_id` LIKE '%$location%' ORDER BY `loc_id` ASC";
        
        $sql = "SELECT T1.wcrcid, T1.category_name, T1.category_name_ar, T1.category_icon, T2.location_name, T2.location_name_ar, T2.wcrid FROM wc_resource_category T1, 
        wc_resource_locations T2 WHERE T2.wcrid='$location'"; 
        
       /* $sql = "SELECT T1.wcrcid, T1.category_name, T1.loc_id, T1.category_icon, T2.location_name, T2.wcrid FROM wc_resource_category T1, 
        wc_resource_locations T2 WHERE T1.loc_id LIKE '%$location%'";  */
       // print_r($sql);
        $data =  $this->db->query($sql);
        return $data->result();
    }
    function get_ccat_data() {
        $location = $this->input->post('location');
        
        $sql = "SELECT wcrcid, category_name, category_icon  FROM `wc_resource_category` WHERE `loc_id` LIKE '%$location%' ORDER BY `loc_id` ASC";
        
      
       /* $sql = "SELECT T1.wcrcid, T1.category_name, T1.loc_id, T1.category_icon, T2.location_name, T2.wcrid FROM wc_resource_category T1, 
        wc_resource_locations T2 WHERE T1.loc_id LIKE '%$location%'";  */
       // print_r($sql);
        $data =  $this->db->query($sql);
        return $data->result();
    }
    function get_data(){
        $location = $this->input->post('location');
        $category = $this->input->post('category');
        $sql = "SELECT * FROM wc_resources WHERE res_loc_id='$location' AND res_res_cat_id='$category' and status = 'Active'";
      // $sql = "SELECT content FROM wc_resources WHERE res_loc_id=$location AND res_res_cat_id=$category";
       // print_r($sql);
       
        $data=  $this->db->query($sql);
      return $data->result();
    }
    
}
