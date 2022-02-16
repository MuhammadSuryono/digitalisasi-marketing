<?php 

class Request_model extends CI_model
{
    public function getAllRequest(){
        return $this->db->get('data_request')->result_array();
    }

    public function tambahData()
    {
        $data = array(
            "nama_request" => $this->input->post('nama_request', true),
            "user_add" => $this->session->userdata('ses_id'),
            "log_modif" =>  date("Y-m-d h:i:s"),
        );

        $this->db->insert('data_request', $data);
    }

    public function hapusData($id)
    {
        // $this->db->where('id', $id);
        $this->db->delete('data_request', array('id_request' => $id));
    }

    public function ubahData()
    {
        $data = array(
            "nama_request" => $this->input->post('nama_request', true),
            "user_add" => $this->session->userdata('ses_id'),
            "log_modif" =>  date("Y-m-d h:i:s"),
        );

        $this->db->where('id_request', $this->input->post('id'));
        $this->db->update('data_request', $data);
    }

}
