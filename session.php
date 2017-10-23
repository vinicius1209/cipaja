<?php
    require_once __DIR__."/entidades/Administrador.php";
    require_once __DIR__."/entidades/Usuario.php";
    session_start();
//var_dump($_SESSION);
   if(!isset($_SESSION['usuario'])){
      header("location:login.php");
   }
    $usuario = unserialize($_SESSION["usuario"]);
?>