<?php

class Test_model extends CI_model
{
    public function pindah($data){
        // for($x=0;$x<count($data);$x++){
			// $this->db->insert('data_test2', $data);
    //    }
    $i = 0;
    foreach ($data as $dt) {
        $this->db->insert('data_test2', $dt[$i++]);
    }
        // for($x=0;$x<count($_POST['bahasa']);$x++){
		// 	$data = array(
		// 		"id_data1" => $_POST['bahasa'],
		// 	);

		// 	$this->db->insert('data_test2', $data);
		// }
    }

    public function getDataTest2(){
        return $this->db->get('data_test2')->result_array();
    }

    public function riway1(){
        foreach($_POST['languages'] as $dt){
				$data = [
                        'id_data1' => $dt,
                        'sts' => 0,
					];
				$this->db->insert('data_test2', $data);

			}
    }

    public function riway2(){
        foreach($_POST['languages'] as $dt){
				$this->db->delete('data_test2', ['id_data1' => $dt]);
			}
    }

    public function riway3(){
        foreach($_POST['languages'] as $dt){
                $this->db->set('sts', 1);
				$this->db->update('data_test2', ['id' => $dt]);
			}
    }

}