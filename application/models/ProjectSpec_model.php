<?php

class ProjectSpec_model extends CI_model
{
    public function getPsByRfq($id)
    {
        return $this->db->get_where('project_spec',array('no_rfq'=>$id))->row_array();
    }

    public function tambahSpec($id)
    {
        $data = array(
            "no_rfq"  => $id,
            "keterangan" => $this->input->post('keterangan', true),
            "tgl_mulai"  => $this->input->post('tgl_mulai',true),
            "tgl_selesai"  => $this->input->post('tgl_selesai', true),
        );

        $this->db->insert('project_spec', $data);
    }

    public function ubahSpec($id)
    {
        $data = array(
            "keterangan" => htmlspecialchars($this->input->post('keterangan'), ENT_QUOTES),
            "tgl_mulai"  => $this->input->post('tgl_mulai',true),
            "tgl_selesai"  => $this->input->post('tgl_selesai', true),
            "save" => 1
        );

        $this->db->where('no_rfq', $id);
        $this->db->update('project_spec', $data);
    }

    public function addDataResponden()
    {
      // EDIT BY ADAM SANTOSO
      $no_rfq = $this->input->post('rfq', true);
      $id_kota = $this->input->post('id_kota', true);
      $jumlah = $this->input->post('jumlah', true);
      $cek = $this->db->get_where('responden', ['no_rfq' => $no_rfq, 'id_kota' => $id_kota]);
      $get = $cek->row_array();
      $data = array(
          "no_rfq"  => $no_rfq,
          "id_kota" => $id_kota,
          "jumlah"  => $jumlah,
      );
      if($cek->num_rows() != 0){
        $data['jumlah'] = $get['jumlah']+$jumlah;
        $this->db->where(['no_rfq' => $no_rfq, 'id_kota' => $id_kota]);
        $this->db->update('responden', $data);
      }else{
        $this->db->insert('responden', $data);
      }
    }

    public function addDataTim()
    {
        // EDIT BY ADAM SANTOSO
        $no_rfq = $this->input->post('rfq', true);
        $id_user = $this->input->post('user', true);
        $status = $this->input->post('status', true);
        $cek = $this->db->get_where('team_ps', ['no_rfq' => $no_rfq, 'id_user' => $id_user]);
        $get = $cek->row_array();
        $data = array(
            "no_rfq"  => $no_rfq,
            "id_user" => $id_user,
            "status"  => $status,
        );
        if($cek->num_rows() != 0){
          $data['status'] = $status;
          $this->db->where(['no_rfq' => $no_rfq, 'id_user' => $id_user]);
          $this->db->update('team_ps', $data);
        }else{
          $this->db->insert('team_ps', $data);
        }
    }

    public function getUser($id)
    {

        return $this->db->get_where('data_user', array('dept'=>$id))->result_array();
    }

    public function getResponden($rfq)
    {
        error_reporting(0);
        $this->db->select('*');
        $this->db->from('responden');
        $this->db->join('daftar_kota', 'daftar_kota.id_kota = responden.id_kota');
        $this->db->where('responden.no_rfq', $rfq);

        return $this->db->get()->result_array();

    }

    public function getTim($id, $rfq)
    {
      error_reporting(0);
      $this->db->select('*');
      $this->db->from('team_ps');
      $this->db->join('data_user', 'data_user.id_user = team_ps.id_user and data_user.dept ='.$id);
      $this->db->where('team_ps.no_rfq', $rfq);
      $this->db->order_by('team_ps.status','desc');

      return $this->db->get()->result_array();
    }

    public function getDataTim($id, $no_rfq)
    {
      error_reporting(0);
      $data = array();
      foreach ($id as $id) {
        $this->db->select('*');
        $this->db->from('team_ps');
        $this->db->join('data_user', 'data_user.id_user = team_ps.id_user');
        $this->db->where('team_ps.id_team_ps', $id);
        $this->db->where('team_ps.no_rfq', $no_rfq);
        $get = $this->db->get();
        if($get->num_rows() > 0){
          $data[] = $get->row_array();
        }
      }
      return $data;
    }

    public function delDataKota($id)
    {
        // $this->db->where('id', $id);
        $this->db->delete('responden', array('id_responden' => $id));
    }

    public function delDataTim($id)
    {
        // $this->db->where('id', $id);
        $this->db->delete('team_ps', array('id_team_ps' => $id));
    }

    public function getBatalById($id)
    {
        return $this->db->get_where('data_batal', array('id_batal' => $id))->row_array();
    }

    public function ubahDataBatal()
    {
        $data = array(
            "alasan_batal" => $this->input->post('alasan_batal', true),
            "keterangan" => $this->input->post('keterangan', true),
            "user_add" => $this->session->userdata('ses_id'),
            "log_modif" =>  date("Y-m-d h:i:s"),
        );

        $this->db->where('id_batal', $this->input->post('id'));
        $this->db->update('data_batal', $data);
    }




    public function updatePPByAdam($id){
      error_reporting(0);
      $pp = $this->db->query("SELECT id_project_plan FROM project_plan WHERE nomor_rfq = '$id'")->row_array();
      $this->db->select('project_plan_data.date_start_target as st, project_plan_data.date_finish_target as ft, project_plan_master.nama_kegiatan as nk');
      $this->db->from('project_plan_data');
      $this->db->join('project_plan_master', 'project_plan_master.id_pp_master = project_plan_data.id_pp_master');
      $this->db->where('project_plan_data.id_project_plan', $pp['id_project_plan']);
      $this->db->order_by('project_plan_data.urutan_proses', 'ASC');
      $data = $this->db->get()->result_array();
      $bagi = ceil(count($data) / 2);
      $listPP = array_chunk($data, $bagi);

      $ket = '<table cellspacing="0" class="tbl-spec" width="100%">
      <tr class="bg-b">
        <td class="b-t b-l text-center" width="25%"><b>Schedule Details</b></td>
        <td class="b-t b-l b-r text-center" width="25%"><b>Date</b></td>
        <td class="b-t b-r text-center" width="25%"><b>Schedule Details</b></td>
        <td class="b-t b-r text-center" width="25%"><b>Date</b></td>
      </tr>';
      for ($i=0; $i < $bagi ; $i++) {
        $tglkiri = ''; $tglkanan = '';
        if($listPP[0][$i]['st'] != 0 AND $listPP[0][$i]['ft'] != 0){
          $tglkiri = $listPP[0][$i]['st'].' - '.$listPP[0][$i]['ft'];
        }
        if($listPP[1][$i]['st'] != 0 AND $listPP[1][$i]['ft'] != 0){
          $tglkanan = $listPP[1][$i]['st'].' - '.$listPP[1][$i]['ft'];
        }
        $ket .='<tr><td class="b-t b-l" width="25%">'.$listPP[0][$i]['nk'].'</td><td class="b-t b-l b-r text-center" width="25%">'.$tglkiri.'</td><td class="b-t b-r" width="25%">'.$listPP[1][$i]['nk'].'</td><td class="b-t b-r text-center" width="25%">'.$tglkanan.'</td></tr>';
      }
      $ket .= '</table>';

      if(count($data) > 0){
        return $ket;
      }else{
        echo 'error';
      }

    }

    public function getPPDataByAdam($id, $rfq){
      $pp = $this->db->query("SELECT id_project_plan FROM project_plan WHERE nomor_rfq = '$id'")->row_array();
      $this->db->select('project_plan_data.date_start_target as st, project_plan_data.date_finish_target as ft, project_plan_master.nama_kegiatan as nk');
      $this->db->from('project_plan_data');
      $this->db->join('project_plan_master', 'project_plan_master.id_pp_master = project_plan_data.id_pp_master');
      $this->db->where('project_plan_data.id_project_plan', $pp['id_project_plan']);
      $this->db->order_by('project_plan_data.urutan_proses', 'ASC');
      $data = $this->db->get()->result_array();
      $bagi = ceil(count($data) / 2);
      $listPP = array_chunk($data, $bagi);

      $cekMetode = @unserialize($rfq['id_methodology']);
      if($cekMetode !== false){
        $metodes = array();
        foreach ($cekMetode as $id_metode) {
          $metode = $this->Methodology_model->getMethodologyById($id_metode);
          $metodes[] = $metode['keterangan'];
        }
          $metodenya = implode(', ',$metodes);
      }else{
        $metode = $this->Methodology_model->getMethodologyById($rfq['id_methodology']);
        if($metode != null){
          $metodenya = $metode['keterangan'];
        }else{
          $metodenya = '<i>Tidak ada metode</i>';
        }
      }

      $ket = '';
      $ket .= '<table cellspacing="0" class="tbl-spec" width="100%">
        <tr>
          <td rowspan="8" class="tbl-logo" width="25%"><img src="'.base_url('images/logo.png').'" width="150px" height="150px" /></td>
          <td class="b-t b-l b-r" width="25%">&nbsp;Job Name</td>
          <td class="b-t b-r" width="25%">&nbsp;:&nbsp;'.$rfq['nama_project'].'</td>
          <td class="b-t b-r" width="10%">Distribusi</td>
          <td class="b-t b-r" width="15%"></td>
        </tr>

        <tr>
          <td class="b-t b-l b-r" width="25%">&nbsp;Job No</td>
          <td class="b-t b-r" width="25%">&nbsp;:&nbsp;'.$rfq['kode_project'].'</td>
          <td class="b-t b-r" width="10%">&nbsp;F. Director</td>
          <td class="b-t b-r" width="15%">&nbsp;(1)</td>
        </tr>
        <tr>
          <td class="b-t b-l b-r" width="25%">&nbsp;Date</td>
          <td class="b-t b-r" width="25%">&nbsp;:&nbsp;'.$rfq['date_system'].'</td>
          <td class="b-t b-r" width="10%">&nbsp;QC</td>
          <td class="b-t b-r" width="15%">&nbsp;(2)</td>
        </tr>
        <tr>
          <td class="b-t b-l b-r" width="25%">&nbsp;Exec</td>
          <td class="b-t b-r" width="25%">&nbsp;:&nbsp;</td>
          <td class="b-t b-r" width="10%">&nbsp;SPV</td>
          <td class="b-t b-r" width="15%">&nbsp;(3)</td>
        </tr>
        <tr>
          <td class="b-t b-l b-r" width="25%">&nbsp;R. MGR</td>
          <td class="b-t b-r" width="25%">&nbsp;:&nbsp;</td>
          <td class="b-t b-r" width="10%">&nbsp;Fin</td>
          <td class="b-t b-r" width="15%">&nbsp;(4)</td>
        </tr>
        <tr>
          <td class="b-t b-l b-r" width="25%">&nbsp;SPV/AFM</td>
          <td class="b-t b-r" width="25%">&nbsp;:&nbsp;</td>
          <td class="b-t b-r" width="10%">&nbsp;Coding</td>
          <td class="b-t b-r" width="15%">&nbsp;(5)</td>
        </tr>
        <tr>
          <td class="b-t b-l b-r" width="25%">&nbsp;DP</td>
          <td class="b-t b-r" width="25%">&nbsp;:&nbsp;</td>
          <td class="b-t b-r" width="10%">&nbsp;DP</td>
          <td class="b-t b-r" width="15%">&nbsp;(6)</td>
        </tr>
        <tr>
          <td class="b-t b-l b-r" width="25%"></td>
          <td class="b-t b-r" width="25%"></td>
          <td class="b-t b-r" width="10%">&nbsp;Puncher</td>
          <td class="b-t b-r" width="15%">&nbsp;(7)</td>
        </tr>
        </table><div id="listPP"></div>';
        // error_reporting(0);
        // for ($i=0; $i < $bagi ; $i++) {
        //   $tglkiri = ''; $tglkanan = '';
        //   if($listPP[0][$i]['st'] != 0 AND $listPP[0][$i]['ft'] != 0){
        //     $tglkiri = $listPP[0][$i]['st'].' - '.$listPP[0][$i]['ft'];
        //   }
        //   if($listPP[1][$i]['st'] != 0 AND $listPP[1][$i]['ft'] != 0){
        //     $tglkanan = $listPP[1][$i]['st'].' - '.$listPP[1][$i]['ft'];
        //   }
        //   $ket .='<tr><td class="b-t b-l">'.$listPP[0][$i]['nk'].'</td><td class="b-t b-l b-r text-center">'.$tglkiri.'</td><td class="b-t b-r">'.$listPP[1][$i]['nk'].'</td><td class="b-t b-r text-center" colspan="2">'.$tglkanan.'</td></tr>';
        // }
      $ket .=  '<table cellspacing="0" class="tbl-spec"><tr>
          <td class="b-all" colspan="5">
            <ul class="mt-3">
              <li>Metode: '.$metodenya.'</li>
              <li>Sampling: </li>
              <li id="listKota">Area: </li>
              <li>Kriteria responden: </li>
            </ul>
          </td>
        </tr>
        <tr>
          <td class="b-b b-l b-r" colspan="5">
            <table width="100%">
              <tr>
                <td class="text-center" width="33.3%">Checked by:<br><br><br><br></td>
                <td class="b-l b-r text-center" width="33.3%">Checked by:<br><br><br><br></td>
                <td class="text-center" width="33.3%">Checked by:<br><br><br><br></td>
              </tr>
              <tr>
                <td class="text-center" width="33.3%">_______________</td>
                <td class="b-l b-r text-center" width="33.3%">_______________</td>
                <td class="text-center" width="33.3%">_______________</td>
              </tr>
            </table>
          </td>
        </tr>
      </table>';
      //return $ket;
      if($this->db->get_where('project_spec', ['no_rfq' => $id])->num_rows() == 0){
        $data = array(
            "no_rfq"  => $id,
            "keterangan" => htmlspecialchars($ket, ENT_QUOTES),
            "tgl_mulai"  => null,
            "tgl_selesai"  => null,
            "save" => 0,
            "kode_dokumen" => $this->randomCode()
        );
        $this->db->insert('project_spec', $data);
      }else{
        $data = array(
            "keterangan" => htmlspecialchars($ket, ENT_QUOTES)
        );
        // $this->db->where(['no_rfq' => $id])->update('project_spec', $data);
      }
    }

    function randomCode() {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
        for ($i = 0; $i < 10; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $randomString .= $characters[$index];
        }
        return 'MRI-'.$randomString.date('ms');
    }

    // public function cariDataMahasiswa()
    // {
    //     $keyword = $this->input->post('keyword', true);
    //     $this->db->like('nama', $keyword);
    //     $this->db->or_like('jurusan', $keyword);
    //     $this->db->or_like('nrp', $keyword);
    //     $this->db->or_like('email', $keyword);
    //     return $this->db->get('mahasiswa')->result_array();
    // }
}
