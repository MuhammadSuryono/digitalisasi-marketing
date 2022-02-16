<?php
defined('BASEPATH') or exit('No direct script access allowed');

class GroupCosting1 extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if ($this->session->userdata('masuk') != true) {
            $url = base_url();
            redirect($url);
        }

        role_access();
        
        $this->load->model('GroupCosting1_model');
        $this->load->library('form_validation');
        date_default_timezone_set('Asia/Jakarta');
    }

    public function index()
    {
        $data['costing'] = $this->GroupCosting1_model->getAllGroupCosting1();
        $this->load->view('templates/header');
        $this->load->view('gcosting1/index', $data);
        $this->load->view('templates/footer');
    }

    public function tambah()
    {
        $this->GroupCosting1_model->tambahDataGroupCosting1();
        $this->session->set_flashdata('flash', 'Ditambahkan');
        redirect('groupCosting1');
    }

    public function hapus($id)
    {
        $this->GroupCosting1_model->hapusDataGroupCosting1($id);
		$this->session->set_flashdata('flash', 'Dihapus');
        redirect('groupCosting1');
    }

    public function ubah()
    {
        $this->GroupCosting1_model->ubahDataGroupCosting1();
        $this->session->set_flashdata('flash', 'Diubah');
        redirect('groupCosting1');
    }
}
