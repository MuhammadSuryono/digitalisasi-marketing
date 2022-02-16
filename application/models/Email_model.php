<?php 

class Email_model extends CI_model
{
    public function getAllEmail()
    {
        $this->db->select('*');
        $this->db->from('email');
        $this->db->order_by('log_modif','DESC');
        return $this->db->get()->result_array();
    }

    public function tambahDataEmail($id, $data_file, $sent)
    {
        $data = array(
            "tgl_email" => date('Y-m-d'),
            "judul_email" => $this->input->post('judul', true),
            "head_isi" => $this->input->post('header', true),
            "isi_email" => $this->input->post('isi_email', true),
            "id_customer" => $id,
            "file" => $data_file,
            "user_add" => $this->session->userdata('ses_id'),
            "log_modif" =>  date("Y-m-d H:i:s"),
        );

        $this->db->insert('email', $data);
    }

    public function hapusEmail($id)
    {
        // $this->db->where('id', $id);
        $this->db->delete('email', array('id_email' => $id));
    }

    public function getEmailById($id)
    {
        return $this->db->get_where('email', array('id_email' => $id))->row_array();
    }

    public function ubahDataEmail()
    {
        $data = array(
            "dept" => $this->input->post('dept', true),
            "user_add" => $this->session->userdata('ses_id'),
            "log_modif" =>  date("Y-m-d h:i:s"),
        );

        $this->db->where('id_dept', $this->input->post('id'));
        $this->db->update('daftar_dept', $data);
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
