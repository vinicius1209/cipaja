<?php
require_once __DIR__."/../session.php";
if (!$usuario instanceof \Administrador){
    header("location: ./../index.php");
}
?>
<!DOCTYPE html>
<html lang="br">

<head>
    <title>Bem-vindo!</title>
    <link rel="stylesheet" href="../assets/bootstrap-3.3.7/bootstrap-3.3.7/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/jquery/jquery-ui/jquery-ui.css">
    <script src="../assets/jquery/jquery.min.js"></script>
    <script src="../assets/jquery/jquery-ui/jquery-ui.js"></script>
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
                        <label>Início da votação</label>
                        <input type="text" class="form-control date" placeholder="DD/MM/YYYY" id="iniciovotacao" name="iniciovotacao">
                    </li>
                    <li class="list-group-item">
                        <label>Término da votação</label>
                        <input type="text" class="form-control date" placeholder="DD/MM/YYYY" id="terminovotacao" name="terminovotacao">
                    </li>
                    <li class="list-group-item">
                        <label>Início da candidatura</label>
                        <input type="text" class="form-control date" placeholder="DD/MM/YYYY" id="iniciocandidatura" name="inicio">
                    </li>
                    <li class="list-group-item">
                        <label>Término da candidatura</label>
                        <input type="text" class="form-control date" placeholder="DD/MM/YYYY" id="terminocandidatura" name="terminocandidatura">
                    </li>
                    <li class="list-group-item">
                        <input type="file" id="uploadEdital" class="hide" />
                        <span class="glyphicon glyphicon-open-file"></span>
                        <label for="uploadEdital" class="btn btn-large">Enviar Edital</label>
                        <span id="editalNome"></span>
                    </li>
                    <li class="list-group-item">
                        <button type="button" class="btn btn-danger">Cancelar</button>
                        <div class="material-switch pull-right">
                            <button class="btn btn-success">Confirmar</button>
                        </div>
                    </li>
                </ul>
            </form>
            </div>
        </div>
    </div>
</div>
<script src="./../js/notify.js"></script>
<script type="text/javascript">
    function desconectar(){
        $.ajax({
            method: "POST",
            url: "../request/desconectar.php",
            success: function(){
                location.href = "../login.php";
            }
        });
    }
    $("#cadastrar-votacao").on("submit", function(){
        var data = new FormData();
        data.append("iniciocandidatura", $("#iniciocandidatura").val());
        data.append("terminocandidatura", $("#terminocandidatura").val());
        data.append("iniciovotacao", $("#iniciovotacao").val());
        data.append("terminovotacao", $("#terminovotacao").val());
        data.append("edital[]", document.getElementById("uploadEdital").files[0]);
        $.ajax({
            type: "post",
            url: "../request/cadastrarVotacao.php",
            processData: false,
            contentType: false,
            data: data,
            success: function(retorno){
                retorno = JSON.parse(retorno);
                if(retorno["tipo"] == "erro"){
					imprimeNotificacao(retorno["mensagem"], "error");
                } else{			
					imprimeNotificacao("Cipa cadastrada com sucesso!", "success");
                }
            }
        });
        return false;
    });
    $(function(){
        $(".date").datepicker({
            dateFormat: "dd/mm/yy"
        });
        $("#uploadEdital").on("change", function(){
            var arquivo = document.getElementById("uploadEdital").files[0].name;
            $("#editalNome").html(arquivo);
        });
    });
</script>
</body>
</html>
