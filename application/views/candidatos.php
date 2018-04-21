<!DOCTYPE html>
<html lang="br">

<head>
    <title>Votação</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= link_tag("application/third_party/bootstrap-3.3.7/bootstrap-3.3.7/dist/css/bootstrap.min.css") ?>
    <?= link_tag("application/third_party/cssCharts.css") ?>
    <?= link_tag("application/libraries/simulacao.css") ?>
    <?= script_tag("application/third_party/jquery/jquery.min.js") ?>
    <?= script_tag("application/third_party/bootstrap-3.3.7/bootstrap-3.3.7/dist/js/bootstrap.min.js") ?>
    <?= script_tag("application/third_party/notify.js") ?>
    <?= script_tag("application/third_party/jquery.chart.js") ?>
    <?= link_tag("application/third_party/select2/dist/css/select2.min.css") ?>
    <?= script_tag("application/third_party/select2/dist/js/select2.min.js") ?>
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
          $("#votar").on("click", function(){
              var candidato_id = $("#candidatos").val();
              var cipa_id = $(this).data("cipa_id");
              $.ajax({
                  type: "post",
                  url: "<?= site_url("cipa/votar") ?>",
                  data: {
                      cipa_id: cipa_id,
                      candidato_id: candidato_id
                  },
                  success: function(){
                      // location.href = "login.php";
                  }
              });
          });
      });
  </script>

</body>
<html>