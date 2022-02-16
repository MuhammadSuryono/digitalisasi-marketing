<?php

class MataUang_model extends CI_model
{
    public function getAllMataUang()
    {
        return $this->db->get('daftar_mata_uang')->result_array();
    }
    public function getMataUangById($id)
    {
        return $this->db->get_where('daftar_mata_uang', array('id_mata_uang' => $id))->row_array();
    }
    public function tambahMataUang()
    {
        $data = array(
            "mata_uang" => $this->input->post('mataUang', true),
            "simbol_mata_uang" => $this->input->post('simbol', true),
            "pemisah" => $this->input->post('pemisah', true),
            "user_add" => $this->session->userdata('ses_id'),
            "log_modif" =>  date("Y-m-d h:i:s"),
        );

        $this->db->insert('daftar_mata_uang', $data);
    }

    public function hapusMataUang($id)
    {
        $this->db->delete('daftar_mata_uang', array('id_mata_uang' => $id));
    }

    public function ubahMataUang()
    {
        $data = array(
            "mata_uang" => $this->input->post('mataUang', true),
            "simbol_mata_uang" => $this->input->post('simbol', true),
            "pemisah" => $this->input->post('pemisah', true),
            "user_add" => $this->session->userdata('ses_id'),
            "log_modif" =>  date("Y-m-d h:i:s"),
        );

        $this->db->where('id_mata_uang', $this->input->post('id'));
        $this->db->update('daftar_mata_uang', $data);
    }
}
