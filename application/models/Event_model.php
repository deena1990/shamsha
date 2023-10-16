<?php
class event_model extends CI_Model
{
    function add_event($user)
    {
        $this->db->insert('wc_events',$user);
        //$last_id = mysqli_insert_id();
        //$RANDOM = 'CEO1000'.$last_id;
        //print_r($last_id);
        //die();
        //$this->db->where('ci_user_id',$last_id);
        //$this->db->update('ci_user',array('userid'=>$RANDOM));
    }
    function get_entries()
    {
        $query = $this->db->get('wc_events');
        return $query->result();
    }
    function get_event_images()
    {   
        $data = array();
        $events_images = $this->db->get('wc_events_images')->result();
        foreach ($events_images as $key => $value) {
            $this->db->where('wceid',$value->event_id);
            $eventName = $this->db->get('wc_events')->row()->title_en;
            $data[] = array(  
                            'id' => $value->wceiid,
                            'eventName' => $eventName,
                            'image' => $value->image
                        );
        }
        return $data;
    }
    function get_media_articles()
    {
        $query = $this->db->get('wc_media_articles');
        return $query->result();
    }
    function delete_entry($id)
    {
        $this->db->delete('wc_events', array('wceid' => $id));
    }
    function delete_eventImage($id)
    {
        $this->db->delete('wc_events_images', array('wceiid' => $id));
    }
    function delete_mediaArticles($id)
    {
        $this->db->delete('wc_media_articles', array('wcmaid' => $id));
    }
    function update_entry($user,$id)
    {
        $this->db->where('wceid',$id);
        $this->db->update('wc_events',$user);
    }
    function update_mediaArticle($user,$id)
    {
        $this->db->where('wcmaid',$id);
        $this->db->update('wc_media_articles',$user);
    }
    function add_mediaArticle($user)
    {
        $this->db->insert('wc_media_articles',$user);
    }
    function get($id){
        $sql = "SELECT * FROM wc_events WHERE wceid = ?";
        $query =$this->db->query($sql, array($id));
        return $query->result();
    }
    function get_event($id){
        $sql = "SELECT * FROM wc_events WHERE wceid = $id";
        $query =$this->db->query($sql);
        return $query->row();
    }
    function get_mediaArticle($id){
        $sql = "SELECT * FROM wc_media_articles WHERE wcmaid = ?";
        $query =$this->db->query($sql, array($id));
        return $query->result();
    }


    function get_media_article($id){
        $sql = "SELECT * FROM wc_media_articles WHERE wcmaid = $id";
        $query =$this->db->query($sql);
        return $query->row();
    }


    function get_volunteers(){
        $sql = "SELECT * FROM wc_voulnteer";
        $query =$this->db->query($sql);
        $row = $query->result();
        $volunteerList = [];
        foreach ($row as $v){
            if(!empty($v->vol_token_id)){
                if(strtolower($v->device) == 'android'){
                    $volunteerList['android'][] = $v->vol_token_id;
                }
                if(strtolower($v->device) == 'ios'){
                    $volunteerList['ios'][] = $v->vol_token_id;
                }
            }

        }
        return $volunteerList;
    }
    
        function get_volunteers_language($language){
        $sql = "SELECT * FROM wc_voulnteer";
        if($language == "Arabic"){
           $sql .= " where shift_language = 'Arabic'"; 
        }
        $query =$this->db->query($sql);
        $row = $query->result();
        $volunteerList = [];
        foreach ($row as $v){
            if(!empty($v->vol_token_id)){
                if(strtolower($v->device) == 'android'){
                    $volunteerList['android'][] = $v->vol_token_id;
                }
                if(strtolower($v->device) == 'ios'){
                    $volunteerList['ios'][] = $v->vol_token_id;
                }
            }

        }
        return $volunteerList;
    }

    function get_registration($id){
        $sql = "SELECT * FROM wc_events_registration where event_id = '$id' and status = 'Active'";
        $query =$this->db->query($sql);
        $row = $query->result();
        return $row;
    }

    function multiple_images($image = array()){
        return $this->db->insert_batch('wc_events_images',$image);
    }

}  