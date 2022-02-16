<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if ($this->session->userdata('masuk') != true) {
            $url = base_url();
            redirect($url);
        }

        role_access();

        $this->load->model('User_model');
        $this->load->library('form_validation');
        date_default_timezone_set('Asia/Jakarta');
    }

    public function index()
    {
        $data['user'] = $this->User_model->getAllUser();
        $this->load->view('templates/header');
        $this->load->view('user/index', $data);
        $this->load->view('templates/footer');
    }

    public function changePassword()
    {

        $this->form_validation->set_rules('old_ps', 'Password', 'required|trim');
        $this->form_validation->set_rules('new_ps1', 'Password', 'required|trim');
        $this->form_validation->set_rules('new_ps2', 'Password', 'required|trim|matches[new_ps1]');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header');
            $this->load->view('user/changePassword');
            $this->load->view('templates/footer');
        } else {
            $data = $this->User_model->getUserById($this->input->post('id'));
            if (md5($this->input->post('old_ps')) == $data['password']) {
                $this->User_model->changePw($this->input->post('id'));
                $this->session->set_flashdata('success', '<i class="fas fa-check"></i> Password berhasil diubah');
                redirect('user/changePassword');
            } else {
                $this->session->set_flashdata('danger', 'Current Password Salah');
                redirect('user/changePassword');
            }
        }
    }

    public function tambahDept()
    {
        $this->load->model('Dept_model');
        $this->Dept_model->tambahDataDept();
        $this->session->set_flashdata('flash', 'Ditambahkan');
        redirect('user/tambah');
    }

    public function tambahJabatan()
    {
        $this->load->model('Jabatan_model');
        $this->Jabatan_model->tambahDataJabatan();
        $this->session->set_flashdata('flash', 'Ditambahkan');
        redirect('user/tambah');
    }

    public function tambah()
    {

        $this->form_validation->set_rules('user', 'User', 'required|trim');
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|matches[password2]');
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');
        $this->form_validation->set_rules('dept', 'Dept', 'required|trim');
        $this->form_validation->set_rules('jabatan', 'Jabatan', 'required|trim');
        $this->form_validation->set_rules('email1', 'Email', 'required|trim|valid_email|is_unique[data_user.email1]', [
            'is_unique' => "Email is already",
        ]);
        $this->form_validation->set_rules('email2', 'Email', 'trim|valid_email');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header');
            $this->load->view('user/tambah');
            $this->load->view('templates/footer');
        } else {
            $this->User_model->tambahDataUser();
            $this->session->set_flashdata('flash', 'Ditambahkan');
            redirect('user');
        }
    }

    public function hapus($id)
    {
        $this->User_model->hapusDataUser($id);
        $this->session->set_flashdata('flash', 'Dihapus');
        redirect('user');
    }

    public function ubah($id)
    {
        $data['user'] = $this->User_model->getUserById($id);

        $this->form_validation->set_rules('user', 'User', 'required|trim');
        $this->form_validation->set_rules('dept', 'Dept', 'required|trim');
        $this->form_validation->set_rules('jabatan', 'Jabatan', 'required|trim');
        $this->form_validation->set_rules('email1', 'Email', 'required|trim|valid_email');
        $this->form_validation->set_rules('email2', 'Email', 'trim|valid_email');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header');
            $this->load->view('user/ubah', $data);
            $this->load->view('templates/footer');
        } else {
            $this->User_model->ubahDataUser();
            $this->session->set_flashdata('flash', 'Diubah');
            redirect('user');
        }
    }
}
