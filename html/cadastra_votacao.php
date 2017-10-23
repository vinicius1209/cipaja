<?php
require_once __DIR__."/../session.php";
?>
<!DOCTYPE html>
<html lang="br">

<head>
    <title>Bem-vindo!</title>
    <link rel="stylesheet" href="../assets/bootstrap-3.3.7/bootstrap-3.3.7/dist/css/bootstrap.min.css">
    <script src="../assets/jquery/jquery.min.js"></script>
    <script src="../assets/bootstrap-3.3.7/bootstrap-3.3.7/dist/js/bootstrap.min.js"></script>
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
            <a class="navbar-brand" href="../index.php">Dashboard <small><?= $usuario->getNome() ?></small></a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="simulacao.html">Simulação</a></li>
                <li><a href="cadastra_votacao.php">Cadastro Votação</a></li>
                <li><a href="votacao.html">Votação</a></li>
                <li><a href="importacao.html">Funcionários</a></li>
                <li><a href="divulgacao.html">Resultados</a></li>
                <li><a href="aprovacao_candidatura.html">Candidaturas</a></li>
                <li><a href="javascript:desconectar()"><i class="glyphicon glyphicon-option-horizontal"></i></a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container">
    <h3 class="text-center">Cadastro de Votação</h3>
    <hr>
    <div class="col-xs-12">
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-4 col-sm-offset-3 col-md-offset-4">
            <div class="panel panel-default">
            <form method="post" enctype="multipart/form-data" id="cadastrar-votacao">
                <!-- Lista de opções -->
                <ul class="list-group">
                    <li class="list-group-item">
                        <label>Data de Início</label>
                        <input type="text" class="form-control" placeholder="DD/MM/YYYY">
                    </li>
                    <li class="list-group-item">
                        <label>Data de Término</label>
                        <input type="text" class="form-control" placeholder="DD/MM/YYYY">
                    </li>
                    <li class="list-group-item">
                        <input type="file" id="uploadEdital" class="hide" />
                        <span class="glyphicon glyphicon-open-file"></span>
                        <label for="uploadEdital" class="btn btn-large">Enviar Edital</label>
                        <div class="material-switch pull-right">
                            <a class="btn btn-info" href="#">Upload</a>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <button type="button" class="btn btn-danger">Cancelar</button>
                        <div class="material-switch pull-right">
                            <a class="btn btn-success" href="votacao.html">Confirmar</a>
                        </div>
                    </li>
                </ul>
            </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function desconectar(){
        $.ajax({
            method: "POST",
            url: "request/desconectar.php",
            success: function(){
                location.href = "login.php";
            }
        });
    }
    $("#cadastrar-votacao").on("submit", function(){
        $.ajax({
            
        });
        return false;
    });
</script>
</body>
</html>
