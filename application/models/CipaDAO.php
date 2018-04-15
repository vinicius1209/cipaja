<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CipaDAO extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function getCipasEmAndamento()
    {
        $cipas = $this->db->query("select * from cipa where inicio_votacao <= curdate() and fim_votacao >= curdate()");

        return $cipas;
    }
}