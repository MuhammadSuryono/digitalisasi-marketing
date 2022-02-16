<?php

class Report_model extends CI_model
{
    public function getAllPermintaanRFQ(){
        return $this->db->get('data_jnsprmt_rfq')->result_array();
    }

    public function getAllQuery(){
        return $this->db->query("SELECT B.jenis_permintaan, A.id_jnsprmt_rfq, SUM(IF(A.last_status=0,1,0)) as ON_PROGRESS, SUM(IF(A.last_status=1,1,0)) AS DEAL, SUM(IF(A.last_status=2,1,0)) AS NO_DEAL, SUM(IF(A.last_status=3,1,0)) AS PENDING FROM data_jnsprmt_rfq B JOIN data_rfq A on A.id_jnsprmt_rfq=B.id_jnsprmt_rfq GROUP BY B.jenis_permintaan, B.id_jnsprmt_rfq")->result_array();
    }

    public function getAllQueryByDate(){
        $tgl1 = $this->input->post('date1');
        $tgl2 = $this->input->post('date2');

        return $this->db->query("SELECT B.jenis_permintaan, A.id_jnsprmt_rfq, SUM(IF(A.last_status=0,1,0)) as ON_PROGRESS, SUM(IF(A.last_status=1,1,0)) AS DEAL, SUM(IF(A.last_status=2,1,0)) AS NO_DEAL, SUM(IF(A.last_status=3,1,0)) AS PENDING FROM data_jnsprmt_rfq B JOIN data_rfq A on A.id_jnsprmt_rfq=B.id_jnsprmt_rfq WHERE  DATE_FORMAT(A.tgl_submit, '%m-%d-%Y') BETWEEN '$tgl1' and '$tgl2' GROUP BY B.jenis_permintaan, B.id_jnsprmt_rfq")->result_array();
    }

    public function getAllStatus(){
        return $this->db->get('data_status')->result_array();
    }
    // public function getAllStatus1(){
    //     return $this->db->query('Select A.id_jnsprmt_rfq, B.jenis_permintaan, A.last_status, C.status, count(jenis_permintaan) as banyak From data_status C JOIN ( data_rfq A JOIN data_jnsprmt_rfq B on A.id_jnsprmt_rfq=B.id_jnsprmt_rfq) on A.last_status=C.id_status WHERE last_status=1 GROUP BY jenis_permintaan, last_status')->result_array();
    // }
    // public function getAllStatus0(){
    //     return $this->db->query('Select A.id_jnsprmt_rfq, B.jenis_permintaan, A.last_status, C.status, count(jenis_permintaan) as banyak From data_status C JOIN ( data_rfq A JOIN data_jnsprmt_rfq B on A.id_jnsprmt_rfq=B.id_jnsprmt_rfq) on A.last_status=C.id_status WHERE last_status=0 GROUP BY jenis_permintaan, last_status')->result_array();
    // }

    // public function getAllStatus2(){
    //     return $this->db->query('Select A.id_jnsprmt_rfq, B.jenis_permintaan, A.last_status, C.status, count(jenis_permintaan) as banyak From data_status C JOIN ( data_rfq A JOIN data_jnsprmt_rfq B on A.id_jnsprmt_rfq=B.id_jnsprmt_rfq) on A.last_status=C.id_status WHERE last_status=2 GROUP BY jenis_permintaan, last_status')->result_array();
    // }

    // public function getAllStatus3(){
    //     return $this->db->query('Select A.id_jnsprmt_rfq, B.jenis_permintaan, A.last_status, C.status, count(jenis_permintaan) as banyak From data_status C JOIN ( data_rfq A JOIN data_jnsprmt_rfq B on A.id_jnsprmt_rfq=B.id_jnsprmt_rfq) on A.last_status=C.id_status WHERE last_status=3 GROUP BY jenis_permintaan, last_status')->result_array();
    // }

    // public function getStatusById($id){
    //     return $this->db->query("Select A.id_jnsprmt_rfq, B.jenis_permintaan, A.last_status, C.status, count(jenis_permintaan) as banyak From data_status C JOIN ( data_rfq A JOIN data_jnsprmt_rfq B on A.id_jnsprmt_rfq=B.id_jnsprmt_rfq) on A.last_status=C.id_status WHERE A.last_status='.$id.' GROUP BY jenis_permintaan, last_status")->result_array();
    // }

    //  public function getAllStatus1MY(){

    //     $tgl1 = $this->input->post('date1');
    //     $tgl2 = $this->input->post('date2');
    //     return $this->db->query("Select A.id_jnsprmt_rfq, B.jenis_permintaan, A.last_status, C.status, count(jenis_permintaan) as banyak From data_status C JOIN ( data_rfq A JOIN data_jnsprmt_rfq B on A.id_jnsprmt_rfq=B.id_jnsprmt_rfq) on A.last_status=C.id_status WHERE DATE_FORMAT(A.tgl_submit, '%m-%d-%Y')  BETWEEN '$tgl1' and '$tgl2' and last_status=1 GROUP BY jenis_permintaan, last_status")->result_array();
    // }
    //  public function getAllStatus0MY(){

    //     $tgl1 = $this->input->post('date1');
    //     $tgl2 = $this->input->post('date2');
    //     return $this->db->query("Select A.id_jnsprmt_rfq, B.jenis_permintaan, A.last_status, C.status, count(jenis_permintaan) as banyak From data_status C JOIN ( data_rfq A JOIN data_jnsprmt_rfq B on A.id_jnsprmt_rfq=B.id_jnsprmt_rfq) on A.last_status=C.id_status  WHERE DATE_FORMAT(A.tgl_submit, '%m-%d-%Y') BETWEEN '$tgl1' and '$tgl2' and last_status=0 GROUP BY jenis_permintaan, last_status")->result_array();
    // }

    // public function getAllStatus2MY(){

    //     $tgl1 = $this->input->post('date1');
    //     $tgl2 = $this->input->post('date2');
    //     return $this->db->query("Select A.id_jnsprmt_rfq, B.jenis_permintaan, A.last_status, C.status, count(jenis_permintaan) as banyak From data_status C JOIN ( data_rfq A JOIN data_jnsprmt_rfq B on A.id_jnsprmt_rfq=B.id_jnsprmt_rfq) on A.last_status=C.id_status WHERE DATE_FORMAT(A.tgl_submit, '%m-%d-%Y')  BETWEEN '$tgl1' and '$tgl2' and last_status=2 GROUP BY jenis_permintaan, last_status")->result_array();
    // }

    // public function getAllStatus3MY(){

    //     $tgl1 = $this->input->post('date1');
    //     $tgl2 = $this->input->post('date2');
    //     return $this->db->query("Select A.id_jnsprmt_rfq, B.jenis_permintaan, A.last_status, C.status, count(jenis_permintaan) as banyak From data_status C JOIN ( data_rfq A JOIN data_jnsprmt_rfq B on A.id_jnsprmt_rfq=B.id_jnsprmt_rfq) on A.last_status=C.id_status  WHERE  DATE_FORMAT(A.tgl_submit, '%m-%d-%Y') BETWEEN '$tgl1' and '$tgl2' and last_status=3 GROUP BY jenis_permintaan, last_status")->result_array();
    // }

}
