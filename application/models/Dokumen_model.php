<?php

class Dokumen_model extends CI_model
{
    public function getAllDokumen()
    {
        $this->db->order_by('keterangan','ASC');
        return $this->db->get('data_dokumen')->result_array();
    }

    public function tambahDataDokumen()
    {
        $data = array(
            "dokumen" => $this->input->post('dokumen', true),
            "keterangan" => $this->input->post('keterangan', true),
            "email" => $this->input->post('email', true),
            "user_add" => $this->session->userdata('ses_id'),
            "log_modif" =>  date("Y-m-d h:i:s"),
        );

        $this->db->insert('data_dokumen', $data);
    }

    public function hapusDataDokumen($id)
    {
        // $this->db->where('id', $id);
        $this->db->delete('data_dokumen', array('id_dokumen' => $id));
    }

    public function getDokumenById($id)
    {
        return $this->db->get_where('data_dokumen', array('id_dokumen' => $id))->row_array();
    }

    public function getDokumenByIdArray($id)
    {
        return $this->db->get_where('data_dokumen', array('id_dokumen' => $id))->result_array();
    }

    public function ubahDataDokumen()
    {
        $data = array(
            "dokumen" => $this->input->post('dokumen', true),
	          "keterangan" => $this->input->post('keterangan', true),
            "email" => $this->input->post('email', true),
            "user_add" => $this->session->userdata('ses_id'),
            "log_modif" =>  date("Y-m-d h:i:s"),
        );

        $this->db->where('id_dokumen', $this->input->post('id'));
        $this->db->update('data_dokumen', $data);
    }
}
