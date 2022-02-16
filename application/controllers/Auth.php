<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->library('form_validation');
        $this->load->model('Auth_model');
    }

    public function index()
    {

        $this->load->view('templates/auth_header');
        $this->load->view('auth/login');
        $this->load->view('templates/auth_footer');
    }


    public function auth()
    {
        $username = htmlspecialchars($this->input->post('user', TRUE), ENT_QUOTES);
        $password = htmlspecialchars($this->input->post('password', TRUE), ENT_QUOTES);

        $proses = $this->Auth_model->login($username, $password);

        if ($proses->num_rows() > 0) {

            $data = $proses->row_array();
            $this->session->set_userdata('masuk', TRUE);
            $this->session->set_userdata('ses_id', $data['id_user']);
            $this->session->set_userdata('ses_nama', $data['nama_user']);
            $this->session->set_userdata('ses_level', $data['dept']);
            $this->session->set_userdata('ses_role', $data['role_access']);
            $this->session->set_userdata('ses_jabatan', $data['jabatan']);

            if ($this->input->post('continue'))
                redirect(base_url($this->input->post('continue')));
            else
                redirect(base_url('dasboard'));
        } else {
            $this->session->set_flashdata('flash', 'User atau Password Salah');
            redirect(base_url('auth'));
        }
    }

    public function blocked()
    {
        $this->load->view('auth/blocked');
    }

    public function logout()
    {
        $this->session->sess_destroy();
        $url = base_url();
        redirect($url);
    }
}
