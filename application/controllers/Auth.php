<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('Auth_model');
        $this->load->library(['session', 'form_validation']);
        $this->load->helper(['url', 'form']);
        $this->load->database(); // 🔥 WAJIB
    }

    // ================= LOGIN PAGE =================
    public function index() {

        if ($this->session->userdata('logged_in')) {
            redirect($this->session->userdata('role') == 'admin' ? 'admin' : 'siswa');
        }

        $this->load->view('auth/login');
    }

    // ================= PROSES LOGIN =================
    public function login() {

        $this->form_validation->set_rules('username', 'Username', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');

        if ($this->form_validation->run() == FALSE) {

            $this->load->view('auth/login');

        } else {

            $username = $this->input->post('username', TRUE);
            $password = $this->input->post('password', TRUE);

            $user = $this->Auth_model->get_by_username($username);

            if ($user && password_verify($password, $user['password'])) {

                $this->session->set_userdata([
                    'user_id'    => $user['id'],
                    'username'   => $user['username'],
                    'role'       => $user['role'],
                    'id_anggota' => $user['id_anggota'],
                    'logged_in'  => TRUE
                ]);

                redirect($user['role'] == 'admin' ? 'admin' : 'siswa');

            } else {
                $this->session->set_flashdata('error', 'Username / Password salah!');
                redirect('auth');
            }
        }
    }

    // ================= REGISTER =================
    public function register() {

        $this->form_validation->set_rules('nis', 'NIS', 'required|trim|is_unique[anggota.nis]');
        $this->form_validation->set_rules('nama', 'Nama', 'required|trim');
        $this->form_validation->set_rules('kelas', 'Kelas', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
        $this->form_validation->set_rules('password_confirm', 'Konfirmasi Password', 'required|matches[password]');

        if ($this->form_validation->run() == FALSE) {

            $this->load->view('auth/register');

        } else {

            // SIMPAN ANGGOTA
            $data_anggota = [
                'nis'      => $this->input->post('nis', TRUE),
                'nama'     => $this->input->post('nama', TRUE),
                'kelas'    => $this->input->post('kelas', TRUE),
                'alamat'   => $this->input->post('alamat', TRUE),
                'telepon'  => $this->input->post('telepon', TRUE)
            ];

            $this->db->insert('anggota', $data_anggota);
            $id_anggota = $this->db->insert_id();

            if (!$id_anggota) {
                $this->session->set_flashdata('error', 'Gagal simpan anggota!');
                redirect('auth/register');
            }

            // SIMPAN USER
            $data_user = [
                'username'   => $this->input->post('nis', TRUE),
                'password'   => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'role'       => 'siswa',
                'id_anggota' => $id_anggota
            ];

            $this->db->insert('users', $data_user);

            $this->session->set_flashdata('success', 'Registrasi berhasil! Silakan login.');
            redirect('auth');
        }
    }

    // ================= LOGOUT =================
    public function logout() {
        $this->session->sess_destroy();
        redirect('auth');
    }
}