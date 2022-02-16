<?php
defined('BASEPATH') or exit('No direct script access allowed');

class TemplateProjectPlan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if ($this->session->userdata('masuk') != true) {
            $url = base_url();
            redirect($url);
        }

        role_access();

        $this->load->model('TemplateProjectPlan_model');
        $this->load->library('form_validation');
        date_default_timezone_set('Asia/Jakarta');
    }

    public function index()
    {
        $data['templates'] = $this->TemplateProjectPlan_model->getAllTemplatepp();
        $this->load->view('templates/header');
        $this->load->view('templateprojectplan/index', $data);
        $this->load->view('templates/footer');
    }

    public function tambah()
    {

        $this->TemplateProjectPlan_model->tambahTemplatepp();
        $this->session->set_flashdata('flash', 'Ditambahkan');
        redirect('templateprojectplan');

    }

    public function tambahKegiatan()
    {
        $this->TemplateProjectPlan_model->tambahKegiatan();
        redirect('templateprojectplan/view/'.$this->input->post('id_template'));
    }

    public function view($id)
    {
        $data['template'] = $this->TemplateProjectPlan_model->getTemplateById($id);
        $data['kegiatan'] = $this->db->get_where('jenis_kegiatan', array('id_template_project' => $id))->result_array();
        $this->load->view('templates/header');
        $this->load->view('templateprojectplan/tambah', $data);
        $this->load->view('templates/footer');

    }

    public function hapus($id)
    {
        $this->TemplateProjectPlan_model->hapusDataTemplatepp($id);
		$this->session->set_flashdata('flash', 'Dihapus');
        redirect('templateprojectplan');
    }

    public function hapus_kegiatan($id,$idpp)
    {
        $this->TemplateProjectPlan_model->hapusDataKegiatan($id);
        $this->session->set_flashdata('flash', 'Dihapus');
        redirect('templateprojectplan/view/'.$idpp);
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
