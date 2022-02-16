<?php
defined('BASEPATH') or exit('No direct script access allowed');

class StkbMasterplan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if ($this->session->userdata('masuk') != true) {
            $url = base_url();
            redirect($url);
        }

        $this->load->model('StkbMasterplan_model');
        $this->load->library('form_validation');
        date_default_timezone_set('Asia/Jakarta');
    }

    public function index()
    {
        //$data['stkbmasterplan'] = $this->StkbPerdin_model->getAllStkbPerdin();
        $data['masterplannama'] = $this->StkbMasterplan_model->getallnama();
        $data['masterplanproject'] = $this->StkbMasterplan_model->getallproject();
        $data['masterplankota'] = $this->StkbMasterplan_model->kotakabupaten();
        $this->load->view('templates/header');
        $this->load->view('stkbmasterplan/index', $data);
        $this->load->view('templates/footer');
    }

    public function getkotaproject(){
       $id = $_POST['id'];
       $data = $this->StkbMasterplan_model->getkotaproject($id);
       echo json_encode($data);
   }

   public function getdaftarcabang(){
       $id    = $_POST['id'];
       $kota  = $_POST['kota'];
       $data = $this->StkbMasterplan_model->getdaftarcabang($id,$kota);
       echo json_encode($data);
   }

}
