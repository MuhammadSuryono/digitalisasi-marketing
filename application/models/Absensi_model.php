<?php 

class Absensi_model extends CI_model
{
    public function getAllAbsensi()
    {
        $this->db->select('*');
        $this->db->from('absensi');
        $this->db->join('data_rfq','data_rfq.nomor_rfq = absensi.nomor_rfq');

        return $this->db->get()->result_array();
    }

    public function tambahDataAbsensi()
    {
        $data = array(
            "nomor_rfq" => $this->input->post('nomor_rfq', true),
            "kegiatan" => $this->input->post('kegiatan', true),
            "tanggal" => $this->input->post('tanggal', true),
        );

        $this->db->insert('absensi', $data);
    }

    public function hapusDataBatal($id)
    {
        // $this->db->where('id', $id);
        $this->db->delete('data_batal', array('id_batal' => $id));
    }

    public function getAbsensiById($id)
    {
        $this->db->select('*');
        $this->db->from('absensi');
        $this->db->join('data_rfq','data_rfq.nomor_rfq = absensi.nomor_rfq');
        $this->db->where('absensi.id_absensi', $id);

        return $this->db->get()->row_array();
    }

    public function tambahDetail($id, $user)
    {
        $data = array(
            "id_absensi" => $id,
            "id_user" => $user,
            "date" => date("Y-m-d H:i:s"),
        );

        $this->db->insert('detail_absen', $data);
    }

    public function getDetailAbsenId($id, $user)
    {
        $this->db->select('*');
        $this->db->from('detail_absen');
        $this->db->where('id_absensi ='.$id.' and id_user ='.$user);

        return $this->db->get()->row_array();
    }

    public function ubahDataBatal()
    {
        $data = array(
            "alasan_batal" => $this->input->post('alasan_batal', true),
            "keterangan" => $this->input->post('keterangan', true),
            "user_add" => $this->session->userdata('ses_id'),
            "log_modif" =>  date("Y-m-d h:i:s"),
        );

        $this->db->where('id_batal', $this->input->post('id'));
        $this->db->update('data_batal', $data);
    }
}
