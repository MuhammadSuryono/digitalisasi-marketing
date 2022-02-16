<?php

defined('BASEPATH') or exit('No direct script access allowed');

use Dompdf\Dompdf;

class ResearchBrief extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if ($this->session->userdata('masuk') != true) {
            $url = base_url();
            redirect($url);
        }

        role_access();

        $this->load->model('Rfq_model');
        $this->load->model('Request_model');
        $this->load->model('ProjectDocument_model');
        $this->load->model('Perusahaan_model');
        $this->load->model('Customer_model');
        $this->load->model('ResearchBrief_model');
        $this->load->library('form_validation');
        date_default_timezone_set('Asia/Jakarta');
    }

    public function index()
    {
        $data['perusahaan'] = $this->Perusahaan_model->getAllPerusahaan();
        $data['data_user'] = $this->User_model->getAllUser();
        $data['data_dept'] = $this->Dept_model->getAllDept();
        // var_dump($this->input->post());
        // die();

        $this->form_validation->set_rules('id_perusahaan', 'Perusahaan', 'required');
        $this->form_validation->set_rules('id_customer[]', 'Customer', 'required');
        // $this->form_validation->set_rules('questionPp[]', 'Company Profile Question', 'required');
        $this->form_validation->set_rules('questionLbr[]', 'Background Research Question', 'required');
        $this->form_validation->set_rules('questionm[]', 'Methodology Question', 'required');
        $this->form_validation->set_rules('questionSr[]', 'Sampling and Respondent Question', 'required');
        // $this->form_validation->set_rules('questionDs[]', 'Sampling Distribution Question', 'required');
        $this->form_validation->set_rules('questiont[]', 'Timeline Question', 'required');
        $this->form_validation->set_rules('questionb[]', 'Budget Question', 'required');
        $this->form_validation->set_rules('questionHt[]', 'Other Technical Question', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header');
            $this->load->view('researchbrief/index', $data);
            $this->load->view('templates/footer');
        } else {

            // var_dump($this->input->post());
            $query = $this->db->get_where('data_perusahaan', ['id_perusahaan' => $this->input->post('id_perusahaan')])->row_array();
            $queryRb = $this->ResearchBrief_model->getResearchBriefByIdAndDept($query['id_research_brief'], $this->input->post('id_departemen'));
            // var_dump($queryRb);
            // die();
            if ($queryRb) {
                $this->ResearchBrief_model->updateResearchBrief();
                $this->session->set_flashdata('flash', 'Diubah');
                redirect('researchBrief');
            } else {
                $this->ResearchBrief_model->setResearchBrief();
                $this->session->set_flashdata('flash', 'Dibuat');
                redirect('researchBrief');
            }
        }
    }

    public function addCompanyProfile()
    {
        $this->ResearchBrief_model->setCompanyProfile();

        $this->session->set_flashdata('flash', 'Diubah');
        redirect('researchBrief');
    }

    public function printPdf($id)
    {
        $dompdf = new Dompdf();

        $data['research_brief'] = $this->ResearchBrief_model->getResearchBriefById($id);
        $data['company_profile'] = $this->Perusahaan_model->getPerusahaanByResearchBriefId($id);
        $data['rfq'] = $this->input->get('rfq');

        $html = $this->load->view('researchbrief/print', $data, true);
        $dompdf->load_html($html, $data, true);

        $dompdf->set_paper('A4', 'landscape');

        $dompdf->render();

        if ($this->input->get('status') == "view") $dompdf->stream('Research Brief.pdf', array("Attachment" => false));
        else $dompdf->stream('Research Brief.pdf', array("Attachment" => true));
    }

    public function checkCompanyProfile()
    {
        $id = $_GET['id'];
        $company = $this->Perusahaan_model->getPerusahaanById($id);
        if ($company['profil_perusahaan']) {
            $defaultQuestionPp  = 4;
            $arrProfilePerusahaan = unserialize($company['profil_perusahaan']);
            $arrAnswerProfilePerusahaan = $this->detailProcessData($defaultQuestionPp, $arrProfilePerusahaan);
            $data = [
                'profil_perusahaan_answer' => $arrAnswerProfilePerusahaan,
            ];
        } else {
            $data = [
                'profil_perusahaan_answer' => '',
            ];
        }
        echo json_encode($data);
    }

    public function checkDataCompany()
    {
        $id = $_GET['id'];
        $idDept = $_GET['idDept'];

        $company = $this->Perusahaan_model->getPerusahaanById($id);

        if ($company['id_research_brief']) {
            $researchBrief = $this->ResearchBrief_model->getResearchBriefByIdAndDept($company['id_research_brief'], $idDept);
            $data = $this->processData($researchBrief, $company['profil_perusahaan'], $company['id_research_brief']);
        } else {
            $customer = $this->db->get_where('data_customer', ['perusahaan' => $id, 'dept' => $idDept])->result_array();
            $data = [
                'profil_perusahaan_answer' => '',
                'latar_belakang_research_answer' => '',
                'methodology_answer' => '',
                'sampling_dan_responden_answer' => '',
                'timeline_answer' => '',
                'budget_answer' => '',
                'hal_teknis_lainnya_answer' => '',
                'pesaing' => '',
                'peserta' => '',
                'customer' => $customer
            ];
        }
        echo json_encode($data);
    }

    public function processData($research_brief, $profil_perusahaan, $idResearchBrief)
    {


        $defaultQuestionPp  = 4;
        $arrProfilePerusahaan = unserialize($profil_perusahaan);
        $arrAnswerProfilePerusahaan = $this->detailProcessData($defaultQuestionPp, $arrProfilePerusahaan);

        $defaultQuestionLbr  = 3;
        $arrLatarBelakangResearch = isset($research_brief['latar_belakang_research']) ? unserialize($research_brief['latar_belakang_research']) : 0;
        $arrAnswerLatarBelakangResearch = $this->detailProcessData($defaultQuestionLbr, $arrLatarBelakangResearch);

        $defaultQuestionm = 3;
        $arrMethodology = isset($research_brief['methodology']) ? unserialize($research_brief['methodology']) : 0;
        $arrAnswerMethodology = $this->detailProcessData($defaultQuestionm, $arrMethodology);

        $defaultQuestionSr  = 4;
        $arrSamplingResponden = isset($research_brief['sampling_dan_responden']) ? unserialize($research_brief['sampling_dan_responden']) : 0;
        $arrAnswerSamplingResponden = $this->detailProcessData($defaultQuestionSr, $arrSamplingResponden);

        $defaultQuestiont  = 1;
        $arrTimeline = isset($research_brief['timeline']) ? unserialize($research_brief['timeline']) : 0;
        $arrAnswerTimeline = $this->detailProcessData($defaultQuestiont, $arrTimeline);

        $defaultQuestionb  = 1;
        $arrBudget = isset($research_brief['budget']) ? unserialize($research_brief['budget']) : 0;
        $arrAnswerBudget = $this->detailProcessData($defaultQuestionb, $arrBudget);

        $defaultQuestionHt  = 4;
        $arrHalTeknis = isset($research_brief['hal_teknis_lainnya']) ? unserialize($research_brief['hal_teknis_lainnya']) : 0;
        $arrAnswerHalTeknis = $this->detailProcessData($defaultQuestionHt, $arrHalTeknis);


        $arrPeserta = isset($research_brief['peserta']) ? unserialize($research_brief['peserta']) : [];
        $arrString = array_diff($arrPeserta, ['']);
        $dataPeserta = [];
        foreach ($arrString as $as) {
            array_push($dataPeserta, $as);
        }

        $pesaing = isset($research_brief['pesaing']) ? unserialize($research_brief['pesaing']) : 0;
        $dataPesaing = [];
        if (strpos($pesaing, '&bull;') !== false) {
            $arrString = explode('&bull;', $pesaing);
            $arrString = array_diff($arrString, ['']);
            $arrStringNew = [];
            foreach ($arrString as $as) {
                array_push($arrStringNew, $as);
            }

            if (count($arrStringNew) == 1) {
                array_push($dataPesaing, $arrStringNew[0]);
            } else {
                $string = '';
                for ($j = 0; $j < count($arrStringNew); $j++) {
                    $string .= "●" . $arrStringNew[$j];
                }
                array_push($dataPesaing, $string);
            }
        } else {
            array_push($dataPesaing, $pesaing);
        }

        $customer = isset($research_brief['id_customer']) ? unserialize($research_brief['id_customer']) : [];
        $dataCustomer = [];
        if (is_array($customer) || is_object($customer)) {
            foreach ($customer as $c) {
                $result = $this->Customer_model->getCustomerById($c);
                array_push($dataCustomer, $result);
            }
        }

        $data = [
            'profil_perusahaan_answer' => $arrAnswerProfilePerusahaan,
            'latar_belakang_research_answer' => $arrAnswerLatarBelakangResearch,
            'methodology_answer' => $arrAnswerMethodology,
            'sampling_dan_responden_answer' => $arrAnswerSamplingResponden,
            // 'distribusi_sampling_answer' => $arrAnswerDistribusiSampling,
            'timeline_answer' => $arrAnswerTimeline,
            'budget_answer' => $arrAnswerBudget,
            'hal_teknis_lainnya_answer' => $arrAnswerHalTeknis,
            'pesaing' => $dataPesaing,
            'peserta' => $dataPeserta,
            'customer' => $dataCustomer,
            'id_research_brief' => $idResearchBrief
        ];

        return $data;
    }

    public function detailProcessData($defaultQuestion = 0, $arrQuestion = [])
    {
        $arrResult = [];
        for ($i = 0; $i < count((is_countable($arrQuestion) ? $arrQuestion : [])); $i++) {
            if ($i < $defaultQuestion * 2 - 1) {
                if ($i % 2 != 0) {
                    if (strpos($arrQuestion[$i], '&bull;') !== false) {
                        $arrString = explode('&bull;', $arrQuestion[$i]);
                        $arrString = array_diff($arrString, ['']);
                        $arrStringNew = [];
                        foreach ($arrString as $as) {
                            array_push($arrStringNew, $as);
                        }

                        if (count($arrStringNew) == 1) {
                            array_push($arrResult, $arrStringNew[0]);
                        } else {
                            $string = '';

                            for ($j = 0; $j < count($arrStringNew); $j++) {
                                $string .= "●" . $arrStringNew[$j];
                            }
                            array_push($arrResult, $string);
                        }
                    } else {
                        array_push($arrResult, $arrQuestion[$i]);
                    }
                }
            } else {
                if (strpos($arrQuestion[$i], '&bull;') !== false) {
                    $arrString = explode('&bull;', $arrQuestion[$i]);
                    $arrString = array_diff($arrString, ['']);
                    $arrStringNew = [];
                    foreach ($arrString as $as) {
                        array_push($arrStringNew, $as);
                    }

                    if (count($arrStringNew) == 1) {
                        array_push($arrResult, $arrStringNew[0]);
                    } else {
                        $string = '';

                        for ($j = 0; $j < count($arrStringNew); $j++) {
                            $string .= "●" . $arrStringNew[$j];
                        }
                        array_push($arrResult, $string);
                    }
                } else {
                    array_push($arrResult, $arrQuestion[$i]);
                }
            }
        }
        return $arrResult;
    }
}
