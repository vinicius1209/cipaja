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
        <?php foreach($candidatos as $candidato): ?>
            <div class="col-md-4">
                <div class="thumbnail">
                    <a href="https://www.icon2s.com/img256/256x256-black-white-android-user.png" target="_blank">
                    <img src="https://www.icon2s.com/img256/256x256-black-white-android-user.png" alt="Lights" style="width:100%">
                    <div class="caption">
                        <p> <?= $candidato->getNome() ?></p>
                    </div>
                    </a>
                </div>
            </div>
        <?php endforeach; ?>
        </div>
        </div>


    <div class="container">
		<div class="row form-group text-center">
			<div class="col-md-12">
                <select id="candidatos" class="form-control">
                    <option></option>
                <?php foreach($candidatos as $candidato): ?>
                    <option value="<?= $candidato->getId() ?>"><?= $candidato->getNome() ?></option>
                <?php endforeach; ?>
                </select>
			</div>
		</div>
        <div class="row form-group text-center">
            <div class="col-md-6">
                <button class="btn btn-danger">Voltar</button>
            </div>
            <div class="col-md-6">
                <button class="btn btn-success" id="votar" data-cipa_id="<?= $cipa_id ?>">Votar</button>
            </div>
        </div>
    </div>
  <script type="text/javascript">
      $(function(){
          $("#candidatos").select2({
              placeholder: "Selecione um candidato"
          });
          $("#votar").off("click").on("click", function(){
              var candidato_id = $("#candidatos").val();
              var cipa_id = $(this).data("cipa_id");
              $.ajax({
                  type: "post",
                  url: "<?= site_url("cipa/votar") ?>",
                  data: {
                      cipa_id: cipa_id,
                      candidato_id: candidato_id
                  },
                  success: function(retorno){
                      if (retorno){
						 alert("Voto realizado com sucesso");
						 //imprimeNotificacao("Você já votou nesta cipa", "success");
						} else{
							alert("Você já votou nesta cipa");
							//console.log("nao entrou");
							//imprimeNotificacao("Você já votou nesta cipa", "warn");
						}
                  },
				  error: function(retorno){
					  imprimeNotificacao("retornoop", "success");
				  }
              });
          });
      });
  </script>

</body>
<html>