<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct() {
        parent::__construct();

        // Load library session (WAJIB)
        $this->load->library('session');

        // Cek login
        $this->_check_login();

        // Load model dengan alias biar aman
        $this->load->model('Buku_model', 'buku');
        $this->load->model('Anggota_model', 'anggota');
        $this->load->model('Peminjaman_model', 'peminjaman');
    }

    private function _check_login() {
        if (
            !$this->session->userdata('logged_in') ||
            $this->session->userdata('role') !== 'admin'
        ) {
            redirect('auth');
        }
    }

    public function index() {
        $data['title'] = 'Dashboard Admin';

        // Pakai alias model
        $data['total_buku'] = $this->buku->count_all();
        $data['total_anggota'] = $this->anggota->count_all();
        $data['total_peminjaman'] = $this->peminjaman->count_active();
        $data['peminjaman_terbaru'] = $this->peminjaman->get_recent(5);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar_admin', $data);
        $this->load->view('admin/dashboard', $data);
        $this->load->view('templates/footer');
    }
}