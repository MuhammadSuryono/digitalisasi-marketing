<?php

class ProjectPlan_model extends CI_model
{
    public function getAllProjectPlan()
    {
        $this->db->select('*, data_perusahaan.nama as nama_perusahaan');
        $this->db->from('project_plan');
        $this->db->join('data_rfq', 'data_rfq.nomor_rfq = project_plan.nomor_rfq');
        $this->db->join('template_pp', 'template_pp.id_template_project = project_plan.id_template_project', 'left');
        $this->db->join('data_perusahaan', 'data_perusahaan.id_perusahaan=data_rfq.id_perusahaan');
        return $this->db->get()->result_array();
    }

    public function getDetail($id)
    {
        $this->db->select('*');
        $this->db->from('detail_project_plan');
        $this->db->join('jenis_kegiatan', 'jenis_kegiatan.id_kegiatan = detail_project_plan.id_jenis_kegiatan');
        $this->db->where('detail_project_plan.id_project_plan ='.$id);
        $this->db->order_by('detail_project_plan.urutan_proses','ASC');

        return $this->db->get()->result_array();

    }

    public function getDetailField($id)
    {
        $this->db->select('*');
        $this->db->from('detail_project_plan');
        $this->db->join('jenis_kegiatan', 'jenis_kegiatan.id_kegiatan = detail_project_plan.id_jenis_kegiatan');
        $this->db->where('detail_project_plan.id_project_plan ='.$id.' and jenis_kegiatan.ket = 3');

        return $this->db->get()->row_array();

    }

    public function getDetailBrief($id)
    {
        $this->db->select('*');
        $this->db->from('detail_project_plan');
        $this->db->join('jenis_kegiatan', 'jenis_kegiatan.id_kegiatan = detail_project_plan.id_jenis_kegiatan');
        $this->db->where('detail_project_plan.id_project_plan ='.$id.' and jenis_kegiatan.ket = 2');

        return $this->db->get()->row_array();

    }

    public function tambahDataProjectPlan()
    {
        $this->db->select('max(id_project_plan) as maxId');
        $this->db->from('project_plan');
        $data = $this->db->get()->row_array();
        $id = $data['maxId'] + 1;

        $data = array(
            "id_project_plan" =>$id,
            "nomor_rfq" => $this->input->post('nomor_rfq', true),
            "id_template_project" => $this->input->post('id_template_project', true),
        );

        $this->db->insert('project_plan', $data);

        $kegiatan = $this->db->get_where('jenis_kegiatan', array('id_template_project' => $this->input->post('id_template_project', true)))->result_array();
        $no = 1;
        foreach ($kegiatan as $db) {

            $data_kegiatan = array(
                "id_project_plan" =>$id,
                "urutan_proses"=>$no,
                "id_jenis_kegiatan"=> $db['id_kegiatan'],
            );

            $this->db->insert('detail_project_plan', $data_kegiatan);

        $no++;
        }

    }

    public function hapusDataProjectPlan($id)
    {
        // $this->db->where('id', $id);
        $this->db->delete('project_plan', array('id_project_plan' => $id));
        $this->db->delete('detail_project_plan', array('id_project_plan' => $id));
    }

    public function getProjectPlanById($id)
    {
        $this->db->join('data_rfq', 'data_rfq.nomor_rfq = project_plan.nomor_rfq');
        return $this->db->get_where('project_plan', array('id_project_plan' => $id))->row_array();
    }

    public function ubahDataProjectPlan()
    {
        if($this->input->post('start', true) != null){
            $data = array(
                "date_start_target" => $this->input->post('start', true),
            );
        }

        if($this->input->post('finish', true) != null){
            $data = array(
                "date_finish_target" => $this->input->post('finish', true),
            );
        }

        if($this->input->post('start_r', true) != null){
            $data = array(
                "date_start_real" => $this->input->post('start_r', true),
            );
        }

        if($this->input->post('finish_r', true) != null){
            $data = array(
                "date_finish_real" => $this->input->post('finish_r', true),
            );
        }

        if($this->input->post('n', true) != null){
            $data = array(
                "n_real" => $this->input->post('n', true),
            );
        }

        if($this->input->post('ket', true) != null){
            $data = array(
                "keterangan" => $this->input->post('ket', true),
            );
        }

        if($this->input->post('done', true) != null){
            $data = array(
                "done" => $this->input->post('done', true),
            );
        }

        $this->db->where('id_detail_pp', $this->input->post('id'));
        $this->db->update('detail_project_plan', $data);
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
