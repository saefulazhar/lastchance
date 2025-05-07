<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penyewa extends CI_Controller {
    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('logged_in') || $this->session->userdata('role') != 'penyewa') {
            redirect('auth/login');
        }
        $this->load->model('Kosan_model');
        $this->load->library('form_validation');
    }

    public function index() {
        $data['pemesanan'] = $this->Kosan_model->get_pemesanan_by_penyewa($this->session->userdata('username'));
        $this->load->view('templates/header');
        $this->load->view('penyewa/index', $data);
        $this->load->view('templates/footer');
    }

    public function sewa($kosan_id) {
        $data['kosan'] = $this->Kosan_model->get_kosan_by_id($kosan_id);
        if (!$data['kosan']) {
            show_404();
        }

        $this->form_validation->set_rules('durasi', 'Durasi Sewa (bulan)', 'required|numeric');
        $this->form_validation->set_rules('tanggal_mulai', 'Tanggal Mulai', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header');
            $this->load->view('penyewa/sewa', $data);
            $this->load->view('templates/footer');
        } else {
            $pemesanan = array(
                'kosan_id' => $kosan_id,
                'penyewa_username' => $this->session->userdata('username'),
                'durasi' => $this->input->post('durasi'),
                'tanggal_mulai' => $this->input->post('tanggal_mulai'),
                'total_harga' => $data['kosan']['harga'] * $this->input->post('durasi'),
                'status' => 'pending'
            );

            $this->Kosan_model->insert_pemesanan($pemesanan);
            $this->session->set_flashdata('success', 'Pemesanan berhasil diajukan. Menunggu konfirmasi pemilik.');
            redirect('penyewa');
        }
    }
}