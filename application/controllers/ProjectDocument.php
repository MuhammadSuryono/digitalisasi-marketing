<?php
defined('BASEPATH') or exit('No direct script access allowed');

use Dompdf\Dompdf;

class ProjectDocument extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();

    if ($this->session->userdata('masuk') != true) {
      $url = base_url();
      redirect($url);
    }

    role_access();

    $this->load->model('ProjectDocument_model');
    $this->load->model('TemplateProjectPlan_model');
    $this->load->model('ProjectPlan_model');
    $this->load->model('CommisionVoucher_model');
    $this->load->model('MataUang_model');
    $this->load->library('form_validation');
    $this->load->helper('download');
    date_default_timezone_set('Asia/Jakarta');
  }

  public function index()
  {
    error_reporting(0); //menyembunyikan pesan kesalahan karena beberapa var belum di set jika data project document masih kosong
    $data['doc'] = $this->ProjectDocument_model->getAllDocument();
    $data['list'] = $this->ProjectDocument_model->listReadyAddDocument();
    $this->load->view('templates/header');
    $this->load->view('projectdocument/index', $data);
    $this->load->view('templates/footer');
  }

  public function tambah()
  {
    redirect('projectDocument/document/' . $this->input->post('nomor_rfq', true));
  }

  public function hapus($id)
  {
    $hapus = $this->ProjectDocument_model->deleteDocument($id);
    if ($hapus) {
      $this->session->set_flashdata('flash', 'Semua Data Dokumen Berhasil Dihapus');
      redirect('projectDocument/');
    }
  }

  public function document($id)
  {
    $check = $this->ProjectDocument_model->checkDocument($id);
    $data['methodology'] = $this->db->select('methodology')->select('keterangan')->get('data_methodology')->result_array();

    $this->load->view('templates/header');
    if ($check) {
      $data['file'] = $this->ProjectDocument_model->getDocument($id);
      $data['user'] = $this->ProjectDocument_model->getCustomerDocument($id)[0];
      $data['commVoucher'] = $this->CommisionVoucher_model->getCommVoucher($id);
      $this->load->view('projectdocument/view', $data);
    } else {
      $this->load->view('projectdocument/view');
    }
    $this->load->view('templates/footer');
  }

  public function upload($id)
  {
    error_reporting(0);
    $check = $this->ProjectDocument_model->getDocument($id);

    $x21 = unserialize($check['document_x21']);
    $x22 = unserialize($check['document_x22']);
    $x23 = unserialize($check['document_x23']);
    $x24 = unserialize($check['document_x24']);

    foreach ($_FILES['x21']['name'] as $key => $tmp_name) {
      if ($x21[$key] == null and $_FILES['x21']['name'][$key] != null) {
        $file_name = str_replace(' ', '', $_FILES['x21']['name'][$key]);
        $file_tmp = $_FILES['x21']['tmp_name'][$key];
        move_uploaded_file($file_tmp, "./file/document/" . $file_name);
        $fileX21[] = $file_name;
      } else {
        $fileX21[] = $x21[$key];
      }
    }

    foreach ($_FILES['x22']['name'] as $key => $tmp_name) {
      if ($x22[$key] == null and $_FILES['x22']['name'][$key] != null) {
        $file_name = str_replace(' ', '', $_FILES['x22']['name'][$key]);
        $file_tmp = $_FILES['x22']['tmp_name'][$key];
        move_uploaded_file($file_tmp, "./file/document/" . $file_name);
        $fileX22[] = $file_name;
      } else {
        $fileX22[] = $x22[$key];
      }
    }

    foreach ($_FILES['x23']['name'] as $key => $tmp_name) {
      if ($x23[$key] == null and $_FILES['x23']['name'][$key] != null) {
        $file_name = str_replace(' ', '', $_FILES['x23']['name'][$key]);
        $file_tmp = $_FILES['x23']['tmp_name'][$key];
        move_uploaded_file($file_tmp, "./file/document/" . $file_name);
        $fileX23[] = $file_name;
      } else {
        $fileX23[] = $x23[$key];
      }
    }

    foreach ($_FILES['x24']['name'] as $key => $tmp_name) {
      if ($x24[$key] == null and $_FILES['x24']['name'][$key] != null) {
        $file_name = str_replace(' ', '', $_FILES['x24']['name'][$key]);
        $file_tmp = $_FILES['x24']['tmp_name'][$key];
        move_uploaded_file($file_tmp, "./file/document/" . $file_name);
        $fileX24[] = $file_name;
      } else {
        $fileX24[] = $x24[$key];
      }
    }

    $fileX21 = serialize($fileX21);
    $fileX22 = serialize($fileX22);
    $fileX23 = serialize($fileX23);
    $fileX24 = serialize($fileX24);

    $upload = $this->ProjectDocument_model->upDocument($id, $fileX21, $fileX22, $fileX23, $fileX24);

    if ($upload) {
      $this->session->set_flashdata('flash', 'Berhasil Ditambahkan');
      redirect('projectDocument/document/' . $id);
    }
  }

  public function download($file)
  {
    force_download('file/document/' . $file, NULL);
  }

  public function tambahCommVoucher()
  {
    $this->session->set_flashdata('flash', 'Berhasil Ditambahkan');
    $this->CommisionVoucher_model->setCommVoucher();
    redirect('projectDocument/document/' . $this->input->post('nomor_rfq'));
  }

  public function updateCommVoucher()
  {
    $this->session->set_flashdata('flash', 'Berhasil Diubah');
    $this->CommisionVoucher_model->editCommVoucher();
    redirect('projectDocument/document/' . $this->input->post('nomor_rfq'));
  }

  public function printPdf($id)
  {
    // def("DOMPDF_ENABLE_REMOTE", false);
    $dompdf = new Dompdf();

    $data['commVoucher'] = $this->CommisionVoucher_model->getCommVoucher($id);

    $id_login = $this->session->userdata('ses_id');
    $jbtn_login = $this->session->userdata('ses_jabatan');
    $dept_login = $this->session->userdata('ses_level');
    if ($id != null) {
      if ($data['commVoucher']['created_by'] == $id_login or ($dept_login == '13' and $jbtn_login == '57') or ($dept_login == '8' and $jbtn_login == '57') or $jbtn_login == '24') {
        $html = $this->load->view('projectdocument/print', $data, true);
      } else {
        $this->session->set_flashdata('flash2', 'Akses dokumen dibatasi');
        redirect('projectDocument');
      }
    }

    // $this->pdf->load_view($html, $data);
    $dompdf->load_html($html);

    $dompdf->set_paper('A4', 'portait');

    $dompdf->render();

    $pdf = $dompdf->output();

    if ($this->input->get('status') == "view") $dompdf->stream('Commission Voucher.pdf', array("Attachment" => false));
    else $dompdf->stream('Commission Voucher.pdf', array("Attachment" => true));
  }
}
