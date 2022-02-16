<?php

class Negara_model extends CI_model
{
    public function getAllNegara()
    {
        $this->db->select('*');
        $this->db->from('data_negara');
        $this->db->order_by('negara','ASC');

        return $this->db->get()->result_array();
    }

    public function tambahDataNegara()
    {
        $nama = $this->input->post('negara', true);

        // cek apa sudah ada nama yang sama atau belum
        if($this->db->get_where('data_negara', ['negara' => $nama])->num_rows() != 0){
            return 0;
        } else {

            $data = array(
            "negara" => $this->input->post('negara', true),
        );

            $this->db->insert('data_negara', $data);
            return 1;

        }


    }

    public function hapusDataNegara($id)
    {
        // $this->db->where('id', $id);
        $this->db->delete('data_negara', array('id_negara' => $id));
    }

    public function getNegaraById($id)
    {
        return $this->db->get_where('data_negara', array('id_negara' => $id))->row_array();
    }

    public function ubahDataNegara()
    {
        $nama = $this->input->post('negara', true);

        // cek apa sudah ada nama yang sama atau belum
        if($this->db->get_where('data_negara', ['negara' => $nama])->num_rows() != 0){
            return 0;
        } else {

             $data = array(
            "negara" => $this->input->post('negara', true),
        );

        $this->db->where('id_negara', $this->input->post('id'));
        $this->db->update('data_negara', $data);

            return 1;

        }
    }





    public function tambahDataNegaraAdam(){
      $nama = $this->input->post('negara', true);
      // cek apa sudah ada nama yang sama atau belum
      if($this->db->get_where('data_negara', ['negara' => $nama])->num_rows() != 0){
          return 0;
      } else {
          $data = array(
            "negara" => $nama,
          );
          $this->db->insert('data_negara', $data);
          $insert_id = $this->db->insert_id();
          return $insert_id;
      }
    }
}
