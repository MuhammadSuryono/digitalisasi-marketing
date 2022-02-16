<?php

class Perusahaan_model extends CI_model
{
    public function getAllPerusahaan()
    {
        $this->db->select('*');
        $this->db->from('data_perusahaan');
        $this->db->join('bidang_usaha', 'bidang_usaha.id_usaha=data_perusahaan.bidang');
        $this->db->join('daftar_kota', 'daftar_kota.id_kota=data_perusahaan.kota');
        $this->db->order_by('data_perusahaan.nama', 'ASC');
        return $this->db->get()->result_array();
    }

    public function tambahDataPerusahaan()
    {
        $data = array(
            "nama" => htmlspecialchars($this->input->post('nama', true)),
            "bidang" => htmlspecialchars($this->input->post('bidang', true)),
            "alamat" => htmlspecialchars($this->input->post('alamat', true)),
            "kota" => htmlspecialchars($this->input->post('kota', true)),
            "negara" => htmlspecialchars($this->input->post('negara', true)),
            "email" => htmlspecialchars($this->input->post('email', true)),
            "telp" => htmlspecialchars($this->input->post('telp', true)),
            "fax" => htmlspecialchars($this->input->post('fax', true)),
            "web" => htmlspecialchars($this->input->post('web', true)),
            "user_add" => $this->session->userdata('ses_id'),
            "log_modif" =>  date("Y-m-d h:i:s"),
        );

        $this->db->insert('data_perusahaan', $data);
    }

    public function hapusDataPerusahaan($id)
    {
        // $this->db->where('id', $id);
        $this->db->delete('data_perusahaan', array('id_perusahaan' => $id));
    }

    public function getPerusahaanById($id)
    {
        return $this->db->get_where('data_perusahaan', array('id_perusahaan' => $id))->row_array();
    }

    public function getPerusahaanByResearchBriefId($id)
    {
        return $this->db->get_where('data_perusahaan', array('id_research_brief' => $id))->row_array();
    }

    public function ubahDataPerusahaan()
    {
        $data = array(
            "nama" => htmlspecialchars($this->input->post('nama', true)),
            "bidang" => htmlspecialchars($this->input->post('bidang', true)),
            "alamat" => htmlspecialchars($this->input->post('alamat', true)),
            "kota" => htmlspecialchars($this->input->post('kota', true)),
            "negara" => htmlspecialchars($this->input->post('negara', true)),
            "email" => htmlspecialchars($this->input->post('email', true)),
            "telp" => htmlspecialchars($this->input->post('telp', true)),
            "fax" => htmlspecialchars($this->input->post('fax', true)),
            "web" => htmlspecialchars($this->input->post('web', true)),
            "user_add" => $this->session->userdata('ses_id'),
            "log_modif" =>  date("Y-m-d h:i:s"),
        );

        $this->db->where('id_perusahaan', $this->input->post('id'));
        $this->db->update('data_perusahaan', $data);
    }

    public function tambahDataPerusahaanAdam()
    {
        $nama = htmlspecialchars($this->input->post('nama', true));
        if ($this->db->get_where('data_perusahaan', ['nama' => $nama])->num_rows() != 0) {
            return 0;
        } else {
            $data = array(
                "nama" => $nama,
                "bidang" => htmlspecialchars($this->input->post('bidang', true)),
                "alamat" => htmlspecialchars($this->input->post('alamat', true)),
                "kota" => htmlspecialchars($this->input->post('kota', true)),
                "negara" => htmlspecialchars($this->input->post('negara', true)),
                "telp" => htmlspecialchars($this->input->post('telp', true)),
                "fax" => htmlspecialchars($this->input->post('fax', true)),
                "web" => htmlspecialchars($this->input->post('web', true)),
                "user_add" => $this->session->userdata('ses_id'),
                "log_modif" =>  date("Y-m-d h:i:s"),
            );
            $this->db->insert('data_perusahaan', $data);
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
