<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penyewa extends CI_Controller {
    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('logged_in') || $this->session->userdata('role') != 'penyewa') {
            redirect('auth/login');
        }
        $this->load->model('Kosan_model');
        $this->load->model('Sewa_model');
        $this->load->model('Ulasan_model');
        $this->load->library('form_validation');
    }

    public function index() {
        $data['pemesanan'] = $this->Kosan_model->get_pemesanan_by_penyewa($this->session->userdata('user_id'));
        $penyewa_id = $this->session->userdata('user_id');
        // Ambil jumlah sewa aktif untuk dashboard
        $this->db->where('penyewa_id', $penyewa_id);
        $this->db->where('status', 'aktif');
        $data['active_sewa_count'] = $this->db->count_all_results('sewa');

        // Ambil jumlah ulasan yang sudah diberikan
        $this->db->where('penyewa_id', $penyewa_id);
        $data['ulasan_count'] = $this->db->count_all_results('ulasan');
        $this->load->view('templates/header');
        $this->load->view('penyewa/index', $data);
        $this->load->view('templates/footer');
    }

    public function sewa($kosan_id) {
        $data['kosan'] = $this->Kosan_model->get_kosan_by_id($kosan_id);
        if (!$data['kosan']) {
            show_404();
        }

        $this->form_validation->set_rules('durasi', 'Durasi Sewa (bulan)', 'required|numeric|greater_than[0]');
        $this->form_validation->set_rules('tanggal_mulai', 'Tanggal Mulai', 'required|callback_valid_date');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header');
            $this->load->view('penyewa/sewa', $data);
            $this->load->view('templates/footer');
        } else {
            $durasi = $this->input->post('durasi');
            $tanggal_mulai = $this->input->post('tanggal_mulai');
            $tanggal_selesai = date('Y-m-d', strtotime($tanggal_mulai . ' + ' . $durasi . ' months - 1 day'));

            $pemesanan = array(
                'kosan_id' => $kosan_id,
                'penyewa_id' => $this->session->userdata('user_id'),
                'tanggal_mulai' => $tanggal_mulai,
                'tanggal_selesai' => $tanggal_selesai,
                'status' => 'menunggu'
            );

            $this->Kosan_model->insert_pemesanan($pemesanan);
            $this->session->set_flashdata('success', 'Pemesanan berhasil diajukan. Menunggu konfirmasi pemilik.');
            redirect('penyewa');
        }
    }

    public function valid_date($date) {
        $d = DateTime::createFromFormat('Y-m-d', $date);
        if ($d && $d->format('Y-m-d') === $date && $d >= new DateTime()) {
            return TRUE;
        } else {
            $this->form_validation->set_message('valid_date', 'Tanggal mulai harus valid dan tidak boleh di masa lalu.');
            return FALSE;
        }
    }

    public function cancel_pemesanan($id) {
        $penyewa_id = $this->session->userdata('user_id');
        if ($this->Kosan_model->cancel_pemesanan($id, $penyewa_id)) {
            $this->session->set_flashdata('success', 'Pemesanan berhasil dibatalkan.');
        } else {
            $this->session->set_flashdata('error', 'Gagal membatalkan pemesanan. Pastikan status masih menunggu.');
        }
        redirect('penyewa');
    }

    public function my_sewa() {
    $penyewa_id = $this->session->userdata('user_id');
    $data['menunggu'] = $this->Sewa_model->get_sewa_menunggu_by_penyewa($penyewa_id); // Harus difilter 'menunggu' di Kosan_model
    $data['sewa_aktif'] = $this->Sewa_model->get_sewa_aktif_by_penyewa($penyewa_id);
    $data['sewa_selesai'] = $this->Sewa_model->get_sewa_selesai_by_penyewa($penyewa_id);
    foreach ($data['sewa_aktif'] as &$sewa) {
        $sewa['has_ulasan'] = $this->Ulasan_model->get_ulasan_by_sewa($sewa['id']) ? true : false;
    }
    foreach ($data['sewa_selesai'] as &$sewa) {
        $sewa['has_ulasan'] = $this->Ulasan_model->get_ulasan_by_sewa($sewa['id']) ? true : false;
    }
    $this->load->view('templates/header');
    $this->load->view('templates/sidebar');
    $this->load->view('penyewa/my_sewa', $data);
    $this->load->view('templates/footer');
}

    public function add_ulasan($sewa_id) {
        $penyewa_id = $this->session->userdata('user_id');
        $sewa = $this->Sewa_model->get_sewa_by_id($sewa_id, $penyewa_id);

        if (!$sewa) {
            $this->session->set_flashdata('error', 'Sewa tidak ditemukan atau Anda tidak memiliki akses.');
            redirect('penyewa/sewa');
        }

        // Cek apakah sudah ada ulasan
        if ($this->Ulasan_model->get_ulasan_by_sewa($sewa_id)) {
            $this->session->set_flashdata('error', 'Anda sudah memberikan ulasan untuk sewa ini.');
            redirect('penyewa/sewa');
        }

        $data['sewa'] = $sewa;
        $this->load->view('templates/header');
        $this->load->view('penyewa/add_ulasan', $data);
        $this->load->view('templates/footer');
    }

    public function save_ulasan() {
        $penyewa_id = $this->session->userdata('user_id');
        $sewa_id = $this->input->post('sewa_id');
        $kosan_id = $this->input->post('kosan_id');

        // Validasi sewa
        $sewa = $this->Sewa_model->get_sewa_by_id($sewa_id, $penyewa_id);
        if (!$sewa) {
            $this->session->set_flashdata('error', 'Sewa tidak ditemukan atau Anda tidak memiliki akses.');
            redirect('penyewa/sewa');
        }

        // Cek apakah sudah ada ulasan
        if ($this->Ulasan_model->get_ulasan_by_sewa($sewa_id)) {
            $this->session->set_flashdata('error', 'Anda sudah memberikan ulasan untuk sewa ini.');
            redirect('penyewa/sewa');
        }

        // Validasi input
        $this->form_validation->set_rules('rating', 'Rating', 'required|integer|greater_than[0]|less_than[6]');
        $this->form_validation->set_rules('ulasan', 'Ulasan', 'required');

        if ($this->form_validation->run() === FALSE) {
            $data['sewa'] = $sewa;
            $this->load->view('templates/header');
            $this->load->view('penyewa/add_ulasan', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'sewa_id' => $sewa_id,
                'kosan_id' => $kosan_id,
                'penyewa_id' => $penyewa_id,
                'rating' => $this->input->post('rating'),
                'ulasan' => $this->input->post('ulasan')
                
            ];

            $this->Ulasan_model->create_ulasan($data);
            $this->session->set_flashdata('success', 'Ulasan dan rating berhasil disimpan.');
            redirect('penyewa/my_sewa');
        }
    }

    public function riwayat_ulasan() {
        $penyewa_id = $this->session->userdata('user_id');
        $data['riwayat_ulasan'] = $this->Ulasan_model->get_ulasan_by_penyewa($penyewa_id);
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('penyewa/riwayat_ulasan', $data);
        $this->load->view('templates/footer');
    }

public function laporan() {
    $penyewa_id = $this->session->userdata('penyewa_id');
    $data['laporan'] = $this->Sewa_model->get_laporan_by_penyewa($penyewa_id);
    $this->load->view('templates/header');
    $this->load->view('templates/sidebar');
    $this->load->view('penyewa/laporan', $data);
    $this->load->view('templates/footer');
}

public function edit_ulasan($ulasan_id) {
    $penyewa_id = $this->session->userdata('user_id');
    $data['ulasan'] = $this->Ulasan_model->get_ulasan_by_id($ulasan_id, $penyewa_id);

    if (!$data['ulasan']) {
        $this->session->set_flashdata('error', 'Ulasan tidak ditemukan atau Anda tidak memiliki akses.');
        redirect('penyewa/riwayat_ulasan');
    }

    $this->form_validation->set_rules('rating', 'Rating', 'required|integer|greater_than[0]|less_than[6]');
    $this->form_validation->set_rules('ulasan', 'Ulasan', 'required');

    if ($this->form_validation->run() === FALSE) {
        $this->load->view('templates/header');
        $this->load->view('penyewa/edit_ulasan', $data);
        $this->load->view('templates/footer');
    } else {
        $update_data = [
            'rating' => $this->input->post('rating'),
            'ulasan' => $this->input->post('ulasan')
        ];

        if ($this->Ulasan_model->update_ulasan($ulasan_id, $update_data)) {
            $this->session->set_flashdata('success', 'Ulasan berhasil diperbarui.');
        } else {
            $this->session->set_flashdata('error', 'Gagal memperbarui ulasan.');
        }
        redirect('penyewa/riwayat_ulasan');
    }
}

public function profile() {
    $user_id = $this->session->userdata('user_id');
    if (!$user_id) {
        redirect('auth/login');
    }

    $this->load->model('User_model');
    $data['user'] = $this->User_model->get_user_by_id($user_id);

    if (!$data['user']) {
        $this->session->set_flashdata('error', 'Pengguna tidak ditemukan.');
        redirect('auth/login');
    }

    $this->load->view('templates/header');
    $this->load->view('templates/sidebar');
    $this->load->view('penyewa/profile', $data);
    $this->load->view('templates/footer');
}
}