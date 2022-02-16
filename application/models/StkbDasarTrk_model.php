<?php

class StkbDasarTrk_model extends CI_model
{

    public function getallstkbbank()
    {
        $this->db->select('*');
        $this->db->from('bank');
        $this->db->order_by('nama', 'asc');
        return $this->db->get()->result_array();
    }

    public function getbanktanpa()
    {
      $this->db->select('*');
      $this->db->from('bank');
      $this->db->where('kode NOT IN (select kodebank from stkb_dasar_trk where kodebank = bank.kode)');
      return $this->db->get()->result_array();
    }

    public function getallstkbskenario()
    {
        $this->db->select('*');
        $this->db->from('stkb_skenario');
        return $this->db->get()->result_array();
    }

    public function tambahdatamatrixperdin($id)
    {
        $data = array(
            "kotaasal" => htmlspecialchars($this->input->post('kotaasal', true)),
            "kotatujuan" => htmlspecialchars($this->input->post('kotatujuan', true)),
            "jenis" => htmlspecialchars($this->input->post('jenis', true)),
            "matrixhonor" => htmlspecialchars($this->input->post('matrixhonor', true)),
        );

        $this->db->insert('stkb_perdin', $data);
    }

    public function hapusDatastkbperdin($id)
    {
        // $this->db->where('id', $id);
        $this->db->delete('stkb_perdin', array('no' => $id));
    }

    public function getBankByKode($id)
    {
        // return $this->db->get_where('stkb_dasar_trk', array('kodebank' => $id))->row_array();
        $this->db->select('a.*, b.nama');
        $this->db->from('stkb_dasar_trk a');
        $this->db->join('bank b', 'a.kodebank = b.kode');
        $this->db->where('a.kodebank', $id);
        return $this->db->get()->row_array();

    }

    public function getSkenario($id)
    {
     // return  $this->db->get_where('stkb_dasar_trk', ['kodebank' => $id])->result_array();
    $this->db->select('a.*, b.nama');
    $this->db->from('stkb_dasar_trk a');
    $this->db->join('stkb_skenario b', 'a.kodeskenario = b.no');
    $this->db->where('a.kodebank', $id);
    return $this->db->get()->result_array();
    }

    public function edittrk()
    {
        $data = [
            "nama_user" => $this->input->post('user', true),
            "jabatan" => $this->input->post('jabatan', true),
            "dept" => $this->input->post('dept', true),
            "email1" => $this->input->post('email1', true),
            "email2" => $this->input->post('email2', true),
            "user_add" => $this->session->userdata('ses_id'),
            "log_modif" =>  date("Y-m-d H:i:s"),
        ];

        $this->db->where('id_user', $this->input->post('id'));
        $this->db->update('data_user', $data);
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
