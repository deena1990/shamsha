<?php  
class victim_alert_model extends CI_Model  
{  
    function get_victims(){
        return $this->db->get('wc_victim')->result();
    }

    function add_victim_alerts($victim_alert)
	{
    	$this->db->insert('wc_victim_alerts',$victim_alert);
	} 

    function get_allvictimalerts()
    {
        return $this->db->get('wc_victim_alerts')->result();
    }

    function get_sent_by_name()
    {
        $victim_alerts = $this->get_allvictimalerts();
        $sent_by_name = array();
        foreach ($victim_alerts as $key => $value) {
            $sent_by_name[] = $this->db->query("select * from users where id='$value->sent_by'")->row()->name;  
        }

        return $sent_by_name;

    }

}  