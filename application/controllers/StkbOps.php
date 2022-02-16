<?php
defined('BASEPATH') or exit('No direct script access allowed');

class StkbOps extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $db2 = $this->load->database('database_kedua', TRUE);

        if ($this->session->userdata('masuk') != true) {
            $url = base_url();
            redirect($url);
        }

        $this->load->model('StkbOps_model');
        $this->load->library('form_validation');
        date_default_timezone_set('Asia/Jakarta');
    }

    public function index()
    {
        $data['stkbops'] = $this->StkbOps_model->getAllStkbOps();
        $data['allproject'] = $this->StkbOps_model->getallproject();
        $data['dariiddata'] = $this->StkbOps_model->getalliddata();
        $this->load->view('templates/header');
        $this->load->view('stkbops/index', $data);
        $this->load->view('templates/footer');
    }

    public function tambah()
    {
        $this->StkbSkenario_model->tambahstkbops();
        $this->session->set_flashdata('flash', 'Data Ditambahkan');
        redirect('stkbops');
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
