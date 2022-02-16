<?php

class TemplateProjectPlan_model extends CI_model
{
    var $keg = array(
        1 =>'Project Spec',
        2 =>'Briefing',
        3 =>'Field Start'
    );

    public function getAllTemplatepp()
    {
        return $this->db->get('template_pp')->result_array();
    }

    public function tambahTemplatepp()
    {
        $data = array(
            "nama_template" => $this->input->post('nama_template', true),
            "log_modif" =>  date("Y-m-d h:i:s"),
        );

        $this->db->insert('template_pp', $data);
    }

    public function hapusDataTemplatepp($id)
    {
        // $this->db->where('id', $id);
        $this->db->delete('template_pp', array('id_template_project' => $id));
    }

    public function hapusDataKegiatan($id)
    {
        // $this->db->where('id', $id);
        $this->db->delete('jenis_kegiatan', array('id_kegiatan' => $id));
    }

    public function getTemplateById($id)
    {
        return $this->db->get_where('template_pp', array('id_template_project' => $id))->row_array();
    }

    public function tambahKegiatan()
    {
        if($this->input->post('nama_kegiatan') == null) {
            $nama = $this->keg[$this->input->post('kegiatan', true)];
            $ket = $this->input->post('kegiatan', true);
        }

        if($this->input->post('kegiatan') == null) {
            $nama = $this->input->post('nama_kegiatan', true);
            $ket = 0;
        }

        $data = array(
            "id_template_project" => $this->input->post('id_template', true),
            "nama_kegiatan" => $nama,
            "undangan" => $this->input->post('undangan', true),
            "ket" => $ket
        );

        $this->db->insert('jenis_kegiatan', $data);
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

}
