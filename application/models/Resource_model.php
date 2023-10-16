<?php

class Resource_model extends CI_Model
{
    function add($user)
    {
        $this->db->insert('wc_resources', $user);
    }

    function get_entries()
    {
        //$sql = "SELECT * FROM wc_resources WHERE res_loc_id !=1";
        //$query =$this->db->query($sql);
        //  return $query->result();
        //	$this->db->where('res_loc_id','!=1');
        //	$query = $this->db->get('wc_resources');


        $this->db->select('wcresid,contact_info1, address_info, web_info1, name, location_name, category_name, category_icon, wc_resources.status as status');
        $this->db->from('wc_resources');
        $this->db->join('wc_resource_locations', 'res_loc_id = wcrid', 'left');
        $this->db->join('wc_resource_category', 'res_res_cat_id = wcrcid', 'left');
        $query = $this->db->get();
        return $query->result();

    }

    function get_loc()
    {
        $query = $this->db->get('wc_resource_locations');

        return $query->result();
    }

    function get_category()
    {
        $query = $this->db->get('wc_resource_category');

        return $query->result();
    }

    function get_cat_entries()
    {
        $query = $this->db->get('wc_resource_category');

        return $query->result();
    }

    function delete_entry($id)
    {
        $this->db->delete('wc_resources', array('wcresid' => $id));
    }

    function delete_cat_entry($id)
    {
        $this->db->delete('wc_resource_category', array('wcrcid' => $id));
    }


    function update_entry($user, $id)
    {
        $this->db->where('wcresid', $id);
        $this->db->update('wc_resources', $user);
    }

    function update_category_entry($user, $id)
    {
        $this->db->where('wcrcid', $id);
        $this->db->update('wc_resource_category', $user);
    }

    function get($id)
    {
        //	$sql = "SELECT * FROM wc_resources WHERE wcresid = ?";
        //	$query =$this->db->query($sql, array($id));

        $sql = "SELECT A.wcresid, A.contact_info, A.address_info, A.web_info, A.timings, A.name, B.wcrid, B.location_name, C.wcrcid, C.category_name
  FROM wc_resources A
  JOIN wc_resource_locations B ON A.res_loc_id = B.wcrid 
  JOIN wc_resource_category C ON A.res_res_cat_id = C.wcrcid
  WHERE A.wcresid=$id";
        $query = $this->db->query($sql);
        return $query->result();

    }

    function get_row($id)
    {
        $sql = "SELECT r.*,c.category_name, l.location_name FROM wc_resources r inner join wc_resource_locations l ON r.res_loc_id = l.wcrid inner join wc_resource_category c ON r.res_res_cat_id = c.wcrcid WHERE wcresid=$id";
        $query = $this->db->query($sql);
       // print_r($query->row()); exit;
        return $query->row();

    }

    function get_cat_info($id)
    {
        $sql = "SELECT * FROM wc_resource_category WHERE wcrcid = ?";
        $query = $this->db->query($sql, array($id));
        return $query->result();
    }

}  