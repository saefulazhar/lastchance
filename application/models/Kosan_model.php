<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kosan_model extends CI_Model {
    public function search_kosan($cari = '', $tipe = '', $kepribadian = '') {
        $this->db->select('kosan.*, GROUP_CONCAT(CONCAT("uploads/kosan/", foto_kosan.path) SEPARATOR ",") as foto_paths');
        $this->db->from('kosan');
        $this->db->join('foto_kosan', 'foto_kosan.kosan_id = kosan.id', 'left');

        if (!empty($cari)) {
            $this->db->group_start();
            $this->db->like('kosan.nama', $cari);
            $this->db->or_like('kosan.alamat', $cari);
            $this->db->or_like('kosan.kecamatan', $cari);
            $this->db->or_like('kosan.desa', $cari);
            $this->db->group_end();
        }

        if (!empty($tipe)) {
            $this->db->where('kosan.tipe', $tipe);
        }

        if (!empty($kepribadian)) {
            $this->db->where('kosan.kepribadian', $kepribadian);
        }

        $this->db->group_by('kosan.id');
        return $this->db->get()->result_array();
    }

    public function get_kosan_by_id($id) {
        $this->db->where('kosan.id', $id);
        return $this->db->get('kosan')->row_array();
    }

    public function get_fasilitas($id) {
        $this->db->select('fasilitas.nama_fasilitas');
        $this->db->from('kosan_fasilitas');
        $this->db->join('fasilitas', 'fasilitas.id = kosan_fasilitas.fasilitas_id');
        $this->db->where('kosan_fasilitas.kosan_id', $id);
        return $this->db->get()->result_array();
    }

    public function get_foto_kosan($id) {
        $this->db->select('CONCAT("uploads/kosan/", path) as path');
        $this->db->where('kosan_id', $id);
        $this->db->order_by('id', 'asc');
        $this->db->limit(8);
        return $this->db->get('foto_kosan')->result_array();
    }

    public function get_kosan_by_pemilik($pemilik_id) {
        $this->db->select('kosan.*, GROUP_CONCAT(CONCAT("uploads/kosan/", foto_kosan.path) SEPARATOR ",") as foto_paths');
        $this->db->from('kosan');
        $this->db->join('foto_kosan', 'foto_kosan.kosan_id = kosan.id', 'left');
        $this->db->where('kosan.pemilik_id', $pemilik_id);
        $this->db->group_by('kosan.id');
        return $this->db->get()->result_array();
    }

    public function insert_kosan($data) {
        $this->db->insert('kosan', $data);
        return $this->db->insert_id();
    }

    public function insert_foto_kosan($kosan_id, $path) {
        $data = array(
            'kosan_id' => $kosan_id,
            'path' => $path
        );
        $this->db->insert('foto_kosan', $data);
    }

    public function insert_fasilitas($kosan_id, $nama_fasilitas) {
        // Cek apakah fasilitas sudah ada
        $this->db->select('id');
        $this->db->from('fasilitas');
        $this->db->where('nama_fasilitas', $nama_fasilitas);
        $fasilitas = $this->db->get()->row_array();

        if (!$fasilitas) {
            // Jika belum ada, masukkan ke tabel fasilitas
            $data_fasilitas = array('nama_fasilitas' => $nama_fasilitas);
            $this->db->insert('fasilitas', $data_fasilitas);
            $fasilitas_id = $this->db->insert_id();
        } else {
            $fasilitas_id = $fasilitas['id'];
        }

        // Masukkan relasi ke tabel kosan_fasilitas
        $data = array(
            'kosan_id' => $kosan_id,
            'fasilitas_id' => $fasilitas_id
        );
        $this->db->insert('kosan_fasilitas', $data);
    }

    public function update_kosan($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('kosan', $data);
    }

    public function delete_foto_kosan($kosan_id) {
        $this->db->where('kosan_id', $kosan_id);
        $this->db->delete('foto_kosan');
    }

    public function delete_fasilitas($kosan_id) {
        $this->db->where('kosan_id', $kosan_id);
        $this->db->delete('kosan_fasilitas');
    }

    public function delete_kosan($id) {
        // Hapus data terkait di tabel foto_kosan
        $this->db->where('kosan_id', $id);
        $this->db->delete('foto_kosan');

        // Hapus data terkait di tabel kosan_fasilitas
        $this->db->where('kosan_id', $id);
        $this->db->delete('kosan_fasilitas');

        // Hapus data dari tabel kosan
        $this->db->where('id', $id);
        $this->db->delete('kosan');
    }

    public function insert_pemesanan($data) {
        $this->db->insert('pemesanan', $data);
    }

    public function get_pemesanan_by_penyewa($penyewa_username) {
        $this->db->select('pemesanan.*, kosan.nama as nama_kosan');
        $this->db->from('pemesanan');
        $this->db->join('kosan', 'kosan.id = pemesanan.kosan_id');
        $this->db->where('pemesanan.penyewa_username', $penyewa_username);
        return $this->db->get()->result_array();
    }
}