<?php 

class Surat_model extends CI_model
{
    public function getAllSurat()
    {
        $this->db->order_by('jenis_surat','ASC');
        return $this->db->get('daftar_surat')->result_array();
    }

    public function tambahDataSurat()
    {
        $data = array(
            "jenis_surat" => $this->input->post('jenis_surat', true),
            "id_menu" => $this->input->post('id_menu', true),
            "isi_surat" => $this->input->post('isi_surat', true),
            "user_add" => $this->session->userdata('ses_id'),
            "log_modif" =>  date("Y-m-d h:i:s"),
        );

        $this->db->insert('daftar_surat', $data);
    }

    public function hapusDataSurat($id)
    {
        // $this->db->where('id', $id);
        $this->db->delete('daftar_surat', array('id_surat' => $id));
    }

    public function getSuratById($id)
    {
        return $this->db->get_where('daftar_surat', array('id_surat' => $id))->row_array();
    }

    public function ubahDataSurat()
    {
        $data = array(
            "jenis_surat" => $this->input->post('jenis_surat', true),
            "id_menu" => $this->input->post('id_menu', true),
            "isi_surat" => $this->input->post('isi_surat', true),
            "user_add" => $this->session->userdata('ses_id'),
            "log_modif" =>  date("Y-m-d h:i:s"),
        );

        $this->db->where('id_surat', $this->input->post('id'));
        $this->db->update('daftar_surat', $data);
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
