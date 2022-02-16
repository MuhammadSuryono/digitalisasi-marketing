<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Rfq extends CI_Controller
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
		$this->load->model('ProjectDocument_model');
		$this->load->model('ResearchBrief_model');
		$this->load->library('form_validation');
		$this->load->helper('download');
		date_default_timezone_set('Asia/Jakarta');
	}

	public function index()
	{
		$data['rfq'] = $this->Rfq_model->getAllRfq();

		// var_dump($data['rfq']);
		$this->load->view('templates/header');
		$this->load->view('rfq/index', $data);
		$this->load->view('templates/footer');
	}

	public function cetak($id)
	{
		$data['rfq'] = $this->Rfq_model->getRfqById($id);

		$this->load->library('Pdf');
		$this->pdf->setPaper('A4', 'potrait');
		$this->pdf->filename = "rfq'.$id.'.pdf";
		$this->pdf->load_view('rfq/cetak', $data);
	}

	public function fu($id)
	{
		$this->form_validation->set_rules('date', 'Date', 'required|trim');
		$this->form_validation->set_rules('ket', 'Schedule', 'required|trim');

		if ($this->form_validation->run() == false) {
			$data['rfq'] = $this->Rfq_model->getRfqById($id);
			$data['fu'] = $this->db->get_where('data_fu', array('nomor_rfq' => $id))->result_array();

			$this->load->view('templates/header');
			$this->load->view('rfq/fu', $data);
			$this->load->view('templates/footer');
		} else {
			$this->Rfq_model->tambahFu();
			$this->session->set_flashdata('flash', 'Ditambahkan');
			$no = $this->input->post('nomor_rfq', true);
			redirect('rfq/fu/' . $no);
		}
	}

	public function hapusFu($id, $no)
	{
		$this->db->delete('data_fu', array('id_fu' => $id));
		$this->session->set_flashdata('flash', 'Dihapus');
		redirect('rfq/fu/' . $no);
	}

	public function customer()
	{
		$id = $_GET['id'];

		$data = $this->db->get_where('data_customer', ['perusahaan' => $id])->result_array();

		echo json_encode($data);
	}

	public function tambahDept()
	{
		$this->load->model('Dept_model');
		$this->Dept_model->tambahDataDept();
		$this->session->set_flashdata('flash', 'Ditambahkan');
		redirect('customer/tambah');
	}

	public function tambahJabatan()
	{
		$this->load->model('Jabatan_model');
		$this->Jabatan_model->tambahDataJabatan();
		$this->session->set_flashdata('flash', 'Ditambahkan');
		redirect('customer/tambah');
	}

	public function tambah_OLD() // BACKUP new version move to tambah()
	{
		$this->form_validation->set_rules('tgl_masuk', 'Nama', 'required|trim');
		$this->form_validation->set_rules('kode_project', 'Kode Project', 'required|trim');
		$this->form_validation->set_rules('nama_project', 'Project', 'required|trim');
		$this->form_validation->set_rules('id_perusahaan', 'Perusahaan', 'required|trim');
		$this->form_validation->set_rules('id_customer', 'Customer', 'required|trim');
		$this->form_validation->set_rules('id_jnsprmt_rfq', 'Jenis Permintaan', 'required|trim');
		$this->form_validation->set_rules('id_krj_rfq', 'Kerja', 'required|trim');
		$this->form_validation->set_rules('id_methodology', 'Methodology', 'required|trim');
		$this->form_validation->set_rules('id_request', 'Request', 'required|trim');
		$this->form_validation->set_rules('date_system', 'Date System', 'required|trim');
		$this->form_validation->set_rules('date_customer', 'Date Customer', 'required|trim');
		$this->form_validation->set_rules('tgl_submit', 'Date Customer', 'required|trim');
		// $this->form_validation->set_rules('last_status', 'Status', 'required|trim');

		if ($this->form_validation->run() == false) {
			$this->db->select('max(nomor_rfq) as maxKode');
			$this->db->from('data_rfq');
			$data = $this->db->get()->row_array();

			$no_rfq = $data['maxKode'];
			$no_urut = (int)substr($no_rfq, 11);
			$no_urut++;
			$char = 'REQ';
			$date = date("Ymd");
			//echo $no_urut;
			$noRfq['id'] = $char . $date . sprintf('%07s', $no_urut);

			$this->load->view('templates/header');
			$this->load->view('rfq/tambah', $noRfq);
			$this->load->view('templates/footer');
		} else {

			$file_name = $_FILES['filedata']['name'];
			$file_tmp = $_FILES['filedata']['tmp_name'];
			move_uploaded_file($file_tmp, "file/rfq/" . $file_name);

			$this->Rfq_model->tambahDataRfq($file_name);
			$this->session->set_flashdata('flash', 'Ditambahkan');
			redirect('rfq');
		}
	}

	public function tambah() //new version
	{
		ini_set('max_execution_time', '0');
		if ($this->input->post('id_jnsprmt_rfq') == 3) {
			$this->form_validation->set_rules('tgl_masuk', 'Nama', 'required|trim');
			$this->form_validation->set_rules('id_perusahaan', 'Perusahaan', 'required|trim');
			$this->form_validation->set_rules('id_customer[]', 'Customer', 'required|trim');
		} else {
			$this->form_validation->set_rules('tgl_masuk', 'Nama', 'required|trim');
			$this->form_validation->set_rules('researchBrief', 'Research Brief', 'required|trim');
			//$this->form_validation->set_rules('kode_project', 'Kode Project', 'required|trim');
			$this->form_validation->set_rules('dlKP', '', 'required|trim');
			$this->form_validation->set_rules('asKP', '', 'required|trim');
			$this->form_validation->set_rules('nama_project', 'Project', 'required|trim');
			$this->form_validation->set_rules('id_perusahaan', 'Perusahaan', 'required|trim');
			$this->form_validation->set_rules('id_customer[]', 'Customer', 'required|trim');
			$this->form_validation->set_rules('id_jnsprmt_rfq', 'Jenis Permintaan', 'required|trim');
			$this->form_validation->set_rules('id_krj_rfq[]', 'Kerja', 'required|trim');
			if (empty($_FILES['filedata']['name'])) {
				$this->form_validation->set_rules('filedata', 'Term of Reference', 'required|trim');
			}
			$this->form_validation->set_rules('id_methodology[]', 'Methodology', 'required|trim');
			$this->form_validation->set_rules('id_topic[]', 'Methodology', 'required|trim');
			$this->form_validation->set_rules('id_dokumen[]', 'Dokumen', 'required|trim');
			$this->form_validation->set_rules('id_request', 'Request', 'required|trim');
			//$this->form_validation->set_rules('tgl_proposal', 'Tanggal Pemberian Proposal', 'required|trim');
			$this->form_validation->set_rules('date_system', 'Date System', 'required|trim');
			$this->form_validation->set_rules('date_customer', 'Date Customer', 'required|trim');
			//$this->form_validation->set_rules('tgl_submit', 'Date Submit', 'required|trim');
			// $this->form_validation->set_rules('last_status', 'Status', 'required|trim');
		}

		if ($this->form_validation->run() == false) {

			$this->db->select('max(nomor_rfq) as maxKode, max(kode_project) as maxKP');
			$this->db->from('data_rfq');
			$data = $this->db->get()->row_array();

			$no_rfq = $data['maxKode'];
			$no_urut = (int)substr($no_rfq, 11);
			$no_urut++;
			$char = 'REQ';
			$date = date("Ymd");
			//echo $no_urut;
			$noRfq['id'] = $char . $date . sprintf('%07s', $no_urut);
			// OTOMATIS  GENERATE NOMOR URUT BARU UNTUK KODE PROJECT BY ADAM SANTOSO
			$data = $this->db->query("SELECT max(kode_project) as maxKP FROM data_rfq WHERE nomor_rfq = '$no_rfq'")->row_array();
			$noKP = $data['maxKP'];
			if (date('Y-m-d') == date('Y-') . '01-01') { // JIKA SUDAH TAHUN BARU
				$noUrutKP = 1;
			} else {
				$noUrutKP = (int)substr($noKP, -3);
				$noUrutKP++;
			}
			$noRfq['blnThnKP'] = date('m.Y');
			$noRfq['noUrutKP'] = sprintf('%03s', $noUrutKP);
			// ============= //
			$this->load->view('templates/header');
			$this->load->view('rfq/tambah2', $noRfq);
			$this->load->view('templates/footer');
		} else {

			if ($this->input->post('id_jnsprmt_rfq') != 3) {
				$file_name = $_FILES['filedata']['name'];
				$file_tmp = $_FILES['filedata']['tmp_name'];
				move_uploaded_file($file_tmp, "file/rfq/" . $file_name);

				$this->Rfq_model->tambahDataRfq($file_name);
			} else {
				$this->Rfq_model->tambahDataRfq();
			}

			// var_dump($this->input->post());
			// die();

			$this->session->set_flashdata('flash', 'Ditambahkan');
			redirect('rfq');
		}
	}

	public function status($id)
	{
		if (isset($_POST['kirim_email'])) {
			$iduser = $this->session->userdata('ses_id');
			$model = $this->User_model->getUserById($iduser);
			$surat = $this->Surat_model->getSuratById($this->input->post('jenis_surat'), true);
			$judul_email = $surat['jenis_surat'];
			$isi_email = str_replace('[Nomor Urut RFQ]', $id, $surat['isi_surat']);
			$isi_email = str_replace('[Nama Project]', $this->input->post('nama_project', true), $isi_email);
			$email = explode(',', trim($this->input->post('email', true)));
			$config = configEmail();
			$this->load->library('email', $config);
			$namaPengirim = $model['nama_user']; //'Marketing MRI';
			$emailPengirim = $model['email1']; //'mri.marketing@mri-research-ind.com';
			$this->email->from($emailPengirim, $namaPengirim);
			$this->email->subject($judul_email);
			$this->email->message($isi_email);

			for ($x = 0; $x < count($email); $x++) {
				$cloned = clone $this->email;
				$cloned->to($email[$x]);
				if ($cloned->send()) {
					echo "sent";
				} else {
					echo "gagal";
				}
				$cloned->clear();
			}
			$this->session->set_flashdata('flash', 'Email Terkirim');
			redirect('rfq');
		} else {
			$data['rfq'] = $this->Rfq_model->getRfqById($id);
			if ($data['rfq'] == null) {
				$this->session->set_flashdata('flash2', 'Nomor Request tidak ditemukan');
				redirect('rfq');
			}

			$status = $this->input->post('status', true);

			if ($this->input->post('id_jnsprmt_rfq') == 3) {
				$this->form_validation->set_rules('tgl_masuk', 'Nama', 'required|trim');
				$this->form_validation->set_rules('id_perusahaan', 'Perusahaan', 'required|trim');
				$this->form_validation->set_rules('id_customer[]', 'Customer', 'required|trim');
			} else {
				$this->form_validation->set_rules('tgl_masuk', 'Nama', 'required|trim');
				//$this->form_validation->set_rules('kode_project', 'Kode Project', 'required|trim');
				$this->form_validation->set_rules('dlKP', '', 'required|trim');
				$this->form_validation->set_rules('asKP', '', 'required|trim');
				$this->form_validation->set_rules('nama_project', 'Project', 'required|trim');
				$this->form_validation->set_rules('id_perusahaan', 'Perusahaan', 'required|trim');
				$this->form_validation->set_rules('id_customer[]', 'Customer', 'required|trim');
				$this->form_validation->set_rules('id_jnsprmt_rfq', 'Jenis Permintaan', 'required|trim');
				$this->form_validation->set_rules('id_krj_rfq[]', 'Kerja', 'required|trim');
				$this->form_validation->set_rules('id_methodology[]', 'Methodology', 'required|trim');
				$this->form_validation->set_rules('id_topic[]', 'Methodology', 'required|trim');
				$this->form_validation->set_rules('id_dokumen[]', 'Dokumen', 'required|trim');
				$this->form_validation->set_rules('id_request', 'Request', 'required|trim');
				//$this->form_validation->set_rules('tgl_proposal', 'Tanggal Pemberian Proposal', 'required|trim');
				$this->form_validation->set_rules('date_system', 'Date System', 'required|trim');
				$this->form_validation->set_rules('date_customer', 'Date Customer', 'required|trim');
				//$this->form_validation->set_rules('tgl_submit', 'Date Submit', 'required|trim');
				if ($status == 1) {
					$this->form_validation->set_rules('tgl_deal', 'Tanggal Deal', 'required|trim');
					//$this->form_validation->set_rules('template_project', 'Template Project Execution', 'required|trim');
				} else if ($status == 2) {
					$this->form_validation->set_rules('tgl_nodeal', 'Tanggal No Deal', 'required|trim');
					$this->form_validation->set_rules('id_batal', 'Alasan Gagal', 'required|trim');
					$this->form_validation->set_rules('masukan', 'Masukan Customer', 'required|trim');
				} else if ($status == 4) {
					$this->form_validation->set_rules('tgl_kirim_proposal', 'Tanggal Kirim Proposal', 'required|trim');
					if (empty($_FILES['file_proposal']['name']) and empty($this->input->post('oldfile_proposal'))) {
						$this->form_validation->set_rules('file_proposal', 'File Proposal', 'required');
					}
				} else if ($status == 5) {
					$this->form_validation->set_rules('tgl_presentasi', 'Tanggal Presentasi Proposal', 'required|trim');
				} else if ($status == 6) {
					$this->form_validation->set_rules('tgl_negosiasi', 'Tanggal Negosiasi', 'required|trim');
				}
			}

			if ($this->form_validation->run() == false) {
				$this->load->view('templates/header');
				$this->load->view('rfq/status', $data);
				$this->load->view('templates/footer');
			} else {

				$file = array();
				// CHECK FILE TOR
				if (!empty($_FILES['filedata']['name'])) {
					$file_name = $_FILES['filedata']['name'];
					$file_tmp = $_FILES['filedata']['tmp_name'];
					move_uploaded_file($file_tmp, "file/rfq/" . $file_name);

					$file[] = $file_name;
				} else {
					$file[] = $this->input->post('oldfiledata');
				}
				// CHECK FILE PROPOSAL
				if (!empty($_FILES['file_proposal']['name'])) {
					$file_name = $_FILES['file_proposal']['name'];
					$file_tmp = $_FILES['file_proposal']['tmp_name'];
					move_uploaded_file($file_tmp, "file/rfq/" . $file_name);

					$file[] = $file_name;
				} else {
					$file[] = $this->input->post('oldfile_proposal');
				}

				$this->Rfq_model->ubahDataRfq($file);
				if ($status == 1) {
					$rfq = $this->input->post('nomor_rfq');
					$this->session->set_flashdata('flash', 'Berhasil Disimpan, Silahkan buat Commision Voucher');
					redirect("commisionVoucher?rfq=$rfq");
				} else {
					$this->session->set_flashdata('flash', 'Berhasil Disimpan');
					redirect('rfq');
				}
			}
		}
	}

	public function kirimEmail()
	{
		ini_set('max_execution_time', '0');
		$iduser = $this->session->userdata('ses_id');
		$model = $this->User_model->getUserById($iduser);
		$surat = $this->Surat_model->getSuratById($this->input->post('jenis_surat'), true);
		$judul_email = $surat['jenis_surat'];
		$isi_email = str_replace('[Nomor Urut RFQ]', $this->input->post('id'), $surat['isi_surat']);
		$isi_email = str_replace('[Nama Project]', $this->input->post('nama_project', true), $isi_email);
		$isi_email = str_replace('[Nama Customer]', $this->input->post('nama_customer', true), $isi_email);
		$model['isi'] = nl2br($isi_email);
		$isi_email = $this->load->view('email/tem_email', $model, true);

		$email = explode(',', trim($this->input->post('email', true)));
		var_dump($email);
		die;

		$config = configEmail();
		$this->load->library('email', $config);
		$namaPengirim = $model['nama_user']; //'Marketing MRI';
		$emailPengirim = $model['email1']; //'mri.marketing@mri-research-ind.com';
		$this->email->from($emailPengirim, $namaPengirim);
		$this->email->subject($judul_email);
		$this->email->message($isi_email);


		//$this->email->reply_to('mri.marketing@mri-research-ind.com', $model['nama_user']);

		/*foreach ($email as $value) {
			$this->email->clear(true);
            //$this->email->from('apriweljenian76@gmail', $model['nama_user']);
            $this->email->from('mri.marketing@mri-research-ind.com', $model['nama_user']);
            $this->email->to($value);
            $this->email->subject($judul_email);
            $this->email->message($isi_email);

            if($this->email->send()){
                $data = 'terkirim';
            }else{
                $data = 'gagal';
            }

        }*/

		for ($x = 0; $x < count($email); $x++) {
			$cloned = clone $this->email;

			$cloned->to($email[$x]);

			if ($cloned->send()) {
				$data = 'terkirim';
			} else {
				$data = 'gagal';
			}
			$cloned->clear(true);
		}

		echo json_encode($data);
	}

	public function hapus($id)
	{
		$this->Rfq_model->hapusDataRfq($id);
		$this->session->set_flashdata('flash', 'Dihapus');
		redirect('rfq');
	}

	public function ubah($id)
	{
		$data['customer'] = $this->Rfq_model->getRfqById($id);

		$this->form_validation->set_rules('nama', 'Nama', 'required|trim');
		$this->form_validation->set_rules('status', 'Status', 'required|trim');
		$this->form_validation->set_rules('perusahaan', 'Perusahaan', 'required|trim');
		$this->form_validation->set_rules('dept', 'Dept', 'required|trim');
		$this->form_validation->set_rules('jabatan', 'Jabatan', 'required|trim');
		$this->form_validation->set_rules('hp1', 'Phone Number', 'required|trim');
		$this->form_validation->set_rules('email1', 'Email', 'required|trim|valid_email');

		if ($this->form_validation->run() == false) {
			$this->load->view('templates/header');
			$this->load->view('customer/ubah', $data);
			$this->load->view('templates/footer');
		} else {
			$this->Rfq_model->ubahDataRfq();
			$this->session->set_flashdata('flash', 'Diubah');
			redirect('customer');
		}
	}

	public function test()
	{
		$norfqnya = 'REQ202011050000107';
		$data = $this->db->query("SELECT nomor_rfq FROM data_rfq WHERE nomor_rfq = '$norfqnya'")->row_array();
		if ($data['nomor_rfq'] != null) { // JIKA NOMOR RFQ DARI INPUT OTOMATIS SUDAH ADA MAKA GENERATE NOMOR BARU
			echo "nomor rfq baru<bR><br>";
			$this->db->select('max(nomor_rfq) as maxKode, max(kode_project) as maxKP');
			$this->db->from('data_rfq');
			$data = $this->db->get()->row_array();
			$no_rfq = $data['maxKode'];
			$no_urut = (int)substr($no_rfq, 11);
			$no_urut++;
			$char = 'REQ';
			$date = date("Ymd");
			echo $noRfq['id'] = $char . $date . sprintf('%07s', $no_urut) . '<BR>';
			// OTOMATIS IKUT GENERATE NOMOR URUT BARU UNTUK KODE PROJECT
			$data = $this->db->query("SELECT max(kode_project) as maxKP FROM data_rfq WHERE nomor_rfq = '$norfqnya'")->row_array();
			$noKP = $data['maxKP'];
			if (date('Y-m-d') == date('Y-') . '01-01') { // JIKA SUDAH TAHUN BARU
				$noUrutKP = 1;
			} else {
				$noUrutKP = (int)substr($noKP, -3);
				$noUrutKP++;
			}
			$char = 'REQ';
			$date = date("Ymd");
			$noRfq['blnThnKP'] = date('m.Y');
			$noRfq['noUrutKP'] = sprintf('%03s', $noUrutKP);
			echo $noRfq['blnThnKP'] . '/' . $noRfq['noUrutKP'];
		} else {
			echo "tidak ada";
			$norfqnya; // KALAU GAK ADA SET DARI INPUT
		}
	}



	// Penambahan Tedi //
	public function carimethod()
	{
		$data = $this->db->query("SELECT * FROM data_methodology ORDER BY methodology ASC")->result_array();
		echo json_encode($data);
	}
	public function cariJenisPekerjaan()
	{
		$data = $this->db->query("SELECT * FROM data_krj_rfq ORDER BY jenis_pekerjaan ASC")->result_array();
		echo json_encode($data);
	}
	// edit Adam Santoso
	public function caridokumen()
	{
		$data = $this->db->query("SELECT * FROM data_dokumen ORDER BY keterangan ASC")->result_array();
		echo json_encode($data);
	}
	public function caritopic()
	{
		$data = $this->db->query("SELECT * FROM data_topic ORDER BY keterangan ASC")->result_array();
		echo json_encode($data);
	}
	public function download($file)
	{
		force_download('file/rfq/' . $file, NULL);
	}
}
