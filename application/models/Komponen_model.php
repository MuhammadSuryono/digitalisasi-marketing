<?php 

class Komponen_model extends CI_model
{
    public function getAllKomponen()
    {
        $this->db->select('*');
        $this->db->from('komponen_cost');

        return $this->db->get()->result_array();
    }

    public function tambahDataKomponen()
    {
        $data = array(
            "komponen" => $this->input->post('komponen', true),
        );

        $this->db->insert('komponen_cost', $data);
    }

    public function hapusDataKomponen($id)
    {
        // $this->db->where('id', $id);
        $this->db->delete('komponen_cost', array('id_komponen' => $id));
    }

    public function getKotaById($id)
    {
        return $this->db->get_where('daftar_kota', array('id_kota' => $id))->row_array();
    }

    public function ubahDataKota()
    {
        $data = array(
            "id_negara" => $this->input->post('id_negara',true),
            "kota" => $this->input->post('kota', true),
            "user_add" => $this->session->userdata('ses_id'),
            "log_modif" =>  date("Y-m-d h:i:s"),
        );

        $this->db->where('id_kota', $this->input->post('id'));
        $this->db->update('daftar_kota', $data);
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
