<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Surat extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if ($this->session->userdata('masuk') != true) {
            $url = base_url();
            redirect($url);
        }

        role_access();

        $this->load->model('Surat_model');
        $this->load->library('form_validation');
        date_default_timezone_set('Asia/Jakarta');
    }

    public function index()
    {
        $data['surat'] = $this->Surat_model->getAllSurat();
        $this->load->view('templates/header');
        $this->load->view('surat/index', $data);
        $this->load->view('templates/footer');
    }

    public function tambah()
    {
        $data['jenis_surat'] = array(
            "1" => "Blast Email",
            "2" => "Data Request",
            "3" => "Umum"
        );

        $this->form_validation->set_rules('jenis_surat', 'Jenis Surat', 'required|trim');
        $this->form_validation->set_rules('isi_surat', 'Isi_surat', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header');
            $this->load->view('surat/tambah', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Surat_model->tambahDataSurat();
            $this->session->set_flashdata('flash', 'Ditambahkan');
            redirect('surat');
        }
    }

    public function hapus($id)
    {
        $this->Surat_model->hapusDataSurat($id);
		$this->session->set_flashdata('flash', 'Dihapus');
        redirect('surat');
    }

    public function ubah($id)
    {
        $data['surat'] = $this->Surat_model->getSuratById($id);
        $data['jenis_surat'] = array(
            "1" => "Blast Email",
            "2" => "Data Request",
            "3" => "Umum"
        );

        $this->form_validation->set_rules('jenis_surat', 'Jenis Surat', 'required|trim');
        $this->form_validation->set_rules('isi_surat', 'Isi_surat', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header');
            $this->load->view('surat/ubah', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Surat_model->ubahDataSurat();
            $this->session->set_flashdata('flash', 'Diubah');
            redirect('surat');
        }
    }
}
