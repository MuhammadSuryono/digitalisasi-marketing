<?php

class JenisPermRfq_model extends CI_model
{
    public function getAllJenisPermRfq()
    {
        return $this->db->get('data_jnsprmt_rfq')->result_array();
    }

    public function tambahDataJenisPermRfq()
    {
        $data = array(
            "jenis_permintaan" => $this->input->post('jenis_permintaan', true),
            "ket" => $this->input->post('ket', true),
            "user_add" => $this->session->userdata('ses_id'),
            "log_modif" =>  date("Y-m-d h:i:s"),
        );

        $this->db->insert('data_jnsprmt_rfq', $data);
    }

    public function hapusDataJenisPermRfq($id)
    {
        // $this->db->where('id', $id);
        $this->db->delete('data_jnsprmt_rfq', array('id_jnsprmt_rfq' => $id));
    }

    public function getJenisPermRfqById($id)
    {
        return $this->db->get_where('data_jnsprmt_rfq', array('id_jnsprmt_rfq' => $id))->row_array();
    }

    public function ubahDataJenisPermRfq()
    {
        $data = array(
            "jenis_permintaan" => $this->input->post('jenis_permintaan', true),
            "ket" => $this->input->post('ket', true),
            "user_add" => $this->session->userdata('ses_id'),
            "log_modif" =>  date("Y-m-d h:i:s"),
        );

        $this->db->where('id_jnsprmt_rfq', $this->input->post('id'));
        $this->db->update('data_jnsprmt_rfq', $data);
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
