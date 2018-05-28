<!DOCTYPE html>
<html lang="br">

<head>
    <title>Importação</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= $head ?>
</head>

<body>
<?= $menu ?>
<div class="container">
    <h3 class="text-center">Importação de funcionários</h3>
    <hr>
    <div class="col-xs-12">
    </div>
</div>

<div class="container">
    <div class="row">
        <form method="post" enctype="multipart/form-data" id="importar-funcionarios">
            <div class="col-xs-12 col-sm-6 col-md-4 col-sm-offset-3 col-md-offset-4">
                <div class="panel panel-default">
                    <!-- Lista de opções -->
                    <ul class="list-group">
                        <li class="list-group-item">
                            <input type="file" id="upload" class="hide"  />
                            <span class="glyphicon glyphicon-open-file"></span>
                            <label for="upload" class="btn btn-large">Escolha um arquivo</label>
                            <span id="uploadNome"></span>
                            <div class="material-switch pull-right">
                                <button type="submit" class="btn btn-success">Upload</button>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </form>
    </div>
</div>
<script type="text/javascript">
    $(function(){
        $("#importar-funcionarios").on("submit", function(){
            var data = new FormData();
            data.append("funcionarios[]", document.getElementById("upload").files[0]);
            $.ajax({
                type: "post",
                url: "<?= site_url("System/importarFuncionarios") ?>",
                processData: false,
                contentType: false,
                data: data,
                success: function(retorno){
                    retorno = JSON.parse(retorno);
                    if(retorno){
                        imprimeNotificacao("Usuarios importados com sucesso!", "success");
                    } else{
                        imprimeNotificacao("Usuarios nao puderam ser importados", "error");
                    }
                }
            });
            return false;
        });

        $("#upload").on("change", function(){
            var arquivo = document.getElementById("upload").files[0].name;
            $("#uploadNome").html(arquivo);
        });
    });
</script>
</body>
<html>