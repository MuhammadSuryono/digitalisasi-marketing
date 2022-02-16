<?php

class Topic_model extends CI_model
{
    public function getAllTopic()
    {
        $this->db->order_by('keterangan','ASC');
        return $this->db->get('data_topic')->result_array();
    }

    public function tambahDataTopic()
    {
        $data = array(
            "topic" => $this->input->post('topic', true),
            "keterangan" => $this->input->post('keterangan', true),
            "user_add" => $this->session->userdata('ses_id'),
            "log_modif" =>  date("Y-m-d h:i:s"),
        );

        $this->db->insert('data_topic', $data);
    }

    public function hapusDataTopic($id)
    {
        // $this->db->where('id', $id);
        $this->db->delete('data_topic', array('id_topic' => $id));
    }

    public function getTopicById($id)
    {
        return $this->db->get_where('data_topic', array('id_topic' => $id))->row_array();
    }

    public function getTopicByIdArray($id)
    {
        return $this->db->get_where('data_topic', array('id_topic' => $id))->result_array();
    }

    public function ubahDataTopic()
    {
        $data = array(
            "topic" => $this->input->post('topic', true),
	          "keterangan" => $this->input->post('keterangan', true),
            "user_add" => $this->session->userdata('ses_id'),
            "log_modif" =>  date("Y-m-d h:i:s"),
        );

        $this->db->where('id_topic', $this->input->post('id'));
        $this->db->update('data_topic', $data);
    }
}
