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
}