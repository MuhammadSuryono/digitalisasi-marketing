<?php
defined('BASEPATH') or exit('No direct script access allowed');

class StkbDasarTrk extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if ($this->session->userdata('masuk') != true) {
            $url = base_url();
            redirect($url);
        }

        $this->load->model('StkbDasarTrk_model');
        $this->load->library('form_validation');
        date_default_timezone_set('Asia/Jakarta');
    }

    public function index()
    {
        $data['stkbdasartrkbank'] = $this->StkbDasarTrk_model->getallstkbbank();
        $data['stkbdasartrksken'] = $this->StkbDasarTrk_model->getallstkbskenario();
        $proses = $this->StkbDasarTrk_model->getallstkbbank();
        $this->load->view('templates/header');
        $this->load->view('stkbdasartrk/index', $data);
        $this->load->view('templates/footer');
    }

    public function tambah()
    {
        $data['stkbbanktanpa'] = $this->StkbDasarTrk_model->getbanktanpa();
        $this->load->view('templates/header');
        $this->load->view('stkbdasartrk/tambah', $data);
        $this->load->view('templates/footer');
        // $this->StkbSkenario_model->tambahdatastkbskenario();
        // $this->session->set_flashdata('flash', 'Data Ditambahkan');
        // redirect('stkbskenario');

    }

    public function edit($id)
    {
      $data['kode'] = $this->StkbDasarTrk_model->getBankByKode($id);
      // var_dump($data['kode']);
      // die;
      $data['skenario'] = $this->StkbDasarTrk_model->getSkenario($id);

      $this->form_validation->set_rules('kodebank', 'Kodebank', 'trim');

      $ulangtrk = $this->db->get('stkb_dasar_trk')->result_array();
      $i = 1;

      foreach ($ulangtrk as $key => $value) {
        $this->form_validation->set_rules("$i", "$i", 'trim');
        $i++;
      }


      // $this->form_validation->set_rules('2', '2', 'trim');
      // $this->form_validation->set_rules('3', '3', 'trim');
      // $this->form_validation->set_rules('4', '4', 'trim');
      // $this->form_validation->set_rules('5', '5', 'trim');
      // $this->form_validation->set_rules('6', '6', 'trim');
      // $this->form_validation->set_rules('7', '7', 'trim');
      // $this->form_validation->set_rules('8', '8', 'trim');
      // $this->form_validation->set_rules('9', '9', 'trim');
      // $this->form_validation->set_rules('10', '10', 'trim');
      // $this->form_validation->set_rules('11', '11', 'trim');
      // $this->form_validation->set_rules('12', '12', 'trim');
      // $this->form_validation->set_rules('13', '13', 'trim');
      // $this->form_validation->set_rules('14', '14', 'trim');
      // $this->form_validation->set_rules('15', '15', 'trim');
      // $this->form_validation->set_rules('16', '16', 'trim');
      // $this->form_validation->set_rules('17', '17', 'trim');
      // $this->form_validation->set_rules('18', '18', 'trim');
      // $this->form_validation->set_rules('19', '19', 'trim');
      // $this->form_validation->set_rules('20', '20', 'trim');
      // $this->form_validation->set_rules('21', '21', 'trim');
      // $this->form_validation->set_rules('22', '22', 'trim');
      // $this->form_validation->set_rules('23', '23', 'trim');
      // $this->form_validation->set_rules('24', '24', 'trim');
      // $this->form_validation->set_rules('25', '25', 'trim');
      // $this->form_validation->set_rules('26', '26', 'trim');
      // $this->form_validation->set_rules('27', '27', 'trim');
      // $this->form_validation->set_rules('28', '28', 'trim');
      // $this->form_validation->set_rules('29', '29', 'trim');
      // $this->form_validation->set_rules('30', '30', 'trim');
      // $this->form_validation->set_rules('31', '31', 'trim');
      // $this->form_validation->set_rules('32', '32', 'trim');
      // $this->form_validation->set_rules('33', '33', 'trim');
      // $this->form_validation->set_rules('34', '34', 'trim');
      // $this->form_validation->set_rules('35', '35', 'trim');
      // $this->form_validation->set_rules('36', '36', 'trim');
      // $this->form_validation->set_rules('37', '37', 'trim');
      // $this->form_validation->set_rules('38', '38', 'trim');
      // $this->form_validation->set_rules('39', '39', 'trim');

      if ($this->form_validation->run() == false) {
        $this->load->view('templates/header');
        $this->load->view('stkbdasartrk/edit', $data);
        $this->load->view('templates/footer');
      }else{
        $this->StkbDasarTrk_model->ubahDasarTrk();
        $this->session->set_flashdata('flash', 'Data berhasil di ubah');
        redirect('stkbdasartrk');
      }
    }

    // public function hapus($id)
    // {
    //     $this->StkbSkenario_model->hapusdatastkbskenario($id);
		// $this->session->set_flashdata('flash', 'Dihapus');
    //     redirect('stkbskenario');
    // }
    //
    // public function ubah()
    // {
    //     $this->StkbSkenario_model->ubahdatastkbskenario();
    //     $this->session->set_flashdata('flash', 'Diubah');
    //     redirect('stkbskenario');
    // }
}
