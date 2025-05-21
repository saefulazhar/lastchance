<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Kosan_model');
    }

    public function index() {
        // Ambil semua kosan dengan status aktif dari database menggunakan model
        $this->db->select('kosan.*');
        $this->db->from('kosan');
        $this->db->where('status', 'aktif');
        $query = $this->db->get();
        $kosan_list = $query->result_array();

        // Ambil foto untuk setiap kosan
        foreach ($kosan_list as &$kosan) {
            $this->db->select('path');
            $this->db->from('foto_kosan');
            $this->db->where('kosan_id', $kosan['id']);
            $this->db->limit(1);
            $foto_query = $this->db->get();
            $foto = $foto_query->row_array();
            $kosan['foto'] = $foto ? $foto['path'] : null;
        }
        unset($kosan);

        // Debugging: Log query untuk memastikan
        log_message('debug', 'Query semua kosan aktif: ' . $this->db->last_query());
        log_message('debug', 'Jumlah hasil: ' . count($kosan_list));

        // Kirim data ke view
        $data['kosan_list'] = $kosan_list;
        $data['is_logged_in'] = $this->session->userdata('role') === 'penyewa' && $this->session->userdata('user_id');
        $data['content_view'] = 'home/index';
        $data['title'] = 'Cari Kosan - HORIKOS';
        $data['show_sidebar'] = false;
        $this->load->view('templates/header', $data);
    }

    public function search()
    {
        // Ambil parameter kecamatan
        $kecamatan = $this->input->get('kecamatan');

        if (empty($kecamatan)) {
            $this->session->set_flashdata('error', 'Masukkan kecamatan untuk mencari kosan.');
            redirect('home');
        }

        // Query untuk mencari semua kosan di kecamatan tersebut
        $this->db->select('kosan.*');
        $this->db->from('kosan');
        $this->db->group_start();
        $this->db->like('kecamatan', $kecamatan, 'both');
        $this->db->or_like('alamat', $kecamatan, 'both');
        $this->db->or_like('desa', $kecamatan, 'both');
        $this->db->group_end();
        $query = $this->db->get();
        $kosan_list = $query->result_array();

        // Ambil foto untuk setiap kosan
        foreach ($kosan_list as &$kosan) {
            $this->db->select('path');
            $this->db->from('foto_kosan');
            $this->db->where('kosan_id', $kosan['id']);
            $this->db->limit(1);
            $foto_query = $this->db->get();
            $foto = $foto_query->row_array();
            $kosan['foto'] = $foto ? $foto['path'] : null;
        }
        unset($kosan);

        // Debugging: Log query untuk memastikan
        log_message('debug', 'Query pencarian: ' . $this->db->last_query());
        log_message('debug', 'Jumlah hasil: ' . count($kosan_list));

        // Kirim data ke view
        $data['kecamatan_searched'] = $kecamatan;
        $data['kosan_list'] = $kosan_list;
        $data['content_view'] = 'home/index';
        $data['title'] = 'Hasil Pencarian - HORIKOS';
        $data['show_sidebar'] = false;
        $this->load->view('templates/header', $data);
    }

    public function filter()
{
    $kecamatan = $this->input->get('kecamatan') ? trim($this->input->get('kecamatan')) : ''; // Tangani null dengan aman
    $harga = $this->input->get('harga') ? $this->input->get('harga') : [];
    $tipe = $this->input->get('tipe') ? $this->input->get('tipe') : [];
    $kepribadian = $this->input->get('kepribadian') ? $this->input->get('kepribadian') : [];

    // Query dengan filter tambahan
    $this->db->select('kosan.*');
    $this->db->from('kosan');
    $this->db->where('status', 'aktif'); // Hanya kosan aktif

    // Filter lokasi (kecamatan, alamat, desa) hanya jika kecamatan diisi
    if (!empty($kecamatan)) {
        $this->db->group_start();
        $this->db->like('LOWER(kecamatan)', strtolower($kecamatan), 'both');
        $this->db->or_like('LOWER(alamat)', strtolower($kecamatan), 'both');
        $this->db->or_like('LOWER(desa)', strtolower($kecamatan), 'both');
        $this->db->or_like('LOWER(nama)', strtolower($kecamatan), 'both'); // Pencarian berdasarkan nama
        $this->db->group_end();
    }

    // Filter harga
    if (!empty($harga)) {
        $this->db->group_start();
        $first = true;
        foreach ($harga as $range) {
            list($min, $max) = explode('-', $range);
            if ($first) {
                $this->db->where('harga BETWEEN ' . $min . ' AND ' . $max);
                $first = false;
            } else {
                $this->db->or_where('harga BETWEEN ' . $min . ' AND ' . $max);
            }
        }
        $this->db->group_end();
    }

    // Filter tipe
    if (!empty($tipe)) {
        $this->db->group_start();
        $this->db->where_in('LOWER(tipe)', array_map('strtolower', $tipe));
        $this->db->group_end();
    }

    // Filter kepribadian
    if (!empty($kepribadian)) {
        $this->db->group_start();
        $this->db->where_in('LOWER(kepribadian)', array_map('strtolower', $kepribadian));
        $this->db->group_end();
    }

    $query = $this->db->get();
    $kosan_list = $query->result_array();

    // Ambil foto untuk setiap kosan
    foreach ($kosan_list as &$kosan) {
        $this->db->select('path');
        $this->db->from('foto_kosan');
        $this->db->where('kosan_id', $kosan['id']);
        $this->db->limit(1);
        $foto_query = $this->db->get();
        $foto = $foto_query->row_array();
        $kosan['foto'] = $foto ? $foto['path'] : null;
    }
    unset($kosan);

    // Debugging
    log_message('debug', 'Query filter: ' . $this->db->last_query());
    log_message('debug', 'Jumlah hasil setelah filter: ' . count($kosan_list));

    // Kirim data ke view
    $data['kecamatan_searched'] = $kecamatan;
    $data['kosan_list'] = $kosan_list;
    $data['is_logged_in'] = $this->session->userdata('role') === 'penyewa' && $this->session->userdata('user_id');
    $data['content_view'] = 'home/index';
    $data['title'] = 'Hasil Filter - HORIKOS';
    $data['show_sidebar'] = false;
    $this->load->view('templates/header', $data);
}
    public function detail($id) {
    $data['kosan'] = $this->Kosan_model->get_kosan_by_id($id);
    if (!$data['kosan']) {
        show_404();
    }

    $data['fasilitas'] = $this->Kosan_model->get_fasilitas($id);
    $data['foto_kosan'] = $this->Kosan_model->get_foto_kosan($id);
    $data['ulasan_list'] = $this->Kosan_model->get_ulasan_by_kosan($id);
    $data['rata_rating'] = $this->Kosan_model->get_average_rating($id);

    // Cek apakah pengguna adalah penyewa dengan riwayat sewa aktif/selesai
    if ($this->session->userdata('role') === 'penyewa') {
        $penyewa_id = $this->session->userdata('user_id');
        $data['bisa_ulas'] = $this->Kosan_model->cek_sewa_aktif_atau_selesai($penyewa_id, $id);
        $data['ulasan_exist'] = $data['bisa_ulas'] ? $this->db->where('sewa_id', $data['bisa_ulas']['id'])->get('ulasan')->row_array() : false;
    } else {
        $data['bisa_ulas'] = false;
        $data['ulasan_exist'] = false;
    }

    $data['content_view'] = 'home/detail';
    $data['title'] = 'Detail Kosan: ' . htmlspecialchars($data['kosan']['nama']) . ' - HORIKOS';
    $data['show_sidebar'] = false;
    $this->load->view('templates/header', $data);
}

    public function tentang() {
        $data['content_view'] = 'home/tentang'; // View untuk halaman tentang
        $data['title'] = 'Tentang - HORIKOS';
        $data['show_sidebar'] = false;
        $this->load->view('templates/header', $data);
    }

    public function kontak() {
        $data['content_view'] = 'home/kontak'; // View untuk halaman tentang
        $data['title'] = 'Tentang - HORIKOS';
        $data['show_sidebar'] = false;
        $this->load->view('templates/header', $data);
    }

    public function pemesanan($kosan_id) {
        if (!$this->session->userdata('logged_in') || $this->session->userdata('role') != 'penyewa') {
            $this->session->set_flashdata('error', 'Silakan login sebagai penyewa untuk memesan.');
            redirect('auth/login');
        }

        $this->form_validation->set_rules('tanggal_mulai', 'Tanggal Mulai', 'required|callback_valid_date');
        $this->form_validation->set_rules('durasi', 'Durasi', 'required|numeric|greater_than[0]');

        if ($this->form_validation->run() === FALSE) {
            $this->detail($kosan_id); // Kembali ke detail dengan error
        } else {
            $data = array(
                'kosan_id' => $kosan_id,
                'penyewa_username' => $this->session->userdata('username'),
                'tanggal_mulai' => $this->input->post('tanggal_mulai'),
                'durasi' => $this->input->post('durasi'),
                'status' => 'menunggu'
            );

            $this->Kosan_model->insert_pemesanan($data);
            $this->session->set_flashdata('success', 'Pemesanan berhasil diajukan. Menunggu konfirmasi pemilik.');
            redirect('home/detail/' . $kosan_id);
        }
    }

    

    public function valid_date($date) {
        $d = DateTime::createFromFormat('Y-m-d', $date);
        return $d && $d->format('Y-m-d') === $date && $d >= new DateTime();
    }
}