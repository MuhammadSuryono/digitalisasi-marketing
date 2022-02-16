<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MataUang extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if ($this->session->userdata('masuk') != true) {
            $url = base_url();
            redirect($url);
        }

        role_access();

        $this->load->model('MataUang_model');
        $this->load->library('form_validation');
        date_default_timezone_set('Asia/Jakarta');
    }

    public function index()
    {
        $data['db'] = $this->MataUang_model->getAllMataUang();
        $this->load->view('templates/header');
        $this->load->view('matauang/index', $data);
        $this->load->view('templates/footer');
    }

    public function tambah()
    {
        $this->MataUang_model->tambahMataUang();
        $this->session->set_flashdata('flash', 'Ditambahkan');
        redirect('mataUang');
    }

    public function hapus($id)
    {
        $this->MataUang_model->hapusMataUang($id);
        $this->session->set_flashdata('flash', 'Dihapus');
        redirect('mataUang');
    }

    public function ubah()
    {
        $this->MataUang_model->ubahMataUang();
        $this->session->set_flashdata('flash', 'Diubah');
        redirect('mataUang');
    }
}
