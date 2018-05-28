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
	    <div class="col-md-12 text-center">
			<?php foreach($cipas as $cipa): ?>
				<div class="row">
					<div class="col-md-12">
						<div class="thumbnail votacao"> 
							<div class="row">                    
                                    <div class="col-md-12">
										<h2>Lista de Candidatos da Cipa N.° <?= $cipa->getId() ?></h2>
										<p>Candidatura: <?= $cipa->getInicioCandidaturaAsDateTime()->format('d/m/Y') ?> - <?= $cipa->getFimCandidaturaAsDateTime()->format('d/m/Y') ?></p>
										<p>Votação: <?= $cipa->getInicioVotacaoAsDateTime()->format('d/m/Y') ?> - <?= $cipa->getFimVotacaoAsDateTime()->format('d/m/Y') ?></p>
									</div>
							</div>
							<div class="row">
								<?php foreach ($cipa->getCandidatos() as $candidato): ?>
                                    <div class="col-md-6"> 
										<img src="<?php echo base_url('img/candidatos.png'); ?>" alt="Lights" style="height:250px" >
										<div class="caption">
											<p class="candidatoDAO" data-id="<?= $candidato->getId() ?>"> <?= $candidato->getNome() ?></p>
										</div>
                                        <?php switch ($candidato->getAprovacao()){
                                            case 0:
                                                echo "<button class='btn btn-success aprovarCandidato' data-valor='1' data-id='{$candidato->getId()}'>Aprovar</button>";
                                                echo "<button class='btn btn-danger aprovarCandidato' data-valor='2' data-id='{$candidato->getId()}'>Reprovar</button>";
                                                break;
                                            case 1:
                                                echo "<span class='btn btn-success'>Aprovado</span>";
                                                break;
                                            case 2:
                                                echo "<span class='btn btn-danger'>Reprovado</span>";
                                                break;
                                        }
                                        ?>
									</div>
								<?php endforeach; ?>
							</div>
							<div class='row'>                 
                                <div class="col-md-12">
									<button type="button" class="btn btn-success btn-lg btn-block candidatarse" data-cipa_id="<?= $cipa->getId()?>">Candidatar-se</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
    </div>
</div>
<script type="text/javascript">
    $(function(){
        $(".candidatarse").off("click").on("click", function(){
            var cipa_id = $(this).data("cipa_id");
            console.log(cipa_id);
            $.ajax({
                type: "POST",
                url: "<?= site_url("cipa/candidatarse") ?>",
                data: {
                    cipa_id: cipa_id,
                },
                success: function(retorno){
                    retorno = JSON.parse(retorno);
                    console.log(retorno);
                    if(retorno === 1){
                        imprimeNotificacao('sucesso', 'Candidatado com sucesso!');
                    } else{
                        imprimeNotificacao('info', 'Você já se candidatou nesta cipa!');
                    }
                },
                error: function(retorno){
                    imprimeNotificacao('erro', 'Ocorreu um erro inesperado no retorno!');
                }
            });
        });

        $(".aprovarCandidato").off("click").on("click", function(){
            var candidato_id = $(this).data("id");
            var valor        = $(this).data("valor");
            $.ajax({
                type: "POST",
                url: "<?= site_url("Cipa/aprovarCandidatura") ?>",
                data: {
                    candidato_id: candidato_id,
                    valor: valor,
                },
                success: function(retorno){
                    retorno = JSON.parse(retorno);
                    console.log(retorno);
                    if(retorno === 1){
                        if (valor == '1') {
                            imprimeNotificacao('sucesso', 'Candidadura aprovada!');
                        } else{
                            imprimeNotificacao('sucesso', 'Candidatura reprovada!');
                        }
                    } else{
                        imprimeNotificacao('info', 'Ocorreu um erro!');
                    }
                },
                error: function(retorno){
                    imprimeNotificacao('erro', 'Ocorreu um erro inesperado no retorno!');
                }
            });
        });
    });
   
</script>

</body>
</html>