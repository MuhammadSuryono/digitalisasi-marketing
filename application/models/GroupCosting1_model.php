<?php 

class GroupCosting1_model extends CI_model
{
    public function getAllGroupCosting1()
    {
        return $this->db->get('group_costing1')->result_array();
    }

    public function tambahDataGroupCosting1()
    {
        $data = array(
            "g_c1" => $this->input->post('g_c1', true),
            "keterangan" => $this->input->post('keterangan', true),
        );

        $this->db->insert('group_costing1', $data);
    }

    public function hapusDataGroupCosting1($id)
    {
        // $this->db->where('id', $id);
        $this->db->delete('group_costing1', array('id_g_c1' => $id));
    }

    public function getGroupCosting1ById($id)
    {
        return $this->db->get_where('group_costing1', array('id_g_c1' => $id))->row_array();
    }

    public function ubahDataGroupCosting1()
    {
        $data = array(
            "g_c1" => $this->input->post('g_c1', true),
            "keterangan" => $this->input->post('keterangan', true),
        );

        $this->db->where('id_g_c1', $this->input->post('id'));
        $this->db->update('group_costing1', $data);
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
