<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once("application/models/entity/usuarioEntity.php");
require_once("application/models/entity/administradorEntity.php");

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

    public function newUsuario($isAdministrador = false)
    {
        return ($isAdministrador) ? new AdministradorEntity() : new UsuarioEntity();
    }

    public function isAdministrador(UsuarioEntity $usuario)
    {
        $r = $this->db->query("select * from administrador where usuario_id = ?", [$usuario->getId()]);

        foreach($r->result() as $resultado){
            return true;
        }
        return false;
    }

    public function cadastrar($usuarios = [])
    {
        if (!is_array($usuarios)){
            $usuarios = [$usuarios];
        }
        /**
         * @var $usuario UsuarioEntity | administradorEntity
         */
        $this->db->trans_start();
        foreach ($usuarios as $usuario) {
            $this->db->query("insert into usuario(nome, matricula, senha) values(?, ?, ?)", [$usuario->getNome(), $usuario->getMatricula(), $usuario->getSenha()]);
            if ($usuario instanceof AdministradorEntity) {
                $this->db->query("insert into administrador(usuario_id) values(last_insert_id())");
            }
        }
        $this->db->trans_complete();
        return ($this->db->trans_status());
    }
}