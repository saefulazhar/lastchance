<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Kosan_model');
    }

    public function index()
    {
        // Ambil semua kosan dari database
        $this->db->select('kosan.*');
        $this->db->from('kosan');
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
        log_message('debug', 'Query semua kosan: ' . $this->db->last_query());
        log_message('debug', 'Jumlah hasil: ' . count($kosan_list));

        // Kirim data ke view
        $data['kosan_list'] = $kosan_list;
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
        // Ambil parameter dari form filter
        $kecamatan = $this->input->get('kecamatan');
        $harga = $this->input->get('harga') ? $this->input->get('harga') : [];
        $tipe = $this->input->get('tipe') ? $this->input->get('tipe') : [];
        $kepribadian = $this->input->get('kepribadian') ? $this->input->get('kepribadian') : [];

        if (empty($kecamatan)) {
            $this->session->set_flashdata('error', 'Kecamatan tidak ditemukan.');
            redirect('home');
        }

        // Query dengan filter tambahan
        $this->db->select('kosan.*');
        $this->db->from('kosan');

        // Filter lokasi (kecamatan, alamat, desa)
        $this->db->group_start();
        $this->db->like('kecamatan', $kecamatan, 'both');
        $this->db->or_like('alamat', $kecamatan, 'both');
        $this->db->or_like('desa', $kecamatan, 'both');
        $this->db->group_end();

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

        // Filter tipe (putra, putri, campur)
        if (!empty($tipe)) {
            $this->db->group_start();
            $this->db->where_in('tipe', $tipe);
            $this->db->group_end();
        }

        // Filter kepribadian
        if (!empty($kepribadian)) {
            $this->db->group_start();
            $this->db->where_in('kepribadian', $kepribadian);
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

        // Debugging: Log query untuk memastikan
        log_message('debug', 'Query filter: ' . $this->db->last_query());
        log_message('debug', 'Jumlah hasil setelah filter: ' . count($kosan_list));

        // Kirim data ke view
        $data['kecamatan_searched'] = $kecamatan;
        $data['kosan_list'] = $kosan_list;
        $data['content_view'] = 'home/index';
        $data['title'] = 'Hasil Pencarian - HORIKOS';
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

        $data['content_view'] = 'home/detail'; // View untuk halaman tentang
        $data['title'] = 'Tentang - HORIKOS';
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