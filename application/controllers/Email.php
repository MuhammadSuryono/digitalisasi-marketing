<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Email extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		if ($this->session->userdata('masuk') != true) {
			$url = base_url();
			redirect($url);
		}

		role_access();

		$this->load->model('Email_model');
		$this->load->model('Test_model');
		$this->load->library('form_validation');
		date_default_timezone_set('Asia/Jakarta');
	}

	public function getCus()
	{
		$usaha = $_POST['usaha'];

		$this->db->select('*, data_customer.nama as nama_customer, data_perusahaan.nama as nama_perusahaan');
		$this->db->from('data_customer');
		$this->db->join('data_perusahaan', 'data_perusahaan.id_perusahaan=data_customer.perusahaan and data_perusahaan.bidang=' . $usaha);

		$data =  $this->db->get()->result_array();

		echo json_encode($data);
	}
	public function getSurat()
	{
		$id = $_GET['id'];
		$data = $this->Surat_model->getSuratById($id);

		echo json_encode($data);
	}


	public function index()
	{
		$data['email'] = $this->Email_model->getAllEmail();
		$this->load->view('templates/header');
		$this->load->view('email/index', $data);
		$this->load->view('templates/footer');
	}

	public function create()
	{
		$this->load->view('templates/header');
		// $this->load->view('email/tambah');
		$this->load->view('email/index1');
		$this->load->view('templates/footer');
	}

	public function view($id)
	{
		$data['email'] = $this->Email_model->getEmailById($id);
		$this->load->view('templates/header');
		$this->load->view('email/view', $data);
		$this->load->view('templates/footer');
	}

	public function tambah()
	{
		foreach ($_FILES['filedata']['tmp_name'] as $key => $tmp_name) {
			$file_name = str_replace(' ', '', $_FILES['filedata']['name'][$key]);
			$file_tmp = $_FILES['filedata']['tmp_name'][$key];
			move_uploaded_file($file_tmp, "file/email/" . $file_name);

			$file[] = $file_name;
		}
		var_dump($_FILES['filedata']['name']);
		echo '<br><br>';
		var_dump($file);
		$data_file = serialize($file);
		$data_cus = serialize($_POST['id_cus']);
		var_dump($data_cus);
		die;
		$this->Email_model->tambahDataEmail($data_cus, $data_file, $sent);

		$this->db->select('max(id_email) as maxEmail');
		$this->db->from('email');
		$data = $this->db->get()->row_array();

		$id = $data['maxEmail'];

		redirect('email/view/' . $id);
	}

	public function tes($id)
	{
		$data = $this->Email_model->getEmailById($id);
		$iduser = $this->session->userdata('ses_id');
		$model = $this->User_model->getUserById($iduser);
		$file = unserialize($data['file']);

		$config = configEmail();

		$this->load->library('email', $config);
		$this->email->from('apriweljenian76@gmail', 'Email');
		$this->email->to($model['email1']);
		$this->email->subject('hjk');
		$this->email->message(nl2br($data['isi_email']));
		foreach ($file as $db) {
			$this->email->attach(base_url('file/email/' . $db));
		}
		$this->session->set_flashdata('flash', 'Email dikirim');
		$this->email->send();
		redirect('email/view/' . $data['id_email']);
	}

	public function temMail()
	{
		$this->load->view('email/tem_email');
	}

	public function kirim($id)
	{
		ini_set('max_execution_time', 0);

		$data = $this->Email_model->getEmailById($id);
		$iduser = $this->session->userdata('ses_id');
		$model = $this->User_model->getUserById($iduser);
		$file = unserialize($data['file']);
		$cus = unserialize($data['id_customer']);

		$no = 1;
		$config = configEmail();
		$this->load->library('email', $config);
		$namaPengirim = $model['nama_user']; //'Marketing MRI';
		$emailPengirim = $model['email1']; //'mri.marketing@mri-research-ind.com';
		$this->email->from($emailPengirim, $namaPengirim);
		$this->email->subject($data['judul_email']);
		$this->email->set_header('Cc', 'mri.marketing@mri-research-ind.com');
		foreach ($cus as $db) {
			$hasil = $this->Customer_model->getCustomerById($db);
			$model['header'] = str_replace('[status]', $hasil['status'], $data['head_isi']);
			$model['header'] = str_replace('[nama]', $hasil['nama'], $model['header']);
			$model['isi'] = nl2br($data['isi_email']);
			$isi_email =  $this->load->view('email/tem_email', $model, true);
			$penerima[] = $hasil['email1'];
			$pesan[] = $isi_email;

			// if($no == 1 AND $model['email1'] != 'mri@mri-research-ind.com'){
			// 	$this->email->cc('mri@mri-research-ind.com');
			// }



			//$send_mail = $this->email->send();
			//echo $this->email->print_debugger();

			$no++;
		}

		for ($x = 0; $x < count($penerima); $x++) {
			$cloned = clone $this->email;

			$cloned->to($penerima[$x]);
			$cloned->message($pesan[$x]);

			if ($file[0] != null) { // CEK APAKAH ADA ATTACHMENT
				foreach ($file as $dba) {
					$cloned->attach(base_url('file/email/' . $dba));
				}
			}

			if ($cloned->send()) {
				echo "sent";
			} else {
				echo "gagal";
			}
			$cloned->clear(TRUE);
		}

		$this->db->where('id_email', $id);

		$this->db->update('email', array('stat' => 1));

		$this->session->set_flashdata('flash', 'Email dikirim');
		redirect('email');
	}

	public function hapus($id)
	{
		$this->Email_model->hapusEmail($id);
		$this->session->set_flashdata('flash', 'Dihapus');
		redirect('email');
	}

	public function ubah()
	{
		$this->Jabatan_model->ubahDataJabatan();
		$this->session->set_flashdata('flash', 'Diubah');
		redirect('jabatan');
	}

	public function test()
	{
		$data['datates2'] = $this->Test_model->getDataTest2();
		$this->load->view('templates/header');
		$this->load->view('test/index3');
		$this->load->view('templates/footer');
	}

	public function testajadulu()
	{
		$data = $this->input->post('test1');
		var_dump($data);
		die;
		$i = 0;
		foreach ($data as $dt) {
			$this->db->query("INSERT INTO data_test2 (id_data1) VALUES ('$dt[$i]')");
		}

		redirect('email/test');
	}

	public function testriway()
	{
		$usaha = $_POST['usaha'];

		$this->db->select('*, data_customer.nama as nama_customer, data_perusahaan.nama as nama_perusahaan');
		$this->db->from('data_customer');
		$this->db->join('data_perusahaan', 'data_perusahaan.id_perusahaan=data_customer.perusahaan and data_perusahaan.bidang=' . $usaha);

		$data =  $this->db->get()->result_array();

		echo json_encode($data);
	}

	public function testriway1()
	{
		// foreach($_POST['languages'] as $dt){
		// 	$data = [
		// 			'id_data1' => $dt,
		// 		];
		// 	$this->db->insert('data_test2', $data);

		// }

		$this->Test_model->riway1();
		$this->db->select('*, data_test2.id, data_customer.nama as nama_customer, data_perusahaan.nama as nama_perusahaan');
		$this->db->from('data_customer');
		$this->db->join('data_perusahaan', 'data_perusahaan.id_perusahaan=data_customer.perusahaan');
		$this->db->join('data_test2', 'data_test2.id_data1=data_customer.id_customer and sts = 0');

		$data =  $this->db->get()->result_array();

		echo json_encode($data);
		// $this->db->select('*, data_customer.nama as nama_customer, data_perusahaan.nama as nama_perusahaan');
		// $this->db->from('data_customer');
		// $this->db->join('data_perusahaan','data_perusahaan.id_perusahaan=data_customer.perusahaan and data_perusahaan.bidang='.$usaha);

		// $data =  $this->db->get()->result_array();

		// echo json_encode($data);
		// for($x=0;$x<count($_POST["languages"]);$x++){
		// 	$data = [
		// 	'id_data1' => $_POST["languages"],
		// ];
		// 	$this->db->insert('data_test2', $data);
		// }


		// $data = [
		// 	'id_data1' => 22,
		// ];

		//$this->db->insert('data_test2', $data);
		// $usaha = $_POST['usaha'];



	}

	public function testriway2()
	{
		$this->Test_model->riway2();
		$this->db->select('*, data_test2.id, data_customer.nama as nama_customer, data_perusahaan.nama as nama_perusahaan');
		$this->db->from('data_customer');
		$this->db->join('data_perusahaan', 'data_perusahaan.id_perusahaan=data_customer.perusahaan');
		$this->db->join('data_test2', 'data_test2.id_data1=data_customer.id_customer and sts = 0');

		$data =  $this->db->get()->result_array();

		echo json_encode($data);
	}

	public function tambahriway1()
	{
		foreach ($_POST['languages'] as $dt) {
			$this->db->delete('data_test2', ['id' => $dt]);
			// $this->db->update('data_test2', ['id' => $dt]);
			// $this->db->query("UPDATE data_test2 SET sts = 1, WHERE id = $dt");
		}
		// $this->Test_model->riway3();
		$this->db->select('*, data_test2.id, data_customer.nama as nama_customer, data_perusahaan.nama as nama_perusahaan');
		$this->db->from('data_customer');
		$this->db->join('data_perusahaan', 'data_perusahaan.id_perusahaan=data_customer.perusahaan');
		$this->db->join('data_test2', 'data_test2.id_data1=data_customer.id_customer and sts = 0');

		$data =  $this->db->get()->result_array();

		echo json_encode($data);
		redirect('email/test');
		//$data = serialize($_POST['testaja1[]']);
		// $data = $this->input->post('testaja1');
		// $data = $this->input->post('testaja1[]');
		// var_dump($data);
		// var_dump($data_cus);
		// die;
		// $i = 0;
		// foreach ($datacus as $dt) {
		// 	$this->db->set('sts', 1);
		// 	$this->db->where('id', $dt);
		// 	$this->db->update('data_test2');
		// }
	}

	public function tambahriway()
	{

		foreach ($_POST['testaja'] as $dt) {
			$this->db->delete('data_test2', ['id_data1' => $dt]);
		}

		foreach ($_FILES['filedata']['tmp_name'] as $key => $tmp_name) {
			$file_name = str_replace(' ', '', $_FILES['filedata']['name'][$key]);
			$file_tmp = $_FILES['filedata']['tmp_name'][$key];
			move_uploaded_file($file_tmp, "./file/email/" . $file_name);

			$file[] = $file_name;
		}

		$data_file = serialize($file);
		// $data_cus = serialize($_POST['testaja']);
		// $data_cus = $_POST['testaja'];
		$data_cus = serialize($_POST['testaja']);
		// var_dump($data_cus);
		// die;
		$this->Email_model->tambahDataEmail($data_cus, $data_file, $sent);



		$this->db->select('max(id_email) as maxEmail');
		$this->db->from('email');
		$data = $this->db->get()->row_array();

		$id = $data['maxEmail'];

		redirect('email/view/' . $id);
	}
}
