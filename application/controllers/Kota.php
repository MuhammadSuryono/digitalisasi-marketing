<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kota extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if ($this->session->userdata('masuk') != true) {
            $url = base_url();
            redirect($url);
        }

        role_access();

        $this->load->model('Kota_model');
        $this->load->library('form_validation');
        date_default_timezone_set('Asia/Jakarta');
    }

    public function index()
    {
        $data['kota'] = $this->Kota_model->getAllKota();
        $this->load->view('templates/header');
        $this->load->view('kota/index', $data);
        $this->load->view('templates/footer');
    }

    public function tambah()
    {
            $datacek = $this->Kota_model->tambahDataKota();

            if ($datacek != 1){
                $this->session->set_flashdata('flash', 'Gagal ditambahkan, kota sudah terdaftar');
            } else {
                 $this->session->set_flashdata('flash', 'Ditambahkan');
            }
            redirect('kota');
    }

    public function hapus($id)
    {
        $this->Kota_model->hapusDataKota($id);
		$this->session->set_flashdata('flash', 'Dihapus');
        redirect('kota');
    }

    public function ubah()
    {
            $datacek = $this->Kota_model->ubahDataKota();

             if ($datacek != 1){
                $this->session->set_flashdata('flash', 'Gagal ditambahkan, kota sudah terdaftar');
            } else {
                 $this->session->set_flashdata('flash', 'Ditambahkan');
            }
            redirect('kota');
        
    }
}
