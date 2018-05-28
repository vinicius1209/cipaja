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
        <?php foreach($candidatos as $candidato): ?>
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
        </div>
    </div>
  <script type="text/javascript">
    
      $(document).ready(function(){
          
        $document = $(this);

        $(".thumbnail").on("click", function(){
             
            var $thumbnail = $(this);
            var $candidato = $thumbnail.find('.candidatoDAO');
             
            var cipa_id = <?= $cipa_id ?>;
              
            var candidato_id = $candidato.data('id');

           var votoAjax = $.ajax({
                  type: "post",
                  url: "<?= site_url("cipa/votar") ?>",
                  data: {
                      cipa_id: cipa_id,
                      candidato_id: candidato_id
                  },
                  success: function(retorno){
                      console.log(retorno);
                      if(retorno == 1){
                           imprimeNotificacao('sucesso', 'Voto realizado com sucesso!');
                      } else{
                           imprimeNotificacao('info', 'Você já votou nesta Cipa!');                      
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