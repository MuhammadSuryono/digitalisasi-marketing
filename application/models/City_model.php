<?php 

class City_model extends CI_model
{
    public function getAllCity()
    {

        return $this->db->get('city_cost')->result_array();
    }

    public function tambahCity()
    {
        $data = array(
            "name_city" => $this->input->post('city', true),
        );

       $this->db->insert('city_cost', $data);
    }

    public function editCity()
    {
        $data = array(
            "name_city" => $this->input->post('city', true),
        );

       
       $this->db->where('id_city', $this->input->post('id'));
       $this->db->update('city_cost', $data);
    }

    public function tambahCityKomponen()
    {

        $this->db->select('max(id_city) as maxId');
        $this->db->from('city_cost');
        $id = $this->db->get()->row_array();

        $komponen = $this->db->get('komponen_cost')->result_array();

        foreach ($komponen as $db) {
            $data = array(
                "id_kota_cost" => $id['maxId'],
                "id_komponen_cost" => $db['id_komponen'],
                "harga"=> $this->input->post($db['id_komponen'], true),
            );

           $this->db->insert('city_kom', $data);
        }
    }

     public function editCityKomponen()
    {

        $komponen = $this->db->get('komponen_cost')->result_array();

        foreach ($komponen as $db) {
            $data = array(
                "harga"=> $this->input->post($db['id_komponen'], true),
            );

           $this->db->where('id_kota_cost = '.$this->input->post('id').' and id_komponen_cost ='.$db['id_komponen']);
           $this->db->update('city_kom', $data);
        }
    }

    public function hapusDataKota($id)
    {
        // $this->db->where('id', $id);
        $this->db->delete('daftar_kota', array('id_kota' => $id));
    }

    public function getKotaById($id)
    {
        return $this->db->get_where('daftar_kota', array('id_kota' => $id))->row_array();
    }

    public function ubahDataKota()
    {
        $data = array(
            "id_negara" => $this->input->post('id_negara',true),
            "kota" => $this->input->post('kota', true),
            "user_add" => $this->session->userdata('ses_id'),
            "log_modif" =>  date("Y-m-d h:i:s"),
        );

        $this->db->where('id_kota', $this->input->post('id'));
        $this->db->update('daftar_kota', $data);
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
