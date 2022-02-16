<?php
defined('BASEPATH') or exit('No direct script access allowed');

class StkbSkenario extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if ($this->session->userdata('masuk') != true) {
            $url = base_url();
            redirect($url);
        }

        $this->load->model('StkbSkenario_model');
        $this->load->library('form_validation');
        date_default_timezone_set('Asia/Jakarta');
    }

    public function index()
    {
        $data['stkbskenario'] = $this->StkbSkenario_model->getAllStkbSkenario();
        $this->load->view('templates/header');
        $this->load->view('stkbskenario/index', $data);
        $this->load->view('templates/footer');
    }

    public function tambah()
    {
        $this->StkbSkenario_model->tambahdatastkbskenario();
        $this->session->set_flashdata('flash', 'Data Ditambahkan');
        redirect('stkbskenario');
    }

    public function hapus($id)
    {
        $this->StkbSkenario_model->hapusdatastkbskenario($id);
		$this->session->set_flashdata('flash', 'Dihapus');
        redirect('stkbskenario');
    }

    public function ubah()
    {
        $this->StkbSkenario_model->ubahdatastkbskenario();
        $this->session->set_flashdata('flash', 'Diubah');
        redirect('stkbskenario');
    }
}
