<?php
defined('BASEPATH') or exit('No direct script access allowed');

class StkbPerdin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if ($this->session->userdata('masuk') != true) {
            $url = base_url();
            redirect($url);
        }

        $this->load->model('StkbPerdin_model');
        $this->load->library('form_validation');
        date_default_timezone_set('Asia/Jakarta');
    }

    public function index()
    {
        $data['stkbperdin'] = $this->StkbPerdin_model->getAllStkbPerdin();
        $this->load->view('templates/header');
        $this->load->view('stkbperdin/index', $data);
        $this->load->view('templates/footer');
    }

    public function tambah()
    {
        $this->StkbPerdin_model->tambahdatamatrixperdin();
        $this->session->set_flashdata('flash', 'Data Ditambahkan');
        redirect('stkbperdin');
    }

    public function hapus($id)
    {
        $this->StkbPerdin_model->hapusDatastkbperdin($id);
		    $this->session->set_flashdata('flash', 'Dihapus');
        redirect('stkbperdin');
    }

    public function ubah()
    {
        $this->GroupCosting1_model->ubahDataGroupCosting1();
        $this->session->set_flashdata('flash', 'Diubah');
        redirect('groupCosting1');
    }
}
