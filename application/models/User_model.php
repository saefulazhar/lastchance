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
}