<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once("application/models/entity/usuarioEntity.php");

class UsuarioDAO extends CI_Model
{
    public function __construct()
    {
    }

    public function getUsuarioByMatriculaAndSenha($matricula, $senha)
    {
        $resultados = $this->db->query("select * from usuario where matricula = ? and senha = md5(?)", [$matricula, $senha]);
        $usuario = new UsuarioEntity();
        foreach ($resultados->result() as $resultado) {
            $usuario->setId($resultado->id);
            $usuario->setNome($resultado->nome);
            $usuario->setSenha($resultado->senha);
            $usuario->setMatricula($resultado->matricula);
        }

        return $usuario;
    }
}