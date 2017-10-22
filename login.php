<?php
   include("config.php");
   session_start();
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      
      $mymatricula = mysqli_real_escape_string($db,$_POST['matricula']);
      $mypassword = mysqli_real_escape_string($db,$_POST['password']); 

      echo "Hello world!"; 
      
      $sql = "SELECT id FROM usuario WHERE matricula = '$mymatricula' and senha = '$mypassword'";
      $result = mysqli_query($db,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      $active = $row['active'];
      
      $count = mysqli_num_rows($result);
      
      // If result matched $myusername and $mypassword, table row must be 1 row
		
      if($count == 1) {
         session_register("mymatricula");
         $_SESSION['login_user'] = $mymatricula;
         
         header("location: welcome.php");
      }else {
         $error = "Your Login Name or Password is invalid";
      }
   }
?>
<meta charset="utf-8">
<html lang="br">

<head>
    <title>Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="css\login.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

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
                        <form>
                            <div class="row">
                                <div class="col-sm-12 col-md-10  col-md-offset-1 ">
                                    <form> 
                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                        <i class="glyphicon glyphicon-envelope"></i>
                                                    </span>
                                                <input class="form-control" placeholder="Matrícula" name="matricula" type="text" autofocus>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                        <i class="glyphicon glyphicon-asterisk"></i>
                                                    </span>
                                                <input class="form-control" placeholder="Senha" name="password" type="password" value="">
                                            </div>
                                        </div>
                                        <div class="col-sm-offset-1">
                                            <label class="checkbox">
                                            <input type="checkbox" value="Lembrar-me"> Lembrar-me
                                            </label>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" method = "post" class="btn btn-lg btn-success btn-block">Entrar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
</body>
<html>