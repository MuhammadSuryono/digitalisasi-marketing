<?php

class Auth_model extends CI_model
{

    public function login($username, $password)
    {
        $query  = $this->db->query("SELECT * FROM data_user WHERE nama_user='$username' AND password=MD5('$password') LIMIT 1");
        return $query;
    }
}
