<?php

class Sindikasi_model extends CI_model
{
    public function getAllSindikasi()
    {
        $this->db->select('*');
        $this->db->from('data_sindikasi');
        return $this->db->get()->result_array();
    }

    public function tambah()
    {
        $targetSales = str_replace(',', '', $this->input->post('target_sales'));

        if ($_FILES['proposal']['name']) {
            $file = pathinfo($_FILES['proposal']['name']);
            $file_name = $file['filename'] . ' - ' . $this->input->post('nama_project') . '.' . $file['extension'];
            $file_tmp = $_FILES['proposal']['tmp_name'];
            move_uploaded_file($file_tmp, "file/proposal/" . $file_name);
        }

        $data = array(
            "nama_project" => htmlspecialchars($this->input->post('nama_project')),
            "target_sales" => htmlspecialchars($targetSales),
            "id_methodology" => serialize($this->input->post('id_methodology[]')),
            "id_pic" => $this->input->post('id_pic'),
            "proposal" => $file_name,
            "user_add" => $_SESSION['ses_id'],
            "created_at" => date('Y-m-d h:i:s')
        );

        $this->db->insert('data_sindikasi', $data);
    }

    public function getSindikasiById($id)
    {
        return $this->db->query("SELECT a.*, b.*
                                FROM data_sindikasi a
                                JOIN data_user b ON b.Id_user = a.id_pic
                                WHERE a.id = '$id'
                                ")->row_array();
    }

    public function hapusDataSindikasi($id)
    {
        $this->db->delete('data_sindikasi', array('id' => $id));
    }

    public function ubah($id)
    {
        $targetSales = str_replace(',', '', $this->input->post('target_sales'));

        if ($_FILES['proposal']['name']) {
            $file = pathinfo($_FILES['proposal']['name']);
            $file_name = $file['filename'] . ' - ' . $this->input->post('nama_project') . '.' . $file['extension'];
            $file_tmp = $_FILES['proposal']['tmp_name'];
            move_uploaded_file($file_tmp, "file/proposal/" . $file_name);
        }

        $data = array(
            "nama_project" => htmlspecialchars($this->input->post('nama_project')),
            "target_sales" => htmlspecialchars($targetSales),
            "id_methodology" => serialize($this->input->post('id_methodology[]')),
            "id_pic" => $this->input->post('id_pic'),
            "proposal" => $file_name,
            "created_at" => date('Y-m-d h:i:s')
        );
        $this->db->where('id', $id);
        $this->db->update('data_sindikasi', $data);
    }

    public function getAllOpsiStatus()
    {
        return $this->db->order_by('urutan', 'ASC')->get('data_status')->result_array();
    }

    // TAMBAHAN BARU EDIT BY ADAM SANTOSO
    function cekGenerate($norfqnya)
    {
        $data = $this->db->query("SELECT nomor_rfq FROM data_rfq WHERE nomor_rfq = '$norfqnya'")->row_array();
        if ($data['nomor_rfq'] != null) { // JIKA NOMOR RFQ DARI INPUT OTOMATIS SUDAH ADA MAKA GENERATE NOMOR BARU
            $this->db->select('max(nomor_rfq) as maxKode, max(kode_project) as maxKP');
            $this->db->from('data_rfq');
            $data = $this->db->get()->row_array();
            $no_rfq = $data['maxKode'];
            $no_urut = (int) substr($no_rfq, 11);
            $no_urut++;
            $char = 'REQ';
            $date = date("Ymd");
            $noRfq = $char . $date . sprintf('%07s', $no_urut);
            // OTOMATIS IKUT GENERATE NOMOR URUT BARU UNTUK KODE PROJECT
            $data = $this->db->query("SELECT max(kode_project) as maxKP FROM data_rfq WHERE nomor_rfq = '$no_rfq'")->row_array();
            $noKP = $data['maxKP'];
            if (date('Y-m-d') == date('Y-') . '01-01') { // JIKA SUDAH TAHUN BARU
                $noUrutKP = 1;
            } else {
                $noUrutKP = (int) substr($noKP, -3);
                $noUrutKP++;
            }
            $blnThnKP = date('m.Y');
            $noUrutKP = sprintf('%03s', $noUrutKP);
            $generate = array(
                'status' => true,
                'noRfq' => $noRfq,
                'blnThnKP' => $blnThnKP,
                'noUrutKP' => $noUrutKP
            );
        } else {
            $generate = array(
                'status' => false
            );
        }

        return $generate;
    }
}
