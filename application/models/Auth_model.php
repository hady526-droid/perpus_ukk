<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_model extends CI_Model {

    private $table_users   = 'users';
    private $table_anggota = 'anggota';

    // ================= LOGIN =================
    public function get_by_username($username)
    {
        return $this->db
            ->where('username', $username)
            ->get($this->table_users)
            ->row_array();
    }

    // ================= REGISTER ANGGOTA =================
    public function register_anggota($data)
    {
        $this->db->insert($this->table_anggota, $data);
        return $this->db->insert_id();
    }

    // ================= REGISTER USER =================
    public function register_user($data)
    {
        return $this->db->insert($this->table_users, $data);
    }

    // ================= CEK USERNAME =================
    public function check_username($username)
    {
        return $this->db
            ->where('username', $username)
            ->get($this->table_users)
            ->row_array();
    }

    // ================= GET USER BY ID =================
    public function get_user_by_id($id)
    {
        return $this->db
            ->where('id', $id)
            ->get($this->table_users)
            ->row_array();
    }

    // ================= GET ANGGOTA BY ID =================
    public function get_anggota_by_id($id)
    {
        return $this->db
            ->where('id', $id)
            ->get($this->table_anggota)
            ->row_array();
    }

    // ================= JOIN USER + ANGGOTA =================
    public function get_user_with_anggota($id_user)
    {
        return $this->db
            ->select('users.*, anggota.nama, anggota.nis, anggota.kelas, anggota.alamat, anggota.telepon')
            ->from($this->table_users)
            ->join($this->table_anggota, 'anggota.id = users.id_anggota', 'left')
            ->where('users.id', $id_user)
            ->get()
            ->row_array();
    }

    // ================= UPDATE PASSWORD =================
    public function update_password($id, $password)
    {
        return $this->db
            ->where('id', $id)
            ->update($this->table_users, [
                'password' => password_hash($password, PASSWORD_DEFAULT)
            ]);
    }

    // ================= COUNT USER =================
    public function count_users()
    {
        return $this->db->count_all($this->table_users);
    }

}