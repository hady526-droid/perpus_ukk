<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->_check_login();
        $this->load->model('Laporan_model');
    }

    private function _check_login() {
        if (!$this->session->userdata('logged_in') || $this->session->userdata('role') != 'admin') {
            redirect('auth');
        }
    }

    // ================= HALAMAN LAPORAN =================
    public function index() {
        $tanggal_awal  = $this->input->get('tanggal_awal');
        $tanggal_akhir = $this->input->get('tanggal_akhir');

        $data['title'] = 'Laporan Peminjaman';
        $data['laporan'] = $this->Laporan_model->get_laporan($tanggal_awal, $tanggal_akhir);
        $data['tanggal_awal'] = $tanggal_awal;
        $data['tanggal_akhir'] = $tanggal_akhir;

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar_admin');
        $this->load->view('admin/laporan/index', $data);
        $this->load->view('templates/footer');
    }

    // ================= CETAK =================
    public function cetak() {
        $tanggal_awal  = $this->input->get('tanggal_awal');
        $tanggal_akhir = $this->input->get('tanggal_akhir');

        $data['laporan'] = $this->Laporan_model->get_laporan($tanggal_awal, $tanggal_akhir);
        $data['tanggal_awal'] = $tanggal_awal;
        $data['tanggal_akhir'] = $tanggal_akhir;

        $this->load->view('admin/laporan/cetak', $data);
    }
}