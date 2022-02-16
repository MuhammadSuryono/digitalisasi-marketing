<?php

class Rfq_model extends CI_model
{
  public function getAllRfq()
  {
    $this->db->select('*, data_rfq.id_research_brief as idResearchBrief, data_perusahaan.nama as nama_perusahaan, data_request.nama_request');
    //$this->db->select('*, data_customer.nama as nama_customer, data_customer.hp1 as contact_person1, data_customer.hp2 as contact_person2, data_customer.email1 as email_customer1, data_customer.email2 as email_customer2, data_perusahaan.nama as nama_perusahaan, data_request.nama_request');
    $this->db->from('data_rfq');
    $this->db->join('data_request', 'data_request.id_request=data_rfq.request', 'left');
    $this->db->join('data_perusahaan', 'data_perusahaan.id_perusahaan=data_rfq.id_perusahaan');
    //$this->db->join('data_customer','data_customer.id_customer=data_rfq.id_customer');
    $this->db->join('data_jnsprmt_rfq', 'data_jnsprmt_rfq.id_jnsprmt_rfq=data_rfq.id_jnsprmt_rfq', 'left');
    $this->db->join('data_krj_rfq', 'data_krj_rfq.id_krj_rfq=data_rfq.id_krj_rfq', 'left');
    $this->db->join('data_status', 'data_status.id_status=data_rfq.last_status', 'left');
    //$this->db->join('data_methodology','data_methodology.id_methodology=data_rfq.id_methodology');
    $this->db->order_by('data_rfq.nomor_rfq', 'DESC');
    //$this->db->limit(1);
    return $this->db->get()->result_array();
  }

  public function tambahDataRfq($file = '')
  {
    // var_dump($this->input->post('id_krj_rfq'));
    // die;
    ini_set('max_execution_time', '0');
    $no_rfq = htmlspecialchars($this->input->post('nomor_rfq', true));
    $blnThnKP = htmlspecialchars($this->input->post('blnThnKP', true));
    $noUrutKP = htmlspecialchars($this->input->post('noUrutKP', true));
    $dlKP = htmlspecialchars($this->input->post('dlKP', true)); // Dalam/Luar Negeri
    $asKP = htmlspecialchars($this->input->post('asKP', true)); // Adhoc/Sindikasi

    $cek = $this->cekGenerate($no_rfq);

    if ($cek['status']) {
      $no_rfq = $cek['noRfq'];
      $blnThnKP = $cek['blnThnKP'];
      $noUrutKP = $cek['noUrutKP'];
    }

    $kodeProject = $dlKP . '/' . $blnThnKP . '/' . $asKP . '/' . $noUrutKP;

    $id_dokumen = serialize($this->input->post('id_dokumen', true));
    $id_customer = serialize($this->input->post('id_customer', true)); // MULTI CUSTOMER BARU BY ADAM SANTOSO
    //$id_customer = htmlspecialchars($this->input->post('id_customer', true));

    // Cek kalau sindikasi
    if ($this->input->post('id_jnsprmt_rfq') == 3) {
      $data = array(
        "tgl_masuk" => htmlspecialchars(date('Y-m-d', strtotime($this->input->post('tgl_masuk', true)))),
        "nomor_rfq" => $no_rfq,
        "id_jnsprmt_rfq" => htmlspecialchars($this->input->post('id_jnsprmt_rfq', true)),
        "id_perusahaan" => htmlspecialchars($this->input->post('id_perusahaan', true)),
        "id_customer" => $id_customer,
        "last_status" => 0,
        "id_methodology" => serialize($this->input->post('id_methodology', true)),
        "user_add" => $this->session->userdata('ses_id'),
        "log_modif" =>  date("Y-m-d h:i:s"),
      );
      $this->db->insert('data_rfq', $data);
      return 1;
    }

    $data = array(
      "nomor_rfq" => $no_rfq,
      "tgl_masuk" => htmlspecialchars(date('Y-m-d', strtotime($this->input->post('tgl_masuk', true)))),
      //"tgl_masuk" => htmlspecialchars($this->input->post('tgl_masuk', true)),
      //"kode_project" => htmlspecialchars($this->input->post('kode_project', true)),
      "kode_project" => $kodeProject,
      "nama_project" => htmlspecialchars($this->input->post('nama_project', true)),
      "id_research_brief" => $this->input->post('researchBrief'),
      "id_perusahaan" => htmlspecialchars($this->input->post('id_perusahaan', true)),
      "id_customer" => $id_customer,
      "id_jnsprmt_rfq" => htmlspecialchars($this->input->post('id_jnsprmt_rfq', true)),
      "id_krj_rfq" => serialize($this->input->post('id_krj_rfq', true)),
      "id_methodology" => serialize($this->input->post('id_methodology', true)),
      "id_topic" => serialize($this->input->post('id_topic', true)),
      "id_dokumen" => $id_dokumen,
      "request" => htmlspecialchars($this->input->post('id_request', true)),
      "file_project" => $file,
      "catatan_tor" => htmlspecialchars($this->input->post('catatan_tor', true)),
      //"tgl_proposal" => htmlspecialchars(date('Y-m-d', strtotime($this->input->post('tgl_proposal', true)))),
      "date_system" => htmlspecialchars(date('Y-m-d', strtotime($this->input->post('date_system', true)))),
      "date_customer" => htmlspecialchars(date('Y-m-d', strtotime($this->input->post('date_customer', true)))),
      //"tgl_submit" => htmlspecialchars(date('Y-m-d', strtotime($this->input->post('tgl_submit', true)))),
      "last_status" => 0,
      "user_add" => $this->session->userdata('ses_id'),
      "log_modif" =>  date("Y-m-d h:i:s"),
    );

    //var_dump($data);

    $this->db->insert('data_rfq', $data);

    // TAMBAHAN ADAM SANTOSO NOTIFIKASI DOKUMEN TERPILIH VIA EMAIL
    $cekDokumen = @unserialize($id_dokumen);
    if ($id_dokumen !== false) {
      $dok = unserialize($id_dokumen);
      $dataDok = array();
      for ($i = 0; $i < count($dok); $i++) {
        $getEmailDokumen = $this->db->select('dokumen, keterangan, email')->get_where('data_dokumen', array('id_dokumen' => $dok[$i]))->row_array();
        $dataDok[] = array(
          'namaDokumen' => $getEmailDokumen['dokumen'],
          //'ketDokumen' => $getEmailDokumen['keterangan'],
          'email' => $getEmailDokumen['email']
        );
      }

      // CARI EMAIL YANG SAMA dan satukan list dokumen
      $output = array();
      foreach ($dataDok as $values) {
        $key = $values['email'];
        $output[$key][] = $values;
      }
      $output = array_values($output);
      $final = array();
      foreach ($output as $value) {
        if (count($value) > 0) {
          $email = $value[0]['email'];
          foreach ($value as $val2) {
            $dokumen[] = $val2['namaDokumen'];
          }
        } else {
          $email = $value['email'];
          $dokumen[] = $value['namaDokumen'];
        }

        $final[] = array(
          'email' => $email,
          'dokumen' => implode(', ', $dokumen)
        );
        $dokumen = array(); // Kosongkan list dokumen sebelumnya
      }

      //echo json_encode($final);

      $id_cus = unserialize($id_customer);
      foreach ($id_cus as $idcus) {
        $namaCustomer = $this->db->get_where('data_customer', array('id_customer' => $idcus))->row_array();
        $namaCus[] = $namaCustomer['nama'];
      }
      $namaCus = implode(', ', $namaCus);

      $iduser = $this->session->userdata('ses_id');
      $model = $this->User_model->getUserById($iduser);
      // NATIVE SUBJEK
      //$judul_email = 'Persiapkan Dokumen Untuk Request '.$no_rfq;
      // ====
      // TEMPLATE SUBJEK
      $surat = $this->Surat_model->getSuratById(11); // dari tabel daftar_surat
      $judul_email = $surat['jenis_surat'] . ': ' . $no_rfq;
      // ====

      $config = configEmail();
      $this->load->library('email', $config);
      $namaPengirim = $model['nama_user']; //'Marketing MRI';
      $emailPengirim = $model['email1']; //'mri.marketing@mri-research-ind.com';
      $this->email->from($emailPengirim, $namaPengirim);
      $this->email->subject($judul_email);

      for ($x = 0; $x < count($final); $x++) {
        $cloned = clone $this->email;

        // NATIVE MESSAGE
        //$isi_email = 'Persiapkan Dokumen '.$final[$x]['dokumen'].' Untuk Request: <b>'.$no_rfq.'</b>';
        // ====
        // TEMPLATE MESSAGE
        $isi_email = str_replace('[Nomor Urut RFQ]', $no_rfq, $surat['isi_surat']);
        $isi_email = str_replace('[Nama Project]', $this->input->post('nama_project', true), $isi_email);
        //$namaCustomer = $this->db->get_where('data_customer', array('id_customer' => $id_customer))->row_array();
        $isi_email = str_replace('[Nama Customer]', $namaCus, $isi_email);
        $isi_email = str_replace('[Nama Dokumen]', $final[$x]['dokumen'], $isi_email);
        $model['isi'] = nl2br($isi_email);
        $isi_email = $this->load->view('email/tem_email', $model, true);
        // ====

        $cloned->message($isi_email);
        $cloned->to($final[$x]['email']);

        if ($cloned->send()) {
          $data = 'terkirim';
        } else {
          $data = 'gagal';
        }
        $cloned->clear(true);
      }
    }
  }

  public function tambahFu()
  {
    $data = array(
      'nomor_rfq' => htmlspecialchars($this->input->post('nomor_rfq', true)),
      'date' => htmlspecialchars($this->input->post('date', true)),
      'ket' => htmlspecialchars($this->input->post('ket', true)),
    );

    $this->db->insert('data_fu', $data);
  }

  public function hapusDataRfq($id)
  {
    $this->db->delete('data_rfq', array('nomor_rfq' => $id));
    $this->db->delete('data_fu', array('nomor_rfq' => $id));
  }

  public function getRfqById($id)
  {
    // return $this->db->get_where('data_rfq', array('nomor_rfq' => $id))->row_array();
    // return $this->db->select('*')->from('data_rfq')
    //   ->join('data_perusahaan', 'data_perusahaan.id_perusahaan=data_rfq.id_perusahaan')
    //   ->where('data_rfq.nomor_rfq', $id)->get();

    return $this->db->query("SELECT b.*, c.*
                                FROM data_rfq b
                                JOIN data_perusahaan c ON b.id_perusahaan = c.id_perusahaan
                                WHERE b.nomor_rfq = '$id'
                                ")->row_array();
  }

  public function getRfqByUser($id)
  {
    // return $this->db->get_where('data_rfq', array('user_add' => $id))->result_array();
    $this->db->select('*');
    $this->db->from('data_rfq');
    $this->db->join('data_status', 'data_status.id_status = data_rfq.last_status');
    $this->db->where('user_add', $id);
    return $this->db->get()->result_array();
    // $this->db->order_by('data_fu.date', 'asc');
  }

  public function getRfqByStatus($id)
  {
    $all = $this->db->query("SELECT b.nomor_rfq, b.kode_project, b.nama_project, b.id_perusahaan, b.id_methodology, b.id_topic, b.last_status, c.nama
                      FROM data_rfq b
                      LEFT JOIN data_perusahaan c ON b.id_perusahaan = c.id_perusahaan
                      WHERE b.last_status = $id
    ")->result_array();

    return $all;
  }

  public function ubahDataRfq($file)
  {
    $blnThnKP = htmlspecialchars($this->input->post('blnThnKP', true));
    $noUrutKP = htmlspecialchars($this->input->post('noUrutKP', true));
    $dlKP = htmlspecialchars($this->input->post('dlKP', true)); // Dalam/Luar Negeri
    $asKP = htmlspecialchars($this->input->post('asKP', true)); // Adhoc/Sindikasi
    $kodeProject = $dlKP . '/' . $blnThnKP . '/' . $asKP . '/' . $noUrutKP;
    $status = htmlspecialchars($this->input->post('status', true));

    if ($this->input->post('id_jnsprmt_rfq') == 3) {
      $data = array(
        "tgl_masuk" => htmlspecialchars(date('Y-m-d', strtotime($this->input->post('tgl_masuk', true)))),
        "id_jnsprmt_rfq" => htmlspecialchars($this->input->post('id_jnsprmt_rfq', true)),
        "id_perusahaan" => htmlspecialchars($this->input->post('id_perusahaan', true)),
        "id_customer" => serialize($this->input->post('id_customer', true)),
        "tgl_feedback" => htmlspecialchars($this->input->post('tgl_feedback', true)),
        "tgl_kirim_proposal" => htmlspecialchars($this->input->post('tgl_kirim_proposal', true)),
        "file_proposal" => $file[1], // INDEX 1 FILE PROPOSAL
        "tgl_presentasi" => htmlspecialchars($this->input->post('tgl_presentasi', true)),
        "tgl_negosiasi" => htmlspecialchars($this->input->post('tgl_negosiasi', true)),
        "tgl_deal" => htmlspecialchars($this->input->post('tgl_deal', true)),
        "tgl_nodeal" => htmlspecialchars($this->input->post('tgl_nodeal', true)),
        "diskon" => htmlspecialchars($this->input->post('diskon', true)),
        "last_status" => $status,
        "id_batal" => htmlspecialchars($this->input->post('id_batal', true)),
        "masukan" => htmlspecialchars($this->input->post('masukan', true)),
        "user_add" => $this->session->userdata('ses_id'),
        "log_modif" =>  date("Y-m-d h:i:s"),
      );
      $id = $this->input->post('id');
      $this->db->where('nomor_rfq', $id);
      $this->db->update('data_rfq', $data);
      return 1;
    }

    $data = array(
      "tgl_masuk" => htmlspecialchars($this->input->post('tgl_masuk', true)),
      "kode_project" => $kodeProject,
      "nama_project" => htmlspecialchars($this->input->post('nama_project', true)),
      "id_perusahaan" => htmlspecialchars($this->input->post('id_perusahaan', true)),
      "id_customer" => serialize($this->input->post('id_customer', true)),
      "id_jnsprmt_rfq" => htmlspecialchars($this->input->post('id_jnsprmt_rfq', true)),
      "id_krj_rfq" => serialize($this->input->post('id_krj_rfq', true)),
      //"id_methodology" => htmlspecialchars($this->input->post('id_methodology', true)),
      "id_methodology" => serialize($this->input->post('id_methodology', true)),
      "id_topic" => serialize($this->input->post('id_topic', true)),
      "id_dokumen" => serialize($this->input->post('id_dokumen', true)),
      "request" => htmlspecialchars($this->input->post('id_request', true)),
      "file_project" => $file[0], // INDEX 0 FILE TOR
      "tgl_proposal" => htmlspecialchars($this->input->post('tgl_proposal', true)),
      "catatan_tor" => htmlspecialchars($this->input->post('catatan_tor', true)),
      "date_system" => htmlspecialchars($this->input->post('date_system', true)),
      "date_customer" => htmlspecialchars($this->input->post('date_customer', true)),
      "tgl_submit" => date('Y-m-d'), //htmlspecialchars($this->input->post('tgl_submit', true)),
      "tgl_feedback" => htmlspecialchars($this->input->post('tgl_feedback', true)),
      "tgl_kirim_proposal" => htmlspecialchars($this->input->post('tgl_kirim_proposal', true)),
      "file_proposal" => $file[1], // INDEX 1 FILE PROPOSAL
      "tgl_presentasi" => htmlspecialchars($this->input->post('tgl_presentasi', true)),
      "tgl_negosiasi" => htmlspecialchars($this->input->post('tgl_negosiasi', true)),
      "tgl_deal" => htmlspecialchars($this->input->post('tgl_deal', true)),
      "tgl_nodeal" => htmlspecialchars($this->input->post('tgl_nodeal', true)),
      "diskon" => htmlspecialchars($this->input->post('diskon', true)),
      "last_status" => $status,
      "id_batal" => htmlspecialchars($this->input->post('id_batal', true)),
      "masukan" => htmlspecialchars($this->input->post('masukan', true)),
      "user_add" => $this->session->userdata('ses_id'),
      "log_modif" =>  date("Y-m-d h:i:s"),
    );
    $id = $this->input->post('id');
    $this->db->where('nomor_rfq', $id);
    $this->db->update('data_rfq', $data);

    $cek = $this->db->query("SELECT nomor_rfq FROM project_plan WHERE nomor_rfq = '$id'")->result_array();
    if ($status == 1 and count($cek) == null) { // 1 SAMA DENGAN DEAL => LIHAT DATA DARI TBL DATA_STATUS, MAKA BUAT PROJECT PLAN DAN PROJECT DOCUMENT JIKA CEK PROJECT PLAN BELUM ADA
      $data = array(
        "nomor_rfq" => $id
      );
      $this->db->insert('project_plan', $data);
      $dataDocument = array(
        "nomor_rfq" => $id,
        "document_x21" => serialize($file),
        "documentCheck_x212" => 0,
        "document_x22" => 'N;',
        "document_x23" => 'N;',
        "document_x24" => 'N;'
      );
      $this->db->insert('project_document', $dataDocument);
    }
  }

  public function getAllOpsiStatus()
  {
    return $this->db->order_by('urutan', 'ASC')->get('data_status')->result_array();
  }

  // TAMBAHAN BARU EDIT BY ADAM SANTOSO
  function cekGenerate($norfqnya)
  {
    $data = $this->db->query("SELECT nomor_rfq FROM data_rfq WHERE nomor_rfq = '$norfqnya'")->row_array();
    if ($data['nomor_rfq'] != null) { // JIKA NOMOR RFQ DARI INPUT OTOMATIS SUDAH ADA MAKA GENERATE NOMOR BARU
      $this->db->select('max(nomor_rfq) as maxKode, max(kode_project) as maxKP');
      $this->db->from('data_rfq');
      $data = $this->db->get()->row_array();
      $no_rfq = $data['maxKode'];
      $no_urut = (int) substr($no_rfq, 11);
      $no_urut++;
      $char = 'REQ';
      $date = date("Ymd");
      $noRfq = $char . $date . sprintf('%07s', $no_urut);
      // OTOMATIS IKUT GENERATE NOMOR URUT BARU UNTUK KODE PROJECT
      $data = $this->db->query("SELECT max(kode_project) as maxKP FROM data_rfq WHERE nomor_rfq = '$no_rfq'")->row_array();
      $noKP = $data['maxKP'];
      if (date('Y-m-d') == date('Y-') . '01-01') { // JIKA SUDAH TAHUN BARU
        $noUrutKP = 1;
      } else {
        $noUrutKP = (int) substr($noKP, -3);
        $noUrutKP++;
      }
      $blnThnKP = date('m.Y');
      $noUrutKP = sprintf('%03s', $noUrutKP);
      $generate = array(
        'status' => true,
        'noRfq' => $noRfq,
        'blnThnKP' => $blnThnKP,
        'noUrutKP' => $noUrutKP
      );
    } else {
      $generate = array(
        'status' => false
      );
    }

    return $generate;
  }

  // public function cariDataMahasiswa()
  // {
  //     $keyword = $this->input->post('keyword', true);
  //     $this->db->like('nama', $keyword);
  //     $this->db->or_like('jurusan', $keyword);
  //     $this->db->or_like('nrp', $keyword);
  //     $this->db->or_like('email', $keyword);
  //     return $this->db->get('mahasiswa')->result_array();
  // }
}
