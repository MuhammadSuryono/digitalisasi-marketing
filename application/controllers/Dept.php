<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dept extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if ($this->session->userdata('masuk') != true) {
            $url = base_url();
            redirect($url);
        }

        role_access();

        $this->load->model('Dept_model');
        $this->load->library('form_validation');
        date_default_timezone_set('Asia/Jakarta');
    }

    public function index()
    {
        $data['dept'] = $this->Dept_model->getAllDept();
        $this->load->view('templates/header');
        $this->load->view('dept/index', $data);
        $this->load->view('templates/footer');
    }

    public function tambah()
    {
        $datacek = $this->Dept_model->tambahDataDept();

        if ($datacek != 1) {
            $this->session->set_flashdata('flash', 'Gagal ditambahkan, Departemen sudah terdaftar');
        } else {
            $this->session->set_flashdata('flash', 'Ditambahkan');
        }
        if ($this->input->post('link') == 'researchbrief') {
            redirect('researchBrief');
        } else {
            redirect('dept');
        }
    }

    public function hapus($id)
    {
        $this->Dept_model->hapusDataDept($id);
        $this->session->set_flashdata('flash', 'Dihapus');
        redirect('dept');
    }

    public function ubah()
    {
        $datacek = $this->Dept_model->ubahDataDept();
        if ($datacek != 1) {
            $this->session->set_flashdata('flash', 'Gagal ditambahkan, Departemen sudah terdaftar');
        } else {
            $this->session->set_flashdata('flash', 'Ditambahkan');
        }
        redirect('dept');
    }
}
