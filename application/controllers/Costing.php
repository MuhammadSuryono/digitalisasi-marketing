<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Costing extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if ($this->session->userdata('masuk') != true) {
            $url = base_url();
            redirect($url);
        }

        role_access();

        $this->load->model('Costing_model');
        $this->load->model('City_model');
        $this->load->model('Komponen_model');
        $this->load->model('GroupCosting1_model');
        $this->load->model('GroupCosting2_model');
        $this->load->model('Project_model');
        $this->load->library('form_validation');
        date_default_timezone_set('Asia/Jakarta');
    }

    public function index()
    {
        $data['cc'] = $this->Costing_model->getAllCc();
        foreach ($data['cc'] as $key) {
            $idC[] = $key['nomor_rfq']; 
        }

        $data['rfq'] = $this->Rfq_model->getAllRfq();
        foreach ($data['rfq'] as $db) {
             $data_rfq[] = $db['nomor_rfq']; 
        }

        $data['idrfq'] = array_diff($data_rfq, $idC);

        $data['metode'] = $this->Methodology_model->getAllMethodology();
        $data['kota'] = $this->City_model->getAllCity();

        $this->load->view('templates/header');
        $this->load->view('costing/index', $data);
        $this->load->view('templates/footer');
    }

    public function tambah($id) 
    {
		$data['req']= $this->Rfq_model->getRfqById($id);
        $data['komponen'] = $this->Komponen_model->getAllKomponen();
		$data['costing']= $this->Costing_model->getCostingByProject($id);
        $data['costing']= $this->Costing_model->getCostingByProject($id);
		      
		$this->load->view('templates/header');
		$this->load->view('costing/tambah', $data);
		$this->load->view('templates/footer');
    }

    public function kota()
    {
        $model = $this->db->get('city_kom')->result_array();
        foreach ($model as $db) {
            $harga['harga'][$db['id_kota_cost']][$db['id_komponen_cost']] = $db['harga'];
            $harga['id'][$db['id_kota_cost']][$db['id_komponen_cost']] = $db['id_city'];
        }
        $data['kota'] = $this->db->get_where('kota_cost', array('nomor_rfq' => $_GET['rfq']))->result_array();
        $data['komponen'] = $this->Komponen_model->getAllKomponen();

        $no = 0;
        foreach ($data['kota'] as $db) {
            foreach ($data['komponen'] as $db2) {
                if(isset($harga['harga'][$db['id_kota_cost']][$db2['id_komponen']])){
                    $data['city'][$db['id_kota_cost']][$db2['id_komponen']] = $harga['harga'][$db['id_kota_cost']][$db2['id_komponen']];
                    $data['id_city'][$db['id_kota_cost']][$db2['id_komponen']] = $harga['id'][$db['id_kota_cost']][$db2['id_komponen']];
                }else{
                    $data['city'][$db['id_kota_cost']][$db2['id_komponen']] = 0;
                    $data['id_city'][$db['id_kota_cost']][$db2['id_komponen']] =0;
                }
            }
        }
        echo json_encode($data);
    } 
	
	public function input($id)
	{
        $this->form_validation->set_rules('g1', 'Nama Costing', 'required|trim');
        $this->form_validation->set_rules('g2', 'Alamat', 'required|trim');
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'required|trim');
        $this->form_validation->set_rules('rpsatuan', 'Bidang Usaha', 'required|trim');
        $this->form_validation->set_rules('jumlah', 'Jumlah', 'required|trim');

		$data['req']= $this->Rfq_model->getRfqById($id);
		$data['costing']= $this->Costing_model->getCostingByProject($id);
        
		if ($this->form_validation->run() == false) {
			$this->load->view('templates/header');
            $this->load->view('costing/tambah', $data);
            $this->load->view('templates/footer');
		}else{
			$this->Costing_model->tambahDataCosting($id);
			$this->session->set_flashdata('flash', 'Ditambahkan');
			redirect('costing/tambah/'.$id);
		}
	}

    public function hapus($id, $project)
    {
        $this->Costing_model->hapusDataCosting($id);
		$this->session->set_flashdata('flash', 'Dihapus');
        redirect('costing/tambah/'.$project);
    }


    public function delete($id)
    {
        $this->Costing_model->DeleteCosting($id);
        $this->session->set_flashdata('flash', 'Dihapus');
        redirect('costing');
    }

    public function tesin()
    {
        $this->Costing_model->gg();
    }

    public function add()
    {
        $this->Costing_model->AddCc();
        $this->session->set_flashdata('flash', 'Ditambahkan');
        redirect('costing');   
    }

    public function view($id)
    {
        $data['proses'] = $this->db->get('proses_cost')->result_array();
        $data['kota'] = $this->Costing_model->getAllKotaCost($id);
        $proses = $this->db->get_where('data_proses', array('nomor_rfq' => $id))->result_array();
        foreach ($proses as $db) {
            $data['data_proses'][$db['id_proses']][$db['id_city']] = number_format($db['nilai']);
        }
        $data['id'] = $id ;

        $this->load->view('templates/header');
        $this->load->view('costing/view', $data);
        $this->load->view('templates/footer');   
    }

    public function cost($id)
    {
        $data['cost'] = $this->Costing_model->getAllCost();
        $data['kota'] = $this->Costing_model->getAllKotaCost($id);
        $data['sub'] = $this->db->get('sub_cos')->result_array();
        $data['id'] = $id ;
        $data['tampil'] = $this->Costing_model->tampilCost($id);
        
        $this->load->view('templates/header');
        $this->load->view('costing/cost', $data);
        $this->load->view('templates/footer');   
    }

    public function updateNilaiCost()
    {
        $data = $this->Costing_model->updateNilaiCost();

        echo json_encode($data);
    }

    public function showProses()
    {
        $id= $_GET['id']; 
        $data['proses'] = $this->db->get('proses_cost')->result_array();
        $data['kota'] = $this->Costing_model->getAllKotaCost($id);
        $this->Costing_model->rumusProses($id, count($data['kota']));
        $proses = $this->db->get_where('data_proses', array('nomor_rfq' => $id))->result_array();
        foreach ($proses as $db) {
            if($db['id_proses'] == 12 or $db['id_proses'] == 19 or $db['id_proses'] == 26 or $db['id_proses'] == 27 or $db['id_proses'] == 30){
                $data['data_proses'][$db['id_proses']][$db['id_city']] = number_format($db['nilai'],1);
            }else{ 
                $data['data_proses'][$db['id_proses']][$db['id_city']] = number_format($db['nilai']); 
            }

            $data['id_proses'][$db['id_proses']][$db['id_city']] = $db['id_data_proses'];
        }

        $adjust =  $this->db->get_where('adjustment', array('nomor_rfq' => $id))->result_array();
        foreach ($adjust as $db) {
            if($db['id_proses'] == 10 or $db['id_proses'] == 26 or $db['id_proses'] == 27 or $db['id_proses'] == 30 or $db['id_proses'] == 41 ){
                $data['adjust'][$db['id_proses']][$db['nomor_rfq']] = $db['adjust']; 
            }else{
                $data['adjust'][$db['id_proses']][$db['nomor_rfq']] = number_format($db['adjust']); 
            }
        }

        echo json_encode($data);        
    }

    public function mapping()
    {
        $data2 = array(
            "adjust" => $this->input->post('data', true),
        );
        $this->db->where('id_proses = '.$this->input->post('id').' and nomor_rfq = "'.$this->input->post('rfq').'"');
        $dat = $this->db->update('adjustment', $data2);


        echo json_encode($dat);
    }

    public function updateInput()
    {
        $data2 = array(
            "adjust" => $this->input->post('data', true),
        );
        $this->db->where('id_proses = '.$this->input->post('id').' and nomor_rfq = "'.$this->input->post('rfq').'"');
        $dat = $this->db->update('adjustment', $data2);

        echo json_encode($dat);
    } 

    public function fieldUp()
    {
        $data2 = array(
            "nilai" => $this->input->post('data', true),
        );

        $this->db->where('id_data_proses', $this->input->post('id'));
        $dat = $this->db->update('data_proses', $data2);

        echo json_encode($dat);
    }

    public function ubah($id)
    {
		$this->Costing_model->ubahDataCosting($id);
		$this->session->set_flashdata('flash', 'Diubah');
		redirect('costing/tambah/'.$id);
    }


    public function addKota()
    {
        $this->Costing_model->AddKotaCc();
        $this->session->set_flashdata('flash', 'Ditambahkan');
        redirect('costing');   
    }
}
