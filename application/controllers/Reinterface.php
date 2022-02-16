<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Reinterface extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if ($this->session->userdata('masuk') != true) {
            $url = base_url();
            redirect($url);
        }

        // role_access();

        $this->load->model('Email_model');
		$this->load->model('Test_model');
        $this->load->library('form_validation');
        date_default_timezone_set('Asia/Jakarta');
    }

    public function video(){
        $this->load->view('templates/header');
        $this->load->view('reinterface/video');
        $this->load->view('templates/footer');
    }

    public function dialog(){
        $this->load->view('templates/header');
        $this->load->view('reinterface/dialog');
        $this->load->view('templates/footer');
    }

}
