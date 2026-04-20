<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Buku_model extends CI_Model {

    private $table = 'buku';

    public function get_all() {
        $this->db->order_by('judul', 'ASC');
        return $this->db->get($this->table)->result_array();
    }

    public function get_by_id($id) {
        $this->db->where('id', $id);
        return $this->db->get($this->table)->row_array();
    }

    public function get_available() {
        $this->db->where('stok >', 0);
        $this->db->order_by('judul', 'ASC');
        return $this->db->get($this->table)->result_array();
    }

    public function insert($data) {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function update($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update($this->table, $data);
    }

    public function delete($id) {
        $this->db->where('id', $id);
        return $this->db->delete($this->table);
    }

    public function count_all() {
        return $this->db->count_all($this->table);
    }

    // ================= FILTER BARU =================
    public function get_filtered($keyword = null, $kategori = null)
    {
        $this->db->from($this->table);

        // SEARCH (judul & pengarang)
        if (!empty($keyword)) {
            $this->db->group_start();
            $this->db->like('judul', $keyword);
            $this->db->or_like('pengarang', $keyword);
            $this->db->group_end();
        }

        // FILTER KATEGORI
        if (!empty($kategori)) {
            $this->db->where('kategori', $kategori);
        }

        $this->db->order_by('judul', 'ASC');
        return $this->db->get()->result_array();
    }

    // AMBIL LIST KATEGORI (UNIK)
    public function get_kategori()
    {
        $this->db->select('kategori');
        $this->db->group_by('kategori');
        return $this->db->get($this->table)->result_array();
    }
}