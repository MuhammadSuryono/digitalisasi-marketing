<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CommisionVoucher extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if ($this->session->userdata('masuk') != true) {
            $url = base_url();
            redirect($url);
        }

        role_access();

        $this->load->model('ProjectDocument_model');
        $this->load->model('TargetClient_model');
        $this->load->model('Methodology_model');
        $this->load->model('CommisionVoucher_model');
        $this->load->model('Rfq_model');
        $this->load->model('Customer_model');
        $this->load->model('MataUang_model');
        $this->load->library('form_validation');
        $this->load->helper('download');
        date_default_timezone_set('Asia/Jakarta');
    }
    public function index()
    {
        $deptB1 = $this->db->query("SELECT * FROM daftar_dept WHERE dept='RE/RA B1'")->row_array();
        $idDeptB1 = $deptB1['id_dept'];
        $deptB2 = $this->db->query("SELECT * FROM daftar_dept WHERE dept='RE/RA B2'")->row_array();
        $idDeptB2 = isset($deptB2['id_dept']) ? $deptB2['id_dept'] : 0;
        $deptMarketing = $this->db->query("SELECT * FROM daftar_dept WHERE dept='Marketing'")->row_array();
        $idDeptMarketing = $deptMarketing['id_dept'];
        $jabatan = $this->db->query("SELECT * FROM daftar_jabatan WHERE jabatan='Manager'")->row_array();
        $idJabatan = $jabatan['id_jabatan'];

        $getRfq = $this->input->get('rfq');

        if ($getRfq) {
            $data['rfq'] = $getRfq;
            if ($_SESSION['ses_level'] != $idDeptMarketing) {
                if (strlen($getRfq) == 18) {
                    $queryData = $this->db->query("SELECT user_add, id_methodology FROM data_rfq WHERE nomor_rfq = '$getRfq'")->row_array();
                    $idMethodology = unserialize($queryData['id_methodology']);
                    if (in_array(11, $idMethodology)) {
                        if ($queryData['user_add'] != $_SESSION['ses_id']) {
                            die;
                            if (($_SESSION['ses_level'] == $idDeptB1 && $_SESSION['ses_jabatan'] != $idJabatan) || $_SESSION['ses_level'] == $idDeptB2) {
                                $this->session->set_flashdata('flash2', 'Anda tidak memiliki akses untuk membuat Commision Voucher');
                                redirect('dasboard');
                            }
                        }
                    } else {
                        if (($_SESSION['ses_level'] == $idDeptB2 && $_SESSION['ses_jabatan'] != $idJabatan) || $_SESSION['ses_level'] == $idDeptB1) {
                            $this->session->set_flashdata('flash2', 'Anda tidak memiliki akses untuk membuat Commision Voucher');
                            redirect('dasboard');
                        }
                    }
                } else {
                    $queryData = $this->db->query("SELECT data_target_client.user_add, data_sindikasi.id_methodology FROM data_target_client 
                JOIN data_sindikasi on data_sindikasi.id = data_target_client.id_sindikasi
                WHERE nomor_rfq = '$getRfq'")->row_array();

                    $idMethodology = unserialize($queryData['id_methodology']);
                    if (in_array(11, $idMethodology)) {
                        if ($queryData['user_add'] != $_SESSION['ses_id']) {
                            if (($_SESSION['ses_level'] == $idDeptB1 && $_SESSION['ses_jabatan'] != $idJabatan) || $_SESSION['ses_level'] == $idDeptB2) {
                                $this->session->set_flashdata('flash2', 'Anda tidak memiliki akses untuk membuat Commision Voucher');
                                redirect('dasboard');
                            }
                        } else {
                            if (($_SESSION['ses_level'] == $idDeptB2 && $_SESSION['ses_jabatan'] != $idJabatan) || $_SESSION['ses_level'] == $idDeptB1) {
                                $this->session->set_flashdata('flash2', 'Anda tidak memiliki akses untuk membuat Commision Voucher');
                                redirect('dasboard');
                            }
                        }
                    }
                }
            }
        } else {
            if ($_SESSION['ses_level'] == $idDeptB1 && $_SESSION['ses_jabatan'] != $idJabatan) {
                $this->session->set_flashdata('flash2', 'Anda tidak memiliki akses untuk membuat Commision Voucher');
                redirect('dasboard');
            }
        }


        $data['doc_rfq'] = $this->Rfq_model->getRfqByStatus('1');
        $data['doc_sindikasi'] = $this->TargetClient_model->getTargetClientByStatus('1');
        $data['doc'] = array_merge($data['doc_rfq'], $data['doc_sindikasi']);
        $data['methodology'] = $this->db->select('methodology')->select('keterangan')->get('data_methodology')->result_array();
        $data['mata_uang'] = $this->MataUang_model->getAllMataUang();

        $this->form_validation->set_rules('projectNumber', 'Project Number', 'required');
        $this->form_validation->set_rules('projectName', 'Project Name', 'required');
        $this->form_validation->set_rules('internalProjectName', 'Internal Project Name', 'required');
        $this->form_validation->set_rules('client', 'Client', 'required');
        // $this->form_validation->set_rules('phoneNumber', 'Phone Number', 'required');
        $this->form_validation->set_rules('projectNumber', 'Project Number', 'required');
        $this->form_validation->set_rules('projectType[]', 'Project Type', 'required');
        $this->form_validation->set_rules('address', 'Address', 'required');
        $this->form_validation->set_rules('ppn', 'PPN', 'required');
        $this->form_validation->set_rules('hargaPokokProduksi', 'Harga Pokok Produksi', 'required');
        $this->form_validation->set_rules('managementFee', 'Management Fee', 'required');
        $this->form_validation->set_rules('contactPersonName[]', 'Contact Person Name', 'required');
        $this->form_validation->set_rules('contactPersonNumber[]', 'Contact Person Number', 'required');
        $this->form_validation->set_rules('contractValue', 'Contract Value', 'required');
        $this->form_validation->set_rules('termsPayment[]', 'Terms of Payment', 'required');
        $this->form_validation->set_rules('loa[]', 'LOA', 'required');
        $this->form_validation->set_rules('paymentDate[]', 'Date', 'required');
        // $this->form_validation->set_rules('invoiceDate[]', 'Date', 'required');
        $this->form_validation->set_rules('researchExecutive', 'Research Executive', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header');
            $this->load->view('commisionvoucher/index', $data);
            $this->load->view('templates/footer');
        } else {
            $termsPayment = $this->input->post('termsPayment[]');
            $totalTermsPayment = 0;
            for ($i = 0; $i < count($termsPayment); $i++) {
                $totalTermsPayment += $termsPayment[$i];
            }
            if ($totalTermsPayment != 100) {
                $this->session->set_flashdata('flash2', 'Terms Payment harus 100%');
                redirect('commisionVoucher');
            }

            $queryCheck = $this->db->get_where('comm_voucher', ['nomor_project' => $this->input->post('projectNumber')])->row_array();
            if ($queryCheck) {
                $this->CommisionVoucher_model->editCommVoucher();
                $this->session->set_flashdata('flash', 'Berhasil Diubah');
                redirect('commisionVoucher');
            } else {
                $this->session->set_flashdata('flash', 'Berhasil Ditambahkan');
                $this->CommisionVoucher_model->setCommVoucher();
                redirect('commisionVoucher');
            }
        }
    }

    public function checkData()
    {
        $rfq = $this->input->post('rfq');
        $commisionVoucher = $this->db->get_where('comm_voucher', ['nomor_project' => $rfq])->row_array();
        if (!$rfq) {
            $data = [
                'projectName' => '',
                'internalProjectName' => '',
                'projectNumber' => '',
                'client' => '',
                'address' => '',
                'phone' => '',
                'email' => '',
                'projectType' => '',
                'contactPersonName' => '',
                'jabatan' => '',
                'contactPersonNumber' => '',
                'ppn' => '',
                'hargaPokokProduksi' => '',
                'managementFee' => '',
                'contractValue' => '',
                'mataUang' => '',
                'termsPayment' => '',
                'loa' => '',
                'paymentDate' => '',
                'invoiceDate' => '',
                'confirmLetter' => '',
                'researchExecutive' => '',
                'dataRfq' => ''
            ];
            echo json_encode($data);
        } else if (strlen($rfq) == 18) {
            $user = $this->Rfq_model->getRfqById($rfq);
        } else {
            $user = $this->TargetClient_model->getTargetClientByRfq($rfq);
        }

        // echo json_encode(count($rfq[]));

        $projectName = '';
        $internalProjectName = '';
        $projectNumber = '';
        $client = '';
        $address = '';
        $phone = '';
        $email = '';
        $projectType = '';
        $contactPersonName = '';
        $contactPersonJabatan = [];
        $contactPersonNumber = [];
        $ppn = '';
        $hargaPokokProduksi = '';
        $managementFee = '';
        $contractValue = '';
        $mataUang = '';
        $termsPayment = [];
        $loa = [];
        $paymentDate = [];
        $invoiceDate = [];
        $confirmLetter = '';
        $researchExecutive = '';

        if ($commisionVoucher) {
            $projectName = $commisionVoucher['nama_project'];
            $internalProjectName = $commisionVoucher['nama_project_internal'];
            $projectNumber = $commisionVoucher['nomor_project'];
            $client = $commisionVoucher['client'];
            $address = $commisionVoucher['alamat'];
            $phone = $commisionVoucher['telp'];
            $email = ($commisionVoucher['email']) ? $commisionVoucher['email'] : '';
            $arrProjectType = unserialize($commisionVoucher['tipe_project']);
            $projectType = [];
            foreach ($arrProjectType as $apt) {
                $string = explode('-', $apt);
                $name = '';
                for ($i = 0; $i < count($string); $i++) {
                    $name .= trim($string[$i]);
                    if ($i < count($string) - 1 && $i == 0) $name .= ' - ';
                    else if ($i < count($string) - 1) $name .= '-';
                }
                array_push($projectType, $name);
            }
            $contactPersonName = unserialize($commisionVoucher['nama_contact_person']);
            $contactPersonNumber = unserialize($commisionVoucher['nomor_contact_person']);
            $contactPersonJabatan = unserialize($commisionVoucher['jabatan_contact_person']);
            $ppn = $commisionVoucher['ppn'];
            $hargaPokokProduksi = $commisionVoucher['harga_pokok_produksi'];
            $managementFee = $commisionVoucher['management_fee'];
            $contractValue = $commisionVoucher['contract_value'];
            $mataUang = $commisionVoucher['id_mata_uang'];
            $termsPayment = unserialize($commisionVoucher['terms_of_payment']);
            $loa = unserialize($commisionVoucher['based_on_loa']);
            $paymentDate = unserialize($commisionVoucher['payment_date']);
            $invoiceDate = unserialize($commisionVoucher['invoice_date']);
            $confirmLetter = ($commisionVoucher['letter_to_followed_by']);
            $researchExecutive = $commisionVoucher['research_executive'];
        } else {
            $projectName = ($user['nama_project']) ? $user['nama_project'] : '';
            $projectNumber = $rfq;
            $client = ($user['nama']) ? $user['nama'] : '';
            $address = ($user['alamat']) ? $user['alamat'] : '';
            $phone = ($user['telp']) ? $user['telp'] : '';
            $email = ($user['email']) ? $user['email'] : '';
            if (@unserialize($user['id_methodology']) !== false) {
                $arrProjectType = unserialize($user['id_methodology']);
                $projectType = [];
                foreach ($arrProjectType as $apt) {
                    $queryProjectType = $this->Methodology_model->getMethodologyById($apt);
                    $name = $queryProjectType['methodology'] . ' - ' . $queryProjectType['keterangan'];
                }
                array_push($projectType, $name);
            } else {
                $queryProjectType = $this->Methodology_model->getMethodologyById($user['id_methodology']);
                $projectType = [$queryProjectType['methodology'] . ' - ' . $queryProjectType['keterangan']];
            }

            if (@unserialize($user['id_customer']) !== false) {
                $arrCustomer = unserialize($user['id_customer']);
                $contactPersonName = [];
                $contactPersonNumber = [];
                $contactPersonJabatan = [];
                for ($i = 0; $i < count($arrCustomer); $i++) {
                    $data = $this->Customer_model->getCustomerById($arrCustomer[$i]);
                    array_push($contactPersonName, $data['nama']);
                    array_push($contactPersonNumber, $data['hp1']);

                    $dataJabatan = $this->Jabatan_model->getJabatanById($data['jabatan']);
                    array_push($contactPersonJabatan, $dataJabatan['jabatan']);
                }
                // $contactPersonName = ($user['id_customer']) ? unserialize($user['id_customer']) : "";
                // $contactPersonNumber = ($user['id_customer']) ? unserialize($user['id_customer']) : "";
            } else {
                $data = $this->Customer_model->getCustomerById($user['id_customer']);
                $contactPersonName = ($data["nama"]) ? [$data['nama']] : [];
                $contactPersonNumber = ($data['hp1']) ? [$data['hp1']] : [];
            }
        }

        $queryRfq = $this->Rfq_model->getRfqById($projectNumber);
        if (@unserialize($queryRfq['id_customer']) === false) {
            $arrCustomer = $queryRfq['id_customer'];
            $queryCustomer = $this->Customer_model->getCustomerById($arrCustomer);
            $namaCustomer = $queryCustomer['nama'];
            $emailCustomer = $queryCustomer['email1'];
        } else {
            $arrCustomer = unserialize($queryRfq['id_customer']);
            $namaCustomer = [];
            $emailCustomer = [];
            foreach ($arrCustomer as $dataRfq) {
                $queryCustomer = $this->Customer_model->getCustomerById($dataRfq);
                array_push($namaCustomer, $queryCustomer['nama']);
                array_push($emailCustomer, $queryCustomer['email1']);
            }
        }

        $dataRfq = [
            'projectNumber' => $projectNumber,
            'enterDate' => $queryRfq['tgl_masuk'],
            'projectCode' => $queryRfq['kode_project'],
            'customerName' => $namaCustomer,
            'emailCustomer' => $emailCustomer,
            'idResearchBrief' => $queryRfq['id_research_brief']
        ];

        $data = [
            'projectName' => $projectName,
            'internalProjectName' => $internalProjectName,
            'projectNumber' => $projectNumber,
            'client' => $client,
            'address' => $address,
            'phone' => $phone,
            'email' => $email,
            'projectType' => $projectType,
            'contactPersonName' => $contactPersonName,
            'jabatan' => $contactPersonJabatan,
            'contactPersonNumber' => $contactPersonNumber,
            'ppn' => $ppn,
            'hargaPokokProduksi' => $hargaPokokProduksi,
            'managementFee' => $managementFee,
            'contractValue' => $contractValue,
            'mataUang' => $mataUang,
            'termsPayment' => $termsPayment,
            'loa' => $loa,
            'paymentDate' => $paymentDate,
            'invoiceDate' => $invoiceDate,
            'confirmLetter' => $confirmLetter,
            'researchExecutive' => $researchExecutive,
            'dataRfq' => $dataRfq
        ];
        echo json_encode($data);
    }
}
