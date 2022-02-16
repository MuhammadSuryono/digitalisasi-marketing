<?php

class Jabatan_model extends CI_model
{
  public function getAllJabatan()
  {

    $this->db->order_by('jabatan', 'ASC');
    return $this->db->get('daftar_jabatan')->result_array();
  }

  public function tambahDataJabatan()
  {
    $nama = $this->input->post('jabatan', true);
    $cekNama = trim($nama);
    if ($cekNama == null) {
      return 0;
    } else {
      // cek apa sudah ada nama yang sama atau belum
      if ($this->db->get_where('daftar_jabatan', ['jabatan' => $nama])->num_rows() != 0) {
        return 0;
      } else {
        $data = array(
          "jabatan" => $this->input->post('jabatan', true),
          "user_add" => $this->session->userdata('ses_id'),
          "log_modif" =>  date("Y-m-d h:i:s"),
        );

        $this->db->insert('daftar_jabatan', $data);
        return 1;
      }
    }
  }

  public function hapusDataJabatan($id)
  {
    // $this->db->where('id', $id);
    $this->db->delete('daftar_jabatan', array('id_jabatan' => $id));
  }

  public function getJabatanById($id)
  {
    return $this->db->get_where('daftar_jabatan', array('id_jabatan' => $id))->row_array();
  }

  public function ubahDataJabatan()
  {
    $nama = $this->input->post('jabatan', true);

    // cek apa sudah ada nama yang sama atau belum
    if ($this->db->get_where('daftar_jabatan', ['jabatan' => $nama])->num_rows() != 0) {
      return 0;
    } else {
      $data = array(
        "jabatan" => $this->input->post('jabatan', true),
        "user_add" => $this->session->userdata('ses_id'),
        "log_modif" =>  date("Y-m-d h:i:s"),
      );

      $this->db->where('id_jabatan', $this->input->post('id'));
      $this->db->update('daftar_jabatan', $data);
      return 1;
    }
  }


  public function tambahDataJabatanAdam()
  {
    $nama = $this->input->post('jabatan', true);
    // cek apa sudah ada nama yang sama atau belum
    if ($this->db->get_where('daftar_jabatan', ['jabatan' => $nama])->num_rows() != 0) {
      return 0;
    } else {
      $data = array(
        "jabatan" => $nama,
        "user_add" => $this->session->userdata('ses_id'),
        "log_modif" =>  date("Y-m-d h:i:s"),
      );
      $this->db->insert('daftar_jabatan', $data);
      $insert_id = $this->db->insert_id();
      return $insert_id;
    }
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
