<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dokumen extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if ($this->session->userdata('masuk') != true) {
            $url = base_url();
            redirect($url);
        }

        role_access();
        $this->load->library('form_validation');
        date_default_timezone_set('Asia/Jakarta');
    }

    public function index()
    {
        $data['dokumen'] = $this->Dokumen_model->getAllDokumen();
        $this->load->view('templates/header');
        $this->load->view('dokumen/index', $data);
        $this->load->view('templates/footer');
    }

    public function tambah()
    {
        $this->Dokumen_model->tambahDataDokumen();
        $this->session->set_flashdata('flash', 'Ditambahkan');
        redirect('dokumen');
    }

    public function hapus($id)
    {
        $this->Dokumen_model->hapusDataDokumen($id);
		$this->session->set_flashdata('flash', 'Dihapus');
        redirect('dokumen');
    }

    public function ubah()
    {
        $this->Dokumen_model->ubahDataDokumen();
        $this->session->set_flashdata('flash', 'Diubah');
        redirect('dokumen');
    }
}
