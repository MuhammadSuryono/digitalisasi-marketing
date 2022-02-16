<?php

class StkbOps_model extends CI_model
{
    public function getAllStkbOps()
    {
        $this->db->select('*');
        $this->db->from('stkb_ops');
        return $this->db->get()->result_array();
    }

    public function tambahstkbops($id)
    {
        $data = array(
            "kotaasal" => htmlspecialchars($this->input->post('kotaasal', true)),
            "kotatujuan" => htmlspecialchars($this->input->post('kotatujuan', true)),
            "jenis" => htmlspecialchars($this->input->post('jenis', true)),
            "matrixhonor" => htmlspecialchars($this->input->post('matrixhonor', true)),
        );

        $this->db->insert('stkb_perdin', $data);
    }

    public function getallproject()
    {
      $db2 = $this->load->database('database_kedua', TRUE);
      $db2->select('*');
      $db2->from('project');
      $db2->where('visible', 'y');
      $db2->where('type', 'n');
      $db2->order_by('nama', 'asc');
      return $db2->get()->result_array();
    }

    public function getalliddata()
    {
      $db2 = $this->load->database('database_kedua', TRUE);
      $db2->select('Id,Nama');
      $db2->from('id_data');
      $db2->where("(level='Supervisor' OR level='Kareg')");
      $db2->order_by('nama', 'asc');
      return $db2->get()->result_array();
    }

    

    // public function hapusDatastkbperdin($id)
    // {
    //     // $this->db->where('id', $id);
    //     $this->db->delete('stkb_perdin', array('no' => $id));
    // }
    //
    // public function getCostingById($id)
    // {
    //     return $this->db->get_where('data_customer', array('id_customer' => $id))->row_array();
    // }



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
