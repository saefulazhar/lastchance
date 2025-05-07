<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('logged_in') || $this->session->userdata('role') != 'admin') {
            redirect('auth/login');
        }
    }

    public function index() {
        $this->load->view('templates/header');
        $this->load->view('admin/index');
        $this->load->view('templates/footer');
    }
}