<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Batal extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if ($this->session->userdata('masuk') != true) {
            $url = base_url();
            redirect($url);
        }

        role_access();

        $this->load->model('Batal_model');
        $this->load->library('form_validation');
        date_default_timezone_set('Asia/Jakarta');
    }

    public function index()
    {
        $data['db'] = $this->Batal_model->getAllBatal();
        $this->load->view('templates/header');
        $this->load->view('batal/index', $data);
        $this->load->view('templates/footer');
    }

    public function tambah()
    {
        $this->Batal_model->tambahDataBatal();
        $this->session->set_flashdata('flash', 'Ditambahkan');
        redirect('batal');
    }

    public function hapus($id)
    {
        $this->Batal_model->hapusDataBatal($id);
        $this->session->set_flashdata('flash', 'Dihapus');
        redirect('batal');
    }

    public function ubah()
    {
        $this->Batal_model->ubahDataBatal();
        $this->session->set_flashdata('flash', 'Diubah');
        redirect('batal');
    }
}
