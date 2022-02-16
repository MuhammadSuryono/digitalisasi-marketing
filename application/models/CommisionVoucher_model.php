<?php

class CommisionVoucher_model extends CI_model
{
    public function getCommVoucher($id)
    {
        return $this->db->get_where('comm_voucher', ['nomor_project' => $id])->row_array();
    }

    public function setCommVoucher()
    {
        $departemen = $_SESSION['ses_level'];

        if (is_array($this->input->post('projectType'))) {
            $projectType = serialize($this->input->post('projectType'));
        } else {
            $projectType = serialize(explode(',', $this->input->post('projectType')));
        }

        $GLOBALS['onBudget'] = 0;

        if (strlen($this->input->post('projectNumber')) == 18) {
            $GLOBALS['onBudget'] = 0;

            $this->db->select('*');
            $this->db->from('data_rfq');
            $this->db->where('nomor_rfq', $this->input->post('projectNumber'));
            $resultRfq = $this->db->get()->row_array();
            $id_methodology = unserialize($resultRfq['id_methodology']);
            $kodeProject = explode("/", $resultRfq['kode_project']);

            if ($resultRfq['id_jnsprmt_rfq'] != 3) {
                if ($departemen == 76) {
                    $this->db->select('nomor_commission_voucher');
                    $this->db->from('comm_voucher');
                    $this->db->like('nomor_commission_voucher', 'RDN', 'after');
                    $count = $this->db->count_all_results() + 1;
                    $count = sprintf('%02d', $count);
                    $noComm = "RDN-" . $count . date('mY');
                } else {
                    if ($kodeProject[0] == 'D') {
                        $this->db->select('nomor_commission_voucher');
                        $this->db->from('comm_voucher');
                        $this->db->like('nomor_commission_voucher', 'MDN', 'after');
                        $count = $this->db->count_all_results() + 1;
                        $count = sprintf('%02d', $count);
                        $noComm = "MDN-" . $count . date('mY');
                    } else if ($kodeProject[0] == 'L') {
                        $this->db->select('nomor_commission_voucher');
                        $this->db->from('comm_voucher');
                        $this->db->like('nomor_commission_voucher', 'MLN', 'after');
                        $count = $this->db->count_all_results() + 1;
                        $count = sprintf('%02d', $count);
                        $noComm = "MLN-" . $count . date('mY');
                    }
                }
            } else {
                $this->db->select('*');
                $this->db->from('data_perusahaan');
                $this->db->where('id_perusahaan', $resultRfq['id_perusahaan']);
                $resultCompany = $this->db->get()->row_array();
                if ($departemen == 51) {
                    if ($resultCompany['bidang'] == 1) {
                        $this->db->select('nomor_commission_voucher');
                        $this->db->from('comm_voucher');
                        $this->db->like('nomor_commission_voucher', 'IMDN-3', 'after');
                        $count = $this->db->count_all_results() + 1;
                        $noComm = "IMDN-3." . $count . '-' . date('m') . '.' . date('Y');
                    } else if ($resultCompany['bidang'] == 2) {
                        $this->db->select('nomor_commission_voucher');
                        $this->db->from('comm_voucher');
                        $this->db->like('nomor_commission_voucher', 'IMDN-2', 'after');
                        $count = $this->db->count_all_results() + 1;
                        $noComm = "IMDN-2." . $count . '-' . date('m') . '.' . date('Y');
                    } else if ($resultCompany['bidang'] == 19) {
                        $this->db->select('nomor_commission_voucher');
                        $this->db->from('comm_voucher');
                        $this->db->like('nomor_commission_voucher', 'IMDN-1', 'after');
                        $count = $this->db->count_all_results() + 1;
                        $noComm = "IMDN-1." . $count . '-' . date('m') . '.' . date('Y');
                    }
                } else {
                    $this->db->select('nomor_commission_voucher');
                    $this->db->from('comm_voucher');
                    $this->db->like('nomor_commission_voucher', 'ISLE-1', 'after');
                    $count = $this->db->count_all_results() + 1;
                    $noComm = "ISLE-1." . $count . '-' . date('mY');
                }
            }
        } else {
            $GLOBALS['onBudget'] = 1;
            $resultRfq =  $this->TargetClient_model->getTargetClientByRfq($this->input->post('projectNumber'));
            // $this->db->select('*');
            // $this->db->from('data_target_client');
            // $this->db->where('nomor_rfq', $this->input->post('projectNumber'));
            // $resultRfq = $this->db->get()->row_array();
            // var_dump($resultRfq);
            // die;
            $id_methodology = unserialize($resultRfq['id_methodology']);
            // $kodeProject = explode("/", $resultRfq['kode_project']);

            $this->db->select('*');
            $this->db->from('data_perusahaan');
            $this->db->where('id_perusahaan', $resultRfq['id_perusahaan']);
            $resultCompany = $this->db->get()->row_array();
            if ($departemen == 51) {
                if ($resultCompany['bidang'] == 1) {
                    $this->db->select('nomor_commission_voucher');
                    $this->db->from('comm_voucher');
                    $this->db->like('nomor_commission_voucher', 'IMDN-3', 'after');
                    $count = $this->db->count_all_results() + 1;
                    $noComm = "IMDN-3." . $count . '-' . date('m') . '.' . date('Y');
                } else if ($resultCompany['bidang'] == 2) {
                    $this->db->select('nomor_commission_voucher');
                    $this->db->from('comm_voucher');
                    $this->db->like('nomor_commission_voucher', 'IMDN-2', 'after');
                    $count = $this->db->count_all_results() + 1;
                    $noComm = "IMDN-2." . $count . '-' . date('m') . '.' . date('Y');
                } else if ($resultCompany['bidang'] == 19) {
                    $this->db->select('nomor_commission_voucher');
                    $this->db->from('comm_voucher');
                    $this->db->like('nomor_commission_voucher', 'IMDN-1', 'after');
                    $count = $this->db->count_all_results() + 1;
                    $noComm = "IMDN-1." . $count . '-' . date('m') . '.' . date('Y');
                }
            } else {
                $this->db->select('nomor_commission_voucher');
                $this->db->from('comm_voucher');
                $this->db->like('nomor_commission_voucher', 'ISLE-1', 'after');
                $count = $this->db->count_all_results() + 1;
                $noComm = "ISLE-1." . $count . '-' . date('mY');
            }
        }

        var_dump($GLOBALS['onBudget']);
        // // var_dump($noComm);
        // die;

        $data = [
            "nomor_commission_voucher" => $noComm,
            "nama_project" => trim($this->input->post('projectName')),
            "nama_project_internal" => trim($this->input->post('internalProjectName')),
            "nomor_project" => $this->input->post('projectNumber'),
            "client" => trim($this->input->post('client')),
            "alamat" => trim($this->input->post('address')),
            "telp" => trim($this->input->post('phoneNumber')),
            "email" => trim($this->input->post('email')),
            "tipe_project" => $projectType,
            "nama_contact_person" => serialize($this->input->post('contactPersonName')),
            "jabatan_contact_person" => serialize($this->input->post('contactPersonPosition')),
            "nomor_contact_person" => serialize($this->input->post('contactPersonNumber')),
            "ppn" => trim($this->input->post('ppn')),
            "harga_pokok_produksi" => trim($this->input->post('hargaPokokProduksi')),
            "management_fee" => trim($this->input->post('managementFee')),
            "contract_value" => trim($this->input->post('contractValue')),
            "id_mata_uang" => trim($this->input->post('mataUang')),
            "terms_of_payment" => serialize($this->input->post('termsPayment')),
            "based_on_loa" => serialize($this->input->post('loa')),
            "payment_date" => serialize($this->input->post('paymentDate')),
            "invoice_date" => serialize($this->input->post('invoiceDate')),
            "letter_to_followed_by" => ($this->input->post('confirmLetter')),
            "research_executive" => $this->input->post('researchExecutive'),
            "user_add" => $_SESSION['ses_id'],
            "on_budget" => $GLOBALS['onBudget'],
            "created_by" => $this->session->userdata('ses_id'),
            "kode_dokumen" => $this->randomCode()
        ];

        $this->db->insert('comm_voucher', $data);
    }

    public function editCommVoucher()
    {
        if (is_array($this->input->post('projectType'))) {
            $projectType = serialize($this->input->post('projectType'));
        } else {
            $projectType = serialize(explode(',', $this->input->post('projectType')));
        }

        $data = [
            "nama_project" => trim($this->input->post('projectName')),
            "nama_project_internal" => trim($this->input->post('internalProjectName')),
            "nomor_project" => $this->input->post('projectNumber'),
            "client" => trim($this->input->post('client')),
            "alamat" => trim($this->input->post('address')),
            "telp" => trim($this->input->post('phoneNumber')),
            "email" => trim($this->input->post('email')),
            "tipe_project" => $projectType,
            "nama_contact_person" => serialize($this->input->post('contactPersonName')),
            "nomor_contact_person" => serialize($this->input->post('contactPersonNumber')),
            "ppn" => trim($this->input->post('ppn')),
            "harga_pokok_produksi" => trim($this->input->post('hargaPokokProduksi')),
            "management_fee" => trim($this->input->post('managementFee')),
            "contract_value" => trim($this->input->post('contractValue')),
            "id_mata_uang" => trim($this->input->post('mataUang')),
            "terms_of_payment" => serialize($this->input->post('termsPayment')),
            "based_on_loa" => serialize($this->input->post('loa')),
            "payment_date" => serialize($this->input->post('paymentDate')),
            "invoice_date" => serialize($this->input->post('invoiceDate')),
            "letter_to_followed_by" => ($this->input->post('confirmLetter')),
            "research_executive" => trim($this->input->post('researchExecutive')),
        ];
        $this->db->where('nomor_project', $this->input->post('projectNumber'));
        $this->db->update('comm_voucher', $data);
    }

    function randomCode()
    {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
        for ($i = 0; $i < 10; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $randomString .= $characters[$index];
        }
        return 'MRI-' . $randomString . date('ms');
    }
}
