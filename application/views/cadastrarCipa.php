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
    
    <div class="container votacaoAberta">
        <div class="row">
            <div class="col-md-4 text-center">            
                <div class="panel panel-default">
                    <ul class="list-group">
						<li class="list-group-item">
                            <label>Início da candidatura</label>
                            <input type="text" class="form-control date" placeholder="DD/MM/YYYY" id="iniciocandidatura" name="inicio">
                        </li>
                        <li class="list-group-item">
                            <label>Término da candidatura</label>
                            <input type="text" class="form-control date" placeholder="DD/MM/YYYY" id="terminocandidatura" name="terminocandidatura">
                        </li> 
                    </ul> 
                </div>
            </div>

            <div class="col-md-4 text-center">            
                <div class="panel panel-default">
                    <li class="list-group-item">
                        <label>Início da votação</label>
                        <input type="text" class="form-control date" placeholder="DD/MM/YYYY" id="iniciovotacao" name="iniciovotacao">
                    </li>
                    <li class="list-group-item">
                        <label>Término da votação</label>
                        <input type="text" class="form-control date" placeholder="DD/MM/YYYY" id="terminovotacao" name="terminovotacao">
                    </li> 
                </div>
            </div>

            <div class="col-md-4 text-center">            
                <div class="panel panel-default">
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
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 text-center">           
                <div class="row">      
                    <div class="col-md-12">
                        <div class="thumbnail votacao">
                            <div class="row">
                                <div class="col-md-12">
                                    <img src="<?php echo base_url('img/edital.jpg'); ?>" class="img-fluid" alt="Responsive image">
                                    <div class="caption overlay">
                                        <input type="file" id="uploadEdital" class="inputfuncionarios" />
                                        <label for="uploadEdital" id="nomeArquivo">Selecionar Edital</label>                                    
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-success btn-block confirmar">Confirmar</button>
                                </div>
                            </div>
                        <div>
                    </div>
                </div>
            </div>
        </div> 
    </div>         


  <script type="text/javascript">
      $(function(){
          
          //$("#cadastrar-votacao").on("submit", function(){
            $(".confirmar").off("click").on("click", function(){

                if  (!$("#iniciocandidatura").val()){
                    imprimeNotificacao('erro', 'É necessário preencher o Início da Candidatura!');
                    return false;
                };

                if  (!$("#terminocandidatura").val()){
                    imprimeNotificacao('erro', 'É necessário preencher o Término da Candidatura!');
                    return false;
                };

                if  (!$("#iniciovotacao").val()){
                    imprimeNotificacao('erro', 'É necessário preencher o Início da Votação!');
                    return false;
                };

                if  (!$("#terminovotacao").val()){
                    imprimeNotificacao('erro', 'É necessário preencher o Término da Votação!');
                    return false;
                };

                if  (!$("#numerofuncionarios").val()){
                    imprimeNotificacao('erro', 'É necessário preencher o Número de Funcionários!');
                    return false;
                };

                if (document.getElementById("uploadEdital").value == ''){
                    imprimeNotificacao('erro', 'É necessário carregar o Edital!');
                    return false;
                }else if (!(document.getElementById("uploadEdital").files[0].type == 'application/pdf')){
                    imprimeNotificacao('erro', 'O formato do Edital deve ser PDF!');
                    return false;
                }

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
              document.getElementById('nomeArquivo').innerHTML = arquivo;
          });
      });
  </script>
</body>
<html>