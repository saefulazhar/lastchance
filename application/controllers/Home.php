<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Kosan_model');
    }

    public function index() {
    $cari = $this->input->get('cari');
    $tipe = $this->input->get('tipe');
    $kepribadian = $this->input->get('kepribadian');

    $data['kosan'] = $this->Kosan_model->search_kosan($cari, $tipe, $kepribadian);
    $this->load->view('templates/header');
    $this->load->view('home/index', $data);
    $this->load->view('templates/footer');
}
    public function detail($id) {
        $data['kosan'] = $this->Kosan_model->get_kosan_by_id($id);
        if (!$data['kosan']) {
            show_404();
        }
        $data['fasilitas'] = $this->Kosan_model->get_fasilitas($id);
        $data['foto_kosan'] = $this->Kosan_model->get_foto_kosan($id);

        $this->load->view('templates/header');
        $this->load->view('home/detail', $data);
        $this->load->view('templates/footer');
    }

    public function tentang() {
        $this->load->view('templates/header');
        $this->load->view('home/tentang');
        $this->load->view('templates/footer');
    }

    public function kontak() {
        $this->load->view('templates/header');
        $this->load->view('home/kontak');
        $this->load->view('templates/footer');
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