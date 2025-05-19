<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {
    public function get_user_by_username($username) {
        $this->db->where('username', $username);
        return $this->db->get('users')->row_array();
    }

    public function insert_user($data) {
        return $this->db->insert('users', $data);
    }

    public function get_all_users() {
        return $this->db->get('users')->result_array();
    }

    public function delete_user($id) {
        $this->db->where('id', $id);
        return $this->db->delete('users');
    }

    public function update_user($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('users', $data);
    }

   public function get_user_by_id($id) {
        $this->db->select('id, nama, username, email, no_hp, password, role, foto_profil');
        $this->db->where('id', $id);
        return $this->db->get('users')->row_array();
    }

    public function get_user_by_email($email) {
        $this->db->where('email', $email);
        return $this->db->get('users')->row_array();
    }

    public function is_username_taken($username, $exclude_id = null)
{
    $this->db->where('username', $username);
    if ($exclude_id !== null) {
        $this->db->where('id !=', $exclude_id);
    }
    return $this->db->get('users')->num_rows() > 0;
}

public function is_email_taken($email, $exclude_id = null)
{
    $this->db->where('email', $email);
    if ($exclude_id !== null) {
        $this->db->where('id !=', $exclude_id);
    }
    return $this->db->get('users')->num_rows() > 0;
}

}