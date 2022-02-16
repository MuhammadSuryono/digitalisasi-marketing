<?php

class Kota_model extends CI_model
{
    public function getAllKota()
    {
        $this->db->select('*');
        $this->db->from('daftar_kota');
        $this->db->join('data_negara', 'data_negara.id_negara = daftar_kota.id_negara');
        $this->db->order_by('daftar_kota.kota', 'ASC');

        return $this->db->get()->result_array();
    }

    public function tambahDataKota()
    {
        $nama = $this->input->post('kota', true);

        // cek apa sudah ada nama yang sama atau belum
        if ($this->db->get_where('daftar_kota', ['kota' => $nama])->num_rows() != 0) {
            return 0;
        } else {
            $data = array(
                "id_negara" => $this->input->post('id_negara', true),
                "kota" => $this->input->post('kota', true),
                "user_add" => $this->session->userdata('ses_id'),
                "log_modif" =>  date("Y-m-d h:i:s"),
            );

            $this->db->insert('daftar_kota', $data);

            return 1;
        }
    }

    public function hapusDataKota($id)
    {
        // $this->db->where('id', $id);
        $this->db->delete('daftar_kota', array('id_kota' => $id));
    }

    public function getKotaById($id)
    {
        return $this->db->get_where('daftar_kota', array('id_kota' => $id))->row_array();
    }

    public function ubahDataKota()
    {
        $nama = $this->input->post('kota', true);

        // cek apa sudah ada nama yang sama atau belum
        if ($this->db->get_where('daftar_kota', ['kota' => $nama])->num_rows() != 0) {
            return 0;
        } else {
            $data = array(
                "id_negara" => $this->input->post('id_negara', true),
                "kota" => $this->input->post('kota', true),
                "user_add" => $this->session->userdata('ses_id'),
                "log_modif" =>  date("Y-m-d h:i:s"),
            );

            $this->db->where('id_kota', $this->input->post('id'));
            $this->db->update('daftar_kota', $data);
            return 1;
        }
    }





    public function tambahDataKotaAdam()
    {
        $nama = $this->input->post('kota', true);
        $id_negara = $this->input->post('id_negara', true);
        // cek apa sudah ada nama yang sama atau belum
        if ($this->db->get_where('daftar_kota', ['id_negara' => $id_negara, 'kota' => $nama])->num_rows() != 0) {
            return 0;
        } else {
            $data = array(
                "id_negara" => $id_negara,
                "kota" => $nama,
                "user_add" => $this->session->userdata('ses_id'),
                "log_modif" =>  date("Y-m-d h:i:s"),
            );
            $this->db->insert('daftar_kota', $data);
            return 1;
        }
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
