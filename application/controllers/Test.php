<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Test extends CI_Controller
{
     public function __construct()
    {
        parent::__construct();

        if ($this->session->userdata('masuk') != true) {
            $url = base_url();
            redirect($url);
        }

        role_access();

        $this->load->model('Rfq_model');
        $this->load->model('Request_model');
        $this->load->library('form_validation');
        date_default_timezone_set('Asia/Jakarta');
    }

    

    public function blastemail(){
        $data = $this->db->get('data_rfq');
        $data1 = $this->input->post('testiway');
        echo $data1;
        foreach($data as $db){
            
        }
    }

}