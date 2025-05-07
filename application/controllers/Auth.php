<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->library('form_validation');
        $this->load->helper('url');
    }

    public function login() {
        if ($this->session->userdata('logged_in')) {
            redirect($this->session->userdata('role') == 'admin' ? 'admin' : ($this->session->userdata('role') == 'pemilik' ? 'pemilik' : 'penyewa'));
        }

        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header');
            $this->load->view('auth/login');
            $this->load->view('templates/footer');
        } else {
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $user = $this->User_model->get_user_by_username($username);

            if ($user && password_verify($password, $user['password'])) {
                $session_data = array(
                    'logged_in' => TRUE,
                    'username' => $user['username'],
                    'user_id' => $user['id'],
                    'role' => $user['role'],
                    'foto_profil' => $user['foto_profil']
                );
                $this->session->set_userdata($session_data);
                redirect($user['role'] == 'admin' ? 'admin' : ($user['role'] == 'pemilik' ? 'pemilik' : 'penyewa'));
            } else {
                $this->session->set_flashdata('error', 'Username atau password salah.');
                $this->load->view('templates/header');
                $this->load->view('auth/login');
                $this->load->view('templates/footer');
            }
        }
    }

    public function register() {
        if ($this->session->userdata('logged_in')) {
            redirect('home');
        }

        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('username', 'Username', 'required|is_unique[users.username]');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('no_hp', 'No HP', 'trim|numeric|max_length[15]');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
        $this->form_validation->set_rules('konfirmasi_password', 'Konfirmasi Password', 'required|matches[password]');
        $this->form_validation->set_rules('role', 'Role', 'required|in_list[pemilik,penyewa]');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header');
            $this->load->view('auth/register');
            $this->load->view('templates/footer');
        } else {
            $upload_path = FCPATH . 'uploads/profile/';
            if (!is_dir($upload_path)) {
                $created = mkdir($upload_path, 0777, TRUE);
                if (!$created) {
                    $this->session->set_flashdata('error', 'Gagal membuat direktori upload. Periksa izin folder atau buat manually: ' . $upload_path);
                    $this->load->view('templates/header');
                    $this->load->view('auth/register');
                    $this->load->view('templates/footer');
                    return;
                }
                chmod($upload_path, 0777);
            }

            if (!is_writable($upload_path)) {
                $this->session->set_flashdata('error', 'Direktori upload tidak dapat ditulis. Periksa izin folder: ' . $upload_path);
                $this->load->view('templates/header');
                $this->load->view('auth/register');
                $this->load->view('templates/footer');
                return;
            }

            $config['upload_path'] = $upload_path;
            $config['allowed_types'] = 'jpg|png|jpeg';
            $config['max_size'] = 2048; // 2MB
            $config['encrypt_name'] = TRUE;
            $config['file_ext_tolower'] = TRUE;

            $this->load->library('upload', $config);

            $foto_profil = 'default-profile.png';
            if ($_FILES['foto_profil']['name']) {
                if ($this->upload->do_upload('foto_profil')) {
                    $upload_data = $this->upload->data();
                    $foto_profil = $upload_data['file_name'];
                } else {
                    $this->session->set_flashdata('error', 'Gagal upload foto: ' . $this->upload->display_errors());
                    $this->load->view('templates/header');
                    $this->load->view('auth/register');
                    $this->load->view('templates/footer');
                    return;
                }
            }

            $data = array(
                'nama' => $this->input->post('nama'),
                'username' => $this->input->post('username'),
                'email' => $this->input->post('email'),
                'no_hp' => $this->input->post('no_hp'),
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'role' => $this->input->post('role'),
                'foto_profil' => $foto_profil
            );
            $this->User_model->insert_user($data);
            $this->session->set_flashdata('success', 'Registrasi berhasil. Silakan login.');
            redirect('auth/login');
        }
    }

    public function logout() {
        $this->session->unset_userdata('logged_in');
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('user_id');
        $this->session->unset_userdata('role');
        $this->session->unset_userdata('foto_profil');
        $this->session->sess_destroy();
        redirect('home');
    }
}