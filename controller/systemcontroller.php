<?php
session_start();
header('Content-Type: text/html; charset=utf-8');
require_once __DIR__."/abstractcontroller.php";
require_once __DIR__."/../model/dao/systemDAO.php";
require_once __DIR__."/../model/dao/usuarioDAO.php";
class SystemController extends AbstractController{
    public function indexAction(){
        if (!isset($_SESSION['usuario'])){
            $this->loginAction();
        }
        $usuario = unserialiaze($_SESSION['usuario']);
        parent::getView("index");
    }

    public function loginAction(){
        if(!isset($_SESSION['usuario'])){
            $matricula = @$_POST["matricula"];
            $senha     = @$_POST["senha"];
            if ($matricula && $senha){
                $usuario = UsuarioDAO::getUsuarioByMatriculaAndSenha($matricula, $senha);
                $_SESSION["usuario"] = serialize($usuario);
            
                $this->loginAction();
            }
            parent::getView("login");
        }
        
        parent::getView("index");
        //$usuario = unserialize($_SESSION["usuario"]);
        //return $usuario;
    }
}
