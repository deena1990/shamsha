<?php  
class announcement_model extends CI_Model  
{  
    function add_announcement($user)
	{
    	$this->db->insert('wc_notes_admin',$user);
    	//$last_id = mysqli_insert_id();
    	//$RANDOM = 'CEO1000'.$last_id;
    	//print_r($last_id);
    	//die();
    	//$this->db->where('ci_user_id',$last_id);
   		//$this->db->update('ci_user',array('userid'=>$RANDOM));
	}   

    function add_vol_announcement($user)
	{
    	$this->db->insert('wc_notes_volunteer',$user);
	}

    function get_vol_announce_details($id)
    {
       $vol_announce_details = $this->db->query("select * from wc_notes_volunteer where wcnvid='$id'")->row();
    //    echo"<pre>";print_r($vol_announce_details);die;
       return $vol_announce_details;
    }

    function get_announcement_details($id)
    {
       $announcement_details = $this->db->query("select * from wc_notes_admin where wcnid='$id'")->row();
    //    echo"<pre>";print_r($announcement_details);die;
       return $announcement_details;
    }

    function change_vol_announce_status($id){
        $this->db->query("update wc_notes_volunteer set status='Active' where wcnvid='$id'");
    }

    function get_role_name($session_id){
        $user_role=$this->db->query("select * from roles_users where user_id='$session_id'")->row();
        $role = $this->db->query("select * from roles where id='$user_role->role_id'")->row();
        return $role->name;
    }
	function get_entries()
	{
        $this->db->order_by('wcnid', 'desc');
		$query = $this->db->get('wc_notes_admin');
  		return $query->result();
    }
    function get_vol_entries()
	{
		$query = $this->db->get('wc_notes_volunteer')->result();
  		return $query;
    }
    function get_vol_names_entries()
	{
        $volunteer_name = array();
		$query = $this->db->get('wc_notes_volunteer')->result();
        foreach ($query as $key => $value) {
            $volunteer_name[] = $this->db->query("select * from users where id='$value->volunteer_id'")->row()->name;
        }
  		return $volunteer_name;
    }
    function get_vol_names($id)
	{
        $volunteer_name = $this->db->query("select * from users where id='$id'")->row()->name;
  		return $volunteer_name;
    }
    function delete_entry($id)
    {
       $this->db->delete('wc_notes_admin', array('wcnid' => $id));
    }
    function update_entry($user,$id)
    {
        $this->db->where('wcnid',$id);
   		$this->db->update('wc_notes_admin',$user);
    }
    function update_volannu_entry($user,$id)
    {
        $this->db->where('wcnvid',$id);
   		$this->db->update('wc_notes_volunteer',$user);
    }
 	function get($id){
    	$sql = "SELECT * FROM wc_notes_admin WHERE wcnid = ?";
    	$query =$this->db->query($sql, array($id)); 
            return $query->result();
    }
    function get_vol_announce($id){
       $sql = "SELECT * FROM wc_notes_volunteer WHERE wcnvid = ?";
       $query =$this->db->query($sql, array($id)); 
           return $query->result();
    }
    function get_emails($id){
        $sql = "SELECT * FROM wc_notes_admin_send_list WHERE notes_id = $id";
        $query =$this->db->query($sql);
        return $query->result();
    }
    
    function get_vol_emails($id){
        $sql = "SELECT * FROM wc_notes_volunteer WHERE wcnvid = $id";
        $query =$this->db->query($sql);
        return $query->result();
    }


    function get_volunteers()
    {
        $sql = "SELECT vemail FROM wc_voulnteer";
        $query =$this->db->query($sql);
        $result = $query->result_array();
        $name = [];
        foreach ($result as $key){
            $name[] = $key['vemail'];
        }
        return $name;
    }
    
    function get_volunteers_all()
    {
       $sql = "SELECT * FROM wc_voulnteer";
        $query =$this->db->query($sql);
        $row = $query->result();
        $volunteerList = [];
        $volunteerList['ios'] = [];
        $volunteerList['ios_user_id'] = [];
        $volunteerList['android'] = [];
        $volunteerList['android_user_id'] = [];
        foreach ($row as $v){
            if(!empty($v->vol_token_id)){
                if(strtolower($v->device) == 'android'){
                    $volunteerList['android'][] = $v->vol_token_id;
                    $volunteerList['android_user_id'][] = $v->vounter_id;
                }
                if(strtolower($v->device) == 'ios'){
                    $volunteerList['ios'][] = $v->vol_token_id;
                    $volunteerList['ios_user_id'][] = $v->vounter_id;
                }
            }

        }
        return $volunteerList;
    }

    function insertNotification($insert){
        date_default_timezone_set('Asia/Kolkata');
        // print_r($insert);die;
        $this->db->insert('wc_notifications',$insert);
    }
    
    function get_volunteers_active()
    {
       $sql = "SELECT * FROM wc_voulnteer where status='Active'";
        $query =$this->db->query($sql);
        $row = $query->result();
        $volunteerList = [];
        $volunteerList['ios'] = [];
        $volunteerList['ios_user_id'] = [];
        $volunteerList['android'] = [];
        $volunteerList['android_user_id'] = [];
        foreach ($row as $v){
            if(!empty($v->vol_token_id)){
                if(strtolower($v->device) == 'android'){
                    $volunteerList['android'][] = $v->vol_token_id;
                    $volunteerList['android_user_id'][] = $v->vounter_id;
                }
                if(strtolower($v->device) == 'ios'){
                    $volunteerList['ios'][] = $v->vol_token_id;
                    $volunteerList['ios_user_id'][] = $v->vounter_id;
                }
            }

        }
        return $volunteerList;
    }
    
    function get_volunteers_arabic()
    {
       $sql = "SELECT * FROM wc_voulnteer where shift_language = 'Arabic'";
        $query =$this->db->query($sql);
        $row = $query->result();
        $volunteerList = [];
        $volunteerList['ios'] = [];
        $volunteerList['ios_user_id'] = [];
        $volunteerList['android'] = [];
        $volunteerList['android_user_id'] = [];
        foreach ($row as $v){
            if(!empty($v->vol_token_id)){
                if(strtolower($v->device) == 'android'){
                    $volunteerList['android'][] = $v->vol_token_id;
                    $volunteerList['android_user_id'][] = $v->vounter_id;
                }
                if(strtolower($v->device) == 'ios'){
                    $volunteerList['ios'][] = $v->vol_token_id;
                    $volunteerList['ios_user_id'][] = $v->vounter_id;
                }
            }

        }
        return $volunteerList;
    }
    
    function get_volunteers_english()
    {
       $sql = "SELECT * FROM wc_voulnteer where shift_language = 'English'";
        $query =$this->db->query($sql);
        $row = $query->result();
        $volunteerList = [];
        $volunteerList['ios'] = [];
        $volunteerList['ios_user_id'] = [];
        $volunteerList['android'] = [];
        $volunteerList['android_user_id'] = [];
        foreach ($row as $v){
            if(!empty($v->vol_token_id)){
                if(strtolower($v->device) == 'android'){
                    $volunteerList['android'][] = $v->vol_token_id;
                    $volunteerList['android_user_id'][] = $v->vounter_id;
                }
                if(strtolower($v->device) == 'ios'){
                    $volunteerList['ios'][] = $v->vol_token_id;
                    $volunteerList['ios_user_id'][] = $v->vounter_id;
                }
            }

        }
        return $volunteerList;
    }
    
    function get_volunteers_selected($id)
    {
       $sql = "SELECT * FROM wc_voulnteer where vemail='$id'";
        $query =$this->db->query($sql);
        $row = $query->result();
        $volunteerList = [];
        $volunteerList['ios'] = [];
        $volunteerList['ios_user_id'] = [];
        $volunteerList['android'] = [];
        $volunteerList['android_user_id'] = [];
        foreach ($row as $v){
            if(!empty($v->vol_token_id)){
                if(strtolower($v->device) == 'android'){
                    $volunteerList['android'][] = $v->vol_token_id;
                    $volunteerList['android_user_id'][] = $v->vounter_id;
                }
                // else
                // {
                //     $volunteerList['android'][] = null;
                // }
                if(strtolower($v->device) == 'ios'){
                    $volunteerList['ios'][] = $v->vol_token_id;
                    $volunteerList['ios_user_id'][] = $v->vounter_id;
                }
                // else
                // {
                //     $volunteerList['ios'][] = null;
                // }
            }
        }
        // echo"<pre>";print_r($volunteerList);die;
        return $volunteerList;
    }
    
    function get_volunteers_by_type($type,$email_list)
    {
        $andQry = "";
        if($type == "arabic"){
            $andQry = " where shift_language = 'Arabic'";
        }
        if($type == "english"){
            $andQry = " where shift_language = 'English'";
        }
        if($type == "active"){
            $andQry = " where status = 'Active'";
        }
        if($type == "selected" && !empty($email_list)){
            $andQry = " where vemail in ($email_list)";
        }
        $sql = "SELECT * FROM wc_voulnteer".$andQry;
        $query =$this->db->query($sql);
        $result = $query->result();
        return $result;
    }
    function add_notes_admin_send_list($user)
    {
        $this->db->insert('wc_notes_admin_send_list',$user);
    }

}  