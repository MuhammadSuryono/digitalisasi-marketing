<?php
/*
Pembaruan Menu Template Project Plan BY ADAM SANTOSO
*/
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

    // TEMPLATE PROJECT PLAN OPTION
    public function tambah()
    {
        $this->TemplateProjectPlan_model->tambahTemplatepp();
        $this->session->set_flashdata('flash', 'Ditambahkan');
        redirect('templateProjectPlan');
    }
    public function hapus($id)
    {
        $this->TemplateProjectPlan_model->hapusDataTemplatepp($id);
		    $this->session->set_flashdata('flash', 'Dihapus');
        redirect('templateProjectPlan');
    }
    // ===== //

    public function tambahKegiatan()
    {
        $this->TemplateProjectPlan_model->tambahDataKegiatan();
        $this->session->set_flashdata('flash', 'Ditambahkan');
        redirect('templateProjectPlan/view/'.$this->input->post('id_template_pp'));
    }
    public function ubahKegiatan($id, $idpp)
    {
        $this->TemplateProjectPlan_model->ubahDataKegiatan($id);
        $this->session->set_flashdata('flash', 'Diubah');
        redirect('templateProjectPlan/view/'.$idpp);
    }
    public function hapusKegiatan($id, $idpp)
    {
        $this->TemplateProjectPlan_model->hapusDataKegiatan($id);
        $this->session->set_flashdata('flash', 'Dihapus');
        redirect('templateProjectPlan/view/'.$idpp);
    }

    public function view($id)
    {
        $data['template'] = $this->TemplateProjectPlan_model->getTemplateById($id);
        $data['master'] = $this->TemplateProjectPlan_model->ambilDataMasterPP();
        $data['detail'] = $this->TemplateProjectPlan_model->ambilDataDetailTemplatePP($id);
        $this->load->view('templates/header');
        $this->load->view('templateprojectplan/tambah', $data);
        $this->load->view('templates/footer');

    }
}
