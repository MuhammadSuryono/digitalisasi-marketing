<?php

class ResearchBrief_model extends CI_model
{
    public function setResearchBrief()
    {
        $arrQuestionSr = [];
        foreach ($this->input->post('questionSr[]') as $t) {
            $string = str_replace('●', '&bull;', $t);
            array_push($arrQuestionSr, $string);
        }
        $arrQuestionPp = [];
        foreach ($this->input->post('questionPp[]') as $t) {
            $string = str_replace('●', '&bull;', $t);
            array_push($arrQuestionPp, $string);
        }
        $arrQuestionLbr = [];
        foreach ($this->input->post('questionLbr[]') as $t) {
            $string = str_replace('●', '&bull;', $t);
            array_push($arrQuestionLbr, $string);
        }
        $arrQuestionm = [];
        foreach ($this->input->post('questionm[]') as $t) {
            $string = str_replace('●', '&bull;', $t);
            array_push($arrQuestionm, $string);
        }
        // $arrQuestionDs = [];
        // foreach ($this->input->post('questionDs[]') as $t) {
        //     $string = str_replace('●', '&bull;', $t);
        //     array_push($arrQuestionDs, $string);
        // }
        $arrQuestiont = [];
        foreach ($this->input->post('questiont[]') as $t) {
            $string = str_replace('●', '&bull;', $t);
            array_push($arrQuestiont, $string);
        }
        $arrQuestionb = [];
        foreach ($this->input->post('questionb[]') as $t) {
            $string = str_replace('●', '&bull;', $t);
            array_push($arrQuestionb, $string);
        }
        $arrQuestionHt = [];
        foreach ($this->input->post('questionHt[]') as $t) {
            $string = str_replace('●', '&bull;', $t);
            array_push($arrQuestionHt, $string);
        }
        $pesaing = str_replace('●', '&bull;', $this->input->post('pesaing'));
        // var_dump($this->input->post('id_departemen'));
        // die();
        $data = [
            'id_perusahaan' => $this->input->post('id_perusahaan'),
            'id_customer' => serialize($this->input->post('id_customer[]')),
            'id_dept' => $this->input->post('id_departemen'),
            'profil_perusahaan' => serialize($arrQuestionPp),
            'latar_belakang_research' => serialize($arrQuestionLbr),
            'methodology ' => serialize($arrQuestionm),
            'sampling_dan_responden' =>  serialize($arrQuestionSr),
            // 'distribusi_sampling' => serialize($arrQuestionDs),
            'timeline ' => serialize($arrQuestiont),
            'budget ' => serialize($arrQuestionb),
            'hal_teknis_lainnya' => serialize($arrQuestionHt),
            'peserta' => serialize($this->input->post('id_peserta[]')),
            'pesaing' => serialize($pesaing),
            'created_by' => $this->session->userdata('ses_id'),
            'created_at' => date('Y-m-d'),
            'updated_at' => date('Y-m-d')
        ];

        $this->db->insert('research_brief', $data);

        $getId = $this->db->query('SELECT * FROM research_brief ORDER BY id_research_brief DESC LIMIT 1')->row_array();
        $query = $this->db->get_where('data_perusahaan', ['id_perusahaan' => $this->input->post('id_perusahaan')])->row_array();
        if (!$query['id_research_brief']) {
            $this->db->set('id_research_brief', $getId['id_research_brief']);
            $this->db->where('id_perusahaan',  $this->input->post('id_perusahaan'));
            $this->db->update('data_perusahaan');
        }
    }

    public function getAllResearchBrief()
    {
        $query = $this->db->query('
            SELECT *
            FROM research_brief
            JOIN data_perusahaan ON data_perusahaan.id_perusahaan = research_brief.id_perusahaan
            JOIN data_user ON data_user.id_user = research_brief.created_by
            ORDER BY data_perusahaan.nama
        ')->result_array();

        return $query;
    }

    public function getResearchBriefById($id)
    {
        return $this->db->query("
            SELECT *
            FROM research_brief
            JOIN data_perusahaan ON data_perusahaan.id_perusahaan = research_brief.id_perusahaan
            JOIN data_user ON data_user.id_user = research_brief.created_by
            WHERE research_brief.id_research_brief = $id
        ")->row_array();
    }
    public function getResearchBriefByIdAndDept($id, $idDept)
    {
        return $this->db->query("
            SELECT *
            FROM research_brief
            JOIN data_perusahaan ON data_perusahaan.id_perusahaan = research_brief.id_perusahaan
            JOIN data_user ON data_user.id_user = research_brief.created_by
            WHERE research_brief.id_research_brief = $id AND research_brief.id_dept = $idDept
        ")->row_array();
    }

    public function updateResearchBrief()
    {
        $arrQuestionSr = [];
        foreach ($this->input->post('questionSr[]') as $t) {
            $string = str_replace('●', '&bull;', $t);
            array_push($arrQuestionSr, $string);
        }
        // $arrQuestionPp = [];
        // foreach ($this->input->post('questionPp[]') as $t) {
        //     $string = str_replace('●', '&bull;', $t);
        //     array_push($arrQuestionPp, $string);
        // }
        $arrQuestionLbr = [];
        foreach ($this->input->post('questionLbr[]') as $t) {
            $string = str_replace('●', '&bull;', $t);
            array_push($arrQuestionLbr, $string);
        }
        $arrQuestionm = [];
        foreach ($this->input->post('questionm[]') as $t) {
            $string = str_replace('●', '&bull;', $t);
            array_push($arrQuestionm, $string);
        }
        // $arrQuestionDs = [];
        // foreach ($this->input->post('questionDs[]') as $t) {
        //     $string = str_replace('●', '&bull;', $t);
        //     array_push($arrQuestionDs, $string);
        // }
        $arrQuestiont = [];
        foreach ($this->input->post('questiont[]') as $t) {
            $string = str_replace('●', '&bull;', $t);
            array_push($arrQuestiont, $string);
        }
        $arrQuestionb = [];
        foreach ($this->input->post('questionb[]') as $t) {
            $string = str_replace('●', '&bull;', $t);
            array_push($arrQuestionb, $string);
        }
        $arrQuestionHt = [];
        foreach ($this->input->post('questionHt[]') as $t) {
            $string = str_replace('●', '&bull;', $t);
            array_push($arrQuestionHt, $string);
        }
        $pesaing = str_replace('●', '&bull;', $this->input->post('pesaing'));
        $idPerusahaan =  $this->input->post('id_perusahaan');

        $data = [
            'id_perusahaan' => $idPerusahaan,
            'id_customer' => serialize($this->input->post('id_customer[]')),
            'id_dept' => $this->input->post('id_departemen'),
            // 'profil_perusahaan' => serialize($arrQuestionPp),
            'latar_belakang_research' => serialize($arrQuestionLbr),
            'methodology ' => serialize($arrQuestionm),
            'sampling_dan_responden' =>  serialize($arrQuestionSr),
            // 'distribusi_sampling' => serialize($arrQuestionDs),
            'timeline ' => serialize($arrQuestiont),
            'budget ' => serialize($arrQuestionb),
            'hal_teknis_lainnya' => serialize($arrQuestionHt),
            'peserta' => serialize($this->input->post('id_peserta[]')),
            'pesaing' => serialize($pesaing),
            'created_by' => $this->session->userdata('ses_id'),
            'created_at' => date('Y-m-d'),
            'updated_at' => date('Y-m-d')
        ];
        $result = $this->db->query("SELECT id_research_brief
                        FROM data_perusahaan
                        WHERE id_perusahaan = $idPerusahaan")->row_array();


        $this->db->set($data);
        $this->db->where('id_research_brief',  $result['id_research_brief']);
        $this->db->update('research_brief');
    }

    public function setCompanyProfile()
    {
        $arrQuestionPp = [];
        foreach ($this->input->post('questionPpModal[]') as $t) {
            $string = str_replace('●', '&bull;', $t);
            array_push($arrQuestionPp, $string);
        }

        $data = [
            'profil_perusahaan' => serialize($arrQuestionPp),
        ];

        $id = $this->input->post('idCompanyHidden');

        $this->db->set($data);
        $this->db->where('id_perusahaan', $id);
        $this->db->update('data_perusahaan');

        // $this->db->insert('research_brief', $data);

        // $getId = $this->db->query('SELECT * FROM research_brief ORDER BY id_research_brief DESC LIMIT 1')->row_array();
        // $query = $this->db->get_where('data_perusahaan', ['id_perusahaan' => $this->input->post('id_perusahaan')])->row_array();
        // if (!$query['id_research_brief']) {
        //     $this->db->set('id_research_brief', $getId['id_research_brief']);
        //     $this->db->where('id_perusahaan',  $this->input->post('id_perusahaan'));
        //     $this->db->update('data_perusahaan');
        // }
    }
}
