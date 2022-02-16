<?php

class Batal_model extends CI_model
{
    public function getAllBatal()
    {
        return $this->db->get('data_batal')->result_array();
    }

    public function tambahDataBatal()
    {
        $data = array(
            "alasan_batal" => $this->input->post('alasan_batal', true),
            "keterangan" => $this->input->post('keterangan', true),
            "user_add" => $this->session->userdata('ses_id'),
            "log_modif" =>  date("Y-m-d h:i:s"),
        );

        $this->db->insert('data_batal', $data);
    }

    public function hapusDataBatal($id)
    {
        // $this->db->where('id', $id);
        $this->db->delete('data_batal', array('id_batal' => $id));
    }

    public function getBatalById($id)
    {
        return $this->db->get_where('data_batal', array('id_batal' => $id))->row_array();
    }

    public function ubahDataBatal()
    {
        $data = array(
            "alasan_batal" => $this->input->post('alasan_batal', true),
            "keterangan" => $this->input->post('keterangan', true),
            "user_add" => $this->session->userdata('ses_id'),
            "log_modif" =>  date("Y-m-d h:i:s"),
        );

        $this->db->where('id_batal', $this->input->post('id'));
        $this->db->update('data_batal', $data);
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
