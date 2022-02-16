<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Report extends CI_Controller
{
     public function __construct()
    {
        parent::__construct();

        if ($this->session->userdata('masuk') != true) {
            $url = base_url();
            redirect($url);
        }

        role_access();

        $this->load->model('Report_model');
        $this->load->library('form_validation');
        date_default_timezone_set('Asia/Jakarta');
    }

    public function index()
    {
        $data['db1'] = $this->Report_model->getAllPermintaanRFQ();
        $data['status'] = $this->Report_model->getAllStatus();
        // $data['status1'] = $this->Report_model->getAllStatus1();
        // $data['status0'] = $this->Report_model->getAllStatus0();
        // $data['status2'] = $this->Report_model->getAllStatus2();
        // $data['status3'] = $this->Report_model->getAllStatus3();
        $data['db'] = $this->Report_model->getAllQuery();

        $this->load->view('templates/header');
        $this->load->view('report/index', $data);
        $this->load->view('templates/footer');
    }

    public function test(){
        var_dump($this->input->post('date1'));
        var_dump($this->input->post('date2'));
        die;
    }

    public function lihat(){
        $data['db'] = $this->Report_model->getAllQueryByDate();
         $data['status'] = $this->Report_model->getAllStatus();


        $this->load->view('templates/header');
        $this->load->view('report/index', $data);
        $this->load->view('templates/footer');
    }

}