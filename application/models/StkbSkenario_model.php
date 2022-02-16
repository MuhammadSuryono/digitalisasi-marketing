<?php

class StkbSkenario_model extends CI_model
{
    public function getAllStkbSkenario()
    {
        $this->db->select('*');
        $this->db->from('stkb_skenario');
        return $this->db->get()->result_array();
    }

    public function tambahdatastkbskenario($id)
    {
        $data = array(
            "nama" => htmlspecialchars($this->input->post('nama', true)),
            "keterangan" => htmlspecialchars($this->input->post('keterangan', true)),
        );

        $this->db->insert('stkb_skenario', $data);
    }

    public function hapusdatastkbskenario($id)
    {
        // $this->db->where('id', $id);
        $this->db->delete('stkb_skenario', array('no' => $id));
    }

    public function getstkbskenarioById($id)
    {
        return $this->db->get_where('stkb_skenario', array('no' => $id))->row_array();
    }

    public function ubahdatastkbskenario($id)
    {
		$data = array(
            "nama" => htmlspecialchars($this->input->post('nama', true)),
            "keterangan" => htmlspecialchars($this->input->post('keterangan', true)),
        );

        $this->db->where('no', $this->input->post('no'));
        $this->db->update('stkb_skenario', $data);
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
