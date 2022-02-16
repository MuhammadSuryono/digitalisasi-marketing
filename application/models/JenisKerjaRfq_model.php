<?php

class JenisKerjaRfq_model extends CI_model
{
    public function getAllJenisKerjaRfq()
    {
        return $this->db->get('data_krj_rfq')->result_array();
    }

    public function tambahDataJenisKerjaRfq()
    {
        $data = array(
            "jenis_pekerjaan" => $this->input->post('jenis_pekerjaan', true),
            "ket" => $this->input->post('ket', true),
            "user_add" => $this->session->userdata('ses_id'),
            "log_modif" =>  date("Y-m-d h:i:s"),
        );

        $this->db->insert('data_krj_rfq', $data);
    }

    public function getJenisKerjaRfqByIdArray($id)
    {
        return $this->db->get_where('data_krj_rfq', array('id_krj_rfq' => $id))->result_array();
    }

    public function hapusDataJenisKerjaRfq($id)
    {
        // $this->db->where('id', $id);
        $this->db->delete('data_krj_rfq', array('id_krj_rfq' => $id));
    }

    public function getJenisKerjaRfqById($id)
    {
        return $this->db->get_where('data_krj_rfq', array('id_krj_rfq' => $id))->row_array();
    }

    public function ubahDataJenisKerjaRfq()
    {
        $data = array(
            "jenis_pekerjaan" => $this->input->post('jenis_pekerjaan', true),
            "ket" => $this->input->post('ket', true),
            "user_add" => $this->session->userdata('ses_id'),
            "log_modif" =>  date("Y-m-d h:i:s"),
        );

        $this->db->where('id_krj_rfq', $this->input->post('id'));
        $this->db->update('data_krj_rfq', $data);
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
