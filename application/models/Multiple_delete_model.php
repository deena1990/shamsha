<?php

class Multiple_delete_model extends CI_Model
{
 function fetch_data()
 {
  $this->db->select("*");
  $this->db->from("wc_voulnteer");
  $this->db->order_by('wc_vid', 'desc');
  return $this->db->get();
 }

 function delete($id)
 {
  $this->db->where('wc_vid', $id);
  $this->db->delete('wc_voulnteer');
 }
}

?>
