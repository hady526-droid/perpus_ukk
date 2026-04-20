<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Anggota extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->_check_login();

        $this->load->model('Anggota_model');
        $this->load->library(['form_validation', 'upload']);
        $this->load->helper(['url', 'form']);
    }

    private function _check_login() {
        if (!$this->session->userdata('logged_in') || $this->session->userdata('role') != 'admin') {
            redirect('auth');
        }
    }

    // ================= INDEX =================
    public function index() {
        $keyword = $this->input->get('keyword');

        $data['title'] = 'Kelola Data Anggota';
        $data['anggota'] = $this->Anggota_model->get_filtered($keyword);
        $data['keyword'] = $keyword;

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar_admin', $data);
        $this->load->view('admin/anggota/index', $data);
        $this->load->view('templates/footer');
    }

    // ================= TAMBAH =================
    public function tambah() {

        $this->form_validation->set_rules('nis', 'NIS', 'required|trim|is_unique[anggota.nis]');
        $this->form_validation->set_rules('nama', 'Nama', 'required|trim');
        $this->form_validation->set_rules('kelas', 'Kelas', 'required|trim');

        if ($this->form_validation->run() == FALSE) {

            $data['title'] = 'Tambah Anggota';

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_admin', $data);
            $this->load->view('admin/anggota/tambah', $data);
            $this->load->view('templates/footer');

        } else {

            // ================= UPLOAD FOTO =================
            $foto = 'default.png';

            if (!empty($_FILES['foto']['name'])) {

                $config['upload_path']   = './uploads/';
                $config['allowed_types'] = 'jpg|jpeg|png';
                $config['max_size']      = 2048;
                $config['file_name']     = 'user_' . time();

                $this->upload->initialize($config);

                if ($this->upload->do_upload('foto')) {
                    $foto = $this->upload->data('file_name');
                }
            }

            // ================= SIMPAN ANGGOTA =================
            $data_anggota = [
                'nis'      => $this->input->post('nis', TRUE),
                'nama'     => $this->input->post('nama', TRUE),
                'kelas'    => $this->input->post('kelas', TRUE),
                'alamat'   => $this->input->post('alamat', TRUE),
                'telepon'  => $this->input->post('telepon', TRUE),
                'foto'     => $foto
            ];

            $this->db->insert('anggota', $data_anggota);
            $id_anggota = $this->db->insert_id();

            if (!$id_anggota) {
                $this->session->set_flashdata('error', 'Gagal simpan anggota!');
                redirect('anggota/tambah');
            }

            // ================= BUAT USER =================
            $data_user = [
                'username'   => $this->input->post('nis', TRUE),
                'password'   => password_hash('siswa123', PASSWORD_DEFAULT),
                'role'       => 'siswa',
                'id_anggota' => $id_anggota
            ];

            $this->db->insert('users', $data_user);

            $this->session->set_flashdata('success', 'Anggota berhasil ditambahkan! Password: siswa123');
            redirect('anggota');
        }
    }

    // ================= EDIT =================
    public function edit($id) {

        $data['anggota'] = $this->Anggota_model->get_by_id($id);

        if (!$data['anggota']) {
            show_404();
        }

        $this->form_validation->set_rules('nama', 'Nama', 'required|trim');
        $this->form_validation->set_rules('kelas', 'Kelas', 'required|trim');

        if ($this->form_validation->run() == FALSE) {

            $data['title'] = 'Edit Anggota';

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_admin', $data);
            $this->load->view('admin/anggota/edit', $data);
            $this->load->view('templates/footer');

        } else {

            $update_data = [
                'nama'     => $this->input->post('nama', TRUE),
                'kelas'    => $this->input->post('kelas', TRUE),
                'alamat'   => $this->input->post('alamat', TRUE),
                'telepon'  => $this->input->post('telepon', TRUE)
            ];

            // UPDATE FOTO JIKA ADA
            if (!empty($_FILES['foto']['name'])) {

                $config['upload_path']   = './uploads/';
                $config['allowed_types'] = 'jpg|jpeg|png';
                $config['file_name']     = 'user_' . time();

                $this->upload->initialize($config);

                if ($this->upload->do_upload('foto')) {
                    $update_data['foto'] = $this->upload->data('file_name');
                }
            }

            $this->Anggota_model->update($id, $update_data);

            $this->session->set_flashdata('success', 'Anggota berhasil diupdate!');
            redirect('anggota');
        }
    }

    // ================= HAPUS =================
    public function hapus($id) {

        $anggota = $this->Anggota_model->get_by_id($id);

        if (!$anggota) {
            show_404();
        }

        // hapus user terkait
        $this->db->where('id_anggota', $id);
        $this->db->delete('users');

        // hapus anggota
        $this->Anggota_model->delete($id);

        $this->session->set_flashdata('success', 'Anggota berhasil dihapus!');
        redirect('anggota');
    }

    // ================= CETAK KARTU =================
    public function cetak_kartu($id)
    {
        $data['anggota'] = $this->Anggota_model->get_by_id($id);

        if (!$data['anggota']) {
            show_404();
        }

        $this->load->view('admin/anggota/cetak_kartu', $data);
    }
}