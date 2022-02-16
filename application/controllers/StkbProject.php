<?php
defined('BASEPATH') or exit('No direct script access allowed');

class StkbProject extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if ($this->session->userdata('masuk') != true) {
            $url = base_url();
            redirect($url);
        }

        $this->load->model('StkbProject_model');
        $this->load->library('form_validation');
        date_default_timezone_set('Asia/Jakarta');
    }

    public function index()
    {
        $data['semuaproject'] = $this->StkbProject_model->getallproject();
        $this->load->view('templates/header');
        $this->load->view('stkbproject/index', $data);
        $this->load->view('templates/footer');
    }

    public function edit($kopro)
    {
       $data['kode'] = $this->StkbProject_model->getprojectbykode($kopro);
       $data['id'] = $this->StkbProject_model->getskenariopro($kopro);
       // $data['sken'] = $this->StkbProject_model->getallskenario();
       $this->load->view('templates/header');
       $this->load->view('stkbproject/edit', $data);
       $this->load->view('templates/footer');
    }

    public function tambah()
    {
       $kopro = $_POST['kodeproject'];
       $this->StkbProject_model->tambahskenarioproject();
       $this->session->set_flashdata('flash', 'Skenario Ditambahkan');
       redirect("stkbproject/edit/$kopro");
    }

}
