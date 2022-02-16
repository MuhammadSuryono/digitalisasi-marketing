<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Negara extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if ($this->session->userdata('masuk') != true) {
            $url = base_url();
            redirect($url);
        }

        role_access();

        $this->load->model('Negara_model');
        $this->load->library('form_validation');
        date_default_timezone_set('Asia/Jakarta');
    }

    public function index()
    {
        $data['negara'] = $this->Negara_model->getAllNegara();
        $this->load->view('templates/header');
        $this->load->view('negara/index', $data);
        $this->load->view('templates/footer');
    }

    public function tambah()
    {
            $datacek = $this->Negara_model->tambahDataNegara();

            if ($datacek != 1){
                $this->session->set_flashdata('flash', 'Gagal ditambahkan, negara sudah terdaftar');
            } else {
                 $this->session->set_flashdata('flash', 'Ditambahkan');
            }
            
            redirect('negara');
    }

    public function hapus($id)
    {
        $this->Negara_model->hapusDataNegara($id);
		$this->session->set_flashdata('flash', 'Dihapus');
        redirect('negara');
    }

    public function ubah()
    {
            $datacek = $this->Negara_model->ubahDataNegara();
            if ($datacek != 1){
                $this->session->set_flashdata('flash', 'Gagal diubah, negara sudah terdaftar');
            } else {
                 $this->session->set_flashdata('flash', 'Diubah');
            };

            redirect('negara');
        
    }
}
