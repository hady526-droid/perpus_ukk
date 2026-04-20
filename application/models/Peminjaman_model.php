<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Peminjaman_model extends CI_Model {

    private $table = 'peminjaman';

    // ================= GET ALL =================
    public function get_all() {
        return $this->db
            ->order_by('created_at', 'DESC')
            ->get($this->table)
            ->result_array();
    }

    // ================= GET ALL + JOIN =================
    public function get_all_with_detail() {
        return $this->db
            ->select('peminjaman.*, buku.judul, buku.kode_buku, anggota.nama, anggota.nis')
            ->from($this->table)
            ->join('buku', 'buku.id = peminjaman.id_buku')
            ->join('anggota', 'anggota.id = peminjaman.id_anggota')
            ->order_by('peminjaman.created_at', 'DESC')
            ->get()
            ->result_array();
    }

    // ================= FILTER (SUPER LENGKAP) =================
    public function get_filtered($keyword = null, $status = null, $tanggal = null)
    {
        $this->db->select('peminjaman.*, buku.judul, buku.kode_buku, anggota.nama, anggota.nis');
        $this->db->from($this->table);
        $this->db->join('buku', 'buku.id = peminjaman.id_buku');
        $this->db->join('anggota', 'anggota.id = peminjaman.id_anggota');

        // 🔍 SEARCH
        if (!empty($keyword)) {
            $this->db->group_start();
            $this->db->like('anggota.nama', $keyword);
            $this->db->or_like('anggota.nis', $keyword);
            $this->db->or_like('buku.judul', $keyword);
            $this->db->group_end();
        }

        // 🎯 STATUS
        if (!empty($status)) {
            $this->db->where('peminjaman.status', $status);
        }

        // 📅 TANGGAL PINJAM
        if (!empty($tanggal)) {
            $this->db->where('DATE(peminjaman.tanggal_pinjam)', $tanggal);
        }

        $this->db->order_by('peminjaman.created_at', 'DESC');

        return $this->db->get()->result_array();
    }

    // ================= GET BY ID =================
    public function get_by_id($id) {
        return $this->db
            ->where('id', $id)
            ->get($this->table)
            ->row_array();
    }

    // ================= DETAIL =================
    public function get_by_id_with_detail($id) {
        return $this->db
            ->select('peminjaman.*, buku.judul, buku.kode_buku, buku.pengarang, anggota.nama, anggota.nis, anggota.kelas')
            ->from($this->table)
            ->join('buku', 'buku.id = peminjaman.id_buku')
            ->join('anggota', 'anggota.id = peminjaman.id_anggota')
            ->where('peminjaman.id', $id)
            ->get()
            ->row_array();
    }

    // ================= PER ANGGOTA =================
    public function get_by_anggota($id_anggota, $limit = null) {
        $this->db->where('id_anggota', $id_anggota);
        $this->db->order_by('created_at', 'DESC');

        if ($limit) {
            $this->db->limit($limit);
        }

        return $this->db->get($this->table)->result_array();
    }

    public function get_by_anggota_with_detail($id_anggota) {
        return $this->db
            ->select('peminjaman.*, buku.judul, buku.kode_buku, buku.pengarang')
            ->from($this->table)
            ->join('buku', 'buku.id = peminjaman.id_buku')
            ->where('peminjaman.id_anggota', $id_anggota)
            ->order_by('peminjaman.created_at', 'DESC')
            ->get()
            ->result_array();
    }

    // ================= RECENT =================
    public function get_recent($limit = 5) {
        return $this->db
            ->select('peminjaman.*, buku.judul, anggota.nama')
            ->from($this->table)
            ->join('buku', 'buku.id = peminjaman.id_buku')
            ->join('anggota', 'anggota.id = peminjaman.id_anggota')
            ->order_by('peminjaman.created_at', 'DESC')
            ->limit($limit)
            ->get()
            ->result_array();
    }

    // ================= CEK PINJAMAN =================
    public function check_existing($id_anggota, $id_buku) {
        return $this->db
            ->where('id_anggota', $id_anggota)
            ->where('id_buku', $id_buku)
            ->where('status', 'dipinjam')
            ->get($this->table)
            ->row_array();
    }

    // ================= CRUD =================
    public function insert($data) {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function update($id, $data) {
        return $this->db
            ->where('id', $id)
            ->update($this->table, $data);
    }

    public function delete($id) {
        return $this->db
            ->where('id', $id)
            ->delete($this->table);
    }

    // ================= COUNT =================
    public function count_all() {
        return $this->db->count_all($this->table);
    }

    public function count_active() {
        return $this->db
            ->where('status', 'dipinjam')
            ->count_all_results($this->table);
    }

    public function count_by_anggota($id_anggota) {
        return $this->db
            ->where('id_anggota', $id_anggota)
            ->count_all_results($this->table);
    }

    public function count_active_by_anggota($id_anggota) {
        return $this->db
            ->where('id_anggota', $id_anggota)
            ->where('status', 'dipinjam')
            ->count_all_results($this->table);
    }
}