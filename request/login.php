<?php
	header('Content-Type: text/html; charset=utf-8');
    require __DIR__."/../config.php";
    require_once __DIR__."/../entidades/Administrador.php";
    require_once __DIR__."/../entidades/Usuario.php";
    session_start();

    $matricula = $_POST["matricula"];
    $senha     = md5($_POST["senha"]);

    $sql = "SELECT
                  usuario.*,
                  ifnull(administrador.id, 0) administrador_id
              FROM usuario
              left join administrador on (usuario.id = administrador.usuario_id)
              WHERE matricula = '$matricula' and senha = '$senha'";

    $res = $db->query($sql, PDO::FETCH_OBJ);

    if (!$res->fetch()){
        echo json_encode(false);
        return;
    }

    foreach ($db->query($sql, PDO::FETCH_OBJ) as $us){
        if ($us->administrador_id > 0){
            $usuario = new \Administrador();
            ;
        } else{
            $usuario = new Usuario();
        }

        $usuario->setMatricula($us->matricula)
            ->setNome($us->nome)
            ->setSenha($us->senha)
        ;

        $_SESSION["usuario"] = serialize($usuario);
        echo json_encode(true);
        return;
    }