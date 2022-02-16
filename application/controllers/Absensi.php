<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Absensi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if ($this->session->userdata('masuk') != true) {
            $url = base_url();
            redirect($url);
        }

        role_access();

        $this->load->model('Absensi_model');
        $this->load->model('ProjectPlan_model');
        $this->load->library('form_validation');
        date_default_timezone_set('Asia/Jakarta');
    }

    public function index()
    {
        $data['absensi'] = $this->Absensi_model->getAllAbsensi();
        $data['project'] = $this->ProjectPlan_model->getAllProjectPlan();
        $this->load->view('templates/header');
        $this->load->view('absensi/index', $data);
        $this->load->view('templates/footer');
    }

    public function view($id)
    {
        $data['absen'] = $this->Absensi_model->getAbsensiById($id);
        $data['kegiatan'] = array(1=>'Meeting', 2=>'Briefing');

        $this->load->view('templates/header');
        $this->load->view('absensi/view', $data);
        $this->load->view('templates/footer');   
    }

    public function showdata()
    {
        $id = $_GET['id'];
        $this->db->join('data_user', 'data_user.id_user = detail_absen.id_user');
        $data = $this->db->get_where('detail_absen', array('detail_absen.id_absensi'=>$id))->result_array();

        echo json_encode($data);
    }


    public function ambilData()
    {   

        $db = explode('|', trim($_GET['id']));
        $absen = $this->Absensi_model->getAbsensiById($_GET['rfq']);

        if(isset($db[1])){
            if($db[1] == $absen['nomor_rfq']){
                $this->db->select("*");
                $this->db->from('team_ps');
                $this->db->where('no_rfq ="'.$absen['nomor_rfq'].'" and id_user ='.$db[0]);
                $team = $this->db->get()->row_array();

                if(isset($team)){
                    $model = $this->User_model->getUserById($db[0]);
                    $data = $model['nama_user'];

                    $det = $this->Absensi_model->getDetailAbsenId($absen['id_absensi'], $model['id_user']);

                    if(!isset($det)){
                        $this->Absensi_model->tambahDetail($absen['id_absensi'], $model['id_user']);
                    }

                }else{
                    $data = 'gagal';
                } 
            }else{
                $data ="gagal";
            }
        }else{
            $data = 'gagal';
        }

        echo json_encode($data);
    }

    public function tambah()
    {
        $this->Absensi_model->tambahDataAbsensi();
        $this->session->set_flashdata('flash', 'Ditambahkan');
        redirect('absensi');
    }

    public function hapus($id)
    {
        $this->Batal_model->hapusDataBatal($id);
		$this->session->set_flashdata('flash', 'Dihapus');
        redirect('batal');
    }

    public function ubah()
    {
        $this->Batal_model->ubahDataBatal();
        $this->session->set_flashdata('flash', 'Diubah');
        redirect('batal');
    }
}
