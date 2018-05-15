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
                                        <img src="<?php echo base_url('img/votacao.jpg'); ?>" class="img-fluid" alt="Responsive image">
                                        <div class="caption overlay">
                                            <p class="text"> Data de Início: <?= $cipa->getInicioVotacaoAsDateTime()->format('d/m/Y') ?> </p>
                                            <p class="text2"> Data de Término: <?= $cipa->getFimVotacaoAsDateTime()->format('d/m/Y') ?> </p>
                                        </div>
                                    </div>
                                </div>                            
                                <div class="row">
                                    <div class="col-md-6"> 
                                        <?= anchor("system/download/".$cipa->getEdital(), "Edital", "class='btn btn-info btn-block' target='_blank'") ?>
                                    </div>
                                    <div class="col-md-6">
                                        <?= anchor("cipa/candidatos/".$cipa->getId(), 'Votar', 'class="btn btn-success btn-block"' ) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>   
                </div>                
            </div>
        </div>   
    </body>
<html>
