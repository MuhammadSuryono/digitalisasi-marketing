<?php

class TargetClient_model extends CI_model
{
    public function tambah($id)
    {
        $this->db->where('id_sindikasi', $id);
        $idClient = $this->input->post('id_client');
        $this->db->from('data_target_client');
        $query = $this->db->query("SELECT * FROM data_target_client WHERE id_sindikasi = $id AND id_client = $idClient");
        $checkData = $query->row_array();

        $statusFile = $this->input->post('status-file');
        $revisiFile = $this->input->post('revisi-file');
        $arrProposal = [];
        if ($_FILES['suratPenawaran']['name']) {
            if ($statusFile == 1) {
                //baru
                $file_name = $_FILES['suratPenawaran']['name'];
                $file_tmp = $_FILES['suratPenawaran']['tmp_name'];
                move_uploaded_file($file_tmp, "file/proposal/" . $file_name);
            } else if ($statusFile == 2) {
                //revisi
                $countProposal = 1;
                if (@unserialize($checkData['proposal'])) {
                    $arrProposal = unserialize($checkData['proposal']);
                    for ($j = 0; $j < count($arrProposal); $j++) {
                        if (strpos($arrProposal[$j], $revisiFile) !== false) {
                            $countProposal++;
                        }
                    }
                }

                $file = pathinfo($_FILES['suratPenawaran']['name']);
                $revisiFileName = pathinfo($revisiFile);
                $file_name = $revisiFileName['filename'] . ' Revisi ' . $countProposal . '.' . $file['extension'];
                $file_tmp = $_FILES['suratPenawaran']['tmp_name'];
                move_uploaded_file($file_tmp, "file/proposal/" . $file_name);
            }


            if (@unserialize($checkData['proposal'])) {
                $arrProposal = unserialize($checkData['proposal']);
                array_push($arrProposal, $file_name);
            } else {
                array_push($arrProposal, $file_name);
            }
        } else {
            if (@unserialize($checkData['proposal'])) {
                $arrProposal = unserialize($checkData['proposal']);
            }
        }

        $hargaPenawaran = str_replace(',', '', $this->input->post('harga_penawaran[]'));
        $total = str_replace(',', '', $this->input->post('total[]'));

        if ($checkData) {
            $data = array(
                "id_client" => $this->input->post('id_client'),
                "id_contact_person" => serialize($this->input->post('id_cp[]')),
                "proposal" => serialize($arrProposal),
                "id_status" => $this->input->post('status'),
                "tgl_update" => $this->input->post('tgl_update'),
                "tgl_deal" => $this->input->post('tgl_deal'),
                "tgl_deadline" => $this->input->post('tgl_deadline'),
                "harga_penawaran" => $hargaPenawaran,
                "diskon" => $this->input->post('diskon'),
                "total" => $total,
                "catatan" => $this->input->post('catatan'),
                "created_at" => date('Y-m-d h:i:s')
            );

            $this->db->where('id_target_client', $this->input->post('id_target_client'));
            $this->db->update('data_target_client', $data);
        } else {
            $code = "REQ" . date('Y');
            $this->db->reset_query();
            $this->db->select('nomor_rfq');
            $this->db->from('data_target_client');
            $this->db->like('nomor_rfq', $code, 'after');
            $count = $this->db->count_all_results() + 1;
            $count = sprintf('%03d', $count);
            $noRfq = $code . date('md') . $count;

            $arrProposal = [];
            array_push($arrProposal, $file_name);

            $data = array(
                "nomor_rfq" => $noRfq,
                "id_sindikasi" => $id,
                "id_client" => $this->input->post('id_client'),
                "id_contact_person" => serialize($this->input->post('id_cp[]')),
                "proposal" => serialize($arrProposal),
                "id_status" => $this->input->post('status'),
                "tgl_update" => $this->input->post('tgl_update'),
                "tgl_deal" => $this->input->post('tgl_deal'),
                "tgl_deadline" => $this->input->post('tgl_deadline'),
                "harga_penawaran" => $hargaPenawaran,
                "diskon" => $this->input->post('diskon'),
                "total" => $total,
                "catatan" => $this->input->post('catatan'),
                "user_add" => $_SESSION['ses_id'],
                "created_at" => date('Y-m-d h:i:s')
            );

            $insert = $this->db->insert('data_target_client', $data);
        }
    }

    public function getTargetClientByDeadline()
    {
        $two_week = date("Y-m-d", strtotime("+2 week"));
        $one_week = date("Y-m-d", strtotime("+1 week"));
        return $this->db->query("SELECT a.*,b.*,c.*, e.nama AS nama_perusahaan FROM data_target_client a
                                JOIN data_sindikasi b ON b.id = a.id_sindikasi
                                JOIN data_user c ON c.id_user = b.id_pic
                                JOIN daftar_dept d ON d.id_dept = c.dept
                                JOIN data_perusahaan e ON e.id_perusahaan = a.id_client
                                WHERE a.tgl_deadline = '$two_week' OR a.tgl_deadline = '$one_week'")->result_array();
    }

    public function getTargetClientByIdSindikasi($id)
    {
        return $this->db->query("SELECT a.*, c.nama AS `nama_perusahaan`, d.status AS `status`
                                FROM data_target_client a
                                JOIN data_perusahaan c ON c.id_perusahaan = a.id_client
                                JOIN data_status d ON d.id_status = a.id_status
                                WHERE a.id_sindikasi = '$id'
                                ")->result_array();
    }

    public function getTargetClientById($id)
    {
        return $this->db->query("SELECT a.*, c.nama AS `nama_perusahaan`, d.status AS `status`
                                FROM data_target_client a
                                -- JOIN data_customer b ON b.id_customer = a.id_contact_person
                                JOIN data_perusahaan c ON c.id_perusahaan = a.id_client
                                JOIN data_status d ON d.id_status = a.id_status
                                WHERE a.id_target_client = '$id'
                                ")->row_array();
    }

    public function getTargetClientByStatus($status)
    {
        return $this->db->query("SELECT a.*, b.*, c.*, e.*
                                FROM data_target_client a
                                JOIN data_perusahaan c ON c.id_perusahaan = a.id_client
                                JOIN data_status d ON d.id_status = a.id_status
                                JOIN data_sindikasi e ON e.id = a.id_sindikasi
                                WHERE a.id_status = '$status'
                                ")->result_array();
    }
    public function getTargetClientByRfq($id)
    {
        return $this->db->query("SELECT a.*, c.*, e.*
                                FROM data_target_client a
                                JOIN data_perusahaan c ON c.id_perusahaan = a.id_client
                                JOIN data_sindikasi e ON e.id = a.id_sindikasi
                                WHERE a.nomor_rfq = '$id'
                                ")->row_array();
    }

    public function tambahFu()
    {
        $data = array(
            'nomor_rfq' => htmlspecialchars($this->input->post('nomor_rfq', true)),
            'date' => htmlspecialchars($this->input->post('date', true)),
            'ket' => htmlspecialchars($this->input->post('ket', true)),
        );

        $this->db->insert('data_fu', $data);
    }

    public function hapus($id)
    {
        $this->db->delete('data_target_client', array('id_target_client' => $id));
    }

    public function getRfqByUser($id)
    {
        // return $this->db->get_where('data_rfq', array('user_add' => $id))->result_array();
        $this->db->select('*');
        $this->db->from('data_rfq');
        $this->db->join('data_status', 'data_status.id_status = data_rfq.last_status');
        $this->db->where('user_add', $id);
        return $this->db->get()->result_array();
        // $this->db->order_by('data_fu.date', 'asc');
    }

    public function getRfqByStatus($id)
    {
        $all = $this->db->query("SELECT b.nomor_rfq, b.kode_project, b.nama_project, b.id_perusahaan, b.id_methodology, b.id_topic, b.last_status, c.nama
                      FROM data_rfq b
                      LEFT JOIN data_perusahaan c ON b.id_perusahaan = c.id_perusahaan
                      WHERE b.last_status = $id
    ")->result_array();

        return $all;
    }

    public function ubahDataRfq($file)
    {
        $blnThnKP = htmlspecialchars($this->input->post('blnThnKP', true));
        $noUrutKP = htmlspecialchars($this->input->post('noUrutKP', true));
        $dlKP = htmlspecialchars($this->input->post('dlKP', true)); // Dalam/Luar Negeri
        $asKP = htmlspecialchars($this->input->post('asKP', true)); // Adhoc/Sindikasi
        $kodeProject = $dlKP . '/' . $blnThnKP . '/' . $asKP . '/' . $noUrutKP;
        $status = htmlspecialchars($this->input->post('status', true));

        if ($this->input->post('id_jnsprmt_rfq') == 3) {
            $data = array(
                "tgl_masuk" => htmlspecialchars(date('Y-m-d', strtotime($this->input->post('tgl_masuk', true)))),
                "id_jnsprmt_rfq" => htmlspecialchars($this->input->post('id_jnsprmt_rfq', true)),
                "id_perusahaan" => htmlspecialchars($this->input->post('id_perusahaan', true)),
                "id_customer" => serialize($this->input->post('id_customer', true)),
                "tgl_feedback" => htmlspecialchars($this->input->post('tgl_feedback', true)),
                "tgl_kirim_proposal" => htmlspecialchars($this->input->post('tgl_kirim_proposal', true)),
                "file_proposal" => $file[1], // INDEX 1 FILE PROPOSAL
                "tgl_presentasi" => htmlspecialchars($this->input->post('tgl_presentasi', true)),
                "tgl_negosiasi" => htmlspecialchars($this->input->post('tgl_negosiasi', true)),
                "tgl_deal" => htmlspecialchars($this->input->post('tgl_deal', true)),
                "tgl_nodeal" => htmlspecialchars($this->input->post('tgl_nodeal', true)),
                "diskon" => htmlspecialchars($this->input->post('diskon', true)),
                "last_status" => $status,
                "id_batal" => htmlspecialchars($this->input->post('id_batal', true)),
                "masukan" => htmlspecialchars($this->input->post('masukan', true)),
                "user_add" => $this->session->userdata('ses_id'),
                "log_modif" =>  date("Y-m-d h:i:s"),
            );
            $id = $this->input->post('id');
            $this->db->where('nomor_rfq', $id);
            $this->db->update('data_rfq', $data);
            return 1;
        }

        $data = array(
            "tgl_masuk" => htmlspecialchars($this->input->post('tgl_masuk', true)),
            "kode_project" => $kodeProject,
            "nama_project" => htmlspecialchars($this->input->post('nama_project', true)),
            "id_perusahaan" => htmlspecialchars($this->input->post('id_perusahaan', true)),
            "id_customer" => serialize($this->input->post('id_customer', true)),
            "id_jnsprmt_rfq" => htmlspecialchars($this->input->post('id_jnsprmt_rfq', true)),
            "id_krj_rfq" => htmlspecialchars($this->input->post('id_krj_rfq', true)),
            //"id_methodology" => htmlspecialchars($this->input->post('id_methodology', true)),
            "id_methodology" => serialize($this->input->post('id_methodology', true)),
            "id_topic" => serialize($this->input->post('id_topic', true)),
            "id_dokumen" => serialize($this->input->post('id_dokumen', true)),
            "request" => htmlspecialchars($this->input->post('id_request', true)),
            "file_project" => $file[0], // INDEX 0 FILE TOR
            "tgl_proposal" => htmlspecialchars($this->input->post('tgl_proposal', true)),
            "catatan_tor" => htmlspecialchars($this->input->post('catatan_tor', true)),
            "date_system" => htmlspecialchars($this->input->post('date_system', true)),
            "date_customer" => htmlspecialchars($this->input->post('date_customer', true)),
            "tgl_submit" => date('Y-m-d'), //htmlspecialchars($this->input->post('tgl_submit', true)),
            "tgl_feedback" => htmlspecialchars($this->input->post('tgl_feedback', true)),
            "tgl_kirim_proposal" => htmlspecialchars($this->input->post('tgl_kirim_proposal', true)),
            "file_proposal" => $file[1], // INDEX 1 FILE PROPOSAL
            "tgl_presentasi" => htmlspecialchars($this->input->post('tgl_presentasi', true)),
            "tgl_negosiasi" => htmlspecialchars($this->input->post('tgl_negosiasi', true)),
            "tgl_deal" => htmlspecialchars($this->input->post('tgl_deal', true)),
            "tgl_nodeal" => htmlspecialchars($this->input->post('tgl_nodeal', true)),
            "diskon" => htmlspecialchars($this->input->post('diskon', true)),
            "last_status" => $status,
            "id_batal" => htmlspecialchars($this->input->post('id_batal', true)),
            "masukan" => htmlspecialchars($this->input->post('masukan', true)),
            "user_add" => $this->session->userdata('ses_id'),
            "log_modif" =>  date("Y-m-d h:i:s"),
        );
        $id = $this->input->post('id');
        $this->db->where('nomor_rfq', $id);
        $this->db->update('data_rfq', $data);

        $cek = $this->db->query("SELECT nomor_rfq FROM project_plan WHERE nomor_rfq = '$id'")->result_array();
        if ($status == 1 and count($cek) == null) { // 1 SAMA DENGAN DEAL => LIHAT DATA DARI TBL DATA_STATUS, MAKA BUAT PROJECT PLAN DAN PROJECT DOCUMENT JIKA CEK PROJECT PLAN BELUM ADA
            $data = array(
                "nomor_rfq" => $id
            );
            $this->db->insert('project_plan', $data);
            $dataDocument = array(
                "nomor_rfq" => $id,
                "document_x21" => serialize($file),
                "documentCheck_x212" => 0,
                "document_x22" => 'N;',
                "document_x23" => 'N;',
                "document_x24" => 'N;'
            );
            $this->db->insert('project_document', $dataDocument);
        }
    }
}
