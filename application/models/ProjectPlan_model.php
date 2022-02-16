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

    public function getProjectPlanById($id)
    {
        $this->db->join('data_rfq', 'data_rfq.nomor_rfq = project_plan.nomor_rfq');
        return $this->db->get_where('project_plan', array('id_project_plan' => $id))->row_array();
    }

    public function getDetailProjectPlanById($id)
    {
        $this->db->select('*');
        $this->db->from('project_plan_data');
        $this->db->join('project_plan_master', 'project_plan_master.id_pp_master = project_plan_data.id_pp_master');
        $this->db->where('project_plan_data.id_project_plan', $id);
        $this->db->order_by('project_plan_data.urutan_proses', 'ASC');
        return $this->db->get()->result_array();
    }

    public function tambahDataProjectPlan($id_pp)
    {
        $nomorUrut = $this->cekNomorUrut($id_pp);
        $id = $this->input->post('id_pp_master');
        $t_pp = substr($id, 0, 10); //Template Project Plan VARIABLE
        if ($id == 'tambahbaru') {
            $data = array(
                "nama_kegiatan" => $this->input->post('nama_kegiatan', true)
            );
            $this->db->insert('project_plan_master', $data);
            $id = $this->db->insert_id();
        } else if ($t_pp == 'templatepp') {
            $id_tpp = str_replace("templatepp", "", $id); //Template Project Plan ID
            $t_pp = $this->TemplateProjectPlan_model->ambilDataDetailTemplatePP($id_tpp); //Get All Project Plan List By Template
            $no = $nomorUrut;
            $data = array();
            foreach ($t_pp as $tpp) {
                $data[] = array(
                    "id_project_plan" => $id_pp,
                    "urutan_proses" => $no++,
                    "id_pp_master" => $tpp['id_pp_master']
                );
            }
            $this->db->insert_batch('project_plan_data', $data);

            $this->session->set_flashdata('flash', 'Ditambahkan');
            redirect('projectPlan/view/' . $id_pp);
            exit();
        }

        $data = array(
            "id_project_plan" => $id_pp,
            "urutan_proses" => $nomorUrut,
            "id_pp_master" => $id,
            "date_start_target" => date('Y-m-d', strtotime($this->input->post('date_start_target', true))),
            "date_finish_target" => date('Y-m-d', strtotime($this->input->post('date_finish_target', true)))
        );
        $this->db->insert('project_plan_data', $data);
    }

    public function ubahDataProjectPlan($id_pp, $id_ubah)
    {
        $id = $this->input->post('id_pp_master');
        $t_pp = substr($id, 0, 10); //Template Project Plan VARIABLE
        if ($id == 'tambahbaru') {
            $data = array(
                "nama_kegiatan" => $this->input->post('nama_kegiatan', true)
            );
            $this->db->insert('project_plan_master', $data);
            $id = $this->db->insert_id();
        } else if ($t_pp == 'templatepp') {
            $this->session->set_flashdata('flash2', 'Tidak bisa menambahkan template di mode edit');
            redirect('projectPlan/view/' . $id_pp);
            exit();
        }

        $data = array(
            "id_pp_master" => $id,
            "date_start_target" => date('Y-m-d', strtotime($this->input->post('date_start_target', true))),
            "date_finish_target" => date('Y-m-d', strtotime($this->input->post('date_finish_target', true)))
        );
        $this->db->where('id_pp_data', $id_ubah);
        $this->db->update('project_plan_data', $data);
    }

    public function hapusDataProjectPlan($idpp, $id)
    {
        $this->db->delete('project_plan_data', array('id_pp_data' => $id));
        // PERBAIKI NOMOR URUT
        $data_pp = $this->db->get_where('project_plan_data', ['id_project_plan' => $idpp])->result_array();
        $no = 1;
        foreach ($data_pp as $data) {
            $update = array(
                "urutan_proses" => $no++,
            );
            $this->db->where('id_pp_data', $data['id_pp_data']);
            $this->db->update('project_plan_data', $update);
            $update = array();
        }
    }

    public function ubahDataField($id_ppd)
    {
        $data = array();
        if ($this->input->post('date_start_real', true) != null) {
            $datas = array(
                "date_start_real" => date('Y-m-d', strtotime($this->input->post('date_start_real', true))),
            );
            $data = array_merge($data, $datas);
        }

        if ($this->input->post('date_finish_real', true) != null) {
            $datas = array(
                "date_finish_real" => date('Y-m-d', strtotime($this->input->post('date_finish_real', true))),
            );
            $data = array_merge($data, $datas);
        }

        if ($this->input->post('n_target', true) != null) {
            $datas = array(
                "n_target" => $this->input->post('n_target', true),
            );
            $data = array_merge($data, $datas);
        }

        if ($this->input->post('n_real', true) != null) {
            $datas = array(
                "n_real" => $this->input->post('n_real', true),
            );
            $data = array_merge($data, $datas);
        }

        if ($this->input->post('keterangan', true) != null) {
            $datas = array(
                "keterangan" => $this->input->post('keterangan', true),
            );
            $data = array_merge($data, $datas);
        }

        $datas = array(
            "done" => $this->input->post('done', true),
        );
        $data = array_merge($data, $datas);

        // $data = array(
        //     "date_start_real" => date('Y-m-d', strtotime($this->input->post('date_start_real', true))),
        //     "date_finish_real" => date('Y-m-d', strtotime($this->input->post('date_finish_real', true))),
        //     "n_target" => $this->input->post('n_target', true),
        //     "n_real" => $this->input->post('n_real', true),
        //     "done" => $this->input->post('done', true),
        //     "keterangan" => $this->input->post('keterangan', true),
        // );
        $this->db->where('id_pp_data', $id_ppd);
        $this->db->update('project_plan_data', $data);
    }




    function cekNomorUrut($id_pp)
    {
        $noRut = $this->db->order_by('urutan_proses', 'DESC')->get_where('project_plan_data', ['id_project_plan' => $id_pp])->row_array();
        if ($noRut != null) {
            $noRut = $noRut['urutan_proses'] + 1;
        } else {
            $noRut = 1;
        }
        return $noRut;
    }
}
