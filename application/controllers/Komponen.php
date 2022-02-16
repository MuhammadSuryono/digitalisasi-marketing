<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Komponen extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if ($this->session->userdata('masuk') != true) {
            $url = base_url();
            redirect($url);
        }

        role_access();

        $this->load->model('Komponen_model');
        $this->load->library('form_validation');
        date_default_timezone_set('Asia/Jakarta');
    }

    public function index()
    {
        $data['komponen'] = $this->Komponen_model->getAllKomponen();
        $this->load->view('templates/header');
        $this->load->view('komponen/index', $data);
        $this->load->view('templates/footer');
    }

    public function tambah()
    {
            $this->Komponen_model->tambahDataKomponen();
            $this->session->set_flashdata('flash', 'Ditambahkan');
            redirect('komponen');
    }

    public function hapus($id)
    {
        $this->Komponen_model->hapusDataKomponen($id);
		$this->session->set_flashdata('flash', 'Dihapus');
        redirect('komponen');
    }

    public function ubah()
    {
            $this->Kota_model->ubahDataKota();
            $this->session->set_flashdata('flash', 'Diubah');
            redirect('kota');
        
    }
}
