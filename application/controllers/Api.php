<?php
defined('BASEPATH') OR exit('Akses langsung tidak diizinkan');

use chriskacerguis\RestServer\RestController;

class Api extends RestController {
    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('Kosan_model');
        $this->load->model('Sewa_model');
        $this->load->model('Ulasan_model');
        $this->load->model('Laporan_model');
        $this->load->library('form_validation');
        $this->load->helper('url');

        header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
    header('Access-Control-Allow-Headers: Authorization, Content-Type');

     if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
            exit(0);
        }

    }

    // Login Pengguna
    public function login_post() {
        $this->form_validation->set_data($this->post());
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Kata Sandi', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->response([
                'status' => FALSE,
                'pesan' => validation_errors()
            ], RestController::HTTP_BAD_REQUEST);
        }

        $username = $this->post('username');
        $password = $this->post('password');
        $user = $this->User_model->get_user_by_username($username);

        if ($user && password_verify($password, $user['password'])) {
            // Generate API Key sederhana
            $api_key = bin2hex(random_bytes(16)); // API Key 32 karakter
            $this->db->where('id', $user['id']);
            $this->db->update('users', ['api_key' => $api_key]);

            $this->response([
                'status' => TRUE,
                'pesan' => 'Login berhasil',
                'data' => [
                    'id_pengguna' => $user['id'],
                    'username' => $user['username'],
                    'role' => $user['role'],
                    'api_key' => $api_key
                ]
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => FALSE,
                'pesan' => 'Username atau kata sandi salah'
            ], RestController::HTTP_UNAUTHORIZED);
        }
    }

    // Registrasi Pengguna
    public function register_post() {
        $this->form_validation->set_data($this->post());
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('username', 'Username', 'required|is_unique[users.username]');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('no_hp', 'No HP', 'trim|numeric|max_length[15]');
        $this->form_validation->set_rules('password', 'Kata Sandi', 'required|min_length[6]');
        $this->form_validation->set_rules('konfirmasi_password', 'Konfirmasi Kata Sandi', 'required|matches[password]');
        $this->form_validation->set_rules('role', 'Role', 'required|in_list[pemilik,penyewa]');

        if ($this->form_validation->run() === FALSE) {
            $this->response([
                'status' => FALSE,
                'pesan' => validation_errors()
            ], RestController::HTTP_BAD_REQUEST);
        }

        $upload_path = FCPATH . 'uploads/profile/';
        if (!is_dir($upload_path)) {
            mkdir($upload_path, 0777, TRUE);
            chmod($upload_path, 0777);
        }

        if (!is_writable($upload_path)) {
            $this->response([
                'status' => FALSE,
                'pesan' => 'Direktori unggah tidak dapat ditulis'
            ], RestController::HTTP_INTERNAL_ERROR);
        }

        $config['upload_path'] = $upload_path;
        $config['allowed_types'] = 'jpg|png|jpeg';
        $config['max_size'] = 2048;
        $config['encrypt_name'] = TRUE;
        $config['file_ext_tolower'] = TRUE;

        $this->load->library('upload', $config);

        $foto_profil = 'default-profile.png';
        if (!empty($_FILES['foto_profil']['name'])) {
            if ($this->upload->do_upload('foto_profil')) {
                $upload_data = $this->upload->data();
                $foto_profil = $upload_data['file_name'];
            } else {
                $this->response([
                    'status' => FALSE,
                    'pesan' => 'Gagal mengunggah foto: ' . $this->upload->display_errors()
                ], RestController::HTTP_BAD_REQUEST);
            }
        }

        $data = [
            'nama' => $this->post('nama'),
            'username' => $this->post('username'),
            'email' => $this->post('email'),
            'no_hp' => $this->post('no_hp'),
            'password' => password_hash($this->post('password'), PASSWORD_DEFAULT),
            'role' => $this->post('role'),
            'foto_profil' => $foto_profil
        ];

        if ($this->User_model->insert_user($data)) {
            $this->response([
                'status' => TRUE,
                'pesan' => 'Registrasi berhasil. Silakan login.'
            ], RestController::HTTP_CREATED);
        } else {
            $this->response([
                'status' => FALSE,
                'pesan' => 'Gagal mendaftar pengguna'
            ], RestController::HTTP_INTERNAL_ERROR);
        }
    }

    // Mendapatkan Semua Kosan Aktif
    public function kosan_get() {
        $kosan_list = $this->Kosan_model->get_kosan_aktif();

        foreach ($kosan_list as &$kosan) {
            $foto = $this->Kosan_model->get_foto_kosan($kosan['id']);
            $kosan['foto'] = !empty($foto) ? $foto[0]['path'] : null;
        }
        unset($kosan);

        $this->response([
            'status' => TRUE,
            'data' => $kosan_list
        ], RestController::HTTP_OK);
    }

    // Pencarian Kosan
    public function kosan_search_get() {
        $kecamatan = $this->get('kecamatan');
        if (empty($kecamatan)) {
            $this->response([
                'status' => FALSE,
                'pesan' => 'Kecamatan wajib diisi'
            ], RestController::HTTP_BAD_REQUEST);
        }

        $kosan_list = $this->Kosan_model->search_kosan($kecamatan);

        $this->response([
            'status' => TRUE,
            'data' => $kosan_list
        ], RestController::HTTP_OK);
    }

    // Filter Kosan
    public function kosan_filter_get() {
        $kecamatan = $this->get('kecamatan') ? trim($this->get('kecamatan')) : '';
        $tipe = $this->get('tipe') ? trim($this->get('tipe')) : '';
        $kepribadian = $this->get('kepribadian') ? trim($this->get('kepribadian')) : '';

        // Harga tidak didukung langsung oleh search_kosan, jadi kita filter manual setelah query
        $harga = $this->get('harga') ? explode(',', $this->get('harga')) : [];

        $kosan_list = $this->Kosan_model->search_kosan($kecamatan, $tipe, $kepribadian);

        // Filter harga manual
        if (!empty($harga)) {
            $filtered_kosan = [];
            foreach ($kosan_list as $kosan) {
                $kosan_harga = $kosan['harga'];
                foreach ($harga as $range) {
                    list($min, $max) = explode('-', $range);
                    if ($kosan_harga >= $min && $kosan_harga <= $max) {
                        $filtered_kosan[] = $kosan;
                        break;
                    }
                }
            }
            $kosan_list = $filtered_kosan;
        }

        $this->response([
            'status' => TRUE,
            'data' => $kosan_list
        ], RestController::HTTP_OK);
    }

    // Detail Kosan
    public function kosan_detail_get($id) {
        $kosan = $this->Kosan_model->get_kosan_by_id($id);
        if (!$kosan) {
            $this->response([
                'status' => FALSE,
                'pesan' => 'Kosan tidak ditemukan'
            ], RestController::HTTP_NOT_FOUND);
        }

        $kosan['fasilitas'] = $this->Kosan_model->get_fasilitas($id);
        $kosan['foto_kosan'] = $this->Kosan_model->get_foto_kosan($id);
        $kosan['ulasan_list'] = $this->Kosan_model->get_ulasan_by_kosan($id);
        $kosan['rata_rating'] = $this->Kosan_model->get_average_rating($id);

        $this->response([
            'status' => TRUE,
            'data' => $kosan
        ], RestController::HTTP_OK);
    }

    // Tambah Kosan (Pemilik)
    public function kosan_post() {
        $auth = $this->check_auth('pemilik');
        $pemilik_id = $auth['id'];

        $this->form_validation->set_data($this->post());
        $this->form_validation->set_rules('nama', 'Nama Kosan', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');
        $this->form_validation->set_rules('kecamatan', 'Kecamatan', 'required');
        $this->form_validation->set_rules('desa', 'Desa', 'required');
        $this->form_validation->set_rules('harga', 'Harga', 'required|numeric');
        $this->form_validation->set_rules('tipe', 'Tipe', 'required|in_list[putra,putri,campur]');
        $this->form_validation->set_rules('kepribadian', 'Kepribadian', 'required|in_list[introvert,extrovert,ambivert]');
        $this->form_validation->set_rules('jumlah_kamar', 'Jumlah Kamar', 'required|numeric|greater_than[0]');
        $this->form_validation->set_rules('kamar_tersedia', 'Kamar Tersedia', 'required|numeric|greater_than_equal_to[0]|callback_check_kamar_tersedia');

        if ($this->form_validation->run() === FALSE) {
            $this->response([
                'status' => FALSE,
                'pesan' => validation_errors()
            ], RestController::HTTP_BAD_REQUEST);
        }

        $upload_path = FCPATH . 'uploads/kosan/';
        if (!is_dir($upload_path)) {
            mkdir($upload_path, 0777, TRUE);
            chmod($upload_path, 0777);
        }

        if (!is_writable($upload_path)) {
            $this->response([
                'status' => FALSE,
                'pesan' => 'Direktori unggah tidak dapat ditulis'
            ], RestController::HTTP_INTERNAL_ERROR);
        }

        $config['upload_path'] = $upload_path;
        $config['allowed_types'] = 'jpg|png|jpeg';
        $config['max_size'] = 2048;
        $config['encrypt_name'] = TRUE;
        $config['file_ext_tolower'] = TRUE;

        $this->load->library('upload', $config);

        $foto_paths = [];
        // Validasi apakah foto_kosan ada dan merupakan array untuk multiple files
        if (!empty($_FILES['foto_kosan']['name'])) {
            if (is_array($_FILES['foto_kosan']['name'])) {
                $files = $_FILES['foto_kosan'];
                $count = count($files['name']);
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
                            $this->response([
                                'status' => FALSE,
                                'pesan' => 'Gagal mengunggah foto: ' . $this->upload->display_errors()
                            ], RestController::HTTP_BAD_REQUEST);
                        }
                    }
                }
            } else {
                // Handle single file upload (opsional, jika ingin mendukung)
                $_FILES['file']['name'] = $_FILES['foto_kosan']['name'];
                $_FILES['file']['type'] = $_FILES['foto_kosan']['type'];
                $_FILES['file']['tmp_name'] = $_FILES['foto_kosan']['tmp_name'];
                $_FILES['file']['error'] = $_FILES['foto_kosan']['error'];
                $_FILES['file']['size'] = $_FILES['foto_kosan']['size'];

                if ($this->upload->do_upload('file')) {
                    $upload_data = $this->upload->data();
                    $foto_paths[] = $upload_data['file_name'];
                } else {
                    $this->response([
                        'status' => FALSE,
                        'pesan' => 'Gagal mengunggah foto: ' . $this->upload->display_errors()
                    ], RestController::HTTP_BAD_REQUEST);
                }
            }
        }

        $data = [
            'nama' => $this->post('nama'),
            'alamat' => $this->post('alamat'),
            'kecamatan' => $this->post('kecamatan'),
            'desa' => $this->post('desa'),
            'harga' => $this->post('harga'),
            'tipe' => $this->post('tipe'),
            'kepribadian' => $this->post('kepribadian'),
            'deskripsi' => $this->post('deskripsi'),
            'google_maps_link' => $this->post('google_maps_link'),
            'pemilik_id' => $pemilik_id,
            'jumlah_kamar' => $this->post('jumlah_kamar'),
            'kamar_tersedia' => $this->post('kamar_tersedia'),
            'status' => 'menunggu'
        ];

        $kosan_id = $this->Kosan_model->insert_kosan($data);

        if (!empty($foto_paths)) {
            foreach ($foto_paths as $path) {
                $this->Kosan_model->insert_foto_kosan($kosan_id, $path);
            }
        }

        $fasilitas = $this->post('fasilitas') ? $this->post('fasilitas') : [];
        if (!empty($fasilitas)) {
            foreach ($fasilitas as $f) {
                if (!empty($f)) {
                    $this->Kosan_model->insert_fasilitas($kosan_id, $f);
                }
            }
        }

        $this->response([
            'status' => TRUE,
            'pesan' => 'Kosan berhasil ditambahkan dan menunggu verifikasi admin'
        ], RestController::HTTP_CREATED);
    }

    // Edit Kosan (Pemilik)
    public function kosan_put($id) {
        $auth = $this->check_auth('pemilik');
        $pemilik_id = $auth['id'];

        $kosan = $this->Kosan_model->get_kosan_by_id($id);
        if (!$kosan || $kosan['pemilik_id'] != $pemilik_id) {
            $this->response([
                'status' => FALSE,
                'pesan' => 'Kosan tidak ditemukan atau Anda tidak memiliki akses'
            ], RestController::HTTP_NOT_FOUND);
        }

        $this->form_validation->set_data($this->put());
        $this->form_validation->set_rules('nama', 'Nama Kosan', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');
        $this->form_validation->set_rules('kecamatan', 'Kecamatan', 'required');
        $this->form_validation->set_rules('desa', 'Desa', 'required');
        $this->form_validation->set_rules('harga', 'Harga', 'required|numeric');
        $this->form_validation->set_rules('tipe', 'Tipe', 'required|in_list[putra,putri,campur]');
        $this->form_validation->set_rules('kepribadian', 'Kepribadian', 'required|in_list[introvert,extrovert,ambivert]');
        $this->form_validation->set_rules('jumlah_kamar', 'Jumlah Kamar', 'required|numeric|greater_than[0]');
        $this->form_validation->set_rules('kamar_tersedia', 'Kamar Tersedia', 'required|numeric|greater_than_equal_to[0]|callback_check_kamar_tersedia');

        if ($this->form_validation->run() === FALSE) {
            $this->response([
                'status' => FALSE,
                'pesan' => validation_errors()
            ], RestController::HTTP_BAD_REQUEST);
        }

        $upload_path = FCPATH . 'uploads/kosan/';
        if (!is_dir($upload_path)) {
            mkdir($upload_path, 0777, TRUE);
            chmod($upload_path, 0777);
        }

        if (!is_writable($upload_path)) {
            $this->response([
                'status' => FALSE,
                'pesan' => 'Direktori unggah tidak dapat ditulis'
            ], RestController::HTTP_INTERNAL_ERROR);
        }

        $config['upload_path'] = $upload_path;
        $config['allowed_types'] = 'jpg|png|jpeg';
        $config['max_size'] = 2048;
        $config['encrypt_name'] = TRUE;
        $config['file_ext_tolower'] = TRUE;

        $this->load->library('upload', $config);

        $foto_paths = [];
        // Validasi apakah foto_kosan ada dan merupakan array untuk multiple files
        if (!empty($_FILES['foto_kosan']['name'])) {
            if (is_array($_FILES['foto_kosan']['name'])) {
                $files = $_FILES['foto_kosan'];
                $count = count($files['name']);
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
                            $this->response([
                                'status' => FALSE,
                                'pesan' => 'Gagal mengunggah foto: ' . $this->upload->display_errors()
                            ], RestController::HTTP_BAD_REQUEST);
                        }
                    }
                }
            } else {
                // Handle single file upload (opsional, jika ingin mendukung)
                $_FILES['file']['name'] = $_FILES['foto_kosan']['name'];
                $_FILES['file']['type'] = $_FILES['foto_kosan']['type'];
                $_FILES['file']['tmp_name'] = $_FILES['foto_kosan']['tmp_name'];
                $_FILES['file']['error'] = $_FILES['foto_kosan']['error'];
                $_FILES['file']['size'] = $_FILES['foto_kosan']['size'];

                if ($this->upload->do_upload('file')) {
                    $upload_data = $this->upload->data();
                    $foto_paths[] = $upload_data['file_name'];
                } else {
                    $this->response([
                        'status' => FALSE,
                        'pesan' => 'Gagal mengunggah foto: ' . $this->upload->display_errors()
                    ], RestController::HTTP_BAD_REQUEST);
                }
            }

            // Hapus foto lama jika ada upload baru
            if (!empty($foto_paths)) {
                foreach ($this->Kosan_model->get_foto_kosan($id) as $foto) {
                    $file_path = FCPATH . 'uploads/kosan/' . basename($foto['path']);
                    if (file_exists($file_path)) {
                        unlink($file_path);
                    }
                }
                $this->Kosan_model->delete_foto_kosan($id);
            }
        }

        $data_kosan = [
            'nama' => $this->put('nama'),
            'alamat' => $this->put('alamat'),
            'kecamatan' => $this->put('kecamatan'),
            'desa' => $this->put('desa'),
            'harga' => $this->put('harga'),
            'tipe' => $this->put('tipe'),
            'kepribadian' => $this->put('kepribadian'),
            'deskripsi' => $this->put('deskripsi'),
            'google_maps_link' => $this->put('google_maps_link'),
            'jumlah_kamar' => $this->put('jumlah_kamar'),
            'kamar_tersedia' => $this->put('kamar_tersedia'),
            'status' => 'menunggu'
        ];

        $this->Kosan_model->update_kosan($id, $data_kosan);

        if (!empty($foto_paths)) {
            foreach ($foto_paths as $path) {
                $this->Kosan_model->insert_foto_kosan($id, $path);
            }
        }

        $this->Kosan_model->delete_fasilitas($id);
        $fasilitas = $this->put('fasilitas') ? $this->put('fasilitas') : [];
        if (!empty($fasilitas)) {
            foreach ($fasilitas as $f) {
                if (!empty($f)) {
                    $this->Kosan_model->insert_fasilitas($id, $f);
                }
            }
        }

        $this->response([
            'status' => TRUE,
            'pesan' => 'Kosan berhasil diperbarui dan menunggu verifikasi admin'
        ], RestController::HTTP_OK);
    }

    // Hapus Kosan (Pemilik)
    public function kosan_delete($id) {
        $auth = $this->check_auth('pemilik');
        $pemilik_id = $auth['id'];

        $kosan = $this->Kosan_model->get_kosan_by_id($id);
        if (!$kosan || $kosan['pemilik_id'] != $pemilik_id) {
            $this->response([
                'status' => FALSE,
                'pesan' => 'Kosan tidak ditemukan atau Anda tidak memiliki akses'
            ], RestController::HTTP_NOT_FOUND);
        }

        $foto_kosan = $this->Kosan_model->get_foto_kosan($id);
        foreach ($foto_kosan as $foto) {
            $file_path = FCPATH . 'uploads/kosan/' . basename($foto['path']);
            if (file_exists($file_path)) {
                unlink($file_path);
            }
        }

        $this->Kosan_model->delete_kosan($id);
        $this->response([
            'status' => TRUE,
            'pesan' => 'Kosan berhasil dihapus'
        ], RestController::HTTP_OK);
    }

    // Pemesanan Kosan (Penyewa)
    public function sewa_post($kosan_id) {
        $auth = $this->check_auth('penyewa');
        $penyewa_id = $auth['id'];

        $kosan = $this->Kosan_model->get_kosan_by_id($kosan_id);
        if (!$kosan) {
            $this->response([
                'status' => FALSE,
                'pesan' => 'Kosan tidak ditemukan'
            ], RestController::HTTP_NOT_FOUND);
        }

        $this->form_validation->set_data($this->post());
        $this->form_validation->set_rules('durasi', 'Durasi Sewa (bulan)', 'required|numeric|greater_than[0]');
        $this->form_validation->set_rules('tanggal_mulai', 'Tanggal Mulai', 'required|callback_valid_date');

        if ($this->form_validation->run() === FALSE) {
            $this->response([
                'status' => FALSE,
                'pesan' => validation_errors()
            ], RestController::HTTP_BAD_REQUEST);
        }

        $durasi = $this->post('durasi');
        $tanggal_mulai = $this->post('tanggal_mulai');
        $tanggal_selesai = date('Y-m-d', strtotime($tanggal_mulai . ' + ' . $durasi . ' months - 1 day'));

        $pemesanan = [
            'kosan_id' => $kosan_id,
            'penyewa_id' => $penyewa_id,
            'tanggal_mulai' => $tanggal_mulai,
            'tanggal_selesai' => $tanggal_selesai,
            'status' => 'menunggu'
        ];

        // Sementara menggunakan query langsung karena Sewa_model belum memiliki fungsi insert_pemesanan
        $this->db->insert('sewa', $pemesanan);
        $this->response([
            'status' => TRUE,
            'pesan' => 'Pemesanan berhasil diajukan. Menunggu konfirmasi pemilik.'
        ], RestController::HTTP_CREATED);
    }

    // Batalkan Pemesanan (Penyewa)
    public function sewa_delete($id) {
        $auth = $this->check_auth('penyewa');
        $penyewa_id = $auth['id'];

        // Sementara menggunakan query langsung karena Sewa_model belum memiliki fungsi cancel_pemesanan
        $this->db->where('id', $id);
        $this->db->where('penyewa_id', $penyewa_id);
        $this->db->where('status', 'menunggu');
        $this->db->update('sewa', ['status' => 'dibatalkan']);

        if ($this->db->affected_rows() > 0) {
            $this->response([
                'status' => TRUE,
                'pesan' => 'Pemesanan berhasil dibatalkan'
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => FALSE,
                'pesan' => 'Gagal membatalkan pemesanan. Pastikan status masih menunggu.'
            ], RestController::HTTP_BAD_REQUEST);
        }
    }

    // Terima atau Tolak Pemesanan (Pemilik)
    public function sewa_status_put($id) {
        $this->check_auth('pemilik');

        $status = $this->put('status');
        if (!in_array($status, ['aktif', 'ditolak'])) {
            $this->response([
                'status' => FALSE,
                'pesan' => 'Status tidak valid'
            ], RestController::HTTP_BAD_REQUEST);
        }

        // Sementara menggunakan query langsung karena Sewa_model belum memiliki fungsi update_pemesanan_status
        $this->db->where('id', $id);
        $this->db->update('sewa', ['status' => $status]);
        $this->response([
            'status' => TRUE,
            'pesan' => 'Status pemesanan berhasil diperbarui'
        ], RestController::HTTP_OK);
    }

    // Beri Ulasan (Penyewa)
    public function ulasan_post($kosan_id) {
        $auth = $this->check_auth('penyewa');
        $penyewa_id = $auth['id'];

        $kosan = $this->Kosan_model->get_kosan_by_id($kosan_id);
        if (!$kosan) {
            $this->response([
                'status' => FALSE,
                'pesan' => 'Kosan tidak ditemukan'
            ], RestController::HTTP_NOT_FOUND);
        }

        $this->form_validation->set_data($this->post());
        $this->form_validation->set_rules('rating', 'Rating', 'required|numeric|greater_than[0]|less_than_equal_to[5]');
        $this->form_validation->set_rules('ulasan', 'Ulasan', 'trim');

        if ($this->form_validation->run() === FALSE) {
            $this->response([
                'status' => FALSE,
                'pesan' => validation_errors()
            ], RestController::HTTP_BAD_REQUEST);
        }

        $data = [
            'kosan_id' => $kosan_id,
            'penyewa_id' => $penyewa_id,
            'rating' => $this->post('rating'),
            'ulasan' => $this->post('ulasan')
        ];

        if ($this->Ulasan_model->create_ulasan($data)) {
            $this->response([
                'status' => TRUE,
                'pesan' => 'Ulasan berhasil ditambahkan'
            ], RestController::HTTP_CREATED);
        } else {
            $this->response([
                'status' => FALSE,
                'pesan' => 'Gagal menambahkan ulasan'
            ], RestController::HTTP_INTERNAL_ERROR);
        }
    }

    // Edit Ulasan (Penyewa)
    public function ulasan_put($ulasan_id) {
        $auth = $this->check_auth('penyewa');
        $penyewa_id = $auth['id'];

        $ulasan = $this->Ulasan_model->get_ulasan_by_id($ulasan_id, $penyewa_id);
        if (!$ulasan) {
            $this->response([
                'status' => FALSE,
                'pesan' => 'Ulasan tidak ditemukan atau Anda tidak memiliki akses'
            ], RestController::HTTP_NOT_FOUND);
        }

        $this->form_validation->set_data($this->put());
        $this->form_validation->set_rules('rating', 'Rating', 'required|numeric|greater_than[0]|less_than_equal_to[5]');
        $this->form_validation->set_rules('ulasan', 'Ulasan', 'trim');

        if ($this->form_validation->run() === FALSE) {
            $this->response([
                'status' => FALSE,
                'pesan' => validation_errors()
            ], RestController::HTTP_BAD_REQUEST);
        }

        $data = [
            'rating' => $this->put('rating'),
            'ulasan' => $this->put('ulasan')
        ];

        if ($this->Ulasan_model->update_ulasan($ulasan_id, $data)) {
            $this->response([
                'status' => TRUE,
                'pesan' => 'Ulasan berhasil diperbarui'
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => FALSE,
                'pesan' => 'Gagal memperbarui ulasan'
            ], RestController::HTTP_INTERNAL_ERROR);
        }
    }

    // Buat Laporan (Penyewa)
    public function laporan_post($kosan_id) {
        $auth = $this->check_auth('penyewa');
        $penyewa_id = $auth['id'];

        $kosan = $this->Kosan_model->get_kosan_by_id($kosan_id);
        if (!$kosan) {
            $this->response([
                'status' => FALSE,
                'pesan' => 'Kosan tidak ditemukan'
            ], RestController::HTTP_NOT_FOUND);
        }

        $laporan = $this->Kosan_model->get_laporan_by_penyewa($penyewa_id);
        $last_report = null;
        foreach ($laporan as $l) {
            if ($l['kosan_id'] == $kosan_id) {
                $last_report = $l;
                break;
            }
        }

        if ($last_report) {
            $last_report_date = strtotime($last_report['created_at']);
            $days_since_last_report = (time() - $last_report_date) / (60 * 60 * 24);
            if ($days_since_last_report < 30) {
                $this->response([
                    'status' => FALSE,
                    'pesan' => 'Anda sudah melaporkan kosan ini. Tunggu hingga ' . date('d-m-Y', strtotime($last_report['created_at'] . ' +30 days'))
                ], RestController::HTTP_BAD_REQUEST);
            }
        }

        $this->form_validation->set_data($this->post());
        $this->form_validation->set_rules('judul', 'Judul Laporan', 'required|trim');
        $this->form_validation->set_rules('deskripsi', 'Deskripsi Laporan', 'required|trim');

        if ($this->form_validation->run() === FALSE) {
            $this->response([
                'status' => FALSE,
                'pesan' => validation_errors()
            ], RestController::HTTP_BAD_REQUEST);
        }

        $lampiran_path = null;
        if (!empty($_FILES['lampiran']['name'])) {
            $config['upload_path'] = './uploads/laporan/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['max_size'] = 2048;
            $config['file_name'] = 'laporan_' . $penyewa_id . '_' . time();

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('lampiran')) {
                $upload_data = $this->upload->data();
                $lampiran_path = 'uploads/laporan/' . $upload_data['file_name'];
            } else {
                $this->response([
                    'status' => FALSE,
                    'pesan' => 'Gagal mengunggah lampiran: ' . $this->upload->display_errors()
                ], RestController::HTTP_BAD_REQUEST);
            }
        }

        $data = [
            'kosan_id' => $kosan_id,
            'user_id' => $penyewa_id,
            'judul' => $this->post('judul'),
            'deskripsi' => $this->post('deskripsi'),
            'lampiran' => $lampiran_path,
            'created_at' => date('Y-m-d H:i:s')
        ];

        if ($this->Laporan_model->insert_laporan($data)) {
            $this->response([
                'status' => TRUE,
                'pesan' => 'Laporan berhasil dikirim'
            ], RestController::HTTP_CREATED);
        } else {
            $this->response([
                'status' => FALSE,
                'pesan' => 'Gagal mengirim laporan'
            ], RestController::HTTP_INTERNAL_ERROR);
        }
    }

    // Riwayat Laporan (Penyewa)
    public function laporan_get() {
        $auth = $this->check_auth('penyewa');
        $penyewa_id = $auth['id'];

        $laporan = $this->Laporan_model->get_laporan_by_user_id($penyewa_id);

        $this->response([
            'status' => TRUE,
            'data' => $laporan
        ], RestController::HTTP_OK);
    }

    // Edit Profil (Penyewa)
    public function profile_put() {
        $auth = $this->check_auth('penyewa');
        $id_user = $auth['id'];

        $user = $this->User_model->get_user_by_id($id_user);
        if (!$user) {
            $this->response([
                'status' => FALSE,
                'pesan' => 'Pengguna tidak ditemukan'
            ], RestController::HTTP_NOT_FOUND);
        }

        $this->form_validation->set_data($this->put());
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('no_hp', 'Nomor HP', 'numeric|max_length[13]');
        $this->form_validation->set_rules('password', 'Kata Sandi', 'min_length[8]|matches[password_confirm]');
        $this->form_validation->set_rules('password_confirm', 'Konfirmasi Kata Sandi', 'matches[password]');

        if ($this->form_validation->run() === FALSE) {
            $this->response([
                'status' => FALSE,
                'pesan' => validation_errors()
            ], RestController::HTTP_BAD_REQUEST);
        }

        $data = [
            'nama' => $this->put('nama'),
            'username' => $this->put('username'),
            'email' => $this->put('email'),
            'no_hp' => $this->put('no_hp') ?: NULL
        ];

        $password = $this->put('password');
        if (!empty($password)) {
            $data['password'] = password_hash($password, PASSWORD_DEFAULT);
        }

        if ($this->User_model->is_username_taken($data['username'], $id_user)) {
            $this->response([
                'status' => FALSE,
                'pesan' => 'Username sudah digunakan oleh pengguna lain'
            ], RestController::HTTP_BAD_REQUEST);
        }

        if ($this->User_model->is_email_taken($data['email'], $id_user)) {
            $this->response([
                'status' => FALSE,
                'pesan' => 'Email sudah digunakan oleh pengguna lain'
            ], RestController::HTTP_BAD_REQUEST);
        }

        $photo_updated = false;
        if (!empty($_FILES['foto_profil']['name'])) {
            $config['upload_path'] = './uploads/foto_profil/';
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['max_size'] = 2048;
            $config['file_name'] = 'foto_' . $id_user . '_' . time();

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('foto_profil')) {
                $upload_data = $this->upload->data();
                $data['foto_profil'] = $upload_data['file_name'];
                $photo_updated = true;
                if ($user['foto_profil'] && file_exists('./uploads/foto_profil/' . $user['foto_profil'])) {
                    unlink('./uploads/foto_profil/' . $user['foto_profil']);
                }
            } else {
                $this->response([
                    'status' => FALSE,
                    'pesan' => 'Gagal mengunggah foto: ' . $this->upload->display_errors()
                ], RestController::HTTP_BAD_REQUEST);
            }
        }

        $this->db->trans_start();
        if ($this->User_model->update_user($id_user, $data)) {
            $this->db->trans_complete();
            $this->response([
                'status' => TRUE,
                'pesan' => 'Profil berhasil diperbarui'
            ], RestController::HTTP_OK);
        } else {
            $this->db->trans_rollback();
            $this->response([
                'status' => FALSE,
                'pesan' => 'Gagal memperbarui profil'
            ], RestController::HTTP_INTERNAL_ERROR);
        }
    }

    // Validasi Tanggal
    public function valid_date($date) {
        $d = DateTime::createFromFormat('Y-m-d', $date);
        if ($d && $d->format('Y-m-d') === $date && $d >= new DateTime()) {
            return TRUE;
        } else {
            $this->form_validation->set_message('valid_date', 'Tanggal mulai harus valid dan tidak boleh di masa lalu.');
            return FALSE;
        }
    }

    // Validasi Kamar Tersedia
    public function check_kamar_tersedia($str) {
        $jumlah_kamar = $this->input->post('jumlah_kamar') ?: $this->put('jumlah_kamar');
        if ($str > $jumlah_kamar) {
            $this->form_validation->set_message('check_kamar_tersedia', 'Kamar tersedia tidak boleh melebihi jumlah kamar.');
            return FALSE;
        }
        return TRUE;
    }

    // Fungsi Autentikasi Berbasis API Key
    private function check_auth($role) {
        $auth_header = $this->input->get_request_header('Authorization', TRUE);
        if (!$auth_header) {
            $this->response([
                'status' => FALSE,
                'pesan' => 'API Key tidak ditemukan'
            ], RestController::HTTP_UNAUTHORIZED);
        }

        $api_key = str_replace('Bearer ', '', $auth_header);
        $this->db->where('api_key', $api_key);
        $user = $this->db->get('users')->row_array();

        if (!$user) {
            $this->response([
                'status' => FALSE,
                'pesan' => 'API Key tidak valid'
            ], RestController::HTTP_UNAUTHORIZED);
        }

        if ($user['role'] !== $role) {
            $this->response([
                'status' => FALSE,
                'pesan' => 'Akses tidak diizinkan. Role yang diperlukan: ' . $role
            ], RestController::HTTP_UNAUTHORIZED);
        }

        return [
            'id' => $user['id'],
            'username' => $user['username'],
            'role' => $user['role']
        ];
    }
}