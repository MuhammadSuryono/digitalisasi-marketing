<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Sindikasi extends CI_Controller
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
        $this->load->model('TargetClient_model');
        $this->load->model('Sindikasi_model');
        $this->load->model('Request_model');
        $this->load->model('ProjectDocument_model');
        $this->load->model('ResearchBrief_model');
        $this->load->model('Customer_model');
        $this->load->library('form_validation');
        $this->load->helper('download');
        date_default_timezone_set('Asia/Jakarta');
    }

    public function index()
    {
        $data['sindikasi'] = $this->Sindikasi_model->getAllSindikasi();
        $iduser = $this->session->userdata('ses_id');
        $model = $this->User_model->getUserById($iduser);
        // $surat = $this->Surat_model->getSuratById($this->input->post('jenis_surat'), true);
        // $judul_email = $surat['jenis_surat'];

        $projectDeadline = $this->TargetClient_model->getTargetClientByDeadline();
        foreach ($projectDeadline as $pd) {
            $email = [];
            $idDeptManager = $this->db->query("SELECT id_jabatan FROM daftar_jabatan WHERE jabatan = 'Manager'")->row_array();
            $emailManager = $this->db->query("SELECT email1 FROM data_user WHERE jabatan = '$idDeptManager[id_jabatan]' AND dept = '$pd[dept]'")->row_array();
            if (isset($pd['email1']))
                array_push($email, $pd['email1']);
            if (isset($emailManager['email1']))
                array_push($email, $emailManager['email1']);

            $config = configEmail();
            $this->load->library('email', $config);
            $this->email->initialize($config);

            $judul_email = "Notifikasi Deadline Data Sindikasi";
            $isi_email = "Nama Project:<strong> $pd[nama_project]</strong><br>
            Nama Client:<strong> $pd[nama_perusahaan]</strong><br>
            Tanggal Deadline:<strong> $pd[tgl_deadline]</strong><br>";
            $this->email->from('mri.marketing@mri-research-ind.com', 'Marketing MRI');
            $this->email->subject($judul_email);
            $this->email->message($isi_email);

            for ($x = 0; $x < count($email); $x++) {
                $cloned = clone $this->email;
                $cloned->to($email[$x]);
                if ($cloned->send()) {
                    echo "sent";
                } else {
                    echo "gagal";
                }
                $cloned->clear();
            }
        }



        // $email = ['fmanadeprasetyoo@gmail.com', 'fmanadeprasetyo@gmail.com'];
        // $config = configEmail();
        // $this->load->library('email', $config);
        // $this->email->initialize($config);

        // $this->email->from('mri.marketing@mri-research-ind.com', 'Marketing MRI');
        // $this->email->subject($judul_email);
        // $this->email->message($isi_email);



        // for ($x = 0; $x < count($email); $x++) {
        //     $cloned = clone $this->email;
        //     $cloned->to($email[$x]);

        //     if ($cloned->send()) {
        //         echo "sent";
        //     } else {
        //         echo "gagal";
        //     }
        //     $cloned->clear();
        // }
        // $this->session->set_flashdata('flash', 'Email Terkirim');

        // var_dump($data['rfq']);
        $this->load->view('templates/header');
        $this->load->view('sindikasi/index', $data);
        $this->load->view('templates/footer');
    }

    public function tambah()
    {
        $this->form_validation->set_rules('nama_project', 'Nama Project', 'required|trim');
        $this->form_validation->set_rules('target_sales', 'Target Sales', 'required|trim');
        $this->form_validation->set_rules('id_methodology[]', 'Methdology', 'required');
        $this->form_validation->set_rules('id_pic', 'PIC', 'required');
        // $this->form_validation->set_rules('proposal', 'Proposal', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header');
            $this->load->view('sindikasi/tambah');
            $this->load->view('templates/footer');
        } else {
            $this->Sindikasi_model->tambah();
            $this->session->set_flashdata('flash', 'Ditambahkan');
            redirect('sindikasi');
        }
    }

    public function hapus($id)
    {
        $this->Sindikasi_model->hapusDataSindikasi($id);
        $this->session->set_flashdata('flash', 'Dihapus');
        redirect('sindikasi');
    }

    public function getContactPerson()
    {
        $id = $_GET['id'];

        $data = $this->db->get_where('data_customer', ['perusahaan' => $id])->result_array();

        echo json_encode($data);
    }

    public function status($id)
    {
        $data['sindikasi'] = $this->Sindikasi_model->getSindikasiById($id);
        $data['target_client'] = $this->TargetClient_model->getTargetClientByIdSindikasi($id);
        $data['total_harga_deal'] = 0;
        $data['total_harga_pending'] = 0;
        $data['status_deal'] = 0;
        $data['status_pending'] = 0;
        foreach ($data['target_client'] as $tc) {
            if ($tc['id_status'] == 1) {
                $data['status_deal']++;
                $data['total_harga_deal'] += $tc['total'];
            } else if ($tc['id_status'] != 2) {
                $data['status_pending']++;
                $data['total_harga_pending'] += $tc['total'];
            }
        }
        if ($data['sindikasi'] == null) {
            $this->session->set_flashdata('flash2', 'Sindikasi tidak ditemukan');
            redirect('sindikasi');
        }

        $updated = $this->input->post('updated');

        if ($updated == 'sindikasi') {
            $this->form_validation->set_rules('nama_project', 'Nama Project', 'required|trim');
            $this->form_validation->set_rules('target_sales', 'Target Sales', 'required|trim');
            $this->form_validation->set_rules('id_methodology[]', 'Methdology', 'required');
            $this->form_validation->set_rules('id_pic', 'PIC', 'required');
        } else if ($updated == 'target-client') {
            $this->form_validation->set_rules('id_client[]', 'Client', 'required');
            // $this->form_validation->set_rules('status-file', 'Status File', 'required');
        }

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header');
            $this->load->view('sindikasi/status', $data);
            $this->load->view('templates/footer');
        } else {
            $updated = $this->input->post('updated');
            if ($updated == 'sindikasi') {
                $this->Sindikasi_model->ubah($this->input->post('id'));
            } else if ($updated == 'target-client') {
                $this->TargetClient_model->tambah($this->input->post('id'));
            }
            $this->session->set_flashdata('flash', 'Berhasil Disimpan');
            // redirect('sindikasi');
            redirect('sindikasi/status/' . $id);
        }
    }

    public function hapusTargetClient()
    {
        $this->TargetClient_model->hapus($this->input->post('id_target_client'));
        $this->session->set_flashdata('flash', 'Dihapus');
        redirect('sindikasi/status/' . $this->input->post('id_sindikasi'));
        // redirect('sindikasi');
    }

    public function getTargetClient()
    {
        $data = $this->TargetClient_model->getTargetClientById($this->input->get('id'));
        $outputFile = [];
        if (@unserialize($data['proposal'])) {
            $arrProposal = unserialize($data['proposal']);
            for ($i = 0; $i < count($arrProposal); $i++) {
                if (strpos($arrProposal[$i], ' ') !== false) {
                    $firstString = explode(" ", $arrProposal[$i])[0];
                } else if (strpos($arrProposal[$i], '.') !== false)
                    $firstString = explode(".", $arrProposal[$i])[0]; {
                }
                $input = preg_quote($firstString, '~'); // don't forget to quote input string!

                // var_dump($firstString);
                $m_array = preg_grep('~' . $input . '~', $arrProposal);
                $fixFile = $m_array[min(array_keys($m_array))];
                if (!in_array($fixFile, $outputFile)) {
                    array_push($outputFile, $fixFile);
                }
            }
        }
        $result = [
            'tgl_deal' => $data['tgl_deal'],
            'id_client' => $data['id_client'],
            'id_contact_person' => unserialize($data['id_contact_person']),
            'id_status' => $data['id_status'],
            'harga_penawaran' => $data['harga_penawaran'],
            'diskon' => $data['diskon'],
            'total' => $data['total'],
            'id_status' => $data['id_status'],
            'tgl_update' => $data['tgl_update'],
            'proposal' => $outputFile,
            'catatan' => $data['catatan']
        ];
        echo json_encode($result);
        // die;
    }
    public function fu($id)
    {
        $this->form_validation->set_rules('date', 'Date', 'required|trim');
        $this->form_validation->set_rules('ket', 'Schedule', 'required|trim');

        if ($this->form_validation->run() == false) {
            $data['rfq'] = $this->TargetClient_model->getTargetClientByRfq($id);
            // die;
            $data['fu'] = $this->db->get_where('data_fu', array('nomor_rfq' => $id))->result_array();
            // var_dump($data);
            $this->load->view('templates/header');
            $this->load->view('sindikasi/fu', $data);
            $this->load->view('templates/footer');
        } else {
            $this->TargetClient_model->tambahFu();
            $this->session->set_flashdata('flash', 'Ditambahkan');
            $no = $this->input->post('nomor_rfq', true);
            redirect('sindikasi/fu/' . $no);
        }
    }

    public function hapusFu($id, $no)
    {
        $this->db->delete('data_fu', array('id_fu' => $id));
        $this->session->set_flashdata('flash', 'Dihapus');
        redirect('rfq/fu/' . $no);
    }

    public function customer()
    {
        $id = $_GET['id'];

        $data = $this->db->get_where('data_customer', ['perusahaan' => $id])->result_array();

        echo json_encode($data);
    }

    public function tambahDept()
    {
        $this->load->model('Dept_model');
        $this->Dept_model->tambahDataDept();
        $this->session->set_flashdata('flash', 'Ditambahkan');
        redirect('customer/tambah');
    }

    public function tambahJabatan()
    {
        $this->load->model('Jabatan_model');
        $this->Jabatan_model->tambahDataJabatan();
        $this->session->set_flashdata('flash', 'Ditambahkan');
        redirect('customer/tambah');
    }

    public function kirimEmail()
    {
        ini_set('max_execution_time', '0');
        $iduser = $this->session->userdata('ses_id');
        $model = $this->User_model->getUserById($iduser);
        $surat = $this->Surat_model->getSuratById($this->input->post('jenis_surat'), true);
        $judul_email = $surat['jenis_surat'];
        $isi_email = str_replace('[Nomor Urut RFQ]', $this->input->post('id'), $surat['isi_surat']);
        $isi_email = str_replace('[Nama Project]', $this->input->post('nama_project', true), $isi_email);
        $isi_email = str_replace('[Nama Customer]', $this->input->post('nama_customer', true), $isi_email);
        $model['isi'] = nl2br($isi_email);
        $isi_email = $this->load->view('email/tem_email', $model, true);

        $email = explode(',', trim($this->input->post('email', true)));

        $config = configEmail();
        $this->load->library('email', $config);
        $namaPengirim = $model['nama_user']; //'Marketing MRI';
        $emailPengirim = $model['email1']; //'mri.marketing@mri-research-ind.com';
        $this->email->from($emailPengirim, $namaPengirim);
        $this->email->subject($judul_email);
        $this->email->message($isi_email);


        //$this->email->reply_to('mri.marketing@mri-research-ind.com', $model['nama_user']);

        /*foreach ($email as $value) {
			$this->email->clear(true);
            //$this->email->from('apriweljenian76@gmail', $model['nama_user']);
            $this->email->from('mri.marketing@mri-research-ind.com', $model['nama_user']);
            $this->email->to($value);
            $this->email->subject($judul_email);
            $this->email->message($isi_email);

            if($this->email->send()){
                $data = 'terkirim';
            }else{
                $data = 'gagal';
            }

        }*/

        for ($x = 0; $x < count($email); $x++) {
            $cloned = clone $this->email;

            $cloned->to($email[$x]);

            if ($cloned->send()) {
                $data = 'terkirim';
            } else {
                $data = 'gagal';
            }
            $cloned->clear(true);
        }

        echo json_encode($data);
    }

    public function ubah($id)
    {
        $data['customer'] = $this->Rfq_model->getRfqById($id);

        $this->form_validation->set_rules('nama', 'Nama', 'required|trim');
        $this->form_validation->set_rules('status', 'Status', 'required|trim');
        $this->form_validation->set_rules('perusahaan', 'Perusahaan', 'required|trim');
        $this->form_validation->set_rules('dept', 'Dept', 'required|trim');
        $this->form_validation->set_rules('jabatan', 'Jabatan', 'required|trim');
        $this->form_validation->set_rules('hp1', 'Phone Number', 'required|trim');
        $this->form_validation->set_rules('email1', 'Email', 'required|trim|valid_email');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header');
            $this->load->view('customer/ubah', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Rfq_model->ubahDataRfq();
            $this->session->set_flashdata('flash', 'Diubah');
            redirect('customer');
        }
    }

    public function test()
    {
        $norfqnya = 'REQ202011050000107';
        $data = $this->db->query("SELECT nomor_rfq FROM data_rfq WHERE nomor_rfq = '$norfqnya'")->row_array();
        if ($data['nomor_rfq'] != null) { // JIKA NOMOR RFQ DARI INPUT OTOMATIS SUDAH ADA MAKA GENERATE NOMOR BARU
            echo "nomor rfq baru<bR><br>";
            $this->db->select('max(nomor_rfq) as maxKode, max(kode_project) as maxKP');
            $this->db->from('data_rfq');
            $data = $this->db->get()->row_array();
            $no_rfq = $data['maxKode'];
            $no_urut = (int)substr($no_rfq, 11);
            $no_urut++;
            $char = 'REQ';
            $date = date("Ymd");
            echo $noRfq['id'] = $char . $date . sprintf('%07s', $no_urut) . '<BR>';
            // OTOMATIS IKUT GENERATE NOMOR URUT BARU UNTUK KODE PROJECT
            $data = $this->db->query("SELECT max(kode_project) as maxKP FROM data_rfq WHERE nomor_rfq = '$norfqnya'")->row_array();
            $noKP = $data['maxKP'];
            if (date('Y-m-d') == date('Y-') . '01-01') { // JIKA SUDAH TAHUN BARU
                $noUrutKP = 1;
            } else {
                $noUrutKP = (int)substr($noKP, -3);
                $noUrutKP++;
            }
            $char = 'REQ';
            $date = date("Ymd");
            $noRfq['blnThnKP'] = date('m.Y');
            $noRfq['noUrutKP'] = sprintf('%03s', $noUrutKP);
            echo $noRfq['blnThnKP'] . '/' . $noRfq['noUrutKP'];
        } else {
            echo "tidak ada";
            $norfqnya; // KALAU GAK ADA SET DARI INPUT
        }
    }



    // Penambahan Tedi //
    public function carimethod()
    {
        $data = $this->db->query("SELECT * FROM data_methodology ORDER BY methodology ASC")->result_array();
        echo json_encode($data);
    }
    // edit Adam Santoso
    public function caridokumen()
    {
        $data = $this->db->query("SELECT * FROM data_dokumen ORDER BY keterangan ASC")->result_array();
        echo json_encode($data);
    }
    public function caritopic()
    {
        $data = $this->db->query("SELECT * FROM data_topic ORDER BY keterangan ASC")->result_array();
        echo json_encode($data);
    }
    public function download($file)
    {
        force_download('file/rfq/' . $file, NULL);
    }
}
