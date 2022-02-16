<?php
defined('BASEPATH') or exit('No direct script access allowed');

class City extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if ($this->session->userdata('masuk') != true) {
            $url = base_url();
            redirect($url);
        }

        role_access();
        
        $this->load->model('City_model');
        $this->load->model('Komponen_model');
        $this->load->library('form_validation');
        date_default_timezone_set('Asia/Jakarta');
    }

    public function index()
    {
        $data['city'] = $this->City_model->getAllCity();
        $data['komponen'] = $this->Komponen_model->getAllKomponen();

        $model = $this->db->get('city_kom')->result_array();
        foreach ($model as $db) {
            $data['hasil'][$db['id_kota_cost']][$db['id_komponen_cost']] = $db['harga'];
        }
        $this->load->view('templates/header');
        $this->load->view('city/index', $data);
        $this->load->view('templates/footer');
    }

    public function tambah()
    {
        $this->form_validation->set_rules('city', 'City', 'required|trim');
        $data['komponen'] = $this->db->get('komponen_cost')->result_array();

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header');
            $this->load->view('city/tambah', $data);
            $this->load->view('templates/footer');
        } else {
            $this->City_model->tambahCity();
            $this->City_model->tambahCityKomponen();
            $this->session->set_flashdata('flash', 'Ditambahkan');
            redirect('city');
        }
    }

    public function edit($id)
    {
        $this->form_validation->set_rules('city', 'City', 'required|trim');
        $data['kota'] = $this->db->get_where('city_cost',['id_city'=>$id])->row_array();
        $data['komponen'] = $this->db->get('komponen_cost')->result_array();

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header');
            $this->load->view('city/edit', $data);
            $this->load->view('templates/footer');
        } else {
            $this->City_model->editCity();
            $this->City_model->editCityKomponen();
            $this->session->set_flashdata('flash', 'Diubah');
            redirect('city');
        }
    }

    public function hapus($id)
    {
        $this->Jabatan_model->hapusDataJabatan($id);
		$this->session->set_flashdata('flash', 'Dihapus');
        redirect('jabatan');
    }

    public function ubah()
    {
        $this->Jabatan_model->ubahDataJabatan();
        $this->session->set_flashdata('flash', 'Diubah');
        redirect('jabatan');
    }
}
