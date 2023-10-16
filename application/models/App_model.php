<?php  
class app_model extends CI_Model  
{    
	function get_event($id){
    	$this->db->where('wceid',$id);
    	$query =$this->db->get('wc_events'); 
        return $query->row();
    }

	function get_media_article($id){
    	$this->db->where('wcmaid',$id);
    	$query =$this->db->get('wc_media_articles'); 
        return $query->row();
    }

	function get_terms_conditions(){
    	$this->db->where('wcp_id',2);
    	$query =$this->db->get('wc_pages'); 
        return $query->row();
    }

	function get_resource_type($cat_id){
		$this->db->where('wcrcid',$cat_id);
    	$query =$this->db->get('wc_resource_category'); 
        return $query->row()->category_name;
	}

	function get_hospital_details($loc_id, $cat_id){
		$this->db->where('res_loc_id',$loc_id);
		$this->db->where('res_res_cat_id',$cat_id);
    	$query =$this->db->get('wc_resources'); 
        return $query->result();
	}
	
}  