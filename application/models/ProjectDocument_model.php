<?php

use Mpdf\Tag\P;

class ProjectDocument_model extends CI_model
{
  public function checkDocument($id)
  {
    $check = $this->db->get_where('project_document', array('nomor_rfq' => $id))->result_array();
    if (count($check) == null) {
      $dataDocument = array(
        "nomor_rfq" => $id,
        "document_x21" => '',
        "documentCheck_x212" => 0,
        "document_x22" => '',
        "document_x23" => '',
        "document_x24" => ''
      );
      $this->db->insert('project_document', $dataDocument);
      return false;
    } else {
      return true;
    }
  }

  public function getAllDocument()
  {
    $nomor_rfq = $this->db->select('nomor_rfq')->get('project_document')->result_array();
    foreach ($nomor_rfq as $data) {
      $template_pp = $this->db->select('id_template_project')->get_where('project_plan', array('nomor_rfq' => $data['nomor_rfq']))->row_array();
      $template_pp = $this->db->select('nama_template')->get_where('template_pp', array('id_template_project' => $template_pp['id_template_project']))->row_array();
      $rfq = $this->db->select('kode_project, nama_project, id_perusahaan, id_methodology, id_topic')->get_where('data_rfq', array('nomor_rfq' => $data['nomor_rfq']))->row_array();
      $perusahaan = $this->db->select('nama')->get_where('data_perusahaan', array('id_perusahaan' => $rfq['id_perusahaan']))->row_array();


      $all[] = array(
        'nomor_rfq' => $data['nomor_rfq'],
        'kode_project' => $rfq['kode_project'],
        'nama_project' => $rfq['nama_project'],
        'nama_template' => $template_pp['nama_template'],
        'nama_perusahaan' => $perusahaan['nama'],
        'id_methodology' => $rfq['id_methodology'],
        'id_topic' => $rfq['id_topic']
      );
    }

    return $all;
  }

  public function getDealDocument()
  {

    $all = $this->db->query('SELECT a.nomor_rfq, b.kode_project, b.nama_project, b.id_perusahaan, b.id_methodology, b.id_topic, b.last_status, c.nama
                      FROM project_document a
                      LEFT JOIN data_rfq b ON a.nomor_rfq = b.nomor_rfq
                      LEFT JOIN data_perusahaan c ON b.id_perusahaan = c.id_perusahaan
                      WHERE b.last_status = 1
    ')->result_array();

    return $all;
  }

  public function getDocument($id)
  {
    return $this->db->get_where('project_document', array('nomor_rfq' => $id))->row_array();
  }

  public function getCustomerDocument($id)
  {
    $getData = $this->db->query("SELECT b.*, c.*
                                FROM project_document a
                                JOIN data_rfq b ON a.nomor_rfq = b.nomor_rfq
                                JOIN data_perusahaan c ON b.id_perusahaan = c.id_perusahaan
                                WHERE a.nomor_rfq = '$id'
                                ")->result_array();
    return $getData;
  }

  function randomCode()
  {
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
    for ($i = 0; $i < 10; $i++) {
      $index = rand(0, strlen($characters) - 1);
      $randomString .= $characters[$index];
    }
    return 'MRI-' . $randomString . date('ms');
  }

  public function upDocument($id, $x21, $x22, $x23, $x24)
  {
    $dataDocument = array(
      "nomor_rfq" => $id,
      "document_x21" => $x21,
      "documentCheck_x212" => $this->input->post('cekProposal'),
      "document_x22" => $x22,
      "document_x23" => $x23,
      "document_x24" => $x24
    );

    $this->db->where('nomor_rfq', $id);
    $up = $this->db->update('project_document', $dataDocument);

    if ($up) {
      return true;
    } else {
      return false;
    }
  }

  public function listReadyAddDocument()
  {
    $nomor_rfq = $this->db->select('nomor_rfq')->get('project_plan')->result_array();
    foreach ($nomor_rfq as $data) {
      $check = $this->db->get_where('project_document', array('nomor_rfq' => $data['nomor_rfq']))->row_array();
      if ($check == null) {
        $rfq = $this->db->select('kode_project, nama_project')->get_where('data_rfq', array('nomor_rfq' => $data['nomor_rfq']))->row_array();

        $list[] = array(
          'nomor_rfq' => $data['nomor_rfq'],
          'kode_project' => $rfq['kode_project'],
          'nama_project' => $rfq['nama_project']
        );
      }
    }

    return $list;
  }

  public function deleteDocument($id)
  {
    $getDoc = $this->db->get_where('project_document', array('nomor_rfq' => $id))->row_array();
    $x21 = unserialize($getDoc['document_x21']);
    $x22 = unserialize($getDoc['document_x22']);
    $x23 = unserialize($getDoc['document_x23']);
    $x24 = unserialize($getDoc['document_x24']);

    foreach ($x21 as $key => $tmp_name) {
      if ($x21[$key] != null) {
        unlink("./file/document/" . $x21[$key]);
      }
    }
    foreach ($x22 as $key => $tmp_name) {
      if ($x22[$key] != null) {
        unlink("./file/document/" . $x22[$key]);
      }
    }
    foreach ($x23 as $key => $tmp_name) {
      if ($x23[$key] != null) {
        unlink("./file/document/" . $x23[$key]);
      }
    }
    foreach ($x24 as $key => $tmp_name) {
      if ($x24[$key] != null) {
        unlink("./file/document/" . $x24[$key]);
      }
    }

    $delete = $this->db->delete('project_document', array('nomor_rfq' => $id));

    if ($delete) {
      return true;
    } else {
      return false;
    }
  }
}
