<?php

class User_model extends CI_model
{
    public function getAllUser()
    {
        $this->db->select('*');
        $this->db->from('data_user');
        $this->db->join('daftar_jabatan', 'daftar_jabatan.id_jabatan=data_user.jabatan');
        $this->db->join('daftar_dept', 'daftar_dept.id_dept=data_user.dept');
        $this->db->order_by('data_user.nama_user', 'ASC');

        return $this->db->get()->result_array();
    }

    public function tambahDataUser()
    {
        $data = array(
            "nama_user" => $this->input->post('user', true),
            "password" => md5($this->input->post('password1', true)),
            "jabatan" => $this->input->post('jabatan', true),
            "dept" => $this->input->post('dept', true),
            "email1" => $this->input->post('email1', true),
            "email2" => $this->input->post('email2', true),
            "user_add" => $this->session->userdata('ses_id'),
            "log_modif" =>  date("Y-m-d H:i:s"),
        );

        $this->db->insert('data_user', $data);
    }

    public function hapusDataUser($id)
    {
        // $this->db->where('id', $id);
        $this->db->delete('data_user', array('id_user' => $id));
    }

    public function getUserById($id)
    {
        return $this->db->get_where('data_user', array('id_user' => $id))->row_array();
    }

    public function ubahDataUser()
    {
        $data = [
            "nama_user" => $this->input->post('user', true),
            "jabatan" => $this->input->post('jabatan', true),
            "dept" => $this->input->post('dept', true),
            "email1" => $this->input->post('email1', true),
            "email2" => $this->input->post('email2', true),
            "user_add" => $this->session->userdata('ses_id'),
            "log_modif" =>  date("Y-m-d H:i:s"),
        ];

        $this->db->where('id_user', $this->input->post('id'));
        $this->db->update('data_user', $data);
    }

    public function changePw($id)
    {
        $data = [
            "password" => md5($this->input->post('new_ps1', true)),
        ];

        $this->db->where('id_user', $this->input->post('id'));
        $this->db->update('data_user', $data);
    }
}
