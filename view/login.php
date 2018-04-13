<meta charset="utf-8">
<html lang="pt-br">
<head>
    <title>Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="assets/bootstrap-3.3.7/bootstrap-3.3.7/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/login.css">
    <script src="assets/jquery/jquery.min.js"></script>
    <script src="assets/bootstrap-3.3.7/bootstrap-3.3.7/dist/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container" style="margin-top:40px">
        <div class="row">
            <div class="col-sm-6 col-md-4 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h2 class="text-center"> Bem-Vindo!</h2>
                    </div>
                    <div class="panel-body">
                        <form method="post" id = "login-form">
                            <div class="row">
                                <div class="col-sm-12 col-md-10  col-md-offset-1 ">
                                    <form> 
                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                        <i class="glyphicon glyphicon-envelope"></i>
                                                    </span>
                                                <input class="form-control" placeholder="Matrícula" name="matricula" id="matricula" type="text" autofocus>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                        <i class="glyphicon glyphicon-asterisk"></i>
                                                    </span>
                                                <input class="form-control" placeholder="Senha" name="senha" id="senha" type="password" value="">
                                            </div>
                                        </div>
                                        <div class="col-sm-offset-1">
                                            <label class="checkbox">
                                            <input type="checkbox" value="Lembrar-me"> Lembrar-me
                                            </label>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-lg btn-success btn-block">Entrar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
		<script type="text/javascript" src="js/notify.js"></script>
        <script type="text/javascript">
            $("#login-form").on("submit", function(){
                $.ajax({
                    type: "post",
                    url: "index.php?controller=system&action=login",
                    data: {matricula: $("#matricula").val(), senha: $("#senha").val()},
                    success: function(retorno){
                        retorno = JSON.parse(retorno);
                        if (retorno){
                            location.href = "index.php";
                        } else{
							imprimeNotificacao("Login ou Senha incorreto!", "warn");
                        }
                    }
                });
                return false;
            });
        </script>
</body>
<html>