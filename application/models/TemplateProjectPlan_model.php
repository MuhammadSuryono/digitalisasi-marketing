<?php

class TemplateProjectPlan_model extends CI_model
{
    public function getAllTemplatepp()
    {
        return $this->db->get('template_pp')->result_array();
    }

    public function tambahTemplatepp()
    {
        $data = array(
            "nama_template" => $this->input->post('nama_template', true),
            "log_modif" =>  date("Y-m-d h:i:s"),
        );
        $this->db->insert('template_pp', $data);
    }

    public function getTemplateById($id)
    {
        return $this->db->get_where('template_pp', array('id_template_project' => $id))->row_array();
    }

    public function hapusDataTemplatepp($id)
    {
        $this->db->delete('template_pp', array('id_template_project' => $id));
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

    // TAMBAHAN ADAM SANTOSO
    public function ambilDataMasterPP(){
      return $this->db->order_by('nama_kegiatan', 'ASC')->get('project_plan_master')->result_array();
    }

    public function ambilDataDetailTemplatePP($id){
      $this->db->select('*');
      $this->db->from('project_plan_template_detail');
      $this->db->join('project_plan_master', 'project_plan_master.id_pp_master = project_plan_template_detail.id_pp_master');
      $this->db->where('project_plan_template_detail.id_template_pp', $id);
      return $this->db->get()->result_array();
    }

    public function tambahDataKegiatan()
    {
        $id = $this->input->post('id_pp_master');
        if($id == 'tambahbaru') {
            $data = array(
                "nama_kegiatan" => $this->input->post('nama_kegiatan', true)
            );
            $this->db->insert('project_plan_master', $data);
            $id = $this->db->insert_id();
        }

        $data = array(
            "id_template_pp" => $this->input->post('id_template_pp', true),
            "id_pp_master" => $id
        );

        $this->db->insert('project_plan_template_detail', $data);
    }
    public function ubahDataKegiatan($idKegiatan)
    {
        $id = $this->input->post('id_pp_master');
        if($id == 'tambahbaru') {
            $data = array(
                "nama_kegiatan" => $this->input->post('nama_kegiatan', true)
            );
            $this->db->insert('project_plan_master', $data);
            $id = $this->db->insert_id();
        }

        $data = array(
            "id_pp_master" => $id
        );
        $this->db->where('id_pp_kegiatan', $idKegiatan);
        $this->db->update('project_plan_template_detail', $data);
    }
    public function hapusDataKegiatan($id)
    {
        $this->db->delete('project_plan_template_detail', array('id_pp_kegiatan' => $id));
    }

}
