<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Methodology extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if ($this->session->userdata('masuk') != true) {
            $url = base_url();
            redirect($url);
        }

        role_access();

        $this->load->model('Methodology_model');
        $this->load->library('form_validation');
        date_default_timezone_set('Asia/Jakarta');
    }

    public function index()
    {
        $data['methodology'] = $this->Methodology_model->getAllMethodology();
        $this->load->view('templates/header');
        $this->load->view('methodology/index', $data);
        $this->load->view('templates/footer');
    }

    public function tambah()
    {
        $this->Methodology_model->tambahDataMethodology();
        $this->session->set_flashdata('flash', 'Ditambahkan');
        redirect('methodology');
    }

    public function hapus($id)
    {
        $this->Methodology_model->hapusDataMethodology($id);
		$this->session->set_flashdata('flash', 'Dihapus');
        redirect('methodology');
    }

    public function ubah()
    {
        $this->Methodology_model->ubahDataMethodology();
        $this->session->set_flashdata('flash', 'Diubah');
        redirect('methodology');
    }
}
