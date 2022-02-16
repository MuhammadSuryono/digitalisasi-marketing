<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Proposal extends CI_Controller
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
        $this->load->model('Proposal_model');
        $this->load->library('form_validation');
        date_default_timezone_set('Asia/Jakarta');
    }

    public function index()
    {
        //$data['jabatan'] = $this->Jabatan_model->getAllJabatan();
        $this->load->view('templates/header');
        $this->load->view('proposal/index');
        $this->load->view('templates/footer');
    }
	
	
    public function download()
    {
        //$data['jabatan'] = $this->Jabatan_model->getAllJabatan();
		$data['hasil'] ='';
		if(isset($_POST['show'])){
			$rfq = $this->input->post('rfq',true);
			$methodology = $this->input->post('methodology',true);
			$usaha = $this->input->post('usaha',true);
			
			$data['hasil'] = $this->db->get_where('bank_proposal',array('nomor_rfq'=>$rfq, 'id_methodology'=>$methodology, 'id_usaha'=>$usaha))->result_array();
		}
        $this->load->view('templates/header');
        $this->load->view('proposal/download',$data);
        $this->load->view('templates/footer');
    }

    public function tambah()
    {		
		foreach($_FILES['filedata']['tmp_name'] as $key=> $tmp_name){
			$file_name = $_FILES['filedata']['name'][$key];
			$file_tmp = $_FILES['filedata']['tmp_name'][$key];
			move_uploaded_file($file_tmp,"file/proposal/".$file_name);
			
			$this->Proposal_model->tambahDataProposal($file_name);
		}		
		$this->session->set_flashdata('flash', 'Uplaod Sukses');
		redirect('proposal');
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
