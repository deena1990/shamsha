<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Member extends CI_Model{
    
    function __construct() {
        // Set table name
        $this->table = 'wc_resources';
    }
    
    /*
     * Fetch wc_resources data from the database
     * @param array filter data based on the passed parameters
     */
    function getRows($params = array()){
        $this->db->select('*');
        $this->db->from($this->table);
        
        if(array_key_exists("where", $params)){
            foreach($params['where'] as $key => $val){
                $this->db->where($key, $val);
            }
        }
        
        if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){
            $result = $this->db->count_all_results();
        }else{
            if(array_key_exists("wcresid", $params)){
                $this->db->where('wcresid', $params['wcresid']);
                $query = $this->db->get();
                $result = $query->row_array();
            }else{
                $this->db->order_by('wcresid', 'desc');
                if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
                    $this->db->limit($params['limit'],$params['start']);
                }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
                    $this->db->limit($params['limit']);
                }
                
                $query = $this->db->get();
                $result = ($query->num_rows() > 0)?$query->result_array():FALSE;
            }
        }
        
        // Return fetched data
        return $result;
    }
    
    /*
     * Insert members data into the database
     * @param $data data to be insert based on the passed parameters
     */
    public function insert($data = array()) {
        if(!empty($data)){
            // Add created and modified date if not included
            // if(!array_key_exists("created", $data)){
            //     $data['created'] = date("Y-m-d H:i:s");
            // }
            // if(!array_key_exists("modified", $data)){
            //     $data['modified'] = date("Y-m-d H:i:s");
            // }
            
            // Insert member data
            $insert = $this->db->insert($this->table, $data);
            
            // Return the status
            return $insert?$this->db->insert_id():false;
        }
        return false;
    }
    
    /*
     * Update member data into the database
     * @param $data array to be update based on the passed parameters
     * @param $condition array filter data
     */
    public function update($data, $condition = array()) {
        if(!empty($data)){
            // Add modified date if not included
            // if(!array_key_exists("modified", $data)){
            //     $data['modified'] = date("Y-m-d H:i:s");
            // }
            
            // Update member data
            $update = $this->db->update($this->table, $data, $condition);
            
            // Return the status
            return $update?true:false;
        }
        return false;
    }

    public function getCatId($category, $locId){
        $this->db->where('category_name', $category);
        $query = $this->db->get('wc_resource_category')->row();
        if (empty($query)){
            $insert = array(
                'loc_id' => $locId,
                'category_name' => $category,
                'category_icon' => 'img.png:::img.png',
                'status' => 'Active',
            );
            $this->db->insert('wc_resource_category',$insert);
            return $this->db->insert_id();
        }else{
            if(in_array($locId, explode(',',$query->loc_id), TRUE)){
                return $query->wcrcid;
            }else{
                $update = array(
                    'loc_id' => $query->loc_id.','.$locId,
                );
                $this->db->update('wc_resource_category',$update, array('category_name' => $category));
                return $query->wcrcid;
            }
        }
    }

    public function getLocId($location){
        $this->db->where('location_name', $location);
        $query = $this->db->get('wc_resource_locations')->row();
        if (empty($query)){
            $insert = array(
                'location_name' => $location,
                'status' => 'Active',
            );
            $this->db->insert('wc_resource_locations',$insert);
            return $this->db->insert_id();
        }else{
            return $query->wcrid;
        }
    }
}