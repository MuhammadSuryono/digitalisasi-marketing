<?php

class Dept_model extends CI_model
{
    public function getAllDept()
    {
        $this->db->order_by('dept', 'ASC');
        return $this->db->get('daftar_dept')->result_array();
    }

    public function tambahDataDept()
    {

        $nama = $this->input->post('dept', true);

        // cek apa sudah ada nama yang sama atau belum
        if ($this->db->get_where('daftar_dept', ['dept' => $nama])->num_rows() != 0) {
            return 0;
        } else {
            $data = array(
                "dept" => $this->input->post('dept', true),
                "user_add" => $this->session->userdata('ses_id'),
                "log_modif" =>  date("Y-m-d h:i:s"),
            );

            $this->db->insert('daftar_dept', $data);
            return 1;
        }
    }

    public function hapusDataDept($id)
    {
        // $this->db->where('id', $id);
        $this->db->delete('daftar_dept', array('id_dept' => $id));
    }

    public function getDeptById($id)
    {
        return $this->db->get_where('daftar_dept', array('id_dept' => $id))->row_array();
    }

    public function ubahDataDept()
    {
        $nama = $this->input->post('dept', true);

        // cek apa sudah ada nama yang sama atau belum
        if ($this->db->get_where('daftar_dept', ['dept' => $nama])->num_rows() != 0) {
            return 0;
        } else {
            $data = array(
                "dept" => $this->input->post('dept', true),
                "user_add" => $this->session->userdata('ses_id'),
                "log_modif" =>  date("Y-m-d h:i:s"),
            );

            $this->db->where('id_dept', $this->input->post('id'));
            $this->db->update('daftar_dept', $data);
            return 1;
        }
    }

    public function tambahDataDeptAdam()
    {
        $nama = $this->input->post('dept', true);
        // cek apa sudah ada nama yang sama atau belum
        if ($this->db->get_where('daftar_dept', ['dept' => $nama])->num_rows() != 0) {
            return 0;
        } else {
            $data = array(
                "dept" => $nama,
                "user_add" => $this->session->userdata('ses_id'),
                "log_modif" =>  date("Y-m-d h:i:s"),
            );
            $this->db->insert('daftar_dept', $data);
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
