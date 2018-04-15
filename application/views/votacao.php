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
			<div class="col-md-12 text-center">
				<table class="table table-striped custab">
					<thead>
						<tr>
							<th>#</th>
							<th>Data de Início</th>
							<th>Data de Término</th>
							<th class="text-center">Ações</th>
						</tr>
					</thead>
                    <?php foreach($cipas->result() as $cipa): ?>
                    <tr>
                        <td><?= $cipa->id ?></td>
                        <td><?= (new \DateTime($cipa->inicio_votacao))->format('d/m/Y') ?></td>
                        <td><?= (new \DateTime($cipa->fim_votacao))->format('d/m/Y') ?></td>
                        <td class="text-center"><a class='btn btn-success btn-xs' href="votacao_candidatos.html"><span class="glyphicon glyphicon-edit"></span> Votar</a>
<!--                            <a href="candidatarse.html" class="btn btn-info btn-xs"><span class="glyphicon glyphicon-pencil"></span> Candidatar-se</a></td>-->
                    </tr>
                    <?php endforeach; ?>
				</table>    
			</div>
		</div>
    </div>
	<div class="row">
		<div class="col-md-12 text-center">
			<div class="chart donut"">
				<div class="donut-chart" style="width: 200%; height: 200%;" data-percent="0.70" data-title="Votos Necessários"> </div>
			</div>
		</div>
	</div>
	
	
  <script type="text/javascript">
           $(function () {
				$('.donut-chart').cssCharts({ type: "donut" }).trigger('show-donut-chart');
          });
  </script>

</body>
<html>