<?php
require_once __DIR__."/../../config.php";
class UsuarioDAO
{
    public static function getUsuarioByMatriculaAndSenha($matricula, $senha)
    {
        global $db;
        $sql = "SELECT
            usuario.*,
            ifnull(administrador.id, 0) administrador_id
            FROM usuario
            left join administrador on (usuario.id = administrador.usuario_id)
            WHERE matricula = '".$matricula."' and senha = '".md5($senha)."'";
        $res = $db->query($sql, PDO::FETCH_OBJ);

        if (!$res->fetch()){
            return null;
        }

        foreach ($db->query($sql, PDO::FETCH_OBJ) as $us){
            //UsuarioFactory
            if ($us->administrador_id > 0){
                $usuario = new \Administrador();
            } else{
                $usuario = new Usuario();
            }
        }
        $usuario->setMatricula($us->matricula)
            ->setNome($us->nome)
            ->setSenha($us->senha)
            ->setDataAdmissao($us->dataadmissao)
        ;
        return $usuario;
    }
}