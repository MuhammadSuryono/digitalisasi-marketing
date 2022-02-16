<?php

class StkbMasterplan_model extends CI_model
{

  public function getallnama()
  {
    $db2 = $this->load->database('database_kedua', TRUE);
    $db2->select('Id,Nama');
    $db2->from('id_data');
    $db2->where("(level='Supervisor' OR level='Kareg')");
    $db2->order_by('Nama', 'asc');
    return $db2->get()->result_array();
  }

  public function getallproject()
  {
    $db2 = $this->load->database('database_kedua', TRUE);
    $db2->select('*');
    $db2->from('project');
    $db2->where('visible', 'y');
    $db2->order_by('nama', 'ASC');
    return $db2->get()->result_array();
  }

  public function getkotaproject($id)
  {
    $db2 = $this->load->database('database_kedua', TRUE);
    $db2->select('kode, kota');
    $db2->from('cabang');
    $db2->where('project', $id);
    $db2->group_by('kota');
    $db2->order_by('kota', 'ASC');
    return $db2->get()->result_array();
  }

  public function getdaftarcabang($id, $kota)
  {
    $db2 = $this->load->database('database_kedua', TRUE);
    $db2->select('kode, nama');
    $db2->from('cabang');
    $db2->where('project', $id);
    $db2->where('kota', $kota);
    $db2->order_by('nama', 'ASC');
    return $db2->get()->result_array();
  }

  public function kotakabupaten()
  {
    $this->db->select('*');
    $this->db->from('kota');
    $this->db->order_by('kabupaten', 'ASC');
    return $this->db->get()->result_array();
  }

}
