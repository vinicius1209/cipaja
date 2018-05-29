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

<div class="container votacaoAberta">
    <div class="row">
        <div class="col-md-12 text-center">    
            <div class="row">   
                <div class="col-md-12">
                    <div class="thumbnail votacao">
                        <div class="row">                    
                            <div class="col-md-12">
                                <img src="<?php echo base_url('img/funcionarios.jpg'); ?>" class="img-fluid" alt="Responsive image">
                                <div class="caption overlay">
                                    <input type="file" id="uploadArquivo" class="inputfuncionarios" />
                                    <label for="uploadArquivo" id="uploadArquivoDesc">Escolha um Arquivo</label>                                    
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-success btn-block upload">Upload</button>
                            </div>
                        </div> 
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(function(){
        
        //$("#importar-funcionarios").on("submit", function(){
         $(".upload").off("click").on("click", function(){     

            if (document.getElementById("uploadArquivo").value == ''){
                imprimeNotificacao('erro', 'É necessário carregar o Arquivo antes de dar Upload!');
                return false;
            }

            var data = new FormData();
            data.append("funcionarios[]", document.getElementById("uploadArquivo").files[0]);
            $.ajax({
                type: "post",
                url: "<?= site_url("System/importarFuncionarios") ?>",
                processData: false,
                contentType: false,
                data: data,
                success: function(retorno){
                    retorno = JSON.parse(retorno);
                    if(retorno){
                        imprimeNotificacao('sucesso', 'Usuários importados com sucesso!');
                    } else{
                        imprimeNotificacao('erro', 'Usuarios nao puderam ser importados');
                    }
                }
            });
            return false;
        });

        $("#uploadArquivo").on("change", function(){
            var arquivo = document.getElementById("uploadArquivo").files[0].name;
            $("uploadArquivoDesc").html(arquivo);
        });
    });
</script>
</body>
<html>