<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jabatan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if ($this->session->userdata('masuk') != true) {
            $url = base_url();
            redirect($url);
        }

        role_access();

        $this->load->model('Jabatan_model');
        $this->load->library('form_validation');
        date_default_timezone_set('Asia/Jakarta');
    }

    public function index()
    {
        $data['jabatan'] = $this->Jabatan_model->getAllJabatan();
        $this->load->view('templates/header');
        $this->load->view('jabatan/index', $data);
        $this->load->view('templates/footer');
    }

    public function tambah()
    {
            $datacek = $this->Jabatan_model->tambahDataJabatan();

            if ($datacek != 1){
                $this->session->set_flashdata('flash', 'Gagal ditambahkan, jabatan sudah terdaftar');
            } else {
                 $this->session->set_flashdata('flash', 'Ditambahkan');
            }
        
        redirect('jabatan');
    }

    public function hapus($id)
    {
        $this->Jabatan_model->hapusDataJabatan($id);
		$this->session->set_flashdata('flash', 'Dihapus');
        redirect('jabatan');
    }

    public function ubah()
    {
        $datacek = $this->Jabatan_model->ubahDataJabatan();
        if ($datacek != 1){
                $this->session->set_flashdata('flash', 'Gagal ditambahkan, jabatan sudah terdaftar');
            } else {
                 $this->session->set_flashdata('flash', 'Ditambahkan');
            }
        redirect('jabatan');
    }
}
