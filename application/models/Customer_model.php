<?php

class Customer_model extends CI_model
{
    public function getAllCustomer()
    {
        $this->db->select('*, data_perusahaan.nama as perusahaan, data_customer.nama as nama_cus');
        $this->db->from('data_customer');
        $this->db->join('data_perusahaan', 'data_perusahaan.id_perusahaan=data_customer.perusahaan');
        $this->db->join('daftar_dept', 'daftar_dept.id_dept=data_customer.dept');
        $this->db->join('daftar_jabatan', 'daftar_jabatan.id_jabatan=data_customer.jabatan');
        $this->db->order_by('data_customer.nama', 'ASC');

        return $this->db->get()->result_array();
    }

    public function getAllCustomerByPerusahaan($idPerusahaan)
    {
        $this->db->select('*, data_perusahaan.nama as perusahaan, data_customer.nama as nama_cus');
        $this->db->from('data_customer');
        $this->db->join('data_perusahaan', 'data_perusahaan.id_perusahaan=data_customer.perusahaan');
        $this->db->join('daftar_dept', 'daftar_dept.id_dept=data_customer.dept');
        $this->db->join('daftar_jabatan', 'daftar_jabatan.id_jabatan=data_customer.jabatan');
        $this->db->where('data_customer.perusahaan', $idPerusahaan);
        $this->db->order_by('data_customer.nama', 'ASC');

        return $this->db->get()->result_array();
    }

    public function tambahDataCustomer()
    {
        $nama = htmlspecialchars($this->input->post('nama', true));
        $pt = htmlspecialchars($this->input->post('perusahaan', true));
        $hp1 = htmlspecialchars($this->input->post('hp1', true));
        $this->db->select('nama, hp1')->from('data_customer');
        $where = "(nama = '$nama' AND hp1 = '$hp1') OR (nama = '$nama' AND perusahaan = '$pt') OR (hp1 = '$hp1' AND perusahaan = '$pt')";
        $this->db->where($where);
        $cek = $this->db->get()->num_rows();
        if ($cek != 0) {
            $this->session->set_flashdata('flash2', 'Data customer sudah ada');
            redirect('customer');
        } else {
            $data = array(
                "nama" => $nama,
                "status" => htmlspecialchars($this->input->post('status', true)),
                "perusahaan" => $pt,
                "dept" => htmlspecialchars($this->input->post('dept', true)),
                "jabatan" => htmlspecialchars($this->input->post('jabatan', true)),
                "hp1" => $hp1,
                "hp2" => htmlspecialchars($this->input->post('hp2', true)),
                "email1" => htmlspecialchars($this->input->post('email1', true)),
                "email2" => htmlspecialchars($this->input->post('email2', true)),
                "catatan" => htmlspecialchars($this->input->post('catatan', true)),
                "user_add" => $this->session->userdata('ses_id'),
                "log_modif" =>  date("Y-m-d h:i:s"),
            );
            $this->db->insert('data_customer', $data);
        }
    }

    public function hapusDataCustomer($id)
    {
        // $this->db->where('id', $id);
        $this->db->delete('data_customer', array('id_customer' => $id));
    }

    public function getCustomerById($id)
    {
        return $this->db->get_where('data_customer', array('id_customer' => $id))->row_array();
    }

    public function getCustomerByDeptAndCompany($id, $idDept)
    {
        return $this->db->get_where('data_customer', array('id_customer' => $id))->row_array();
    }
    public function getCustomerByIdArray($id)
    {
        return $this->db->get_where('data_customer', array('id_customer' => $id))->result_array();
    }

    public function getCustomerByName($name)
    {
        return $this->db->get_where('data_customer', array('nama' => $name))->result_array();
    }

    public function ubahDataCustomer()
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
}
