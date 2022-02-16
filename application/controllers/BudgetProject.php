<?php
defined('BASEPATH') or exit('No direct script access allowed');

class BudgetProject extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if ($this->session->userdata('masuk') != true) {
            $url = base_url();
            redirect($url);
        }

        role_access();
        //$this->load->model('BudgetProject_model');
        $this->load->model('Rfq_model');
        $this->load->library('form_validation');
        date_default_timezone_set('Asia/Jakarta');
    }

    public function index()
    {
        $data['rfq'] = $this->db->get_where('data_rfq', ['last_status'=>1])->result_array();
        $this->load->view('templates/header');
        $this->load->view('budgetproject/index', $data);
        $this->load->view('templates/footer');
    }

    public function view($id)
    {
        $data['rfq'] = $this->Rfq_model->getRfqById($id);
        $this->load->view('templates/header');
        $this->load->view('BudgetProject/view', $data);
        $this->load->view('templates/footer');
    }

    public function template()
    {
        $model = $this->db->get_where('template_pp', array('id_template_project'=>$_GET['id']))->row_array();
        $data = $model['project_plan'];

        echo json_encode($data);
    }

    public function tambah()
    {

        $this->form_validation->set_rules('jenis_surat', 'Jenis Surat', 'required|trim');
        $this->form_validation->set_rules('isi_surat', 'Isi_surat', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header');
            $this->load->view('surat/tambah');
            $this->load->view('templates/footer');
        } else {
            $this->Surat_model->tambahDataSurat();
            $this->session->set_flashdata('flash', 'Ditambahkan');
            redirect('surat');
        }
    }

    public function hapus($id)
    {
        $this->Surat_model->hapusDataSurat($id);
		$this->session->set_flashdata('flash', 'Dihapus');
        redirect('surat');
    }

    public function ubah($id)
    {
        $data['surat'] = $this->Surat_model->getSuratById($id);

        $this->form_validation->set_rules('jenis_surat', 'Jenis Surat', 'required|trim');
        $this->form_validation->set_rules('isi_surat', 'Isi_surat', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header');
            $this->load->view('surat/ubah', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Surat_model->ubahDataSurat();
            $this->session->set_flashdata('flash', 'Diubah');
            redirect('surat');
        }
    }
}
