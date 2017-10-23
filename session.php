<?php
	header('Content-Type: text/html; charset=utf-8');
    require_once __DIR__."/entidades/Administrador.php";
    require_once __DIR__."/entidades/Usuario.php";
    session_start();
   if(!isset($_SESSION['usuario'])){
      header("location:login.php");
   }
    $usuario = unserialize($_SESSION["usuario"]);
?>