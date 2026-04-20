<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->_check_login();
        $this->load->model('Peminjaman_model');
        $this->load->model('Buku_model');
        $this->load->model('Anggota_model');
    }

    private function _check_login() {
        if (!$this->session->userdata('logged_in') || $this->session->userdata('role') != 'admin') {
            redirect('auth');
        }
    }

    // ================= INDEX + FILTER =================
    public function index() {
        $data['title'] = 'Kelola Transaksi';

        $keyword = $this->input->get('keyword');
        $status  = $this->input->get('status');
        $tanggal = $this->input->get('tanggal');

        $data['keyword'] = $keyword;
        $data['status']  = $status;
        $data['tanggal'] = $tanggal;

        if ($keyword || $status || $tanggal) {
            $data['transaksi'] = $this->Peminjaman_model->get_filtered($keyword, $status, $tanggal);
        } else {
            $data['transaksi'] = $this->Peminjaman_model->get_all_with_detail();
        }

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar_admin', $data);
        $this->load->view('admin/transaksi/index', $data);
        $this->load->view('templates/footer');
    }

    // ================= CETAK =================
    public function cetak() {
        $keyword = $this->input->get('keyword');
        $status  = $this->input->get('status');
        $tanggal = $this->input->get('tanggal');

        $data['transaksi'] = $this->Peminjaman_model->get_filtered($keyword, $status, $tanggal);

        $this->load->view('admin/transaksi/cetak', $data);
    }
// ================= EXPORT PDF =================
public function pdf() {

    $this->load->library('pdf');

    $keyword = $this->input->get('keyword');
    $status  = $this->input->get('status');
    $tanggal = $this->input->get('tanggal');

    $data['transaksi'] = $this->Peminjaman_model->get_filtered($keyword, $status, $tanggal);

    // ambil HTML dari view
    $html = $this->load->view('admin/transaksi/pdf', $data, true);

    // 🔥 PAKAI METHOD generate()
    $this->pdf->generate($html, 'laporan_transaksi.pdf');
}
   // ================= TAMBAH =================
    public function tambah() {
        $this->form_validation->set_rules('id_anggota', 'Anggota', 'required');
        $this->form_validation->set_rules('id_buku', 'Buku', 'required');
        $this->form_validation->set_rules('tanggal_pinjam', 'Tanggal Pinjam', 'required');
        $this->form_validation->set_rules('tanggal_kembali', 'Tanggal Kembali', 'required');

        if ($this->form_validation->run() == FALSE) {

            $data['title'] = 'Tambah Transaksi';
            $data['anggota'] = $this->Anggota_model->get_all();
            $data['buku'] = $this->Buku_model->get_available();

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_admin', $data);
            $this->load->view('admin/transaksi/tambah', $data);
            $this->load->view('templates/footer');

        } else {

            $id_buku = $this->input->post('id_buku');

            $buku = $this->Buku_model->get_by_id($id_buku);
            if ($buku['stok'] < 1) {
                $this->session->set_flashdata('error', 'Stok buku tidak tersedia!');
                redirect('transaksi/tambah');
            }

            $data = [
                'id_anggota'      => $this->input->post('id_anggota'),
                'id_buku'         => $id_buku,
                'tanggal_pinjam'  => $this->input->post('tanggal_pinjam'),
                'tanggal_kembali' => $this->input->post('tanggal_kembali'),
                'status'          => 'dipinjam'
            ];

            $this->Peminjaman_model->insert($data);

            $this->Buku_model->update($id_buku, [
                'stok' => $buku['stok'] - 1
            ]);

            $this->session->set_flashdata('success', 'Transaksi berhasil ditambahkan!');
            redirect('transaksi');
        }
    }

    // ================= DETAIL =================
    public function detail($id) {
        $data['title'] = 'Detail Transaksi';
        $data['transaksi'] = $this->Peminjaman_model->get_by_id_with_detail($id);

        if (!$data['transaksi']) {
            show_404();
        }

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar_admin', $data);
        $this->load->view('admin/transaksi/detail', $data);
        $this->load->view('templates/footer');
    }

    // ================= KONFIRMASI =================
    public function konfirmasi($id) {
        $transaksi = $this->Peminjaman_model->get_by_id($id);

        if (!$transaksi) {
            show_404();
        }

        $today = date('Y-m-d');
        $denda = 0;

        if (strtotime($today) > strtotime($transaksi['tanggal_kembali'])) {
            $diff = (strtotime($today) - strtotime($transaksi['tanggal_kembali'])) / (60 * 60 * 24);
            $denda = $diff * 1000;
        }

        $this->Peminjaman_model->update($id, [
            'status' => 'dikembalikan',
            'tanggal_dikembalikan' => $today,
            'denda' => $denda
        ]);

        $buku = $this->Buku_model->get_by_id($transaksi['id_buku']);
        $this->Buku_model->update($transaksi['id_buku'], [
            'stok' => $buku['stok'] + 1
        ]);

        $this->session->set_flashdata(
            'success',
            'Buku dikembalikan!' . ($denda > 0 ? ' Denda: Rp ' . number_format($denda,0,',','.') : '')
        );

        redirect('transaksi');
    }

    // ================= HAPUS =================
    public function hapus($id) {
        $transaksi = $this->Peminjaman_model->get_by_id($id);

        if (!$transaksi) {
            show_404();
        }

        if ($transaksi['status'] == 'dipinjam') {
            $buku = $this->Buku_model->get_by_id($transaksi['id_buku']);
            $this->Buku_model->update($transaksi['id_buku'], [
                'stok' => $buku['stok'] + 1
            ]);
        }

        $this->Peminjaman_model->delete($id);

        $this->session->set_flashdata('success', 'Transaksi berhasil dihapus!');
        redirect('transaksi');
    }
}