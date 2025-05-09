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
        $data['pemesanan'] = $this->Kosan_model->get_pemesanan_by_penyewa($this->session->userdata('user_id'));
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
}