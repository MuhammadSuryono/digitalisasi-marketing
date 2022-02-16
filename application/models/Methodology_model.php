<?php

class Methodology_model extends CI_model
{
    public function getAllMethodology()
    {
        $this->db->order_by('methodology', 'ASC');
        return $this->db->get('data_methodology')->result_array();
    }

    public function tambahDataMethodology()
    {
        $data = array(
            "methodology" => $this->input->post('methodology', true),
            "keterangan" => $this->input->post('keterangan', true),
            "user_add" => $this->session->userdata('ses_id'),
            "log_modif" =>  date("Y-m-d h:i:s"),
        );

        $this->db->insert('data_methodology', $data);
    }

    public function hapusDataMethodology($id)
    {
        // $this->db->where('id', $id);
        $this->db->delete('data_methodology', array('id_methodology' => $id));
    }

    public function getMethodologyById($id)
    {
        return $this->db->get_where('data_methodology', array('id_methodology' => $id))->row_array();
    }

    public function getMethodologyByIdArray($id)
    {
        return $this->db->get_where('data_methodology', array('id_methodology' => $id))->result_array();
    }

    public function ubahDataMethodology()
    {
        $data = array(
            "methodology" => $this->input->post('methodology', true),
            "keterangan" => $this->input->post('keterangan', true),
            "user_add" => $this->session->userdata('ses_id'),
            "log_modif" =>  date("Y-m-d h:i:s"),
        );

        $this->db->where('id_methodology', $this->input->post('id'));
        $this->db->update('data_methodology', $data);
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
