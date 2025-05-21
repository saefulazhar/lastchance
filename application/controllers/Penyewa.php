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
        $this->load->model('Laporan_model');
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
        
        $data['content_view'] = 'penyewa/index';
        $data['title'] = 'Dashboard Penyewa - HORIKOS';
        $data['show_sidebar'] = true;
        $this->load->view('templates/header', $data);
        return;
    }

    public function sewa($kosan_id) {
        $data['kosan'] = $this->Kosan_model->get_kosan_by_id($kosan_id);
        if (!$data['kosan']) {
            show_404();
        }

        $this->form_validation->set_rules('durasi', 'Durasi Sewa (bulan)', 'required|numeric|greater_than[0]');
        $this->form_validation->set_rules('tanggal_mulai', 'Tanggal Mulai', 'required|callback_valid_date');

        if ($this->form_validation->run() === FALSE) {
            $data['content_view'] = 'penyewa/sewa'; // View untuk halaman tentang
        $data['title'] = 'Sewa Kos - HORIKOS';
        $data['show_sidebar'] = false;
        $this->load->view('templates/header', $data);
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
    
        $data['content_view'] = 'penyewa/my_sewa';
        $data['title'] = 'Riwayat Sewa - HORIKOS';
        $data['show_sidebar'] = true;
        $this->load->view('templates/header', $data);
        return;
}

    public function beri_ulasan($kosan_id) {
    $penyewa_id = $this->session->userdata('user_id');
    $kosan = $this->Kosan_model->get_kosan_by_id($kosan_id);
    if (!$kosan) {
        $this->session->set_flashdata('error', 'Kosan tidak ditemukan.');
        redirect('home');
    }

    // Ambil riwayat sewa aktif atau selesai untuk kosan ini
    $sewa = $this->Kosan_model->cek_sewa_aktif_atau_selesai($penyewa_id, $kosan_id);
    if (!$sewa) {
        $this->session->set_flashdata('error', 'Anda tidak memiliki riwayat sewa aktif atau selesai untuk kosan ini.');
        redirect('home/detail/' . $kosan_id);
    }

    // Cek apakah ulasan sudah ada untuk sewa ini dari riwayat
    $this->db->where('sewa_id', $sewa['id']);
    $ulasan_exist = $this->db->get('ulasan')->row_array();
    if ($ulasan_exist) {
        $this->session->set_flashdata('error', 'Anda sudah memberikan ulasan untuk sewa ini.');
        redirect('home/detail/' . $kosan_id);
    }

    if ($this->input->post()) {
        $this->form_validation->set_rules('rating', 'Rating', 'required|numeric|greater_than[0]|less_than_equal_to[5]');
        $this->form_validation->set_rules('ulasan', 'Ulasan', 'trim');

        if ($this->form_validation->run() === TRUE) {
            $data = array(
                'kosan_id' => $kosan_id,
                'penyewa_id' => $penyewa_id,
                'sewa_id' => $sewa['id'],
                'rating' => $this->input->post('rating'),
                'ulasan' => $this->input->post('ulasan')
            );

            if ($this->db->insert('ulasan', $data)) {
                $rata_rating = $this->Kosan_model->get_average_rating($kosan_id);
                $this->Kosan_model->update_kosan_rating($kosan_id, $rata_rating);
                $this->session->set_flashdata('success', 'Ulasan dan rating berhasil ditambahkan.');
            } else {
                log_message('error', 'Gagal menyimpan ulasan: ' . json_encode($this->db->error()));
                $this->session->set_flashdata('error', 'Gagal menambahkan ulasan.');
            }
            redirect('home/detail/' . $kosan_id);
        }
    }

    $data['kosan_id'] = $kosan_id;
    $data['content_view'] = 'penyewa/beri_ulasan';
    $data['title'] = 'Beri Ulasan - HORIKOS';
    $data['show_sidebar'] = false;
    $this->load->view('templates/header', $data);
}

public function edit_ulasan($ulasan_id) {
    $penyewa_id = $this->session->userdata('user_id');
    $this->db->where('id', $ulasan_id);
    $this->db->where('penyewa_id', $penyewa_id);
    $ulasan = $this->db->get('ulasan')->row_array();

    if (!$ulasan) {
        $this->session->set_flashdata('error', 'Ulasan tidak ditemukan atau Anda tidak memiliki akses.');
        redirect('home');
    }

    if ($this->input->post()) {
        $this->form_validation->set_rules('rating', 'Rating', 'required|numeric|greater_than[0]|less_than_equal_to[5]');
        $this->form_validation->set_rules('ulasan', 'Ulasan', 'trim');

        if ($this->form_validation->run() === TRUE) {
            $data = array(
                'rating' => $this->input->post('rating'),
                'ulasan' => $this->input->post('ulasan')
            );

            $this->db->where('id', $ulasan_id);
            if ($this->db->update('ulasan', $data)) {
                $kosan_id = $ulasan['kosan_id'];
                $rata_rating = $this->Kosan_model->get_average_rating($kosan_id);
                $this->Kosan_model->update_kosan_rating($kosan_id, $rata_rating);
                $this->session->set_flashdata('success', 'Ulasan berhasil diperbarui.');
            } else {
                log_message('error', 'Gagal memperbarui ulasan: ' . json_encode($this->db->error()));
                $this->session->set_flashdata('error', 'Gagal memperbarui ulasan.');
            }
            redirect('home/detail/' . ($ulasan['kosan_id'] ?? ''));
        }
    }

    $data['ulasan'] = $ulasan;
    $data['content_view'] = 'penyewa/edit_ulasan';
    $data['title'] = 'Edit Ulasan - HORIKOS';
    $data['show_sidebar'] = false;
    $this->load->view('templates/header', $data);
}

    public function riwayat_ulasan() {
        $penyewa_id = $this->session->userdata('user_id');
        $data['riwayat_ulasan'] = $this->Ulasan_model->get_ulasan_by_penyewa($penyewa_id);
        
        $data['content_view'] = 'penyewa/riwayat_ulasan';
        $data['title'] = 'Riwayat Ulasan - HORIKOS';
        $data['show_sidebar'] = true;
        $this->load->view('templates/header', $data);
        return;
    }

    public function buat_laporan($kosan_id = null, $sewa_id = null) {
    $user_id = $this->session->userdata('user_id');
    if (!$user_id || $this->session->userdata('role') !== 'penyewa') {
        $this->session->set_flashdata('error', 'Anda harus login sebagai penyewa.');
        redirect('auth/login');
    }

    $this->load->model('Laporan_model');
    $this->load->model('Kosan_model');
    $this->load->library('form_validation');

    $this->form_validation->set_rules('judul', 'Judul', 'required');
    $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required');
    $this->form_validation->set_rules('kosan_id', 'Kosan', 'required|callback_valid_kosan');

    if ($this->form_validation->run() === FALSE) {
        $data['selected_kosan_id'] = $kosan_id;
        $data['selected_sewa_id'] = $sewa_id;
        $data['kosan'] = $this->Kosan_model->get_all_kosan();

        $data['content_view'] = 'penyewa/buat_laporan';
        $data['title'] = 'Buat Laporan - HORIKOS';
        $data['show_sidebar'] = true;
        $this->load->view('templates/header', $data);
    } else {
        $data = [
            'user_id' => $user_id,
            'kosan_id' => $this->input->post('kosan_id'),
            'judul' => $this->input->post('judul'),
            'deskripsi' => $this->input->post('deskripsi')
        ];

        if (!empty($_FILES['lampiran']['name'])) {
            $config['upload_path'] = './uploads/laporan/';
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['max_size'] = 2048;
            $config['file_name'] = 'laporan_' . $user_id . '_' . time();

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('lampiran')) {
                $upload_data = $this->upload->data();
                $data['lampiran'] = 'uploads/laporan/' . $upload_data['file_name'];
            } else {
                $this->session->set_flashdata('error', 'Gagal mengunggah lampiran: ' . $this->upload->display_errors());
                redirect('penyewa/buat_laporan/' . $kosan_id . '/' . $sewa_id);
            }
        }

        if ($this->Laporan_model->insert_laporan($data)) {
            $this->session->set_flashdata('success', 'Laporan berhasil dikirim.');
        } else {
            $this->session->set_flashdata('error', 'Gagal mengirim laporan.');
        }
        redirect('penyewa/my_sewa'); // Alihkan ke halaman utama setelah submit
    }
}

public function valid_kosan($kosan_id) {
    if ($kosan_id) {
        $this->load->model('Kosan_model');
        $kosan = $this->Kosan_model->get_kosan_by_id($kosan_id);
        if ($kosan) {
            return TRUE;
        }
    }
    $this->form_validation->set_message('valid_kosan', 'Kosan yang dipilih tidak valid.');
    return FALSE;
}

public function riwayat_laporan() {
    $user_id = $this->session->userdata('user_id');
    if (!$user_id || $this->session->userdata('role') !== 'penyewa') {
        $this->session->set_flashdata('error', 'Anda harus login sebagai penyewa.');
        redirect('auth/login');
    }

    $this->load->model('Laporan_model');
    $data['laporan'] = $this->Laporan_model->get_laporan_by_user_id($user_id);

    $data['content_view'] = 'penyewa/riwayat_laporan';
    $data['title'] = 'Riwayat Laporan - HORIKOS';
    $data['show_sidebar'] = true;
    $this->load->view('templates/header', $data);
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

    
        $data['content_view'] = 'penyewa/profile';
        $data['title'] = 'Profil - HORIKOS';
        $data['show_sidebar'] = true;
        $this->load->view('templates/header', $data);
        return;
}

public function edit_profile()
{
    $this->load->library('form_validation');
    $this->load->model('User_model');

    $id_user = $this->session->userdata('user_id');
    if (!$id_user) {
        $this->session->set_flashdata('error', 'Anda harus login terlebih dahulu.');
        redirect('auth/login');
        return;
    }

    $user = $this->User_model->get_user_by_id($id_user);

    // Set rules validasi
    $this->form_validation->set_rules('nama', 'Nama', 'required');
    $this->form_validation->set_rules('username', 'Username', 'required');
    $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
    $this->form_validation->set_rules('no_hp', 'Nomor HP', 'numeric|max_length[13]');
    $this->form_validation->set_rules('password', 'Kata Sandi', 'min_length[8]|matches[password_confirm]', [
        'matches' => 'Konfirmasi kata sandi tidak cocok.'
    ]);
    $this->form_validation->set_rules('password_confirm', 'Konfirmasi Kata Sandi', 'matches[password]');

    if ($this->form_validation->run() === FALSE) {
       $data['user'] = $user;
        $data['content_view'] = 'penyewa/edit_profile';
        $data['title'] = 'Edit Profil - HORIKOS';
        $data['show_sidebar'] = true;
        $this->load->view('templates/header', $data);
        return;
    }

    // Ambil input secara selektif
    $data = [
        'nama' => $this->input->post('nama'),
        'username' => $this->input->post('username'),
        'email' => $this->input->post('email'),
        'no_hp' => $this->input->post('no_hp') ?: NULL
    ];

    // Handle password jika diisi
    $password = $this->input->post('password');
    if (!empty($password)) {
        $data['password'] = password_hash($password, PASSWORD_DEFAULT);
    }

    // Cek duplikat username dan email
    if ($this->User_model->is_username_taken($data['username'], $id_user)) {
        $this->session->set_flashdata('error', 'Username sudah digunakan oleh pengguna lain.');
        redirect('penyewa/edit_profile');
        return;
    }

    if ($this->User_model->is_email_taken($data['email'], $id_user)) {
        $this->session->set_flashdata('error', 'Email sudah digunakan oleh pengguna lain.');
        redirect('penyewa/edit_profile');
        return;
    }

    // Handle unggah foto profil
    $photo_updated = false;
    if (!empty($_FILES['foto_profil']['name'])) {
        $config['upload_path'] = './uploads/foto_profil/';
        $config['allowed_types'] = 'jpg|jpeg|png';
        $config['max_size'] = 2048; // 2MB
        $config['file_name'] = 'foto_' . $id_user . '_' . time();

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('foto_profil')) {
            $upload_data = $this->upload->data();
            $data['foto_profil'] = $upload_data['file_name'];
            $photo_updated = true;
            $old_user = $this->User_model->get_user_by_id($id_user);
            if ($old_user['foto_profil'] && file_exists('./uploads/foto_profil/' . $old_user['foto_profil'])) {
                unlink('./uploads/foto_profil/' . $old_user['foto_profil']);
            }
        } else {
            $this->session->set_flashdata('error', 'Gagal mengunggah foto: ' . $this->upload->display_errors());
            redirect('penyewa/edit_profile');
            return;
        }
    }

    // Mulai transaksi
    $this->db->trans_start();
    if ($this->User_model->update_user($id_user, $data)) {
        $this->db->trans_complete();
        $this->session->set_flashdata('success', 'Profil berhasil diperbarui.');
        if ($photo_updated && !$data['foto_profil']) {
            $this->session->set_flashdata('warning', 'Data profil berhasil diperbarui, tetapi foto gagal diunggah.');
        }
    } else {
        $this->db->trans_rollback();
        $error = $this->db->error();
        $this->session->set_flashdata('error', 'Gagal memperbarui profil. Error: ' . $error['message']);
    }

    redirect('penyewa/edit_profile');
}


}