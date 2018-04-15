<!DOCTYPE html>
<html>

<head>
    <title>Bem-vindo!</title>
    <meta charset="UTF-8">
    <?= link_tag("application/third_party/bootstrap-3.3.7/bootstrap-3.3.7/dist/css/bootstrap.min.css") ?>
    <?= link_tag("application/libraries/login.css") ?>
    <?= script_tag("application/third_party/jquery/jquery.min.js") ?>
    <?= script_tag("application/third_party/bootstrap-3.3.7/bootstrap-3.3.7/dist/js/bootstrap.min.js") ?>
</head>
<body>
<?= $menu ?>
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
