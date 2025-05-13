<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sewa_model extends CI_Model {
    public function get_sewa_by_penyewa($penyewa_id) {
        $this->db->select('sewa.id, sewa.kosan_id, sewa.penyewa_id, sewa.tanggal_mulai, sewa.tanggal_selesai, sewa.status, kosan.nama as nama_kosan');
        $this->db->from('sewa');
        $this->db->join('kosan', 'kosan.id = sewa.kosan_id');
        $this->db->where('sewa.penyewa_id', $penyewa_id);
        $this->db->where_in('sewa.status', ['aktif', 'selesai']);
        return $this->db->get()->result_array();
    }

    public function get_sewa_by_id($sewa_id, $penyewa_id) {
        $this->db->select('sewa.id, sewa.kosan_id, sewa.penyewa_id, sewa.tanggal_mulai, sewa.tanggal_selesai, sewa.status, kosan.nama as nama_kosan');
        $this->db->from('sewa');
        $this->db->join('kosan', 'kosan.id = sewa.kosan_id');
        $this->db->where('sewa.id', $sewa_id);
        $this->db->where('sewa.penyewa_id', $penyewa_id);
        $this->db->where_in('sewa.status', ['aktif', 'selesai']);
        return $this->db->get()->row_array();
    }

    public function get_sewa_aktif_by_penyewa($penyewa_id) {
        $this->db->select('sewa.id, sewa.kosan_id, sewa.penyewa_id, sewa.tanggal_mulai, sewa.tanggal_selesai, sewa.status, kosan.nama as nama_kosan');
        $this->db->from('sewa');
        $this->db->join('kosan', 'kosan.id = sewa.kosan_id');
        $this->db->where('sewa.penyewa_id', $penyewa_id);
        $this->db->where('sewa.status', 'aktif');
        return $this->db->get()->result_array();
    }

    public function get_sewa_selesai_by_penyewa($penyewa_id) {
        $this->db->select('sewa.id, sewa.kosan_id, sewa.penyewa_id, sewa.tanggal_mulai, sewa.tanggal_selesai, sewa.status, kosan.nama as nama_kosan');
        $this->db->from('sewa');
        $this->db->join('kosan', 'kosan.id = sewa.kosan_id');
        $this->db->where('sewa.penyewa_id', $penyewa_id);
        $this->db->where('sewa.status', 'selesai');
        return $this->db->get()->result_array();
    }
}
?>