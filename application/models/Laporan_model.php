<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Laporan_model');
        $this->load->helper('download');
    }

    public function index()
    {
        $data['transaksi'] = $this->Laporan_model->get_laporan();
        $this->load->view('laporan_view', $data);
    }

    public function filter()
    {
        $tanggal_awal  = $this->input->get('tanggal_awal');
        $tanggal_akhir = $this->input->get('tanggal_akhir');

        $data['transaksi'] = $this->Laporan_model->get_laporan($tanggal_awal, $tanggal_akhir);
        $data['tanggal_awal'] = $tanggal_awal;
        $data['tanggal_akhir'] = $tanggal_akhir;

        $this->load->view('laporan_view', $data);
    }

    public function export_excel()
    {
        $tanggal_awal  = $this->input->get('tanggal_awal');
        $tanggal_akhir = $this->input->get('tanggal_akhir');

        $data['transaksi'] = $this->Laporan_model->get_laporan($tanggal_awal, $tanggal_akhir);

        $this->load->view('laporan_excel', $data);
    }

    public function export_pdf()
    {
        $this->load->library('pdf');

        $tanggal_awal  = $this->input->get('tanggal_awal');
        $tanggal_akhir = $this->input->get('tanggal_akhir');

        $data['transaksi'] = $this->Laporan_model->get_laporan($tanggal_awal, $tanggal_akhir);
        $data['tanggal_awal'] = $tanggal_awal;
        $data['tanggal_akhir'] = $tanggal_akhir;

        $html = $this->load->view('laporan_pdf', $data, true);

        $this->pdf->create($html, 'laporan_transaksi_' . date('Ymd') . '.pdf');
    }
}