<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UsuarioDAO extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function getUsuarioByMatriculaAndSenha($matricula, $senha)
    {
        $usuario = $this->db->query("select * from usuario where matricula = ? and senha = md5(?)", [$matricula, $senha]);
        return $usuario->result();
    }
}