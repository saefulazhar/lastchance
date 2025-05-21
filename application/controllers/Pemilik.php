<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pemilik extends CI_Controller {
    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('logged_in') || $this->session->userdata('role') != 'pemilik') {
            redirect('auth/login');
        }
        if (!$this->session->userdata('user_id')) {
            log_message('error', 'User ID tidak ditemukan di sesi untuk username: ' . $this->session->userdata('username'));
            $this->session->set_flashdata('error', 'Sesi tidak valid. Silakan login kembali.');
            redirect('auth/logout');
        }
        $this->load->model('Kosan_model');
        $this->load->library('form_validation');
    }

    public function index() {
        $pemilik_id = $this->session->userdata('user_id');
        log_message('debug', 'Mengambil daftar kosan untuk pemilik_id: ' . $pemilik_id);
        $data['kosan'] = $this->Kosan_model->get_kosan_by_pemilik($pemilik_id);
        log_message('debug', 'Jumlah kosan yang ditemukan: ' . count($data['kosan']));
        $data['content_view'] = 'pemilik/index';
        $data['title'] = 'Dashboard Pemilik - HORIKOS';
        $data['show_sidebar'] = false;
        $this->load->view('templates/header', $data);
        return;
    }


    public function tambah_kosan() {
        $this->form_validation->set_rules('nama', 'Nama Kosan', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');
        $this->form_validation->set_rules('kecamatan', 'Kecamatan', 'required');
        $this->form_validation->set_rules('desa', 'Desa', 'required');
        $this->form_validation->set_rules('harga', 'Harga', 'required|numeric');
        $this->form_validation->set_rules('tipe', 'Tipe', 'required|in_list[putra,putri,campur]');
        $this->form_validation->set_rules('kepribadian', 'Kepribadian', 'required|in_list[introvert,extrovert,ambivert]');
        $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'trim');
        $this->form_validation->set_rules('google_maps_link', 'Google Maps Link', 'trim|valid_url');
        $this->form_validation->set_rules('fasilitas[]', 'Fasilitas', 'trim');
        $this->form_validation->set_rules('jumlah_kamar', 'Jumlah Kamar', 'required|numeric|greater_than[0]');
        $this->form_validation->set_rules('kamar_tersedia', 'Kamar Tersedia', 'required|numeric|greater_than_equal_to[0]|callback_check_kamar_tersedia');

        if ($this->form_validation->run() === FALSE) {
            $data['content_view'] = 'pemilik/tambah_kosan';
            $data['title'] = 'Tambah Kosan - HORIKOS';
            $data['show_sidebar'] = false;
            $this->load->view('templates/header', $data);
        } else {
            $upload_path = FCPATH . 'uploads/kosan/';
            if (!is_dir($upload_path)) {
                mkdir($upload_path, 0777, TRUE);
                chmod($upload_path, 0777);
            }

            if (!is_writable($upload_path)) {
                $this->session->set_flashdata('error', 'Direktori upload tidak dapat ditulis. Periksa izin folder: ' . $upload_path);
                $data['content_view'] = 'pemilik/tambah_kosan';
                $data['title'] = 'Tambah Kosan - HORIKOS';
                $data['show_sidebar'] = false;
                $this->load->view('templates/header', $data);
                return;
            }

            $config['upload_path'] = $upload_path;
            $config['allowed_types'] = 'jpg|png|jpeg';
            $config['max_size'] = 2048;
            $config['encrypt_name'] = TRUE;
            $config['file_ext_tolower'] = TRUE;

            $this->load->library('upload', $config);

            $foto_paths = [];
            if (!empty($_FILES['foto_kosan']['name'][0])) {
                $files = $_FILES['foto_kosan'];
                $count = count($_FILES['foto_kosan']['name']);
                for ($i = 0; $i < $count; $i++) {
                    if (!empty($files['name'][$i])) {
                        $_FILES['file']['name'] = $files['name'][$i];
                        $_FILES['file']['type'] = $files['type'][$i];
                        $_FILES['file']['tmp_name'] = $files['tmp_name'][$i];
                        $_FILES['file']['error'] = $files['error'][$i];
                        $_FILES['file']['size'] = $files['size'][$i];

                        if ($this->upload->do_upload('file')) {
                            $upload_data = $this->upload->data();
                            $foto_paths[] = $upload_data['file_name'];
                        } else {
                            $this->session->set_flashdata('error', 'Gagal upload foto: ' . $this->upload->display_errors());
                            $data['content_view'] = 'pemilik/tambah_kosan';
                            $data['title'] = 'Tambah Kosan - HORIKOS';
                            $data['show_sidebar'] = true;
                            $this->load->view('templates/header', $data);
                            return;
                        }
                    }
                }
            }

            $data = array(
                'nama' => $this->input->post('nama'),
                'alamat' => $this->input->post('alamat'),
                'kecamatan' => $this->input->post('kecamatan'),
                'desa' => $this->input->post('desa'),
                'harga' => $this->input->post('harga'),
                'tipe' => $this->input->post('tipe'),
                'kepribadian' => $this->input->post('kepribadian'),
                'deskripsi' => $this->input->post('deskripsi'),
                'google_maps_link' => $this->input->post('google_maps_link'),
                'pemilik_id' => $this->session->userdata('user_id'),
                'jumlah_kamar' => $this->input->post('jumlah_kamar'),
                'kamar_tersedia' => $this->input->post('kamar_tersedia'),
                'status' => 'menunggu' // Status default saat menambah kosan
            );

            $kosan_id = $this->Kosan_model->insert_kosan($data);

            if (!empty($foto_paths)) {
                foreach ($foto_paths as $path) {
                    $this->Kosan_model->insert_foto_kosan($kosan_id, $path);
                }
            }

            $fasilitas = $this->input->post('fasilitas');
            if (!empty($fasilitas)) {
                foreach ($fasilitas as $f) {
                    if (!empty($f)) {
                        $this->Kosan_model->insert_fasilitas($kosan_id, $f);
                    }
                }
            }

            $this->session->set_flashdata('success', 'Kosan berhasil ditambahkan dan menunggu verifikasi admin.');
            redirect('pemilik');
        }
    }

    public function edit_kosan($id) {
        $data['kosan'] = $this->Kosan_model->get_kosan_by_id($id);
        if (!$data['kosan'] || $data['kosan']['pemilik_id'] != $this->session->userdata('user_id')) {
            show_404();
        }

        $data['fasilitas'] = $this->Kosan_model->get_fasilitas($id);
        $data['foto_kosan'] = $this->Kosan_model->get_foto_kosan($id);

        $this->form_validation->set_rules('nama', 'Nama Kosan', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');
        $this->form_validation->set_rules('kecamatan', 'Kecamatan', 'required');
        $this->form_validation->set_rules('desa', 'Desa', 'required');
        $this->form_validation->set_rules('harga', 'Harga', 'required|numeric');
        $this->form_validation->set_rules('tipe', 'Tipe', 'required|in_list[putra,putri,campur]');
        $this->form_validation->set_rules('kepribadian', 'Kepribadian', 'required|in_list[introvert,extrovert,ambivert]');
        $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'trim');
        $this->form_validation->set_rules('google_maps_link', 'Google Maps Link', 'trim|valid_url');
        $this->form_validation->set_rules('fasilitas[]', 'Fasilitas', 'trim');
        $this->form_validation->set_rules('jumlah_kamar', 'Jumlah Kamar', 'required|numeric|greater_than[0]');
        $this->form_validation->set_rules('kamar_tersedia', 'Kamar Tersedia', 'required|numeric|greater_than_equal_to[0]|callback_check_kamar_tersedia');

        if ($this->form_validation->run() === FALSE) {
            $data['content_view'] = 'pemilik/edit_kosan';
            $data['title'] = 'Edit Kosan - HORIKOS';
            $data['show_sidebar'] = false;
            $this->load->view('templates/header', $data);
        } else {
            $upload_path = FCPATH . 'uploads/kosan/';
            if (!is_dir($upload_path)) {
                mkdir($upload_path, 0777, TRUE);
                chmod($upload_path, 0777);
            }

            if (!is_writable($upload_path)) {
                $this->session->set_flashdata('error', 'Direktori upload tidak dapat ditulis. Periksa izin folder: ' . $upload_path);
                $data['content_view'] = 'pemilik/edit_kosan';
                $data['title'] = 'Edit Kosan - HORIKOS';
                $data['show_sidebar'] = false;
                $this->load->view('templates/header', $data);
                return;
            }

            $config['upload_path'] = $upload_path;
            $config['allowed_types'] = 'jpg|png|jpeg';
            $config['max_size'] = 2048;
            $config['encrypt_name'] = TRUE;
            $config['file_ext_tolower'] = TRUE;

            $this->load->library('upload', $config);

            $foto_paths = [];
            if (!empty($_FILES['foto_kosan']['name'][0])) {
                $files = $_FILES['foto_kosan'];
                $count = count($_FILES['foto_kosan']['name']);
                for ($i = 0; $i < $count; $i++) {
                    if (!empty($files['name'][$i])) {
                        $_FILES['file']['name'] = $files['name'][$i];
                        $_FILES['file']['type'] = $files['type'][$i];
                        $_FILES['file']['tmp_name'] = $files['tmp_name'][$i];
                        $_FILES['file']['error'] = $files['error'][$i];
                        $_FILES['file']['size'] = $files['size'][$i];

                        if ($this->upload->do_upload('file')) {
                            $upload_data = $this->upload->data();
                            $foto_paths[] = $upload_data['file_name'];
                        } else {
                            $this->session->set_flashdata('error', 'Gagal upload foto: ' . $this->upload->display_errors());
                            $data['content_view'] = 'pemilik/edit_kosan';
                            $data['title'] = 'Edit Kosan - HORIKOS';
                            $data['show_sidebar'] = false;
                            $this->load->view('templates/header', $data);
                            return;
                        }
                    }
                }

                foreach ($data['foto_kosan'] as $foto) {
                    $file_path = FCPATH . 'uploads/kosan/' . basename($foto['path']);
                    if (file_exists($file_path)) {
                        unlink($file_path);
                    }
                }
                $this->Kosan_model->delete_foto_kosan($id);
            }

            $data_kosan = array(
                'nama' => $this->input->post('nama'),
                'alamat' => $this->input->post('alamat'),
                'kecamatan' => $this->input->post('kecamatan'),
                'desa' => $this->input->post('desa'),
                'harga' => $this->input->post('harga'),
                'tipe' => $this->input->post('tipe'),
                'kepribadian' => $this->input->post('kepribadian'),
                'deskripsi' => $this->input->post('deskripsi'),
                'google_maps_link' => $this->input->post('google_maps_link'),
                'jumlah_kamar' => $this->input->post('jumlah_kamar'),
                'kamar_tersedia' => $this->input->post('kamar_tersedia'),
                'status' => 'menunggu' // Reset status ke menunggu saat diedit
            );

            $this->Kosan_model->update_kosan($id, $data_kosan);

            if (!empty($foto_paths)) {
                foreach ($foto_paths as $path) {
                    $this->Kosan_model->insert_foto_kosan($id, $path);
                }
            }

            $this->Kosan_model->delete_fasilitas($id);
            $fasilitas = $this->input->post('fasilitas');
            if (!empty($fasilitas)) {
                foreach ($fasilitas as $f) {
                    if (!empty($f)) {
                        $this->Kosan_model->insert_fasilitas($id, $f);
                    }
                }
            }

            $this->session->set_flashdata('success', 'Kosan berhasil diperbarui dan menunggu verifikasi admin.');
            redirect('pemilik');
        }
    }

// Callback untuk memeriksa kamar tersedia
public function check_kamar_tersedia($str) {
    $jumlah_kamar = $this->input->post('jumlah_kamar');
    if ($this->input->post('kamar_tersedia') > $jumlah_kamar) {
        $this->form_validation->set_message('check_kamar_tersedia', 'Kamar tersedia tidak boleh melebihi jumlah kamar.');
        return FALSE;
    }
    return TRUE;
}

    public function hapus_kosan($id) {
        $kosan = $this->Kosan_model->get_kosan_by_id($id);
        if (!$kosan || $kosan['pemilik_id'] != $this->session->userdata('user_id')) {
            show_404();
        }

        $foto_kosan = $this->Kosan_model->get_foto_kosan($id);
        foreach ($foto_kosan as $foto) {
            $file_path = FCPATH . 'uploads/kosan/' . basename($foto['path']);
            if (file_exists($file_path)) {
                unlink($file_path);
            }
        }

        $this->Kosan_model->delete_kosan($id);
        $this->session->set_flashdata('success', 'Kosan berhasil dihapus.');
        redirect('pemilik');
    }

    public function sewa() {
        $pemilik_id = $this->session->userdata('user_id');
        $data['sewa'] = $this->Kosan_model->get_pemesanan_by_pemilik($pemilik_id);
        $data['content_view'] = 'pemilik/sewa';
        $data['title'] = 'Sewa - HORIKOS';
        $data['show_sidebar'] = false;
        $this->load->view('templates/header', $data);
    }

    public function terima_sewa($id) {
        $this->Kosan_model->update_pemesanan_status($id, 'aktif');
        $this->session->set_flashdata('success', 'Pemesanan berhasil diterima.');
        redirect('pemilik/sewa');
    }

    public function tolak_sewa($id) {
        $this->Kosan_model->update_pemesanan_status($id, 'ditolak');
        $this->session->set_flashdata('success', 'Pemesanan berhasil ditolak.');
        redirect('pemilik/sewa');
    }
}