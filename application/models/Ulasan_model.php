<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ulasan_model extends CI_Model {
    public function get_ulasan_by_sewa($sewa_id) {
        $this->db->where('sewa_id', $sewa_id);
        return $this->db->get('ulasan')->row_array();
    }

    public function create_ulasan($data) {
        return $this->db->insert('ulasan', $data);
    }
}
?>
