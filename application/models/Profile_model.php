<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class profile_model extends CI_Model{

    function get_profile_detail($session_id){
        $profile_detail=$this->db->query("select * from users where id='$session_id'")->row();
        return $profile_detail;
    }

    function get_roles(){
        $roles=$this->db->query("select * from roles")->result();
        return $roles;
    }

    function get_user_role($session_id){
        $user_role=$this->db->query("select * from roles_users where user_id='$session_id'")->row();
        return $user_role->role_id;
    }

    public function find($id)
    {
        return $this->db->get_where("users", array("id" => $id, "deleted_at" => null))->row(0);
    }

    function edit($data)
    {
        return $this->db->update('users', $data, array('id' => $data['id']));
    }

    function deleteRoles($user_id, $roles)
    {

        return $this->db->delete('roles_users', array('user_id' => $user_id));
    }

    public function addRole($data)
    {
        return $this->db->insert('roles_users', $data);
    }

    function addRoles($user_id, $roles)
    {
        $data["user_id"] = $user_id;
        if (is_array($roles)) {
            foreach ($roles as $role) {
                $data["role_id"] = $role;
                $this->addRole($data);
            }
        }
        else {
            $data["role_id"] = $roles;
            $this->addRole($data);
        }

        return 1;
    }

    function editRoles($user_id, $roles)
    {
        if($this->deleteRoles($user_id, $roles))
            $this->addRoles($user_id, $roles);

        return 1;
    }
    
}
?>