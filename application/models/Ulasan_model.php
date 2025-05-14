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

    public function get_ulasan_by_penyewa($penyewa_id) {
       $this->db->select('u.id, u.rating, u.ulasan, u.created_at, k.nama as kosan_nama, k.id as kosan_id');
    $this->db->from('ulasan u');
    $this->db->join('sewa s', 's.penyewa_id = u.penyewa_id', 'left'); // Hubungkan ulasan dengan sewa melalui penyewa_id
    $this->db->join('kosan k', 'k.id = s.kosan_id', 'left'); // Hubungkan sewa dengan kosan untuk mendapatkan nama dan id
    $this->db->where('u.penyewa_id', $penyewa_id);
    $this->db->order_by('u.created_at', 'DESC');
    return $this->db->get()->result_array();
    }

    public function get_ulasan_by_id($ulasan_id, $penyewa_id) {
    $this->db->select('u.id, u.rating, u.ulasan, u.created_at, u.penyewa_id, k.nama as kosan_nama, k.id as kosan_id');
        $this->db->from('ulasan u');
        $this->db->join('kosan k', 'k.id = u.kosan_id', 'left'); // Pastikan JOIN dengan tabel kosan
        $this->db->where('u.id', $ulasan_id);
        $this->db->where('u.penyewa_id', $penyewa_id);
        $query = $this->db->get();
        return $query->row_array();
}

    public function update_ulasan($ulasan_id, $data) {
        $this->db->where('id', $ulasan_id);
        return $this->db->update('ulasan', $data);
    }
}

