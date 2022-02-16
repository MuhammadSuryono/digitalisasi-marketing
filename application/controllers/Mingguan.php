<?php
defined('BASEPATH') or exit('No direct script access allowed');

use Dompdf\Dompdf;

class Mingguan extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('Mingguan_model');
    $this->load->library('form_validation');
    //Codeigniter : Write Less Do More
    if (!$this->session->userdata('ses_username')) {
      redirect('auth');
    }
  }

  public function homemingguan2()
  {
    $data['kelima'] = $this->Mingguan_model->getminggukelima();
    $data['kedua'] = $this->Mingguan_model->getminggukedua();
    $data['ketiga'] = $this->Mingguan_model->getmingguketiga();
    $data['keempat'] = $this->Mingguan_model->getminggukeempat();
    $data['prokelima'] = $this->Mingguan_model->getpekerjaankelima();
    $data['prokedua'] = $this->Mingguan_model->getpekerjaankedua();
    $data['proketiga'] = $this->Mingguan_model->getpekerjaanketiga();
    $data['prokeempat'] = $this->Mingguan_model->getpekerjaankeempat();
    $this->load->view('template/header');
    $this->load->view('template/sidebar');
    $this->load->view('mingguan/homemingguan', $data);
    $this->load->view('template/footer');
  }

  public function homemingguan3()
  {
    date_default_timezone_set('Asia/Jakarta');

    $tanggalnow = date('Y-m-d');
    $var = date('N', strtotime($tanggalnow));
    $awal = $var - 1;
    $akhir = 5 - $var;

    $senin = date('Y-m-d', strtotime("-$awal days", strtotime($tanggalnow)));
    $jumat = date('Y-m-d', strtotime("+$akhir days", strtotime($tanggalnow)));

    $dari       = $senin;
    $sampai     = date('Y-m-d', strtotime("+21 days", strtotime($dari)));

    $data['senin'] = $senin;
    $data['pekerjaan'] = $this->Mingguan_model->getPekerjaan($dari, $sampai);
    $data['tkmdivisi'] = $this->Mingguan_model->getTkmDivisi($dari, $sampai);
    // var_dump("A"); die;

    $data['kelima'] = $this->Mingguan_model->getminggukelima();
    $data['kedua'] = $this->Mingguan_model->getminggukedua();
    $data['ketiga'] = $this->Mingguan_model->getmingguketiga();
    $data['keempat'] = $this->Mingguan_model->getminggukeempat();
    $data['prokelima'] = $this->Mingguan_model->getpekerjaankelima();
    $data['prokedua'] = $this->Mingguan_model->getpekerjaankedua();
    $data['proketiga'] = $this->Mingguan_model->getpekerjaanketiga();
    $data['prokeempat'] = $this->Mingguan_model->getpekerjaankeempat();
    $this->load->view('template/header');
    $this->load->view('template/sidebar');
    $this->load->view('mingguan/homemingguan2', $data);
    $this->load->view('template/footer');
  }

  public function homemingguan()
  {
    date_default_timezone_set('Asia/Jakarta');

    $tanggalnow = date('Y-m-d');
    $var = date('N', strtotime($tanggalnow));
    $awal = $var - 1;
    $akhir = 5 - $var;

    $senin = date('Y-m-d', strtotime("-$awal days", strtotime($tanggalnow)));
    $jumat = date('Y-m-d', strtotime("+$akhir days", strtotime($tanggalnow)));

    $dari       = $senin;
    $sampai     = date('Y-m-d', strtotime("+21 days", strtotime($dari)));

    $data['senin'] = $senin;
    $data['pekerjaan'] = $this->Mingguan_model->getPekerjaan($dari, $sampai);
    $data['pekerjaan_lintasdivisi'] = $this->Mingguan_model->getPekerjaanLintasDivisi($dari, $sampai);
    $data['tkmdivisi'] = $this->Mingguan_model->getTkmDivisi($dari, $sampai);

    // var_dump("A"); die;

    // $data['kelima'] = $this->Mingguan_model->getminggukelima();
    // $data['kedua'] = $this->Mingguan_model->getminggukedua();
    // $data['ketiga'] = $this->Mingguan_model->getmingguketiga();
    // $data['keempat'] = $this->Mingguan_model->getminggukeempat();
    // $data['prokelima'] = $this->Mingguan_model->getpekerjaankelima();
    // $data['prokedua'] = $this->Mingguan_model->getpekerjaankedua();
    // $data['proketiga'] = $this->Mingguan_model->getpekerjaanketiga();
    // $data['prokeempat'] = $this->Mingguan_model->getpekerjaankeempat();

    $this->load->view('template/header');
    $this->load->view('template/sidebar');
    $this->load->view('mingguan/homemingguan3', $data);
    $this->load->view('template/footer');
  }

  public function isitkm($tanggal1, $tanggal2)
  {
    $this->form_validation->set_rules('project0', 'Project', 'required');

    if ($this->form_validation->run() == false) {
      $data['tanggalnya'] = [
        't1' => $tanggal1,
        't2' => $tanggal2,
      ];
      $divisi = $this->session->userdata('ses_divisi');
      $data['cariproject'] = $this->db->query("SELECT
                                                	a.*, SUM(a.persentase) AS sumper
                                                FROM
                                                	pekerjaan a
                                                JOIN tkmdivisi b ON a.idtkmdiv = b. NO
                                                WHERE
                                                b.divisi = '$divisi'
                                                GROUP BY
                                                	a.project
                                                	HAVING SUM(a.persentase) < 100")->result_array();
      $data['jmlpekerjaan'] = $this->db->query("SELECT
                                                	COUNT(a.no) AS nonya
                                                FROM
                                                	pekerjaan a
                                                JOIN tkmdivisi b ON a.idtkmdiv = b. NO
                                                WHERE
                                                b.divisi = '$divisi'
                                                GROUP BY
                                                	a.project
                                                	HAVING SUM(a.persentase) < 100")->row_array();


      $this->load->view('template/header');
      $this->load->view('template/sidebar');
      $this->load->view('mingguan/isitkmdivisi', $data);
      $this->load->view('template/footer');
    } else {
      $this->Mingguan_model->isitkmnya();
      $this->session->set_flashdata('flash2', 'TKM Berhasil Diisi');
      redirect('mingguan/homemingguan');
    }
  }

  public function isitkm2($tanggal1, $tanggal2)
  {
    $this->form_validation->set_rules('project0', 'Project', 'required');

    if ($this->form_validation->run() == false) {
      $data['tanggalnya'] = [
        't1' => $tanggal1,
        't2' => $tanggal2,
      ];
      $divisi = $this->session->userdata('ses_divisi');
      $data['cariproject'] = $this->db->query("SELECT
                                                	a.*, SUM(a.persentase) AS sumper
                                                FROM
                                                	pekerjaan a
                                                JOIN tkmdivisi b ON a.idtkmdiv = b. NO
                                                WHERE
                                                b.divisi = '$divisi'
                                                GROUP BY
                                                	a.project
                                                	HAVING SUM(a.persentase) < 100")->result_array();
      $data['jmlpekerjaan'] = $this->db->query("SELECT
                                                	COUNT(a.no) AS nonya
                                                FROM
                                                	pekerjaan a
                                                JOIN tkmdivisi b ON a.idtkmdiv = b. NO
                                                WHERE
                                                b.divisi = '$divisi'
                                                GROUP BY
                                                	a.project
                                                  HAVING SUM(a.persentase) < 100")->row_array();

      // $data['kategori'] = $this->db->get_where('kategori', ['divisi'=>$divisi])->result_array();

      $data['kategori'] = $this->db->query("SELECT * FROM kategori ORDER BY nama_kategori ASC")->result_array();

      $this->load->view('template/header');
      $this->load->view('template/sidebar');
      $this->load->view('mingguan/isitkmdivisi2', $data);
      $this->load->view('template/footer');
    } else {
      // var_dump("MASUK"); die;
      $this->Mingguan_model->isitkmnya2();
      $this->session->set_flashdata('flash2', 'TKM Berhasil Diisi');
      redirect('mingguan/homemingguan');
    }
  }

  public function simpantkm2()
  {
    // $banyakuraian = $this->input->post("uraian1");
    // var_dump("$banyakuraian"); die;
    $this->Mingguan_model->isitkmnya2();
    $this->session->set_flashdata('flash2', 'TKM Berhasil Diisi');
    redirect('mingguan/homemingguan');
  }

  public function isitkm3($tanggal1, $tanggal2)
  {
    $this->form_validation->set_rules('project0', 'Project', 'required');

    if ($this->form_validation->run() == false) {
      $data['tanggalnya'] = [
        't1' => $tanggal1,
        't2' => $tanggal2,
      ];
      $divisi = $this->session->userdata('ses_divisi');

      $data['cariproject'] = $this->db->query("SELECT
                                                	a.*,
                                                  SUM(a.persentase) AS sumper,
                                                  c.id_kategori AS idkategori,
                                                  c.nama_kategori AS namakategori
                                                FROM
                                                	pekerjaan a
                                                JOIN tkmdivisi b ON a.idtkmdiv = b. NO
                                                JOIN kategori c ON a.id_kategori = c.id_kategori
                                                WHERE
                                                b.divisi = '$divisi'
                                                GROUP BY
                                                	a.project
                                                	HAVING SUM(a.persentase) < 100")->result_array();
      $data['jmlpekerjaan'] = $this->db->query("SELECT
                                                	COUNT(a.no) AS nonya
                                                FROM
                                                	pekerjaan a
                                                JOIN tkmdivisi b ON a.idtkmdiv = b. NO
                                                WHERE
                                                b.divisi = '$divisi'
                                                GROUP BY
                                                	a.project
                                                  HAVING SUM(a.persentase) < 100")->row_array();

      // $data['kategori'] = $this->db->get_where('kategori', ['divisi'=>$divisi])->result_array();

      $data['kategori'] = $this->db->query("SELECT * FROM kategori ORDER BY nama_kategori ASC")->result_array();
      $data['divisi'] = $this->db->get_where('divisi', ['divisi!=' => $divisi])->result_array();

      $data['rincianPekerjaanSebelumnya'] = $this->db->where('bobotpersentase <', 100)->get('uraian')->result_array();

      // var_dump($data['rincianPekerjaanSebelumnya']);
      // die();

      $this->load->view('template/header');
      $this->load->view('template/sidebar');
      $this->load->view('mingguan/isitkmdivisi3', $data);
      $this->load->view('template/footer');
    } else {
      // var_dump("MASUK"); die;
      $this->Mingguan_model->isitkmnya2();
      $this->session->set_flashdata('flash2', 'TKM Berhasil Diisi');
      redirect('mingguan/homemingguan3');
    }
  }

  public function simpantkm3()
  {
    // $banyakuraian = $this->input->post("uraian1");
    // var_dump("$banyakuraian"); die;
    $this->Mingguan_model->isitkmnya3();
    $this->session->set_flashdata('flash2', 'TKM Berhasil Diisi');
    redirect('mingguan/homemingguan3');
  }

  // public function prosesisitkm(){
  //   $daritanggal      = $_POST['daritanggal'];
  //   $sampaitanggal    = $_POST['sampaitanggal'];
  //   $divisi           = $this->session->userdata('ses_divisi');
  //   $pengisi          = $this->session->userdata('ses_username');
  //   $target           = $_POST['target'];
  //   $status           = "Menunggu Approval";
  //
  //   $this->db->query("INSERT INTO tkmdivisi (divisi,pengisi,daritanggal,sampaitanggal,target,status)
  //                                     VALUES ('$divisi','$pengisi','$daritanggal','$sampaitanggal','$target','$status')");
  //
  //   $this->session->set_flashdata('flash2', 'TKM Berhasil Diisi');
  //   redirect('mingguan/homemingguan');
  // }

  public function approvalmingguan3()
  {
    // var_dump("MASUK"); die;
    $data['gettkm'] = $this->Mingguan_model->getalltkm();
    $this->load->view('template/header');
    $this->load->view('template/sidebar');
    $this->load->view('mingguan/approvalmingguan', $data);
    $this->load->view('template/footer');
  }

  public function approvalmingguan()
  {
    // var_dump("MASUK"); die;
    $data['gettkm'] = $this->Mingguan_model->getalltkm();
    $this->load->view('template/header');
    $this->load->view('template/sidebar');
    $this->load->view('mingguan/approvalmingguan3', $data);
    $this->load->view('template/footer');
  }

  public function approve($no)
  {
    $this->db->query("UPDATE tkmdivisi SET status='Disetujui' WHERE no='$no'");
    $this->session->set_flashdata('flash2', 'TKM Berhasil Di Approve');
    redirect('mingguan/approvalmingguan');
  }

  public function approveb1($tgl)
  {
    $divisi = $this->session->userdata('ses_divisi');
    $this->db->query("UPDATE tkmdivisi SET status='Disetujui' WHERE daritanggal='$tgl' AND divisi='$divisi'");
    $this->session->set_flashdata('flash2', 'TKM Berhasil Di Approve');
    redirect('mingguan/homemingguan');
  }

  public function edittkmdivisi($no)
  {
    $data['tkmnya'] = $this->db->query("SELECT * FROM tkmdivisi WHERE no='$no'")->row_array();
    $this->load->view('template/header');
    $this->load->view('template/sidebar');
    $this->load->view('mingguan/edittkmdivisi', $data);
    $this->load->view('template/footer');
  }

  public function prosesedittkm()
  {
    $no     = $_POST['no'];
    $target = $_POST['target'];
    $this->db->query("UPDATE tkmdivisi SET target='$target' WHERE no='$no'");
    if ($this->session->userdata['ses_akses'] == 'Direksi') {
      $this->session->set_flashdata('flash2', 'TKM Berhasil Di Hapus');
      redirect('mingguan/approvalmingguan');
    } else {
      $this->session->set_flashdata('flash2', 'TKM Berhasil Di Hapus');
      redirect('mingguan/homemingguan');
    }
  }

  public function deletetkmdivisi($no)
  {
    $this->db->query("DELETE FROM tkmdivisi WHERE no='$no'");
    $this->db->query("DELETE FROM pekerjaan WHERE idtkmdiv='$no'");
    if ($this->session->userdata['ses_akses'] == 'Direksi') {
      $this->session->set_flashdata('flash2', 'TKM Berhasil Di Hapus');
      redirect('mingguan/approvalmingguan');
    } else {
      $this->session->set_flashdata('flash2', 'TKM Berhasil Di Hapus');
      redirect('mingguan/homemingguan');
    }
  }

  public function deletetkmdivisi2($no)
  {
    $cek = $this->db->get_where('tkmdivisi', ['daritanggal' => $no, 'divisi' => $this->session->userdata('ses_divisi')])->row_array();
    $notkmdiv = $cek['no'];

    $this->db->query("DELETE FROM pekerjaan WHERE idtkmdiv='$notkmdiv'");
    $this->db->query("DELETE FROM tkmdivisi WHERE no='$notkmdiv'");

    if ($this->session->userdata['ses_akses'] == 'Direksi') {
      $this->session->set_flashdata('flash2', 'TKM Berhasil Di Hapus');
      redirect('mingguan/approvalmingguan');
    } else {
      $this->session->set_flashdata('flash2', 'TKM Berhasil Di Hapus');
      redirect('mingguan/homemingguan');
    }
  }

  public function deletetkmdivisi3($no)
  {
    $cek = $this->db->get_where('tkmdivisi', ['daritanggal' => $no, 'divisi' => $this->session->userdata('ses_divisi')])->row_array();
    $notkmdiv = $cek['no'];

    $this->db->query("DELETE FROM pekerjaan WHERE idtkmdiv='$notkmdiv'");
    $this->db->query("DELETE FROM pekerjaan_lintasdivisi WHERE idtkmdiv='$notkmdiv'");
    $this->db->query("DELETE FROM tkmdivisi WHERE no='$notkmdiv'");

    if ($this->session->userdata['ses_akses'] == 'Direksi') {
      $this->session->set_flashdata('flash2', 'TKM Berhasil Di Hapus');
      redirect('mingguan/approvalmingguan');
    } else {
      $this->session->set_flashdata('flash2', 'TKM Berhasil Di Hapus');
      redirect('mingguan/homemingguan2');
    }
  }

  public function listtkmdivisi()
  {
    // $data['pertamaapp'] = $this->Mingguan_model->getminggupertamaapp();
    // $data['keduaapp'] = $this->Mingguan_model->getminggukeduaapp();
    // $data['ketigaapp'] = $this->Mingguan_model->getmingguketigaapp();
    // $data['keempatapp'] = $this->Mingguan_model->getminggukeempatapp();
    // $data['kelimaapp'] = $this->Mingguan_model->getminggukelimaapp();
    // $data['keenamapp'] = $this->Mingguan_model->getminggukeenamapp();

    if ($this->session->userdata('ses_divisi') == 'FINANCE') {
      $data['tanggalnya'] = $this->db->query("SELECT * FROM tkmdivisi WHERE status='Disetujui' AND (divisi='FINANCE' OR divisi='SUB FINANCE') GROUP BY daritanggal,sampaitanggal")->result_array();
    } else {
      $data['tanggalnya'] = $this->db->query("SELECT * FROM tkmdivisi WHERE status='Disetujui' GROUP BY daritanggal,sampaitanggal")->result_array();
    }

    $this->load->view('template/header');
    $this->load->view('template/sidebar');
    $this->load->view('mingguan/listtkmdivisi', $data);
    $this->load->view('template/footer');
  }

  public function viewtkmdivisi($no)
  {
    $data['divnya'] = $this->db->query("SELECT * FROM tkmdivisi WHERE no='$no'")->row_array();
    $data['tkmdiv'] = $this->db->query("SELECT
                                              a.*,
                                              b.*,
                                              b.no as nopekerjaan
                                          FROM tkmdivisi a
                                          JOIN pekerjaan b ON a.no = b.idtkmdiv
                                          WHERE a.no='$no'")->result_array();
    $divisi = $data['divnya']['divisi'];
    $data['liststaff'] = $this->db->query("SELECT * FROM tb_user WHERE divisi='$divisi' AND aktif='Y' AND resign='0' ORDER BY nama_user")->result_array();

    $data['rincian'] = $this->db->query("SELECT
                                            a.*
                                          FROM rincian a
                                          JOIN tkmdivisi b ON a.idtkmdiv = b.no
                                          WHERE a.idtkmdiv = '$no' and userstaff is not null")->result_array();


    $this->load->view('template/header');
    $this->load->view('template/sidebar');
    $this->load->view('mingguan/viewtkmdivisi', $data);
    $this->load->view('template/footer');
  }

  public function viewtkmdivisi2($tgl)
  {
    $divisi = $this->session->userdata('ses_divisi');
    $data['divnya'] = $this->db->query("SELECT * FROM tkmdivisi WHERE daritanggal='$tgl' AND divisi='$divisi'")->row_array();
    $no = $data['divnya']['no'];

    $data['tkmdiv'] = $this->db->query("SELECT
                                              a.*,
                                              b.*,
                                              b.no as nopekerjaan
                                          FROM tkmdivisi a
                                          JOIN pekerjaan b ON a.no = b.idtkmdiv
                                          WHERE a.no='$no'")->result_array();
    //$divisi = $data['divnya']['divisi'];
    $data['liststaff'] = $this->db->query("SELECT * FROM tb_user WHERE divisi='$divisi' AND aktif='Y' AND resign='0' ORDER BY nama_user")->result_array();

    $data['rincian'] = $this->db->query("SELECT
                                            a.*
                                          FROM rincian a
                                          JOIN tkmdivisi b ON a.idtkmdiv = b.no
                                          WHERE a.idtkmdiv = '$no' and userstaff is not null")->result_array();

    $data['leader'] = $this->db->query("SELECT * FROM tb_user WHERE jabatan1='Leader 1' OR jabatan1='Leader 2' OR jabatan1='Leader 3'")->result_array();


    $this->load->view('template/header');
    $this->load->view('template/sidebar');
    $this->load->view('mingguan/viewtkmdivisi', $data);
    $this->load->view('template/footer');
  }

  public function viewtkmdivisi3($tgl)
  {
    $divisi = $this->session->userdata('ses_divisi');
    $data['divnya'] = $this->db->query("SELECT * FROM tkmdivisi WHERE daritanggal='$tgl' AND divisi='$divisi'")->row_array();
    $no = $data['divnya']['no'];

    $data['tkmdiv'] = $this->db->query("SELECT
                                              a.*,
                                              b.*,
                                              b.no as nopekerjaan
                                          FROM tkmdivisi a
                                          JOIN pekerjaan b ON a.no = b.idtkmdiv
                                          WHERE a.no='$no'")->result_array();
    //$divisi = $data['divnya']['divisi'];
    $data['liststaff'] = $this->db->query("SELECT * FROM tb_user WHERE divisi='$divisi' AND aktif='Y' AND resign='0' ORDER BY nama_user")->result_array();

    $data['rincian'] = $this->db->query("SELECT
                                            a.*
                                          FROM rincian a
                                          JOIN tkmdivisi b ON a.idtkmdiv = b.no
                                          WHERE a.idtkmdiv = '$no' and userstaff is not null")->result_array();

    $data['leader'] = $this->db->query("SELECT * FROM tb_user WHERE jabatan1='Leader 1' OR jabatan1='Leader 2' OR jabatan1='Leader 3'")->result_array();
    // var_dump($data);
    // die();

    $this->load->view('template/header');
    $this->load->view('template/sidebar');
    $this->load->view('mingguan/viewtkmdivisi3', $data);
    $this->load->view('template/footer');
  }

  public function isitkmstaff($username, $no)
  {
    $data['usernya'] = $this->db->query("SELECT * FROM tb_user WHERE id_user='$username'")->row_array();
    $data['divnya'] = $this->db->query("SELECT * FROM tkmdivisi WHERE no='$no'")->row_array();
    $data['tkmdiv'] = $this->db->query("SELECT
                                              a.*,
                                              b.*
                                          FROM tkmdivisi a
                                          JOIN pekerjaan b ON a.no = b.idtkmdiv
                                          WHERE a.no='$no'")->result_array();
    $data['tkmnya'] = $this->db->query("SELECT
                                              a.*,
                                              b.*
                                          FROM tkmdivisi a
                                          JOIN pekerjaan b ON a.no = b.idtkmdiv
                                          WHERE a.no='$no'")->result_array();

    $data['kerjaan'] = $this->db->query("SELECT
                                          			a.*
                                          FROM pekerjaan a
                                          JOIN tkmdivisi b ON a.idtkmdiv = b.no
                                          WHERE a.idtkmdiv = '$no'")->result_array();

    $this->load->view('template/header');
    $this->load->view('template/sidebar');
    $this->load->view('mingguan/isitkmstaff', $data);
    $this->load->view('template/footer');
  }

  public function isitkmstaff2($username, $no)
  {
    $data['usernya'] = $this->db->query("SELECT * FROM tb_user WHERE id_user='$username'")->row_array();
    $data['divnya'] = $this->db->query("SELECT * FROM tkmdivisi WHERE no='$no'")->row_array();
    $data['tkmdiv'] = $this->db->query("SELECT
                                              a.*,
                                              b.*
                                          FROM tkmdivisi a
                                          JOIN pekerjaan b ON a.no = b.idtkmdiv
                                          WHERE a.no='$no'")->result_array();
    $data['tkmnya'] = $this->db->query("SELECT
                                              a.*,
                                              b.*
                                          FROM tkmdivisi a
                                          JOIN pekerjaan b ON a.no = b.idtkmdiv
                                          WHERE a.no='$no'")->result_array();

    $data['kerjaan'] = $this->db->query("SELECT
                                          			a.*
                                          FROM pekerjaan a
                                          JOIN tkmdivisi b ON a.idtkmdiv = b.no
                                          WHERE a.idtkmdiv = '$no'")->result_array();

    $data['rincian'] = $this->db->query("SELECT
                                            a.*
                                          FROM rincian a
                                          JOIN tkmdivisi b ON a.idtkmdiv = b.no
                                          WHERE a.idtkmdiv = '$no' and userstaff='$username'")->result_array();


    $this->load->view('template/header');
    $this->load->view('template/sidebar');
    $this->load->view('mingguan/isitkmstaff2', $data);
    $this->load->view('template/footer');
  }

  public function isitkmstaff3($username, $no)
  {
    $data['usernya'] = $this->db->query("SELECT * FROM tb_user WHERE id_user='$username'")->row_array();
    $data['divnya'] = $this->db->query("SELECT * FROM tkmdivisi WHERE no='$no'")->row_array();
    $data['tkmdiv'] = $this->db->query("SELECT
                                              a.*,
                                              b.*
                                          FROM tkmdivisi a
                                          JOIN pekerjaan b ON a.no = b.idtkmdiv
                                          WHERE a.no='$no'")->result_array();
    $data['tkmnya'] = $this->db->query("SELECT
                                              a.*,
                                              b.*
                                          FROM tkmdivisi a
                                          JOIN pekerjaan b ON a.no = b.idtkmdiv
                                          WHERE a.no='$no'")->result_array();

    $data['kerjaan'] = $this->db->query("SELECT
                                          			a.*
                                          FROM pekerjaan a
                                          JOIN tkmdivisi b ON a.idtkmdiv = b.no
                                          WHERE a.idtkmdiv = '$no'")->result_array();

    $data['rincian'] = $this->db->query("SELECT
                                            a.*
                                          FROM rincian a
                                          JOIN tkmdivisi b ON a.idtkmdiv = b.no
                                          WHERE a.idtkmdiv = '$no' and userstaff='$username'")->result_array();


    $this->load->view('template/header');
    $this->load->view('template/sidebar');
    $this->load->view('mingguan/isitkmstaff3', $data);
    $this->load->view('template/footer');
  }

  public function isitkmstaff4($username, $no)
  {
    $data['usernya'] = $this->db->query("SELECT * FROM tb_user WHERE id_user='$username'")->row_array();
    $data['divnya'] = $this->db->query("SELECT * FROM tkmdivisi WHERE no='$no'")->row_array();
    $data['tkmdiv'] = $this->db->query("SELECT
                                              a.*,
                                              b.*
                                          FROM tkmdivisi a
                                          JOIN pekerjaan b ON a.no = b.idtkmdiv
                                          WHERE a.no='$no'")->result_array();
    $data['tkmnya'] = $this->db->query("SELECT
                                              a.*,
                                              b.*
                                          FROM tkmdivisi a
                                          JOIN pekerjaan b ON a.no = b.idtkmdiv
                                          WHERE a.no='$no'")->result_array();

    if ($data['divnya']['status'] == 'Disetujui') {
      $data['kerjaan'] = $this->db->query("SELECT
                                                  a.*
                                            FROM pekerjaan a
                                            JOIN tkmdivisi b ON a.idtkmdiv = b.no
                                            WHERE a.idtkmdiv = '$no'")->result_array();
    } else {
      $data['kerjaan'] = $this->db->query("SELECT
                                                  a.*
                                            FROM pekerjaan a
                                            JOIN tkmdivisi b ON a.idtkmdiv = b.no
                                            WHERE a.idtkmdiv = '$no' AND (a.id_kategori = 1 OR a.id_kategori = 2)")->result_array();
    }



    $data['rincian'] = $this->db->query("SELECT
                                            a.*
                                          FROM rincian a
                                          JOIN tkmdivisi b ON a.idtkmdiv = b.no
                                          WHERE a.idtkmdiv = '$no' and userstaff='$username'")->result_array();


    $this->load->view('template/header');
    $this->load->view('template/sidebar');
    $this->load->view('mingguan/isitkmstaff4', $data);
    $this->load->view('template/footer');
  }

  public function isitkmstaff5($username, $no)
  {
    $data['usernya'] = $this->db->query("SELECT * FROM tb_user WHERE id_user='$username'")->row_array();
    $data['divnya'] = $this->db->query("SELECT * FROM tkmdivisi WHERE no='$no'")->row_array();
    $data['tkmdiv'] = $this->db->query("SELECT
                                              a.*,
                                              b.*
                                          FROM tkmdivisi a
                                          JOIN pekerjaan b ON a.no = b.idtkmdiv
                                          WHERE a.no='$no'")->result_array();
    $data['tkmnya'] = $this->db->query("SELECT
                                              a.*,
                                              b.*
                                          FROM tkmdivisi a
                                          JOIN pekerjaan b ON a.no = b.idtkmdiv
                                          WHERE a.no='$no'")->result_array();



    if ($data['divnya']['status'] == 'Disetujui') {
      $data['kerjaan'] = $this->db->query("SELECT
                                                  a.*
                                            FROM pekerjaan a
                                            JOIN tkmdivisi b ON a.idtkmdiv = b.no
                                            WHERE a.idtkmdiv = '$no' AND a.persentase < 100")->result_array();
    } else {
      $data['kerjaan'] = $this->db->query("SELECT
                                                  a.*
                                            FROM pekerjaan a
                                            JOIN tkmdivisi b ON a.idtkmdiv = b.no
                                            WHERE a.idtkmdiv = '$no'AND a.persentase < 100 AND (a.id_kategori = 1 OR a.id_kategori = 2 OR b.divisi IN ('ITDP','FINANCE','HC (1)','OPERATION 2','OPERATION  - SUPPORT','HC'))")->result_array();
    }

    $data['rincian'] = $this->db->query("SELECT
                                            a.*
                                          FROM rincian a
                                          JOIN tkmdivisi b ON a.idtkmdiv = b.no
                                          WHERE a.idtkmdiv = '$no' and userstaff='$username'")->result_array();


    $this->load->view('template/header');
    $this->load->view('template/sidebar');
    $this->load->view('mingguan/isitkmstaff5', $data);
    $this->load->view('template/footer');
  }

  public function prosesisitkmstaff()
  {
    $idtkmdiv = $this->input->post('idtkmdiv');
    $this->Mingguan_model->isitkmstaffnya();
    $this->session->set_flashdata('flash2', 'TKM Staff Berhasil Diisi');
    redirect('mingguan/viewtkmdivisi/' . $idtkmdiv);
  }

  public function prosesisitkmstaff2()
  {
    $idtkmdiv = $this->input->post('idtkmdiv');
    $this->Mingguan_model->isitkmstaffnya2();
    $this->session->set_flashdata('flash2', 'TKM Staff Berhasil Diisi');
    redirect('mingguan/viewtkmdivisi/' . $idtkmdiv);
  }

  public function prosesisitkmstaff4()
  {
    $idtkmdiv = $this->input->post('idtkmdiv');
    $this->Mingguan_model->isitkmstaffnya4();
    $this->session->set_flashdata('flash2', 'TKM Staff Berhasil Diisi');
    redirect('mingguan/viewtkmdivisi/' . $idtkmdiv);
  }

  public function prosesisitkmstaff5()
  {
    $idtkmdiv = $this->input->post('tgldivisnya');
    $this->Mingguan_model->isitkmstaffnya5();
    $this->session->set_flashdata('flash2', 'TKM Staff Berhasil Diisi');
    redirect('mingguan/viewtkmdivisi3/' . $idtkmdiv);
  }

  public function edittkmstaff($no)
  {
    $data['tkmnya'] = $this->db->query("SELECT
                                              a.*,
                                              b.daritanggal,
                                              b.sampaitanggal,
                                              b.divisi,
                                              b.target AS targetdiv,
                                              c.nama_user
                                        FROM tkmstaff a
                                        JOIN tkmdivisi b ON a.idtkmdiv = b.no
                                        JOIN tb_user c ON a.userstaff = c.id_user
                                        WHERE a.no='$no'")->row_array();
    $this->load->view('template/header');
    $this->load->view('template/sidebar');
    $this->load->view('mingguan/edittkmstaff', $data);
    $this->load->view('template/footer');
  }

  public function prosesedittkmstaff()
  {
    $target       = $_POST['target'];
    $idtkmstaff   = $_POST['idtkmstaff'];
    $idtkmdiv     = $_POST['idtkmdiv'];
    $this->db->query("UPDATE tkmstaff SET target='$target' WHERE no='$idtkmstaff'");
    $this->session->set_flashdata('flash2', 'TKM Staff Berhasil Di Edit');
    redirect('mingguan/viewtkmdivisi/' . $idtkmdiv);
  }

  public function viewtkmstaff($username, $nodiv)
  {

    $data['usernya'] = $this->db->query("SELECT * FROM tb_user WHERE id_user='$username'")->row_array();

    $data['caritarget'] = $this->db->query("SELECT a.*,b.deskripsi FROM tkmstaff a JOIN pekerjaan b ON a.idtkmdiv = b.idtkmdiv AND a.project = b.project  WHERE a.userstaff='$username' AND a.idtkmdiv ='$nodiv'")->result_array();

    $gettanggal = $this->db->query("SELECT * FROM tkmdivisi WHERE no='$nodiv'")->row_array();
    $daritanggal = $gettanggal['daritanggal'];
    $sampaitanggal = $gettanggal['sampaitanggal'];

    $data['hariannya'] = $this->db->query("SELECT tanggal FROM tugasharian WHERE username='$username' AND tanggal BETWEEN '$daritanggal' AND '$sampaitanggal' GROUP BY tanggal")->result_array();

    $this->load->view('template/header');
    $this->load->view('template/sidebar');
    $this->load->view('mingguan/viewtkmstaff', $data);
    $this->load->view('template/footer');
  }

  public function edittkm($no)
  {
    $tkm = $this->db->get_where('tkmdivisi', ['no' => $no])->row_array();
    $divisi = $tkm['divisi'];

    $data['tkm'] = $tkm;
    $data['cariproject'] = $this->db->query("SELECT
                                              a.*
                                              FROM
                                                pekerjaan a
                                                JOIN tkmdivisi b ON a.idtkmdiv = b.NO
                                              WHERE
                                                a.idtkmdiv = $tkm[no]")->result_array();

    $data['uraian'] = $this->db->query("SELECT
                                              a.*,
                                              c.*
                                              FROM
                                                pekerjaan a
                                                JOIN tkmdivisi b ON a.idtkmdiv = b.NO
                                                LEFT JOIN uraian c on a.no = c.id_pekerjaan
                                              WHERE
                                                a.idtkmdiv = $tkm[no]")->result_array();

    $data['persentase'] = $this->db->query("SELECT
                                                a.*, SUM(a.persentase) AS sumper
                                              FROM
                                                pekerjaan a
                                              JOIN tkmdivisi b ON a.idtkmdiv = b. NO
                                              WHERE
                                              b.divisi = '$divisi'
                                              GROUP BY
                                                a.project
                                                HAVING SUM(a.persentase) < 100")->result_array();

    $data['kategori'] = $this->db->get_where('kategori', ['divisi' => $divisi])->result_array();


    $this->load->view('template/header');
    $this->load->view('template/sidebar');
    $this->load->view('mingguan/edittkmdivisi2', $data);
    $this->load->view('template/footer');
  }

  public function edittkmmanager($tgl)
  {
    $divisi = $this->session->userdata('ses_divisi');
    $data['divnya'] = $this->db->query("SELECT * FROM tkmdivisi WHERE daritanggal='$tgl' AND divisi='$divisi'")->row_array();
    $no = $data['divnya']['no'];

    $tkm = $this->db->get_where('tkmdivisi', ['no' => $no])->row_array();
    // $divisi = $tkm['divisi'];

    $data['tkm'] = $tkm;
    $data['cariproject'] = $this->db->query("SELECT
                                              a.*
                                              FROM
                                                pekerjaan a
                                                JOIN tkmdivisi b ON a.idtkmdiv = b.NO
                                              WHERE
                                                a.idtkmdiv = $tkm[no]")->result_array();

    $data['uraian'] = $this->db->query("SELECT
                                              a.*,
                                              c.*
                                              FROM
                                                pekerjaan a
                                                JOIN tkmdivisi b ON a.idtkmdiv = b.NO
                                                LEFT JOIN uraian c on a.no = c.id_pekerjaan
                                              WHERE
                                                a.idtkmdiv = $tkm[no]")->result_array();

    $data['persentase'] = $this->db->query("SELECT
                                                a.*, SUM(a.persentase) AS sumper
                                              FROM
                                                pekerjaan a
                                              JOIN tkmdivisi b ON a.idtkmdiv = b. NO
                                              WHERE
                                              b.divisi = '$divisi'
                                              GROUP BY
                                                a.project
                                                HAVING SUM(a.persentase) < 100")->result_array();

    $data['kategori'] = $this->db->get_where('kategori', ['divisi' => $divisi])->result_array();


    $this->load->view('template/header');
    $this->load->view('template/sidebar');
    $this->load->view('mingguan/edittkmmanager', $data);
    $this->load->view('template/footer');
  }


  public function tambahtkm($no)
  {
    $tkm = $this->db->get_where('tkmdivisi', ['no' => $no])->row_array();
    $divisi = $tkm['divisi'];

    $data['tkm'] = $tkm;
    $data['kategori'] = $this->db->get_where('kategori', ['divisi' => $divisi])->result_array();


    $this->load->view('template/header');
    $this->load->view('template/sidebar');
    $this->load->view('mingguan/tambahtargetkerja', $data);
    $this->load->view('template/footer');
  }

  public function tambahtkmdiv($tgl)
  {
    // $tkm = $this->db->get_where('tkmdivisi', ['no'=>$no])->row_array();
    // $divisi = $tkm['divisi'];
    $divisi = $this->session->userdata('ses_divisi');
    $tkm = $this->db->query("SELECT * FROM tkmdivisi WHERE daritanggal='$tgl' AND divisi='$divisi'")->row_array();

    $data['tkm'] = $tkm;
    $data['kategori'] = $this->db->get_where('kategori')->result_array();
    $data['divisi'] = $this->db->get_where('divisi', ['divisi!=' => $divisi])->result_array();
    $data['pekerjaanSebelumnya'] = $this->db->where('persentase <', 100)->get('pekerjaan')->result_array();
    $data['tkmDivSebelumnya'] = $this->db->where('daritanggal <=', date('Y-m-d'))->where('daritanggal >', date('Y-m-d', strtotime('-1 week')))->get('tkmdivisi')->result_array();
    $data['rincianPekerjaanSebelumnya'] = $this->db->where('bobotpersentase <', 100)->get('uraian')->result_array();


    $this->load->view('template/header');
    $this->load->view('template/sidebar');
    $this->load->view('mingguan/tambahtargetkerjadiv', $data);
    $this->load->view('template/footer');
  }


  public function simpantargetkerja()
  {
    $this->Mingguan_model->simpantargetkerja();
    $this->session->set_flashdata('flash2', 'Target Kerja Berhasil Di Simpan');
    redirect('mingguan/approvalmingguan');
  }

  public function simpantargetkerjadiv()
  {
    $this->Mingguan_model->simpantargetkerjadiv();
    $this->session->set_flashdata('flash2', 'Target Kerja Berhasil Di Simpan');
    redirect('mingguan/homemingguan');
  }

  public function simpantargetkerjadiv2()
  {
    $this->Mingguan_model->simpantargetkerjadiv2();
    $this->session->set_flashdata('flash2', 'Target Kerja Berhasil Di Simpan');
    redirect('mingguan/homemingguan');
  }

  public function simpanuraian()
  {
    $this->Mingguan_model->simpanuraian();
    $this->session->set_flashdata('flash2', 'Uraian Berhasil Di Simpan');
    redirect('mingguan/edittkm/' . $this->input->post('idtkm'));
  }

  public function edituraian()
  {
    $this->Mingguan_model->edituraian();
    $this->session->set_flashdata('flash2', 'Uraian Berhasil Diubah');
    redirect('mingguan/edittkm/' . $this->input->post('idtkm'));
  }

  public function hapusuraian($idtkm, $id)
  {
    $this->Mingguan_model->hapusuraian($id);
    $this->session->set_flashdata('flash2', 'Uraian Telah Di Hapus');
    redirect('mingguan/edittkm/' . $idtkm);
  }

  public function hapusdata()
  {
    $this->Mingguan_model->hapusdata();
    $this->session->set_flashdata('flash2', 'Data Telah Di Hapus');
    redirect('mingguan/edittkm/' . $this->input->post('idtkm'));
  }

  public function hapussemuadata()
  {
    $this->Mingguan_model->hapussemuadata();
    $this->session->set_flashdata('flash2', 'Data Telah Di Hapus');
    redirect('mingguan/approvalmingguan');
  }

  public function hapussemuadata3()
  {
    $this->Mingguan_model->hapussemuadata3();
    $this->session->set_flashdata('flash2', 'Data Telah Di Hapus');
    redirect('mingguan/approvalmingguan');
  }

  public function ubahtargetkerja()
  {
    $id = $_POST['id'];
    $val = $_POST['val'];
    $nama = $_POST['nama'];

    $data = [
      "$nama" => $val,
    ];

    $this->db->update('pekerjaan', $data, ['no' => $id]);
    echo json_encode($data);
  }

  public function tambahrincian()
  {
    $nomor = $_POST['nomor'];
    $data['rinciannya'] = $this->db->query("SELECT * FROM uraian WHERE id_pekerjaan='$nomor'")->result_array();
    $this->load->view('mingguan/addrincian', $data);
  }

  public function laporantimesheet()
  {
    $pencari  = $this->session->userdata('ses_username');
    $divisinya = $this->session->userdata('ses_divisi');

    if ($this->session->userdata('ses_akses') == 'Direksi' or $this->session->userdata('ses_divisi') == 'HC (1)' or $this->session->userdata('ses_username') == 'alfi') {
      $data['user'] = $this->db->query("SELECT * FROM tb_user WHERE jabatan1!='' AND hak_akses !='Direksi' ORDER BY nama_user ASC")->result_array();
    } elseif ($this->session->userdata('ses_akses') == 'Manager') {
      $data['user'] = $this->db->query("SELECT * FROM tb_user WHERE jabatan1!='' AND divisi='$divisinya' ORDER BY nama_user ASC")->result_array();
    } else {
      $data['user'] = $this->db->query("SELECT * FROM tb_user WHERE id_user='$pencari'")->result_array();
    }

    if ($this->input->post()) {
      $divisinya      = $this->session->userdata('ses_divisi');
      $data['tglterakhir'] = [
        "daritanggal" => $this->input->post('daritanggal'),
        "sampaitanggal" => $this->input->post('sampaitanggal')
      ];

      $this->session->set_flashdata('flash2', 'Pencarian Berhasil');
    } else {
      $data['tglterakhir'] = $this->db->query("SELECT * FROM tanggalhistory WHERE pencari='$pencari' ORDER BY no DESC LIMIT 1")->row_array();
    }
    // Hari Libur
    $db2 = $this->load->database('database_kedua', TRUE);

    $daritanggal    = $data['tglterakhir']['daritanggal'];
    $sampaitanggal  = $data['tglterakhir']['sampaitanggal'];

    $data['dataHariLibur'] = $db2->query("SELECT * FROM kalender WHERE tanggal BETWEEN '$daritanggal' AND '$sampaitanggal' AND tambahan = 'N'")->result_array();

    $this->db->query("INSERT INTO tanggalhistory(daritanggal,sampaitanggal,pencari) VALUES ('$daritanggal','$sampaitanggal','$pencari')");

    $this->load->view('template/header');
    $this->load->view('template/sidebar');
    $this->load->view('mingguan/laporantimesheet3', $data);
    $this->load->view('template/footer');
  }

  public function proseslaporan()
  {

    $pencari        = $this->input->post('pencari');
    $daritanggal    = $this->input->post('daritanggal');
    $sampaitanggal  = $this->input->post('sampaitanggal');
    $divisinya      = $this->session->userdata('ses_divisi');
    $user           = $this->session->userdata('ses_username');

    // // +++++++++++++++++++++++++++

    if ($this->session->userdata('ses_akses') == 'Direksi' or $this->session->userdata('ses_divisi') == 'HC (1)' or $this->session->userdata('ses_username') == 'alfi') {
      $data['namanya'] = $this->db->query("SELECT * FROM tb_user WHERE jabatan1!='' AND hak_akses !='Direksi' ORDER BY nama_user ASC")->result_array();
    } elseif ($this->session->userdata('ses_akses') == 'Manager') {
      $data['namanya'] = $this->db->query("SELECT * FROM tb_user WHERE jabatan1!='' AND divisi='$divisinya' ORDER BY nama_user ASC")->result_array();
    } else {
      $data['namanya'] = $this->db->query("SELECT * FROM tb_user WHERE id_user='$pencari'")->result_array();
    }


    $insertketgl = $this->db->query("INSERT INTO tanggalhistory(daritanggal,sampaitanggal,pencari) VALUES ('$daritanggal','$sampaitanggal','$pencari')");

    $data['tglterakhir'] = $this->db->query("SELECT * FROM tanggalhistory WHERE pencari='$pencari' ORDER BY no DESC LIMIT 1")->row_array();

    $this->load->view('template/header');
    $this->load->view('template/sidebar');
    $this->session->set_flashdata('flash2', 'Pencarian Berhasil');
    $this->load->view('mingguan/laporantimesheet3', $data);
    $this->load->view('template/footer');
  }

  public function laporanpayrol()
  {
    $pencari  = $this->session->userdata('ses_username');
    $divisinya = $this->session->userdata('ses_divisi');
    $data['tglterakhir'] = $this->db->query("SELECT * FROM tanggalhistory WHERE pencari='$pencari' ORDER BY no DESC LIMIT 1")->row_array();

    if ($this->session->userdata('ses_akses') == 'Direksi' or $this->session->userdata('ses_divisi') == 'HC (1)' or $this->session->userdata('ses_username') == 'alfi') {
      $data['namanya'] = $this->db->query("SELECT * FROM tb_user WHERE jabatan1!='' AND hak_akses !='Direksi' ORDER BY nama_user ASC")->result_array();
    } else {
      $data['namanya'] = $this->db->query("SELECT * FROM tb_user WHERE jabatan1!='' AND divisi='$divisinya' ORDER BY nama_user ASC")->result_array();
    }

    if ($this->input->post()) {
      $divisinya      = $this->session->userdata('ses_divisi');
      $data['tglterakhir'] = [
        "daritanggal" => $this->input->post('daritanggal'),
        "sampaitanggal" => $this->input->post('sampaitanggal')
      ];

      $this->session->set_flashdata('flash2', 'Pencarian Berhasil');
    } else {
      $data['tglterakhir'] = $this->db->query("SELECT * FROM tanggalhistory WHERE pencari='$pencari' ORDER BY no DESC LIMIT 1")->row_array();
    }

    $db2 = $this->load->database('database_kedua', TRUE);

    $daritanggal    = $data['tglterakhir']['daritanggal'];
    $sampaitanggal  = $data['tglterakhir']['sampaitanggal'];

    $data['dataHariLibur'] = $db2->query("SELECT * FROM kalender WHERE tanggal BETWEEN '$daritanggal' AND '$sampaitanggal' AND tambahan = 'N'")->result_array();

    // var_dump($data['dataHariLibur']);
    // die();
    $this->db->query("INSERT INTO tanggalhistory(daritanggal,sampaitanggal,pencari) VALUES ('$daritanggal','$sampaitanggal','$pencari')");

    $this->load->view('template/header');
    $this->load->view('template/sidebar');
    $this->load->view('mingguan/laporanpayrol1', $data);
    $this->load->view('template/footer');
  }

  public function prosespayrol()
  {
    $pencari        = $this->input->post('pencari');
    $daritanggal    = $this->input->post('daritanggal');
    $sampaitanggal  = $this->input->post('sampaitanggal');
    $divisinya = $this->session->userdata('ses_divisi');

    if ($this->session->userdata('ses_akses') == 'Direksi' or $this->session->userdata('ses_divisi') == 'HC (1)' or $this->session->userdata('ses_username') == 'alfi') {
      $data['namanya'] = $this->db->query("SELECT * FROM tb_user WHERE jabatan1!='' AND hak_akses !='Direksi' ORDER BY nama_user ASC")->result_array();
    } else {
      $data['namanya'] = $this->db->query("SELECT * FROM tb_user WHERE jabatan1!='' AND divisi='$divisinya' ORDER BY nama_user ASC")->result_array();
    }

    $insertketgl = $this->db->query("INSERT INTO tanggalhistory(daritanggal,sampaitanggal,pencari) VALUES ('$daritanggal','$sampaitanggal','$pencari')");

    $data['tglterakhir'] = $this->db->query("SELECT * FROM tanggalhistory WHERE pencari='$pencari' ORDER BY no DESC LIMIT 1")->row_array();


    $this->load->view('template/header');
    $this->load->view('template/sidebar');
    $this->session->set_flashdata('flash2', 'Pencarian Berhasil');
    $this->load->view('mingguan/laporanpayrol1', $data);
    $this->load->view('template/footer');
  }

  public function viewlintasdivisi($tgl)
  {
    $divisi = $this->session->userdata('ses_divisi');
    // $data['divnya'] = $this->db->query("SELECT * FROM pekerjaan_lintasdivisi WHERE daritanggal='$tgl' AND divisi='$divisi'")->row_array();
    // $no = $data['divnya']['no'];

    // $data['tkmdiv'] = $this->db->query("SELECT
    //                                           a.*,
    //                                           b.*,
    //                                           b.no as nopekerjaan
    //                                       FROM tkmdivisi a
    //                                       JOIN pekerjaan b ON a.no = b.idtkmdiv
    //                                       WHERE a.no='$no'")->result_array();
    //$divisi = $data['divnya']['divisi'];

    $data['tanggal'] = ['tanggalnya' => $tgl];

    $data['tkmdiv'] = $this->db->query("SELECT
                                        	a.*,
                                        	b.nama_kategori AS namakategori,
                                        	c.divisi AS fromdivisi
                                        FROM
                                        	pekerjaan_lintasdivisi a
                                        JOIN kategori b ON a.id_kategori = b.id_kategori
                                        JOIN tkmdivisi c ON a.idtkmdiv = c.no
                                        WHERE
                                        	a.daritanggal = '$tgl'
                                        AND a.divisi = '$divisi'")->result_array();

    $data['liststaff'] = $this->db->query("SELECT * FROM tb_user WHERE divisi='$divisi' AND divisi!='' AND aktif='Y' AND resign='0' ORDER BY nama_user")->result_array();

    // $data['rincian'] = $this->db->query("SELECT
    //                                         a.*
    //                                       FROM rincian a
    //                                       JOIN tkmdivisi b ON a.idtkmdiv = b.no
    //                                       WHERE a.idtkmdiv = '$no' and userstaff is not null")->result_array();

    $data['leader'] = $this->db->query("SELECT * FROM tb_user WHERE jabatan1='Leader 1' OR jabatan1='Leader 2' OR jabatan1='Leader 3'")->result_array();


    $this->load->view('template/header');
    $this->load->view('template/sidebar');
    $this->load->view('mingguan/viewlintasdivisi', $data);
    $this->load->view('template/footer');
  }

  public function isitkmstafflintas($username, $tanggal)
  {
    $data['usernya'] = $this->db->query("SELECT * FROM tb_user WHERE id_user='$username'")->row_array();

    // $divisinya = $data['usernya']['divisi'];
    //
    // $data['tkmdiv'] = $this->db->query("SELECT
    //                                       	a.*,
    //                                       	b.project AS projectnya
    //                                       FROM
    //                                       	pekerjaan_lintasdivisi a
    //                                       JOIN tkmstaff b ON a.idtkmdiv = b.idtkmdiv
    //                                       WHERE
    //                                       	a.daritanggal = '$tanggal'
    //                                       AND a.divisi = '$divisinya'
    //                                       AND b.userstaff ='$username")->result_array();
    //
    //
    // if($data['divnya']['status'] == 'Disetujui'){
    //   $data['kerjaan'] = $this->db->query("SELECT
    //                                               a.*
    //                                         FROM pekerjaan a
    //                                         JOIN tkmdivisi b ON a.idtkmdiv = b.no
    //                                         WHERE a.idtkmdiv = '$no'")->result_array();
    // }else{
    //   $data['kerjaan'] = $this->db->query("SELECT
    //                                               a.*
    //                                         FROM pekerjaan a
    //                                         JOIN tkmdivisi b ON a.idtkmdiv = b.no
    //                                         WHERE a.idtkmdiv = '$no' AND (a.id_kategori = 1 OR a.id_kategori = 2)")->result_array();
    // }
    //
    // $data['rincian'] = $this->db->query("SELECT
    //                                         a.*
    //                                       FROM rincian a
    //                                       JOIN tkmdivisi b ON a.idtkmdiv = b.no
    //                                       WHERE a.idtkmdiv = '$no' and userstaff='$username'")->result_array();

    // $carilintas = $this->db->query("SELECT
    //                                       a.*,
    //                                       b.nama_kategori AS namakategori,
    //                                   FROM pekerjaan_lintasdivisi a
    //                                   JOIN kategori b ON a.id_kategori = b.id_kategori
    //                                   JOIN tkmdivisi c ON a.idtkmdiv = c.no
    //                                   WHERE daritanggal='$tanggal'
    //                                   AND divisi='$usernya[divisi]'")->result_array();

    $data['tanggal'] = ['tanggalnya' => $tanggal];


    $this->load->view('template/header');
    $this->load->view('template/sidebar');
    $this->load->view('mingguan/isitkmstafflintas', $data);
    $this->load->view('template/footer');
  }

  public function pekerjaanSelesai($id)
  {
    $this->Mingguan_model->updatePekerjaanSelesai($id);
    $this->session->set_flashdata('flash2', 'TKM Berhasil Diselesaikan');
    redirect('mingguan/homemingguan');
  }

  public function print()
  {
    $dompdf = new Dompdf();
  }
}
