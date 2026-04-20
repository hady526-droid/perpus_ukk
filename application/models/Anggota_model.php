<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Anggota_model extends CI_Model {

    private $table = 'anggota';

    // ================= GET ALL =================
    public function get_all() {
        $this->db->order_by('nama', 'ASC');
        return $this->db->get($this->table)->result_array();
    }

    // ================= GET BY ID =================
    public function get_by_id($id) {
        $this->db->where('id', $id);
        return $this->db->get($this->table)->row_array();
    }

    // ================= GET BY NIS =================
    public function get_by_nis($nis) {
        $this->db->where('nis', $nis);
        return $this->db->get($this->table)->row_array();
    }

    // ================= INSERT =================
    public function insert($data) {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    // ================= UPDATE =================
    public function update($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update($this->table, $data);
    }

    // ================= DELETE =================
    public function delete($id) {
        $this->db->where('id', $id);
        return $this->db->delete($this->table);
    }

    // ================= COUNT =================
    public function count_all() {
        return $this->db->count_all($this->table);
    }

    // ================= FILTER (TANPA JK) =================
    public function get_filtered($keyword = null)
    {
        $this->db->from($this->table);

        // SEARCH nama / nis / email (kalau ada)
        if (!empty($keyword)) {
            $this->db->group_start();
            $this->db->like('nama', $keyword);
            $this->db->or_like('nis', $keyword);

            // email opsional (kalau ada di database)
            if ($this->db->field_exists('email', $this->table)) {
                $this->db->or_like('email', $keyword);
            }

            $this->db->group_end();
        }

        $this->db->order_by('nama', 'ASC');

        return $this->db->get()->result_array();
    }
}