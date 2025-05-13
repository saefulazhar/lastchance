<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
        if (!$this->session->userdata('logged_in') || $this->session->userdata('role') != 'admin') {
            redirect('auth/login');
        }
    }

    public function index() {
        $this->load->view('templates/header');
        $this->load->view('admin/index');
        $this->load->view('templates/footer');
    }

    public function users() {
        $data['users'] = $this->User_model->get_all_users();
        $this->load->view('templates/header');
        $this->load->view('admin/users', $data);
        $this->load->view('templates/footer');
    }

    public function delete_user($id) {
        $this->User_model->delete_user($id);
        $this->session->set_flashdata('success', 'Pengguna berhasil dihapus.');
        redirect('admin/users');
    }

    public function edit_user($id) {
        $user = $this->User_model->get_user_by_id($id);
        if (!$user) {
            $this->session->set_flashdata('error', 'Pengguna tidak ditemukan.');
            redirect('admin/users');
        }
        $data['user'] = $user;
        $this->load->view('templates/header');
        $this->load->view('admin/edit_user', $data);
        $this->load->view('templates/footer');
    }

    public function update_user() {
        $id = $this->input->post('id');
        $user = $this->User_model->get_user_by_id($id);
        if (!$user) {
            $this->session->set_flashdata('error', 'Pengguna tidak ditemukan.');
            redirect('admin/users');
        }

        // Validasi hanya untuk field yang diisi
        $nama = $this->input->post('nama');
        $username = $this->input->post('username');
        $email = $this->input->post('email');
        $no_hp = $this->input->post('no_hp');
        $role = $this->input->post('role');
        $password = $this->input->post('password');
        $konfirmasi_password = $this->input->post('konfirmasi_password');

        // Validasi role (wajib)
        $this->form_validation->set_rules('role', 'Role', 'required|in_list[pemilik,penyewa]');

        // Validasi field yang diisi
        if ($nama !== '') {
            $this->form_validation->set_rules('nama', 'Nama', 'required');
        }
        if ($username !== '') {
            $this->form_validation->set_rules('username', 'Username', 'required|callback_username_check');
        }
        if ($email !== '') {
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email|callback_email_check');
        }
        if ($password || $konfirmasi_password) {
            $this->form_validation->set_rules('password', 'Password', 'required');
            $this->form_validation->set_rules('konfirmasi_password', 'Konfirmasi Password', 'required|matches[password]');
        }

        if ($this->form_validation->run() === FALSE) {
            $data['user'] = $user;
            $this->load->view('templates/header');
            $this->load->view('admin/edit_user', $data);
            $this->load->view('templates/footer');
        } else {
            // Hanya masukkan field yang diisi ke array data
            $data = [];
            if ($nama !== '') {
                $data['nama'] = $nama;
            }
            if ($username !== '') {
                $data['username'] = $username;
            }
            if ($email !== '') {
                $data['email'] = $email;
            }
            if ($no_hp !== '') {
                $data['no_hp'] = $no_hp;
            }
            $data['role'] = $role; // Role selalu diisi karena wajib

            if ($password) {
                $data['password'] = password_hash($password, PASSWORD_BCRYPT);
            }

            if ($_FILES['foto_profil']['name']) {
                $config['upload_path'] = './uploads/profile/';
                $config['allowed_types'] = 'jpg|jpeg|png';
                $config['max_size'] = 2048; // 2MB
                $this->load->library('upload', $config);

                if ($this->upload->do_upload('foto_profil')) {
                    $upload_data = $this->upload->data();
                    $data['foto_profil'] = $upload_data['file_name'];
                    // Hapus foto lama jika ada
                    if ($user['foto_profil'] && file_exists('./uploads/profile/' . $user['foto_profil'])) {
                        unlink('./uploads/profile/' . $user['foto_profil']);
                    }
                } else {
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    $data['user'] = $user;
                    $this->load->view('templates/header');
                    $this->load->view('admin/edit_user', $data);
                    $this->load->view('templates/footer');
                    return;
                }
            }

            if (!empty($data)) {
                $this->User_model->update_user($id, $data);
                $this->session->set_flashdata('success', 'Pengguna berhasil diperbarui.');
            } else {
                $this->session->set_flashdata('success', 'Tidak ada perubahan yang disimpan.');
            }
            redirect('admin/users');
        }
    }

    public function username_check($str) {
        $id = $this->input->post('id');
        $user = $this->User_model->get_user_by_username($str);
        if ($user && $user['id'] != $id) {
            $this->form_validation->set_message('username_check', 'Username sudah digunakan.');
            return FALSE;
        }
        return TRUE;
    }

    public function email_check($str) {
        $id = $this->input->post('id');
        $user = $this->User_model->get_user_by_email($str);
        if ($user && $user['id'] != $id) {
            $this->form_validation->set_message('email_check', 'Email sudah digunakan.');
            return FALSE;
        }
        return TRUE;
    }

}