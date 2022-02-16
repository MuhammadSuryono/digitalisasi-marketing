<?php

class StkbPerdin_model extends CI_model
{
    public function getAllStkbPerdin()
    {
        $this->db->select('*');
        $this->db->from('stkb_perdin');
        return $this->db->get()->result_array();
    }

    public function tambahdatamatrixperdin($id)
    {
        $data = array(
            "kotaasal" => htmlspecialchars($this->input->post('kotaasal', true)),
            "kotatujuan" => htmlspecialchars($this->input->post('kotatujuan', true)),
            "jenis" => htmlspecialchars($this->input->post('jenis', true)),
            "matrixhonor" => htmlspecialchars($this->input->post('matrixhonor', true)),
        );

        $this->db->insert('stkb_perdin', $data);
    }

    public function hapusDatastkbperdin($id)
    {
        // $this->db->where('id', $id);
        $this->db->delete('stkb_perdin', array('no' => $id));
    }

    public function getCostingById($id)
    {
        return $this->db->get_where('data_customer', array('id_customer' => $id))->row_array();
    }

	public function getCostingByProject($id)
    {
		$this->db->select('*, costing.keterangan as ket');
		$this->db->from('costing');
		$this->db->join('group_costing1', 'group_costing1.id_g_c1 = costing.g1');
		$this->db->join('group_costing2', 'group_costing2.id_g_c2 = costing.g2');
        $this->db->where('id_project ='. $id);
        return $this->db->get()->result_array();
    }

    public function ubahDataCosting($id)
    {
		$data = array(
            "id_project" => $id,
            "g1" => htmlspecialchars($this->input->post('g1', true)),
            "g2" => htmlspecialchars($this->input->post('g2', true)),
            "rpsatuan" => htmlspecialchars($this->input->post('rpsatuan', true)),
            "keterangan" => htmlspecialchars($this->input->post('keterangan', true)),
            "jumlah" => htmlspecialchars($this->input->post('jumlah', true)),
            "user_add" => $this->session->userdata('ses_id'),
            "log_modif" =>  date("Y-m-d h:i:s"),
        );

        $this->db->where('id_costing', $this->input->post('id'));
        $this->db->update('costing', $data);
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
