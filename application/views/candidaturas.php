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
<div class="container containerCandidatos">
    <div class="row">
        <?php foreach($cipas as $cipa): ?>
            <h2><?= $cipa->getId() ?></h2>
            <small>Candidatura: <?= $cipa->getInicioCandidaturaAsDateTime()->format('d/m/Y') ?> - <?= $cipa->getFimCandidaturaAsDateTime()->format('d/m/Y') ?></small>
            <small>Votação: <?= $cipa->getInicioVotacaoAsDateTime()->format('d/m/Y') ?> - <?= $cipa->getFimVotacaoAsDateTime()->format('d/m/Y') ?></small>

            <?php foreach ($cipa->getCandidatos() as $candidato): ?>
            <div class="col-md-6">
                <div class="thumbnail candidatos">
                    <img src="<?php echo base_url('img/candidatos.png'); ?>" alt="Lights" style="height:250px" >
                    <div class="caption">
                        <p class="candidatoDAO" data-id="<?= $candidato->getId() ?>"> <?= $candidato->getNome() ?></p>
                    </div>
                    </a>
                </div>
            </div>
            <?php endforeach; ?>
            <?php if ($cipa->getInicioCandidaturaAsDateTime() <= new \DateTime() && new \DateTime() <= $cipa->getFimCandidaturaAsDateTime()): ?>
            <div>
                <button type="button" class="btn btn-default candidatarse" data-cipa_id="<?= $cipa->getId()?>">Candidatar-se</button>
            </div>
            <?php endif; ?>
        <?php endforeach; ?>
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
    });
    $(document).ready(function(){

        $(".thumbnail").on("click", function(){

            // var $thumbnail = $(this);
            // var $candidato = $thumbnail.find('.candidatoDAO');
            //
            //
            // var candidato_id = $candidato.data('id');


        });
    });
</script>

</body>
</html>