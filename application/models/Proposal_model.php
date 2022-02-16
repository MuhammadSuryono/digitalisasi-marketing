<?php 

class Proposal_model extends CI_model
{
    public function getAllSurat()
    {
        return $this->db->get('daftar_surat')->result_array();
    }

    public function tambahDataProposal($file_name)
    {
        $data = array(
            "tgl_proposal" => $this->input->post('date', true),
            "nomor_rfq" => $this->input->post('rfq',true),
            "id_methodology" => $this->input->post('methodology', true),
            "id_usaha" => $this->input->post('usaha', true),
            "file" => $file_name,
            "user_add" => $this->session->userdata('ses_id'),
            "log_modif" =>  date("Y-m-d h:i:s"),
        );

        $this->db->insert('bank_proposal', $data);
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
