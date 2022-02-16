<?php

class Usaha_model extends CI_model
{
    public function getAllUsaha()
    {
        $this->db->order_by('bidang', 'ASC');
        return $this->db->get('bidang_usaha')->result_array();
    }

    public function tambahDataUsaha()
    {

        $nama = $this->input->post('bidang', true);

        // cek apa sudah ada nama yang sama atau belum
        if ($this->db->get_where('bidang_usaha', ['bidang' => $nama])->num_rows() != 0) {
            return 0;
        } else {
            $data = array(
                "bidang" => htmlspecialchars($this->input->post('bidang', true)),
                "ket" => htmlspecialchars($this->input->post('ket', true)),
                "user_add" => $this->session->userdata('ses_id'),
                "log_modif" =>  date("Y-m-d h:i:s"),
            );

            $this->db->insert('bidang_usaha', $data);
            return 1;
        }
    }

    public function hapusDataUsaha($id)
    {
        // $this->db->where('id', $id);
        $this->db->delete('bidang_usaha', array('id_usaha' => $id));
    }

    public function getUsahaById($id)
    {
        return $this->db->get_where('bidang_usaha', array('id_usaha' => $id))->row_array();
    }

    public function ubahDataUsaha()
    {
        $nama = $this->input->post('bidang', true);

        // cek apa sudah ada nama yang sama atau belum
        if ($this->db->get_where('bidang_usaha', ['bidang' => $nama])->num_rows() != 0) {
            return 0;
        } else {
            $data = array(
                "bidang" => htmlspecialchars($this->input->post('bidang', true)),
                "ket" => htmlspecialchars($this->input->post('ket', true)),
                "user_add" => $this->session->userdata('ses_id'),
                "log_modif" =>  date("Y-m-d h:i:s"),
            );

            $this->db->where('id_usaha', $this->input->post('id'));
            $this->db->update('bidang_usaha', $data);
            return 1;
        }
    }



    public function tambahDataBidangAdam()
    {
        $nama = $this->input->post('bidang', true);
        // cek apa sudah ada nama yang sama atau belum
        if ($this->db->get_where('bidang_usaha', ['bidang' => $nama])->num_rows() != 0) {
            return 0;
        } else {
            $data = array(
                "bidang" => $nama,
                "ket" => htmlspecialchars($this->input->post('ket', true)),
                "user_add" => $this->session->userdata('ses_id'),
                "log_modif" =>  date("Y-m-d h:i:s"),
            );
            $this->db->insert('bidang_usaha', $data);
            $insert_id = $this->db->insert_id();
            return $insert_id;
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
