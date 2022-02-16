<?php 

class Project_model extends CI_model
{
    public function getAllProject()
    {
        $this->db->select('*');
        $this->db->from('project');
        return $this->db->get()->result_array();
    }

    public function tambahDataProject()
    {
        $data = array(
            "nama_project" => htmlspecialchars($this->input->post('nama_project', true)),
			);
        $this->db->insert('project', $data);
    }

    public function hapusDataCosting($id)
    {
        // $this->db->where('id', $id);
        $this->db->delete('data_customer', array('id_customer' => $id));
    }

    public function getProjectById($id)
    {
        return $this->db->get_where('project', array('id_project' => $id))->row_array();
    }

    public function ubahDataCosting()
    {
       $data = array(
            "nama" => htmlspecialchars($this->input->post('nama', true)),
            "status" => htmlspecialchars($this->input->post('status', true)),
            "perusahaan" => htmlspecialchars($this->input->post('perusahaan', true)),
            "dept" => htmlspecialchars($this->input->post('dept', true)),
            "jabatan" => htmlspecialchars($this->input->post('jabatan', true)),
            "hp1" => htmlspecialchars($this->input->post('hp1', true)),
            "hp2" => htmlspecialchars($this->input->post('hp2', true)),
            "email1" => htmlspecialchars($this->input->post('email1', true)),
            "email2" => htmlspecialchars($this->input->post('email2', true)),
            "catatan" => htmlspecialchars($this->input->post('catatan', true)),
            "user_add" => $this->session->userdata('ses_id'),
            "log_modif" =>  date("Y-m-d h:i:s"),
        );

        $this->db->where('id_customer', $this->input->post('id'));
        $this->db->update('data_customer', $data);
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
