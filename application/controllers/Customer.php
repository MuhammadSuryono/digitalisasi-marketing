<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Customer extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if ($this->session->userdata('masuk') != true) {
            $url = base_url();
            redirect($url);
        }

        role_access();

        $this->load->model('Customer_model');
        $this->load->model('Dept_model');
        $this->load->model('Jabatan_model');
        $this->load->model('Perusahaan_model');
        $this->load->library('form_validation');
        date_default_timezone_set('Asia/Jakarta');
    }

    public function index()
    {
        $data['customer'] = $this->Customer_model->getAllCustomer();
        $this->load->view('templates/header');
        $this->load->view('customer/index', $data);
        $this->load->view('templates/footer');
    }

    public function tambah()
    {
        $id = $this->input->get('id');
        if ($id) {
            $data = ['id' => $id];
        }
        $this->form_validation->set_rules('nama', 'Nama', 'required|trim');
        $this->form_validation->set_rules('status', 'Status', 'required|trim');
        $this->form_validation->set_rules('perusahaan', 'Perusahaan', 'required|trim');
        $this->form_validation->set_rules('dept', 'Dept', 'required|trim');
        $this->form_validation->set_rules('jabatan', 'Jabatan', 'required|trim');
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header');
            if (!empty($data)) {
                $this->load->view('customer/tambah', $data);
            } else {
                $this->load->view('customer/tambah');
            }
            $this->load->view('templates/footer');
        } else {
            $this->Customer_model->tambahDataCustomer();
            $this->session->set_flashdata('flash', 'Ditambahkan');
            redirect('customer');
        }
    }

    public function hapus($id)
    {
        $this->Customer_model->hapusDataCustomer($id);
        $this->session->set_flashdata('flash', 'Dihapus');
        redirect('customer');
    }

    public function ubah($id)
    {
        $data['customer'] = $this->Customer_model->getCustomerById($id);

        $this->form_validation->set_rules('nama', 'Nama', 'required|trim');
        $this->form_validation->set_rules('status', 'Status', 'required|trim');
        $this->form_validation->set_rules('perusahaan', 'Perusahaan', 'required|trim');
        $this->form_validation->set_rules('dept', 'Dept', 'required|trim');
        $this->form_validation->set_rules('jabatan', 'Jabatan', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header');
            $this->load->view('customer/ubah', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Customer_model->ubahDataCustomer();
            $this->session->set_flashdata('flash', 'Diubah');
            redirect('customer');
        }
    }

    public function perusahaan()
    {
        $this->Perusahaan_model->tambahDataPerusahaan();
        $this->session->set_flashdata('flash', 'Ditambahkan');
        redirect('customer/tambah');
    }

    public function tambahDept()
    {
        $this->Dept_model->tambahDataDept();
        $this->session->set_flashdata('flash', 'Ditambahkan');
        redirect('customer/tambah');
    }

    public function tambahJabatan()
    {
        $this->Jabatan_model->tambahDataJabatan();
        $this->session->set_flashdata('flash', 'Ditambahkan');
        redirect('customer/tambah');
    }





    // TAMBAHAN BY ADAM SANTOSO
    public function tambahDeptAdam()
    {
        error_reporting(0);
        $data = $this->Dept_model->tambahDataDeptAdam();
        echo json_encode($data);
    }
    public function tambahJabatanAdam()
    {
        error_reporting(0);
        $data = $this->Jabatan_model->tambahDataJabatanAdam();
        echo json_encode($data);
    }
    public function tambahPerusahaanAdam()
    {
        error_reporting(0);
        $data = $this->Perusahaan_model->tambahDataPerusahaanAdam();
        echo json_encode($data);
    }
}
