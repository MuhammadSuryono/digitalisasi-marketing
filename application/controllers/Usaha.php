<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Usaha extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if ($this->session->userdata('masuk') != true) {
            $url = base_url();
            redirect($url);
        }

        role_access();

        $this->load->model('Usaha_model');
        $this->load->library('form_validation');
        date_default_timezone_set('Asia/Jakarta');
    }

    public function index()
    {
        $data['usaha'] = $this->Usaha_model->getAllUsaha();
        $this->load->view('templates/header');
        $this->load->view('usaha/index', $data);
        $this->load->view('templates/footer');
    }

    public function tambah()
    {
        $datacek = $this->Usaha_model->tambahDataUsaha();
        if ($datacek != 1){
                $this->session->set_flashdata('flash', 'Gagal ditambahkan, bidang usaha sudah terdaftar');
            } else {
                 $this->session->set_flashdata('flash', 'Ditambahkan');
            }
        redirect('usaha');
    }

    public function hapus($id)
    {
        $this->Usaha_model->hapusDataUsaha($id);
		$this->session->set_flashdata('flash', 'Dihapus');
        redirect('usaha');
    }

    public function ubah()
    {
        $datacek = $this->Usaha_model->ubahDataUsaha();
        if ($datacek != 1){
                $this->session->set_flashdata('flash', 'Gagal ditambahkan, bidang usaha sudah terdaftar');
            } else {
                 $this->session->set_flashdata('flash', 'Ditambahkan');
            }
        redirect('usaha');
    }
}
