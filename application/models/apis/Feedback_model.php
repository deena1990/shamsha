<?php
class Feedback_model extends CI_Model{
    function insert($data)
    {
        return $this->db->insert('feedback_form',$data);
    }

    public function getAnnounceDetails(){
        $sql = "select * from wc_notes_admin where wcnid =".$this->input->get('announce_id');
        return $this->db->query($sql)->row();
    }
}
