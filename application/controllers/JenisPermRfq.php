<?php
defined('BASEPATH') or exit('No direct script access allowed');

class JenisPermRfq extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if ($this->session->userdata('masuk') != true) {
            $url = base_url();
            redirect($url);
        }

        role_access();
        
        $this->load->model('JenisPermRfq_model');
        $this->load->library('form_validation');
        date_default_timezone_set('Asia/Jakarta');
    }

    public function index()
    {
        $data['db'] = $this->JenisPermRfq_model->getAllJenisPermRfq();
        $this->load->view('templates/header');
        $this->load->view('jnsprfq/index', $data);
        $this->load->view('templates/footer');
    }

    public function tambah()
    {
        $this->JenisPermRfq_model->tambahDataJenisPermRfq();
        $this->session->set_flashdata('flash', 'Ditambahkan');
        redirect('jenisPermRfq');
    }

    public function hapus($id)
    {
        $this->JenisPermRfq_model->hapusDataJenisPermRfq($id);
		$this->session->set_flashdata('flash', 'Dihapus');
        redirect('jenisPermRfq');
    }

    public function ubah()
    {
        $this->JenisPermRfq_model->ubahDataJenisPermRfq();
        $this->session->set_flashdata('flash', 'Diubah');
        redirect('jenisPermRfq');
    }
}
