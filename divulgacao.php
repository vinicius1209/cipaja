<!DOCTYPE html>
<html lang="br">

<head>
    <title>Votação</title>
    <meta charset="utf-8">
    <?= $head ?>
    <?= script_tag("application/libraries/react/vencedores.js") ?>
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
        <h1>Cipas finalizadas</h1>
		<div class="row">
			<div class="col-md-12 text-center">
				<table class="table table-striped custab">
					<thead>
						<tr>
							<th>#</th>
							<th class='text-center'>Data de Início</th>
							<th class='text-center'>Data de Término</th>
							<th class="text-center">Ações</th>
						</tr>
					</thead>
                    <?php foreach($cipas as $cipa): ?>
                    <tr>
                        <td><?= $cipa->getId() ?></td>
                        <td><?= $cipa->getInicioVotacaoAsDateTime()->format('d/m/Y') ?></td>
                        <td><?= $cipa->getFimVotacaoAsDateTime()->format('d/m/Y') ?></td>
                        <td><button class="btn btn-success btn-xs" onClick="vencedores(<?= $cipa->getId() ?>)">Vencedores</button></td>
                    </tr>
                    <?php endforeach; ?>
				</table>
			</div>
		</div>
        <div id="vencedores">
            <h2>Efetivos</h2>
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-striped bs-custab">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Número de votos</th>
                            </tr>
                        </thead>
                        <tbody id="efetivos">

                        </tbody>
                    </table>
                </div>
            </div>
            <h2>Suplentes</h2>
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-striped bs-custab">
                        <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Número de votos</th>
                        </tr>
                        </thead>
                        <tbody id="suplentes">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</body>
<html>
