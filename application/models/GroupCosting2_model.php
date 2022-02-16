<?php 

class GroupCosting2_model extends CI_model
{
    public function getAllGroupCosting2()
    {
        return $this->db->get('group_costing2')->result_array();
    }

    public function tambahDataGroupCosting2()
    {
        $data = array(
            "g_c2" => $this->input->post('g_c2', true),
            "keterangan" => $this->input->post('keterangan', true),
        );

        $this->db->insert('group_costing2', $data);
    }

    public function hapusDataGroupCosting2($id)
    {
        // $this->db->where('id', $id);
        $this->db->delete('group_costing2', array('id_g_c2' => $id));
    }

    public function getGroupCosting2ById($id)
    {
        return $this->db->get_where('group_costing2', array('id_g_c2' => $id))->row_array();
    }

    public function ubahDataGroupCosting2()
    {
        $data = array(
            "g_c2" => $this->input->post('g_c2', true),
            "keterangan" => $this->input->post('keterangan', true),
        );

        $this->db->where('id_g_c2', $this->input->post('id'));
        $this->db->update('group_costing2', $data);
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
