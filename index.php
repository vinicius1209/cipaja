<?php
   require_once "session.php";
?>
<!DOCTYPE html>
<html lang="br">

<head>
    <title>Bem-vindo!</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="assets/bootstrap-3.3.7/bootstrap-3.3.7/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/login.css">
    <script src="assets/jquery/jquery.min.js"></script>
    <script src="assets/bootstrap-3.3.7/bootstrap-3.3.7/dist/js/bootstrap.min.js"></script>
</head>
<body>

<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">Dashboard <small><?= $usuario->getNome() ?></small></a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="simulacao.html">Simulação</a></li>
                <?php if ($usuario instanceof \Administrador): ?>
                <li><a href="./html/cadastra_votacao.php">Cadastro Votação</a></li>
                <?php endif; ?>
                <li><a href="votacao.html">Votação</a></li>
                <li><a href="importacao.html">Funcionários</a></li>
                <li><a href="divulgacao.html">Resultados</a></li>
                <li><a href="aprovacao_candidatura.html">Candidaturas</a></li>
                <li><a href="javascript:desconectar()"><i class="glyphicon glyphicon-option-horizontal"></i></a></li>
            </ul>
        </div>
    </div>
</nav>
<script type="text/javascript">
    function desconectar(){
        $.ajax({
            type: "POST",
            url: "request/desconectar.php",
            success: function(){
                location.href = "login.php";
            }
        });
    }
</script>
</body>
</html>
