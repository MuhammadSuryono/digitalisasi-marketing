<?php
defined('BASEPATH') or exit('No direct script access allowed');

class JenisKerjaRfq extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if ($this->session->userdata('masuk') != true) {
            $url = base_url();
            redirect($url);
        }

        role_access();

        $this->load->model('JenisKerjaRfq_model');
        $this->load->library('form_validation');
        date_default_timezone_set('Asia/Jakarta');
    }

    public function index()
    {
        $data['db'] = $this->JenisKerjaRfq_model->getAllJenisKerjaRfq();
        $this->load->view('templates/header');
        $this->load->view('jnskrfq/index', $data);
        $this->load->view('templates/footer');
    }

    public function tambah()
    {
        $this->JenisKerjaRfq_model->tambahDataJenisKerjaRfq();
        $this->session->set_flashdata('flash', 'Ditambahkan');
        redirect('jenisKerjaRfq');
    }

    public function hapus($id)
    {
        $this->JenisKerjaRfq_model->hapusDataJenisKerjaRfq($id);
		$this->session->set_flashdata('flash', 'Dihapus');
        redirect('jenisKerjaRfq');
    }

    public function ubah()
    {
        $this->JenisKerjaRfq_model->ubahDataJenisKerjaRfq();
        $this->session->set_flashdata('flash', 'Diubah');
        redirect('jenisKerjaRfq');
    }
}
