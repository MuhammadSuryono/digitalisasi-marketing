<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dasboard extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		//validasi jika user belum login
		if ($this->session->userdata('masuk') != true) {
			$url = base_url();
			redirect($url);
		}

		$this->load->model('Rfq_model');
	}
	public function index()
	{
		$this->db->select('*');
		$this->db->from('data_fu');
		$this->db->join('data_rfq', 'data_rfq.nomor_rfq = data_fu.nomor_rfq');
		$this->db->order_by('data_fu.date', 'asc');
		$data['fu'] = $this->db->get()->result_array();

		$data['rfq'] = $this->Rfq_model->getRfqByUser($_SESSION['ses_id']);
		// var_dump($data['rfq']);
		$this->load->view('templates/header');
		$this->load->view('dasboard/index', $data);
		$this->load->view('templates/footer');
	}
}
