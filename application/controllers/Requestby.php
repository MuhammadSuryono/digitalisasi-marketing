<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Requestby extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if ($this->session->userdata('masuk') != true) {
            $url = base_url();
            redirect($url);
        }

        role_access();

        $this->load->model('Request_model');
        $this->load->library('form_validation');
        date_default_timezone_set('Asia/Jakarta');
    }

    public function index()
    {
        $data['db'] = $this->Request_model->getAllRequest();
        $this->load->view('templates/header');
        $this->load->view('request/index', $data);
        $this->load->view('templates/footer');
    }

    public function tambah()
    {
        $this->Request_model->tambahData();
        $this->session->set_flashdata('flash', 'Ditambahkan');
        redirect('requestby');
    }

    public function hapus($id)
    {
        $this->Request_model->hapusData($id);
		$this->session->set_flashdata('flash', 'Dihapus');
        redirect('requestby');
    }

    public function ubah()
    {
        $this->Request_model->ubahData();
        $this->session->set_flashdata('flash', 'Diubah');
        redirect('requestby');
    }
}