<?php
defined('BASEPATH') or exit('No direct script access allowed');

class GroupCosting2 extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if ($this->session->userdata('masuk') != true) {
            $url = base_url();
            redirect($url);
        }

        role_access();

        $this->load->model('GroupCosting2_model');
        $this->load->library('form_validation');
        date_default_timezone_set('Asia/Jakarta');
    }

    public function index()
    {
        $data['costing'] = $this->GroupCosting2_model->getAllGroupCosting2();
        $this->load->view('templates/header');
        $this->load->view('gcosting2/index', $data);
        $this->load->view('templates/footer');
    }

    public function tambah()
    {
        $this->GroupCosting2_model->tambahDataGroupCosting2();
        $this->session->set_flashdata('flash', 'Ditambahkan');
        redirect('groupCosting2');
    }

    public function hapus($id)
    {
        $this->GroupCosting2_model->hapusDataGroupCosting2($id);
		$this->session->set_flashdata('flash', 'Dihapus');
        redirect('groupCosting2');
    }

    public function ubah()
    {
        $this->GroupCosting2_model->ubahDataGroupCosting2();
        $this->session->set_flashdata('flash', 'Diubah');
        redirect('groupCosting2');
    }
}
