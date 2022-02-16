<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Topic extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if ($this->session->userdata('masuk') != true) {
            $url = base_url();
            redirect($url);
        }

        role_access();
        $this->load->library('form_validation');
        date_default_timezone_set('Asia/Jakarta');
    }

    public function index()
    {
        $data['topic'] = $this->Topic_model->getAllTopic();
        $this->load->view('templates/header');
        $this->load->view('topic/index', $data);
        $this->load->view('templates/footer');
    }

    public function tambah()
    {
        $this->Topic_model->tambahDataTopic();
        $this->session->set_flashdata('flash', 'Ditambahkan');
        redirect('topic');
    }

    public function hapus($id)
    {
        $this->Topic_model->hapusDataTopic($id);
		    $this->session->set_flashdata('flash', 'Dihapus');
        redirect('topic');
    }

    public function ubah()
    {
        $this->Topic_model->ubahDataTopic();
        $this->session->set_flashdata('flash', 'Diubah');
        redirect('topic');
    }
}
