<!DOCTYPE html>
<html lang="br">

<head>
    <title>Votação</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<?= $head ?>
</head>

<body>
    <?= $menu ?>
	<div class="container">
        <h3 class="text-center">Votação em Andamento</h3>
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
                                <label>Início da candidatura</label>
                                <input type="text" class="form-control date" placeholder="DD/MM/YYYY" id="iniciocandidatura" name="inicio">
                            </li>
                            <li class="list-group-item">
                                <label>Término da candidatura</label>
                                <input type="text" class="form-control date" placeholder="DD/MM/YYYY" id="terminocandidatura" name="terminocandidatura">
                            </li>
                            <li class="list-group-item">
                                <label>Início da votação</label>
                                <input type="text" class="form-control date" placeholder="DD/MM/YYYY" id="iniciovotacao" name="iniciovotacao">
                            </li>
                            <li class="list-group-item">
                                <label>Término da votação</label>
                                <input type="text" class="form-control date" placeholder="DD/MM/YYYY" id="terminovotacao" name="terminovotacao">
                            </li>                            
                            <li class="list-group-item">
                                <label>Número de funcionários</label>
                                <input type="number" class="form-control" id="numerofuncionarios" name="numerofuncionarios" min="1">
                            </li>
                            <li class="list-group-item">
                                <label>Negócio</label>
                                <select class="form-control" name="negocio" id="negocio">
                                    <?php foreach($negocios as $negocio): ?>
                                        <option value="<?= $negocio->getId()?>"><?= $negocio->getArea() ?></option>
                                    <?php endforeach; ?>
                                </select>
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
  <script type="text/javascript">
      $(function(){
          $("#cadastrar-votacao").on("submit", function(){
              var data = new FormData();
              data.append("iniciocandidatura", $("#iniciocandidatura").val());
              data.append("terminocandidatura", $("#terminocandidatura").val());
              data.append("iniciovotacao", $("#iniciovotacao").val());
              data.append("terminovotacao", $("#terminovotacao").val());
              data.append("numerofuncionarios", $("#numerofuncionarios").val());
              data.append("negocio", $("#negocio").val());
              data.append("edital[]", document.getElementById("uploadEdital").files[0]);
              $.ajax({
                  type: "post",
                  url: "<?= site_url("cipa/cadastrar") ?>",
                  processData: false,
                  contentType: false,
                  data: data,
                  success: function(retorno){
                      retorno = JSON.parse(retorno);
                      if(retorno.tipo === "erro"){
                          imprimeNotificacao(retorno.mensagem, "error");
                      } else{
                          imprimeNotificacao("Cipa cadastrada com sucesso!", "success");
                      }
                  }
              });
              return false;
          });
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
<html>