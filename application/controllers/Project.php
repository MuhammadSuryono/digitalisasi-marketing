<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Project extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if ($this->session->userdata('masuk') != true) {
            $url = base_url();
            redirect($url);
        }

        role_access();

        $this->load->model('Project_model');
        $this->load->model('GroupCosting1_model');
        $this->load->model('GroupCosting2_model');
        $this->load->library('form_validation');
        date_default_timezone_set('Asia/Jakarta');
    }

    public function index()
    {
        $data['costing'] = $this->Costing_model->getAllCosting();
        $this->load->view('templates/header');
        $this->load->view('costing/index', $data);
        $this->load->view('templates/footer');
    }

    public function tambah()
    {
		$this->Project_model->tambahDataProject();
		$this->session->set_flashdata('flash', 'Ditambahkan');
		redirect('costing');
        
    }

    public function hapus($id)
    {
        $this->db->delete('project', array('id_project'=>$id));
        $this->db->delete('costing', array('id_project'=>$id));
		$this->session->set_flashdata('flash', 'Dihapus');
        redirect('costing');
    }

    public function ubah($id)
    {
        
    }
}
