<?php
defined('BASEPATH') or exit('No direct script access allowed');

use Dompdf\Dompdf;

class ProjectSpec extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if ($this->session->userdata('masuk') != true) {
            $url = base_url();
            redirect($url);
        }

        role_access();

        $this->load->model('ProjectSpec_model');
        $this->load->model('Rfq_model');
        $this->load->library('form_validation');
        date_default_timezone_set('Asia/Jakarta');
    }

    public function index()
    {
        $data['rfq'] = $this->Rfq_model->getAllRfq();
        $this->load->view('templates/header');
        $this->load->view('projectspec/index', $data);
        $this->load->view('templates/footer');
    }

    public function view($id)
    {
        error_reporting(0);
        $data['re'] = $this->ProjectSpec_model->getUser(8);
        $data['dp'] = $this->ProjectSpec_model->getUser(9);
        $data['field'] = $this->ProjectSpec_model->getUser(10);
        $data['qa'] = $this->ProjectSpec_model->getUser(11);
        $data['auvi'] = $this->ProjectSpec_model->getUser(12);
        $data['finance'] = $this->ProjectSpec_model->getUser(13);
        $data['rfq'] = $this->Rfq_model->getRfqById($id);
        $data['ppd'] = $this->ProjectSpec_model->getPPDataByAdam($id, $data['rfq']);
        $data['kota'] = $this->Kota_model->getAllKota();
        $data['ps'] = $this->ProjectSpec_model->getPsByRfq($id);

        $this->load->view('templates/header');
        $this->load->view('projectspec/view', $data);
        $this->load->view('templates/footer');
    }

    public function responden()
    {
        $rfq = $_GET['rfq'];
        $data = $this->ProjectSpec_model->getResponden($rfq);
        if(count($data) > 0){
          echo json_encode($data);
        }else{
          echo 'error';
        }
    }

    public function updatePP()
    {
        $rfq = $_GET['rfq'];
        $data = $this->ProjectSpec_model->updatePPByAdam($rfq);
        echo json_encode($data);
    }


    public function addResponden()
    {
        $data = $this->ProjectSpec_model->addDataResponden();
        echo json_encode($data);
    }

    public function deleteKota()
    {
        $data = $this->ProjectSpec_model->delDataKota($this->input->get('id'));
        echo json_encode($data);
    }

    public function tim()
    {
        $dep = $_GET['id'];
        $rfq = $_GET['rfq'];
        $data = $this->ProjectSpec_model->getTim($dep, $rfq);
        echo json_encode($data);
    }

    public function addTim()
    {
        $data = $this->ProjectSpec_model->addDataTim();

        echo json_encode($data);
    }

    public function deleteTim()
    {
        $data = $this->ProjectSpec_model->delDataTim($this->input->get('id'));

        echo json_encode($data);
    }

    public function kirimEmail()
    {
        $dep = $this->input->get('id');
        $rfq = $this->input->get('rfq');
        $iduser = $this->session->userdata('ses_id');
        $model = $this->User_model->getUserById($iduser);
        $tim = $this->ProjectSpec_model->getDataTim($dep, $rfq);
        $judul_email = 'Pesan Email';
        $isi_email = 'ini isi email';


        if(count($tim) == 0){
            $data = 'gagal';
        }else{
          $config = configEmail();
      		$this->load->library('email', $config);
      		$namaPengirim = $model['nama_user']; //'Marketing MRI';
      		$emailPengirim = $model['email1']; //'mri.marketing@mri-research-ind.com';
      		$this->email->from($emailPengirim, $namaPengirim);
      		$this->email->subject('Document Project Spec '.$rfq);
      		//$this->email->set_header('Cc', 'mri.marketing@mri-research-ind.com');
          $dompdf = new Dompdf();
          $dompdf->set_option('isRemoteEnabled', TRUE);
          $docPS = $this->ProjectSpec_model->getPsByRfq($id);
          $css = '<style type="text/css">.tbl-spec{table-layout:fixed!important;width:100%!important;word-wrap:break-word!important}.tbl-logo{text-align:center!important;vertical-align:middle!important}.b-t{border-top:1px solid #000!important}.b-b{border-bottom:1px solid #000!important}.b-l{border-left:1px solid #000!important}.b-r{border-right:1px solid #000!important}.b-all{border:1px solid #000!important}.bg-b{background:#000!important;color:#FFF!important;font-weight:bold!important;text-align:center!important}.text-center{text-align:center!important}</style>';
          $data = htmlspecialchars_decode($docPS['keterangan'], ENT_QUOTES );
          $dompdf->load_html($css.$data);
          $dompdf->set_paper('A4', 'portait');
          $dompdf->render();
          $pdf = $dompdf->output('Document Project Spec '.$rfq.'.pdf'); // SET ATTACHMETN FILE

      		foreach($tim as $db){
      			$isi = '<p>Halo, '.$db['nama_user'].'</p><p>Berikut ini terlampir dokumen project spec dari nomor request: '.$rfq.'</p>';
      			$model['isi'] = nl2br($isi);
      			$isi_email =  $this->load->view('email/tem_email',$model, true);
      			$penerima[] = $db['email1'];
            $pesan[] = $isi_email;
      		}

      		for ($x = 0; $x < count($penerima); $x++){
      			$cloned = clone $this->email;
      			$cloned->to($penerima[$x]);
      			$cloned->message($pesan[$x]);
      			$cloned->attach($pdf);

      			if ($cloned->send()){
      				$data = "terkirim";
      			} else {
      				$data = "gagal";
      			}
      			$cloned->clear(TRUE);
      		}
        }

        echo json_encode($data);

    }

    public function hapus($id)
    {
        $this->Surat_model->hapusDataSurat($id);
		$this->session->set_flashdata('flash', 'Dihapus');
        redirect('surat');
    }

    public function ubah($id)
    {
            $this->ProjectSpec_model->ubahSpec($id);
            $this->session->set_flashdata('flash', 'Disimpan');
            redirect('projectSpec/view/'.$id);
    }

    public function printPdf($status, $id)
    {
      $dompdf = new Dompdf();
      $dompdf->set_option('isRemoteEnabled', TRUE);
      $docPS = $this->ProjectSpec_model->getPsByRfq($id);
      $css = '<style type="text/css">.tbl-spec{table-layout:fixed!important;width:100%!important;word-wrap:break-word!important;}.tbl-logo{text-align:center!important;vertical-align:middle!important}.b-t{border-top:1px solid #000!important}.b-b{border-bottom:1px solid #000!important}.b-l{border-left:1px solid #000!important}.b-r{border-right:1px solid #000!important}.b-all{border:1px solid #000!important}.bg-b{background:#000!important;color:#FFF!important;font-weight:bold!important;text-align:center!important}.text-center{text-align:center!important}.footer-doc{position:fixed;bottom:0px;font-size:12px;color:#111;text-align:left}table td {page-break-before: always;}</style>';
      $footerDoc = '<div class="footer-doc">Dokumen ini dibuat melalui Aplikasi Digitalisasi Marketing. Kode Dokumen: '.$docPS['kode_dokumen'].'</div>';
      $data = htmlspecialchars_decode($docPS['keterangan'], ENT_QUOTES );
      $dompdf->load_html($css.$data.$footerDoc);
      $dompdf->set_paper('A4', 'portait');
      $dompdf->render();
      $pdf = $dompdf->output();
      if ($status == "view") $dompdf->stream('Document Project Spec '.$id.'.pdf', array("Attachment" => false));
      else $dompdf->stream('Document Project Spec '.$id.'.pdf', array("Attachment" => true));
    }

    function coba(){

    }
}
