<?php 

class Costing_model extends CI_model
{
    public function getAllCosting()
    {
        $this->db->select('*');
        $this->db->from('costing');
        return $this->db->get()->result_array();
    }

    public function getAllCc()
    {
        $this->db->select('*');
        $this->db->from('cc');
        $this->db->join('data_methodology', 'data_methodology.id_methodology = cc.id_methodology');
        $this->db->join('data_rfq', 'data_rfq.nomor_rfq = cc.nomor_rfq');
        return $this->db->get()->result_array();
    }

    public function getAllCost()
    {
        $this->db->select('*');
        $this->db->from('cost');
        
        return $this->db->get()->result_array();
    }

    public function getAllKotaCost($id)
    {
        $this->db->select('*');
        $this->db->from('kota_cost');
        $this->db->join('city_cost', 'city_cost.id_city = kota_cost.id_city');
        $this->db->where('kota_cost.nomor_rfq ="'.$id.'"');

        return $this->db->get()->result_array();
    }

    public function tambahDataCosting($id)
    {
        $data = array(
            "id_project" => $id,
            "g1" => htmlspecialchars($this->input->post('g1', true)),
            "g2" => htmlspecialchars($this->input->post('g2', true)),
            "rpsatuan" => htmlspecialchars($this->input->post('rpsatuan', true)),
            "keterangan" => htmlspecialchars($this->input->post('keterangan', true)),
            "jumlah" => htmlspecialchars($this->input->post('jumlah', true)),
            "user_add" => $this->session->userdata('ses_id'),
            "log_modif" =>  date("Y-m-d h:i:s"),
        );

        $this->db->insert('costing', $data);
    }

    public function tambahDataKota($id)
    {
        $data = array(
            "kota_kost" => htmlspecialchars($this->input->post('kota', true)),
            "nomor_rfq" => $id,
        );

        $this->db->insert('kota_cost', $data);
    }

    public function AddCc()
    {
        $data = array(
            "nomor_rfq" => htmlspecialchars($this->input->post('nomor_rfq', true)),
            "id_methodology" => htmlspecialchars($this->input->post('methodology', true)),
        );

        $this->db->insert('cc',$data);

        foreach($this->input->post('kota') as $key => $value){
            $das = array(
                "id_city" => $value,
                "nomor_rfq" => htmlspecialchars($this->input->post('nomor_rfq', true)),
            );

            $this->db->insert('kota_cost',$das);
        }

        $proses = $this->db->get('proses_cost')->result_array();
        $model = $this->db->get('city_kom')->result_array();
        foreach ($model as $db) {
            $komp[$db['id_kota_cost']][$db['id_komponen_cost']] = $db['harga'];
        }

        foreach ($proses as $db) {
            $adj = array(
                "id_proses" => $db['id_proses'],
                "nomor_rfq" => htmlspecialchars($this->input->post('nomor_rfq', true)),
                "adjust" => 0,
            );
            $this->db->insert('adjustment',$adj); 

            foreach($this->input->post('kota') as $key => $value){
                if($db['id_komponen'] != 0){
                    $nilai = $komp[$value][$db['id_komponen']];
                }elseif($db['id_oh'] != 0) {
                    $oh = $this->db->get_where('data_overhead', array('id_oh'=>$db['id_oh']))->row_array();
                    $nilai = $oh['harga']/count($this->input->post('kota'));
                }else{
                    $nilai = 0;
                }

                $dat_proses = array(
                    "id_proses" => $db['id_proses'],
                    "id_city" => $value,
                    "nilai" => $nilai,
                    "nomor_rfq" => htmlspecialchars($this->input->post('nomor_rfq', true)),
                );

                $this->db->insert('data_proses',$dat_proses); 
            }
        }
    }

    public function rumusProses($id, $kota)
    {
        $this->db->select('*');
        $this->db->from('data_proses');
        $this->db->join('proses_cost', 'data_proses.id_proses = proses_cost.id_proses');
        $this->db->where('data_proses.nomor_rfq ="'.$id.'"');
        $proses = $this->db->get()->result_array();

        $adjust =  $this->db->get_where('adjustment', array('nomor_rfq' => $id))->result_array();
        foreach ($adjust as $db) {
            $adj[$db['id_proses']][$db['nomor_rfq']] = $db['adjust']; 
        }

        foreach ($proses as $db) {
            $ni[$db['id_city']][$db['id_proses']] = $db['nilai'];
        }

        foreach ($proses as $db) {
             if($db['id_komponen'] == 0 && $db['id_oh'] == 0 && $db['input'] == 0){
                if($db['id_proses'] == 10){
                    $nilai = $adj[$db['id_proses']][$db['nomor_rfq']] * 30;
                }elseif($db['id_proses'] == 11){
                    $nilai = round($adj[$db['id_proses']][$db['nomor_rfq']] / $kota);
                }elseif($db['id_proses'] == 12){
                    if($adj[$db['id_proses']][$db['nomor_rfq']] == 0){
                        $nilai = 0;
                    }else{
                        $nilai = (30 * $adj[10][$db['nomor_rfq']]) / $adj[$db['id_proses']][$db['nomor_rfq']];
                    }
                }elseif($db['id_proses'] == 14){
                    $nilai = round($ni[$db['id_city']][2]/30);
                }elseif($db['id_proses'] == 15){
                    $nilai = $ni[$db['id_city']][14] * $ni[$db['id_city']][13];
                }elseif($db['id_proses'] == 17){
                    if($adj[$db['id_proses']][$db['nomor_rfq']] == 0){
                        $nilai = 0;
                    }else{
                        $nilai = ceil($ni[$db['id_city']][2]/($ni[$db['id_city']][15] * ($adj[$db['id_proses']][$db['nomor_rfq']]/100))/ $ni[$db['id_city']][8]);
                    }
                }elseif($db['id_proses'] == 19){
                    if($ni[$db['id_city']][20]== 0){
                        $nilai = 0;
                    }else{
                        $nilai = $ni[$db['id_city']][20] / $ni[$db['id_city']][8] + $ni[$db['id_city']][21];
                    }
                }elseif($db['id_proses'] == 27){
                    if($ni[$db['id_city']][26] == 0){
                        $nilai = 0;
                    }else{
                        $nilai = number_format($ni[$db['id_city']][10] / $ni[$db['id_city']][26] * $adj[$db['id_proses']][$db['nomor_rfq']],1);
                    }
                }elseif($db['id_proses'] == 30){
                    $nilai = $adj[$db['id_proses']][$db['nomor_rfq']] * $ni[$db['id_city']][28]; 
                }elseif($db['id_proses'] == 31){
                    $nilai = ceil($adj[$db['id_proses']][$db['nomor_rfq']] / $kota );
                }elseif($db['id_proses'] == 32){
                    $nilai = ceil($adj[$db['id_proses']][$db['nomor_rfq']] / $kota );
                }elseif($db['id_proses'] == 37){
                    $nilai = $adj[$db['id_proses']][$db['nomor_rfq']] / $kota;
                }elseif($db['id_proses'] == 38){
                    $nilai = $adj[$db['id_proses']][$db['nomor_rfq']] / $kota;
                }elseif($db['id_proses'] == 39){
                    $nilai = $adj[$db['id_proses']][$db['nomor_rfq']] / $kota;
                }elseif($db['id_proses'] == 40){
                    $nilai = $adj[$db['id_proses']][$db['nomor_rfq']] / $kota;
                }elseif($db['id_proses'] == 41){
                    $nilai = $adj[$db['id_proses']][$db['nomor_rfq']] / $kota;
                }else{
                    $nilai = $adj[$db['id_proses']][$db['nomor_rfq']];
                }

                $dat_proses = array(
                    "nilai" => $nilai,
                );

                $this->db->where('id_data_proses', $db['id_data_proses']);
                $this->db->update('data_proses', $dat_proses); 
            }
        }   
    }

    public function tampilCost($id)
    {
        $cost = $this->getAllCost();
        $kota = $this->getAllKotaCost($id);

        $model = $this->db->get('city_kom')->result_array();
        foreach ($model as $db) {
            $komp[$db['id_kota_cost']][$db['id_komponen_cost']] = $db['harga'];
        }

        $proses = $this->db->get_where('data_proses', array('nomor_rfq' => $id))->result_array();
        foreach ($proses as $db) {
            $data[$db['id_proses']][$db['id_city']] = $db['nilai']; 
        }

        foreach ($cost as $dc) {
            foreach ($kota as $dk) {
                if($dc['id_cost'] == 1){
                    $hasil[$dc['id_cost']][$dk['id_city']] = $data[2][$dk['id_city']] * $dc['nilai'];
                }elseif($dc['id_cost'] == 2){
                    $hasil[$dc['id_cost']][$dk['id_city']] = $hasil[1][$dk['id_city']] * $dc['nilai'] * $data[12][$dk['id_city']] ;
                }elseif($dc['id_cost'] == 3){
                    $hasil[$dc['id_cost']][$dk['id_city']] = $data[2][$dk['id_city']] * $dc['nilai'];
                }elseif($dc['id_cost'] == 4){
                    $hasil[$dc['id_cost']][$dk['id_city']] = ($data[13][$dk['id_city']] + $data[14][$dk['id_city']]) * $data[1][$dk['id_city']] * $data[5][$dk['id_city']] * 2;
                }elseif($dc['id_cost'] == 5){   
                    $hasil[$dc['id_cost']][$dk['id_city']] = $data[5][$dk['id_city']] + $data[13][$dk['id_city']] * $data[17][$dk['id_city']] * $komp[$db['id_city']][8];
                }elseif($dc['id_cost'] == 6){
                    $hasil[$dc['id_cost']][$dk['id_city']] = $komp[$db['id_city']][9] * $data[7][$dk['id_city']];  
                }elseif($dc['id_cost'] == 10){
                    $hasil[$dc['id_cost']][$dk['id_city']] = $data[15][$dk['id_city']] * $komp[$db['id_city']][10];
                }elseif($dc['id_cost'] == 11){
                    $hasil[$dc['id_cost']][$dk['id_city']] = $data[15][$dk['id_city']] * $data[19][$dk['id_city']] * $dc['nilai']; 
                }elseif($dc['id_cost'] == 12){
                    if($data[2][$dk['id_city']] == 0){
                        $data[2][$dk['id_city']] = 1;
                    }
                    $hasil[$dc['id_cost']][$dk['id_city']] = 1/$data[2][$dk['id_city']] * ($data[9][$dk['id_city']]/100) * $dc['nilai'] - $data[2][$dk['id_city']] * $dc['nilai'];  
                }elseif($dc['id_cost'] == 13){
                    $hasil[$dc['id_cost']][$dk['id_city']] = $data[13][$dk['id_city']] * $data[17][$dk['id_city']] * $komp[$db['id_city']][11];
                }elseif($dc['id_cost'] == 14){
                    $hasil[$dc['id_cost']][$dk['id_city']] = $data[2][$dk['id_city']] * $data[19][$dk['id_city']] * $dc['nilai'];
                }elseif($dc['id_cost'] == 15){
                    $hasil[$dc['id_cost']][$dk['id_city']] = $data[2][$dk['id_city']] * $data[22][$dk['id_city']] * $dc['nilai'];
                }elseif($dc['id_cost'] == 16){
                    if( $data[8][$dk['id_city']] == 0){
                         $data[8][$dk['id_city']] = 1;
                    }
                    $hasil[$dc['id_cost']][$dk['id_city']] = $data[2][$dk['id_city']] * $komp[$db['id_city']][12] * ($data[42][$dk['id_city']] /(2 * $data[8][$dk['id_city']]));
                }elseif($dc['id_cost'] == 19){
                    $hasil[$dc['id_cost']][$dk['id_city']] = $data[32][$dk['id_city']] * $data[11][$dk['id_city']] * 4;
                }elseif($dc['id_cost'] == 20){
                    $hasil[$dc['id_cost']][$dk['id_city']] = $data[2][$dk['id_city']] * $data[27][$dk['id_city']] * $dc['nilai'];
                }elseif($dc['id_cost'] == 21){
                    $hasil[$dc['id_cost']][$dk['id_city']] = $data[2][$dk['id_city']] * $data[27][$dk['id_city']] * $dc['nilai'] * $data[11][$dk['id_city']];
                }elseif($dc['id_cost'] == 22){
                    $hasil[$dc['id_cost']][$dk['id_city']] = $data[2][$dk['id_city']] * $data[30][$dk['id_city']] * $dc['nilai'];
                }elseif($dc['id_cost'] == 23){
                    $hasil[$dc['id_cost']][$dk['id_city']] = $data[2][$dk['id_city']] * $data[27][$dk['id_city']] * $dc['nilai'];
                }elseif($dc['id_cost'] == 24){
                    $hasil[$dc['id_cost']][$dk['id_city']] = round($data[43][$dk['id_city']] *  $dc['nilai']);
                }elseif($dc['id_cost'] == 25){
                    $hasil[$dc['id_cost']][$dk['id_city']] = round($data[44][$dk['id_city']] * $data[31][$dk['id_city']] * $dc['nilai'] *4);
                }elseif($dc['id_cost'] == 26){
                    $hasil[$dc['id_cost']][$dk['id_city']] = round($data[37][$dk['id_city']] * $data[45][$dk['id_city']] * $dc['nilai'] *4);
                }elseif($dc['id_cost'] == 27){
                    $hasil[$dc['id_cost']][$dk['id_city']] = round($data[46][$dk['id_city']] * $data[12][$dk['id_city']] );
                }elseif($dc['id_cost'] == 28){
                    $hasil[$dc['id_cost']][$dk['id_city']] = ceil($data[38][$dk['id_city']] * $data[47][$dk['id_city']] / $dc['nilai']) * 6;
                }elseif($dc['id_cost'] == 29){
                    $hasil[$dc['id_cost']][$dk['id_city']] = round($data[48][$dk['id_city']]) * $data[39][$dk['id_city']] * $dc['nilai'] * 7;
                }elseif($dc['id_cost'] == 30){
                    $hasil[$dc['id_cost']][$dk['id_city']] = round($data[49][$dk['id_city']]) * $data[40][$dk['id_city']] * $dc['nilai'] * 7;
                }elseif($dc['id_cost'] == 31){
                    $hasil[$dc['id_cost']][$dk['id_city']] = round($data[50][$dk['id_city']]) * $data[41][$dk['id_city']] * $dc['nilai'] * 7;
                }elseif($dc['id_cost'] == 32){
                    $hasil[$dc['id_cost']][$dk['id_city']] = $data[51][$dk['id_city']];
                }elseif($dc['id_cost'] == 33){
                    $hasil[$dc['id_cost']][$dk['id_city']] = round($data[52][$dk['id_city']]) * $data[2][$dk['id_city']] * $dc['nilai'] / round($data[53][$dk['id_city']]) * $dc['nilai2'];
                }elseif($dc['id_cost'] == 34){
                    $hasil[$dc['id_cost']][$dk['id_city']] = round($data[54][$dk['id_city']]) * $data[2][$dk['id_city']] * $dc['nilai'] / round($data[55][$dk['id_city']]) * $dc['nilai2'];
                }else{
                    $hasil[$dc['id_cost']][$dk['id_city']] = '-';
                }
            }
        }

        return $hasil;
    }

    public function hapusDataCosting($id)
    {
        // $this->db->where('id', $id);
        $this->db->delete('costing', array('id_costing' => $id));
    }

    public function DeleteCosting($id)
    {
        // $this->db->where('id', $id);
        $this->db->delete('cc', array('nomor_rfq' => $id));
        $this->db->delete('kota_cost', array('nomor_rfq' => $id));
        $this->db->delete('data_proses', array('nomor_rfq' => $id));
    }

    public function getCostingById($id)
    {	
        return $this->db->get_where('data_customer', array('id_customer' => $id))->row_array();
    }
	
	public function getCostingByProject($id)
    {
		$this->db->select('*, costing.keterangan as ket');
		$this->db->from('costing');
		$this->db->join('group_costing1', 'group_costing1.id_g_c1 = costing.g1');
		$this->db->join('group_costing2', 'group_costing2.id_g_c2 = costing.g2');
        $this->db->where('id_project = "'. $id.'"');

        return $this->db->get()->result_array();
    }

    public function ubahDataCosting($id)
    {
		$data = array(
            "id_project" => $id,
            "g1" => htmlspecialchars($this->input->post('g1', true)),
            "g2" => htmlspecialchars($this->input->post('g2', true)),
            "rpsatuan" => htmlspecialchars($this->input->post('rpsatuan', true)),
            "keterangan" => htmlspecialchars($this->input->post('keterangan', true)),
            "jumlah" => htmlspecialchars($this->input->post('jumlah', true)),
            "user_add" => $this->session->userdata('ses_id'),
            "log_modif" =>  date("Y-m-d h:i:s"),
        );

        $this->db->where('id_costing', $this->input->post('id'));
        $this->db->update('costing', $data);
    }

    public function updateNilaiCost()
    {
        if($this->input->post('n') == 1){
            $data = array(
                "nilai" => htmlspecialchars($this->input->post('data', true)),
            );
        }elseif($this->input->post('n') == 2){
            $data = array(
                "nilai2" => htmlspecialchars($this->input->post('data', true)),
            );
        }

        $this->db->where('id_cost', $this->input->post('id'));
        $this->db->update('cost', $data);
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

    public function AddKotaCc()
    {
        foreach($this->input->post('kota') as $key => $value){
            $kota = $value;
            $das = array(
                "id_city" => $value,
                "nomor_rfq" => htmlspecialchars($this->input->post('nomor_rfq', true)),
            );

            if ($this->db->get_where('kota_cost',['id_city' => $kota, 'nomor_rfq' => $this->input->post('nomor_rfq')])->num_rows() == 0){
                // var_dump($this->db->get_where('kota_cost',['id_city' => $kota, 'nomor_rfq' => $this->input->post('nomor_rfq')])->num_rows());
                // die;
                $this->db->insert('kota_cost',$das);

                 $proses = $this->db->get('proses_cost')->result_array();
        $model = $this->db->get('city_kom')->result_array();
        foreach ($model as $db) {
            $komp[$db['id_kota_cost']][$db['id_komponen_cost']] = $db['harga'];
        }

        foreach ($proses as $db) {
            $adj = array(
                "id_proses" => $db['id_proses'],
                "nomor_rfq" => htmlspecialchars($this->input->post('nomor_rfq', true)),
                "adjust" => 0,
            );
            $this->db->insert('adjustment',$adj); 

            foreach($this->input->post('kota') as $key => $value){
                if($db['id_komponen'] != 0){
                    $nilai = $komp[$value][$db['id_komponen']];
                }elseif($db['id_oh'] != 0) {
                    $oh = $this->db->get_where('data_overhead', array('id_oh'=>$db['id_oh']))->row_array();
                    $nilai = $oh['harga']/count($this->input->post('kota'));
                }else{
                    $nilai = 0;
                }

                $dat_proses = array(
                    "id_proses" => $db['id_proses'],
                    "id_city" => $value,
                    "nilai" => $nilai,
                    "nomor_rfq" => htmlspecialchars($this->input->post('nomor_rfq', true)),
                );

                $this->db->insert('data_proses',$dat_proses); 
            }
        }
            }
            
        }

       
    }
}
