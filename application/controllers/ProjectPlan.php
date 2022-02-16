<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ProjectPlan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if ($this->session->userdata('masuk') != true) {
            $url = base_url();
            redirect($url);
        }

        role_access();

        $this->load->model('TemplateProjectPlan_model');
        $this->load->model('ProjectPlan_model');
        $this->load->library('form_validation');
        date_default_timezone_set('Asia/Jakarta');
    }

    public function index()
    {
        $data['project'] = $this->ProjectPlan_model->getAllProjectPlan();
        $this->load->view('templates/header');
        $this->load->view('projectplan/index', $data);
        $this->load->view('templates/footer');
    }

    public function view($id)
    {
        $data['id_pp'] = $id;
        $data['rfq'] = $this->ProjectPlan_model->getProjectPlanById($id);
        $data['detail'] = $this->ProjectPlan_model->getDetailProjectPlanById($id);
        // GET PROJECT PLAN 1. FROM TEMPLATE 2. FROM MASTER PP
        $data['template'] = $this->TemplateProjectPlan_model->getAllTemplatepp();
        $data['master'] = $this->TemplateProjectPlan_model->ambilDataMasterPP();
        $this->load->view('templates/header');
        $this->load->view('projectplan/view', $data);
        $this->load->view('templates/footer');
    }

    public function tambah($idpp)
    {
        $this->ProjectPlan_model->tambahDataProjectPlan($idpp);
        $this->session->set_flashdata('flash', 'Ditambahkan');
        redirect('projectPlan/view/' . $idpp);
    }
    public function ubah($idpp, $id)
    {
        $data = $this->ProjectPlan_model->ubahDataProjectPlan($idpp, $id);
        $this->session->set_flashdata('flash', 'Diubah');
        redirect('projectPlan/view/' . $idpp);
    }
    public function hapus($id, $idpp)
    {
        $this->ProjectPlan_model->hapusDataProjectPlan($idpp, $id);
        $this->session->set_flashdata('flash', 'Dihapus');
        redirect('projectPlan/view/' . $idpp);
    }

    public function ubahField($idpp, $id)
    {
        $data = $this->ProjectPlan_model->ubahDataField($id);
        $this->session->set_flashdata('flash', 'Diubah');
        redirect('projectPlan/view/' . $idpp . '#field' . $id);
    }



    public function temMail()
    {

        $config = qrcode();
        $this->ciqrcode->initialize($config);


        $image_name = 'tes.png'; //buat name dari qr code sesuai dengan nim
        $params['data'] = 'http://180.211.92.132:60/digital-market/projectplan/temmail'; //data yang akan di jadikan QR CODE
        $params['level'] = 'H'; //H=High
        $params['size'] = 10;
        $params['savename'] = FCPATH . $config['imagedir'] . $image_name; //simpan image QR CODE ke folder assets/images/
        $this->ciqrcode->generate($params); // fungsi untuk generate QR CODE

        $this->load->view('projectplan/tem_email');
    }

    public function sendUndangan()
    {
        $model = $this->db->get_where('team_ps', array('no_rfq' => $this->input->post('id', true)))->result_array();
        $project = $this->Rfq_model->getRfqById($this->input->post('id', true));
        $iduser = $this->session->userdata('ses_id');
        $us = $this->User_model->getUserById($iduser);
        $config = qrcode();
        $configMail = configEmail();
        $this->ciqrcode->initialize($config);

        foreach ($model as $db) {
            //qrcode generate
            $user = $this->User_model->getUserById($db['id_user']);
            $d = date('s');
            $image_name         = $this->input->post('id', true) . $user['id_user'] . $d . '.png'; //buat name dari qr code sesuai dengan nim
            $params['data']     = $user['id_user'] . '|' . $this->input->post('id', true); //data yang akan di jadikan QR CODE
            $params['level']    = 'H'; //H=High
            $params['size']     = 10;
            $params['savename'] = FCPATH . $config['imagedir'] . $image_name; //simpan image QR CODE ke folder assets/images/
            $this->ciqrcode->generate($params); // fungsi untuk generate QR CODE

            //send email
            $input['user']    = $user['nama_user'];
            $input['ket']     = $this->input->post('ket', true);
            $input['tanggal'] = $this->input->post('tgl', true);
            $input['jam']     = $this->input->post('jam', true);
            $input['tempat']  = $this->input->post('tempat', true);
            $input['project'] = $project['nama_project'];
            $input['image']   = $image_name;
            $isi_email =  $this->load->view('projectplan/tem_email', $input, true);

            $this->load->library('email', $configMail);
            $this->email->from('mri@mri-research-ind.com', $us['nama_user']);
            $this->email->to($user['email1']);
            $this->email->subject('Undangan' . $input['ket']);
            $this->email->message($isi_email);

            if ($this->email->send()) {
                $data = 'terkirim';
            } else {
                $data = 'gagal';
            }
        }

        echo json_encode($data);
    }

    public function showdata()
    {
        $id   = $_GET['id'];
        $plan = $this->ProjectPlan_model->getProjectPlanById($id);
        $spec = $this->db->get_where('project_spec', array('no_rfq' => $plan['nomor_rfq']))->row_array();

        $data['show'] = $this->ProjectPlan_model->getDetail($id);
        $data['spec'] = array('mulai' => $spec['tgl_mulai'], 'selesai' => $spec['tgl_selesai']);

        echo json_encode($data);
    }

    public function showField()
    {
        $id   = $_GET['id'];
        $plan = $this->ProjectPlan_model->getProjectPlanById($id);

        $this->db->select('sum(jumlah) as responden');
        $this->db->from('responden');
        $this->db->where('no_rfq = "' . $plan['nomor_rfq'] . '"');
        $hasil = $this->db->get()->row_array();

        $data['show'] = $this->ProjectPlan_model->getDetailField($id);
        $data['show_'] = $this->ProjectPlan_model->getDetailBrief($id);
        $data['respon'] = $hasil['responden'];

        echo json_encode($data);
    }



    public function template()
    {
        $model = $this->db->get_where('template_pp', array('id_template_project' => $_GET['id']))->row_array();
        $data = $model['project_plan'];

        echo json_encode($data);
    }
}
