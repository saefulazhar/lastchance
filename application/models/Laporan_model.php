<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Laporan_model extends CI_Model {

    public function insert_laporan($data) {
        $this->db->insert('laporan', $data);
        return $this->db->insert_id();
    }
    public function get_laporan_by_user_id($user_id) {
        $this->db->select('laporan.*, users.nama as nama_user, kosan.nama as nama_kosan');
        $this->db->from('laporan');
        $this->db->join('users', 'users.id = laporan.user_id', 'left');
        $this->db->join('kosan', 'kosan.id = laporan.kosan_id', 'left');
        $this->db->where('laporan.user_id', $user_id); // Hanya filter berdasarkan user_id
        $this->db->order_by('laporan.created_at', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_laporan_by_id($laporan_id) {
        $this->db->select('laporan.*, users.nama as nama_user, kosan.nama as nama_kosan');
        $this->db->from('laporan');
        $this->db->join('users', 'users.id = laporan.user_id', 'left');
        $this->db->join('kosan', 'kosan.id = laporan.kosan_id', 'left');
        $this->db->where('laporan.id', $laporan_id);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function get_all_laporan() {
        $this->db->select('laporan.*, users.nama as nama_user, kosan.nama as nama_kosan');
        $this->db->from('laporan');
        $this->db->join('users', 'users.id = laporan.user_id', 'left');
        $this->db->join('kosan', 'kosan.id = laporan.kosan_id', 'left');
        $this->db->order_by('laporan.created_at', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function update_laporan($laporan_id, $data) {
        $this->db->where('id', $laporan_id);
        return $this->db->update('laporan', $data);
    }
}