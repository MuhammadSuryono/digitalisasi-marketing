<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Perusahaan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if ($this->session->userdata('masuk') != true) {
            $url = base_url();
            redirect($url);
        }

        role_access();

        $this->load->model('Perusahaan_model');
        $this->load->model('Usaha_model');
        $this->load->model('Negara_model');
        $this->load->model('Kota_model');
        $this->load->library('form_validation');
        date_default_timezone_set('Asia/Jakarta');
    }

    public function index()
    {
        $data['perusahaan'] = $this->Perusahaan_model->getAllPerusahaan();
        $this->load->view('templates/header');
        $this->load->view('perusahaan/index', $data);
        $this->load->view('templates/footer');
    }

    public function tambahBidang()
    {
        $this->Usaha_model->tambahDataUsaha();
        $this->session->set_flashdata('flash', 'Ditambahkan');
        redirect('perusahaan/tambah');
    }

    public function tambah()
    {

        $this->form_validation->set_rules('nama', 'Nama Perusahaan', 'required|trim|is_unique[data_perusahaan.nama]');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim');
        $this->form_validation->set_rules('bidang', 'Bidang Usaha', 'required|trim');
        $this->form_validation->set_rules('negara', 'Negara', 'required|trim');
        $this->form_validation->set_rules('kota', 'Kota', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
        $this->form_validation->set_rules('telp', 'Telp', 'required|trim');
        $this->form_validation->set_rules('fax', 'Fax', 'trim');
        $this->form_validation->set_rules('web', 'Web', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header');
            $this->load->view('perusahaan/tambah');
            $this->load->view('templates/footer');
        } else {
            $this->Perusahaan_model->tambahDataPerusahaan();
            $this->session->set_flashdata('flash', 'Ditambahkan');
            redirect('perusahaan');
        }
    }

    public function hapus($id)
    {
        $this->Perusahaan_model->hapusDataPerusahaan($id);
        $this->session->set_flashdata('flash', 'Dihapus');
        redirect('perusahaan');
    }

    public function kota()
    {
        $this->Kota_model->tambahDataKota();
        $this->session->set_flashdata('flash', 'Ditambahkan');
        redirect('perusahaan/tambah');
    }

    public function negara()
    {
        $this->Negara_model->tambahDataNegara();
        $this->session->set_flashdata('flash', 'Ditambahkan');
        redirect('perusahaan/tambah');
    }

    public function ubah($id)
    {
        $data['perusahaan'] = $this->Perusahaan_model->getPerusahaanById($id);

        $this->form_validation->set_rules('nama', 'Nama Perusahaan', 'required|trim');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim');
        $this->form_validation->set_rules('negara', 'Negara', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
        $this->form_validation->set_rules('telp', 'Telp', 'required|trim');
        $this->form_validation->set_rules('fax', 'Fax', 'required|trim');
        $this->form_validation->set_rules('web', 'Web', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header');
            $this->load->view('perusahaan/ubah', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Perusahaan_model->ubahDataPerusahaan();
            $this->session->set_flashdata('flash', 'Diubah');
            redirect('perusahaan');
        }
    }


    // TAMBAHAN BY ADAM SANTOSO
    public function tambahBidangAdam()
    {
        error_reporting(0);
        $data = $this->Usaha_model->tambahDataBidangAdam();
        echo json_encode($data);
    }
    public function tambahNegaraAdam()
    {
        error_reporting(0);
        $data = $this->Negara_model->tambahDataNegaraAdam();
        echo json_encode($data);
    }
    public function tambahKotaAdam()
    {
        error_reporting(0);
        $data = $this->Kota_model->tambahDataKotaAdam();
        echo json_encode($data);
    }
}
